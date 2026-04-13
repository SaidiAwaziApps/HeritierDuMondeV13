<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Reception;
use App\Models\Don;
use App\Models\User;
use App\Jobs\SendConfirmReceptionJob;

class ReceptionController extends Controller
{
    /* ********************************************
     * RENVOIE LA PAGE DE PROVENANCE (ORIGINE)
     * ****************************************/
    private function getBackPageURLNavigation(): string
    {
        // Historique de navigation
        $history = session('history', []);

        $previousUrl = null;

        if (count($history) >= 2) {
            $previousUrl = $history[1]['url']; // page précédente (index corrigé pour Laravel 13)
        } 
        elseif (count($history) === 1) {
            $previousUrl = $history[0]['url']; // fallback si seulement 1 page
        } 
        else {
            $previousUrl = route('home'); // fallback si pas d'historique
        }

        // Retourne l'URL de redirection
        return $previousUrl;
    }

    /* ***********************************************************
     * TRAITE L' ENREGISTREMENT (PROCESSUS)
     * ***********************************************************/
    public function save(Request $request): RedirectResponse
    {
        // Validation du formulaire
        $request->validate([
            'don_id' => ['required', 'integer'],
            'texte'  => ['required', 'string']
        ]);

        // Don a receptionner
        $don = Don::findOrFail($request->don_id);

        // Enregistre la reception
        $reception = Reception::create([
            'don_id'  => $don->id,
            'user_id' => User::getOne(1)?->id ?? 1, // fallback si User introuvable
            'texte'   => $request->texte
        ]);
        
        // Envoie du email d'accuse de reception au donateur
        SendConfirmReceptionJob::dispatch($reception);  

        // Renvoie a la page precedente
        return redirect($this->getBackPageURLNavigation());
    }
}