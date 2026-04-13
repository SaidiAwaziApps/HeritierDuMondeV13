<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Fichier;
use Illuminate\Database\Eloquent\Model;

class FichierService
{
    /**
     * Sauvegarde plusieurs fichiers attachés à un modèle.
     *
     * @param Request $request
     * @param Model $model
     * @param string $type
     */
    public static function saveMany(Request $request, Model $model, string $type): void
    {
        $fichiers = [];

        // Vérifie qu'il y a des fichiers uploadés
        $uploadedFiles = $request->file('fichiers') ?? [];

        foreach ($uploadedFiles as $fichier) {
            $path = Storage::disk('public')->put(
                $type === 'objection' ? 'commentaire' : $type,
                $fichier
            );

            $fichiers[] = new Fichier([
                'type' => $type,
                'path' => $path,
            ]);
        }

        // Sauvegarde les fichiers liés au modèle
        if (!empty($fichiers)) {
            $model->fichiers()->saveMany($fichiers);
        }
    }
}