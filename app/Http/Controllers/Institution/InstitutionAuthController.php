<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Services\OtpService;
use App\Services\EmailService;

use App\Models\Institution\Institution;

class InstitutionAuthController extends Controller
{

    public function showLogin(Request $request)
    {
        if (Session::has('institution_id')) {
            return redirect('/institution/dashboard');
        }

        return view('frontend.institutionPortal.auth.institutelogin');
    }

    public function login(Request $request)
    {
        // Validate
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Correct Model (Institution)
        $institution = Institution::where('email', $request->email)->first();

        //  Check password (password_hash column)
        if ($institution && Hash::check($request->password, $institution->password_hash)) {

            // Session set
            Session::put('institution_id', $institution->institution_id);
            Session::put('institution_name', $institution->institution_name);

            // Remember Me
            if ($request->remember) {
                $token = Str::random(60);

                $institution->update([
                    'remember_token' => $token
                ]);

                Cookie::queue('institution_remember', $token, 525600); // 1 year
            }

            return redirect('/institution/dashboard');
        }

        //  Login failed
        return back()->with('error', 'Invalid email or password');
    }

    public function logout()
    {
        $token = Cookie::get('institution_remember');

        if ($token) {
            Institution::where('remember_token', $token)
                ->update(['remember_token' => null]);
        }

        Session::forget('institution_id');

        Cookie::queue(Cookie::forget('institution_remember'));

        return redirect('/institution-login');
    }

    public function sendOtp(Request $request, OtpService $otpService, EmailService $emailService)
    {
        try {
    
            $request->validate([
                'email' => 'required|email'
            ]);
    
            $institution = Institution::where('email', $request->email)->first();
    
            if (!$institution) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Email not found'
                ]);
            }
    
            $otpResponse = $otpService->generateOtp($request->email);
    
            if (!$otpResponse['success']) {
                return response()->json([
                    'status' => 'error',
                    'message' => $otpResponse['message']
                ]);
            }
    
            $otp = $otpResponse['otp'];
    
            $html = "<h1>OTP: {$otp}</h1>";
    
            $emailService->sendRawHtmlEmail(
                $request->email,
                'Reset OTP',
                $html
            );
    
            return response()->json([
                'status' => 'success'
            ]);
    
        } catch (\Exception $e) {
    
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage() // 🔥 THIS WILL SHOW REAL ERROR
            ], 500);
        }
    }

public function verifyOtp(Request $request, OtpService $otpService)
{
    $request->validate([
        'email' => 'required|email',
        'otp' => 'required'
    ]);

    $valid = $otpService->verifyOtp($request->email, $request->otp);

    if (!$valid) {
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid or expired OTP'
        ]);
    }

    return response()->json([
        'status' => 'success'
    ]);
}

public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed'
    ]);

    $institution = Institution::where('email', $request->email)->first();

    if (!$institution) {
        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong'
        ]);
    }

    return response()->json([
        'status' => 'success'
    ]);
}


}