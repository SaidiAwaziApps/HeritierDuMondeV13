<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\AccessRessource;
use App\Models\Ressource;
use App\Models\User;

class AccessRessourceController extends Controller
{
    protected $actions = ['register', 'delete', 'update', 'authorized'];
    protected $specialRessources = ['benevole', 'contact', 'don', 'donateur'];

    /* *************************************************************
     * RENVOIE A LA PAGE ENREGISTREMENT (REGISTER)
     * *************************************************************/
    public function register_page(int $user_id)
    {            
        return view('pages.admin.access_ressource.register', [
            'user' => User::getOne($user_id),
            'ressources' => Ressource::getAll()
        ]);
    }

    /* *************************************************************
     * RENVOIE A LA PAGE MODIFICATION (UPDATE)
     * *************************************************************/
    public function update_page(int $user_id)
    {       
        return view('pages.admin.access_ressource.update', [
            'user' => User::getOne($user_id),
            'ressources' => Ressource::getAll()
        ]);
    }

    /* *************************************************************
     * TRAITE L' ENREGISTREMENT (PROCESSUS)
     * *************************************************************/
    public function save(Request $request)
    {
        // L' utilisateur a definir les access
        $user = User::getOne($request->user_id);

        // Appel a methode privee store (enregistrement)
        $this->store($user->id, $request);

        // Renvoie a la page list pour users
        return redirect()->route('user.list');
    }

    /* *************************************************************
     * TRAITE LA MODIFICATION D' UNE INSTANCE (PROCESSUS)
     * *************************************************************/
    public function update_handler(int $user_id, Request $request) {
        // Utilisateur (avec privilegs)
        $user = User::where('id','=',$user_id)
                    ->where('status', '=', true)
                    ->firstOrFail();

        // Supprime tous les instances access_ressources (privileges)            
        foreach($user->access_ressources as $item) {
            $item->delete();
        }   
        
        // Appel a methode privee store (enregistrement)
        $this->store($user_id, $request);

        // Renvoie a la page de provenance
        return redirect()->route('user.list');
    }

    /* *************************************************************
     * ENREGISTRE LES INSTANCES DANS LA BASE DE DONNEES
     * *************************************************************/
    private function store(int $user_id, Request $request) {
        
        // Contenant les donnees au format object json (depuis le corps de la requette) 
        $accessObject = $request->access_ressources ?? [];

        // Contient donnees converties en tableau array
        $accessArray = [];

        // Parcourt ensemble du tableau && convertion (decodage)
        foreach($accessObject as $item) {
            array_push($accessArray, json_decode($item, true));
        }

        // Ensemble de ressource
        foreach(Ressource::getAll() as $ressource) {
            // Cas de ressource speciale
            if(in_array($ressource->nom, $this->specialRessources)) {
                $this->actions = ['authorized'];
            }  else {
                $this->actions = ['register','delete','update'];
            } 
           
            // Initialize la mention
            $mention = null;

            // Parcourt de ensemble des actions
            foreach($this->actions as $action) {
                $filterItem = array_filter($accessArray, function($item) use ($ressource, $action) {
                    return $item['ressource_id'] == $ressource->id && $item['action'] == $action; 
                });
                
                $mention = $filterItem ? 'allowed' : 'denied';
                
                AccessRessource::create([
                    'ressource_id' => $ressource->id,
                    'user_id' => $user_id,
                    'action' => $action,
                    'mention' => $mention
                ]);
            }
        }
    }
}