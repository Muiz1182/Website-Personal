<?php

namespace App\View\Components\Sections;

use Illuminate\View\Component;
use Illuminate\View\View;

class SelectedWorks extends Component
{
    /**
     * @var array<int, array{title: string, category: string, description: string, image: string, span: string}>
     */
    public array $projects;

    /**
     * Kita menggunakan constructor untuk menerima data (Opsional)
     * atau men-set data default jika tidak ada data yang dikirim.
     */
    public function __construct(array $projects = [])
    {
        $this->projects = !empty($projects) ? $projects : $this->getPortfolioData();
    }

    /**
     * Metode untuk mengambil data default (Mock Data).
     * Jika aplikasi Anda menggunakan database, Anda bisa mengganti method ini
     * menjadi Project::orderBy('featured', 'desc')->get()->toArray().
     */
    protected function getPortfolioData(): array
    {
        return [
            [
                'title'       => 'PROJECT: VELOCITY',
                'category'    => 'Featured Work',
                'description' => 'Commercial editing and compositing for a supercar manufacturer.',
                'image'       => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=1000',
                'span'        => 'md:col-span-2'
            ],
            [
                'title'       => 'ATMOSPHERIC FLOW',
                'category'    => 'Cinematography',
                'description' => 'Abstract visual storytelling using 8K drone footage.',
                'image'       => 'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?q=80&w=600',
                'span'        => 'md:col-span-1'
            ],
        ];
    }

    public function render(): View
    {
        return view('components.sections.selected-works');
    }
}