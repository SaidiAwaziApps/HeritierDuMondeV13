<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\TrackHistoryMiddleware;
use App\Http\Middleware\IsAuthenticate;

use App\Http\Controllers\Admin\HomeController as AdminHomeController;


/*
|--------------------------------------------------------------------------
| Web Routes - Home
|--------------------------------------------------------------------------
*/

Route::prefix('admin/home')
    ->middleware([IsAuthenticate::class, TrackHistoryMiddleware::class])
    ->group(function () {

        Route::get('/admin', [AdminHomeController::class, 'admin'])
            ->name('admin.home.admin');

});