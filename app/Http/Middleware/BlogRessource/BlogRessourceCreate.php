<?php

namespace App\Http\Middleware\BlogRessource;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BlogRessourceCreate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->hasAccessToRessource('blog', 'register', 'allowed')) {
                return $next($request);
            } else {
                abort(403);
            }
        } else {
            return redirect()->route('authentication.login_page');
        }
    }
}