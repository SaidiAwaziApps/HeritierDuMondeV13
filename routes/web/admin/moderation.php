<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ModerationController;

/*
|--------------------------------------------------------------------------
| Web Routes - Moderation
|--------------------------------------------------------------------------
*/

Route::prefix('admin/moderation')
    ->as('moderation.')
    ->middleware(\App\Http\Middleware\IsAdmin::class)
    ->group(function() {

        Route::post('/define', [ModerationController::class, 'define'])
            ->name('define');

        Route::put('/update/{id}', [ModerationController::class, 'update'])
            ->name('update');

});