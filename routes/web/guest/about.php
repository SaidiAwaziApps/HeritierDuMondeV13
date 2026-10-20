<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\AboutController;

/*
|--------------------------------------------------------------------------
| Web Routes - Authentication
|--------------------------------------------------------------------------
|
| Routes pour la gestion de l'authentification et de la réinitialisation
| des mots de passe. Les middlewares spécifiques sont appliqués si nécessaire.
|
*/

Route::get('/about-us', [AboutController::class, 'about_us'])->name('guest.about.about_us');