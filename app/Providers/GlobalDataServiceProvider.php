<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Http;

use App\Services\CurrencyRateService;

use App\Models\Identite;
use App\Models\PaymentSetting;
use App\Models\User;

class GlobalDataServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Cache global (toutes les pages)
        View::composer('*', function ($view) {

            // Identité du site (cache indéfini)
            $identiteData = Cache::rememberForever('identite', fn() => Identite::first()?->toArray());
            $identite = $identiteData ? Identite::hydrate([$identiteData])->first() : null;

            // Paramètres de paiement (cache indéfini)
            $paymentSettingData = Cache::rememberForever('payment_setting', fn() => PaymentSetting::first()?->toArray());
            $paymentSetting = $paymentSettingData ? PaymentSetting::hydrate([$paymentSettingData])->first() : null;

            // Premier utilisateur = admin principal (cache indéfini)
            $adminData = Cache::rememberForever('admin', fn() => User::first()?->toArray());
            $admin = $adminData ? User::hydrate([$adminData])->first() : null;

            // Passe les données à toutes les vues
            $view->with(compact('identite', 'paymentSetting', 'admin'));
        });

        // Specifiques a certaines pages (views)
        View::composer('pages.admin.payment_setting.*', function ($view) {

            // Taux d'echange (USD - EURO)
            $currency_exchange_rate = Cache::remember('currency_exchange_rate', now()->addDay(), function() {
                return CurrencyRateService::getRate();
            });   

            // Passe la donnee taux d'echange (USD - EURO) a la vue
            $view->with(compact('currency_exchange_rate'));
        });
    }
}