<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Project;
use App\Models\Service;
use App\Models\CreatorProfile;
use App\Models\Testimonial;

class AdminCmsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@mmaproduction.com'],
            [
                'name' => 'Admin MMA Production',
                'password' => Hash::make('admin1182'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Initial Projects
        if (Project::count() === 0) {
            $projects = [
                [
                    'title'       => 'PROJECT: VELOCITY (CINEMATIC)',
                    'category'    => 'Videography',
                    'tag'         => 'Video Cinematic Komersial',
                    'year'        => '2024',
                    'specs'       => '4K Cinema • Sony FX3 • DaVinci Resolve',
                    'description' => 'Produksi video sinematik yang menangkap ritme dinamis kendaraan performa tinggi dengan tata cahaya terencana, pengambilan gambar berkecepatan tinggi, dan pewarnaan sinematik DaVinci Resolve.',
                    'image'       => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=1200',
                    'span'        => 'col-span-1 md:col-span-2',
                    'aspect'      => 'aspect-[16/9]',
                    'order'       => 1,
                ],
                [
                    'title'       => 'THE DIALOGUE: PODCAST SESSION',
                    'category'    => 'Videography',
                    'tag'         => 'Produksi Video Podcast & Audio Studio',
                    'year'        => '2024',
                    'specs'       => 'Multi-Cam 4K • Mikrofon Studio • DaVinci Audio Mix',
                    'description' => 'Produksi menyeluruh video podcast multi-kamera yang mencakup switching multi-sudut, penataan audio vokal studio yang jernih, pencahayaan podcast hangat, dan klip reels vertikal.',
                    'image'       => 'https://images.unsplash.com/photo-1590602847861-f357a9332bbc?q=80&w=1200',
                    'span'        => 'col-span-1 md:col-span-1',
                    'aspect'      => 'aspect-[4/3]',
                    'order'       => 2,
                ],
                [
                    'title'       => 'AURA UI/UX DESIGN SYSTEM',
                    'category'    => 'Design',
                    'tag'         => 'Desain UI/UX Web & Mobile (Figma)',
                    'year'        => '2024',
                    'specs'       => 'Figma • Design Tokens • Prototyping',
                    'description' => 'Perancangan desain antarmuka UI/UX komprehensif untuk aplikasi web dan mobile dengan wireframe, design tokens, prototipe interaktif Figma, dan standar aksesibilitas WCAG AA.',
                    'image'       => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?q=80&w=900',
                    'span'        => 'col-span-1 md:col-span-1',
                    'aspect'      => 'aspect-[4/3]',
                    'order'       => 3,
                ],
                [
                    'title'       => 'KINETIC POSTER & ILLUSTRATION ART',
                    'category'    => 'Design',
                    'tag'         => 'Desain Poster Komersial & Ilustrasi Digital',
                    'year'        => '2024',
                    'specs'       => 'Adobe Illustrator • Photoshop • Vector Art',
                    'description' => 'Seri desain poster komersial yang dipadukan dengan ilustrasi digital vektor kustom, hierarki tipografi kuat, dan materi visual promosi untuk format cetak maupun digital.',
                    'image'       => 'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?q=80&w=1200',
                    'span'        => 'col-span-1 md:col-span-2',
                    'aspect'      => 'aspect-[16/9]',
                    'order'       => 4,
                ],
                [
                    'title'       => 'ZENITH PLATFORM (LARAVEL & PHP)',
                    'category'    => 'Web Developer',
                    'tag'         => 'Aplikasi Web Full-Stack (Laravel & PHP)',
                    'year'        => '2024',
                    'specs'       => 'Laravel 11 • PHP 8.3 • MySQL • RESTful API',
                    'description' => 'Pengembangan aplikasi web full-stack menggunakan framework Laravel dan PHP modern untuk pemrosesan basis data cepat, autentikasi terstruktur, dan API aman.',
                    'image'       => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=900',
                    'span'        => 'col-span-1 md:col-span-1',
                    'aspect'      => 'aspect-[4/3]',
                    'order'       => 5,
                ],
                [
                    'title'       => 'SOLARIS HUB (VUE & JS)',
                    'category'    => 'Web Developer',
                    'tag'         => 'Frontend Interaktif (Vue.js & Modern JS)',
                    'year'        => '2023',
                    'specs'       => 'Vue 3 • JavaScript ES6+ • Vite • Reactive UI',
                    'description' => 'Website interaktif modern yang dibangun dengan komponen reaktif Vue.js dan logika JavaScript murni untuk transisi halaman instan dan pengalaman pengguna yang responsif.',
                    'image'       => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=900',
                    'span'        => 'col-span-1 md:col-span-1',
                    'aspect'      => 'aspect-[4/3]',
                    'order'       => 6,
                ],
            ];

            foreach ($projects as $item) {
                Project::create($item);
            }
        }

        // 3. Initial Services
        if (Service::count() === 0) {
            $services = [
                [
                    'number'       => '01',
                    'title'        => 'Videografi: Video Cinematic & Podcast',
                    'tagline'      => 'Visual sinematik berkarakter kuat serta produksi rekaman video podcast multi-kamera.',
                    'description'  => 'Kami memproduksi video iklan komersial sinematik, video brand storytelling, serta video podcast berstandar studio. Dilengkapi lensa prima 4K, tata pencahayaan terarah, rekaman mikrofon studio, dan pewarnaan presisi di DaVinci Resolve.',
                    'deliverables' => [
                        'Video Sinematik 4K (Master & Cutdown)',
                        'Produksi Rekaman Video Podcast Multi-Kamera',
                        'Penataan & Mastering Audio Studio Podcast',
                        'Klip Vertikal Media Sosial (Reels & Shorts 9:16)',
                    ],
                    'order'        => 1,
                ],
                [
                    'number'       => '02',
                    'title'        => 'Desain Grafis: UI/UX, Ilustrasi & Poster',
                    'tagline'      => 'Sistem antarmuka UI/UX teruji, ilustrasi digital kustom, dan poster promosi berkarakter.',
                    'description'  => 'Menghadirkan desain antarmuka UI/UX di Figma yang berpusat pada kenyamanan pengguna, karya ilustrasi digital kustom yang orisinal, serta desain poster komersial dan acara dengan susunan tipografi berani.',
                    'deliverables' => [
                        'Desain Antarmuka UI/UX Web & Mobile (Figma)',
                        'Desain Ilustrasi Digital Kustom (Vektor / Raster)',
                        'Desain Poster Komersial & Acara (Cetak / Digital)',
                        'Design System, Pustaka Komponen & Aset Siap Pakai',
                    ],
                    'order'        => 2,
                ],
                [
                    'number'       => '03',
                    'title'        => 'Website Developer: Laravel, Vue, PHP & JS',
                    'tagline'      => 'Website dan aplikasi web modern berkinerja tinggi, responsif, dan aman berbasis Laravel & Vue.',
                    'description'  => 'Membangun solusi web kustom mulai dari struktur database hingga antarmuka pengguna menggunakan backend Laravel dan PHP modern, dipadukan dengan reaktivitas Vue.js dan JavaScript untuk performa cepat dan ramah SEO.',
                    'deliverables' => [
                        'Aplikasi Web Full-Stack (Laravel & PHP)',
                        'Komponen Frontend Reaktif (Vue.js & Modern JS)',
                        'Arsitektur Database, REST API & Sistem Keamanan',
                        'Tata Letak Responsif Mobile-First & Optimasi Kecepatan',
                    ],
                    'order'        => 3,
                ],
            ];

            foreach ($services as $service) {
                Service::create($service);
            }
        }

        // 4. Initial Creator Profile
        if (CreatorProfile::count() === 0) {
            CreatorProfile::create([
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
            ]);
        }

        // 5. Initial Testimonials
        if (Testimonial::count() === 0) {
            $testimonials = [
                [
                    'name'    => 'Alice Sandra',
                    'role'    => 'Direktur Pemasaran, Retail Group',
                    'project' => 'Seri Video Sinematik & Podcast',
                    'quote'   => 'Kualitas rekaman video sinematik dan kejernihan audio podcast multi-mikrofon menghasilkan tingkat keterlibatan audiens yang sangat tinggi. Pengerjaan sangat rapi dan profesional.',
                    'order'   => 1,
                ],
                [
                    'name'    => 'Marcus Boyd',
                    'role'    => 'CTO & Co-Founder, Tech Platform',
                    'project' => 'Aplikasi Web Laravel & Vue',
                    'quote'   => 'Mochammad Muiz mengembangkan aplikasi web kami dengan Laravel, Vue, dan JavaScript modern. Waktu respons halaman di bawah satu detik, arsitektur kode bersih, dan tampilan responsif di semua gawai.',
                    'order'   => 2,
                ],
                [
                    'name'    => 'David Pratama',
                    'role'    => 'Creative Director, Agency 7',
                    'project' => 'Desain UI/UX, Ilustrasi & Poster',
                    'quote'   => 'Keahlian desain yang luar biasa komprehensif: alur antarmuka UI/UX di Figma sangat teliti, sementara ilustrasi kustom dan poster acaranya memberikan identitas visual yang memukau.',
                    'order'   => 3,
                ],
            ];

            foreach ($testimonials as $testimonial) {
                Testimonial::create($testimonial);
            }
        }
    }
}

