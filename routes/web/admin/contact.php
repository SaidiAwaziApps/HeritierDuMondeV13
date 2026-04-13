<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes - Contacts
|--------------------------------------------------------------------------
*/

Route::prefix('contact')
    ->middleware(['contact.ressource.admin','trackHistoryMiddleware'])
    ->group(function () {
        // Page d'index des contacts
        Route::get('/index', [ContactController::class, 'index'])
            ->name('contact.index');
    });