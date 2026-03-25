<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Controller wala same logic yahan bhi lagao
            if ($user->admin_role_id == User::ROLE_SUPER_ADMIN || $user->admin_role_id == User::ROLE_ADMIN_STAFF) {
                return $next($request);
            }

            // Agar admin role nahi hai toh logout karwa do
            Auth::logout();
            return redirect()->route('admin.login')->withErrors(['email' => 'Unauthorized access.']);
        }

        return redirect()->route('admin.login');
    }
}
