<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegulationController;

/*
|--------------------------------------------------------------------------
| Web Routes - Regulation
|--------------------------------------------------------------------------
*/

Route::prefix('regulation')
    ->as('regulation.')
    ->middleware(['isAdmin','trackHistoryMiddleware'])
    ->group(function() {
        Route::get('/register', [RegulationController::class, 'register'])->name('register');
        Route::get('/update/{id}', [RegulationController::class, 'update_page'])->name('update_page');
        Route::post('/save', [RegulationController::class, 'save'])->name('save');
        Route::put('/update/{id}', [RegulationController::class, 'update'])->name('update');
    });