<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutoLoginMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
    
            $userId = session('admin_id') ?? $request->cookie('admin_permanent_login');
    
            if ($userId) {
                $user = \App\Models\User::find($userId);
    
                if ($user) {
                    auth()->login($user, true);
                    session(['admin_id' => $user->id]);
                }
            }
        }
    
        return $next($request);
    }
}
