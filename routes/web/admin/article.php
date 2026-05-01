<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\BlogRessource\BlogRessourceGlobal;

use App\Http\Middleware\BlogRessource\BlogRessourceCreate;

use App\Http\Middleware\BlogRessource\BlogRessourceUpdate;

use App\Http\Middleware\BlogRessource\BlogRessourceDelete;

use App\Http\Middleware\TrackHistoryMiddleware;

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

Route::middleware([BlogRessourceGlobal::class])
    ->prefix('article')
    ->as('admin.article.')
    ->group(function () {

    // Enregistrement d'un nouvel article
    Route::get('/register', [AdminArticleController::class, 'register_page'])
        ->middleware([BlogRessourceCreate::class, TrackHistoryMiddleware::class])
        ->name('register_page');

    // Page de mise à jour d'un article
    Route::get('/update/{id}', [AdminArticleController::class, 'update_page'])
        ->middleware(BlogRessourceUpdate::class, TrackHistoryMiddleware::class)
        ->name('update_page');

    // Liste des articles
    Route::get('/list', [AdminArticleController::class, 'list'])
        ->name('list');

    // Détails d'un article
    Route::get('/details/{id}', [AdminArticleController::class, 'details'])
        ->name('details');

    // Récupérer les commentaires d'un article
    Route::get('/{id}/get-comments', [AdminArticleController::class, 'getComments'])
        ->name('getComments');

    // Ajouter un commentaire à un article
    Route::put('/{id}/add-comment', [AdminArticleController::class, 'addComment'])
        ->name('addComment');

    // Enregistrer un nouvel article
    Route::post('/save', [AdminArticleController::class, 'save'])
        ->middleware(BlogRessourceCreate::class)
        ->name('save');

    // Mettre à jour un article existant
    Route::put('/update/{id}', [AdminArticleController::class, 'update_handler'])
        ->middleware([BlogRessourceCreate::class])
        ->name('update_handler');

    // Supprimer un article
    Route::delete('/delete-one/{id}', [AdminArticleController::class, 'delete_one'])
        ->middleware('blog.ressource.delete')
        ->name('delete_one');

});