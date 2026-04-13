<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benevole extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sociaux() {
        return $this->morphOne(Sociaux::class, 'sociauxeable');
    }

    public function toArray() {
        $this->loadMissing('sociaux');
        return parent::toArray();
    }
}