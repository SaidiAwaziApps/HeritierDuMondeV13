<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Services\NavigationService;

use App\Models\Regulation;
use App\Models\Identite;
use App\Models\User;
use Exception;

class RegulationController extends Controller
{
    /* ********************************************
     * RENVOIE LA PAGE ENREGISTREMENT
     * ********************************************/
    public function register_page()
    {
        return view('pages.admin.regulation.register');
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
        return view('pages.admin.regulation.update', [
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
            return redirect()->route('admin.regulation.register_page')
                             ->withErrors([
                                'failed' => $e->getMessage()
                             ])
                             ->withInput();
        }
    }

    /* ****************************************************
     * TRAITE LA MODIFICATION DE L' INSTANCE DANS LA B.D
     * ***************************************************/ 
    public function update_handler($id, Request $request): RedirectResponse
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
            return redirect(NavigationService::getBackPageURL());
        }
        catch (Exception $e) {
            // Renvoie à la page de modification avec message d'erreur
            return redirect()->route('admin.regulation.update_page', ['id' => $id])
                             ->withErrors([
                                'failed' => $e->getMessage()
                             ])
                             ->withInput();            
        }                                 
    }
}