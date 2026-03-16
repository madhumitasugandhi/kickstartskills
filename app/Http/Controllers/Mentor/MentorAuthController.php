<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorAuthController extends Controller
{
    /**
     * Show the mentor login page.
     */
    public function showLogin()
    {
        // Matches the file path you provided earlier
        return view('frontend.mentorPortal.auth.mentor_login');
    }

    /**
     * Handle the login submission.
     */
    public function login(Request $request)
    {
        // 1. Validate the input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Attempt to log the user in
        // The 'remember' checkbox logic is handled here
        if (Auth::attempt($credentials, $request->filled('remember'))) {

            // 3. Role Verification (Only allow Mentor role ID: 3)
            if (Auth::user()->admin_role_id == 3) {
                $request->session()->regenerate();

                return redirect()->intended(route('mentor.dashboard'))
                    ->with('success', 'Welcome back to your Mentor Portal!');
            }

            // 4. If they aren't a mentor, log them out and block access
            Auth::logout();
            return back()->withErrors([
                'email' => 'Access denied. This portal is strictly for authorized Mentors.',
            ])->onlyInput('email');
        }

        // 5. If credentials fail
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log the mentor out.
     */
   public function logout(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('mentor.login');
}
}
