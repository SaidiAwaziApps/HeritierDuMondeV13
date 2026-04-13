<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\View\View;
use App\Models\Benevole;
use App\Models\Donateur;
use App\Models\Besoin;
use App\Models\Don;
use App\Models\Evenement;
use App\Models\OffreEmploie;

class DashboardController extends Controller
{
    /* **************************************************
     * PAGE DASHBOARD POUR ADMIN
     * **************************************************/
    public function admin(): View
    {
        // Instances Benevoles
        $benevoles = Benevole::where('status', true)->get();

        // Instances Donateurs avec leurs dons actifs
        $donateurs = Donateur::where('status', true)
            ->with(['dons' => fn($query) => $query->where('status', true)])
            ->get();

        // Instances Besoins
        $besoins = Besoin::where('status', true)->get();

        // Instances Dons avec donateur
        $dons = Don::where('status', true)->with('donateur')->get();

        // Instances Evenements
        $evenements = Evenement::where('status', true)->get();

        // Instances OffreEmploies
        $offre_emploies = OffreEmploie::where('status', true)->get();

        return view('pages.admin.dashboard.admin', compact(
            'benevoles',
            'donateurs',
            'besoins',
            'dons',
            'evenements',
            'offre_emploies'
        ));
    }

    /* **************************************************
     * PAGE DASHBOARD POUR USER
     * **************************************************/
    public function user(): View
    {
        return view('pages.admin.dashboard.user');
    }
}