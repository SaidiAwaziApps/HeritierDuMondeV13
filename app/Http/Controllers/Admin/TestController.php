<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /* ***********************************************************
     * RENVOIE LA PAGE DE TOAST (TEST)
     * ***********************************************************/
    public function toast() {
        return view('test.toast');
    }
}