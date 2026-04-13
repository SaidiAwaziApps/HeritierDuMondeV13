<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes - Article
|--------------------------------------------------------------------------
|
| Routes pour la gestion des articles. Les middlewares gèrent l'accès
| global et le suivi des actions.
|
*/

Route::middleware(['blog.ressource.global', 'trackHistoryMiddleware'])
    ->prefix('article')
    ->group(function () {

    // Enregistrement d'un nouvel article
    Route::get('/register', [AdminArticleController::class, 'register'])
        ->middleware('blog.ressource.create')
        ->name('article.register');

    // Page de mise à jour d'un article
    Route::get('/update/{id}', [AdminArticleController::class, 'update_page'])
        ->middleware('blog.ressource.update')
        ->name('article.update_page');

    // Liste des articles
    Route::get('/list', [AdminArticleController::class, 'list'])
        ->name('article.list');

    // Détails d'un article
    Route::get('/details/{id}', [ArticleController::class, 'details'])
        ->name('article.details');

    // Récupérer les commentaires d'un article
    Route::get('/{id}/get-comments', [ArticleController::class, 'getComments'])
        ->name('article.getComments');

    // Ajouter un commentaire à un article
    Route::put('/{id}/add-comment', [ArticleController::class, 'addComment'])
        ->name('article.addComment');

    // Enregistrer un nouvel article
    Route::post('/save', [ArticleController::class, 'save'])
        ->middleware('blog.ressource.create')
        ->name('article.save');

    // Mettre à jour un article existant
    Route::put('/update/{id}', [ArticleController::class, 'update'])
        ->middleware('blog.ressource.update')
        ->name('article.update');

    // Supprimer un article
    Route::delete('/delete-one/{id}', [ArticleController::class, 'delete_one'])
        ->middleware('blog.ressource.delete')
        ->name('article.delete_one');

});