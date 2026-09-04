<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Benevole;
use App\Models\Besoin;
use App\Models\Don;
use App\Models\Donateur;
use App\Models\Evenement;

class HomeController extends Controller
{

    public function home() {
        // Benevoles
        $benevoles = Benevole::where('status','=',true)
                             ->get();

        // Besoins                     
        $besoins = Besoin::where('status','=',true)
                         ->get();

        // Dons                    
        $dons = Don::where('status','=',true)
                  ->get();

        // Donateurs          
        $donateurs = Donateur::where('status','=',true)
                  ->get();

        // Evenements            
        $evenements = Evenement::where('status','=',true)
                  ->get();  
                  
        /* ---- Renvoie la page accueil (home) ---- */
        return view('pages.guest.home.index', [
            'benevoles'  => $benevoles,
            'besoins'    => $besoins,
            'dons'       => $dons,
            'donateurs'  => $donateurs,
            'evenements' => $evenements
        ]);          
    }
}
