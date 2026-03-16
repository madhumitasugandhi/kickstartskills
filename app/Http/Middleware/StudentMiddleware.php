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
        // Check if user is logged in and is a Student (Role 5)
        if (auth()->check() && auth()->user()->admin_role_id == 5) {
            return $next($request);
        }

        // If they aren't a student, kick them to the login page
        return redirect()->route('student.login')->with('error', 'Unauthorized access to Student Portal.');
    }
}
