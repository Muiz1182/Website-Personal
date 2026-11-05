<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Tampilkan daftar ulasan klien.
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Formulir tambah ulasan klien baru.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Simpan ulasan klien baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'role'    => ['nullable', 'string', 'max:255'],
            'project' => ['nullable', 'string', 'max:255'],
            'quote'   => ['required', 'string'],
            'order'   => ['nullable', 'integer'],
            'status'  => ['nullable', 'string', 'in:published,draft'],
        ]);

        $testimonial = Testimonial::create([
            'name'    => $validated['name'],
            'role'    => $validated['role'] ?? null,
            'project' => $validated['project'] ?? null,
            'quote'   => $validated['quote'],
            'order'   => $validated['order'] ?? 0,
            'status'  => $validated['status'] ?? 'published',
        ]);

        try {
            $translator = app(\App\Services\AutoTranslationService::class);
            $translator->translate($testimonial->role);
            $translator->translate($testimonial->project);
            $translator->translate($testimonial->quote);
        } catch (\Throwable $e) {}

        return redirect()->route('admin.testimonials.index')->with('status', 'Ulasan klien berhasil ditambahkan.');
    }

    /**
     * Formulir edit ulasan klien.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Perbarui ulasan klien.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'role'    => ['nullable', 'string', 'max:255'],
            'project' => ['nullable', 'string', 'max:255'],
            'quote'   => ['required', 'string'],
            'order'   => ['nullable', 'integer'],
            'status'  => ['nullable', 'string', 'in:published,draft'],
        ]);

        $testimonial->update([
            'name'    => $validated['name'],
            'role'    => $validated['role'] ?? null,
            'project' => $validated['project'] ?? null,
            'quote'   => $validated['quote'],
            'order'   => $validated['order'] ?? 0,
            'status'  => $validated['status'] ?? 'published',
        ]);

        try {
            $translator = app(\App\Services\AutoTranslationService::class);
            $translator->translate($testimonial->role);
            $translator->translate($testimonial->project);
            $translator->translate($testimonial->quote);
        } catch (\Throwable $e) {}

        return redirect()->route('admin.testimonials.index')->with('status', 'Ulasan klien berhasil diperbarui.');
    }

    /**
     * Hapus ulasan klien.
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('status', 'Ulasan klien berhasil dihapus.');
    }
}

