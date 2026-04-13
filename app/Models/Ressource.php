<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    /**
     * Récupère une ressource active par nom
     */
    public static function getOnceByName($name)
    {
        return self::where('nom', $name)
                   ->where('status', true)
                   ->first();
    }

    /**
     * Récupère toutes les ressources actives
     */
    public static function getAll()
    {
        return self::where('status', true)
                   ->get();
    }

    /**
     * Relation vers les accès aux ressources
     */
    public function access_ressources()
    {
        return $this->hasMany(AccessRessource::class);
    }
}