<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Message;

class ContactController extends Controller
{
    /* ***************************************************************
     * RENVOIE LA PAGE INDEX
     * ***************************************************************/
    public function index(): View
    {
        // Instances à afficher
        $messages = Message::where('status', true)->get();

        return view('pages.contact.admin.index', [
            'app_url' => config('app.url'),
            'storage_path_url' => config('app.storage_path_url'),
            'messages' => $messages
        ]);
    }    
}