<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\TrackHistoryMiddleware;
use App\Http\Middleware\DonateurRessource\DonateurRessourceGlobal;

use App\Http\Controllers\Admin\DonateurController as AdminDonateurController;

/*
|--------------------------------------------------------------------------
| Web Routes - Donateurs
|--------------------------------------------------------------------------
*/

Route::prefix('admin/donateur')
    ->as('admin.donateur.')
    ->middleware([DonateurRessourceGlobal::class, TrackHistoryMiddleware::class])
    ->group(function () {

        // Liste des donateurs
        Route::get('/list', [AdminDonateurController::class, 'list'])
            ->name('list');

        // Détails d’un donateur
        Route::get('/details/{id}', [AdminDonateurController::class, 'details'])
            ->name('details');

});