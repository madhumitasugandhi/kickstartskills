<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    // Step 1: Send OTP
    public function sendOtp(Request $request, EmailService $emailService)
    {
        $request->validate(['email' => 'required|email|exists:users,email'], [
            'email.exists' => 'This email address is not registered.'
        ]);

        $otp = rand(100000, 999999);
        $email = $request->email;

        DB::table('password_reset_otps')->updateOrInsert(
            ['email' => $email],
            ['otp' => $otp, 'created_at' => now()]
        );

        $htmlContent = "
            <div style='font-family: sans-serif; padding: 20px; border: 1px solid #ddd; border-radius: 10px;'>
                <h2 style='color: #2563eb;'>Verification Code</h2>
                <p>Hello, use the following OTP to reset your password:</p>
                <h1 style='background: #f4f4f4; padding: 10px; text-align: center; letter-spacing: 5px;'>$otp</h1>
                <p>Valid for 10 minutes only.</p>
            </div>";

        $emailService->sendRawHtmlEmail($email, 'Password Reset OTP', $htmlContent);

        return response()->json(['success' => true, 'message' => 'OTP sent to your email.']);
    }

    // Step 2: Verify OTP
    public function verifyOtp(Request $request)
    {
        $otpData = DB::table('password_reset_otps')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$otpData || Carbon::parse($otpData->created_at)->addMinutes(10)->isPast()) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired OTP.']);
        }

        return response()->json(['success' => true, 'message' => 'OTP Verified.']);
    }

    // Step 3: Reset Password
    public function resetPassword(Request $request)
    {
        $request->validate(['password' => 'required|min:8|confirmed']);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->update(['password' => Hash::make($request->password)]);
            DB::table('password_reset_otps')->where('email', $request->email)->delete();
            return response()->json(['success' => true, 'message' => 'Password reset successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'User not found.']);
    }
}
