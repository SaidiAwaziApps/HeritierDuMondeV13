<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\OffreEmploie;

class OffreEmploieController extends Controller
{
    /* ***********************************************************
     * RENVOIE A LA PAGE D' ENREGISTREMENT
     * ***********************************************************/
    public function register(): View {
        return view('pages.offre_emploie.register');
    }

    
    /* ***********************************************************
     * RENVOIE A LA PAGE DE MODIFICATION
     * ***********************************************************/
    public function update_page($id): View {
        //Renvoie page
        return view('pages.offre_emploie.update',[
            'offre_emploie' => OffreEmploie::getOne($id)
        ]);
    }


    /* ***********************************************************
     * RENVOIE A LA PAGE LIST (OFFRES EMPLOIES) 
     * ***********************************************************/
    public function list(): View {
        // Recupere les offres
        $offre_emploies = OffreEmploie::where('status','=',true)
                                    ->get();

        //Renvoie page 
        return view('pages.offre_emploie.list',[
            'offre_emploies' => $offre_emploies
        ]);
    }


    /* ***********************************************************
     * TRAITE L' ENREGISTREMENT (pROCESSUS)
     * ***********************************************************/
    public function save(Request $request): RedirectResponse {
        // Validation formulaire
        $request->validate([
           'organisme'     => ['required','string'],
           'domaine'       => ['required','string'],
           'date_emission' => ['required','date'],
           'lieu'          => ['required','string'],
           'object'        => ['required','string'],
           'document'      => ['required','file'] 
        ]);

        //Stockage du fichier
        $document = $request->file('document')->store('documents','public');

        //Execute l'enregistrement
        OffreEmploie::create([
            'organisme'     => $request->organisme,
            'domaine'       => $request->domaine,
            'date_emission' => $request->date_emission,
            'lieu'          => $request->lieu,
            'object'        => $request->object,
            'document'      => $document
        ]);

        //Redirige a la page list offres emploies
        return redirect()->route('offre_emploie.list');
    }


    /* ***********************************************************
     * TRAITE LA MODIFICATION (PROCESSUS)
     * ***********************************************************/
    public function update($id,Request $request): RedirectResponse {
        // Validation du formulaire
        $request->validate([
            'organisme'     => ['required','string'],
            'domaine'       => ['required','string'],
            'date_emission' => ['required','date'],
            'lieu'          => ['required','string'],
            'object'        => ['required','string'],
            'document'      => ['nullable','file']
        ]);

        // Instance a modifier
        $offre_emploie = OffreEmploie::getOne($id);

        // Initialize la valeur document
        $document = $offre_emploie->document;

        // En cas de presence du fichier
        if($request->hasFile('document')) {
            $document = $request->file('document')->store('documents','public');
        } 

        // Execute la modification
        $offre_emploie->update([
            'organisme'     => $request->organisme,
            'domaine'       => $request->domaine,
            'date_emission' => $request->date_emission,
            'lieu'          => $request->lieu,
            'object'        => $request->object,
            'document'      => $document
        ]);

        // Redirige vers la page de list
        return redirect()->route('offre_emploie.list');
    }


    /* ***********************************************************
     * SUPPRIME (DESACTIVE) UNE INSTANCE DE LA BASE DES DONNEES
     * ***********************************************************/
    public function deleteOne($id): RedirectResponse {
        // Instance a supprimer(desactiver)
        $offre_emploie = OffreEmploie::getOne($id);

        // Sécurité (évite erreur si null)
        if(!$offre_emploie) {
            return redirect()->route('offre_emploie.list');
        }

        // Execute la suppresssion
        $offre_emploie->update([
            'status'=>false
        ]);

        // Returne a la page list
        return redirect()->route('offre_emploie.list');
    }
}