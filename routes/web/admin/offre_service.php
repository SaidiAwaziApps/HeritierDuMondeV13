<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\TrackHistoryMiddleware;
use App\Http\Middleware\OffreServiceRessource\OffreServiceRessourceGlobal;
use App\Http\Middleware\OffreServiceRessource\OffreServiceRessourceCreate;
use App\Http\Middleware\OffreServiceRessource\OffreServiceRessourceUpdate;
use App\Http\Middleware\OffreServiceRessource\OffreServiceRessourceDelete;

use App\Http\Controllers\Admin\OffreServiceController as AdminOffreServiceController;


/*
|--------------------------------------------------------------------------
| Web Routes - OffreEmploie
|--------------------------------------------------------------------------
*/

Route::prefix('admin/offre-service')
    ->as('admin.offre_service.')
    ->middleware(OffreServiceRessourceGlobal::class)
    ->group(function() {

        /* ************************************************************************
         * Routes retournant les pages (enregistrement, modification && list)
         * ***********************************************************************/ 
        Route::get('/register', [AdminOffreServiceController::class, 'register_page'])
            ->middleware([OffreServiceRessourceCreate::class, TrackHistoryMiddleware::class])
            ->name('register_page');

        Route::get('/update/{id}', [AdminOffreServiceController::class, 'update_page'])
            ->middleware([OffreServiceRessourceUpdate::class, TrackHistoryMiddleware::class])
            ->name('update_page');

        Route::get('/list', [AdminOffreServiceController::class, 'list'])
             ->middleware(TrackHistoryMiddleware::class)
             ->name('list');    

        
   
        /* ************************************************************************
         * Routes pour traitement (Sauvegarde, Modification && Suppression)
         * ***********************************************************************/     
        Route::post('/save', [AdminOffreServiceController::class, 'save'])
             ->middleware(OffreServiceRessourceCreate::class)
             ->name('save');     

        Route::put('/update/{id}', [AdminOffreServiceController::class, 'update_handler'])
             ->middleware(OffreServiceRessourceUpdate::class)
             ->name('update_handler');

        Route::delete('/delete-one/{id}', [AdminOffreServiceController::class, 'deleteOne'])
             ->middleware(OffreServiceRessourceDelete::class)
             ->name('deleteOne');
});