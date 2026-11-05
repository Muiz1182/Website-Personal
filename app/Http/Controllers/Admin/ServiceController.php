<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Tampilkan daftar keahlian / layanan.
     */
    public function index()
    {
        $services = Service::orderBy('order', 'asc')->orderBy('id', 'asc')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Formulir tambah keahlian baru.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Simpan keahlian baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'number'       => ['required', 'string', 'max:10'],
            'title'        => ['required', 'string', 'max:255'],
            'tagline'      => ['nullable', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'deliverables' => ['nullable', 'string'],
            'order'        => ['nullable', 'integer'],
            'status'       => ['nullable', 'string', 'in:published,draft'],
        ]);

        $deliverablesArray = [];
        if (!empty($validated['deliverables'])) {
            $deliverablesArray = array_values(array_filter(
                array_map('trim', preg_split('/\r\n|\r|\n/', $validated['deliverables'])),
                fn($line) => $line !== ''
            ));
        }

        $service = Service::create([
            'number'       => $validated['number'],
            'title'        => $validated['title'],
            'tagline'      => $validated['tagline'] ?? null,
            'description'  => $validated['description'],
            'deliverables' => $deliverablesArray,
            'order'        => $validated['order'] ?? 0,
            'status'       => $validated['status'] ?? 'published',
        ]);

        try {
            $translator = app(\App\Services\AutoTranslationService::class);
            $translator->translate($service->title);
            $translator->translate($service->tagline);
            $translator->translate($service->description);
            if (is_array($service->deliverables)) {
                foreach ($service->deliverables as $d) {
                    $translator->translate($d);
                }
            }
        } catch (\Throwable $e) {}

        return redirect()->route('admin.services.index')->with('status', 'Pilar keahlian berhasil ditambahkan.');
    }

    /**
     * Formulir edit keahlian.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Perbarui keahlian.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'number'       => ['required', 'string', 'max:10'],
            'title'        => ['required', 'string', 'max:255'],
            'tagline'      => ['nullable', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'deliverables' => ['nullable', 'string'],
            'order'        => ['nullable', 'integer'],
            'status'       => ['nullable', 'string', 'in:published,draft'],
        ]);

        $deliverablesArray = [];
        if (!empty($validated['deliverables'])) {
            $deliverablesArray = array_values(array_filter(
                array_map('trim', preg_split('/\r\n|\r|\n/', $validated['deliverables'])),
                fn($line) => $line !== ''
            ));
        }

        $service->update([
            'number'       => $validated['number'],
            'title'        => $validated['title'],
            'tagline'      => $validated['tagline'] ?? null,
            'description'  => $validated['description'],
            'deliverables' => $deliverablesArray,
            'order'        => $validated['order'] ?? 0,
            'status'       => $validated['status'] ?? 'published',
        ]);

        try {
            $translator = app(\App\Services\AutoTranslationService::class);
            $translator->translate($service->title);
            $translator->translate($service->tagline);
            $translator->translate($service->description);
            if (is_array($service->deliverables)) {
                foreach ($service->deliverables as $d) {
                    $translator->translate($d);
                }
            }
        } catch (\Throwable $e) {}

        return redirect()->route('admin.services.index')->with('status', 'Pilar keahlian berhasil diperbarui.');
    }

    /**
     * Hapus keahlian.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('status', 'Pilar keahlian berhasil dihapus.');
    }
}

