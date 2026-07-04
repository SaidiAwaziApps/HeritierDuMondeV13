<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\TrackHistoryMiddleware;
use App\Http\Middleware\IsAdmin;

use App\Http\Controllers\Admin\IdentiteController;

/*
|--------------------------------------------------------------------------
| Web Routes - Identite
|--------------------------------------------------------------------------
*/

Route::prefix('admin/identite')
    ->as('admin.identite.') 
    ->middleware(IsAdmin::class)
    ->group(function () {

        // Pages (Routes vers les pages)
        Route::get('/register', [IdentiteController::class, 'register'])
            ->middleware(TrackHistoryMiddleware::class)
            ->name('register_page');

        Route::get('/update/{id}', [IdentiteController::class, 'update_page'])
            ->middleware(TrackHistoryMiddleware::class) 
            ->name('update_page');

        // Actions (Routes pour traitement)
        Route::post('/save', [IdentiteController::class, 'save'])
            ->name('save');

        Route::put('/update/{id}', [IdentiteController::class, 'update_handler'])
            ->name('update_handler');

});