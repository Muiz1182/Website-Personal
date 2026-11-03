<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Tampilkan daftar karya portofolio.
     */
    public function index()
    {
        $projects = Project::orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Formulir penambahan karya baru.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Simpan karya baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'category'    => ['required', 'string', 'in:Videography,Design,Web Developer'],
            'tag'         => ['nullable', 'string', 'max:255'],
            'year'        => ['required', 'string', 'max:10'],
            'specs'       => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image_file'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,avif', 'max:10240'],
            'image_url'   => ['nullable', 'string', 'max:1000'],
            'span'        => ['required', 'string', 'in:col-span-1 md:col-span-1,col-span-1 md:col-span-2'],
            'aspect'      => ['required', 'string', 'in:aspect-[4/3],aspect-[16/9]'],
            'order'       => ['nullable', 'integer'],
        ]);

        $imagePath = $validated['image_url'] ?? null;

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . Str::slug($validated['title']) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/projects'), $filename);
            $imagePath = '/uploads/projects/' . $filename;
        }

        Project::create([
            'title'       => $validated['title'],
            'category'    => $validated['category'],
            'tag'         => $validated['tag'] ?? null,
            'year'        => $validated['year'],
            'specs'       => $validated['specs'] ?? null,
            'description' => $validated['description'] ?? null,
            'image'       => $imagePath,
            'span'        => $validated['span'],
            'aspect'      => $validated['aspect'],
            'order'       => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.projects.index')->with('status', 'Karya berhasil ditambahkan ke portofolio.');
    }

    /**
     * Formulir edit karya yang ada.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Perbarui data karya.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'category'    => ['required', 'string', 'in:Videography,Design,Web Developer'],
            'tag'         => ['nullable', 'string', 'max:255'],
            'year'        => ['required', 'string', 'max:10'],
            'specs'       => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image_file'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,avif', 'max:10240'],
            'image_url'   => ['nullable', 'string', 'max:1000'],
            'span'        => ['required', 'string', 'in:col-span-1 md:col-span-1,col-span-1 md:col-span-2'],
            'aspect'      => ['required', 'string', 'in:aspect-[4/3],aspect-[16/9]'],
            'order'       => ['nullable', 'integer'],
        ]);

        $imagePath = $project->image;

        if ($request->filled('image_url')) {
            $imagePath = $validated['image_url'];
        }

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . Str::slug($validated['title']) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/projects'), $filename);
            $imagePath = '/uploads/projects/' . $filename;
        }

        $project->update([
            'title'       => $validated['title'],
            'category'    => $validated['category'],
            'tag'         => $validated['tag'] ?? null,
            'year'        => $validated['year'],
            'specs'       => $validated['specs'] ?? null,
            'description' => $validated['description'] ?? null,
            'image'       => $imagePath,
            'span'        => $validated['span'],
            'aspect'      => $validated['aspect'],
            'order'       => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.projects.index')->with('status', 'Karya berhasil diperbarui.');
    }

    /**
     * Hapus karya dari portofolio.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('status', 'Karya berhasil dihapus dari portofolio.');
    }
}

