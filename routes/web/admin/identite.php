<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IdentiteController;

/*
|--------------------------------------------------------------------------
| Web Routes - Identite
|--------------------------------------------------------------------------
*/

Route::prefix('identite')
    ->as('identite.') 
    ->middleware([\App\Http\Middleware\IsAdmin::class,\App\Http\Middleware\TrackHistoryMiddleware::class])
    ->group(function () {

        // Pages (Routes vers les pages)
        Route::get('/register', [IdentiteController::class, 'register'])
            ->name('register_page');

        Route::get('/update/{id}', [IdentiteController::class, 'update_page'])
            ->name('update_page');

        // Actions (Routes pour traitement)
        Route::post('/save', [IdentiteController::class, 'save'])
            ->name('save');

        Route::put('/update/{id}', [IdentiteController::class, 'update_handler'])
            ->name('update_handler');

});