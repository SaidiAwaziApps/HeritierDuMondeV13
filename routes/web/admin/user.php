<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::middleware(['isAdmin','trackHistoryMiddleware'])
    ->prefix('user')
    ->as('user.')
    ->group(function() {

        Route::get('/register', [UserController::class, 'register'])->name('register');
        Route::get('/list', [UserController::class, 'list'])->name('list');
        Route::get('/details/{id}', [UserController::class, 'details'])->name('details');
        Route::get('/update/{id}', [UserController::class, 'update_page'])->name('update_page');

        // Cette route nécessite un middleware supplémentaire
        Route::get('/my-profil', [UserController::class, 'my_profil'])
            ->middleware('isHighAdmin')
            ->name('my_profil');

        Route::post('/save', [UserController::class, 'save'])->name('save');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/delete-one/{id}', [UserController::class, 'delete_one'])->name('delete_one');
    });