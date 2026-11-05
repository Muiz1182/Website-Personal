@props([
    'strings' => [],
    'title' => 'MMA PRODUCTION',
    'subtitle' => null,
    'ctaLabel' => null,
    'secondaryCtaLabel' => null,
    'lanyardImage' => '/images/lanyard-front.svg'
])

@php
    $isId = app()->getLocale() === 'id';
    $eyebrow = $strings['eyebrow'] ?? ($isId ? 'Videography, Designer, dan Web Developer' : 'Videography, Designer, and Web Developer');
    $tagline = $strings['tagline'] ?? 'VIDEOGRAPHY • DESIGNER • WEB DEVELOPER';
    $desc = !empty($subtitle) ? $subtitle : ($strings['subtitle'] ?? ($isId ? 'MMA Production adalah ruang kreatif yang berfokus pada videografi, desain grafis, dan pengembangan web. Mengubah ide menjadi karya visual dan solusi digital yang kreatif, inovatif, dan bermakna.' : 'MMA Production is a creative space focused on videography, graphic design, and web development. Transforming ideas into creative, innovative, and impactful visual works and digital solutions.'));
    $cta1 = $ctaLabel ?? ($strings['cta_works'] ?? ($isId ? 'JELAJAHI KARYA' : 'EXPLORE WORKS'));
    $cta2 = $secondaryCtaLabel ?? ($strings['cta_contact'] ?? ($isId ? 'MULAI PROYEK' : 'START A PROJECT'));
    $coreFocusLabel = $strings['core_focus_label'] ?? ($isId ? 'Keahlian Inti' : 'Core Capabilities');
    $coreFocusVal = $strings['core_focus_val'] ?? 'Videography, Designer & Web Developer';
    $standardsLabel = $strings['standards_label'] ?? ($isId ? 'Standar Alat' : 'Standard Toolset');
    $standardsVal = $strings['standards_val'] ?? 'Sony 4K, Studio Mic, Figma, Laravel, Vue & PHP';
    $directorLabel = $strings['director_label'] ?? ($isId ? 'Kreator Utama' : 'Lead Creator');
    $directorVal = $strings['director_val'] ?? 'Mochammad Muiz Afdloly';
    $lanyardTag = $strings['lanyard_tag'] ?? ($isId ? 'Kartu Tanda Pengenal Kreator • Geser atau ayunkan kartu' : 'Interactive Creator Pass • Drag to tilt and swing');
    $ticker = $strings['ticker'] ?? [
        $isId ? 'Video Cinematic & Sinematografi 4K' : 'Cinematic Video & 4K Cinematography',
        $isId ? 'Produksi Video Podcast & Audio Studio' : 'Multi-Camera Video Podcast & Studio Audio',
        $isId ? 'Desain Antarmuka UI/UX (Figma)' : 'UI/UX Interface Design in Figma',
        $isId ? 'Desain Ilustrasi Digital Kustom' : 'Custom Digital Illustrations & Vector Art',
        $isId ? 'Desain Poster Komersial & Acara' : 'Commercial & Event Poster Design',
        $isId ? 'Website Developer Laravel & PHP' : 'Full-Stack Web Development with Laravel & PHP',
        $isId ? 'Frontend Reaktif Vue.js & Modern JS' : 'Reactive Frontend with Vue.js & Modern JS',
    ];
@endphp

<section id="hero" class="relative w-full bg-[#070707] text-[#F5F5F7] pt-32 pb-20 md:pt-40 md:pb-28 px-6 md:px-12 overflow-hidden border-b border-[#1F1F24]">
    <!-- Background atmospheric subtle gradient -->
    <div class="absolute inset-0 bg-gradient-to-b from-[#0E0E10]/50 via-transparent to-[#070707] pointer-events-none -z-0"></div>

    <div class="max-w-7xl mx-auto w-full relative z-10">
        <div class="relative min-h-[auto] lg:min-h-[75vh] flex flex-col justify-center">
            <!-- Left Narrative & Typography -->
            <div class="flex flex-col items-start max-w-2xl xl:max-w-3xl relative z-10 space-y-8">
                <div class="space-y-4">
                    <p class="text-xs uppercase tracking-[0.3em] font-semibold text-[#FF5722]">
                        {{ $eyebrow }}
                    </p>
                    <h1 class="font-display text-5xl sm:text-7xl lg:text-8xl font-black tracking-tight leading-[0.95] uppercase text-white">
                        <span data-tech-text="MMA PRODUCTION" class="inline-block hover:text-[#FF5722] transition-colors cursor-pointer select-none">
                            MMA PRODUCTION
                        </span>
                    </h1>
                    <p class="text-sm uppercase tracking-[0.25em] text-neutral-400 font-medium">
                        {{ $tagline }}
                    </p>
                </div>
                
                <p class="text-neutral-300 text-base md:text-lg max-w-xl leading-relaxed font-normal">
                    {{ $desc }}
                </p>

                <!-- Action CTAs -->
                <div class="flex flex-wrap items-center gap-4 pt-4">
                    <a 
                        href="#works" 
                        class="min-h-[48px] inline-flex items-center justify-center bg-[#FF5722] hover:bg-[#F4511E] text-white px-8 py-3 text-xs font-bold uppercase tracking-widest transition-colors duration-200 focus-visible:outline-none"
                    >
                        {{ $cta1 }}
                    </a>
                    
                    <a 
                        href="#contact" 
                        class="min-h-[48px] inline-flex items-center justify-center border border-[#1F1F24] hover:border-white text-white px-8 py-3 text-xs font-bold uppercase tracking-widest transition-colors duration-200 focus-visible:outline-none"
                    >
                        {{ $cta2 }}
                    </a>
                </div>

                <!-- Production Disciplines Tags -->
                <div class="pt-6 border-t border-[#1F1F24]/80 flex flex-wrap gap-x-8 gap-y-3 text-xs text-neutral-400">
                    <div>
                        <span class="text-neutral-500 block text-[10px] uppercase tracking-widest">{{ $coreFocusLabel }}</span>
                        <span class="text-neutral-200 font-medium">{{ $coreFocusVal }}</span>
                    </div>
                    <div>
                        <span class="text-neutral-500 block text-[10px] uppercase tracking-widest">{{ $standardsLabel }}</span>
                        <span class="text-neutral-200 font-medium">{{ $standardsVal }}</span>
                    </div>
                    <div>
                        <span class="text-neutral-500 block text-[10px] uppercase tracking-widest">{{ $directorLabel }}</span>
                        <span class="text-neutral-200 font-medium">{{ $directorVal }}</span>
                    </div>
                </div>
            </div>

            <!-- Right 3D Interactive Lanyard Pass -->
            <div class="w-full h-[520px] sm:h-[580px] mt-10 lg:mt-0 lg:absolute lg:right-0 lg:top-0 lg:bottom-0 lg:w-[50%] lg:h-full z-0 pointer-events-none [&_canvas]:pointer-events-auto">
                <div class="lanyard-wrapper w-full h-full relative" aria-hidden="true">
                    <div 
                        id="hero-lanyard" 
                        class="lanyard w-full h-full relative" 
                        data-lanyard
                        data-front-image="{{ $lanyardImage ?: '/images/lanyard-front.svg' }}"
                        data-back-image="/images/lanyard-back.svg"
                        data-strap-image="/images/lanyard-strap.svg"
                        data-finish="glossy"
                        data-metal="silver"
                        data-card-color="#FAFAFA"
                        data-strap-color="#121216"
                    ></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ticker Reel Strip -->
    <div class="mt-20 pt-8 border-t border-[#1F1F24] overflow-hidden whitespace-nowrap">
        <div class="animate-marquee flex space-x-12 text-xs uppercase tracking-[0.3em] font-semibold text-neutral-400">
            @foreach($ticker as $item)
                <span>{{ $item }}</span>
                <span class="text-[#FF5722]">&bull;</span>
            @endforeach
            <!-- Duplicate for seamless infinite loop -->
            @foreach($ticker as $item)
                <span>{{ $item }}</span>
                <span class="text-[#FF5722]">&bull;</span>
            @endforeach
        </div>
    </div>
</section>
