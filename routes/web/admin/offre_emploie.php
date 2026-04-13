<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OffreEmploieController as AdminOffreEmploieController;

/*
|--------------------------------------------------------------------------
| Web Routes - OffreEmploie
|--------------------------------------------------------------------------
*/

Route::prefix('offre-emploie')
    ->as('offre_emploie.')
    ->middleware(['offre_emploie.ressource.global','trackHistoryMiddleware'])
    ->group(function() {

        Route::get('/register', [AdminOffreEmploieController::class, 'register'])
            ->middleware('offre_emploie.ressource.create')
            ->name('register');

        Route::get('/list', [AdminOffreEmploieController::class, 'list'])
            ->name('list');

        Route::get('/update/{id}', [AdminOffreEmploieController::class, 'update_page'])
            ->middleware('offre_emploie.ressource.update')
            ->name('update_page');

        Route::post('/save', [AdminOffreEmploieController::class, 'save'])
            ->middleware('offre_emploie.ressource.create')
            ->name('save');

        Route::put('/update/{id}', [AdminOffreEmploieController::class, 'update'])
            ->middleware('offre_emploie.ressource.update')
            ->name('update');

        Route::delete('/delete-one/{id}', [AdminOffreEmploieController::class, 'deleteOne'])
            ->middleware('offre_emploie.ressource.delete')
            ->name('deleteOne');
});