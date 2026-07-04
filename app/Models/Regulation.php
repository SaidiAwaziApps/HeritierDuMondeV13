<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cache;


class Regulation extends Model
{
    use HasFactory;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    /**
     * Booted : nettoyage du cache après save ou delete
     */
    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('regulation');
        });

        static::updated(function () {
            Cache::forget('regulation');
        });

        static::deleted(function () {
            Cache::forget('regulation');
        });
    }

    /**
     * Récupère une réglementation active par ID
     */
    public static function getOne($id)
    {
        return self::where('id', $id)
                   ->where('status', true)
                   ->first(); 
    }
}