<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonController;

/*
|--------------------------------------------------------------------------
| Web Routes - Dons
|--------------------------------------------------------------------------
*/

Route::prefix('don')
    ->middleware(['don.ressource.global','trackHistoryMiddleware'])
    ->group(function () {

        // Liste des dons
        Route::get('/list', [DonController::class, 'list'])
            ->name('don.list');

        // Détails d’un don
        Route::get('/details/{id}', [DonController::class, 'details'])
            ->name('don.details');

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