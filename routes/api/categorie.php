<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Ici tu peux définir toutes tes routes API. Elles sont chargées via
| le RouteServiceProvider dans le groupe "api" middleware.
|
*/

// Exemple avec auth:sanctum si tu veux l'activer plus tard
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('categorie')->group(function () {
    Route::post('/register', [CategorieController::class, 'save'])->name('categorie.save');
});