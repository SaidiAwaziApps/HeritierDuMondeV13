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

        return view('pages.admin.don.list', compact('dons'));
    }

    /* ***************************************************************
     * TRAITE L' ENREGISTREMENT D' UNE INSTANCE COMMENTAIRE
     * ***************************************************************/
    public function details($id): View
    {
        $don = Don::where('id', $id)
                  ->where('status', true)
                  ->firstOrFail();

        return view('pages.admin.don.details', compact('don'));
    }
}
