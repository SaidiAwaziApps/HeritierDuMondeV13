<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visiteur extends Model
{
    use HasFactory;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    // Relations commentées conservées
    // public function commentaires(){
    //     return $this->hasMany(Commentaire::class);
    // }

    // public function objections() {
    //     return $this->hasMany(Objection::class);
    // }

    /**
     * Relation morphOne vers Auteur
     */
    public function auteur()
    {
        return $this->morphOne(Auteur::class, 'auteable');
    }
}