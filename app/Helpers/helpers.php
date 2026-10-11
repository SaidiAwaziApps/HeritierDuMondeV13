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




if (! function_exists('oneBesoinDonateStat')) {
    /**
     * Renvoie les stats pour besoin
     *
     * @param string|null $path
     * @return array
     */
    function oneBesoinDonateStat($besoin)
    {
        $receivedAmount = 0;

        foreach ($besoin->besoinDons as $item) {
            if ($item && $item->don && $item->don->reception) {
                $receivedAmount += $item->don->montant;
            }
        }

        $targetAmount = (float) $besoin->montant;

        $receivedAmountPourcent = $targetAmount > 0
            ? ($receivedAmount * 100) / $targetAmount
            : 0;

        return [
            'receivedAmount' => number_format($receivedAmount, 1),
            'receivedAmountPourcent' => number_format($receivedAmountPourcent, 1),
            'notReceivedAmount' => number_format($targetAmount - $receivedAmount, 1),
            'notReceivedAmoutPourcent' => number_format(100 - $receivedAmountPourcent, 1)
        ];
    }
}
