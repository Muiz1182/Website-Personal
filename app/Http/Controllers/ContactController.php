<?php

namespace App\Http\Controllers;

use App\Mail\ProjectCommissionMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Menangani pengiriman form kontak dan mengirimkannya langsung ke Gmail
     */
    public function submit(Request $request)
    {
        $isId = app()->getLocale() === 'id';

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'category' => 'required|string',
            'details'  => 'required|string|min:10|max:3000',
        ], [
            'name.required'     => $isId ? 'Nama wajib diisi.' : 'Name is required.',
            'email.required'    => $isId ? 'Alamat email wajib diisi.' : 'Email is required.',
            'email.email'       => $isId ? 'Format email tidak valid.' : 'Email format is invalid.',
            'category.required' => $isId ? 'Kategori proyek wajib dipilih.' : 'Category is required.',
            'details.required'  => $isId ? 'Detail proyek wajib diisi.' : 'Project details are required.',
            'details.min'       => $isId ? 'Detail proyek minimal 10 karakter.' : 'Project details must be at least 10 characters.',
        ]);

        $categoryMap = [
            'cinematic-video'     => 'Video Cinematic & Iklan Komersial',
            'video-podcast'       => 'Produksi Video Podcast & Audio Studio',
            'design-uiux'         => 'Desain UI/UX Web & Mobile (Figma)',
            'design-illustration' => 'Desain Ilustrasi Digital Kustom',
            'design-poster'       => 'Desain Poster Komersial & Acara',
            'web-laravel-php'     => 'Website Developer (Laravel & PHP)',
            'web-vue-js'          => 'Frontend Interaktif (Vue.js & JavaScript)',
            'all-in-one'          => 'Paket Terpadu (Video + Desain + Website)',
            'videography'         => 'Videografi (Cinematic & Podcast)',
            'design'              => 'Desain Grafis (UI/UX, Ilustrasi, Poster)',
            'web-developer'       => 'Website Developer (Laravel & Vue)',
        ];

        $categoryLabel = $categoryMap[$validated['category']] ?? ucwords(str_replace('-', ' ', $validated['category']));

        $emailPayload = [
            'name'           => $validated['name'],
            'email'          => $validated['email'],
            'category'       => $validated['category'],
            'category_label' => $categoryLabel,
            'details'        => $validated['details'],
            'submitted_at'   => now()->setTimezone('Asia/Jakarta')->format('d M Y, H:i'),
            'ip'             => $request->ip(),
        ];

        try {
            // Tujuan email langsung ke Gmail bisnis kreator
            $recipient = config('mail.from.address', 'muiz1182.business@gmail.com');

            Mail::to($recipient)->send(new ProjectCommissionMail($emailPayload));

            Log::info("Formulir pengajuan proyek berhasil dikirim ke {$recipient} dari {$validated['email']}");

            $successMsg = $isId 
                ? 'Pengajuan proyek Anda berhasil terkirim langsung ke email muiz1182.business@gmail.com. Kami akan segera menghubungi Anda dalam 1x24 jam kerja.' 
                : 'Your project brief was transmitted directly to muiz1182.business@gmail.com. We will get back to you within 24 business hours.';

            return back()->with('success', $successMsg);
            
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email pengajuan proyek: ' . $e->getMessage(), [
                'payload' => $emailPayload,
            ]);
            
            $errorMsg = $isId
                ? 'Terjadi kendala pengiriman email server. Pengajuan Anda telah tercatat di sistem kami, atau silakan hubungi langsung via WhatsApp di +62 851 7442 1182.'
                : 'A mail server connectivity issue occurred. Your brief was recorded in our system, or please contact us directly via WhatsApp at +62 851 7442 1182.';

            return back()->with('error', $errorMsg);
        }
    }
}
