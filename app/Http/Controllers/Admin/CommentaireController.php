<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use App\Services\FichierService;
use App\Services\AuteurService;
use App\Jobs\ModerateableJob;
use App\Models\Commentaire;
use App\Models\Objection;
use App\Models\Image;
use Exception;

class CommentaireController extends Controller
{
    /* ***************************************************************** 
     * DEFINIT L' AUTEUR DU COMMENTAIRE
     * *****************************************************************/
    private function getAuteur(Request $request)
    {
        return session('user')?->auteur;
    }

    /* ********************************************************************** 
     * ENREGISTRE (AJOUTE) D' UNE INSTANCE OBJECTION LIE A UN COMMENTAIRE
     * *********************************************************************/
    public function add_objection(int $id, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'texte' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $commentaire = Commentaire::where('id', $id)
                ->where('status', true)
                ->firstOrFail();

            $objection = $commentaire->objections()->save(new Objection([
                'auteur_id' => AuteurService::define($request)->id,
                'texte'     => $request->texte
            ]));

            // Gestion des fichiers
            if (!empty($request->fichiers) && $request->fichiers !== 'null') {
                FichierService::saveMany($request, $objection, 'objection');
            }

            // Système de modération automatique
            if ($objection->fichiers?->count() > 0) {
                ModerateableJob::dispatch($objection, null);
            } else {
                $objection->moderate(null);
            }

            return response()->json([
                'success'   => true,
                'objection' => $objection,
                'message'   => 'Réponse enregistrée !!!'
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success'   => false,
                'message'   => 'Échec de l\'enregistrement !!!'
            ], 500);
        }
    }

    /* ***************************************************************
     * TRAITE L' ENREGISTREMENT D' UNE INSTANCE COMMENTAIRE
     * ***************************************************************/
    public function save(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'texte' => ['required']
        ]);

        $commentaire = $this->morphModel($request)->commentaires()->save(new Commentaire([
            'auteur_id' => AuteurService::define($request)->id,
            'texte'     => $request->texte
        ]));

        // Gestion des images
        if (!empty($request->images) && $request->images !== 'null') {
            $images = [];
            foreach ($request->images as $image) {
                $images[] = new Image([
                    'titre' => 'Image pour commentaire',
                    'type'  => 'commentaire',
                    'path'  => Storage::disk('public')->put('commentaires', $image)
                ]);
            }
            $commentaire->images()->saveMany($images);
        }

        return redirect()->back()->with([
            'success_message' => 'Commentaire ajouté'
        ]);
    }

    /* ***************************************************************
     * SUPPRIME (DESACTIVE) UNE INSTANCE COMMENTAIRE
     * ***************************************************************/
    public function delete_one(int $id): JsonResponse
    {
        $commentaire = Commentaire::where('id', $id)
            ->where('status', true)
            ->firstOrFail();

        $commentaire->update(['status' => false]);

        return response()->json(['commentaire' => $commentaire], 200);
    }
}