<?php

namespace App\View\Components\Sections;

use Illuminate\View\Component;
use Illuminate\View\View;

class ContactForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.sections.contact-form');
    }
}