<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes - Home
|--------------------------------------------------------------------------
*/

Route::prefix('admin/home')
    ->middleware(['isAuthenticate','trackHistoryMiddleware'])
    ->group(function () {

        Route::get('/admin', [HomeController::class, 'admin'])
            ->name('home.admin');

});