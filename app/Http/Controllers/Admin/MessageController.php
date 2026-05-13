<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Events\ContactMessageEvent;
use App\Jobs\SendContactMessageMailJob;
use App\Models\Message;
use App\Models\Auteur;
use App\Models\Fichier;

use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /* *******************************************************************
     * GENERE OU PROPOSE UN CODE SERIE DESTINEE A UN GROUPE DE MESSAGE
     * *******************************************************************/
    private function getAuthSerialCode($expediteur): string {
        // Groupe de messages non lus
        $messages = Auteur::find(1)?->messagesEnvoyes?->filter(function($item) {
            return $item->readed == false;
        });

        if ($messages && $messages->count() > 0) {
            // Retourne le code du dernier message non lu
            return $messages->last()->auth_serial_code;        
        } else {
            // Génère un nouveau code si aucun message non lu
            return $expediteur->id . '-' . random_int(100000, 1000000) . '-' . random_int(10, 100);
        }
    } 

    /* ***********************************************************
     * RECUPERE UNE INSTANCE (MESSAGE) DE LA BASE DE DONNEES
     * ***********************************************************/
    public function getOne($id): JsonResponse {
        $message = Message::where('status','=',true)
                          ->where('id', '=', $id) // correction importante
                          ->first();

        return response()->json(array('message' => $message));                  
    }

    /* ***********************************************************
     * RECUPERE DES INSTANCES (MESSAGE) DE LA BASE DE DONNEES
     * ***********************************************************/
    public function getAll(): JsonResponse {
        $messages = Message::where('status','=',true)
                          ->get();

        return response()->json(array('messages' => $messages));                    
    }

    /* ***********************************************************
     * ENREGISTRE UNE INSTANCE (MESSAGE) DANS LA BASE DE DONNEES
     * ***********************************************************/
    public function save(Request $request): JsonResponse {
        // Validation du formulaire (test)
        $validator = Validator::make($request->all(), [
            'texte' => ['required','string'],
            'fichiers.*' => ['file','max:4096'] 
        ]);
        
        // Echec de validation du formulaire
        if($validator->fails()) {
            return response()->json(array(
                'errors'=> $validator->errors()
            ), 422);
        }

        $expediteur = null; // Initialization de la variable expediteur
        $destinateur = null; // Initialization de la varianle destinareur

        // En cas d' utilisateur connecte
        $expediteur = Auth::user()?->auteur;

        if($request->filled('destinateur')) {
            $destinateur = json_decode($request->destinateur,true);   
        }                         

        // Creer une instance message
        $message = Message::create([
            'expediteur_id' => $expediteur->id,
            'texte' => $request->texte,
            'auth_serial_code' => $this->getAuthSerialCode($expediteur)
        ]);

        // En cas d' utilistaur connecte
        if($destinateur && isset($destinateur['id'])) {
            $message->destinateurs()->attach([$destinateur['id']]);
        }

        // En cas de presence de fichier
        if($request->hasFile('fichiers')) {
            $fichiers = []; // Initialize le tableau de fichiers

            // Parcourt de l' ensemble des elements du tableau 
            foreach($request->file('fichiers') as $file) {
                $path = $file->store('messages', 'public');

                $fichiers[] = new Fichier([
                   'type' => 'message',
                   'titre' => 'Fichier Messagerie',
                   'path' => $path
                ]); 
            }

            // Enregistre les instances
            $message->fichiers()->saveMany($fichiers);
        }

        // Emet evenement ContactMessageEvent
        // event(new ContactMessageEvent($message));

        // En cas d'utilisateur connecte  
        SendContactMessageMailJob::dispatch($message);
        
        // Renvoie la reponse HTTP au client
        return response()->json(array('message' => $message));
    }

    /* ***********************************************************************
     * MODIFIE LA MENTION READED D' UN GROUP DE MESSAGE LIE A UN EXPEDITEUR
     * ***********************************************************************/
    public function setAuthReadedGroupMessage($auth_serial_code, Request $request): JsonResponse {
        // Validation du formulaire
        $validation = Validator::make($request->all(),[
            'readed' => ['required','boolean']
        ]);

        // En cas d' echec de validation
        if($validation->fails()) {
            return response()->json(array(
                'errors' => $validation->errors()
            ), 422);
        }

        // Recupere le groupe des message
        $messages = Message::where('auth_serial_code','=',$auth_serial_code)
                           ->where('status','=',true)
                           ->get();

        // Parcourt de l' ensemble des instances messages
        foreach($messages as $message) {
            $message->update([
                'readed' => (bool) $request->readed
            ]);
        } 

        // Renvoie la reponse HTTP au client
        return response()->json(array('messages' => $messages));
    }
}