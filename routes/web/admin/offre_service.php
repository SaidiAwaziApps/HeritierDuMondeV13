<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\TrackHistoryMiddleware;
use App\Http\Middleware\OffreEmploieRessource\OffreEmploieRessourceGlobal;
use App\Http\Middleware\OffreEmploieRessource\OffreEmploieRessourceCreate;
use App\Http\Middleware\OffreEmploieRessource\OffreEmploieRessourceUpdate;
use App\Http\Middleware\OffreEmploieRessource\OffreEmploieRessourceDelete;

use App\Http\Controllers\Admin\OffreServiceController as AdminOffreServiceController;


/*
|--------------------------------------------------------------------------
| Web Routes - OffreEmploie
|--------------------------------------------------------------------------
*/

Route::prefix('admin/offre-service')
    ->as('admin.offre_service.')
    // ->middleware(OffreServiceRessourceGlobal::class)
    ->group(function() {

        /* ************************************************************************
         * Routes retournant les pages (enregistrement, modification && list)
         * ***********************************************************************/ 
        Route::get('/register', [AdminOffreServiceController::class, 'register_page'])
            ->middleware([TrackHistoryMiddleware::class])
            ->name('register_page');

        Route::get('/update/{id}', [AdminOffreServiceController::class, 'update_page'])
            ->middleware([TrackHistoryMiddleware::class])
            ->name('update_page');

        Route::get('/list', [AdminOffreServiceController::class, 'list'])
             ->middleware(TrackHistoryMiddleware::class)
             ->name('list');    

        
   
        /* ************************************************************************
         * Routes pour traitement (Sauvegarde, Modification && Suppression)
         * ***********************************************************************/     
        Route::post('/save', [AdminOffreServiceController::class, 'save'])->name('save');     

        Route::put('/update/{id}', [AdminOffreServiceController::class, 'update_handler'])->name('update_handler');

         Route::delete('/delete-one/{id}', [AdminOffreServiceController::class, 'deleteOne'])
              ->name('deleteOne');
});