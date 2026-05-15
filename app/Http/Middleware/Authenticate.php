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

        // STUDENT
        if (str_starts_with($path, 'student')) {
            return route('student.login');
        }

        // ADMIN
        if (str_starts_with($path, 'admin')) {
            return route('admin.login');
        }

        // MENTOR
        if (str_starts_with($path, 'mentor')) {
            return route('mentor.login');
        }

        // HR
        if (str_starts_with($path, 'hr')) {
            return route('hr.login');
        }

        // INSTITUTION
        if (str_starts_with($path, 'institution')) {
            return route('institution.login');
        }

        // fallback
        return '/';
    }
}
}
