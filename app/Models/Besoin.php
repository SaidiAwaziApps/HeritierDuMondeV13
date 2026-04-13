<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Besoin extends Model
{
    use HasFactory;

    // Sécurité: seuls ces champs peuvent être assignés en masse
    protected $fillable = [
        'intitule',
        'montant',
        'contenu',
        'status'
    ];

    // Casts pour types appropriés
    protected $casts = [
        'status' => 'boolean',
        'montant' => 'float',
    ];

    // Relations
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function besoinDons()
    {
        return $this->hasMany(BesoinDon::class);
    }

    public function shares()
    {
        return $this->morphMany(Share::class, 'shareable');
    }

    // Override toArray pour charger les relations
    public function toArray()
    {
        $this->loadMissing(['images', 'besoinDons', 'shares']);
        return parent::toArray();
    }
}