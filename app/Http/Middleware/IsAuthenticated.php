<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('utilisateur')) {
            return redirect('/login')->with('status', 'Vous devez être connecté pour accéder à cette page.');
        }

        return $next($request);
    }
}
