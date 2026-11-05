<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CreatorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CreatorController extends Controller
{
    /**
     * Tampilkan formulir edit profil kreator utama.
     */
    public function edit()
    {
        $creator = CreatorProfile::firstOrCreate(
            ['id' => 1],
            [
                'name'        => 'MOCHAMMAD MUIZ AFDLOLY',
                'role'        => 'Videographer (Cinematic & Podcast) • Designer (UI/UX, Ilustrasi, Poster) • Web Developer (Laravel, Vue, PHP, JS)',
                'headline'    => 'Menyatukan video cinematic, video podcast, desain UI/UX, ilustrasi & poster, serta pengembangan website modern (Laravel & Vue).',
                'bio'         => 'Kreator multidisiplin berbasis di Indonesia dengan keahlian berdedikasi pada: produksi video cinematic & video podcast; perancangan desain UI/UX, ilustrasi digital & poster komersial; serta pengembangan website modern menggunakan Laravel, Vue, PHP, dan JavaScript.',
                'image'       => 'https://6a4a60231e75414caa98f25d.imgix.net/sandbox/muiz.jpeg',
                'disciplines' => [
                    'Video Cinematic',
                    'Video Podcast',
                    'Desain UI/UX',
                    'Desain Ilustrasi',
                    'Desain Poster',
                    'Laravel & PHP',
                    'Vue & JavaScript',
                ],
                'stats'       => [
                    ['label' => 'Keahlian Inti', 'value' => 'Video, Desain & Web Dev'],
                    ['label' => 'Stack & Standar Alat', 'value' => 'Laravel, Vue, PHP, JS, Figma, 4K'],
                    ['label' => 'Basis Lokasi', 'value' => 'Indonesia / Terbuka Proyek'],
                ],
            ]
        );

        return view('admin.creator.edit', compact('creator'));
    }

    /**
     * Perbarui data profil kreator.
     */
    public function update(Request $request)
    {
        $creator = CreatorProfile::firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'name'                => ['required', 'string', 'max:255'],
            'role'                => ['required', 'string', 'max:255'],
            'headline'            => ['nullable', 'string'],
            'bio'                 => ['required', 'string'],
            'image_file'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,avif', 'max:10240'],
            'image_url'           => ['nullable', 'string', 'max:1000'],
            'lanyard_image_file'  => ['nullable', 'file', 'mimes:jpeg,png,jpg,webp,svg,avif', 'max:10240'],
            'lanyard_image_url'   => ['nullable', 'string', 'max:1000'],
            'reset_lanyard'       => ['nullable', 'boolean'],
            'disciplines'         => ['nullable', 'string'],
            'stat_labels'         => ['nullable', 'array'],
            'stat_values'         => ['nullable', 'array'],
        ]);

        $imagePath = $creator->image;

        if ($request->filled('image_url')) {
            $imagePath = $validated['image_url'];
        }

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'creator_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/creator'), $filename);
            $imagePath = '/uploads/creator/' . $filename;
        }

        $lanyardImagePath = $creator->lanyard_image;

        if ($request->boolean('reset_lanyard')) {
            $lanyardImagePath = null;
        } elseif ($request->filled('lanyard_image_url')) {
            $lanyardImagePath = $validated['lanyard_image_url'];
        }

        if ($request->hasFile('lanyard_image_file')) {
            $file = $request->file('lanyard_image_file');
            $filename = 'lanyard_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/creator'), $filename);
            $lanyardImagePath = '/uploads/creator/' . $filename;
        }

        $disciplinesArray = [];
        if (!empty($validated['disciplines'])) {
            $disciplinesArray = array_values(array_filter(
                array_map('trim', preg_split('/\r\n|\r|\n/', $validated['disciplines'])),
                fn($line) => $line !== ''
            ));
        }

        $statsArray = [];
        if (!empty($validated['stat_labels']) && !empty($validated['stat_values'])) {
            foreach ($validated['stat_labels'] as $i => $label) {
                $val = $validated['stat_values'][$i] ?? '';
                if (trim($label) !== '' || trim($val) !== '') {
                    $statsArray[] = [
                        'label' => trim($label),
                        'value' => trim($val),
                    ];
                }
            }
        }

        $creator->update([
            'name'          => $validated['name'],
            'role'          => $validated['role'],
            'headline'      => $validated['headline'] ?? null,
            'bio'           => $validated['bio'],
            'image'         => $imagePath,
            'lanyard_image' => $lanyardImagePath,
            'disciplines'   => $disciplinesArray,
            'stats'         => $statsArray,
        ]);

        try {
            $translator = app(\App\Services\AutoTranslationService::class);
            $translator->translate($creator->role);
            $translator->translate($creator->headline);
            $translator->translate($creator->bio);
            if (is_array($creator->disciplines)) {
                foreach ($creator->disciplines as $d) {
                    $translator->translate($d);
                }
            }
            if (is_array($creator->stats)) {
                foreach ($creator->stats as $st) {
                    $translator->translate($st['label'] ?? '');
                    $translator->translate($st['value'] ?? '');
                }
            }
        } catch (\Throwable $e) {}

        return redirect()->route('admin.creator.edit')->with('status', 'Profil kreator berhasil diperbarui.');
    }
}

