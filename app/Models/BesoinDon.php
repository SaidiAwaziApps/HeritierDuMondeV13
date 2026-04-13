<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BesoinDon extends Model
{
    use HasFactory;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    /**
     * Relation vers le modèle Besoin
     */
    public function besoin()
    {
        return $this->belongsTo(Besoin::class);
    }

    /**
     * Relation vers le modèle Don
     */
    public function don()
    {
        return $this->belongsTo(Don::class);
    }

    /**
     * Surcharge de toArray pour charger automatiquement la relation 'don'
     */
    public function toArray()
    {
        $this->loadMissing('don'); // Utilisation de loadMissing pour éviter de recharger si déjà chargé
        return parent::toArray();
    }
}