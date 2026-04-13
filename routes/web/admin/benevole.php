<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BenevoleController as AdminBenevoleController;
use App\Models\Benevole;
use App\Models\Sociaux;

/*
|--------------------------------------------------------------------------
| Web Routes - Bénévoles
|--------------------------------------------------------------------------
*/

Route::prefix('benevole')
    ->middleware(['benevole.ressource.global','trackHistoryMiddleware'])
    ->group(function() {

        // Liste des bénévoles
        Route::get('/list', [AdminBenevoleController::class, 'list'])->name('benevole.list');

        // Détails d’un bénévole
        Route::get('/details/{id}', [AdminBenevoleController::class, 'details'])->name('benevole.details');

        // Génération de données bénévoles (exemple désactivé)
        Route::get('/generate', function() {
            // Code de génération de données, actuellement commenté
            return "Génération désactivée";
        })->name('benevole.generate');

});