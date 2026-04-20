<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PaymentSettingController;

/*
|--------------------------------------------------------------------------
| Web Routes - Payment Setting
|--------------------------------------------------------------------------
*/

Route::prefix('payment-setting')
    ->as('paymentSetting.')
    ->middleware([\App\Http\Middleware\IsAdmin::class, \App\Http\Middleware\TrackHistoryMiddleware::class])
    ->group(function() {

        // View (affichange)
        Route::get('/register', [PaymentSettingController::class, 'register_page'])
            ->name('register_page');
        Route::get('/update/{id}', [PaymentSettingController::class, 'update_page'])
            ->name('update_page');    

        // Actions (traitements)    
        Route::post('/save', [PaymentSettingController::class, 'save'])
            ->name('save');

        Route::put('/update/{id}', [PaymentSettingController::class, 'update_handler'])
            ->name('update_handler');
});