<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class StudentPaymentController extends Controller
{
    public function createOrder($driveId)
    {
        $student = auth()->user();

        $existingPayment = DB::table('platform_payments')
            ->where('user_id', $student->id)
            ->where('reference_id', $driveId)
            ->orderByDesc('id')
            ->first();

        if ($existingPayment && $existingPayment->status === 'success') {
            return response()->json(['error' => 'Already paid']);
        }

        if ($existingPayment && $existingPayment->status === 'pending') {
            $orderId = $existingPayment->gateway_order_id;
            $amount = $existingPayment->total_amount;
        } else {
            $orderId = 'ORD_' . uniqid();
            $baseAmount = 10;

            $convenienceFee = round($baseAmount * 0.02, 2);
            $gst = round($convenienceFee * 0.18, 2);
            $totalAmount = round($baseAmount + $convenienceFee + $gst, 2);
            
            // DB me full breakdown store karo
            DB::table('platform_payments')->insert([
                'user_id' => $student->id,
                'payment_for' => 'drive',
                'reference_id' => $driveId,
                'gateway_order_id' => $orderId,
            
                'base_amount' => $baseAmount,
                'convenience_fee' => $convenienceFee,
                'gst_amount' => $gst,
                'total_amount' => $totalAmount,
            
                'status' => 'created',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            // Gateway ko sirf base bhejo
            $amount = $baseAmount;
        }

        // update to pending
        DB::table('platform_payments')
            ->where('gateway_order_id', $orderId)
            ->update(['status' => 'pending']);

        $profile = DB::table('student_profiles')
            ->where('user_id', $student->id)
            ->first();
        $institutionAddress = DB::table('institution_addresses as ia')
            ->join('institutions as i', 'i.institution_id', '=', 'ia.institution_id')
            ->leftJoin('cities as c', 'c.id', '=', 'ia.city_id')
            ->leftJoin('states as s', 's.id', '=', 'ia.state_id')
            ->where('i.user_id', $student->institution_id)
            ->select(
                'ia.postal_code',
                'c.name as city_name',
                's.name as state_name'
            )
            ->first();

        $data = [
            "api_key" => config('services.ablepay.api_key'),
            "order_id" => $orderId,
            "amount" => $amount,
            "currency" => "INR",
            "description" => "Drive Exam Payment",
            "name" => $student->full_name,
            "email" => $student->email,
            "phone" => $profile->phone ?? '',
            "city" => $institutionAddress->city_name ?? '',
            "state" => $institutionAddress->state_name ?? '',
            "zip_code" => $institutionAddress->postal_code ?? '',
            "country" => "India",
            "mode" => "TEST",
            "return_url" => route('student.payment.callback'),
        ];

        $data['hash'] = $this->generateHash($data);

        return response()->json(['payment_data' => $data]);
    }

    private function generateHash($input)
    {
        $salt = config('services.ablepay.salt_key');

        $hash_columns = [
            'amount',
            'api_key',
            'city',
            'country',
            'currency',
            'description',
            'email',
            'mode',
            'name',
            'order_id',
            'phone',
            'return_url',
            'state',
            'zip_code'
        ];

        sort($hash_columns);

        $hash_data = $salt;

        foreach ($hash_columns as $column) {
            if (isset($input[$column]) && strlen($input[$column]) > 0) {
                $hash_data .= '|' . trim($input[$column]);
            }
        }

        return strtoupper(hash("sha512", $hash_data));
    }
    //  CALLBACK (User redirect)
    public function callback(Request $request)
    {
        Log::info('CALLBACK DATA:', $request->all());

        $orderId = $request->order_id ?? null;
        $isSuccess = $request->response_code == '0';

        if (!$orderId) {
            return redirect('/student/dashboard/examinations/approved-drives')
                ->with(
                    $isSuccess ? 'success' : 'error',
                    $isSuccess ? 'Payment successful!' : 'Payment failed!'
                );
        }


        $responseCode = $request->response_code ?? null;

        //  AblePay success code
        $isSuccess = $responseCode == '0';

        DB::table('platform_payments')
            ->where('gateway_order_id', $orderId)
            ->update([
                'status' => $isSuccess ? 'success' : 'failed',
                'gateway_payment_id' => $request->transaction_id ?? null,
                'paid_at' => $isSuccess ? now() : null,
                'gateway_response' => json_encode($request->all()),
                'updated_at' => now()
            ]);

        $payment = DB::table('platform_payments')
            ->where('gateway_order_id', $orderId)
            ->first();

            if ($payment && $payment->user_id) {
                Auth::loginUsingId($payment->user_id);
            }

        //  Grant access ONLY if success
        if ($isSuccess && $payment) {

            $exists = DB::table('student_drive_payments')
                ->where('platform_payment_id', $payment->id)
                ->exists();

            if (!$exists) {
                DB::table('student_drive_payments')->insert([
                    'student_id' => $payment->user_id,
                    'drive_id' => $payment->reference_id,
                    'platform_payment_id' => $payment->id,
                    'amount' => $payment->total_amount,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('student.exam.approved-drives')
            ->with(
                $isSuccess ? 'success' : 'error',
                $isSuccess ? 'Payment successful!' : 'Payment failed!'
            );
    }

    //  WEBHOOK (REAL CONFIRMATION)
    public function webhook(Request $request)
    {
        //  Handle BOTH JSON + POST
        $data = $request->all();

        if (!$data || empty($data)) {
            return response()->json(['error' => 'No data received'], 400);
        }

        $orderId = $data['order_id']
            ?? $data['orderId']
            ?? $data['gateway_order_id']
            ?? null;

        $paidAmount = $data['amount']
            ?? $data['txnAmount']
            ?? $data['total_amount']
            ?? 0;

        $responseCode = $data['response_code'] ?? null;
        $isSuccess = $responseCode == '0';

        if (!$orderId) {
            Log::error('Missing order_id', $data);
            return response()->json(['error' => 'Order ID missing'], 400);
        }

        $payment = DB::table('platform_payments')
            ->where('gateway_order_id', $orderId)
            ->first();

        if (!$payment) {
            return response()->json(['error' => 'Payment not found'], 404);
        }

        // Normalize status
        $finalStatus = $isSuccess ? 'success' : 'failed';

        $receivedHash = $data['hash'] ?? '';

        $calculatedHash = $this->generateHash($data);

        if ($receivedHash !== $calculatedHash) {
            Log::error('HASH MISMATCH', [
                'received' => $receivedHash,
                'calculated' => $calculatedHash
            ]);

            return response()->json(['error' => 'Invalid signature'], 400);
        }

        DB::table('platform_payments')
            ->where('id', $payment->id)
            ->update([
                'status' => $finalStatus,
                'gateway_payment_id' => $data['payment_id'] ?? null,
                'paid_at' => $finalStatus === 'success' ? now() : null,
                'gateway_response' => json_encode($data),
                'updated_at' => now()
            ]);

        //  Grant access ONLY on success
        if ($finalStatus === 'success') {

            $exists = DB::table('student_drive_payments')
                ->where('platform_payment_id', $payment->id)
                ->exists();

            if (!$exists) {
                DB::table('student_drive_payments')->insert([
                    'student_id' => $payment->user_id,
                    'drive_id' => $payment->reference_id,
                    'platform_payment_id' => $payment->id,
                    'amount' => $payment->amount,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return response()->json(['status' => 'ok']);
    }

    public function redirectToGateway(Request $request)
    {
        return view('payment.ablepay_redirect', [
            'data' => $request->all()
        ]);
    }
}
