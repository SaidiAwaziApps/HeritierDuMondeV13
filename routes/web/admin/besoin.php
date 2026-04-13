<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BesoinController;

/*
|--------------------------------------------------------------------------
| Web Routes - Besoins
|--------------------------------------------------------------------------
*/

Route::prefix('besoin')
    ->middleware(['besoin.ressource.global','trackHistoryMiddleware'])
    ->group(function() {

        // Page d'enregistrement
        Route::get('/register', [BesoinController::class, 'register'])
            ->middleware('besoin.ressource.create')
            ->name('besoin.register');

        // Liste des besoins
        Route::get('/list', [BesoinController::class, 'list'])->name('besoin.list');

        // Détails d'un besoin
        Route::get('/details/{id}', [BesoinController::class, 'details'])->name('besoin.details');

        // Page de mise à jour
        Route::get('/update/{id}', [BesoinController::class, 'update_page'])
            ->middleware('besoin.ressource.update')
            ->name('besoin.update_page');

        // Enregistrement
        Route::post('/save', [BesoinController::class, 'save'])
            ->middleware('besoin.ressource.create')
            ->name('besoin.save');

        // Mise à jour
        Route::put('/update/{id}', [BesoinController::class, 'update'])
            ->middleware('besoin.ressource.update')
            ->name('besoin.update');

        // Suppression
        Route::delete('/delete-one/{id}', [BesoinController::class, 'delete_one'])
            ->middleware('besoin.ressource.delete')
            ->name('besoin.delete_one');
});