<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Services\ImageService;
use App\Models\Besoin;

class BesoinController extends Controller
{
    /* ************************************************************
     * PAGE ENREGISTREMENT (REGISTER)
     * ***********************************************************/ 
    public function register(): View
    {
        return view('pages.besoin.register');
    }

    /* ************************************************************
     * PAGE DE MODIFICATION (UPDATE)
     * ***********************************************************/ 
    public function update_page(Besoin $besoin): View
    {
        // Vérifie que l'instance est active
        abort_if(!$besoin->status, 404);

        return view('pages.besoin.update', compact('besoin'));
    }

    /* ************************************************************
     * RENVOIE A LA PAGE LIST (BESOINS)
     * ***********************************************************/ 
    public function list(): View
    {
        $besoins = Besoin::where('status', true)->get();

        return view('pages.besoin.list', compact('besoins'));
    }

    /* ******************************************************************
     * RENVOIE A LA PAGE DETAILLANT UNE INSTANCE
     * *****************************************************************/
    public function details(Besoin $besoin): View
    {
        abort_if(!$besoin->status, 404);

        return view('pages.besoin.details', compact('besoin'));
    }

    /* ********************************************************************
     * TRAITE LE PROCESSUS D' ENREGISTREMENT D' UNE INSTANCE DANS LA BD
     * *******************************************************************/
    public function save(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'intitule' => 'required|string',
            'montant'  => 'required|numeric',
            'contenu'  => 'required|string',
        ]);

        $besoin = Besoin::create($validated);

        $this->handleImages($request, $besoin);

        return redirect()->route('besoin.list');
    }

    /* *************************************************************
     *  MODIFIE UNE INSTANCE DANS LA BASE DE DONNEES
     * *************************************************************/
    public function update(Request $request, Besoin $besoin): RedirectResponse
    {
        abort_if(!$besoin->status, 404);

        $validated = $request->validate([
            'intitule' => 'required|string',
            'montant'  => 'required|numeric',
            'contenu'  => 'required|string',
        ]);

        $besoin->update($validated);

        $this->handleImages($request, $besoin);

        return redirect()->route('besoin.list');
    }

    /* ***********************************************************
     * SUPPRIME (DESACTIVE) UNE INSTANCE DE LA BASE DE DONNEES 
     * **********************************************************/
    public function delete_one(Besoin $besoin): RedirectResponse
    {
        abort_if(!$besoin->status, 404);

        $besoin->update(['status' => false]);

        return redirect()->route('besoin.list');
    }

    /* *************************************************************
     * GESTION DES IMAGES ET SUPPRESSION
     * *************************************************************/
    private function handleImages(Request $request, Besoin $besoin): void
    {
        $imageService = new ImageService();

        // Ajout d'images
        if (($request->hasFile('images') && count($request->file('images')) > 0) ||
            (!empty($request->iframes) && count($request->iframes) > 0)) {
            $imageService->saveMany($request, $besoin, 'besoin');
        }

        // Suppression d'images ou vignettes
        if ((!empty($request->remove_uploads_id) && count($request->remove_uploads_id) > 0) ||
            (!empty($request->remove_vgns_id) && count($request->remove_vgns_id) > 0)) {
            $imageService->deleteMany($request, $besoin);
        }
    }
}