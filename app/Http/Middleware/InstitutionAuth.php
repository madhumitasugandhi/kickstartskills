<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Institution\Institution;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class InstitutionAuth
{
    public function handle(Request $request, Closure $next): Response
    {

        $institutionId = session('institution_id');

        if (!$institutionId) {
            return redirect('/institution-login');
        }

        $institution = Institution::find($institutionId);

        if (!$institution) {
            session()->flush();
            return redirect('/institution-login');
        }

        // Share institution with ALL views
        View::share('institution', $institution);

        return $next($request);
    }
}