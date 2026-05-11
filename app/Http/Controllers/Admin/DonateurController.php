<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Donateur;

class DonateurController extends Controller
{
    /* ***************************************************************
     * RENVOIE A LA PAGE LIST (LISTANT LES INSTANCES DONATEURS)
     * ***************************************************************/
    public function list(): View
    {
        $donateurs = Donateur::where('status', true)->get();

        return view('pages.admin.donateur.list', compact('donateurs'));
    }

    /* ***************************************************************
     * RENVOIE LA PAGE DETAILS
     * ***************************************************************/
    public function details($id): View
    {
        $donateur = Donateur::where('id', $id)
                            ->where('status', true)
                            ->firstOrFail();

        return view('pages.admin.donateur.details', compact('donateur'));
    }
}