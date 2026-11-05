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

        <!-- Capabilities Grid: 3 Pillars Layout with 3D Perspective Tilt -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
                <div class="tilt-card-wrapper [perspective:1000px] h-full">
                    <div 
                        data-tilt-card
                        class="tilt-card group relative bg-[#0E0E10] border border-[#1F1F24] p-8 flex flex-col justify-between hover:border-[#FF5722]/60 transition-colors duration-300 overflow-hidden shadow-lg shadow-black/40 h-full select-none"
                        style="transform-style: preserve-3d; will-change: transform;"
                    >
                        <!-- Dynamic Optical Glare (Lens Specular Sheen) -->
                        <div 
                            class="tilt-glare absolute inset-0 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10"
                            style="background: radial-gradient(circle 300px at var(--glare-x, 50%) var(--glare-y, 50%), rgba(255, 87, 34, 0.12), rgba(255, 255, 255, 0.03) 40%, transparent 80%);"
                            aria-hidden="true"
                        ></div>

                        <!-- Studio Film Strip Top Edge Indicator -->
                        <div 
                            class="absolute top-0 left-0 right-0 h-[1.5px] bg-gradient-to-r from-transparent via-[#FF5722]/0 to-transparent group-hover:via-[#FF5722]/70 transition-all duration-500 z-10"
                            aria-hidden="true"
                        ></div>

                        <!-- Top Index & Title (Parallax Elevation Layer) -->
                        <div class="relative z-10 [transform-style:preserve-3d]">
                            <div class="flex items-center justify-between pb-6 mb-6 border-b border-[#1F1F24]">
                                <span class="font-display text-3xl font-black text-neutral-600 group-hover:text-[#FF5722] transition-colors inline-block [transform:translateZ(30px)]">
                                    {{ $service['number'] }}
                                </span>
                                <span class="text-[10px] uppercase tracking-widest text-neutral-400 font-semibold px-3 py-1 bg-[#151518] border border-[#1F1F24] inline-block [transform:translateZ(20px)]">
                                    {{ $badge }}
                                </span>
                            </div>

                            <h3 class="font-display text-xl sm:text-2xl font-bold uppercase tracking-tight text-white mb-2 group-hover:text-[#FF5722] transition-colors [transform:translateZ(24px)]">
                                {{ $service['title'] }}
                            </h3>

                            <p class="text-[#FF5722] text-xs font-medium tracking-wide mb-4 [transform:translateZ(18px)]">
                                {{ $service['tagline'] }}
                            </p>

                            <p class="text-neutral-400 text-sm leading-relaxed mb-8 [transform:translateZ(14px)]">
                                {{ $service['description'] }}
                            </p>
                        </div>

                        <!-- Concrete Deliverables List (Parallax Base Layer) -->
                        <div class="relative z-10 pt-6 border-t border-[#1F1F24] bg-[#151518]/60 p-4 -mx-2 -mb-2 border border-[#1F1F24] [transform:translateZ(16px)] backdrop-blur-xs">
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
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Self-initializing interactive 3D perspective script (Graceful degradation for touch and reduced-motion) -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.__tiltCardsInitialized) return;
        window.__tiltCardsInitialized = true;

        var isTouch = window.matchMedia('(hover: none)').matches;
        var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (isTouch || prefersReducedMotion) return;

        var cards = document.querySelectorAll('[data-tilt-card]');
        cards.forEach(function (card) {
            var rafId = null;

            card.addEventListener('mousemove', function (e) {
                var rect = card.getBoundingClientRect();
                var x = e.clientX - rect.left;
                var y = e.clientY - rect.top;

                var px = ((x / rect.width) * 100).toFixed(1);
                var py = ((y / rect.height) * 100).toFixed(1);
                card.style.setProperty('--glare-x', px + '%');
                card.style.setProperty('--glare-y', py + '%');

                var rotateX = (((y / rect.height) - 0.5) * -15).toFixed(2);
                var rotateY = (((x / rect.width) - 0.5) * 15).toFixed(2);

                if (rafId) cancelAnimationFrame(rafId);
                rafId = requestAnimationFrame(function () {
                    card.style.transform = 'perspective(1000px) rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg) scale3d(1.02, 1.02, 1.02)';
                    card.style.transition = 'transform 0.08s ease-out, border-color 0.3s ease, box-shadow 0.3s ease';
                });
            });

            card.addEventListener('mouseleave', function () {
                if (rafId) cancelAnimationFrame(rafId);
                card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
                card.style.transition = 'transform 0.5s cubic-bezier(0.23, 1, 0.32, 1), border-color 0.3s ease, box-shadow 0.3s ease';
                card.style.removeProperty('--glare-x');
                card.style.removeProperty('--glare-y');
            });
        });
    });
</script>
