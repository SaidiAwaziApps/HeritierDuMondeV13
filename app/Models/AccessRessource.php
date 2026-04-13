<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessRessource extends Model
{
    use HasFactory;

    // Aucun champ protégé, comme dans ton code original
    protected $guarded = [];

    // Relations
    public function ressource()
    {
        return $this->belongsTo(Ressource::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Override toArray pour charger les relations si besoin
    public function toArray()
    {
        $this->loadMissing('ressource');
        return parent::toArray();
    }
}