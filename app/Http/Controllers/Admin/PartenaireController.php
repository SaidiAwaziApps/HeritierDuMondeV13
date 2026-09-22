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
}
