<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\IsHighAdmin;
use App\Http\Middleware\TrackHistoryMiddleware;

use App\Http\Controllers\Admin\PaymentSettingController;

/*
|--------------------------------------------------------------------------
| Web Routes - Payment Setting
|--------------------------------------------------------------------------
*/

Route::prefix('admin/payment-setting')
    ->as('admin.paymentSetting.')
    ->middleware(IsHighAdmin::class)
    ->group(function() {

        // View (affichange)
        Route::get('/register', [PaymentSettingController::class, 'register_page'])
            ->middleware(TrackHistoryMiddleware::class)
            ->name('register_page');
        Route::get('/update/{id}', [PaymentSettingController::class, 'update_page'])
            ->middleware(TrackHistoryMiddleware::class)
            ->name('update_page');    

        // Actions (traitements)    
        Route::post('/save', [PaymentSettingController::class, 'save'])
            ->name('save');

        Route::put('/update/{id}', [PaymentSettingController::class, 'update_handler'])
            ->name('update_handler');
});