<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes - Dashboard
|--------------------------------------------------------------------------
*/

Route::prefix('dashboard')
    ->middleware([\App\Http\Middleware\IsAdmin::class,\App\Http\Middleware\TrackHistoryMiddleware::class])
    ->group(function () {
        Route::get('/admin', [AdminDashboardController::class, 'admin'])
            ->name('dashboard.admin');

        Route::get('/user', [AdminDashboardController::class, 'user'])
            ->name('dashboard.user');
    });