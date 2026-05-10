<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class ImageService
{
    /**
     * Sauvegarde plusieurs images et iframes associées à un modèle.
     */
    public static function saveMany(Request $request, Model $model, string $type): void
    {
        $images = [];

        // ---- Gestion des fichiers uploadés ----
        $uploadedImages = $request->file('images') ?? [];
        foreach ($uploadedImages as $image) {
            $path = Storage::disk('public')->put($type, $image);
            $images[] = new Image([
                'titre' => $request->titre ?? null,
                'type' => $type,
                'img_source' => 'upload',
                'path' => $path,
            ]);
        }

        // ---- Gestion des iframes ----
        $iframes = $request->iframes ?? [];
        foreach ($iframes as $iframe) {
            if($iframe) {
                $images[] = new Image([
                    'titre' => $request->titre ?? null,
                    'type' => $type,
                    'img_source' => 'vignette',
                    'iframe' => $iframe,
                ]);
            }
        }

        // ---- Sauvegarde des images ----
        if (!empty($images)) {
            $model->images()->saveMany($images);
        }
    }

    /**
     * Supprime plusieurs images ou iframes associées à un modèle.
     */
    public static function deleteMany(Request $request, Model $model): void
    { 
        // ---- Supprime les images uploadées ----
        $removeUploads = $request->remove_uploads_id ?? [];
        foreach ($removeUploads as $id) {
            $image = $model->images->where('id', $id)->first();
            $image?->delete();
        }

        // ---- Supprime les iframes ----
        $removeVgns = $request->remove_vgns_id ?? [];
        foreach ($removeVgns as $id) {
            $image = $model->images->where('id', $id)->first();
            $image?->delete();
        }
    }
}