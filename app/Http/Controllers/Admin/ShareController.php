<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Share;
use App\Models\Article;
use App\Models\Besoin;
use App\Models\Evenement;
use Validator;

class ShareController extends Controller
{
    /* *************************************************************
     * TRAITE L' ENREGISTREMENT D' UNE L'INSTANCE DANS LA B.D
     * *************************************************************/
    public function save(Request $request)
    {
        // Validation formulaire
        $validator = Validator::make($request->all(), [
            'shareable_type' => ['required'],
            'shareable_id'   => ['required', 'integer'],
            'media'          => ['required', 'string']
        ]);

        // En cas d'échec de validation
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toJson()]);
        }

        // Initialisation des variables
        $instance = null;
        $fullURL  = null;

        // Cas ressource article
        if ($request->shareable_type === 'App\\Models\\Article') {
            $instance = Article::findOrFail($request->shareable_id);
            $fullURL  = route('article.details', ['id' => $instance->id]);
        } 
        elseif ($request->shareable_type === 'App\\Models\\Besoin') {
            $instance = Besoin::findOrFail($request->shareable_id);
            $fullURL  = route('besoin.details', ['id' => $instance->id]);
        } 
        else {
            $instance = Evenement::findOrFail($request->shareable_id);
            $fullURL  = route('evenement.details', ['id' => $instance->id]);
        }

        // Initialise le tableau media
        $medias = [
            'facebook'  => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($fullURL),
            'twitter'   => 'https://twitter.com/intent/tweet?url=' . urlencode($fullURL),
            'instagram' => '', // Instagram ne supporte pas le partage direct via URL
            'whatsapp'  => 'https://api.whatsapp.com/send?text=' . urlencode($fullURL),
            'linkedin'  => 'https://www.linkedin.com/sharing/share-offsite/?url=' . urlencode($fullURL),
            'mail'      => 'mailto:?subject=Regarde cet article&body=' . urlencode($fullURL)
        ];

        // Vérifie que le media demandé existe
        $mediaKey = strtolower($request->media);
        $shareURL = $medias[$mediaKey] ?? $fullURL;

        // Enregistre le share (partage)
        $share = $instance->shares()->save(new Share([
            'media' => $mediaKey,
            'url'   => $shareURL
        ]));

        // Renvoie la réponse HTTP au client
        return response()->json(['share' => $share]);
    }
}