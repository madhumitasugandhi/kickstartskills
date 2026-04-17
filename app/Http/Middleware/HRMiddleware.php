<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class HRMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // 1. Check Role
            if ($user->admin_role_id == 2) {

                // 🔥 2. Check Account Status
                if ($user->account_status !== 'active') {
                    Auth::logout();
                    return redirect()->route('hr.login')->withErrors([
                        'email' => 'Your account status is no longer active. Please login again or contact Admin.'
                    ]);
                }

                return $next($request);
            }
        }

        return redirect()->route('hr.login')->with('error', 'Unauthorized access! Please login as HR.');
    }
}
