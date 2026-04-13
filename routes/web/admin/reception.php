<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceptionController;

/*
|--------------------------------------------------------------------------
| Web Routes - Reception
|--------------------------------------------------------------------------
*/

Route::prefix('reception')
    ->as('reception.')
    ->middleware(['don.ressource.recept'])
    ->group(function() {
        Route::post('/save', [ReceptionController::class, 'save'])->name('save');
    });