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

Route::middleware([\App\Http\Middleware\IsAdmin::class, \App\Http\Middleware\TrackHistoryMiddleware::class])
->prefix('access-ressource')
->as('access_ressource.')->group(function () {

    // Page d'enregistrement d'accès pour un utilisateur
    Route::get('/register/{user_id}', [AccessRessourceController::class, 'register_page'])
        ->name('register_page');

    // Page de mise à jour d'accès pour un utilisateur
    Route::get('/update/{user_id}', [AccessRessourceController::class, 'update_page'])
        ->name('update_page');

    // Enregistrement de l'accès
    Route::post('/save', [AccessRessourceController::class, 'save'])
        ->name('save');

    // Mise à jour de l'accès
    Route::put('/update/{user_id}', [AccessRessourceController::class, 'update_handler'])
        ->name('update_handler');

});