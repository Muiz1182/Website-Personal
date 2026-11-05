<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AutoTranslationService
{
    /**
     * Jalur berkas cache penyimpanan lokal permanen
     */
    protected string $cachePath;

    /**
     * Memori penampung terjemahan yang telah dimuat
     */
    protected array $cache = [];

    /**
     * Status apakah ada entri cache baru yang perlu disimpan ke disk
     */
    protected bool $dirty = false;

    /**
     * Kamus terjemahan instan untuk istilah inti kreatif & teknologi
     */
    protected array $dictionary = [
        'Keahlian Inti'                => 'Core Disciplines',
        'Stack & Standar Alat'         => 'Tools & Tech Stack',
        'Basis Lokasi'                 => 'Base Location',
        'Indonesia / Terbuka Proyek'   => 'Indonesia / Available for Projects',
        'Video, Desain & Web Dev'      => 'Video, Design & Web Dev',
        'Video Cinematic'              => 'Cinematic Video',
        'Video Podcast'                => 'Video Podcast',
        'Desain UI/UX'                 => 'UI/UX Design',
        'Desain Ilustrasi'             => 'Illustration Design',
        'Desain Poster'                => 'Poster Design',
        'Laravel & PHP'                => 'Laravel & PHP',
        'Vue & JavaScript'             => 'Vue & JavaScript',
    ];

    public function __construct()
    {
        $this->cachePath = storage_path('app/translations_cache.json');
        $this->loadCache();
    }

    /**
     * Menerjemahkan sebuah teks dari bahasa sumber (default: 'id') ke bahasa tujuan (default: 'en')
     */
    public function translate(?string $text, string $target = 'en', string $source = 'id'): string
    {
        if ($text === null) {
            return '';
        }

        $trimmed = trim($text);
        if ($trimmed === '' || $target === $source) {
            return $text;
        }

        // Abaikan teks yang hanya berupa angka, tahun, atau simbol
        if (preg_match('/^[0-9\s\-_:\/•\.,]+$/u', $trimmed)) {
            return $text;
        }

        // Cek kamus instan
        if ($target === 'en' && isset($this->dictionary[$trimmed])) {
            return $this->dictionary[$trimmed];
        }

        $cacheKey = $source . '_' . $target . '_' . md5($trimmed);
        if (isset($this->cache[$cacheKey])) {
            return $this->cache[$cacheKey];
        }

        // Terjemahkan via Google Translate API endpoint (gtx)
        try {
            $url = 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=' . $source . '&tl=' . $target . '&dt=t&q=' . urlencode($trimmed);
            $response = Http::timeout(3.5)->get($url);

            if ($response->successful()) {
                $result = $response->json();
                $translated = '';
                if (isset($result[0]) && is_array($result[0])) {
                    foreach ($result[0] as $sentence) {
                        if (isset($sentence[0])) {
                            $translated .= $sentence[0];
                        }
                    }
                }

                if (!empty(trim($translated))) {
                    $this->cache[$cacheKey] = $translated;
                    $this->dirty = true;
                    $this->saveCache();
                    return $translated;
                }
            }
        } catch (\Throwable $e) {
            // Log senyap agar sistem tidak terganggu saat koneksi offline
            Log::debug('AutoTranslationService notice: ' . $e->getMessage());
        }

        // Fallback jika belum tersambung ke jaringan: kembalikan teks asli
        return $text;
    }

    /**
     * Menerjemahkan array string (misal: deliverables atau disciplines)
     */
    public function translateArray(?array $items, string $target = 'en', string $source = 'id'): array
    {
        if (empty($items)) {
            return [];
        }

        $translated = [];
        foreach ($items as $item) {
            if (is_string($item)) {
                $translated[] = $this->translate($item, $target, $source);
            } else {
                $translated[] = $item;
            }
        }

        return $translated;
    }

    /**
     * Menerjemahkan array statistik/spesifikasi kreator (array of key-value pairs)
     */
    public function translateStats(?array $stats, string $target = 'en', string $source = 'id'): array
    {
        if (empty($stats)) {
            return [];
        }

        $translated = [];
        foreach ($stats as $st) {
            if (is_array($st)) {
                $translated[] = [
                    'label' => $this->translate($st['label'] ?? '', $target, $source),
                    'value' => $this->translate($st['value'] ?? '', $target, $source),
                ];
            } else {
                $translated[] = $st;
            }
        }

        return $translated;
    }

    /**
     * Memuat cache dari disk
     */
    protected function loadCache(): void
    {
        if (file_exists($this->cachePath)) {
            $json = @file_get_contents($this->cachePath);
            if ($json) {
                $data = json_decode($json, true);
                if (is_array($data)) {
                    $this->cache = $data;
                }
            }
        }
    }

    /**
     * Menyimpan perubahan cache ke disk
     */
    public function saveCache(): void
    {
        if ($this->dirty) {
            $dir = dirname($this->cachePath);
            if (!is_dir($dir)) {
                @mkdir($dir, 0755, true);
            }
            @file_put_contents($this->cachePath, json_encode($this->cache, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $this->dirty = false;
        }
    }

    /**
     * Melakukan pra-terjemahan dan memanaskan cache secara langsung
     */
    public function warm(string $text, string $target = 'en', string $source = 'id'): string
    {
        return $this->translate($text, $target, $source);
    }
}

