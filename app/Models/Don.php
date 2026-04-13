<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Don extends Model
{
    use HasFactory;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    /**
     * Relation vers le donateur
     */
    public function donateur()
    {
        return $this->belongsTo(Donateur::class);
    }

    /**
     * Relation vers les besoins liés à ce don
     */
    public function besoinDons()
    {
        return $this->hasMany(BesoinDon::class);
    }

    /**
     * Relation vers la réception associée
     */
    public function reception()
    {
        return $this->hasOne(Reception::class);
    }

    /**
     * Surcharge de toArray pour charger automatiquement la relation 'reception'
     */
    public function toArray()
    {
        $this->loadMissing('reception'); // évite de recharger si déjà chargé
        return parent::toArray();
    }
}