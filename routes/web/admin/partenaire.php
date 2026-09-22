<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\IsAdmin;

use App\Http\Middleware\TrackHistoryMiddleware;

use App\Http\Controllers\Admin\PartenaireController as AdminPartenaireController;


/*
|--------------------------------------------------------------------------
| Web Routes - OffreEmploie
|--------------------------------------------------------------------------
*/
Route::prefix('admin/partenaire')
    ->as('admin.partenaire.')
    ->group(function() {
          
        Route::get('/register',[AdminPartenaireController::class, 'register_page'])->name('register_page'); 
        
        Route::get('/list',[AdminPartenaireController::class, 'list'])->name('list'); 


        Route::post('/save',[AdminPartenaireController::class, 'save'])->name('save'); 

    });