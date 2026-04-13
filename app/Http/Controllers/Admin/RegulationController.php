<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Regulation;
use App\Models\Identite;
use App\Models\User;
use Exception;

class RegulationController extends Controller
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
            $previousUrl = $history[1]['url']; // page précédente (index corrigé)
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

    /* ********************************************
     * RENVOIE LA PAGE ENREGISTREMENT
     * ********************************************/
    public function register()
    {
        return view('pages.regulation.register');
    }

    /* ********************************************
     * RENVOIE LA PAGE DE MODIFICATION
     * ********************************************/
    public function update_page($id)
    {
        // Instance a modifier
        $regulation = Regulation::where('id', $id)
                                ->where('status', true)
                                ->first();

        // Renvoie la page
        return view('pages.regulation.update', [
            'regulation' => $regulation
        ]);                     
    }

    /* *********************************************************
     * TRAITE L' ENREGISTREMENT D' UNE L'INSTANCE DANS LA B.D
     * *********************************************************/
    public function save(Request $request): RedirectResponse
    {
        try {
            // Crée une instance regulation
            $regulation = Regulation::create([
                'type'                     => 'commentaire',
                'attempt_all_to_moderated' => $request->attempt_all_to_moderated ? 'oui' : 'non',
                'must_already_moderated'   => $request->must_already_moderated ? 'oui' : 'non',
                'nbr_already_moderated'    => $request->must_aldready_moderated ? $request->nbr_already_moderated : null,
                'denied_words'             => $request->denied_words,
                'denied_images'            => implode(',', (array) $request->denied_images)
            ]);

            // Renvoie à la page précédente
            return redirect()->back();
        }
        catch (Exception $e) {
            // Renvoie à la page d'enregistrement avec message d'erreur
            return redirect()->route('regulation.register')
                             ->withErrors([
                                'failed' => $e->getMessage()
                             ])
                             ->withInput();
        }
    }

    /* ****************************************************
     * TRAITE LA MODIFICATION DE L' INSTANCE DANS LA B.D
     * ***************************************************/ 
    public function update($id, Request $request): RedirectResponse
    {
        // Instance a modifier
        $regulation = Regulation::where('id', $id)
                                ->where('status', true)
                                ->first();

        try {
            // Applique la modification
            $regulation->update([
                'attempt_all_to_moderated' => $request->attempt_all_to_moderated ? 'oui' : 'non',
                'must_already_moderated'   => $request->must_already_moderated ? 'oui' : 'non',
                'nbr_already_moderated'    => $request->must_aldready_moderated ? $request->nbr_already_moderated : null,
                'denied_words'             => $request->denied_words,
                'denied_images'            => implode(',', (array) $request->denied_images)
            ]);

            // Renvoie à la page précédente
            return redirect($this->getBackPageURLNavigation());
        }
        catch (Exception $e) {
            // Renvoie à la page de modification avec message d'erreur
            return redirect()->route('regulation.update_page', ['id' => $id])
                             ->withErrors([
                                'failed' => $e->getMessage()
                             ])
                             ->withInput();            
        }                                 
    }
}