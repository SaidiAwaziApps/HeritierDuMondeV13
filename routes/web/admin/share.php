<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Global\ShareController;

/*
|--------------------------------------------------------------------------
| Web Routes - Share
|--------------------------------------------------------------------------
*/

Route::prefix('share')
    ->as('share.')
    ->group(function() {
        Route::post('/save', [AdminShareController::class, 'save'])->name('save');
    });