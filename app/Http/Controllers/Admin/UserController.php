<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Services\NavigationService;

use App\Models\User;
use App\Models\Auteur;
use App\Models\Role;
use App\Models\Identite;
use App\Models\Ressource;

class UserController extends Controller
{
    /* ************************************************************
     * RENVOIE LA PAGE LIST UTILISATEURS 
     * ************************************************************/
    public function list(){    
        return view('pages.user.list', [
            'users' => User::getAll()
        ]);           
    }

    /* ************************************************************
     * RENVOIE LA PAGE DETAILS
     * ************************************************************/
    public function details($id) 
    {
        // Utilisateur a detailler
        $user = User::getOne($id);

        // Rend visible le champ password
        $user->makeVisible(['password']);

        // Decrypt le mot de passe 
        try {
            $user->password = Crypt::decryptString($user->password);
        }
        catch(DecryptException $e){
            die($e->getMessage());
        }

        // Renvoie la page details
        return view('pages.user.details', [
           'ressources' => Ressource::getAll(), 
           'user'       => $user 
        ]);   
    }

    /* ************************************************************
     * RENVOIE LA PAGE ENREGISTREMENT
     * ************************************************************/
    public function register(){
        return view('pages.user.register');
    }

    /* ************************************************************
     * RENVOIE LA PAGE UPDATE
     * ************************************************************/
    public function update_page($id) {
        // Instance a modifier
        $user = User::getOne($id);

        // Rend visible le champ password
        $user->makeVisible(['password']);

        // Decrypt le mot de passe 
        try {
            $user->password = Crypt::decryptString($user->password);
        }
        catch(DecryptException $e){
            die($e->getMessage());
        }

        // Renvoie la page update
        return view('pages.user.update', [
            'user' => $user,
        ]);
    }

    /* ************************************************************
     * RENVOIE LA PAGE MON PROFIL
     * ************************************************************/
    public function my_profil(){
        return view('pages.user.my_profil', [
            'user' => User::getOne(1)
        ]);
    }

    /* ************************************************************
     * TRAITE ENREGISTREMENT INSTANCE
     * ************************************************************/
    public function save(Request $request) {
        // Validation formulaire
        $request->validate([
            'nom'      => ['required'],
            'prenom'   => ['required'],
            'email'    => ['required','email','unique:users'],
            'username' => ['required','min:4','max:20','unique:users'],
            'password' => ['required','min:8','max:20'],
            'roles'    => ['required']
        ]);

        // Initialise photo
        $photo = 'profils/user_icone.png';
        if($request->photo != null && $request->photo != 'null'){
            $photo = Storage::disk('public')->put('profils', $request->photo);
        }

        // Crée l'utilisateur
        $user = User::create([
            'nom'      => $request->nom,
            'prenom'   => $request->prenom,
            'email'    => $request->email,
            'username' => $request->username,
            'password' => Crypt::encryptString($request->password),
            'photo'    => $photo
        ]);

        // Associe à un compte auteur
        $user->auteur()->save(new Auteur(['type' => 'user']));

        // Associe des rôles
        foreach($request->roles as $role) {
            $user->roles()->attach([Role::findByRoleName($role)->id]);
        }

        // Redirection selon rôle
        if(in_array('admin', $request->roles)) {
            return redirect()->route('user.list');
        } else {
            return redirect()->route('access_ressource.register', [
                'user_id' => $user->id
            ]);
        }
    }

    /* ************************************************************
     * TRAITE LA MODIFICATION D' UNE INSTANCE
     * ************************************************************/
    public function update($id, Request $request){
        // Validation formulaire
        $request->validate([
            'nom'      => ['required'],
            'prenom'   => ['required'],
            'email'    => ['required','email'],
            'username' => ['required','min:4','max:20'],
            'password' => ['required','min:8','max:20'],
        ]);

        // Récupère l'utilisateur
        $user = User::getOne($id);

        // Initialise photo
        $photo = $user->photo;
        if($request->photo != null && $request->photo != 'null'){
            $photo = Storage::disk('public')->put('profils', $request->photo);
        }

        // Vérifie username et email uniques
        if(User::where('username', $request->username)->where('id', '!=', $user->id)->where('status', true)->first()){
            $route = $user->id == 1 ? 'user.my_profil' : 'user.update_page';
            return redirect()->route($route, $user->id == 1 ? [] : ['id'=>$user->id])
                             ->withErrors(['username_existed'=>'Username "'.$request->username.'" déjà attribué !!!'])
                             ->withInput();
        } elseif(User::where('email', $request->email)->where('id', '!=', $user->id)->where('status', true)->first()){
            $route = $user->id == 1 ? 'user.my_profil' : 'user.update_page';
            return redirect()->route($route, $user->id == 1 ? [] : ['id'=>$user->id])
                             ->withErrors(['email_existed'=>'Email "'.$request->email.'" déjà attribué !!!'])
                             ->withInput();
        } 

        // Modifie l'utilisateur
        $user->update([
            'nom'      => $request->nom,
            'prenom'   => $request->prenom,
            'email'    => $request->email,
            'username' => $request->username,
            'password' => Crypt::encryptString($request->password),
            'photo'    => $photo
        ]);

        // Redirection
        return $user->id == 1 ? redirect(NavigationService::getBackPageURL()) : redirect()->route('user.list');
    }

    /* ************************************************************
     * SUPPRIME (DESACTIVE) UNE INSTANCE
     * ************************************************************/
    public function delete_one($id) {
        // Instance a supprimer
        $user = User::getOne($id);
        // Applique la suppression (desactive)
        $user->update(['status' => false]);
        // Redirection vers la page list de users
        return redirect()->route('user.list');
    }
}