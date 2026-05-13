<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\TrackHistoryMiddleware;
use App\Http\Middleware\ContactRessource\ContactAdminRessource;

use App\Http\Controllers\Admin\ContactController as AdminContactController;

/*
|--------------------------------------------------------------------------
| Web Routes - Contacts
|--------------------------------------------------------------------------
*/

Route::prefix('contact')
    ->as('admin.contact.')
    ->middleware([ContactAdminRessource::class, TrackHistoryMiddleware::class])
    ->group(function () {
        // Page d'index des contacts
        Route::get('/index', [AdminContactController::class, 'index'])
            ->name('index');
    });