<?php

namespace App\View\Components\Sections;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Hero extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title = 'MMA PRODUCTION',
        public string $subtitle = 'High-octane Visual engineering for the world\'s most ambitious brands.',
        public string $ctaLabel = 'SEE OUR WORK'
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sections.hero');
    }
}