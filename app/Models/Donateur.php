<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donateur extends Model
{
    use HasFactory;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    /**
     * Relation vers les dons du donateur
     */
    public function dons()
    {
        return $this->hasMany(Don::class);
    }

    /**
     * Surcharge de toArray pour charger automatiquement la relation 'dons'
     */
    public function toArray()
    {
        $this->loadMissing('dons'); // évite de recharger si déjà chargé
        return parent::toArray();
    }
}