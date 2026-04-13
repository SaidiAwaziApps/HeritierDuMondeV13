<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Moderation;
use App\Models\Commentaire;
use App\Models\Objection;
use Illuminate\Support\Facades\Validator;

class ModerationController extends Controller
{
    /* ***********************************************************
     * DEFINIT (ENREGISTRE) UNE INSTANCE MODERATION 
     * ***********************************************************/
    public function define(Request $request): JsonResponse {
        //Validation du formulaire
        $validator = Validator::make($request->all(),[
            'moderateable_type' => ['required','string','in:commentaire,objection'],
            'moderateable_id'   => ['required','integer'],
            'mention'           => ['required','string','max:255'],
        ]);

        //En cas d' echec de validation
        if($validator->fails()) {
            return response()->json(array(
                'errors' => $validator->errors()
            ), 422);
        } 

        //Initialisation de la variable
        $moderateable = null;

        //Le bon model(moderateable)
        if(strtolower($request->moderateable_type) == 'commentaire') {
            $moderateable = Commentaire::findOrFail($request->moderateable_id);
        } else {
            $moderateable = Objection::findOrFail($request->moderateable_id);
        }

        //Applique la moderation
        $moderation = $moderateable->moderate($request->mention);
        
        //Renvoie la reponse HTTP au client
        return response()->json([
            'moderation' => $moderation->load('moderateable')
        ]);
    }

    /* ***********************************************************
     * MODIFIE UNE INSTANCE MODERATION EXISTANTE
     * ***********************************************************/
    public function update($id,Request $request): JsonResponse {
        //Validation du formulaire
        $validator = Validator::make($request->all(),[
            'mention' => ['required','string','max:255'],
        ]);

        //En cas d' echec de validation
        if($validator->fails()) {
            return response()->json(array(
                'errors' => $validator->errors()
            ), 422);
        } 

        //Instance a modifier
        $moderation = Moderation::where('id','=',$id)
                                ->where('status','=',true)
                                ->firstOrFail();                    

        //Applique la moderation
        $moderation->update([
            'mention' => $request->mention
        ]);  

        //Charge le bon model
        $moderation->load('moderateable');  

        //Renvoie la reponse http au client
        return response()->json(array('moderation' => $moderation));                       
    }
}