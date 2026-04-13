<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModerationController;

/*
|--------------------------------------------------------------------------
| Web Routes - Moderation
|--------------------------------------------------------------------------
*/

Route::prefix('moderation')
    ->as('moderation.')
    ->group(function() {

        Route::post('/define', [ModerationController::class, 'define'])
            ->name('define');

        Route::put('/update/{id}', [ModerationController::class, 'update'])
            ->name('update');

});