<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentaireController;

/*
|--------------------------------------------------------------------------
| Web Routes - Commentaires
|--------------------------------------------------------------------------
*/

Route::prefix('commentaire')
    ->middleware(['commentaire.ressource.global', 'trackHistoryMiddleware'])
    ->group(function () {

        // Enregistrer un commentaire
        Route::post('/register', [CommentaireController::class, 'save'])
            ->name('commentaire.save');

        // Supprimer un commentaire
        Route::delete('/delete-one/{id}', [CommentaireController::class, 'delete_one'])
            ->name('commentaire.delete_one');

        // Ajouter une objection à un commentaire
        Route::put('/{id}/add-objection', [CommentaireController::class, 'add_objection'])
            ->name('commentaire.add_objection');
});
