<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RegulationController;

/*
|--------------------------------------------------------------------------
| Web Routes - Regulation
|--------------------------------------------------------------------------
*/

Route::prefix('regulation')
    ->as('regulation.')
    ->middleware([\App\Http\Middleware\IsAdmin::class, \App\Http\Middleware\TrackHistoryMiddleware::class])
    ->group(function() {
        Route::get('/register', [RegulationController::class, 'register_page'])->name('register_page');
        Route::get('/update/{id}', [RegulationController::class, 'update_page'])->name('update_page');
        Route::post('/save', [RegulationController::class, 'save'])->name('save');
        Route::put('/update/{id}', [RegulationController::class, 'update_handler'])->name('update_handler');
    });