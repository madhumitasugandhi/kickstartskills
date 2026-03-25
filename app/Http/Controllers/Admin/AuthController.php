<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend.adminPortal.auth.admin_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login using the Super Admin we created in Tinker
        if (Auth::attempt($credentials, $request->remember)) {
            $user = Auth::user();

            // Check if they are an Admin (Role 1 or 2)
            if ($user->admin_role_id == User::ROLE_SUPER_ADMIN || $user->admin_role_id == User::ROLE_ADMIN_STAFF) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }

            // If they are a student/mentor trying to sneak into the Admin portal
            Auth::logout();
            return back()->withErrors(['email' => 'Unauthorized access to the Admin Portal.']);
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session to clear all data
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent attacks
        $request->session()->regenerateToken();

        // Redirect back to the login page
        return redirect('/admin-login');
    }
}
