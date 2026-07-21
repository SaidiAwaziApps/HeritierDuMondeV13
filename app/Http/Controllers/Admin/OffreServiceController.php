<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OffreService;

class OffreServiceController extends Controller
{
    /* ********************************************************
     * RENVOIE A LA PAGE REGISTER  
     * *******************************************************/
    public function register_page() {
        return view('pages.admin.offre_service.register');
    }

    /* ********************************************************
     * RENVOIE A LA PAGE UPDATE  
     * *******************************************************/
    public function update_page($id) {
        // Instance a modifier
        $offre_service = OffreService::getOne($id);

        // Renvoie page update
        return view('pages.admin.offre_service.update', [
            'offre_service' => $offre_service
        ]);
    }

    /* ********************************************************
     * RENVOIE A LA PAGE LIST  
     * *******************************************************/
    public function list() {
        // Instances a afficher
        $offre_services = OffreService::where('status','=',true)
                                      ->get();

        return view('pages.admin.offre_service.list', [
            'offre_services' => $offre_services
        ]);
    }



    /* ********************************************************
     * TRAITE LE PROCESSUS D'ENREGISTREMENT
     * *******************************************************/
    public function save(Request $request) {
        // Validation de formulaire
        $request->validate([
            'intitule',
            'description'
        ]);

        // Sauvegarde
        OffreService::create([
            'intitule' => $request->intitule,
            'description' => $request->description
        ]);

        // Redirection vers la page list
        return redirect()->route('admin.offre_service.list');
    }

    /* ********************************************************
     * TRAITE LE PROCESSUS DE MODIFICATION (UPDATE)
     * *******************************************************/
    public function update_handler($id, Request $request) {
        // Validation du formulaire
        $request->validate([
            'intitule' => 'required',
            'description' => 'required'
        ]);

        // Instance a modifier
        $offre_service = OffreService::getOne($id);

        // Modification de l'instance
        $offre_service->update([
            'intitule' => $request->intitule,
            'description' => $request->description
        ]);

        // Renvoie a la page list
        return redirect()->route('admin.offre_service.list');
    }


    /* *************************************************************
     * SUPPRIME (DESACTIVE) UNE INSTANCE DE LA BASE DES DONNEES
     * *************************************************************/
    public function deleteOne($id) {
        // Instance a supprimer(desactiver)
        $offre_service = OffreService::getOne($id);

        // Sécurité (évite erreur si null)
        if(!$offre_service) {
            return redirect()->route('admin.offre_service.list');
        }

        // Execute la suppresssion
        $offre_service->update([
            'status' => false
        ]);

        // Returne a la page list
        return redirect()->route('admin.offre_service.list');
    }
}
