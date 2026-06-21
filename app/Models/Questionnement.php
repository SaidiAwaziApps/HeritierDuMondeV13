<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cache;

class Questionnement extends Model
{
    use HasFactory;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    
    /**
     * Booted : nettoyage du cache après update ou delete
     */
    public static function booted() {
        
        static::updated(function() {
            Cache::forget('identite');
        });

        static::deleted(function() {
            Cache::forget('identite');
        });
    }

    /**
     * Relation morphTo générique
     */
    public function questionneable()
    {
        return $this->morphTo();
    }
}