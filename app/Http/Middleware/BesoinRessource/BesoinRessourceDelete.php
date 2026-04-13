<?php

namespace App\Http\Middleware\BesoinRessource;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BesoinRessourceDelete
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure(Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('authentication.login_page');
        }

        // Vérifie si l'utilisateur a accès à la ressource 'besoin' avec action 'delete' et mention 'allowed'
        if (!Auth::user()->hasAccessToRessource('besoin', 'delete', 'allowed')) {
            abort(403);
        }

        return $next($request);
    }
}