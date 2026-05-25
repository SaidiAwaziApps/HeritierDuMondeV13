<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrackHistoryMiddleware
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
        // Récupère l’historique actuel ou tableau vide
        $history = session()->get('history', []);

        // Ajoute la nouvelle page visitée au début
        array_push($history, [
            'url' => url()->current(),
            'method' => $request->method(),
            'visited_at' => now()->toDateTimeString(),
        ]);

        // Conserve uniquement les 10 dernières URLs
        // $history = array_slice($history, 0, 10);

        // Met à jour la session
        session()->put('history', $history);

        return $next($request);
    }
}