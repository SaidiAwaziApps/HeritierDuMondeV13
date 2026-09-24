<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\Models\Partenaire;
use App\Models\Sociaux;

class PartenaireController extends Controller
{
    /* *************************************************************
     * RENVOIE LA PAGE REGISTER (ENREGISTREMENT)
     * ************************************************************/
    public function register_page() {
        return view('pages.admin.partenaire.register');
    }

    
    /* *************************************************************
     * RENVOIE LA PAGE MODIFICATION (UPDATE)
     * ************************************************************/
    public function update_page($id) {
        // Instance a modifier
        $partenaire = Partenaire::where('id', $id)
                                ->where('status', true)
                                ->firstOrFail();
        
        // Renvoie la page update                        
        return view('pages.admin.partenaire.update', [
            'partenaire' => $partenaire
        ]);
    }

    /* *************************************************************
     * RENVOIE LA PAGE LIST
     * ************************************************************/
    public function list() {
        // Instances a afficher (lister)
        $partenaires = Partenaire::where('status', true)
                                 ->get();

        // Renvoie la page
        return view('pages.admin.partenaire.list', [
            'partenaires' => $partenaires
        ]);                         
    }



    /* *************************************************************
     * SAUVEGARDE UNE INSTANCE (SAVE)
     * ************************************************************/
    public function save(Request $request) {
        // Validation du formulaire
        $request->validate([
            'identite_id' => ['required'],
            'nom' => ['required', 'string'],
            'partner_type' => ['required', 'string'],
            'logo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Stockage de l'image (logo)
        $logo = Storage::disk('public')->put('logo', $request->logo);

        // Sauvegarde une instance partenaire
        $partenaire = Partenaire::create([
            'identite_id' => $request->identite_id,
            'nom' => $request->nom,
            'partner_type' => $request->partner_type,
            'site_web' => $request->site_web,
            'description' => $request->description,
            'logo' => $logo
        ]); 

        // Presence d'au moins un element de reseau sociaux
        if($request->facebook || $request->twitter || $request->linkedIn || $request->instagram) {

            $partenaire->sociaux()->save(new Sociaux([
                'facebook'  => $request->facebook,
                'twitter'   => $request->twitter,
                'linkedIn'  => $request->linkedIn,
                'instagram' => $request->instagram
            ]));

        }

        // Redirige a la page list
        return redirect()->route('admin.partenaire.list');

    }


    /* *************************************************************
     * TRAITE && EXECUTE LA MODIFICATION (UPDATE)
     * ************************************************************/
    public function update_handler($id, Request $request) {
        // Validation du formulaire
        $request->validate([
            'nom' => ['required', 'string'],
            'partner_type' => ['required', 'string'],
            'logo' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Instance a modifier
        $partenaire = Partenaire::where('id', $id)
                                ->where('status', true)
                                ->firstOrFail();

        // Initialise $logo
        $logo = null;

        // Cas de chargement de l'image (logo) 
        if($request->hasFile('logo')) {
            $logo = Storage::disk('public')->put('logo', $request->logo); 
        } else {
            $logo = $partenaire->logo;
        }                        
        
        // Applique la modification de l'instance
        $partenaire->update([
            'nom' => $request->nom,
            'partner_type' => $request->partner_type,
            'site_web' => $request->site_web,
            'description' => $request->description,  
            'logo' => $logo
        ]);   
        
        // Presence d'au moins un element de reseau sociaux
        if($request->facebook || $request->twitter || $request->linkedIn || $request->instagram) {

            $partenaire->sociaux->update([
                'facebook'  => $request->facebook,
                'twitter'   => $request->twitter,
                'linkedIn'  => $request->linkedIn,
                'instagram' => $request->instagram
            ]);

        }

        // Redirige vers la page list
        return redirect()->route('admin.partenaire.list');
    }

    /* *************************************************************
     * TRAITE && EXECUTE LA SUPPRESSION (DESACTIVATED)
     * ************************************************************/
    public function delete_one($id) {
        // Instance a supprimer (desactiver)
        $partenaire = Partenaire::where('id', $id)
                                ->where('status', true)
                                ->firstOrFail();

        // Execute la suppression (desactivation)
        $partenaire->update([
            'status' => false
        ]);
        
        // Redirige a la page list
        return redirect()->route('admin.partenaire.list');
    }
}
