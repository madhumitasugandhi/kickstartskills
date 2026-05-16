<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
{
    if (!$request->expectsJson()) {

        $path = $request->path();

        // first segment = role
        $role = explode('/', $path)[0];

        // check if valid role from config
        if (config("roles.$role")) {
            return route('login.dynamic', $role);
        }

        // fallback
        return '/';
    }
}
}
