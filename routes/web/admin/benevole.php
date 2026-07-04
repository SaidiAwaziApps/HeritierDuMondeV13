<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\TrackHistoryMiddleware;
use App\Http\Middleware\BenevoleRessource\BenevoleRessourceGlobal;

use App\Http\Controllers\Admin\BenevoleController as AdminBenevoleController;

use App\Models\Benevole;
use App\Models\Sociaux;

/*
|--------------------------------------------------------------------------
| Web Routes - Bénévoles
|--------------------------------------------------------------------------
*/

Route::prefix('admin/benevole')
    ->as('admin.benevole.')
    ->middleware([BenevoleRessourceGlobal::class, BenevoleRessourceGlobal::class])
    ->group(function() {

        // Liste des bénévoles
        Route::get('/list', [AdminBenevoleController::class, 'list'])
            ->middleware(TrackHistoryMiddleware::class)
            ->name('list');

        // Détails d’un bénévole
        Route::get('/details/{id}', [AdminBenevoleController::class, 'details'])
             ->middleware(TrackHistoryMiddleware::class)
             ->name('details');

        // Génération de données bénévoles (exemple désactivé)
        Route::get('/generate', function() {
            // Code de génération de données, actuellement commenté
            return "Génération désactivée";
        })->name('benevole.generate');

});