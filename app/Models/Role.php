<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    /**
     * Récupère un rôle actif par nom
     */
    public static function findByRoleName($rolename)
    {
        return self::where('rolename', $rolename)
                   ->where('status', true)
                   ->first();       
    }

    /**
     * Relation vers les utilisateurs ayant ce rôle
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }
}