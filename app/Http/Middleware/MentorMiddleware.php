<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MentorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->admin_role_id == 3) {
            return $next($request);
        }

        // If they aren't a mentor, kick them to the login page
        return redirect()->route('mentor.login')->with('error', 'Unauthorized access.');
    }
}
