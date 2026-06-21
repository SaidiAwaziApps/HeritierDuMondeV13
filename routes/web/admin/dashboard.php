<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\TrackHistoryMiddleware;
use App\Http\Middleware\TerminalGeolocateMiddleware;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes - Dashboard
|--------------------------------------------------------------------------
*/

Route::prefix('dashboard')
    ->middleware([IsAdmin::class, TrackHistoryMiddleware::class])
    ->group(function () {
        Route::get('/admin', [AdminDashboardController::class, 'admin'])
            ->middleware(TerminalGeolocateMiddleware::class)
            ->name('admin.dashboard.admin');

        Route::get('/user', [AdminDashboardController::class, 'user'])
            ->name('admin.dashboard.user');
    });