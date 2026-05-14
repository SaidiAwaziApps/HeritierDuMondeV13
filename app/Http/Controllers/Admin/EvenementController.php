<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;
use App\Models\Evenement;
use App\Models\Image;

class EvenementController extends Controller
{
    /* ***************************************************************
     * RENVOIE A LA PAGE D' ENREGISTREMENT (REGISTER)
     * ***************************************************************/
    public function register_page(): View
    {
        return view('pages.admin.evenement.register');
    }

    /* ***************************************************************
     * RENVOIE A LA PAGE DE MODIFICATION (UPDATE)
     * ***************************************************************/
    public function update_page($id): View
    {
        $evenement = Evenement::where('id', $id)
                              ->where('status', true)
                              ->firstOrFail(); 

        return view('pages.admin.evenement.update', compact('evenement'));
    }

    /* ***************************************************************
     * RENVOIE A LA PAGE LIST (LISTANT LES INSTANCES)
     * ***************************************************************/
    public function list(): View
    {
        $evenements = Evenement::where('status', true)->get();

        return view('pages.admin.evenement.list', compact('evenements'));
    }

    /* ***************************************************************
     * RENVOIE A LA PAGE DETAILS
     * ***************************************************************/
    public function details($id): View
    {
        $evenement = Evenement::where('id', $id)
                              ->where('status', true)
                              ->firstOrFail(); 

        return view('pages.admin.evenement.details', compact('evenement'));
    }



    /* ***************************************************************
     * TRAITE L' ENREGISTREMENT D' UNE INSTANCE
     * ***************************************************************/
    public function save(Request $request)
    {
        $request->validate([
            'type'               => ['required','in:journalier,periodique'],
            'model'              => ['required'],
            'titre'              => ['required'],
            'contenu'            => ['required'],
            'lieu'               => ['required'],
            'date_du_jour'       => ['required_if:type,journalier'],
            'periode_date_debut' => ['required_if:type,periodique'],
            'periode_date_fin'   => ['required_if:type,periodique'],
        ]);

        $evenement = Evenement::create([
            'type'               => $request->type,
            'model'              => $request->model,
            'titre'              => $request->titre,
            'date_du_jour'       => $request->type === 'journalier' ? $request->date_du_jour : null,
            'periode_date_debut' => $request->type === 'periodique' ? $request->periode_date_debut : null,
            'periode_date_fin'   => $request->type === 'periodique' ? $request->periode_date_fin : null,
            'lieu'               => $request->lieu,
            'contenu'            => $request->contenu,
        ]);

        $this->handleImages($request, $evenement);

        return redirect()->route('admin.evenement.list');
    }

    /* ***************************************************************
     * MODIFIE UNE INSTANCE DE LA BASE DE DONNEES
     * ***************************************************************/
    public function update_handler($id, Request $request)
    {
        $evenement = Evenement::where('id', $id)
                              ->where('status', true)
                              ->firstOrFail(); 

        $request->validate([
            'type'               => ['required','in:journalier,periodique'],
            'model'              => ['required'],
            'titre'              => ['required'],
            'contenu'            => ['required'],
            'lieu'               => ['required'],
            'date_du_jour'       => ['required_if:type,journalier'],
            'periode_date_debut' => ['required_if:type,periodique'],
            'periode_date_fin'   => ['required_if:type,periodique'],
        ]);

        $evenement->update([
            'type'               => $request->type,
            'model'              => $request->model,
            'titre'              => $request->titre,
            'date_du_jour'       => $request->type === 'journalier' ? $request->date_du_jour : null,
            'periode_date_debut' => $request->type === 'periodique' ? $request->periode_date_debut : null,
            'periode_date_fin'   => $request->type === 'periodique' ? $request->periode_date_fin : null,
            'lieu'               => $request->lieu,
            'contenu'            => $request->contenu,
        ]);

        $this->handleImages($request, $evenement);

        return redirect()->route('admin.evenement.list');
    }

    /* ***************************************************************
     * SUPPRIME (DESACTIVE) UNE INSTANCE DE LA BASE DE DONNEES
     * ***************************************************************/
    public function delete_one($id)
    {
        $evenement = Evenement::where('id', $id)
                              ->where('status', true)
                              ->firstOrFail(); 

        $evenement->update(['status' => false]);

        return redirect()->route('admin.evenement.list');
    }

    /* ***************************************************************
     * GESTION DES IMAGES ET SUPPRESSION
     * ***************************************************************/
    private function handleImages(Request $request, Evenement $evenement): void
    {
        $imageService = new ImageService();

        // Ajout d'images
        if (($request->hasFile('images') && count($request->file('images')) > 0) ||
            (!empty($request->iframes) && count($request->iframes) > 0)) {
            $imageService->saveMany($request, $evenement, 'evenement');
        }

        // Suppression d'images ou vignettes
        if ((!empty($request->remove_uploads_id) && count($request->remove_uploads_id) > 0) ||
            (!empty($request->remove_vgns_id) && count($request->remove_vgns_id) > 0)) {
            $imageService->deleteMany($request, $evenement);
        }
    }
}