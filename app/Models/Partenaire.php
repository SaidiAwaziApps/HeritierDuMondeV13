<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{

    protected $guarded = [];

    /**
     * Relation avec identite
     */
    public function identite() {
        return $this->belongsTo(Identite::class);
    }

    /**
     * Relation morphOne vers Sociaux
     */
    public function sociaux()
    {
        return $this->morphOne(Sociaux::class, 'sociauxeable');
    }
}
