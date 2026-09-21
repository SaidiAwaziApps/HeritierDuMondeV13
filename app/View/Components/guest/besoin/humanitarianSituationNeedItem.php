<?php

namespace App\View\Components\guest\besoin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class humanitarianSituationNeedItem extends Component
{
    public $besoin;

    /**
     * Create a new component instance.
     */
    public function __construct($besoin)
    {
        $this->besoin = $besoin;

        // Prépare les informations nécessaires aux images
        if ($this->besoin->images) {
            foreach ($this->besoin->images as $image) {
                $image->is_video = $this->isVideo($image->path);
            }
        }
    }

    /**
     * Vérifie si le fichier est une vidéo.
     */
    private function isVideo(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        $extensions = [
            'mp4',
            'mpeg',
            'avi',
            'mov',
            'wmv',
            'avchd',
            'flv',
            'f4v',
            'swf',
            'mkv',
            'webm',
        ];

        $extension = strtolower(
            pathinfo($path, PATHINFO_EXTENSION)
        );

        return in_array($extension, $extensions, true);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view(
            'components.guest.besoin.humanitarian-situation-need-item'
        );
    }
}
