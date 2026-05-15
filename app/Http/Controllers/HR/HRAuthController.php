<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\AuthController;
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
    return app(AuthController::class)
        ->login($request, 2); // HR role
}

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('hr.login');
    }

}
