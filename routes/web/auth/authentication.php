<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticationController;

/*
|--------------------------------------------------------------------------
| Web Routes - Authentication
|--------------------------------------------------------------------------
|
| Routes pour la gestion de l'authentification et de la réinitialisation
| des mots de passe. Les middlewares spécifiques sont appliqués si nécessaire.
|
*/

Route::prefix('admin/')->as('authentication.')->group(function() {
    
    /* ************************
     * Routes GET
     * ************************/
    Route::get('', [AuthenticationController::class, 'loginPage'])
         ->name('login_page');

    Route::get('/reset-email', [AuthenticationController::class, 'resetEmailPage'])
         ->name('reset_email_page');

    Route::get('/reset-code/{reset_email}/{send_code}', [AuthenticationController::class, 'resetCodePage'])
         ->name('reset_code_page');

    Route::get('/reset-password/{reset_email}', [AuthenticationController::class, 'resetPasswordPage'])
         ->name('reset_password_page');

    Route::get('/update-password', [AuthenticationController::class, 'updatePasswordPage'])
         ->name('update_password_page');


    /***************************
     * Routes POST & PUT
     **************************/
    Route::post('/login', [AuthenticationController::class, 'loginHandler'])
         ->name('login_handler');

    Route::post('/reset-email', [AuthenticationController::class, 'resetEmailHandler'])
         ->name('reset_email_handler');

    Route::post('/reset-code', [AuthenticationController::class, 'resetCodeHandler'])
         ->name('reset_code_handler');

    Route::put('/reset-password/{reset_email}', [AuthenticationController::class, 'resetPasswordHandler'])
         ->name('reset_password_handler');

    Route::put('/update-password/{user_id}', [AuthenticationController::class, 'updatePasswordHandler'])
         ->middleware('isAuthentication')
         ->name('update_password_handler');
});