<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:check', function () {
    $user = \App\Models\User::where('email', 'admin@mmaproduction.com')->first();
    $this->info("Admin: " . ($user ? $user->email : 'NOT FOUND'));
    $this->info("Password check: " . ($user && \Illuminate\Support\Facades\Hash::check('admin1182', $user->password) ? 'VALID' : 'INVALID'));
    $this->info("Projects: " . \App\Models\Project::count());
    $this->info("Services: " . \App\Models\Service::count());
    $this->info("Creator: " . (\App\Models\CreatorProfile::first() ? \App\Models\CreatorProfile::first()->name : 'NONE'));
    $this->info("Testimonials: " . \App\Models\Testimonial::count());
});
