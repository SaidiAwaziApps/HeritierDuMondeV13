<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\IsAdmin;
use \App\Http\Middleware\TrackHistoryMiddleware;

use App\Http\Controllers\Admin\RegulationController;

/*
|--------------------------------------------------------------------------
| Web Routes - Regulation
|--------------------------------------------------------------------------
*/

Route::prefix('admin/regulation')
    ->as('admin.regulation.')
    ->middleware(IsAdmin::class)
    ->group(function() {

        Route::get('/register', [RegulationController::class, 'register_page'])
             ->middleware(TrackHistoryMiddleware::class)
             ->name('register_page');

        Route::get('/update/{id}', [RegulationController::class, 'update_page'])
             ->middleware(TrackHistoryMiddleware::class)
             ->name('update_page');

        Route::post('/save', [RegulationController::class, 'save'])->name('save');
        
        Route::put('/update/{id}', [RegulationController::class, 'update_handler'])->name('update_handler');
    });