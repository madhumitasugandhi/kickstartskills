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
        if (auth()->check()) {
            $user = auth()->user();

            // 1. Check if user is a Mentor (Role 3)
            if ($user->admin_role_id == 3) {

                // 🔥 2. Check Account Status
                if ($user->account_status !== 'active') {
                    auth()->logout();
                    return redirect()->route('mentor.login')->withErrors([
                        'email' => 'Your account status is no longer active. Contact Admin for details.'
                    ]);
                }

                return $next($request);
            }
        }

        // If they aren't a mentor, kick them to the login page
        return redirect()->route('mentor.login')->with('error', 'Unauthorized access.');
    }
}
