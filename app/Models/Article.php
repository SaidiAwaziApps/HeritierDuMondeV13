<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categorie() {
        return $this->belongsTo(Categorie::class);
    }

    public function auteur() {
        return $this->belongsTo(Auteur::class);
    }

    public function images() {
        return $this->morphMany(Image::class,'imageable');
    }

    public function commentaires() {
        return $this->morphMany(Commentaire::class,'commentable');
    }

    public function shares() {
        return $this->morphMany(Share::class,'shareable');
    }

    public function getOne($id) {
        return self::where('id','=',$id)
                   ->where('status','=',true)
                   ->first();    
    }

    public function toArray() {
        $this->loadMissing('categorie','auteur','images','commentaires');
        return parent::toArray();
    }
}