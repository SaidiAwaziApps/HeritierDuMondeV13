<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObjectionController;

/*
|--------------------------------------------------------------------------
| Web Routes - Objection
|--------------------------------------------------------------------------
*/

Route::prefix('admin/objection')
    ->as('objection.')
    ->group(function() {

        Route::post('/save', [ObjectionController::class, 'save'])
            ->name('save');

        Route::delete('/delete-one/{id}', [ObjectionController::class, 'delete_one'])
            ->name('delete_one');

});