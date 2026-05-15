<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthController;

class InstitutionAuthController extends Controller
{

    public function showLogin(Request $request)
    {
        if (auth()->check() && auth()->user()->admin_role_id == 4) {
            return redirect('/institution/dashboard');
        }
    
        return view('frontend.institutionPortal.auth.institutelogin');
    }
    
    public function login(Request $request)
    {
        return app(AuthController::class)
            ->login($request, 4);
    }
    
    public function logout(Request $request)
    {
        auth()->logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/institution-login');
    }


}