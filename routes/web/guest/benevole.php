<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\BenevoleController as GuestBenevolecontroller;

/*
|--------------------------------------------------------------------------
| Web Routes - Authentication
|--------------------------------------------------------------------------
|
| Routes pour la gestion de l'authentification et de la réinitialisation
| des mots de passe. Les middlewares spécifiques sont appliqués si nécessaire.
|
*/

Route::get('/benevole/list', [GuestBenevolecontroller::class, 'list'])->name('guest.benevole.list');