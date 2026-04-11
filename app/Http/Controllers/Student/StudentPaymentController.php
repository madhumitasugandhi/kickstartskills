<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StudentPaymentController extends Controller
{
    public function createOrder($driveId)
{
    try {
        $studentId = auth()->id();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt' => 'drive_'.$driveId.'_'.time(),
            'amount' => 100 * 100,
            'currency' => 'INR'
        ]);

        // Platform payment
        $platformPaymentId = DB::table('platform_payments')->insertGetId([
            'user_id' => $studentId,
            'payment_for' => 'drive_exam',
            'reference_id' => $driveId,
            'amount' => 100,
            'razorpay_order_id' => $order['id'],
            'status' => 'pending'
        ]);

        // Student drive payment
        $existing = DB::table('student_drive_payments')
    ->where('student_id', $studentId)
    ->where('drive_id', $driveId)
    ->first();

if ($existing && $existing->status == 'paid') {
    return response()->json(['error' => 'Already paid']);
}

if (!$existing) {
    DB::table('student_drive_payments')->insert([
        'student_id' => $studentId,
        'drive_id' => $driveId,
        'platform_payment_id' => $platformPaymentId,
        'amount' => 100,
        'status' => 'pending'
    ]);
}

        return response()->json([
            'order_id' => $order['id'],
            'amount' => 100,
            'key' => env('RAZORPAY_KEY')
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage()
        ], 500);
    }
}
   

public function paymentSuccess(Request $request)
{
    $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    try {
        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature
        ];

        $api->utility->verifyPaymentSignature($attributes);

    } catch(SignatureVerificationError $e) {
        return response()->json(['status' => 'signature_failed']);
    }

    // Update platform payment
    DB::table('platform_payments')
        ->where('razorpay_order_id', $request->razorpay_order_id)
        ->update([
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature,
            'status' => 'paid',
            'paid_at' => now()
        ]);

    DB::table('student_drive_payments')
        ->where('platform_payment_id', function($q) use ($request){
            $q->select('id')
              ->from('platform_payments')
              ->where('razorpay_order_id', $request->razorpay_order_id)
              ->limit(1);
        })
        ->update(['status' => 'paid']);

    return response()->json(['status' => 'success']);
}
}