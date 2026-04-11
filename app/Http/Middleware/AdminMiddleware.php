<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Agar Auth session khali hai, toh check karo Manual Session ya Cookie
        if (!Auth::check()) {
            $adminId = session('admin_id') ?? $request->cookie('admin_permanent_login');

            if ($adminId) {
                $user = \App\Models\User::find($adminId);
                if ($user && ($user->admin_role_id == 1 || $user->admin_role_id == 2)) {
                    Auth::login($user, true); // Wapas login karwa do
                    session(['admin_id' => $user->id]); // Session refresh
                }
            }
        }

        // 2. Final Guard Check
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->admin_role_id == 1 || $user->admin_role_id == 2) {
                return $next($request);
            }
        }

        return redirect()->route('admin.login');
    }
}
