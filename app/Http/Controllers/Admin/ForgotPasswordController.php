<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\OtpMail; // Make sure you created this Mailable

class ForgotPasswordController extends Controller
{
    // STEP 1: Send OTP to madhumitasugandhi@gmail.com
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $otp = rand(100000, 999999);

        // Securely store the OTP
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($otp),
                'created_at' => now()
            ]
        );

        // Attempt to send the real email
        try {
            Mail::to($request->email)->send(new OtpMail($otp));
            return response()->json([
                'success' => true,
                'message' => 'OTP sent to your inbox.',
                'debug_otp' => $otp // REMOVE THIS for production!
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Mail configuration error: ' . $e->getMessage()
            ], 500);
        }
    }

    // STEP 2: Verify the 6-digit code
    public function verifyOtp(Request $request)
    {
        $request->validate(['email' => 'required|email', 'otp' => 'required']);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$record || !Hash::check($request->otp, $record->token)) {
            return response()->json(['success' => false, 'message' => 'Invalid OTP'], 422);
        }

        return response()->json(['success' => true]);
    }

    // STEP 3: Set the New Password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // Clean up the token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json(['success' => true]);
    }
}
