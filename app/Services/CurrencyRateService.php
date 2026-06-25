<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

use App\Models\PaymentSetting;

class CurrencyRateService
{
    public static function getRate()
    {
        $from = 'USD';
        $to = 'EUR';

        // Instance payment setting
        $paymentSetting = PaymentSetting::findOrFail(1);

        try {
            $response = Http::timeout(5)->get('https://api.frankfurter.app/latest', [
                'from' => $from,
                'to' => $to,
            ]);

            if (!$response->successful()) {
                logger()->error('CurrencyRateService API error', [
                    'status' => $response->status(),
                ]);
           
                 // Renvoie le taux d' echange recent 
                return $paymentSetting->last_currency_rate;
            }

            // Modifie le taux d' change courant de l'instance
            $paymentSetting->update([
               'last_currency_rate' => $response->json("rates.$to")
            ]);

            return $response->json("rates.$to");

        } catch (Exception $e) {
            logger()->error("CurrencyRateService exception: " . $e->getMessage());

            // Renvoie le taux d' echange recent 
            return $paymentSetting->last_currency_rate;
        }
    }
}