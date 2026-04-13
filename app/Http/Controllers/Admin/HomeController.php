<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\View\View;
use App\Models\Identite;

class HomeController extends Controller
{
    /* **************************************************
     * PAGE DASHBOARD ADMIN
     * **************************************************/
    public function admin(): View
    {
        $identite = Identite::getOne(1);

        return view('pages.home.admin', compact('identite'));
    }
}