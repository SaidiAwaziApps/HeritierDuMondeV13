<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\View\View;

class HomeController extends Controller
{
    /* **************************************************
     * PAGE DASHBOARD ADMIN
     * **************************************************/
    public function admin(): View
    {
        return view('pages.admin.home.admin');
    }
}