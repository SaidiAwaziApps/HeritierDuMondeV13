<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\TrackHistoryMiddleware;
use App\Http\Middleware\TerminalGeolocateMiddleware;

use App\Http\Middleware\BesoinRessource\BesoinRessourceGlobal;
use App\Http\Middleware\BesoinRessource\BesoinRessourceCreate;
use App\Http\Middleware\BesoinRessource\BesoinRessourceUpdate;
use App\Http\Middleware\BesoinRessource\BesoinRessourceDelete;

use App\Http\Controllers\Admin\BesoinController as AdminBesoinController;

/*
|--------------------------------------------------------------------------
| Web Routes - Besoins
|--------------------------------------------------------------------------
*/

Route::prefix('besoin')
    ->as('admin.besoin.')
    ->middleware(BesoinRessourceGlobal::class)
    ->group(function() {

        // Page d'enregistrement
        Route::get('/register', [AdminBesoinController::class, 'register_page'])
            ->middleware([BesoinRessourceCreate::class, TrackHistoryMiddleware::class, TerminalGeolocateMiddleware::class])
            ->name('register_page');

        // Liste des besoins
        Route::get('/list', [AdminBesoinController::class, 'list'])
             ->middleware([TrackHistoryMiddleware::class, TerminalGeolocateMiddleware::class])
             ->name('list');

        // Détails d'un besoin
        Route::get('/details/{id}', [AdminBesoinController::class, 'details'])
                ->middleware([TrackHistoryMiddleware::class, TerminalGeolocateMiddleware::class])
                ->name('details');

        // Page de mise à jour
        Route::get('/update/{id}', [AdminBesoinController::class, 'update_page'])
            ->middleware([BesoinRessourceUpdate::class, TrackHistoryMiddleware::class, TerminalGeolocateMiddleware::class])
            ->name('update_page');

        // Enregistrement
        Route::post('/save', [AdminBesoinController::class, 'save'])
            ->middleware(BesoinRessourceCreate::class)
            ->name('save');

        // Mise à jour
        Route::put('/update/{id}', [AdminBesoinController::class, 'update_handler'])
            ->middleware(BesoinRessourceUpdate::class)
            ->name('update_handler');

        // Suppression
        Route::delete('/delete-one/{id}', [AdminBesoinController::class, 'delete_one'])
            ->middleware(BesoinRessourceDelete::class)
            ->name('delete_one');
});