<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;

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

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if ($user->admin_role_id == 1 || $user->admin_role_id == 2) {

                // --- INSTITUTION STYLE MANUAL SESSION ---
                session(['admin_id' => $user->id]);

                // --- PERMANENT COOKIE (1 Year) ---
                if ($remember) {
                    Cookie::queue('admin_permanent_login', $user->id, 525600);
                }

                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }

            Auth::logout();
            return back()->withErrors(['email' => 'Unauthorized access.']);
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Cookie::queue(Cookie::forget('admin_permanent_login')); // Chabi fenk do
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/admin-login');
    }

}
