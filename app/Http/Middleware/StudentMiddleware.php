<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Check if user is logged in
        if (auth()->check()) {
            $user = auth()->user();

            // 1. Check if user is a Student (Role 5)
            if ($user->admin_role_id == 5) {

                // 🔥 2. Check Account Status
                if ($user->account_status !== 'active') {
                    auth()->logout(); // Turant logout karo

                    $status = ucfirst($user->account_status);
                    return redirect()->route('student.login')->withErrors([
                        'email' => "Your session was terminated because your account is $status."
                    ]);
                }

                return $next($request);
            }
        }

        // If they aren't a student, kick them to the login page
        return redirect()->route('student.login')->with('error', 'Unauthorized access to Student Portal.');
    }
}
