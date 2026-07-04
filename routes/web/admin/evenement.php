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

Route::prefix('admin/evenement')
    ->as('admin.evenement.')
    ->middleware(EvenementRessourceGlobal::class)
    ->group(function () {

        // Page enregistrement
        Route::get('/register', [AdminEvenementController::class, 'register_page'])
            ->middleware([EvenementRessourceCreate::class, TrackHistoryMiddleware::class])
            ->name('register_page');

        // Page modification
        Route::get('/update/{id}', [AdminEvenementController::class, 'update_page'])
            ->middleware([EvenementRessourceUpdate::class, TrackHistoryMiddleware::class])
            ->name('update_page');

        // Page liste
        Route::get('/list', [AdminEvenementController::class, 'list'])
             ->middleware(TrackHistoryMiddleware::class)
             ->name('list');

        // Page détails
        Route::get('/details/{id}', [AdminEvenementController::class, 'details'])
             ->middleware(TrackHistoryMiddleware::class)
             ->name('details');


        // Traitement Enregistrement (sauvegarde)
        Route::post('/save', [AdminEvenementController::class, 'save'])
            ->middleware(EvenementRessourceCreate::class)
            ->name('save');

        // Mise à jour (update)
        Route::put('/update/{id}', [AdminEvenementController::class, 'update_handler'])
            ->middleware(EvenementRessourceUpdate::class)
            ->name('update_handler');

        // Suppression
        Route::delete('/delete-one/{id}', [AdminEvenementController::class, 'delete_one'])
            ->middleware(EvenementRessourceDelete::class)
            ->name('delete_one');
});