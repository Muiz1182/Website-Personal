@props([
    'testimonials' => [],
    'strings' => []
])

@php
    $isId = app()->getLocale() === 'id';
    $eyebrow = $strings['eyebrow'] ?? ($isId ? 'Kolaborasi • Ulasan Klien' : 'Collaborations • Feedback');
    $title = $strings['title'] ?? ($isId ? 'KLIEN & KREDIT PRODUKSI' : 'CLIENT CREDITS');
    $subtitle = $strings['subtitle'] ?? ($isId ? 'Ulasan dari pemilik bisnis, brand manager, dan mitra kreatif pada proyek videografi, desain, maupun pengembangan website.' : 'Feedback from business owners, marketing teams, and creative partners across videography, design, and web development projects.');
    $badge = $strings['badge'] ?? ($isId ? 'Produksi' : 'Production');
    $ndaTitle = $strings['nda_title'] ?? ($isId ? 'Kerahasiaan & Perjanjian NDA Dijamin Sepenuhnya' : 'Strict NDA & Confidentiality Respected');
    $ndaSub = $strings['nda_subtitle'] ?? ($isId ? 'Semua materi proyek dan berkas klien diperlakukan dengan standar kerahasiaan penuh' : 'All client materials and project briefs handled with utmost discretion');
@endphp

@if (!empty($testimonials) && count($testimonials) > 0)
<section id="clients" class="bg-[#070707] text-[#F5F5F7] py-28 px-6 md:px-12 border-b border-[#1F1F24]">
    <div class="max-w-7xl mx-auto">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between pb-12 mb-12 border-b border-[#1F1F24] gap-6">
            <div>
                <p class="text-xs uppercase tracking-[0.25em] font-semibold text-[#FF5722] mb-3">
                    {{ $eyebrow }}
                </p>
                <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl font-black uppercase tracking-tight text-white">
                    {{ $title }}
                </h2>
            </div>
            
            <p class="text-xs uppercase tracking-[0.2em] text-neutral-400 font-medium max-w-sm">
                {{ $subtitle }}
            </p>
        </div>

        <!-- Testimonials Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
                <div class="group relative bg-[#0E0E10] border border-[#1F1F24] p-8 md:p-10 flex flex-col justify-between hover:border-[#FF5722]/50 transition-colors duration-300">
                    <div class="space-y-6">
                        <!-- Project Scope Tag -->
                        <div class="flex items-center justify-between text-xs text-neutral-400 pb-4 border-b border-[#1F1F24]">
                            <span class="text-[10px] uppercase font-bold tracking-widest text-[#FF5722]">
                                {{ $badge }}
                            </span>
                            <span class="text-[11px] font-medium text-neutral-300">
                                {{ $testimonial['project'] ?? ($isId ? 'Film Komersial' : 'Commercial Film') }}
                            </span>
                        </div>

                        <!-- Quote Body -->
                        <blockquote class="text-neutral-300 text-sm md:text-base leading-relaxed font-normal">
                            &ldquo;{{ $testimonial['quote'] }}&rdquo;
                        </blockquote>
                    </div>

                    <!-- Client Identity -->
                    <div class="pt-6 mt-8 border-t border-[#1F1F24]">
                        <h4 class="font-display font-bold text-sm text-white tracking-tight uppercase">
                            {{ $testimonial['name'] }}
                        </h4>
                        <p class="text-[11px] text-neutral-400 uppercase tracking-wider mt-1 font-medium">
                            {{ $testimonial['role'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Production Trust Note -->
        <div class="mt-12 p-6 bg-[#0E0E10] border border-[#1F1F24] flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-neutral-400">
            <div class="flex items-center space-x-3">
                <span class="w-2 h-2 bg-[#FF5722]"></span>
                <span class="font-semibold text-neutral-200">{{ $ndaTitle }}</span>
                <span class="hidden sm:inline text-neutral-500">&bull;</span>
                <span class="text-neutral-400">{{ $ndaSub }}</span>
            </div>
            <div class="text-[11px] text-neutral-500 font-mono tracking-wider">
                SURABAYA // JAKARTA // INDONESIA
            </div>
        </div>
    </div>
</section>
@endif
