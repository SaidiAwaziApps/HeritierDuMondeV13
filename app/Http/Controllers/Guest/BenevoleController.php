<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Benevole;

class BenevoleController extends Controller
{
    /* **********************************************************
     * RENVOIE A LA PAGE LIST
     * **********************************************************/
    
    public function list() {
        // Instances a afficher
        $benevoles = Benevole::where('status', true)
                             ->get();
        // Renvoie la page
        return view('pages.guest.benevole.list', [
            'benevoles' => $benevoles
        ]);                     
    }

}
