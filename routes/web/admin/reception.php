<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceptionController;

use \App\Http\Middleware\DonRessourceRecept;

/*
|--------------------------------------------------------------------------
| Web Routes - Reception
|--------------------------------------------------------------------------
*/

Route::prefix('admin/reception')
    ->as('admin.reception.')
    ->middleware(DonRessourceRecept::class)
    ->group(function() {
        Route::post('/save', [ReceptionController::class, 'save'])->name('save');
    });