<?php

namespace App\Http\Middleware\BesoinRessource;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BesoinRessourceUpdate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('authentication.login_page');
        }

        // Vérifie si l'utilisateur a accès à la ressource 'besoin' pour l'action 'update'
        if (!Auth::user()->hasAccessToRessource('besoin', 'update', 'allowed')) {
            abort(403);
        }

        return $next($request);
    }
}