<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Reception;
use App\Services\NavigationService;
use App\Models\Don;
use App\Models\User;
use App\Jobs\SendConfirmReceptionMailJob;

class ReceptionController extends Controller
{
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
        SendConfirmReceptionMailJob::dispatch($reception);  

        // Redirection vers la page d' origine
        return redirect(NavigationService::getBackPageURL());
    }
}