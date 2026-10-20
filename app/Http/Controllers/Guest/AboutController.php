<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Besoin;
use App\Models\Evenement;
use App\Models\Benevole;
use App\Models\Donateur;
use App\Models\Don;

use App\Models\Questionnement;

class AboutController extends Controller
{

    public function about_us() {

        // Benevoles
        $benevoles = Benevole::where('status','=',true)
                             ->get();

        // Donnees a renvoyer
        $besoins = Besoin::where('status', true)
                         ->get();
        // Evenements 
        $evenements = Evenement::where('status', true)
                               ->get();
        // Benevoles  
        $benevoles = Benevole::where('status', true)
                             ->get();
        // Donateurs          
        $donateurs = Donateur::where('status','=',true)
                  ->get();                     
        // Dons 
        $dons = Don::where('status', true)
                   ->get(); 
                   
         // Dons 
        $questionnements = Questionnement::where('status', true)
                                         ->get();            

        // Renvoie la page about
        return view('pages.guest.about.about_us', [
            'besoins' => $besoins,
            'evenements' => $evenements,
            'benevoles' => $benevoles,
            'donateurs' => $donateurs,
            'dons' => $dons,
            'questionnements' => $questionnements
        ]);
    }

}
