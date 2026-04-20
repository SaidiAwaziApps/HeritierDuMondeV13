<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuestionnementController;

/*
|--------------------------------------------------------------------------
| Web Routes - Questionnement
|--------------------------------------------------------------------------
*/

Route::prefix('questionnement')
    ->as('questionnement.')
    ->middleware([\App\Http\Middleware\IsAdmin::class, \App\Http\Middleware\TrackHistoryMiddleware::class])
    ->group(function() {

        // Pages (views)
        Route::get('/register', [QuestionnementController::class, 'register_page'])->name('register_page');
        Route::get('/update/{id}', [QuestionnementController::class, 'update_page'])->name('update_page');
        Route::get('/list', [QuestionnementController::class, 'list'])->name('list');

        // Actions (traitements)
        Route::post('/save', [QuestionnementController::class, 'save'])->name('save');
        Route::put('/update/{id}', [QuestionnementController::class, 'update_handler'])->name('update_handler');
        Route::delete('/delete-one/{id}', [QuestionnementController::class, 'delete_one'])->name('delete_one');
});