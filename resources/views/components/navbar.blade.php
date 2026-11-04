@props(['strings' => []])

@php
    $isId = app()->getLocale() === 'id';
@endphp

<nav 
    x-data="{ open: false, scrolled: false }" 
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
    :class="scrolled ? 'bg-[#070707]/95 border-b border-[#1F1F24] py-4 shadow-xl shadow-black/40' : 'bg-[#070707]/75 border-b border-[#1F1F24]/60 py-6'"
    class="fixed top-0 left-0 w-full z-50 backdrop-blur-md transition-all duration-300"
    role="navigation"
    aria-label="{{ $isId ? 'Navigasi Utama' : 'Main Navigation' }}"
>
    <div class="max-w-7xl mx-auto px-6 md:px-12 flex justify-between items-center">
        <!-- Brand Mark -->
        <a href="/" class="group flex items-center focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF5722] rounded py-0.5 transition-opacity duration-200 hover:opacity-90">
            <img src="{{ asset('images/mma-logo.png') }}" alt="MMA PRODUCTION" class="h-[25px] md:h-[26px] w-auto object-contain">
        </a>

        <!-- Desktop Navigation Items -->
        <div class="hidden md:flex items-center space-x-8">
            <div class="flex space-x-8 text-xs uppercase tracking-[0.2em] font-semibold text-neutral-400">
                <a href="#works" class="hover:text-white transition-colors duration-200 py-2 focus-visible:outline-none focus-visible:text-[#FF5722]">
                    {{ $strings['works'] ?? ($isId ? 'Karya' : 'Works') }}
                </a>
                <a href="#services" class="hover:text-white transition-colors duration-200 py-2 focus-visible:outline-none focus-visible:text-[#FF5722]">
                    {{ $strings['services'] ?? ($isId ? 'Layanan' : 'Capabilities') }}
                </a>
                <a href="#director" class="hover:text-white transition-colors duration-200 py-2 focus-visible:outline-none focus-visible:text-[#FF5722]">
                    {{ $strings['director'] ?? ($isId ? 'Profil' : 'About') }}
                </a>
                @if ($strings['has_testimonials'] ?? false)
                    <a href="#clients" class="hover:text-white transition-colors duration-200 py-2 focus-visible:outline-none focus-visible:text-[#FF5722]">
                        {{ $strings['clients'] ?? ($isId ? 'Klien' : 'Credits') }}
                    </a>
                @endif
            </div>

            <!-- Language Switcher (Segmented Control ID | EN) -->
            <div class="flex items-center bg-[#151518] border border-[#1F1F24] p-1 text-[11px] font-bold tracking-wider uppercase select-none" role="group" aria-label="{{ $isId ? 'Pilihan Bahasa' : 'Language Selector' }}">
                <a 
                    href="{{ route('lang.switch', 'id') }}" 
                    class="px-2.5 py-1 transition-colors {{ $isId ? 'bg-[#FF5722] text-white font-extrabold' : 'text-neutral-400 hover:text-white' }}"
                    title="Bahasa Indonesia"
                    aria-label="Ubah ke Bahasa Indonesia"
                >
                    ID
                </a>
                <span class="text-neutral-600 px-0.5">/</span>
                <a 
                    href="{{ route('lang.switch', 'en') }}" 
                    class="px-2.5 py-1 transition-colors {{ !$isId ? 'bg-[#FF5722] text-white font-extrabold' : 'text-neutral-400 hover:text-white' }}"
                    title="English"
                    aria-label="Switch to English"
                >
                    EN
                </a>
            </div>
            
            <div class="flex items-center pl-2">
                <a href="#contact" class="inline-flex items-center justify-center bg-[#FF5722] hover:bg-[#F4511E] text-white text-xs font-bold uppercase tracking-widest px-5 py-3 transition-colors duration-200 focus-visible:outline-none">
                    {{ $strings['start_project'] ?? ($isId ? 'Mulai Proyek' : 'Start Project') }}
                </a>
            </div>
        </div>

        <!-- Mobile Menu Toggle & Switcher -->
        <div class="md:hidden flex items-center space-x-3">
            <!-- Mobile Language Switcher -->
            <div class="flex items-center bg-[#151518] border border-[#1F1F24] p-0.5 text-[10px] font-bold tracking-wider uppercase">
                <a 
                    href="{{ route('lang.switch', 'id') }}" 
                    class="px-2 py-1 transition-colors {{ $isId ? 'bg-[#FF5722] text-white' : 'text-neutral-400' }}"
                >
                    ID
                </a>
                <span class="text-neutral-600">/</span>
                <a 
                    href="{{ route('lang.switch', 'en') }}" 
                    class="px-2 py-1 transition-colors {{ !$isId ? 'bg-[#FF5722] text-white' : 'text-neutral-400' }}"
                >
                    EN
                </a>
            </div>

            <button 
                @click="open = !open" 
                :aria-expanded="open.toString()"
                aria-label="{{ $isId ? 'Buka tutup menu navigasi' : 'Toggle navigation menu' }}"
                class="min-w-[44px] min-h-[44px] flex items-center justify-center text-white text-xs uppercase tracking-[0.2em] font-bold border border-[#1F1F24] px-4 py-2 hover:border-neutral-500 transition-colors focus-visible:outline-none"
            >
                <span x-text="open ? '{{ $isId ? 'Tutup' : 'Close' }}' : 'Menu'"></span>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div 
        x-show="open" 
        x-transition:enter="transition ease-out duration-250"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        @keydown.escape.window="open = false"
        x-cloak
        class="md:hidden border-b border-[#1F1F24] bg-[#0E0E10] px-6 py-8 shadow-2xl"
    >
        <div class="flex flex-col space-y-5 text-sm uppercase tracking-widest font-semibold" @click="open = false">
            <a href="#works" class="py-2 text-neutral-300 hover:text-[#FF5722] transition-colors">
                {{ $strings['works'] ?? ($isId ? 'Karya Pilihan' : 'Works (Portfolio)') }}
            </a>
            <a href="#services" class="py-2 text-neutral-300 hover:text-[#FF5722] transition-colors">
                {{ $strings['services'] ?? ($isId ? 'Keahlian & Layanan' : 'Capabilities & Services') }}
            </a>
            <a href="#director" class="py-2 text-neutral-300 hover:text-[#FF5722] transition-colors">
                {{ $strings['director'] ?? ($isId ? 'Profil Kreator' : 'About Creator') }}
            </a>
            @if ($strings['has_testimonials'] ?? false)
                <a href="#clients" class="py-2 text-neutral-300 hover:text-[#FF5722] transition-colors">
                    {{ $strings['clients'] ?? ($isId ? 'Kredit Produksi' : 'Production Credits') }}
                </a>
            @endif
            
            <div class="pt-6 border-t border-[#1F1F24] flex flex-col space-y-4">
                <a href="#contact" class="w-full text-center bg-[#FF5722] hover:bg-[#F4511E] text-white py-3 text-xs uppercase font-bold tracking-widest transition-colors">
                    {{ $strings['start_project'] ?? ($isId ? 'Mulai Proyek' : 'Start a Project') }}
                </a>
            </div>
        </div>
    </div>
</nav>
