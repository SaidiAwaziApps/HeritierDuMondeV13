<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategorieController;

/*
|--------------------------------------------------------------------------
| Web Routes - Catégories
|--------------------------------------------------------------------------
*/

Route::prefix('admin/categorie')
    ->as('categorie.')
    ->middleware([\App\Http\Middleware\IsAuthenticate::class])
    ->group(function() {

        // Enregistrement d'une catégorie
        Route::post('/register', [CategorieController::class, 'save'])
            ->name('save');

        // Ici tu peux ajouter d'autres routes : list, update, delete, details, etc.
});