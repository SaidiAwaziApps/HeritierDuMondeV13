<?php

namespace App\Services;

class NavigationService
{
    /**
     * Récupère l'URL de la page précédente à partir de l'historique de session.
     *
     * @return string|null
     */
    public static function getBackPageURL(): ?string
    {
        $history = session('history', []);

        if (empty($history)) {
            return null; // pas d'historique
        }

        // Si au moins 2 pages dans l'historique, on prend l'avant-dernière
        if (count($history) >= 2) {
            return $history[count($history) - 2]['url'] ?? null;
        }

        // Sinon, fallback sur la première page
        return $history[0]['url'] ?? null;
    }
}