<?php 

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class TerminalGeolocalisationService
{
    public static function get(string $ip)
    {
        $key = "terminal_{$ip}";

        return Cache::remember($key, now()->addDay(), function () use ($ip) {

            try {

                $geo = Http::timeout(1600)
                           ->get("https://ipwho.is/{$ip}")
                           ->json();

                $countryCode = $geo['country_code'] ?? null;

                $countryInfo = Http::timeout(1600)
                                   ->get("https://restcountries.com/v3.1/alpha/{$countryCode}")
                                   ->json();

                $currencies = $countryInfo[0]['currencies'] ?? [];
                $currencyCode = array_key_first($currencies);

                return [
                    'country' => [
                        'name' => $geo['country'] ?? null,
                        'code' => $countryCode,
                    ],
                    'currency' => [
                        'code' => $currencyCode,
                        'name' => $currencies[$currencyCode]['name'] ?? null,
                        'symbol' => $currencies[$currencyCode]['symbol'] ?? null,
                    ],
                ];
            }
            catch (Exception $e) {
                // Enregistre l'erreur dans storage/logs/laravel.log sans bloquer l'application
                logger()->error("Erreur Geolocalisation Service: " . $e->getMessage());
                return null;
            }
        });
    }
}