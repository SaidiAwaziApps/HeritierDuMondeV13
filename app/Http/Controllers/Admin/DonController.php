<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\View\View;
use App\Models\Don;

class DonController extends Controller
{
    /* ***************************************************************
     * RENVOIE LA PAGE LIST (AFFICHANT LES INSTANCES DONS)
     * ***************************************************************/
    public function list(): View
    {
        $dons = Don::where('status', true)->get();

        return view('pages.don.list', compact('dons'));
    }

    /* ***************************************************************
     * TRAITE L' ENREGISTREMENT D' UNE INSTANCE COMMENTAIRE
     * ***************************************************************/
    public function details(Don $don): View
    {
        // Vérifie que le don est actif
        abort_if(!$don->status, 404);

        return view('pages.don.details', compact('don'));
    }
}
