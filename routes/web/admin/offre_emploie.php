<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\TrackHistoryMiddleware;
use App\Http\Middleware\OffreEmploieRessource\OffreEmploieRessourceGlobal;
use App\Http\Middleware\OffreEmploieRessource\OffreEmploieRessourceCreate;
use App\Http\Middleware\OffreEmploieRessource\OffreEmploieRessourceUpdate;
use App\Http\Middleware\OffreEmploieRessource\OffreEmploieRessourceDelete;

use App\Http\Controllers\Admin\OffreEmploieController as AdminOffreEmploieController;

/*
|--------------------------------------------------------------------------
| Web Routes - OffreEmploie
|--------------------------------------------------------------------------
*/

Route::prefix('offre-emploie')
    ->as('admin.offre_emploie.')
    ->middleware([OffreEmploieRessourceGlobal::class, TrackHistoryMiddleware::class])
    ->group(function() {

        Route::get('/register', [AdminOffreEmploieController::class, 'register_page'])
            ->middleware(OffreEmploieRessourceCreate::class)
            ->name('register_page');

        Route::get('/list', [AdminOffreEmploieController::class, 'list'])
            ->name('list');

        Route::get('/update/{id}', [AdminOffreEmploieController::class, 'update_page'])
            ->middleware(OffreEmploieRessourceUpdate::class)
            ->name('update_page');



        Route::post('/save', [AdminOffreEmploieController::class, 'save'])
            ->middleware(OffreEmploieRessourceCreate::class)
            ->name('save');

        Route::put('/update/{id}', [AdminOffreEmploieController::class, 'update_handler'])
            ->middleware(OffreEmploieRessourceUpdate::class)
            ->name('update_handler');

        Route::delete('/delete-one/{id}', [AdminOffreEmploieController::class, 'deleteOne'])
            ->middleware(OffreEmploieRessourceDelete::class)
            ->name('deleteOne');
});