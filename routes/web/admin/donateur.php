<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonateurController;

/*
|--------------------------------------------------------------------------
| Web Routes - Donateurs
|--------------------------------------------------------------------------
*/

Route::prefix('donateur')
    ->middleware(['donateur.ressource.global','trackHistoryMiddleware'])
    ->group(function () {

        // Liste des donateurs
        Route::get('/list', [DonateurController::class, 'list'])
            ->name('donateur.list');

        // Détails d’un donateur
        Route::get('/details/{id}', [DonateurController::class, 'details'])
            ->name('donateur.details');

});