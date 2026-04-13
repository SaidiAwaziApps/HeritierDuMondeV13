<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // Tous les champs sont assignables en masse
    protected $guarded = [];

    /**
     * Expéditeur du message
     */
    public function expediteur()
    {
        return $this->belongsTo(Auteur::class, 'expediteur_id');
    }

    /**
     * Destinataires du message via table pivot
     */
    public function destinateurs()
    {
        return $this->belongsToMany(
            Auteur::class,
            'auth_msg_destinations', // table pivot
            'message_id',             // clé étrangère du message dans la pivot
            'destinateur_id'          // clé étrangère du destinataire dans la pivot
        ); 
    }

    /**
     * Fichiers associés au message
     */
    public function fichiers()
    {
        return $this->morphMany(Fichier::class, 'ficheable');
    }

    /**
     * Surcharge de toArray pour charger automatiquement certaines relations
     */
    public function toArray()
    {
        $this->loadMissing('expediteur', 'destinateurs', 'fichiers'); // évite de recharger si déjà chargé
        return parent::toArray();
    }
}