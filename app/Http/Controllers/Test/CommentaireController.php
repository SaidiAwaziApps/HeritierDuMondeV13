<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Identite;

class CommentaireController extends Controller
{
    public function register() {
        return view('pages.test.commentaire.register',[
            'identite'=>Identite::getOne(1),
            'admin'=>User::getOne(1)
        ]);
    }
}
