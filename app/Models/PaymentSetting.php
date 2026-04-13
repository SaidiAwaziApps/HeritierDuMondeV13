<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PaymentSetting extends Model
{
    use HasFactory;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    /**
     * Booted : nettoyage du cache après save ou delete
     */
    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('payment_setting');
        });

        static::deleted(function () { 
            Cache::forget('payment_setting');
        });
    }

    /**
     * Relation vers l'identité
     */
    public function identite()
    {
        return $this->belongsTo(Identite::class);
    }
}