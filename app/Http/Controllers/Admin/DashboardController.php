<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use App\Models\CreatorProfile;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman utama overview panel admin.
     */
    public function index()
    {
        $counts = [
            'projects'     => Project::count(),
            'services'     => Service::count(),
            'testimonials' => Testimonial::count(),
            'creator'      => CreatorProfile::first() ? 1 : 0,
        ];

        $recentProjects = Project::orderBy('id', 'desc')->take(4)->get();
        $creator = CreatorProfile::first();

        return view('admin.dashboard', compact('counts', 'recentProjects', 'creator'));
    }
}

