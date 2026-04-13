<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentSettingController;

/*
|--------------------------------------------------------------------------
| Web Routes - Payment Setting
|--------------------------------------------------------------------------
*/

Route::prefix('payment-setting')
    ->as('paymentSetting.')
    ->middleware(['isHighAdmin','trackHistoryMiddleware'])
    ->group(function() {

        Route::get('/register', [PaymentSettingController::class, 'register'])
            ->name('register');

        Route::post('/save', [PaymentSettingController::class, 'save'])
            ->name('save');

        Route::get('/update/{id}', [PaymentSettingController::class, 'updatePage'])
            ->name('updatePage');

        Route::put('/update/{id}', [PaymentSettingController::class, 'update'])
            ->name('update');
});