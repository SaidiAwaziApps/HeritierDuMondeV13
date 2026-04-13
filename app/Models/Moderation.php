<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moderation extends Model
{
    use HasFactory;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    /**
     * Relation morphTo générique
     */
    public function moderateable()
    {
        return $this->morphTo();
    }

    // La surcharge de toArray est commentée, reste inchangée
    // public function toArray() {
    //     $this->load('moderateable');
    //     return parent::toArray();
    // }
}