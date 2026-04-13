<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Identite;

class MapIdentityAdresseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Identite $identite;

    /**
     * Create a new job instance.
     */
    public function __construct(Identite $identite)
    {
        $this->identite = $identite;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = Http::get('https://photon.komoot.io/api/', [
            'q' => $this->identite->adresse,
        ]);

        $data = $response->json();

        if (!empty($data['features'])) {
            $coords    = $data['features'][0]['geometry']['coordinates'];
            $latitude  = $coords[1];
            $longitude = $coords[0];
            
            // Définit les coordonnées à l'adresse
            $this->identite->update([
                'coord_lat'  => $latitude,
                'coord_long' => $longitude,
            ]);

        } else {
            Log::warning("Adresse introuvable : {$this->identite->adresse}");
        }
    }
}