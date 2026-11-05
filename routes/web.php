<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{LandingController, ContactController};
use App\Http\Controllers\Admin\{
    AuthController,
    DashboardController,
    ProjectController,
    ServiceController,
    CreatorController,
    TestimonialController,
    AnnouncementController
};

// Rute utama portofolio
Route::get('/', [LandingController::class, 'index'])->name('home');

// Pengalih Bahasa (Language Switcher ID <-> EN)
Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['id', 'en'])) {
        session(['locale' => $locale]);
        cookie()->queue(cookie()->forever('locale', $locale));
    }
    return redirect()->back();
})->name('lang.switch');

// Form pengiriman kontak
Route::post('/contact', [ContactController::class, 'submit'])->middleware('throttle:10,1')->name('contact.submit');

// Otentikasi Admin & Gerbang Keamanan
Route::get('/admin/login', [AuthController::class, 'loginForm'])->name('admin.login');
Route::get('/login', fn() => redirect()->route('admin.login'))->name('login');
Route::post('/admin/gate-verify', [AuthController::class, 'verifyGate'])->middleware('throttle:5,1')->name('admin.gate.verify');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Panel Admin (Terproteksi Autentikasi)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // CRUD Karya (Projects)
    Route::resource('projects', ProjectController::class)->names('admin.projects');

    // CRUD Keahlian (Services)
    Route::resource('services', ServiceController::class)->names('admin.services');

    // Kelola Profil Kreator
    Route::get('creator', [CreatorController::class, 'edit'])->name('admin.creator.edit');
    Route::post('creator', [CreatorController::class, 'update'])->name('admin.creator.update');

    // CRUD Ulasan Klien (Testimonials)
    Route::resource('testimonials', TestimonialController::class)->names('admin.testimonials');

    // CRUD Pengumuman Popup (Announcements)
    Route::resource('announcements', AnnouncementController::class)->names('admin.announcements');
    Route::post('announcements/{announcement}/toggle', [AnnouncementController::class, 'toggle'])->name('admin.announcements.toggle');
});
