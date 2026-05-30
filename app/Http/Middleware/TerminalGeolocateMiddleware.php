<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Jobs\TerminalGeolocateJob;

class TerminalGeolocateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Appel au Jon TerminalGeolocateJob (Geolocalisation terminal (appareil))
        TerminalGeolocateJob::dispatch($request->ip());

        return $next($request);
    }
}
