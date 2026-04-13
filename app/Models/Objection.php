<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Moderatable;

class Objection extends Model
{
    use HasFactory, Moderatable;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    /**
     * Relation morphTo générique
     */
    public function objectable()
    {
        return $this->morphTo();
    }

    /**
     * Auteur de l'objection
     */
    public function auteur()
    {
        return $this->belongsTo(Auteur::class);  
    }

    /**
     * Images associées
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Fichiers associés
     */
    public function fichiers()
    {
        return $this->morphMany(Fichier::class, 'ficheable');
    }

    /**
     * Modération associée
     */
    public function moderation()
    {
        return $this->morphOne(Moderation::class, 'moderateable');
    }

    /**
     * Surcharge de toArray pour charger automatiquement certaines relations
     */
    public function toArray()
    {
        $this->loadMissing('images', 'fichiers', 'auteur', 'moderation'); // évite de recharger si déjà chargé
        return parent::toArray();
    }
}