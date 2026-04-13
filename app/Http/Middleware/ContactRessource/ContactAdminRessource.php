<?php

namespace App\Http\Middleware\ContactRessource;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ContactAdminRessource
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (
                Auth::user()->hasAccessToRessource('contact', 'register', 'allowed') ||
                Auth::user()->hasAccessToRessource('contact', 'update', 'allowed') ||
                Auth::user()->hasAccessToRessource('contact', 'delete', 'allowed') ||
                Auth::user()->hasAccessToRessource('contact', 'authorized', 'allowed')
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