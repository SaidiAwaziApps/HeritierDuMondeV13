<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Global HTTP middleware.
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * Route middleware groups.
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Route middleware.
     */
    protected $routeMiddleware = [
        // Auth
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,

        // Custom middlewares
        'isAuthenticate' => \App\Http\Middleware\IsAuthenticate::class,
        'trackHistoryMiddleware' => \App\Http\Middleware\TrackHistoryMiddleware::class,
        'isAdmin' => \App\Http\Middleware\IsAdmin::class,
        'isHighAdmin' => \App\Http\Middleware\IsHighAdmin::class,
        'dashboard.admin' => \App\Http\Middleware\Dashboard\DashboardAdminRessource::class,

        // Blog
        'blog.ressource.global' => \App\Http\Middleware\BlogRessource\BlogRessourceGlobal::class,
        'blog.ressource.create' => \App\Http\Middleware\BlogRessource\BlogRessourceCreate::class,
        'blog.ressource.update' => \App\Http\Middleware\BlogRessource\BlogRessourceUpdate::class,
        'blog.ressource.delete' => \App\Http\Middleware\BlogRessource\BlogRessourceDelete::class,

        // Benevole
        'benevole.ressource.global' => \App\Http\Middleware\BenevoleRessource\BenevoleRessourceGlobal::class,

        // Besoin
        'besoin.ressource.global' => \App\Http\Middleware\BesoinRessource\BesoinRessourceGlobal::class,
        'besoin.ressource.create' => \App\Http\Middleware\BesoinRessource\BesoinRessourceCreate::class,
        'besoin.ressource.update' => \App\Http\Middleware\BesoinRessource\BesoinRessourceUpdate::class,
        'besoin.ressource.delete' => \App\Http\Middleware\BesoinRessource\BesoinRessourceDelete::class,

        // Donateur
        'donateur.ressource.global' => \App\Http\Middleware\DonateurRessource\DonateurRessourceGlobal::class,

        // Don
        'don.ressource.global' => \App\Http\Middleware\DonRessource\DonRessourceGlobal::class,
        'don.ressource.recept' => \App\Http\Middleware\DonRessource\DonRessourceRecept::class,

        // Offre Emploie
        'offre_emploie.ressource.global' => \App\Http\Middleware\OffreEmploieRessource\OffreEmploieRessourceGlobal::class,
        'offre_emploie.ressource.create' => \App\Http\Middleware\OffreEmploieRessource\OffreEmploieRessourceCreate::class,
        'offre_emploie.ressource.update' => \App\Http\Middleware\OffreEmploieRessource\OffreEmploieRessourceUpdate::class,
        'offre_emploie.ressource.delete' => \App\Http\Middleware\OffreEmploieRessource\OffreEmploieRessourceDelete::class,

        // Evenement
        'evenement.ressource.global' => \App\Http\Middleware\EvenementRessource\EvenementRessourceGlobal::class,
        'evenement.ressource.create' => \App\Http\Middleware\EvenementRessource\EvenementRessourceCreate::class,
        'evenement.ressource.update' => \App\Http\Middleware\EvenementRessource\EvenementRessourceUpdate::class,
        'evenement.ressource.delete' => \App\Http\Middleware\EvenementRessource\EvenementRessourceDelete::class,

        // Contact
        'contact.ressource.admin' => \App\Http\Middleware\ContactRessource\ContactAdminRessource::class,
    ];
}