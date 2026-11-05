@props(['announcement'])

@if ($announcement)
<div 
    x-data="{
        open: false,
        id: {{ $announcement->id }},
        init() {
            try {
                const seen = localStorage.getItem('mma_announcement_seen_' + this.id);
                if (!seen) {
                    // Beri jeda 400ms agar halaman utama siap dan animasi pop-up terasa mulus
                    setTimeout(() => {
                        this.open = true;
                    }, 400);
                }
            } catch (e) {
                this.open = true;
            }
        },
        closeModal() {
            this.open = false;
            try {
                localStorage.setItem('mma_announcement_seen_' + this.id, 'true');
            } catch (e) {}
        }
    }"
    x-cloak
    x-show="open"
    @keydown.escape.window="closeModal()"
    class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6"
    role="dialog"
    aria-modal="true"
    aria-labelledby="announcement-title"
>
    <!-- Backdrop Blur Gelap -->
    <div 
        x-show="open"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="closeModal()"
        class="fixed inset-0 bg-black/85 backdrop-blur-md transition-opacity"
        aria-hidden="true"
    ></div>

    <!-- Modal Box Tengah Layar -->
    <div 
        x-show="open"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        class="relative w-full max-w-lg bg-[#0E0E10] border border-[#1F1F24] p-6 sm:p-8 shadow-2xl shadow-black/90 overflow-hidden z-10"
    >
        <!-- Garis Aksen Vermillion Atas -->
        <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-[#FF5722] to-transparent"></div>

        <!-- Tombol Silang (X) di Pojok Kanan Atas -->
        <button 
            type="button" 
            @click="closeModal()" 
            aria-label="Tutup pengumuman"
            class="absolute top-4 right-4 sm:top-5 sm:right-5 w-9 h-9 flex items-center justify-center text-neutral-400 hover:text-white bg-[#151518] hover:bg-[#1F1F24] border border-[#1F1F24] transition-colors focus:outline-none focus:ring-2 focus:ring-[#FF5722] cursor-pointer"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Konten Pengumuman -->
        <div class="pr-8">
            <!-- Badge Kategori -->
            <div class="inline-flex items-center space-x-2 px-2.5 py-1 bg-[#151518] border border-[#1F1F24] text-[#FF5722] text-[10px] font-bold uppercase tracking-widest mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-[#FF5722] animate-pulse"></span>
                <span>{{ $announcement->badge ?? 'PENGUMUMAN' }}</span>
            </div>

            <!-- Judul -->
            <h2 id="announcement-title" class="font-display text-xl sm:text-2xl font-black uppercase tracking-tight text-white leading-tight">
                {{ $announcement->title }}
            </h2>
        </div>

        <!-- Isi Pesan -->
        <div class="mt-4 text-xs sm:text-sm text-neutral-300 leading-relaxed max-h-60 overflow-y-auto pr-1">
            {!! nl2br(e($announcement->content)) !!}
        </div>

        <!-- Bagian Aksi & Tombol Tutup -->
        <div class="mt-6 pt-5 border-t border-[#1F1F24] flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3">
            <button 
                type="button" 
                @click="closeModal()" 
                class="px-5 py-2.5 bg-[#151518] hover:bg-[#1F1F24] text-neutral-300 hover:text-white border border-[#1F1F24] text-xs font-semibold uppercase tracking-wider transition-colors text-center cursor-pointer"
            >
                Tutup
            </button>

            @if (!empty($announcement->action_text) && !empty($announcement->action_url))
                <a 
                    href="{{ $announcement->action_url }}" 
                    @click="closeModal()"
                    class="px-5 py-2.5 bg-[#FF5722] hover:bg-[#F4511E] text-white text-xs font-bold uppercase tracking-widest transition-colors text-center shadow-lg shadow-[#FF5722]/20"
                >
                    {{ $announcement->action_text }} &rarr;
                </a>
            @endif
        </div>
    </div>
</div>
@endif

