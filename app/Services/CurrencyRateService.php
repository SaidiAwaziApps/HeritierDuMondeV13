<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class CurrencyRateService
{
    public static function getRate()
    {
        $from = 'USD';
        $to = 'EUR';

        try {
            $response = Http::timeout(5)->get('https://api.frankfurter.app/latest', [
                'from' => $from,
                'to' => $to,
            ]);

            if (!$response->successful()) {
                logger()->error('CurrencyRateService API error', [
                    'status' => $response->status(),
                ]);

                return null;
            }

            return $response->json("rates.$to");

        } catch (Exception $e) {
            logger()->error("CurrencyRateService exception: " . $e->getMessage());

            return null;
        }
    }
}