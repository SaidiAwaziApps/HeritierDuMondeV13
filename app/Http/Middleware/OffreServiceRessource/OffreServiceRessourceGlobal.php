<?php

namespace App\Http\Middleware\OffreServiceRessource;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class OffreServiceRessourceGlobal
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (
                Auth::user()->hasAccessToRessource('offre_service', 'register', 'allowed') ||
                Auth::user()->hasAccessToRessource('offre_service', 'update', 'allowed') ||
                Auth::user()->hasAccessToRessource('offre_service', 'delete', 'allowed')
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
