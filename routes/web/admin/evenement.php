<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\TrackHistoryMiddleware;
use App\Http\Middleware\EvenementRessource\EvenementRessourceGlobal;
use App\Http\Middleware\EvenementRessource\EvenementRessourceCreate;
use App\Http\Middleware\EvenementRessource\EvenementRessourceUpdate;
use App\Http\Middleware\EvenementRessource\EvenementRessourceDelete;

use App\Http\Controllers\Admin\EvenementController as AdminEvenementController;

/*
|--------------------------------------------------------------------------
| Web Routes - Evenements
|--------------------------------------------------------------------------
*/

Route::prefix('evenement')
    ->as('admin.evenement.')
    ->middleware([EvenementRessourceGlobal::class])
    ->group(function () {

        // Formulaire création
        Route::get('/register', [AdminEvenementController::class, 'register_page'])
            ->middleware([EvenementRessourceCreate::class, TrackHistoryMiddleware::class])
            ->name('register_page');

        // Formulaire modification
        Route::get('/update/{id}', [AdminEvenementController::class, 'update_page'])
            ->middleware([EvenementRessourceUpdate::class, TrackHistoryMiddleware::class])
            ->name('update_page');

        // Liste
        Route::get('/list', [AdminEvenementController::class, 'list'])
             ->middleware(TrackHistoryMiddleware::class)
             ->name('list');

        // Détails
        Route::get('/details/{id}', [AdminEvenementController::class, 'details'])
             ->middleware(TrackHistoryMiddleware::class)
             ->name('details');


        // Enregistrement
        Route::post('/save', [AdminEvenementController::class, 'save'])
            ->middleware(EvenementRessourceCreate::class)
            ->name('save');

        // Mise à jour
        Route::put('/update/{id}', [AdminEvenementController::class, 'update_handler'])
            ->middleware(EvenementRessourceUpdate::class)
            ->name('update_handler');

        // Suppression
        Route::delete('/delete-one/{id}', [AdminEvenementController::class, 'delete_one'])
            ->middleware(EvenementRessourceDelete::class)
            ->name('delete_one');
});