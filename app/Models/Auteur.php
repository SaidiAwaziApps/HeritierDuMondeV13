<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auteur extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function auteable(){
        return $this->morphTo();
    }

    public function morphModel() {
        if($this->type == 'user') {
            return User::where('id', '=', $this->auteable_id)->first();
        } else {
            return Visiteur::where('id', '=', $this->auteable_id)->first();
        }
    }

    public function articles() {
        return $this->hasMany(Article::class);
    }

    public function commentaires() {
        return $this->hasMany(Commentaire::class);
    }

    public function objections() {
        return $this->hasMany(Objection::class);
    }

    public function messagesEnvoyes() {
        return $this->hasMany(Message::class, 'expediteur_id');
    }

    public function messagesRecues() {
        return $this->hasMany(Message::class, 'auth_msg_destinations');
    }

    public function toArray(){
        $this->loadMissing('auteable');
        return parent::toArray();
    }
}