<?php

if (! function_exists('isVideo')) {
    /**
     * Vérifie si un fichier est une vidéo.
     *
     * @param string|null $path
     * @return bool
     */
    function isVideo(?string $path): bool
    {
        // Aucun chemin fourni
        if (empty($path)) {
            return false;
        }

        // Récupère l'extension du fichier
        $extension = strtolower(
            pathinfo($path, PATHINFO_EXTENSION)
        );

        // Extensions vidéo autorisées
        $videoExtensions = [
            'mp4',
            'webm',
            'ogg',
            'mov',
            'm4v',
            'avi',
            'mkv',
        ];

        // Retourne true si l'extension est une vidéo
        return in_array(
            $extension,
            $videoExtensions,
            true
        );
    }
}
