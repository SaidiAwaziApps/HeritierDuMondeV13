<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\TrackHistoryMiddleware;
use App\Http\Middleware\DonRessource\DonRessourceGlobal;

use App\Http\Controllers\Admin\DonController as AdminDonController;

/*
|--------------------------------------------------------------------------
| Web Routes - Dons
|--------------------------------------------------------------------------
*/

Route::prefix('don')
    ->as('admin.don.') 
    ->middleware([DonRessourceGlobal::class, TrackHistoryMiddleware::class])
    ->group(function () {

        // Liste des dons
        Route::get('/list', [AdminDonController::class, 'list'])
            ->name('list');

        // Détails d’un don
        Route::get('/details/{id}', [AdminDonController::class, 'details'])
            ->name('details');

        // Génération de dons (désactivée)
        Route::get('/generate', function () {

            /*
            $dons = [
                ['montant' => '1000', 'mode_paiement' => 'paypal'],
                ['montant' => '6000', 'mode_paiement' => 'visa'],
                ['montant' => '10000', 'mode_paiement' => 'virement bancaire']
            ];

            $donateurs = Donateur::where('status', true)->get();
            $besoins = Besoin::where('status', true)->get();

            foreach ($dons as $i => $data) {
                $don = Don::create([
                    'montant' => $data['montant'],
                    'mode_paiement' => $data['mode_paiement'],
                    'donateur_id' => $donateurs[$i]->id ?? null
                ]);

                if (isset($besoins[$i])) {
                    $besoins[$i]->dons()->attach($don->id);
                }
            }
            */

            return "Génération de dons désactivée.";
        })->name('don.generate');

});