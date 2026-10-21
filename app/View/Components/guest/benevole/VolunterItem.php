<?php

namespace App\View\Components\guest\benevole;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VolunterItem extends Component
{
    public $benevole;

    /**
     * Create a new component instance.
     */
    public function __construct($benevole)
    {
        $this->benevole = $benevole;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.guest.benevole.volunter-item');
    }
}
