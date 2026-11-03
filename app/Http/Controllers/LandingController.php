<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\{Project, Service, CreatorProfile, Testimonial};

class LandingController extends Controller
{
    /**
     * Menampilkan halaman portofolio utama (Bilingual: ID & EN).
     * Fokus murni pada 3 pilar: Videography, Design, dan Website Developer.
     */
    public function index(Request $request): View
    {
        // Deteksi bahasa aktif (Query param > Session > Cookie > Default 'id')
        $locale = $request->query('lang');
        if (!in_array($locale, ['id', 'en'])) {
            $locale = session('locale', $request->cookie('locale', 'id'));
        }

        if (!in_array($locale, ['id', 'en'])) {
            $locale = 'id';
        }

        session(['locale' => $locale]);
        app()->setLocale($locale);

        $projects     = $this->getPortfolioData($locale);
        $services     = $this->getServicesData($locale);
        $testimonials = $this->getTestimonialData($locale);
        $team         = $this->getTeamData($locale);

        $strings = $this->getStrings($locale);
        $strings['has_testimonials'] = count($testimonials) > 0;
        $strings['has_services']     = count($services) > 0;
        $strings['has_projects']     = count($projects) > 0;

        $lanyardImage = '/images/lanyard-front.svg';
        try {
            $creator = CreatorProfile::first();
            if ($creator && !empty($creator->lanyard_image)) {
                $lanyardImage = $creator->lanyard_image;
            }
        } catch (\Throwable $e) {
            // Default SVG
        }

        return view('welcome', [
            'locale'       => $locale,
            'strings'      => $strings,
            'projects'     => $projects,
            'services'     => $services,
            'testimonials' => $testimonials,
            'team'         => $team,
            'lanyardImage' => $lanyardImage,
        ]);
    }

    /**
     * Kamus string antarmuka untuk UI (Navbar, Hero, Section Headers, Contact, Footer)
     */
    private function getStrings(string $locale): array
    {
        if ($locale === 'en') {
            return [
                'nav' => [
                    'works'        => 'Works',
                    'services'     => 'Capabilities',
                    'director'     => 'About Creator',
                    'clients'      => 'Credits',
                    'start_project'=> 'Start Project',
                    'switch_id'    => 'ID',
                    'switch_en'    => 'EN',
                ],
                'hero' => [
                    'eyebrow'          => 'Videography, Designer, and Web Developer',
                    'tagline'          => 'VIDEOGRAPHY • DESIGNER • WEB DEVELOPER',
                    'subtitle'         => 'An integrated creative and technical craft by Mochammad Muiz Afdloly focused on: videography (cinematic & podcasts); design (UI/UX, illustrations, posters); and web development (Laravel, Vue, PHP, JS).',
                    'cta_works'        => 'EXPLORE WORKS',
                    'cta_contact'      => 'START A PROJECT',
                    'core_focus_label' => 'Core Capabilities',
                    'core_focus_val'   => 'Videography, Designer & Web Developer',
                    'standards_label'  => 'Standard Toolset',
                    'standards_val'    => 'Sony 4K, Studio Mic, Figma, Laravel, Vue & PHP',
                    'director_label'   => 'Lead Creator',
                    'director_val'     => 'Mochammad Muiz Afdloly',
                    'lanyard_tag'      => 'Interactive Creator Pass • Drag to tilt and swing',
                    'ticker'           => [
                        'Cinematic Video & 4K Cinematography',
                        'Multi-Camera Video Podcast & Studio Audio',
                        'UI/UX Interface Design in Figma',
                        'Custom Digital Illustrations & Vector Art',
                        'Commercial & Event Poster Design',
                        'Full-Stack Web Development with Laravel & PHP',
                        'Reactive Frontend with Vue.js & Modern JS',
                    ],
                ],
                'works' => [
                    'eyebrow'     => 'Portfolio • Curated Works',
                    'title'       => 'SELECTED WORKS',
                    'filter_all'  => 'All',
                    'filter_video'=> 'Videography',
                    'filter_design'=> 'Design',
                    'filter_web'  => 'Web Developer',
                    'modal' => [
                        'specs'       => 'Tools & Tech Stack',
                        'year'        => 'Year',
                        'category'    => 'Pillar',
                        'overview'    => 'Project Overview',
                        'close'       => 'Close Details',
                        'discuss_cta' => 'Discuss Similar Project',
                    ],
                ],
                'services' => [
                    'eyebrow'      => 'Core Capabilities • 3 Pillars',
                    'title'        => 'TECHNICAL MASTERY',
                    'subtitle'     => 'Focused on three core crafts: cinematic video & podcast production; UI/UX, custom illustration & poster design; and modern website development using Laravel, Vue, PHP, and JavaScript.',
                    'badge'        => 'Core Discipline',
                    'deliverables' => 'Direct Deliverables:',
                ],
                'team' => [
                    'eyebrow'      => 'Creator Profile • Studio Lead',
                    'title'        => 'ABOUT THE CREATOR',
                    'badge'        => 'Videographer (Cinematic & Podcast) • Designer (UI/UX, Illustration, Poster) • Web Developer (Laravel, Vue, PHP, JS)',
                    'disciplines'  => 'Core Expertise',
                    'cta_inquire'  => 'Discuss a Project',
                    'cta_email'    => 'Email Creator',
                ],
                'clients' => [
                    'eyebrow'      => 'Collaborations • Feedback',
                    'title'        => 'CLIENT CREDITS',
                    'subtitle'     => 'Feedback from business owners, marketing teams, and creative partners across videography, design, and web development projects.',
                    'badge'        => 'Production',
                    'nda_title'    => 'Strict NDA & Confidentiality Respected',
                    'nda_subtitle' => 'All client materials and project briefs handled with utmost discretion',
                ],
                'contact' => [
                    'eyebrow'       => 'Inquiries • Commissions',
                    'title'         => "LET'S CREATE<br>TOGETHER.",
                    'subtitle'      => 'Have a project in cinematic video, podcast recording, UI/UX, illustration, posters, or web development (Laravel & Vue)? Fill out the brief below or get in touch directly via WhatsApp or email.',
                    'email_label'   => 'Direct Email',
                    'wa_label'      => 'Instant Chat (WhatsApp)',
                    'wa_link_text'  => '+62 812-3456-7890 (Chat via WhatsApp)',
                    'hub_label'     => 'Creative Hub',
                    'hub_val'       => 'Surabaya • Jakarta, Indonesia',
                    'hours_label'   => 'Response Time',
                    'hours_val'     => 'Within 24 business hours',
                    'form_title'    => 'Project Commission Form',
                    'form_sub'      => 'Select your required scope and tell us about your goals.',
                    'name_label'    => 'Full Name / Company',
                    'email_field'   => 'Email Address',
                    'phone_field'   => 'WhatsApp / Phone Number',
                    'service_field' => 'Primary Discipline',
                    'service_options' => [
                        'cinematic-podcast'   => 'Cinematic Video & Podcast Production',
                        'uiux-design'         => 'UI/UX Design for Web & Mobile (Figma)',
                        'illustration-poster' => 'Custom Digital Illustration & Poster Design',
                        'web-laravel-vue'     => 'Modern Web Development (Laravel, Vue, PHP, JS)',
                        'all-in-one'          => 'Integrated Package (Video + Design + Web)',
                    ],
                    'budget_field'  => 'Estimated Budget',
                    'concept_field' => 'Project Scope & Timeline',
                    'concept_place' => 'Describe your project requirements, references, deliverables, and target deadline...',
                    'submit_cta'    => 'TRANSMIT PROJECT BRIEF',
                    'notice'        => 'We review and respond to every inquiry within 24 business hours.',
                ],
                'footer' => [
                    'bio'           => 'Cinematic video & podcast, UI/UX & poster illustration, and modern web development (Laravel, Vue, PHP, JS) by Mochammad Muiz Afdloly.',
                    'hub'           => 'Creative Hub: Surabaya • Jakarta, Indonesia',
                    'nav_title'     => 'Navigation',
                    'nav_top'       => 'Top // Overview',
                    'nav_works'     => 'Selected Works',
                    'nav_services'  => 'Core Capabilities',
                    'nav_director'  => 'About Creator',
                    'nav_credits'   => 'Client Credits',
                    'nav_contact'   => 'Start a Project',
                    'legal_copy'    => 'MMA Production. Mochammad Muiz Afdloly. All Rights Reserved.',
                    'legal_privacy' => 'Privacy Policy',
                    'legal_terms'   => 'Terms of Service',
                ],
            ];
        }

        // Bahasa Indonesia (Default)
        return [
            'nav' => [
                'works'        => 'Karya',
                'services'     => 'Keahlian',
                'director'     => 'Profil Kreator',
                'clients'      => 'Klien',
                'start_project'=> 'Mulai Proyek',
                'switch_id'    => 'ID',
                'switch_en'    => 'EN',
            ],
            'hero' => [
                'eyebrow'          => 'Videography, Designer, dan Web Developer',
                'tagline'          => 'VIDEOGRAPHY • DESIGNER • WEB DEVELOPER',
                'subtitle'         => 'Kombinasi karya visual dan teknologi digital oleh Mochammad Muiz Afdloly berfokus pada: videography (cinematic & podcast); designer (UI/UX, ilustrasi, poster); serta web developer (Laravel, Vue, PHP, JS).',
                'cta_works'        => 'JELAJAHI KARYA',
                'cta_contact'      => 'KONSULTASI PROYEK',
                'core_focus_label' => 'Keahlian Inti',
                'core_focus_val'   => 'Videography, Designer & Web Developer',
                'standards_label'  => 'Standar Alat',
                'standards_val'    => 'Sony 4K, Studio Mic, Figma, Laravel, Vue & PHP',
                'director_label'   => 'Kreator Utama',
                'director_val'     => 'Mochammad Muiz Afdloly',
                'lanyard_tag'      => 'Kartu Tanda Pengenal Kreator • Geser atau ayunkan kartu',
                'ticker'           => [
                    'Video Cinematic & Sinematografi 4K',
                    'Produksi Video Podcast & Audio Studio',
                    'Desain Antarmuka UI/UX (Figma)',
                    'Desain Ilustrasi Digital Kustom',
                    'Desain Poster Komersial & Acara',
                    'Website Developer Laravel & PHP',
                    'Frontend Reaktif Vue.js & Modern JS',
                ],
            ],
            'works' => [
                'eyebrow'     => 'Portofolio • Karya Pilihan',
                'title'       => 'KARYA PILIHAN',
                'filter_all'  => 'Semua',
                'filter_video'=> 'Videografi',
                'filter_design'=> 'Desain',
                'filter_web'  => 'Web Developer',
                'modal' => [
                    'specs'       => 'Alat & Spesifikasi Teknis',
                    'year'        => 'Tahun',
                    'category'    => 'Pilar Keahlian',
                    'overview'    => 'Ringkasan Proyek',
                    'close'       => 'Tutup Detail',
                    'discuss_cta' => 'Diskusikan Proyek Serupa',
                ],
            ],
            'services' => [
                'eyebrow'      => '3 Pilar Keahlian Utama',
                'title'        => 'KEAHLIAN TEKNIS',
                'subtitle'     => 'Berfokus pada tiga bidang keahlian: produksi video cinematic & podcast; desain UI/UX, ilustrasi digital & poster komersial; serta web development modern dengan stack Laravel, Vue, PHP, dan JavaScript.',
                'badge'        => 'Disiplin Inti',
                'deliverables' => 'Hasil & Berkas Akhir:',
            ],
            'team' => [
                'eyebrow'      => 'Profil Kreator • Pengarah Studio',
                'title'        => 'PROFIL KREATOR',
                'badge'        => 'Videographer (Cinematic & Podcast) • Designer (UI/UX, Ilustrasi, Poster) • Web Developer (Laravel, Vue, PHP, JS)',
                'disciplines'  => 'Pilar Keahlian Utama',
                'cta_inquire'  => 'Ajukan Diskusi Proyek',
                'cta_email'    => 'Kirim Email',
            ],
            'clients' => [
                'eyebrow'      => 'Kolaborasi • Ulasan Klien',
                'title'        => 'KLIEN & KREDIT PRODUKSI',
                'subtitle'     => 'Ulasan dari pemilik bisnis, brand manager, dan mitra kreatif pada proyek videografi, desain, maupun pengembangan website.',
                'badge'        => 'Produksi',
                'nda_title'    => 'Kerahasiaan & Perjanjian NDA Dijamin Sepenuhnya',
                'nda_subtitle' => 'Semua materi proyek dan berkas klien diperlakukan dengan standar kerahasiaan penuh',
            ],
            'contact' => [
                'eyebrow'       => 'Konsultasi • Pemesanan Proyek',
                'title'         => 'MARI BERKARYA<br>BERSAMA.',
                'subtitle'      => 'Punya proyek video cinematic, rekaman podcast, desain UI/UX, ilustrasi, poster, atau pembuatan website (Laravel & Vue)? Sampaikan kebutuhan Anda atau hubungi langsung via WhatsApp maupun email.',
                'email_label'   => 'Email Resmi',
                'wa_label'      => 'Kontak Instan (WhatsApp)',
                'wa_link_text'  => '+62 812-3456-7890 (Chat via WhatsApp)',
                'hub_label'     => 'Basis Kreatif',
                'hub_val'       => 'Surabaya • Jakarta, Indonesia',
                'hours_label'   => 'Waktu Respons',
                'hours_val'     => 'Dalam 1x24 jam kerja',
                'form_title'    => 'Formulir Pengajuan Proyek',
                'form_sub'      => 'Pilih kategori kebutuhan dan sampaikan sasaran proyek Anda.',
                'name_label'    => 'Nama Lengkap / Perusahaan',
                'email_field'   => 'Alamat Email',
                'phone_field'   => 'Nomor WhatsApp / Telepon',
                'service_field' => 'Kategori Kebutuhan',
                'service_options' => [
                    'cinematic-podcast'   => 'Produksi Video Cinematic & Video Podcast',
                    'uiux-design'         => 'Desain Antarmuka UI/UX Web & Mobile (Figma)',
                    'illustration-poster' => 'Desain Ilustrasi Kustom & Poster Komersial',
                    'web-laravel-vue'     => 'Website Developer Modern (Laravel, Vue, PHP, JS)',
                    'all-in-one'          => 'Paket Terpadu (Video + Desain + Website)',
                ],
                'budget_field'  => 'Estimasi Anggaran Proyek',
                'concept_field' => 'Detail & Sasaran Proyek',
                'concept_place' => 'Ceritakan sekilas tentang kebutuhan proyek, referensi gaya, berkas luaran yang diinginkan, serta target jadwal tayang...',
                'submit_cta'    => 'KIRIM PENGAJUAN PROYEK',
                'notice'        => 'Kami merespons setiap pengajuan dalam kurun waktu 1x24 jam kerja.',
            ],
            'footer' => [
                'bio'           => 'Video cinematic & podcast, desain UI/UX & ilustrasi poster, serta web development modern (Laravel, Vue, PHP, JS) oleh Mochammad Muiz Afdloly.',
                'hub'           => 'Basis Kreatif: Surabaya • Jakarta, Indonesia',
                'nav_title'     => 'Navigasi',
                'nav_top'       => 'Kembali ke Atas',
                'nav_works'     => 'Karya Pilihan',
                'nav_services'  => 'Pilar Keahlian',
                'nav_director'  => 'Profil Kreator',
                'nav_credits'   => 'Ulasan Klien',
                'nav_contact'   => 'Konsultasikan Proyek',
                'legal_copy'    => 'MMA Production. Mochammad Muiz Afdloly. Hak Cipta Dilindungi.',
                'legal_privacy' => 'Kebijakan Privasi',
                'legal_terms'   => 'Ketentuan Layanan',
            ],
        ];
    }

    /**
     * Data portofolio Selected Works (6 Proyek fokus: Video Cinematic & Podcast, Desain UI/UX, Ilustrasi & Poster, Web Laravel, Vue, PHP & JS)
     */
    private function getPortfolioData(string $locale): array
    {
        try {
            $dbProjects = Project::orderBy('order', 'asc')->orderBy('id', 'asc')->get();
            $items = [];
            foreach ($dbProjects as $p) {
                $items[] = [
                    'id'          => 'proj-' . $p->id,
                    'title'       => $p->title,
                    'category'    => $p->category,
                    'tag'         => $p->tag ?? $p->category,
                    'year'        => $p->year,
                    'specs'       => $p->specs ?? '',
                    'description' => $p->description ?? '',
                    'image'       => $p->image ?: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=1200',
                    'span'        => $p->span ?? 'col-span-1 md:col-span-1',
                    'aspect'      => $p->aspect ?? 'aspect-[4/3]',
                ];
            }
            return $items;
        } catch (\Throwable $e) {
            // Fallback graceful jika database offline
        }

        if ($locale === 'en') {
            return [
                [
                    'id'          => 'project-velocity',
                    'title'       => 'PROJECT: VELOCITY (CINEMATIC)',
                    'category'    => 'Videography',
                    'tag'         => 'Cinematic Commercial Video',
                    'year'        => '2024',
                    'specs'       => '4K Cinema • Sony FX3 • DaVinci Resolve',
                    'description' => 'Cinematic video production capturing the dynamic rhythm of performance automotive with planned lighting, high-speed tracking shots, and cinematic color grading.',
                    'image'       => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=1200',
                    'span'        => 'col-span-1 md:col-span-2',
                    'aspect'      => 'aspect-[16/9]'
                ],
                [
                    'id'          => 'podcast-dialogue',
                    'title'       => 'THE DIALOGUE: PODCAST SESSION',
                    'category'    => 'Videography',
                    'tag'         => 'Video Podcast & Studio Audio',
                    'year'        => '2024',
                    'specs'       => 'Multi-Cam 4K • Studio Microphones • DaVinci Audio Mix',
                    'description' => 'Complete multi-camera video podcast production featuring multi-angle camera switching, studio-grade audio cleanup, synchronized lighting, and vertical cutdown reels.',
                    'image'       => 'https://images.unsplash.com/photo-1590602847861-f357a9332bbc?q=80&w=1200',
                    'span'        => 'col-span-1 md:col-span-1',
                    'aspect'      => 'aspect-[4/3]'
                ],
                [
                    'id'          => 'aura-uiux',
                    'title'       => 'AURA UI/UX DESIGN SYSTEM',
                    'category'    => 'Design',
                    'tag'         => 'UI/UX Web & Mobile Design (Figma)',
                    'year'        => '2024',
                    'specs'       => 'Figma • Design Tokens • Prototyping',
                    'description' => 'End-to-end UI/UX interface design for web and mobile applications with wireframing, component tokens, interactive Figma prototypes, and accessible typography.',
                    'image'       => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?q=80&w=900',
                    'span'        => 'col-span-1 md:col-span-1',
                    'aspect'      => 'aspect-[4/3]'
                ],
                [
                    'id'          => 'poster-illustration',
                    'title'       => 'KINETIC POSTER & ILLUSTRATION ART',
                    'category'    => 'Design',
                    'tag'         => 'Poster Design & Digital Illustration',
                    'year'        => '2024',
                    'specs'       => 'Adobe Illustrator • Photoshop • Vector Art',
                    'description' => 'Commercial poster design series integrated with custom digital vector illustrations, bold typography hierarchy, and promotional visual collateral for digital and print media.',
                    'image'       => 'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?q=80&w=1200',
                    'span'        => 'col-span-1 md:col-span-2',
                    'aspect'      => 'aspect-[16/9]'
                ],
                [
                    'id'          => 'zenith-platform',
                    'title'       => 'ZENITH PLATFORM (LARAVEL & PHP)',
                    'category'    => 'Web Developer',
                    'tag'         => 'Full-Stack Web App (Laravel & PHP)',
                    'year'        => '2024',
                    'specs'       => 'Laravel 11 • PHP 8.3 • MySQL • RESTful API',
                    'description' => 'Full-stack web application engineering utilizing Laravel and modern PHP for high-speed database queries, robust authentication, and secure API endpoints.',
                    'image'       => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=900',
                    'span'        => 'col-span-1 md:col-span-1',
                    'aspect'      => 'aspect-[4/3]'
                ],
                [
                    'id'          => 'solaris-portal',
                    'title'       => 'SOLARIS HUB (VUE & JS)',
                    'category'    => 'Web Developer',
                    'tag'         => 'Reactive Frontend (Vue.js & Modern JS)',
                    'year'        => '2023',
                    'specs'       => 'Vue 3 • JavaScript ES6+ • Vite • Reactive UI',
                    'description' => 'Modern reactive website built with Vue.js single-file components and pure JavaScript interactive logic for sub-second page transitions and smooth user experience.',
                    'image'       => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=900',
                    'span'        => 'col-span-1 md:col-span-1',
                    'aspect'      => 'aspect-[4/3]'
                ],
            ];
        }

        return [
            [
                'id'          => 'project-velocity',
                'title'       => 'PROJECT: VELOCITY (CINEMATIC)',
                'category'    => 'Videography',
                'tag'         => 'Video Cinematic Komersial',
                'year'        => '2024',
                'specs'       => '4K Cinema • Sony FX3 • DaVinci Resolve',
                'description' => 'Produksi video sinematik yang menangkap ritme dinamis kendaraan performa tinggi dengan tata cahaya terencana, pengambilan gambar berkecepatan tinggi, dan pewarnaan sinematik DaVinci Resolve.',
                'image'       => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=1200',
                'span'        => 'col-span-1 md:col-span-2',
                'aspect'      => 'aspect-[16/9]'
            ],
            [
                'id'          => 'podcast-dialogue',
                'title'       => 'THE DIALOGUE: PODCAST SESSION',
                'category'    => 'Videography',
                'tag'         => 'Produksi Video Podcast & Audio Studio',
                'year'        => '2024',
                'specs'       => 'Multi-Cam 4K • Mikrofon Studio • DaVinci Audio Mix',
                'description' => 'Produksi menyeluruh video podcast multi-kamera yang mencakup switching multi-sudut, penataan audio vokal studio yang jernih, pencahayaan podcast hangat, dan klip reels vertikal.',
                'image'       => 'https://images.unsplash.com/photo-1590602847861-f357a9332bbc?q=80&w=1200',
                'span'        => 'col-span-1 md:col-span-1',
                'aspect'      => 'aspect-[4/3]'
            ],
            [
                'id'          => 'aura-uiux',
                'title'       => 'AURA UI/UX DESIGN SYSTEM',
                'category'    => 'Design',
                'tag'         => 'Desain UI/UX Web & Mobile (Figma)',
                'year'        => '2024',
                'specs'       => 'Figma • Design Tokens • Prototyping',
                'description' => 'Perancangan desain antarmuka UI/UX komprehensif untuk aplikasi web dan mobile dengan wireframe, design tokens, prototipe interaktif Figma, dan standar aksesibilitas WCAG AA.',
                'image'       => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?q=80&w=900',
                'span'        => 'col-span-1 md:col-span-1',
                'aspect'      => 'aspect-[4/3]'
            ],
            [
                'id'          => 'poster-illustration',
                'title'       => 'KINETIC POSTER & ILLUSTRATION ART',
                'category'    => 'Design',
                'tag'         => 'Desain Poster Komersial & Ilustrasi Digital',
                'year'        => '2024',
                'specs'       => 'Adobe Illustrator • Photoshop • Vector Art',
                'description' => 'Seri desain poster komersial yang dipadukan dengan ilustrasi digital vektor kustom, hierarki tipografi kuat, dan materi visual promosi untuk format cetak maupun digital.',
                'image'       => 'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?q=80&w=1200',
                'span'        => 'col-span-1 md:col-span-2',
                'aspect'      => 'aspect-[16/9]'
            ],
            [
                'id'          => 'zenith-platform',
                'title'       => 'ZENITH PLATFORM (LARAVEL & PHP)',
                'category'    => 'Web Developer',
                'tag'         => 'Aplikasi Web Full-Stack (Laravel & PHP)',
                'year'        => '2024',
                'specs'       => 'Laravel 11 • PHP 8.3 • MySQL • RESTful API',
                'description' => 'Pengembangan aplikasi web full-stack menggunakan framework Laravel dan PHP modern untuk pemrosesan basis data cepat, autentikasi terstruktur, dan API aman.',
                'image'       => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=900',
                'span'        => 'col-span-1 md:col-span-1',
                'aspect'      => 'aspect-[4/3]'
            ],
            [
                'id'          => 'solaris-portal',
                'title'       => 'SOLARIS HUB (VUE & JS)',
                'category'    => 'Web Developer',
                'tag'         => 'Frontend Interaktif (Vue.js & Modern JS)',
                'year'        => '2023',
                'specs'       => 'Vue 3 • JavaScript ES6+ • Vite • Reactive UI',
                'description' => 'Website interaktif modern yang dibangun dengan komponen reaktif Vue.js dan logika JavaScript murni untuk transisi halaman instan dan pengalaman pengguna yang responsif.',
                'image'       => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=900',
                'span'        => 'col-span-1 md:col-span-1',
                'aspect'      => 'aspect-[4/3]'
            ],
        ];
    }

    /**
     * 3 Pilar Keahlian Utama (Videography: Cinematic & Podcast, Design: UI/UX, Illustration, Poster, Web Developer: Laravel, Vue, PHP, JS)
     */
    private function getServicesData(string $locale): array
    {
        try {
            $dbServices = Service::orderBy('order', 'asc')->orderBy('id', 'asc')->get();
            $items = [];
            foreach ($dbServices as $s) {
                $items[] = [
                    'number'       => $s->number,
                    'title'        => $s->title,
                    'tagline'      => $s->tagline ?? '',
                    'description'  => $s->description,
                    'deliverables' => is_array($s->deliverables) ? $s->deliverables : [],
                ];
            }
            return $items;
        } catch (\Throwable $e) {
            // Fallback graceful jika database offline
        }

        if ($locale === 'en') {
            return [
                [
                    'number'       => '01',
                    'title'        => 'Videography: Cinematic Video & Podcast',
                    'tagline'      => 'Cinematic storytelling and professional multi-camera video podcast production.',
                    'description'  => 'We produce cinematic commercial videos, brand storytelling reels, and full-length video podcasts. Featuring 4K prime lenses, intentional lighting, studio microphone recording, and frame-accurate DaVinci Resolve grading.',
                    'deliverables' => [
                        '4K Cinematic Video Master & Cutdowns',
                        'Multi-Camera Video Podcast Recording',
                        'Studio Audio Clean-up & Vocal Mastering',
                        'Social Media Short Clips (Reels & Shorts 9:16)'
                    ]
                ],
                [
                    'number'       => '02',
                    'title'        => 'Design: UI/UX, Illustration & Poster',
                    'tagline'      => 'Thoughtful UI/UX systems, custom digital illustrations, and bold commercial posters.',
                    'description'  => 'Delivering user-centered UI/UX designs in Figma, custom digital illustrations with distinctive art direction, and high-impact commercial posters with strong typographic hierarchy.',
                    'deliverables' => [
                        'UI/UX Web & Mobile Interfaces (Figma)',
                        'Custom Digital Illustrations (Vector & Raster)',
                        'Commercial & Event Poster Designs',
                        'Design Systems, Component Libraries & Assets'
                    ]
                ],
                [
                    'number'       => '03',
                    'title'        => 'Web Developer: Laravel, Vue, PHP & JS',
                    'tagline'      => 'High-performance, secure, and reactive web applications powered by Laravel & Vue.',
                    'description'  => 'Building custom web solutions from database to frontend using Laravel and modern PHP for backend architecture, combined with Vue.js and JavaScript for fast, fluid interactivity and clean SEO structure.',
                    'deliverables' => [
                        'Full-Stack Web Development (Laravel & PHP)',
                        'Reactive Frontend Components (Vue.js & JS)',
                        'Database Architecture, REST APIs & Auth Systems',
                        'Mobile-First Responsive Layout & Speed Tuning'
                    ]
                ],
            ];
        }

        return [
            [
                'number'       => '01',
                'title'        => 'Videografi: Video Cinematic & Podcast',
                'tagline'      => 'Visual sinematik berkarakter kuat serta produksi rekaman video podcast multi-kamera.',
                'description'  => 'Kami memproduksi video iklan komersial sinematik, video brand storytelling, serta video podcast berstandar studio. Dilengkapi lensa prima 4K, tata pencahayaan terarah, rekaman mikrofon studio, dan pewarnaan presisi di DaVinci Resolve.',
                'deliverables' => [
                    'Video Sinematik 4K (Master & Cutdown)',
                    'Produksi Rekaman Video Podcast Multi-Kamera',
                    'Penataan & Mastering Audio Studio Podcast',
                    'Klip Vertikal Media Sosial (Reels & Shorts 9:16)'
                ]
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
                    'Design System, Pustaka Komponen & Aset Siap Pakai'
                ]
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
                    'Tata Letak Responsif Mobile-First & Optimasi Kecepatan'
                ]
            ],
        ];
    }

    /**
     * Testimonial & Kolaborasi Klien (Bilingual pada 3 pilar)
     */
    private function getTestimonialData(string $locale): array
    {
        try {
            $dbTestimonials = Testimonial::orderBy('order', 'asc')->orderBy('id', 'asc')->get();
            $items = [];
            foreach ($dbTestimonials as $t) {
                $items[] = [
                    'name'    => $t->name,
                    'role'    => $t->role ?? '',
                    'project' => $t->project ?? '',
                    'quote'   => $t->quote,
                ];
            }
            return $items;
        } catch (\Throwable $e) {
            // Fallback graceful jika database offline
        }

        if ($locale === 'en') {
            return [
                [
                    'name'    => 'Alice Sandra',
                    'role'    => 'Marketing Director, Retail Group',
                    'project' => 'Cinematic Video & Podcast Series',
                    'quote'   => 'The cinematic camera work and clean multi-mic podcast audio delivered an engagement rate far beyond our benchmarks. Visual quality and turnaround time were remarkable.'
                ],
                [
                    'name'    => 'Marcus Boyd',
                    'role'    => 'CTO & Co-Founder, Tech Platform',
                    'project' => 'Laravel & Vue Web Application',
                    'quote'   => 'Mochammad Muiz engineered our complete web app using Laravel, Vue, and modern JavaScript. Sub-second response times, clean architecture, and responsive UX across all viewports.'
                ],
                [
                    'name'    => 'David Pratama',
                    'role'    => 'Creative Director, Agency 7',
                    'project' => 'UI/UX Design, Illustrations & Posters',
                    'quote'   => 'Incredible versatility: the UI/UX flows in Figma were meticulous, while the custom illustrations and event posters gave our campaign distinctive artistic presence.'
                ],
            ];
        }

        return [
            [
                'name'    => 'Alice Sandra',
                'role'    => 'Direktur Pemasaran, Retail Group',
                'project' => 'Seri Video Sinematik & Podcast',
                'quote'   => 'Kualitas rekaman video sinematik dan kejernihan audio podcast multi-mikrofon menghasilkan tingkat keterlibatan audiens yang sangat tinggi. Pengerjaan sangat rapi dan profesional.'
            ],
            [
                'name'    => 'Marcus Boyd',
                'role'    => 'CTO & Co-Founder, Tech Platform',
                'project' => 'Aplikasi Web Laravel & Vue',
                'quote'   => 'Mochammad Muiz mengembangkan aplikasi web kami dengan Laravel, Vue, dan JavaScript modern. Waktu respons halaman di bawah satu detik, arsitektur kode bersih, dan tampilan responsif di semua gawai.'
            ],
            [
                'name'    => 'David Pratama',
                'role'    => 'Creative Director, Agency 7',
                'project' => 'Desain UI/UX, Ilustrasi & Poster',
                'quote'   => 'Keahlian desain yang luar biasa komprehensif: alur antarmuka UI/UX di Figma sangat teliti, sementara ilustrasi kustom dan poster acaranya memberikan identitas visual yang memukau.'
            ],
        ];
    }

    /**
     * Profil Kreator Utama (Bilingual pada 3 pilar: Videography, Design, Web Developer)
     */
    private function getTeamData(string $locale): array
    {
        try {
            $creator = CreatorProfile::first();
            if ($creator) {
                return [
                    [
                        'name'        => $creator->name,
                        'role'        => $creator->role,
                        'headline'    => $creator->headline ?? '',
                        'bio'         => $creator->bio,
                        'image'       => $creator->image ?: 'https://6a4a60231e75414caa98f25d.imgix.net/sandbox/muiz.jpeg',
                        'disciplines' => is_array($creator->disciplines) ? $creator->disciplines : [],
                        'stats'       => is_array($creator->stats) ? $creator->stats : [],
                    ]
                ];
            }
        } catch (\Throwable $e) {
            // Fallback graceful
        }

        if ($locale === 'en') {
            return [
                [
                    'name'       => 'MOCHAMMAD MUIZ AFDLOLY',
                    'role'       => 'Videographer (Cinematic & Podcast) • Designer (UI/UX, Illustration, Poster) • Web Developer (Laravel, Vue, PHP, JS)',
                    'headline'   => 'Unifying cinematic video, podcasts, expressive UI/UX, illustration & posters, and modern web development (Laravel & Vue).',
                    'bio'        => 'Multidisciplinary creative practitioner based in Indonesia with dedicated expertise in: cinematic video & podcast production; UI/UX, digital illustration & commercial poster design; and modern website development using Laravel, Vue, PHP, and JavaScript.',
                    'image'      => 'https://6a4a60231e75414caa98f25d.imgix.net/sandbox/muiz.jpeg',
                    'disciplines'=> ['Cinematic Video', 'Video Podcast', 'UI/UX Design', 'Illustration Design', 'Poster Design', 'Laravel & PHP', 'Vue & JavaScript'],
                    'stats'      => [
                        ['label' => 'Core Capabilities', 'value' => 'Video, Design & Web Dev'],
                        ['label' => 'Technical Stack', 'value' => 'Laravel, Vue, PHP, JS, Figma, 4K'],
                        ['label' => 'Location', 'value' => 'Indonesia / Available for Projects'],
                    ]
                ],
            ];
        }

        return [
            [
                'name'       => 'MOCHAMMAD MUIZ AFDLOLY',
                'role'       => 'Videographer (Cinematic & Podcast) • Designer (UI/UX, Ilustrasi, Poster) • Web Developer (Laravel, Vue, PHP, JS)',
                'headline'   => 'Menyatukan video cinematic, video podcast, desain UI/UX, ilustrasi & poster, serta pengembangan website modern (Laravel & Vue).',
                'bio'        => 'Kreator multidisiplin berbasis di Indonesia dengan keahlian berdedikasi pada: produksi video cinematic & video podcast; perancangan desain UI/UX, ilustrasi digital & poster komersial; serta pengembangan website modern menggunakan Laravel, Vue, PHP, dan JavaScript.',
                'image'      => 'https://6a4a60231e75414caa98f25d.imgix.net/sandbox/muiz.jpeg',
                'disciplines'=> ['Video Cinematic', 'Video Podcast', 'Desain UI/UX', 'Desain Ilustrasi', 'Desain Poster', 'Laravel & PHP', 'Vue & JavaScript'],
                'stats'      => [
                    ['label' => 'Keahlian Inti', 'value' => 'Video, Desain & Web Dev'],
                    ['label' => 'Stack & Standar Alat', 'value' => 'Laravel, Vue, PHP, JS, Figma, 4K'],
                    ['label' => 'Basis Lokasi', 'value' => 'Indonesia / Terbuka Proyek'],
                ]
            ],
        ];
    }
}
