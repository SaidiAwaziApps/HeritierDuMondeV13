<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;

/*
|--------------------------------------------------------------------------
| Web Routes - Catégories
|--------------------------------------------------------------------------
*/

Route::prefix('categorie')
    ->middleware(['categorie.ressource.global','trackHistoryMiddleware'])
    ->group(function() {

        // Enregistrement d'une catégorie
        Route::post('/register', [CategorieController::class, 'save'])
            ->name('categorie.save');

        // Ici tu peux ajouter d'autres routes : list, update, delete, details, etc.
});