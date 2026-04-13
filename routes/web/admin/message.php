<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| Web Routes - Messages
|--------------------------------------------------------------------------
*/

Route::prefix('message')
    ->as('message.')
    ->middleware('contact.ressource.admin')
    ->group(function() {

        Route::get('/get-all', [MessageController::class, 'getAll'])
            ->name('getAll');

        Route::post('/save', [MessageController::class, 'save'])
            ->name('save');

        Route::put('/set-auth-readed-group-messages/{auth_serial_code}', [MessageController::class, 'setAuthReadedGroupMessage'])
            ->name('setAuthReadedGroupMessage');

});