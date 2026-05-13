<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\ContactRessource\ContactAdminRessource;

use App\Http\Controllers\Admin\MessageController as AdminMessageController;

/*
|--------------------------------------------------------------------------
| Web Routes - Messages
|--------------------------------------------------------------------------
*/

Route::prefix('message')
    ->as('admin.message.')
    ->middleware(ContactAdminRessource::class)
    ->group(function() {

        Route::get('/get-all', [AdminMessageController::class, 'getAll'])
            ->name('getAll');

        Route::post('/save', [AdminMessageController::class, 'save'])
            ->name('save');

        Route::put('/set-auth-readed-group-messages/{auth_serial_code}', [MessageController::class, 'setAuthReadedGroupMessage'])
            ->name('setAuthReadedGroupMessage');

});