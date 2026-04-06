<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HRAuthController extends Controller
{
    // HR Login Form
    public function showLoginForm()
    {
        // Agar pehle se logged in hai aur HR hai, toh dashboard bhejo
        if (Auth::check() && Auth::user()->admin_role_id == 2) {
            return redirect()->route('hr.dashboard');
        }
        return view('frontend.hrPortal.auth.hr_login');
    }

    // Login Logic
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($request->only('email', 'password'), $remember)) {
            $user = Auth::user();

            // ROLE ID 2 CHECK
            if ($user->admin_role_id == 2) {
                $request->session()->regenerate();
                return redirect()->intended(route('hr.dashboard'));
            }

            // Agar role match nahi hota toh logout
            Auth::logout();
            return back()->withErrors(['email' => 'Unauthorized: This portal is for HR only.']);
        }

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('hr.login');
    }

    // Show Forgot Password Page
    public function showForgotPassword()
    {
        return view('frontend.hrPortal.auth.forgot_password');
    }
}
