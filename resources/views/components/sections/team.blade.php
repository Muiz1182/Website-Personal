@props([
    'team' => [],
    'strings' => []
])

@php
    $isId = app()->getLocale() === 'id';
    $eyebrow = $strings['eyebrow'] ?? ($isId ? 'Profil Kreator • Pengarah Studio' : 'Creator Profile • Studio Lead');
    $title = $strings['title'] ?? ($isId ? 'PROFIL KREATOR' : 'ABOUT THE CREATOR');
    $badge = $strings['badge'] ?? ($isId ? 'Videographer, Designer & Website Developer' : 'Videographer, Designer & Web Developer');
    $disciplinesLabel = $strings['disciplines'] ?? ($isId ? 'Pilar Keahlian Utama' : 'Core Expertise');
    $ctaInquire = $strings['cta_inquire'] ?? ($isId ? 'Ajukan Diskusi Proyek' : 'Direct Project Inquiry');
    $ctaEmail = $strings['cta_email'] ?? ($isId ? 'Kirim Email' : 'Email Creator');

    $lead = $team[0] ?? [
        'name' => 'MOCHAMMAD MUIZ AFDLOLY',
        'role' => 'Videographer (Cinematic & Podcast) • Designer (UI/UX, Poster) • Web Developer (Laravel, Vue)',
        'headline' => $isId ? 'Menyatukan video cinematic, video podcast, desain UI/UX, ilustrasi & poster, serta web development (Laravel & Vue).' : 'Unifying cinematic video, podcasts, expressive UI/UX, illustration & posters, and modern web development (Laravel & Vue).',
        'bio' => $isId ? 'Kreator multidisiplin berbasis di Indonesia dengan keahlian berdedikasi pada: produksi video cinematic & video podcast; perancangan desain UI/UX, ilustrasi digital & poster komersial; serta pengembangan website modern menggunakan Laravel, Vue, PHP, dan JavaScript.' : 'Multidisciplinary creative practitioner based in Indonesia with dedicated expertise in: cinematic video & podcast production; UI/UX, digital illustration & commercial poster design; and modern website development using Laravel, Vue, PHP, and JavaScript.',
        'image' => 'https://6a4a60231e75414caa98f25d.imgix.net/sandbox/muiz.jpeg',
        'disciplines' => $isId ? ['Video Cinematic', 'Video Podcast', 'Desain UI/UX', 'Desain Ilustrasi', 'Desain Poster', 'Laravel & PHP', 'Vue & JavaScript'] : ['Cinematic Video', 'Video Podcast', 'UI/UX Design', 'Illustration Design', 'Poster Design', 'Laravel & PHP', 'Vue & JavaScript'],
        'stats' => [
            ['label' => $isId ? 'Keahlian Inti' : 'Core Disciplines', 'value' => 'Video, Desain & Web Dev'],
            ['label' => $isId ? 'Standar Alat' : 'Technical Stack', 'value' => 'Laravel, Vue, PHP, JS, Figma, 4K'],
            ['label' => $isId ? 'Basis Lokasi' : 'Location', 'value' => $isId ? 'Indonesia / Terbuka Proyek' : 'Indonesia / Open for Projects'],
        ]
    ];
@endphp

<section id="director" class="bg-[#070707] text-[#F5F5F7] py-28 px-6 md:px-12 border-b border-[#1F1F24] relative">
    <!-- Anchor alias for legacy links -->
    <div id="team" class="absolute -top-20"></div>

    <div class="max-w-7xl mx-auto">
        <!-- Section Tag -->
        <div class="mb-12">
            <p class="text-xs uppercase tracking-[0.25em] font-semibold text-[#FF5722] mb-3">
                {{ $eyebrow }}
            </p>
            <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl font-black uppercase tracking-tight text-white">
                {{ $title }}
            </h2>
        </div>

        <!-- Director Showcase Layout -->
        <div class="bg-[#0E0E10] border border-[#1F1F24] p-8 md:p-14 grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            <!-- Portrait Column -->
            <div class="lg:col-span-5 relative group">
                <div class="relative aspect-[3/4] bg-[#151518] border border-[#1F1F24] overflow-hidden shadow-2xl">
                    <img 
                        src="{{ $lead['image'] }}" 
                        alt="Portrait of {{ $lead['name'] }}" 
                        loading="lazy"
                        class="w-full h-full object-cover grayscale contrast-110 group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700 ease-out"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0E0E10] via-transparent to-transparent opacity-60"></div>
                    
                    <div class="absolute bottom-4 left-4 right-4 p-4 bg-[#070707]/90 border border-[#1F1F24]">
                        <p class="text-[10px] uppercase tracking-widest text-[#FF5722] font-semibold">{{ $lead['role'] }}</p>
                        <h4 class="font-display text-lg font-bold text-white tracking-tight uppercase">{{ $lead['name'] }}</h4>
                    </div>
                </div>

                <!-- Backing border decoration -->
                <div class="hidden sm:block absolute -bottom-3 -right-3 w-full h-full border border-[#FF5722]/20 -z-0 pointer-events-none"></div>
            </div>

            <!-- Narrative Column -->
            <div class="lg:col-span-7 space-y-8">
                <div>
                    <span class="text-xs uppercase tracking-widest text-neutral-400 font-semibold block mb-2">
                        {{ $badge }}
                    </span>
                    <h3 class="font-display text-3xl sm:text-4xl font-extrabold text-white tracking-tight leading-snug">
                        {{ $lead['headline'] }}
                    </h3>
                </div>

                <p class="text-neutral-400 text-base md:text-lg leading-relaxed font-normal">
                    {{ $lead['bio'] }}
                </p>

                <!-- Disciplines Badges -->
                <div class="space-y-3">
                    <span class="text-[11px] uppercase tracking-widest text-neutral-400 font-semibold block">
                        {{ $disciplinesLabel }}
                    </span>
                    <div class="flex flex-wrap gap-2">
                        @foreach($lead['disciplines'] as $discipline)
                            <span class="text-xs uppercase tracking-wider font-semibold text-neutral-300 bg-[#151518] border border-[#1F1F24] px-4 py-2">
                                {{ $discipline }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="pt-6 border-t border-[#1F1F24] grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach($lead['stats'] as $stat)
                        <div>
                            <span class="text-[10px] uppercase tracking-widest text-neutral-500 block mb-1">
                                {{ $stat['label'] }}
                            </span>
                            <span class="text-sm font-bold text-white">
                                {{ $stat['value'] }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <!-- Direct Inquire CTA -->
                <div class="pt-4 flex flex-wrap items-center gap-4">
                    <a 
                        href="#contact" 
                        class="min-h-[44px] inline-flex items-center justify-center bg-[#FF5722] hover:bg-[#F4511E] text-white text-xs font-bold uppercase tracking-widest px-8 py-3 transition-colors duration-200"
                    >
                        {{ $ctaInquire }}
                    </a>
                    <a 
                        href="mailto:muiz1182.business@gmail.com" 
                        class="min-h-[44px] inline-flex items-center justify-center border border-[#1F1F24] hover:border-white text-neutral-300 hover:text-white text-xs font-bold uppercase tracking-widest px-6 py-3 transition-colors duration-200"
                    >
                        {{ $ctaEmail }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
