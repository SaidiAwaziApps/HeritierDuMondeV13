<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Benevole;

class BenevoleController extends Controller
{
    /* ************************************************************
     * RENVOIE LE RESULTAT DE LA RECHERCHE
     * ***********************************************************/
    public function search($search) {
        $benevoles = Benevole::where('nom','LIKE','%'.$search.'%')
                             ->orWhere('prenom','LIKE','%'.$search.'%')
                             ->get();
        
        return response()->json(array('benevoles' => $benevoles));
    }

    /* ************************************************************
     * RENVOIE LA PAGE LIST (BENEVOLES)
     * ***********************************************************/
    public function list() {
        $benevoles = Benevole::where('status', true)->get();

        return view('pages.admin.benevole.list', [
            'benevoles' => $benevoles
        ]);    
    }

    /* ************************************************************
     * RENVOIE LA PAGE DETAILS
     * ***********************************************************/ 
    public function details($id) {
        $benevole = Benevole::where('id', $id)
                            ->where('status', true)
                            ->firstOrFail(); // 404 si non trouvé

        return view('pages.admin.benevole.details', [
            'benevole' => $benevole
        ]);
    }

    /* ************************************************************
     * TRAITE LE PROCESSUS ENREGISTREMENT
     * ***********************************************************/ 
    public function save(Request $request) {
        // Validation minimale pour sécuriser
        $request->validate([
            'nom' => ['required', 'string', 'max:255']
        ]);

        // Création du bénévole
        $benevole = Benevole::create([
            'nom' => $request->nom
        ]);

        // Redirection vers la liste avec message succès
        return redirect()->route('admin.benevole.list')
                         ->with('success', 'Bénévole ajouté avec succès !');
    }
}