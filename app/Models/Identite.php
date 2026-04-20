<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Identite extends Model
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
            Cache::forget('identite');
        });

        static::deleted(function () {
            Cache::forget('identite');
        });
    }

    /**
     * Récupère une identité active par ID
     */
    public static function getOne($id)
    {
        return self::where('id', $id)
                   ->where('status', true)
                   ->first(); 
    }

    /**
     * Relation morphOne vers Sociaux
     */
    public function sociaux()
    {
        return $this->morphOne(Sociaux::class, 'sociauxeable');
    }

    /**
     * Images associées
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Vignettes associées
     */
    public function vignettes()
    {
        return $this->morphMany(Vignette::class, 'vignetteable');
    }

    /**
     * Questionnements associés
     */
    public function questionnements()
    {
        return $this->morphMany(Questionnement::class, 'questionneable');
    }

    /**
     * Paramètres de paiement
     */
    public function paymentSetting()
    {
        return $this->hasOne(PaymentSetting::class);
    }

    /**
     * Surcharge de toArray pour charger automatiquement certaines relations
     */
    public function toArray()
    {
        $this->loadMissing('images','questionnements'); // évite de recharger si déjà chargé
        return parent::toArray();
    }
}