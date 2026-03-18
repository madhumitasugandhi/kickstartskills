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

        if(Session::has('institution_id'))
        {
            return redirect('/institution/dashboard');
        }

        return view('frontend.institutionPortal.auth.institutelogin');
    }



    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $institution = Institution::where('email',$request->email)->first();

        if(!$institution || !Hash::check($request->password,$institution->password_hash))
        {
            return back()->with('error','Invalid email or password');
        }


        /*
        |-----------------------------------
        | SESSION LOGIN
        |-----------------------------------
        */

        Session::put('institution_id',$institution->institution_id);
        Session::put('institution_name',$institution->institution_name);


        /*
        |-----------------------------------
        | REMEMBER ME
        |-----------------------------------
        */

        if($request->remember)
        {

            $token = Str::random(60);

            $institution->remember_token = $token;
            $institution->save();

            Cookie::queue('institution_remember',$token,60*24*30);

        }

        return redirect('/institution/dashboard');

    }



    public function logout()
    {

        $token = Cookie::get('institution_remember');

        if($token)
        {
            Institution::where('remember_token',$token)
                ->update(['remember_token'=>null]);
        }

        Session::flush();

        Cookie::queue(Cookie::forget('institution_remember'));

        return redirect('/institution-login');

    }

}