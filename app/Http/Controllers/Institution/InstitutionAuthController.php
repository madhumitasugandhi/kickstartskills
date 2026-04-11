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



    // AdminAuthController.php
    public function login(Request $request)
    {
        // 1. Check user manually
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // 2. Manual Session
            Session::put('admin_id', $user->id);

            // 3. Manual Remember Me (Exactly like Institution)
            if ($request->remember) {
                $token = Str::random(60);
                $user->update(['remember_token' => $token]);
                Cookie::queue('admin_remember', $token, 525600); // 1 saal
            }
            return redirect('/admin/dashboard');
        }
    }



    public function logout()
    {

        $token = Cookie::get('institution_remember');

        if ($token) {
            Institution::where('remember_token', $token)
                ->update(['remember_token' => null]);
        }

        Session::flush();

        Cookie::queue(Cookie::forget('institution_remember'));

        return redirect('/institution-login');

    }

}
