<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = session('utilisateur');

        if (!$user || $user->isadmin != 1) {
            return redirect('/')->with('error', 'Accès refusé. Cette zone est réservée aux administrateurs.');
        }

        return $next($request);
    }
}
