<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    use HasFactory;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    /**
     * Relation vers le don associé
     */
    public function don()
    {
        return $this->belongsTo(Reception::class); // ⚠️ Vérifier : probablement devrait être Don::class
    }

    /**
     * Utilisateur lié à la réception
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Surcharge de toArray pour charger automatiquement la relation 'user'
     */
    public function toArray()
    {
        $this->loadMissing('user'); // évite de recharger si déjà chargé
        return parent::toArray();
    }
}