<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AccessRessourceController;

/*
|--------------------------------------------------------------------------
| Web Routes - Access Ressource
|--------------------------------------------------------------------------
|
| Routes pour la gestion des accès aux ressources. Ces routes sont
| protégées par les middlewares 'isAdmin' et 'trackHistoryMiddleware'.
|
*/

Route::middleware(['isAdmin', 'trackHistoryMiddleware'])->prefix('access-ressource')->group(function () {

    // Page d'enregistrement d'accès pour un utilisateur
    Route::get('/register/{user_id}', [AccessRessourceController::class, 'register'])
        ->name('access_ressource.register');

    // Page de mise à jour d'accès pour un utilisateur
    Route::get('/update/{user_id}', [AccessRessourceController::class, 'update_page'])
        ->name('access_ressource.update_page');

    // Enregistrement de l'accès
    Route::post('/save', [AccessRessourceController::class, 'save'])
        ->name('access_ressource.save');

    // Mise à jour de l'accès
    Route::put('/update/{user_id}', [AccessRessourceController::class, 'update'])
        ->name('access_ressource.update');

});