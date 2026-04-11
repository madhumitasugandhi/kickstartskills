<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

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

        // 🔥 Correct Model (Institution)
        $institution = Institution::where('email', $request->email)->first();

        // 🔥 Check password (password_hash column)
        if ($institution && Hash::check($request->password, $institution->password_hash)) {

            // Session set
            Session::put('institution_id', $institution->institution_id);

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

        // ❌ Login failed
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
}