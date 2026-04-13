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
    public function register($user_id)
    {
        return view('pages.access_ressource.register', [
            'user' => User::getOne($user_id),
            'ressources' => Ressource::getAll()
        ]);
    }

    /* *************************************************************
     * RENVOIE A LA PAGE MODIFICATION (UPDATE)
     * *************************************************************/
    public function update_page($user_id)
    {
        return view('pages.access_ressource.update', [
            'user' => User::getOne($user_id),
            'ressources' => Ressource::getAll()
        ]);
    }

    /* *************************************************************
     * TRAITE L' ENREGISTREMENT (PROCESSUS)
     * *************************************************************/
    public function save(Request $request)
    {
        $accessItems = $request->access_ressources ?? [];

        foreach (Ressource::getAll() as $ressource) {
            foreach ($this->actions as $action) {
                $mention = $this->determineMention($ressource, $action, $accessItems);

                AccessRessource::create([
                    'ressource_id' => $ressource->id,
                    'user_id' => $request->user_id,
                    'action' => $action,
                    'mention' => $mention
                ]);
            }
        }

        return redirect()->route('user.register', ['user_id' => $request->user_id]);
    }

    /* *************************************************************
     * TRAITE LA MODIFICATION D' UNE INSTANCE (PROCESSUS)
     * *************************************************************/
    public function update($user_id, Request $request)
    {
        $accessItems = $request->access_ressources ?? [];

        foreach (Ressource::getAll() as $ressource) {
            foreach ($this->actions as $action) {
                $mention = $this->determineMention($ressource, $action, $accessItems);

                $accessRessource = AccessRessource::where('ressource_id', $ressource->id)
                    ->where('user_id', $user_id)
                    ->where('action', $action)
                    ->first();

                if ($accessRessource) {
                    $accessRessource->update(['mention' => $mention]);
                }
            }
        }

        return redirect()->route('user.list');
    }

    /* *************************************************************
     * DÉTERMINE LA MENTION POUR UNE RESSOURCE ET ACTION
     * *************************************************************/
    private function determineMention($ressource, $action, array $accessItems)
    {
        $mention = 'denied';

        foreach ($accessItems as $item) {
            [$resId, $act] = explode(',', $item);
            if ($resId == $ressource->id && $act == $action) {
                return 'allowed';
            }
        }

        if (in_array($ressource->nom, $this->specialRessources)) {
            $mention = 'not define';
        }

        return $mention;
    }
}