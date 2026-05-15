<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstitutionSetupMiddleware
{
    public function handle($request, Closure $next)
{
    $user = auth()->user();
    $institution = $user->institution;

    if (!$institution) {
        return redirect('/institution-login');
    }

    $isSetupRoute = $request->is('institution/core-management/setup');

    if ($institution->setup_status !== 'completed' && !$isSetupRoute) {
        return redirect('/institution/core-management/setup');
    }

    if ($institution->setup_status === 'completed' && $isSetupRoute) {
        return redirect('/institution/dashboard');
    }

    return $next($request);
}
}
