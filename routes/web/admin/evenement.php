<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\EvenementController as AdminEvenementController;

/*
|--------------------------------------------------------------------------
| Web Routes - Evenements
|--------------------------------------------------------------------------
*/

Route::prefix('evenement')
    ->middleware(['evenement.ressource.global','trackHistoryMiddleware'])
    ->group(function () {

        // Formulaire création
        Route::get('/register', [AdminEvenementController::class, 'register'])
            ->middleware('evenement.ressource.create')
            ->name('evenement.register');

        // Formulaire modification
        Route::get('/update/{id}', [AdminEvenementController::class, 'update_page'])
            ->middleware('evenement.ressource.update')
            ->name('evenement.update_page');

        // Liste
        Route::get('/list', [AdminEvenementController::class, 'list'])
            ->name('evenement.list');

        // Détails
        Route::get('/details/{id}', [AdminEvenementController::class, 'details'])
            ->name('evenement.details');

        // Enregistrement
        Route::post('/save', [AdminEvenementController::class, 'save'])
            ->middleware('evenement.ressource.create')
            ->name('evenement.save');

        // Mise à jour
        Route::put('/update/{id}', [AdminEvenementController::class, 'update'])
            ->middleware('evenement.ressource.update')
            ->name('evenement.update');

        // Suppression
        Route::delete('/delete-one/{id}', [AdminEvenementController::class, 'delete_one'])
            ->middleware('evenement.ressource.delete')
            ->name('evenement.delete_one');

});