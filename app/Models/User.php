<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\Cache;

#[Fillable(['nom', 'prenom', 'email', 'username', 'password', 'photo', 'status'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Booted : nettoyage du cache après save ou delete
     */
    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('admin');
        });

        static::updated(function() {
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
                   ->firstOrFail();  
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
