<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Tampilkan daftar seluruh pengumuman.
     */
    public function index()
    {
        $announcements = Announcement::orderBy('is_active', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * Formulir tambah pengumuman baru.
     */
    public function create()
    {
        return view('admin.announcements.create');
    }

    /**
     * Simpan pengumuman baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'badge'       => ['nullable', 'string', 'max:100'],
            'content'     => ['required', 'string'],
            'action_text' => ['nullable', 'string', 'max:100'],
            'action_url'  => ['nullable', 'string', 'max:255'],
            'status'      => ['required', 'string', 'in:published,draft'],
            'is_active'   => ['nullable', 'boolean'],
            'starts_at'   => ['nullable', 'date'],
            'expires_at'  => ['nullable', 'date', 'after_or_equal:starts_at'],
        ]);

        $isActive = $request->boolean('is_active', true);

        // Jika diset sebagai pengumuman aktif dan status published, nonaktifkan pengumuman lain agar fokus 1 popup utama
        if ($isActive && $validated['status'] === 'published') {
            Announcement::where('is_active', true)->update(['is_active' => false]);
        }

        Announcement::create([
            'title'       => $validated['title'],
            'badge'       => $validated['badge'] ?? 'PENGUMUMAN',
            'content'     => $validated['content'],
            'action_text' => $validated['action_text'] ?? null,
            'action_url'  => $validated['action_url'] ?? null,
            'status'      => $validated['status'],
            'is_active'   => $isActive,
            'starts_at'   => $validated['starts_at'] ?? null,
            'expires_at'  => $validated['expires_at'] ?? null,
        ]);

        return redirect()->route('admin.announcements.index')
            ->with('status', 'Pengumuman baru berhasil dibuat dan disimpan.');
    }

    /**
     * Formulir edit pengumuman.
     */
    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    /**
     * Perbarui data pengumuman.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'badge'       => ['nullable', 'string', 'max:100'],
            'content'     => ['required', 'string'],
            'action_text' => ['nullable', 'string', 'max:100'],
            'action_url'  => ['nullable', 'string', 'max:255'],
            'status'      => ['required', 'string', 'in:published,draft'],
            'is_active'   => ['nullable', 'boolean'],
            'starts_at'   => ['nullable', 'date'],
            'expires_at'  => ['nullable', 'date', 'after_or_equal:starts_at'],
        ]);

        $isActive = $request->boolean('is_active', false);

        if ($isActive && $validated['status'] === 'published') {
            Announcement::where('id', '!=', $announcement->id)->where('is_active', true)->update(['is_active' => false]);
        }

        $announcement->update([
            'title'       => $validated['title'],
            'badge'       => $validated['badge'] ?? 'PENGUMUMAN',
            'content'     => $validated['content'],
            'action_text' => $validated['action_text'] ?? null,
            'action_url'  => $validated['action_url'] ?? null,
            'status'      => $validated['status'],
            'is_active'   => $isActive,
            'starts_at'   => $validated['starts_at'] ?? null,
            'expires_at'  => $validated['expires_at'] ?? null,
        ]);

        return redirect()->route('admin.announcements.index')
            ->with('status', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Toggle status aktif popup langsung dari index.
     */
    public function toggle(Announcement $announcement)
    {
        $newActiveState = !$announcement->is_active;

        if ($newActiveState) {
            Announcement::where('id', '!=', $announcement->id)->update(['is_active' => false]);
        }

        $announcement->update([
            'is_active' => $newActiveState,
        ]);

        $msg = $newActiveState
            ? 'Pengumuman diaktifkan sebagai popup di halaman utama.'
            : 'Pengumuman dinonaktifkan dari popup.';

        return redirect()->back()->with('status', $msg);
    }

    /**
     * Hapus pengumuman.
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('admin.announcements.index')
            ->with('status', 'Pengumuman berhasil dihapus.');
    }
}

