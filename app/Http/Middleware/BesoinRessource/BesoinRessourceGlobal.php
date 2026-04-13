<?php

namespace App\Http\Middleware\BesoinRessource;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BesoinRessourceGlobal
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (
                Auth::user()->hasAccessToRessource('besoin', 'register', 'allowed') ||
                Auth::user()->hasAccessToRessource('besoin', 'update', 'allowed') ||
                Auth::user()->hasAccessToRessource('besoin', 'delete', 'allowed')
            ) {
                return $next($request);
            } else {
                abort(403);
            }
        } else {
            return redirect()->route('authentication.login_page');
        }
    }
}