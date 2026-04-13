<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    /**
     * Relation morphOne vers Auteur
     */
    public function auteur()
    {
        return $this->morphOne(Auteur::class, 'auteable');
    }
}