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
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();

            // 3. Role Verification (Mentor role ID: 3)
            if ($user->admin_role_id == 3) {

                // 🔥 4. Account Status Check
                if ($user->account_status !== 'active') {
                    Auth::logout();

                    $status = ucfirst($user->account_status);
                    $message = "Your Mentor account is currently $status. Please reach out to the Admin.";

                    if ($user->account_status == 'suspended') {
                        $message = "Access Revoked: Your mentor profile has been suspended.";
                    }

                    return back()->withErrors(['email' => $message])->onlyInput('email');
                }

                $request->session()->regenerate();
                return redirect()->intended(route('mentor.dashboard'))
                    ->with('success', 'Welcome back to your Mentor Portal!');
            }

            // Not a mentor? logout
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
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('mentor.login');
    }

}
