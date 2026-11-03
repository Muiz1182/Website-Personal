<?php

namespace App\View\Components\Sections;

use Illuminate\View\Component;
use Illuminate\View\View;

class TechnicalMastery extends Component
{
    /**
     * @var array<int, array{number: string, title: string, description: string, percentage: int}>
     */
    public array $services;

    /**
     * Komponen sekarang menerima data melalui parameter constructor.
     * Kita memberikan nilai default array kosong agar tidak error jika tidak ada data.
     */
    public function __construct(array $services = [])
    {
        $this->services = $services;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.sections.technical-mastery');
    }
}