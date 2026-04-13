<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cache;

class AserAAA extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    // Champs cachés pour la sérialisation
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Types de champs
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Booted : nettoyage du cache après save ou delete
     */
    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('admin');
        });

        static::deleted(function () {
            Cache::forget('admin');
        });
    }

    /**
     * Récupère un utilisateur actif par ID
     */
    public static function getOne($id)
    {
        return self::where('id', $id)
                   ->where('status', true)
                   ->first();  
    }

    /**
     * Récupère tous les utilisateurs actifs
     */
    public static function getAll()
    {
        return self::where('status', true)->get(); 
    }

    /**
     * Relations et permissions
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function hasRole($rolename)
    {
        return $this->roles()->where('rolename', $rolename)->exists();
    }

    public function access_ressources()
    {
        return $this->hasMany(AccessRessource::class);
    }

    public function hasAccessToRessource($ressource, $action, $mention)
    {
        if (!$this->hasRole('admin')) {
            $access_ressource = $this->access_ressources()
                ->where('ressource_id', Ressource::getOnceByName($ressource)->id)
                ->where('action', $action)
                ->where('mention', $mention)
                ->where('status', true)
                ->first();

            return $access_ressource ? true : false;
        }

        return true;
    }

    public function receptions()
    {
        return $this->hasMany(Reception::class);
    }

    public function auteur()
    {
        return $this->morphOne(Auteur::class, 'auteable');
    }

    /**
     * Surcharge de toArray pour charger automatiquement certaines relations
     */
    public function toArray()
    {
        $this->loadMissing('roles', 'access_ressources'); // optimisation : évite de recharger si déjà chargé
        return parent::toArray();
    }
}