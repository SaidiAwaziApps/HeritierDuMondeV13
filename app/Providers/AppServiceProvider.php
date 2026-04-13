<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Commentaire;
use App\Models\Identite;
use App\Observers\CommentaireObserver;
use App\Observers\IdentityObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Ici tu peux binder des services si nécessaire
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Commentaire::observe(CommentaireObserver::class);
        Identite::observe(IdentityObserver::class);
    }
}