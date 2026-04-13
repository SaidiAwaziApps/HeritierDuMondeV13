<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IdentiteController;

/*
|--------------------------------------------------------------------------
| Web Routes - Identite
|--------------------------------------------------------------------------
*/

Route::prefix('identite')
    ->middleware(['isAdmin','trackHistoryMiddleware'])
    ->group(function () {

        // Pages
        Route::get('/register', [IdentiteController::class, 'register'])
            ->name('identite.register');

        Route::get('/update/{id}', [IdentiteController::class, 'update_page'])
            ->name('identite.update_page');

        Route::get('/questionnement', [IdentiteController::class, 'questionnement'])
            ->name('identite.questionnement');

        // Actions
        Route::post('/save', [IdentiteController::class, 'save'])
            ->name('identite.save');

        Route::put('/update/{id}', [IdentiteController::class, 'update'])
            ->name('identite.update');

});