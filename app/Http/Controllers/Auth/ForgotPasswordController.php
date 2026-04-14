<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\EmailService;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Institution\Institution;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    // 🔥 portal mapping
    private function getModel($portal)
    {
        return match ($portal) {
            'admin' => User::class,
            'mentor' => User::class,
            'student' => User::class,
            'hr' => User::class,
            'institution' => Institution::class,
            default => User::class,
        };
    }

    // ✅ SEND OTP
    public function sendOtp(Request $request, EmailService $emailService, OtpService $otpService)
    {
        $request->validate([
            'email' => 'required|email',
            'portal' => 'required|string'
        ]);

        $model = $this->getModel($request->portal);

        $user = $model::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email not registered'
            ]);
        }

        // 🔥 OTP generate from cache service
        $otpData = $otpService->generateOtp($request->email);

        if (!$otpData['success']) {
            return response()->json([
                'status' => 'error',
                'message' => $otpData['message']
            ]);
        }

        $otp = $otpData['otp'];

        // 📩 Email content
        $html = "
        <div style='font-family: sans-serif; padding:20px'>
            <h2>Password Reset</h2>
            <p>Your OTP:</p>
            <h1 style='letter-spacing:5px'>$otp</h1>
            <p>Valid for 5 minutes</p>
        </div>
        ";

        $emailService->sendRawHtmlEmail(
            $request->email,
            'Password Reset OTP',
            $html
        );

        return response()->json([
            'status' => 'success',
            'message' => 'OTP sent successfully'
        ]);
    }

    // ✅ VERIFY OTP
    public function verifyOtp(Request $request, OtpService $otpService)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required',
            'portal' => 'required|string'
        ]);

        $valid = $otpService->verifyOtp($request->email, $request->otp);

        if (!$valid) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired OTP'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'OTP verified'
        ]);
    }

    // ✅ RESET PASSWORD
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'portal' => 'required|string'
        ]);

        $model = $this->getModel($request->portal);

        $user = $model::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Password reset successful'
        ]);
    }
}