<?php

namespace App\Services;

use App\Models\Evenement;
use App\Models\Don;
use App\Models\OffreEmploie;

class DashboardService {

    /* *****************************************************************
     * VERIFIE LA CREDIBILITE D'UN DASHBOARD
     * *****************************************************************/
    public static function isCredible() {
        return Evenement::where('status', true)->exists()
            && Don::where('status', true)->exists()
            && OffreEmploie::where('status', true)->exists();
    }
}