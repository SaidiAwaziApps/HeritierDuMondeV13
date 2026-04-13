<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Auteur;

class AuteurService
{
    /**
     * Retourne l'auteur connecté, si l'utilisateur est authentifié.
     */
    public static function define(): ?Auteur
    {
        return Auth::check() ? Auth::user()->auteur : null;
    }
}