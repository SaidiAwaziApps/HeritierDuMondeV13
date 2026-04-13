<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    /**
     * Images associées à l'événement
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Shares associés à l'événement
     */
    public function shares()
    {
        return $this->morphMany(Share::class, 'shareable');
    }

    /**
     * Surcharge de toArray pour charger automatiquement la relation 'images'
     */
    public function toArray()
    {
        $this->loadMissing('images'); // évite de recharger si déjà chargé
        return parent::toArray();
    }
}