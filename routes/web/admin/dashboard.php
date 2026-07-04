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

Route::prefix('admin/')
    ->middleware([IsAdmin::class, TrackHistoryMiddleware::class])
    ->group(function () {
        Route::get('dashboard/admin', [AdminDashboardController::class, 'admin'])
            ->middleware(TerminalGeolocateMiddleware::class)
            ->name('admin.dashboard.admin');

        Route::get('dashboard/user', [AdminDashboardController::class, 'user'])
            ->name('admin.dashboard.user');
    });