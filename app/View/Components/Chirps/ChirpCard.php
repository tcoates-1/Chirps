<?php

namespace App\View\Components\Chirps;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChirpCard extends Component
{
    public $chirp;
    /**
     * Create a new component instance.
     */
    public function __construct($chirp)
    {
        $this->chirp = $chirp;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.chirps.chirp-card');
    }
}
