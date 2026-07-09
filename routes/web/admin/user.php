<?php
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\TrackHistoryMiddleware;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;


Route::middleware(IsAdmin::class)
    ->prefix('admin/user')
    ->as('admin.user.')
    ->group(function() {

        Route::get('/register', [UserController::class, 'register_page'])->middleware(TrackHistoryMiddleware::class)->name('register_page');
        Route::get('/list', [UserController::class, 'list'])->middleware(TrackHistoryMiddleware::class)->name('list');
        Route::get('/details/{id}', [UserController::class, 'details'])->middleware(TrackHistoryMiddleware::class)->name('details');
        Route::get('/update/{id}', [UserController::class, 'update_page'])->middleware(TrackHistoryMiddleware::class)->name('update_page');
        Route::get('/reset-password/{id}', [UserController::class, 'reset_password_page'])->middleware(TrackHistoryMiddleware::class)->name('reset_password_page');

        // Cette route nécessite un middleware supplémentaire
        Route::get('/my-profil', [UserController::class, 'my_profil'])
            ->middleware(TrackHistoryMiddleware::class)
            ->name('my_profil');

        Route::post('/save', [UserController::class, 'save'])->name('save');
        Route::put('/update/{id}', [UserController::class, 'update_handler'])->name('update_handler');
        Route::put('/reset-password/{id}', [UserController::class, 'reset_password_handler'])->name('reset_password_handler');
        Route::delete('/delete-one/{id}', [UserController::class, 'delete_one'])->name('delete_one');
    });