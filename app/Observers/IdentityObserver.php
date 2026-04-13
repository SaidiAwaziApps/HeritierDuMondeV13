<?php

namespace App\Observers;

use App\Jobs\MapIdentityAdresseJob;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Identite;

class IdentityObserver
{
    /**
     * Handle the Identite "created" event.
     */
    public function created(Identite $identite): void
    {
        if ($identite->adresse) {
            MapIdentityAdresseJob::dispatch($identite);
        }
    }

    /**
     * Handle the Identite "updated" event.
     */
    public function updated(Identite $identite): void
    {
        if (!$identite->adresse) {
            return;
        }

        try {
            $response = Http::retry(3, 300)
                            ->timeout(10)
                            ->get('https://photon.komoot.io/api/', [
                                'q' => $identite->adresse
                            ]);

            $data = $response->json();

            if (!empty($data['features'][0]['geometry']['coordinates'])) {
                [$longitude, $latitude] = $data['features'][0]['geometry']['coordinates'];

                $identite->update([
                    'coord_lat'  => $latitude,
                    'coord_long' => $longitude,
                ]);
            } else {
                Log::warning("Adresse introuvable : {$identite->adresse}");
            }
        } catch (\Throwable $e) {
            Log::error("Erreur récupération coordonnée pour Identite ID {$identite->id} : {$e->getMessage()}");
        }
    }

    /**
     * Handle the Identite "deleted" event.
     */
    public function deleted(Identite $identite): void
    {
        //
    }

    /**
     * Handle the Identite "restored" event.
     */
    public function restored(Identite $identite): void
    {
        //
    }

    /**
     * Handle the Identite "force deleted" event.
     */
    public function forceDeleted(Identite $identite): void
    {
        //
    }
}