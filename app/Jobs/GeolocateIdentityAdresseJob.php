<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Models\Identite;

class GeolocateIdentityAdresseJob implements ShouldQueue
{
    use Queueable, Dispatchable, SerializesModels;

    private $identite;

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
        // Géocodage sécurisé
        try {
            $response = Http::timeout(10)->retry(3, 200)->get(config('services.opencage.api_url'), [
                'q' => $this->cleanAddress($this->identite->adresse),
                'key' => config('services.opencage.api_key'),
                'limit' => 1,
            ]);

            // En cas d'echec
            if (!$response->successful()) {
                return;
            }

            $data = $response->json();

            // Resultat non trouve (vide)
            if (empty($data['results'])) {
                return;
            }

            $result = $data['results'][0];

            // filtre qualité (très important)
            if (($result['confidence'] ?? 0) < 3) {
                Log::warning('Low confidence geocode', [
                    'query' => $this->identite->adresse,
                    'confidence' => $result['confidence'] ?? null,
                ]);
            }

            // Mise a jour de coordonnee adresse (geolocalisation)
            $this->identite->update([
                'adresse_coord_lat'  => $result['geometry']['lat'] ?? null,
                'adresse_coord_long' => $result['geometry']['lng'] ?? null
            ]);

        } catch (\Exception $e) {
            Log::error('Geocoding error', [
                'message' => $e->getMessage(),
                'query' => $this->identite->adresse,
            ]);
        }   
    }


    private function cleanAddress(string $address): string 
    {
        $patterns = [
            // français
            '/\ben face de\b/i',
            '/\bface à\b/i',
            '/\bprès de\b/i',
            '/\bproche de\b/i',
            '/\bà côté de\b/i',
            '/\bderrière\b/i',
            '/\bdevant\b/i',
            '/\bvers\b/i',
            '/\bau niveau de\b/i',

            // anglais
            '/\bin front of\b/i',
            '/\bopposite\b/i',
            '/\bnear\b/i',
            '/\bclose to\b/i',
            '/\bnext to\b/i',
            '/\bbehind\b/i',
            '/\baround\b/i',
            '/\bat the corner of\b/i',

            // variantes “terrain” fréquentes (Afrique / informal)
            '/\bmosque\b/i',
            '/\bmosquée\b/i',
            '/\bchurch\b/i',
            '/\béglise\b/i',
            '/\bschool\b/i',
            '/\bhôpital\b/i',
            '/\bmarket\b/i',
            '/\bstation\b/i',
        ];

        $cleaned = preg_replace($patterns, ' ', $address);

        // Nettoyage final (espaces multiples + trim)
        return trim(preg_replace('/\s+/', ' ', $cleaned));
    }
}