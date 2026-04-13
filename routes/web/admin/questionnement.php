<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionnementController;

/*
|--------------------------------------------------------------------------
| Web Routes - Questionnement
|--------------------------------------------------------------------------
*/

Route::prefix('questionnement')
    ->as('questionnement.')
    ->middleware(['isAdmin','trackHistoryMiddleware'])
    ->group(function() {

        // Pages (views)
        Route::get('/register', [QuestionnementController::class, 'register'])->name('register');
        Route::get('/update/{id}', [QuestionnementController::class, 'update_page'])->name('update_page');
        Route::get('/list', [QuestionnementController::class, 'list'])->name('list');

        // Actions
        Route::post('/save', [QuestionnementController::class, 'save'])->name('save');
        Route::put('/update/{id}', [QuestionnementController::class, 'update'])->name('update');
        Route::delete('/delete-one/{id}', [QuestionnementController::class, 'delete_one'])->name('delete_one');
});