@props([
    'projects' => [],
    'strings' => []
])

@php
    $isId = app()->getLocale() === 'id';
    $eyebrow = $strings['eyebrow'] ?? ($isId ? 'Portofolio • Karya Pilihan' : 'Portfolio • Curated Reel');
    $title = $strings['title'] ?? ($isId ? 'KARYA PILIHAN' : 'SELECTED WORKS');
    $filterAll = $strings['filter_all'] ?? ($isId ? 'Semua' : 'All');
    $filterVideo = $strings['filter_video'] ?? ($isId ? 'Videografi' : 'Videography');
    $filterDesign = $strings['filter_design'] ?? ($isId ? 'Desain' : 'Design');
    $filterWeb = $strings['filter_web'] ?? ($isId ? 'Website Developer' : 'Web Developer');
    $modalStrings = $strings['modal'] ?? [];
@endphp

<section 
    id="works" 
    x-data="{ 
        activeCategory: 'All',
        activeModal: null,
        projectsList: {{ Js::from($projects) }},
        filterProjects(cat) {
            this.activeCategory = cat;
        },
        openProject(item) {
            this.activeModal = item;
            document.body.style.overflow = 'hidden';
        },
        closeModal() {
            this.activeModal = null;
            document.body.style.overflow = '';
        }
    }"
    class="bg-[#070707] text-[#F5F5F7] py-28 px-6 md:px-12 border-b border-[#1F1F24]"
>
    <div class="max-w-7xl mx-auto">
        <!-- Section Header with Category Tabs -->
        <div class="flex flex-col md:flex-row md:items-end justify-between pb-12 mb-12 border-b border-[#1F1F24] gap-8">
            <div>
                <p class="text-xs uppercase tracking-[0.25em] font-semibold text-[#FF5722] mb-3">
                    {{ $eyebrow }}
                </p>
                <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl font-black uppercase tracking-tight text-white">
                    {{ $title }}
                </h2>
            </div>

            <!-- Filter Buttons (Instant Interactive Switching) -->
            <div class="flex flex-wrap gap-2 text-xs uppercase tracking-widest font-semibold" role="tablist" aria-label="Project category filters">
                <button 
                    @click="filterProjects('All')" 
                    :class="activeCategory === 'All' ? 'bg-[#FF5722] text-white' : 'bg-[#0E0E10] text-neutral-400 hover:text-white border border-[#1F1F24]'"
                    class="min-h-[44px] px-5 py-2 transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF5722] focus-visible:ring-offset-2 focus-visible:ring-offset-[#070707]"
                    role="tab"
                    :aria-selected="(activeCategory === 'All').toString()"
                >
                    {{ $filterAll }} ({{ count($projects) }})
                </button>
                <button 
                    @click="filterProjects('Videography')" 
                    :class="activeCategory === 'Videography' ? 'bg-[#FF5722] text-white' : 'bg-[#0E0E10] text-neutral-400 hover:text-white border border-[#1F1F24]'"
                    class="min-h-[44px] px-5 py-2 transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF5722] focus-visible:ring-offset-2 focus-visible:ring-offset-[#070707]"
                    role="tab"
                    :aria-selected="(activeCategory === 'Videography').toString()"
                >
                    {{ $filterVideo }}
                </button>
                <button 
                    @click="filterProjects('Design')" 
                    :class="activeCategory === 'Design' ? 'bg-[#FF5722] text-white' : 'bg-[#0E0E10] text-neutral-400 hover:text-white border border-[#1F1F24]'"
                    class="min-h-[44px] px-5 py-2 transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF5722] focus-visible:ring-offset-2 focus-visible:ring-offset-[#070707]"
                    role="tab"
                    :aria-selected="(activeCategory === 'Design').toString()"
                >
                    {{ $filterDesign }}
                </button>
                <button 
                    @click="filterProjects('Web Developer')" 
                    :class="activeCategory === 'Web Developer' ? 'bg-[#FF5722] text-white' : 'bg-[#0E0E10] text-neutral-400 hover:text-white border border-[#1F1F24]'"
                    class="min-h-[44px] px-5 py-2 transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF5722] focus-visible:ring-offset-2 focus-visible:ring-offset-[#070707]"
                    role="tab"
                    :aria-selected="(activeCategory === 'Web Developer').toString()"
                >
                    {{ $filterWeb }}
                </button>
            </div>
        </div>

        <!-- Asymmetric Works Grid (Reflecting RHYTHM 3) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <template x-for="project in projectsList" :key="project.id">
                <div 
                    x-show="activeCategory === 'All' || project.category === activeCategory"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    :class="project.span"
                    @click="openProject(project)"
                    @keydown.enter="openProject(project)"
                    @keydown.space.prevent="openProject(project)"
                    tabindex="0"
                    role="button"
                    :aria-label="'View details for ' + project.title"
                    class="group relative bg-[#0E0E10] border border-[#1F1F24] overflow-hidden cursor-pointer hover:border-[#FF5722]/60 transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF5722] focus-visible:ring-offset-2 focus-visible:ring-offset-[#070707]"
                >
                    <!-- Visual Container with Aspect Ratio -->
                    <div :class="project.aspect || 'aspect-[16/9]'" class="relative w-full overflow-hidden bg-[#151518]">
                        <img 
                            :src="project.image" 
                            :alt="project.title" 
                            loading="lazy"
                            class="w-full h-full object-cover grayscale contrast-125 group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700 ease-out"
                        >
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0E0E10] via-transparent to-transparent opacity-80 group-hover:opacity-40 transition-opacity duration-300"></div>

                        <!-- Badge Overlay -->
                        <div class="absolute top-4 left-4 flex items-center space-x-2">
                            <span class="bg-[#070707]/90 text-[#FF5722] text-[10px] uppercase font-bold tracking-widest px-3 py-1 border border-[#1F1F24]" x-text="project.category"></span>
                            <span class="bg-[#070707]/90 text-neutral-300 text-[10px] uppercase font-medium tracking-widest px-3 py-1 border border-[#1F1F24]" x-text="project.year"></span>
                        </div>

                        <!-- Hover Prompt Cue -->
                        <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <span class="bg-[#FF5722] text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1">
                                {{ $isId ? 'Lihat Spesifikasi' : 'View Specs' }}
                            </span>
                        </div>
                    </div>

                    <!-- Meta Information -->
                    <div class="p-6 md:p-8 space-y-3 bg-[#0E0E10]">
                        <div class="flex items-center justify-between text-xs text-neutral-400">
                            <span class="uppercase tracking-widest font-medium" x-text="project.tag"></span>
                            <span class="text-neutral-500 text-[11px]" x-text="project.specs"></span>
                        </div>

                        <h3 class="font-display text-2xl font-bold tracking-tight text-white group-hover:text-[#FF5722] transition-colors" x-text="project.title"></h3>

                        <p class="text-neutral-400 text-sm leading-relaxed line-clamp-2" x-text="project.description"></p>
                    </div>
                </div>
            </template>
        </div>

        <!-- Empty State -->
        <div 
            x-show="projectsList.filter(p => activeCategory === 'All' || p.category === activeCategory).length === 0" 
            x-cloak
            class="py-24 text-center border border-dashed border-[#1F1F24] p-12 bg-[#0E0E10]"
        >
            <p class="text-xs uppercase tracking-[0.25em] text-[#FF5722] font-semibold mb-2">
                {{ $isId ? 'Arsip Kategori Belum Tersedia' : 'Category Archive Empty' }}
            </p>
            <p class="text-sm text-neutral-400 mb-6">
                {{ $isId ? 'Belum ada karya yang diarsipkan dalam kategori ini.' : 'No productions currently cataloged under this specific category.' }}
            </p>
            <button 
                @click="filterProjects('All')" 
                class="bg-[#FF5722] text-white text-xs uppercase font-bold tracking-widest px-6 py-3"
            >
                {{ $isId ? 'Kembalikan ke Semua Karya' : 'Reset Filter to All' }}
            </button>
        </div>

        <!-- Interactive Project Modal Dialog -->
        <div 
            x-show="activeModal" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @keydown.escape.window="closeModal()"
            x-cloak
            class="fixed inset-0 z-[110] flex items-center justify-center p-4 sm:p-6 bg-black/85 backdrop-blur-md"
            role="dialog"
            aria-modal="true"
            :aria-label="activeModal ? activeModal.title : 'Project Details'"
        >
            <div 
                @click.away="closeModal()" 
                class="relative w-full max-w-4xl max-h-[90vh] overflow-y-auto bg-[#0E0E10] border border-[#1F1F24] shadow-2xl p-6 sm:p-10 space-y-6"
            >
                <!-- Close Button -->
                <div class="flex items-center justify-between pb-4 border-b border-[#1F1F24]">
                    <div>
                        <span class="text-xs uppercase tracking-widest text-[#FF5722] font-semibold" x-text="activeModal?.category"></span>
                        <h3 class="font-display text-2xl sm:text-3xl font-bold uppercase text-white mt-1" x-text="activeModal?.title"></h3>
                    </div>
                    <button 
                        @click="closeModal()" 
                        class="min-w-[44px] min-h-[44px] flex items-center justify-center border border-[#1F1F24] text-neutral-400 hover:text-white hover:border-white text-xs uppercase font-bold tracking-widest px-3 py-2 transition-colors"
                        aria-label="Close dialog"
                    >
                        {{ $modalStrings['close'] ?? ($isId ? 'Tutup [ESC]' : 'Close [ESC]') }}
                    </button>
                </div>

                <!-- Preview Image -->
                <div class="aspect-[16/9] w-full overflow-hidden bg-[#151518] border border-[#1F1F24]">
                    <img 
                        :src="activeModal?.image" 
                        :alt="activeModal?.title" 
                        class="w-full h-full object-cover"
                    >
                </div>

                <!-- Production Metadata Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-5 bg-[#151518] border border-[#1F1F24] text-xs">
                    <div>
                        <span class="text-neutral-500 uppercase block tracking-wider text-[10px]">
                            {{ $isId ? 'Konteks / Klien' : 'Client / Context' }}
                        </span>
                        <span class="font-bold text-white mt-1 block" x-text="activeModal?.tag"></span>
                    </div>
                    <div>
                        <span class="text-neutral-500 uppercase block tracking-wider text-[10px]">
                            {{ $modalStrings['specs'] ?? ($isId ? 'Spesifikasi Teknis' : 'Technical Specifications') }}
                        </span>
                        <span class="font-bold text-white mt-1 block" x-text="activeModal?.specs"></span>
                    </div>
                    <div>
                        <span class="text-neutral-500 uppercase block tracking-wider text-[10px]">
                            {{ $modalStrings['year'] ?? ($isId ? 'Tahun Rilis' : 'Production Year') }}
                        </span>
                        <span class="font-bold text-white mt-1 block" x-text="activeModal?.year"></span>
                    </div>
                </div>

                <!-- Synopsis Narrative -->
                <div class="space-y-2">
                    <h4 class="text-xs uppercase tracking-widest font-semibold text-neutral-300">
                        {{ $modalStrings['overview'] ?? ($isId ? 'Catatan & Sinopsis Produksi' : 'Production Synopsis') }}
                    </h4>
                    <p class="text-neutral-400 text-sm leading-relaxed" x-text="activeModal?.description"></p>
                </div>

                <!-- Action Button in Modal -->
                <div class="pt-4 border-t border-[#1F1F24] flex flex-wrap justify-between items-center gap-4">
                    <p class="text-xs text-neutral-500">
                        {{ $isId ? 'Dikerjakan oleh Mochammad Muiz Afdloly (Videography, Design & Web Development)' : 'Crafted by Mochammad Muiz Afdloly (Videography, Design & Web Development)' }}
                    </p>
                    <a 
                        href="#contact" 
                        @click="closeModal()" 
                        class="inline-flex items-center justify-center bg-[#FF5722] hover:bg-[#F4511E] text-white text-xs font-bold uppercase tracking-widest px-6 py-3 transition-colors"
                    >
                        {{ $modalStrings['discuss_cta'] ?? ($isId ? 'Diskusikan Proyek Serupa' : 'Commission Similar Project') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
