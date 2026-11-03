@props([
    'services' => [],
    'strings' => []
])

@php
    $isId = app()->getLocale() === 'id';
    $eyebrow = $strings['eyebrow'] ?? ($isId ? 'Kapabilitas • Keahlian Studio' : 'Capabilities • Studio Craft');
    $title = $strings['title'] ?? ($isId ? 'KEAHLIAN TEKNIS' : 'TECHNICAL MASTERY');
    $subtitle = $strings['subtitle'] ?? ($isId ? 'Kami menggabungkan pilihan optik sinematik dengan ritme penyuntingan presisi frame-accurate. Setiap proyek mendapatkan rancangan alur kerja menyeluruh mulai dari praproduksi hingga tahap pewarnaan master.' : 'We combine deliberate optical choices with frame-accurate editorial rhythm. Every project receives dedicated workflow engineering from pre-production to master color finishing.');
    $badge = $strings['badge'] ?? ($isId ? 'Disiplin Produksi' : 'Production Discipline');
    $deliverablesLabel = $strings['deliverables'] ?? ($isId ? 'Hasil & Berkas Akhir:' : 'Direct Deliverables:');
@endphp

<section id="services" class="bg-[#070707] text-[#F5F5F7] py-28 px-6 md:px-12 border-b border-[#1F1F24]">
    <div class="max-w-7xl mx-auto">
        <!-- Section Header -->
        <div class="max-w-3xl mb-16 space-y-4">
            <p class="text-xs uppercase tracking-[0.25em] font-semibold text-[#FF5722]">
                {{ $eyebrow }}
            </p>
            <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl font-black uppercase tracking-tight text-white">
                {{ $title }}
            </h2>
            <p class="text-neutral-400 text-base md:text-lg leading-relaxed font-normal pt-2">
                {{ $subtitle }}
            </p>
        </div>

        <!-- Capabilities Grid: 3 Pillars Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
                <div class="group relative bg-[#0E0E10] border border-[#1F1F24] p-8 flex flex-col justify-between hover:border-[#FF5722]/50 transition-colors duration-300">
                    <!-- Top Index & Title -->
                    <div>
                        <div class="flex items-center justify-between pb-6 mb-6 border-b border-[#1F1F24]">
                            <span class="font-display text-3xl font-black text-neutral-600 group-hover:text-[#FF5722] transition-colors">
                                {{ $service['number'] }}
                            </span>
                            <span class="text-[10px] uppercase tracking-widest text-neutral-400 font-semibold px-3 py-1 bg-[#151518] border border-[#1F1F24]">
                                {{ $badge }}
                            </span>
                        </div>

                        <h3 class="font-display text-xl sm:text-2xl font-bold uppercase tracking-tight text-white mb-2 group-hover:text-[#FF5722] transition-colors">
                            {{ $service['title'] }}
                        </h3>

                        <p class="text-[#FF5722] text-xs font-medium tracking-wide mb-4">
                            {{ $service['tagline'] }}
                        </p>

                        <p class="text-neutral-400 text-sm leading-relaxed mb-8">
                            {{ $service['description'] }}
                        </p>
                    </div>

                    <!-- Concrete Deliverables List -->
                    <div class="pt-6 border-t border-[#1F1F24] bg-[#151518]/50 p-4 -mx-2 -mb-2 border border-[#1F1F24]">
                        <p class="text-[10px] uppercase tracking-widest font-bold text-neutral-400 mb-3">
                            {{ $deliverablesLabel }}
                        </p>
                        <ul class="grid grid-cols-1 gap-2 text-xs text-neutral-300">
                            @foreach($service['deliverables'] as $item)
                                <li class="flex items-center space-x-2">
                                    <span class="w-1.5 h-1.5 bg-[#FF5722] inline-block shrink-0"></span>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
