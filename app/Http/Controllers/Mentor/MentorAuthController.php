<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\AuthController;
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

     // Login Logic
     public function login(Request $request)
     {
         return app(AuthController::class)
             ->login($request, 3); // mentor role
     }
     

}
