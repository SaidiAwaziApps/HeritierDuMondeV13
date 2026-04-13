<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShareController;

/*
|--------------------------------------------------------------------------
| Web Routes - Share
|--------------------------------------------------------------------------
*/

Route::prefix('share')
    ->as('share.')
    ->middleware('blog.ressource.global')
    ->group(function() {
        Route::post('/save', [ShareController::class, 'save'])->name('save');
    });