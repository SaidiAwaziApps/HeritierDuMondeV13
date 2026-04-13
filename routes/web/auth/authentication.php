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

/*************************
 * Routes GET
 *************************/

Route::get('/login', [AuthenticationController::class, 'loginPage'])
    ->name('authentication.login_page');

Route::get('/reset-email', [AuthenticationController::class, 'resetEmailPage'])
    ->name('authentication.reset_email_page');

Route::get('/reset-code/{reset_email}/{send_code}', [AuthenticationController::class, 'resetCodePage'])
    ->name('authentication.reset_code_page');

Route::get('/reset-password/{reset_email}', [AuthenticationController::class, 'resetPasswordPage'])
    ->name('authentication.reset_password_page');

Route::get('/update-password', [AuthenticationController::class, 'updatePasswordPage'])
    ->name('authentication.update_password_page');

/***************************
 * Routes POST & PUT
 **************************/

Route::post('/login', [AuthenticationController::class, 'loginHandler'])
    ->name('authentication.login_handler');

Route::post('/reset-email', [AuthenticationController::class, 'resetEmailHandler'])
    ->name('authentication.reset_email_handler');

Route::post('/reset-code', [AuthenticationController::class, 'resetCodeHandler'])
    ->name('authentication.reset_code_handler');

Route::put('/reset-password/{reset_email}', [AuthenticationController::class, 'resetPasswordHandler'])
    ->name('authentication.reset_password_handler');

Route::put('/update-password/{user_id}', [AuthenticationController::class, 'updatePasswordHandler'])
    ->middleware('isAuthentication')
    ->name('authentication.update_password_handler');