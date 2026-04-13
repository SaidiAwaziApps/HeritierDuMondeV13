<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

trait Scannable
{
    /**
     * Scanner un fichier via l'API Sightengine.
     *
     * @param array $tasks Liste des tâches à exécuter (ex: ['nudity','offensive'])
     * @return array|null
     */
    public function scan(array $tasks): ?array
    {
        $apiURL = config('services.sightengine.api_url');
        $apiUser = config('services.sightengine.api_user');
        $apiSecret = config('services.sightengine.api_secret');

        // Vérifie que le fichier existe dans le storage public
        if (!Storage::disk('public')->exists($this->path)) {
            return null;
        }

        $fileContent = Storage::disk('public')->get($this->path);

        try {
            $response = Http::timeout(10)
                ->attach(
                    'media',               // clé attendue par l’API
                    $fileContent,
                    basename($this->path)
                )
                ->post($apiURL, [
                    'models' => implode(',', $tasks),
                    'api_user' => $apiUser,
                    'api_secret' => $apiSecret,
                ]);

            return $response->successful() ? $response->json() : null;

        } catch (\Throwable $e) {
            \Log::error("Erreur scan Sightengine pour {$this->path}: {$e->getMessage()}");
            return null;
        }
    }
}