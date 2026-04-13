<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Scannable;

class Image extends Model
{
    use HasFactory, Scannable;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    /**
     * Relation morphTo générique
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}