<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    /**
     * Relation vers le modèle Article
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /** 
     * Recupere toutes les categories par catType 
     */
    public static function findByCatType($ctgType) {
        return self::where('ctg_type','=',$ctgType)
                   ->where('status','=',true)
                   ->get(); 
    }

    /**
     * Récupère toutes les catégories actives
     */
    public static function getAll()
    {
        return self::where('status', true)->get();  
    }
}