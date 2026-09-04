<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;

/*
|--------------------------------------------------------------------------
| Web Routes - Authentication
|--------------------------------------------------------------------------
|
| Routes pour la gestion de l'authentification et de la réinitialisation
| des mots de passe. Les middlewares spécifiques sont appliqués si nécessaire.
|
*/

Route::get('/',[GuestHomeController::class, 'home'])->name('guest.home');
