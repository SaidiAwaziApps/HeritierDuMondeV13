<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Partenaire;

class PartenaireController extends Controller
{
    /* *************************************************************
     * RENVOIE LA PAGE REGISTER (ENREGISTREMENT)
     * ************************************************************/
    public function register_page() {
        return view('pages.admin.partenaire.register');
    }



    /* *************************************************************
     * SAUVEGARDE UNE INSTANCE (SAVE)
     * ************************************************************/
    public function save(Request $request) {
        // Validation du formulaire
        $request->validate([
            'nom' => ['required', 'string'],
            'partner_type' => ['required', 'string'],
            'logo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

    }
}
