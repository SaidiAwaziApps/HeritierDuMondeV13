<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use App\Models\Categorie;

class CategorieController extends Controller
{
    /* ********************************************************************** 
     * VALIDATION DU FORMULAIRE
     * *********************************************************************/
    private function validator(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), [
            'ctg_name' => ['required'],
            'ctg_type' => ['required']
        ]);
    }

    /* ********************************************************************** 
     * TRAITE L' ENREGISTREMENT D' UNE INSTANCE
     * *********************************************************************/
    public function save(Request $request): JsonResponse
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 200);
        }

        $categorie = Categorie::create([
            'ctg_name' => $request->ctg_name, // Nom categorie
            'ctg_type' => $request->ctg_type // Type categorie
        ]);

        return response()->json([
            'categorie' => $categorie
        ], 200);
    }
}