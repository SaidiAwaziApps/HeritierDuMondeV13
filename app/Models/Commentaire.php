<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Moderatable;

class Commentaire extends Model
{
    use HasFactory, Moderatable;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    /**
     * Relation morphTo générique
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Auteur du commentaire
     */
    public function auteur()
    {
        return $this->belongsTo(Auteur::class);
    }

    /**
     * Images associées au commentaire
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Fichiers associés au commentaire
     */
    public function fichiers()
    {
        return $this->morphMany(Fichier::class, 'ficheable');
    }

    /**
     * Objections associées au commentaire
     */
    public function objections()
    {
        return $this->morphMany(Objection::class, 'objectable');
    }

    /**
     * Modération associée
     */
    public function moderation()
    {
        return $this->morphOne(Moderation::class, 'moderateable');
    }

    /**
     * Surcharge de toArray pour charger automatiquement les relations
     */
    public function toArray()
    {
        $this->loadMissing('auteur', 'images', 'fichiers', 'objections', 'moderation');
        return parent::toArray();
    }
}