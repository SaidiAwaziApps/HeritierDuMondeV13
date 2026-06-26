<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CommentaireController as AdminCommentController;

/*
|--------------------------------------------------------------------------
| Web Routes - Commentaires
|--------------------------------------------------------------------------
*/

Route::prefix('commentaire')
    ->as('admin.commentaire.')
    ->group(function () {

        // Enregistrer un commentaire
        Route::post('/register', [AdminCommentController::class, 'save'])
            ->name('commentaire.save');

        // Supprimer un commentaire
        Route::delete('/delete-one/{id}', [AdminCommentController::class, 'delete_one'])
            ->name('commentaire.delete_one');

        // Ajouter une objection à un commentaire
        Route::put('/{id}/add-objection', [AdminCommentController::class, 'add_objection'])
            ->name('commentaire.add_objection');
});
