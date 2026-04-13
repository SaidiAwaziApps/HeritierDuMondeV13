<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\Objection;
use App\Models\Commentaire;
use App\Models\Image;
use Exception;

class ObjectionController extends Controller
{
    /* ***********************************************************
     * SUPPRIME (DESACTIVE) UNE INSTANCE OBJECTION
     * ***********************************************************/
    public function delete_one($id): JsonResponse {

        try {
            //Instance a supprimer
            $objection = Objection::where('id','=',$id)
                                ->where('status','=',true)
                                ->firstOrFail();

            //Execute la suppression
            $objection->update([
                'status' => false
            ]);

            //Renvoie a la page de provenance avec message de success
            return response()->json([
                'success'   => true,
                'objection' => $objection,
                'message'   => 'Reponse supprimee !!!'
            ]);
        }
        catch(Exception $e) {
            return response()->json([
                'success'   => false,
                'objection' => null,
                'message'   => $e->getMessage()
            ], 500);
        }                      
    }
}