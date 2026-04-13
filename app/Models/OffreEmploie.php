<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffreEmploie extends Model
{
    use HasFactory;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    /**
     * Récupère une offre active par ID
     */
    public static function getOne($id)
    {
        return self::where('id', $id)
                   ->where('status', true)
                   ->first();  
    }
}