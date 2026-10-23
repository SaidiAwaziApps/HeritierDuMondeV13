<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\Notifications\RegisterBenevoleNotification;

use App\Models\Benevole;
use App\Models\Sociaux;

use App\Models\User;

class BenevoleController extends Controller
{
    /* **********************************************************
     * RENVOIE A LA PAGE LIST
     * **********************************************************/
    public function list() {
        // Instances a afficher
        $benevoles = Benevole::where('status', true)
                             ->get();
        // Renvoie la page
        return view('pages.guest.benevole.list', [
            'benevoles' => $benevoles
        ]);                     
    }


    /* **********************************************************
     * RENVOIE A LA PAGE ENREGISTREMENT (REGISTER)
     * **********************************************************/
    public function register() {
        // Renvoie la page
        return view('pages.guest.benevole.register');
    }




    /* **********************************************************
     * SAUVEGARGE UN BENEVOLE (SAVE)
     * **********************************************************/
    public function save(Request $request) {

        // Validation du formulaire
        $request->validate([
            'nom' => ['required'],
            'prenom' => ['required'],
            'sexe' => ['required', 'in:M,F'],
            'tel' => ['required'],
            'email' => ['required', 'email', 'unique:benevoles,email'],
            'pays' => ['required'],
            'ville' => ['required'],
            'profession' => ['required'],
            'competences' => ['required'],
            'langues' => ['required'],
            'disponibilite' => ['required'],
            'domaines_intervention' => ['required', 'array', 'min:1'],
            'domaines_intervention.*' => ['required', 'string'],
            'motivation' => ['required'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp'],
        ]);

        // Var photo
        $photo = '';

        // Cas photo existante
        if($request->hasFile('photo')) {
            $photo = Storage::disk('public')->put('benevoles', $request->photo);
        }

        // Sauvegarde 
        $benevole = Benevole::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'sexe' => $request->sexe,
            'tel' => $request->tel,
            'email' => $request->email,
            'pays' => $request->pays,
            'ville' => $request->ville,
            'profession' => $request->profession,
            'competences' => $request->competences,
            'experience' => $request->experience,
            'langues' => $request->langues,
            'disponibilite' => $request->disponibilite,
            'domaines_intervention' => implode(',' ,$request->domaines_intervention),
            'motivation' => $request->motivation,
            'photo' => $photo
        ]);

        // Associe benevoles au model sociaux
        if($request->facebook || $request->twitter || $request->instagram || $request->linkedIn) {

            $benevole->sociaux()->save(new Sociaux([
                'facebook'  => $request->facebook,
                'twitter'   => $request->twitter,
                'instagram' => $request->instagram,
                'linkedIn'  => $request->linkedIn
            ]));

        }

        // Administrateurs ($users) 
        $users = User::where('status', '=', true)
                     ->get();

        // Envoies notifications a tous les administrateurs (users)             
        foreach($users as $user) {
            $user->notify(new RegisterBenevoleNotification($benevole));
        }             

        // Renvoie a la page de provenance avec message de success
        return redirect()->back()->with('success', 'Votre candidature est en attente d\'approbation. Vous recevrez la notification via votre email.');  


    }

}
