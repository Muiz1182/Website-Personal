@props(['strings' => []])

@php
    $isId = app()->getLocale() === 'id';
    $bio = $strings['bio'] ?? ($isId ? 'Video cinematic & podcast, desain UI/UX & ilustrasi poster, serta web development modern (Laravel, Vue, PHP, JS) oleh Mochammad Muiz Afdloly.' : 'Cinematic video & podcast, UI/UX & poster illustration, and modern web development (Laravel, Vue, PHP, JS) by Mochammad Muiz Afdloly.');
    $hub = $strings['hub'] ?? 'Creative Hub: Surabaya &bull; Jakarta, Indonesia';
    $navTitle = $strings['nav_title'] ?? ($isId ? 'Navigasi' : 'Navigation');
    $navTop = $strings['nav_top'] ?? ($isId ? 'Kembali ke Atas' : 'Top // Overview');
    $navWorks = $strings['nav_works'] ?? ($isId ? 'Karya Pilihan' : 'Selected Works');
    $navServices = $strings['nav_services'] ?? ($isId ? '3 Pilar Keahlian' : 'Core Disciplines');
    $navDirector = $strings['nav_director'] ?? ($isId ? 'Profil Kreator' : 'About Creator');
    $navCredits = $strings['nav_credits'] ?? ($isId ? 'Ulasan Klien' : 'Client Credits');
    $navContact = $strings['nav_contact'] ?? ($isId ? 'Pemesanan Proyek' : 'Commission a Project');
    $backToTop = $isId ? 'Kembali ke Atas' : 'Back to Top';
@endphp

<footer class="bg-[#070707] text-neutral-400 py-20 px-6 md:px-12 border-t border-[#1F1F24]" role="contentinfo">
    <div class="max-w-7xl mx-auto space-y-16">
        
        <!-- Top Footer Grid -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-16 pb-16 border-b border-[#1F1F24]">
            <!-- Col 1: Studio Identity -->
            <div class="md:col-span-5 space-y-6">
                <a href="/" class="group inline-flex items-center space-x-2 text-white font-extrabold text-2xl tracking-tighter uppercase focus-visible:outline-none">
                    <span class="font-display">MMA</span>
                    <span class="text-[#FF5722]">.</span>
                    <span class="text-neutral-300 font-light text-base tracking-widest">PRODUCTION</span>
                </a>
                <p class="text-sm leading-relaxed text-neutral-400 font-normal max-w-sm">
                    {{ $bio }}
                </p>
                <div class="pt-2">
                    <span class="text-xs text-neutral-500 font-medium">
                        {!! $hub !!}
                    </span>
                </div>
            </div>

            <!-- Col 2: Navigation Links -->
            <div class="md:col-span-3 space-y-4">
                <h4 class="text-white font-bold text-xs uppercase tracking-[0.2em]">
                    {{ $navTitle }}
                </h4>
                <ul class="space-y-3 text-xs uppercase tracking-wider font-medium text-neutral-400">
                    <li>
                        <a href="#hero" class="hover:text-white transition-colors">
                            {{ $navTop }}
                        </a>
                    </li>
                    <li>
                        <a href="#works" class="hover:text-white transition-colors">
                            {{ $navWorks }}
                        </a>
                    </li>
                    <li>
                        <a href="#services" class="hover:text-white transition-colors">
                            {{ $navServices }}
                        </a>
                    </li>
                    <li>
                        <a href="#director" class="hover:text-white transition-colors">
                            {{ $navDirector }}
                        </a>
                    </li>
                    @if ($strings['has_testimonials'] ?? false)
                        <li>
                            <a href="#clients" class="hover:text-white transition-colors">
                                {{ $navCredits }}
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="#contact" class="hover:text-[#FF5722] transition-colors">
                            {{ $navContact }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Col 3: Direct Connect & Inquiries -->
            <div class="md:col-span-4 space-y-4">
                <h4 class="text-white font-bold text-xs uppercase tracking-[0.2em]">
                    {{ $isId ? 'Kontak Langsung' : 'Direct Inquiries' }}
                </h4>
                <div class="space-y-3 text-xs text-neutral-400">
                    <p>
                        <span class="text-neutral-500 block text-[10px] uppercase tracking-widest">Email</span>
                        <a href="mailto:muiz1182.business@gmail.com" class="text-white hover:text-[#FF5722] transition-colors font-medium">
                            muiz1182.business@gmail.com
                        </a>
                    </p>
                    <p>
                        <span class="text-neutral-500 block text-[10px] uppercase tracking-widest">WhatsApp</span>
                        <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" class="text-neutral-300 hover:text-[#FF5722] transition-colors font-medium">
                            +62 812-3456-7890 (Chat)
                        </a>
                    </p>
                    <p>
                        <span class="text-neutral-500 block text-[10px] uppercase tracking-widest">{{ $isId ? 'Keahlian Inti' : 'Core Disciplines' }}</span>
                        <span class="text-neutral-400">Cinematic &amp; Podcast &bull; UI/UX, Ilustrasi &amp; Poster &bull; Laravel &amp; Vue</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Bottom Copyright & Back to Top -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-6 text-xs text-neutral-500">
            <p class="uppercase tracking-widest text-[11px]">
                &copy; {{ date('Y') }} MMA PRODUCTION. {{ $isId ? 'MOCHAMMAD MUIZ AFDLOLY (VIDEOGRAPHY, DESIGN, WEB DEVELOPER). HAK CIPTA DILINDUNGI.' : 'MOCHAMMAD MUIZ AFDLOLY (VIDEOGRAPHY, DESIGN, WEB DEVELOPER). ALL RIGHTS RESERVED.' }}
            </p>
            
            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}" class="text-neutral-500 hover:text-neutral-300 text-[11px] uppercase tracking-wider transition-colors">
                    Admin CMS
                </a>
                <button 
                    onclick="window.scrollTo({ top: 0, behavior: 'smooth' })" 
                    class="min-h-[44px] flex items-center space-x-2 text-neutral-400 hover:text-white uppercase tracking-widest text-[11px] font-semibold transition-colors focus-visible:outline-none"
                    aria-label="{{ $isId ? 'Kembali ke atas halaman' : 'Scroll back to top of page' }}"
                >
                    <span>{{ $backToTop }}</span>
                    <span class="text-[#FF5722]">&uarr;</span>
                </button>
            </div>
        </div>
    </div>
</footer>
