@props(['strings' => []])

@php
    $isId = app()->getLocale() === 'id';
    $bio = $strings['bio'] ?? ($isId ? 'Video cinematic & podcast, desain UI/UX & ilustrasi poster, serta web development modern (Laravel, Vue, PHP, JS) oleh Mochammad Muiz Afdloly.' : 'Cinematic video & podcast, UI/UX & poster illustration, and modern web development (Laravel, Vue, PHP, JS) by Mochammad Muiz Afdloly.');
    $hub = $strings['hub'] ?? ($isId ? 'Basis Kreatif: Probolinggo, Jawa Timur, Indonesia' : 'Creative Hub: Probolinggo, East Java, Indonesia');
    $navTitle = $strings['nav_title'] ?? ($isId ? 'Navigasi' : 'Navigation');
    $navTop = $strings['nav_top'] ?? ($isId ? 'Beranda' : 'Overview');
    $navWorks = $strings['nav_works'] ?? ($isId ? 'Karya Pilihan' : 'Selected Works');
    $navServices = $strings['nav_services'] ?? ($isId ? '3 Pilar Keahlian' : 'Core Disciplines');
    $navDirector = $strings['nav_director'] ?? ($isId ? 'Profil Kreator' : 'About Creator');
    $navCredits = $strings['nav_credits'] ?? ($isId ? 'Ulasan Klien' : 'Client Credits');
    $navContact = $strings['nav_contact'] ?? ($isId ? 'Pemesanan Proyek' : 'Commission a Project');
@endphp

<footer class="bg-[#070707] text-neutral-400 py-20 px-6 md:px-12 border-t border-[#1F1F24]" role="contentinfo">
    <div class="max-w-7xl mx-auto space-y-16">
        
        <!-- Top Footer Grid -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-16 pb-16 border-b border-[#1F1F24]">
            <!-- Col 1: Studio Identity -->
            <div class="md:col-span-5 space-y-6">
                <a href="/" class="group inline-flex items-center focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF5722] rounded py-0.5 transition-opacity duration-200 hover:opacity-90">
                    <img src="{{ asset('images/mma-logo.png') }}" alt="MMA PRODUCTION" class="h-[28px] md:h-[30px] w-auto object-contain">
                </a>
                <p class="text-sm leading-relaxed text-neutral-400 font-normal max-w-sm">
                    {{ $bio }}
                </p>
                <div class="pt-2">
                    <span class="text-xs text-neutral-500 font-medium">
                        {!! $hub !!}
                    </span>
                </div>

                <!-- Social Media Channels -->
                <div class="pt-2">
                    <span class="text-neutral-500 block text-[10px] uppercase tracking-widest font-semibold mb-3">
                        {{ $isId ? 'Kanal Media Sosial' : 'Social Channels' }}
                    </span>
                    <div class="flex flex-wrap items-center gap-2.5">
                        <a 
                            href="https://www.instagram.com/mmadesain/" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="min-w-[44px] min-h-[44px] w-11 h-11 bg-[#121215] border border-[#1F1F24] hover:border-[#FF5722] text-neutral-400 hover:text-white hover:bg-[#FF5722]/15 flex items-center justify-center transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF5722]"
                            aria-label="Instagram @mmadesain"
                            title="Instagram: @mmadesain"
                        >
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>

                        <a 
                            href="https://www.tiktok.com/@muiz1182" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="min-w-[44px] min-h-[44px] w-11 h-11 bg-[#121215] border border-[#1F1F24] hover:border-[#FF5722] text-neutral-400 hover:text-white hover:bg-[#FF5722]/15 flex items-center justify-center transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF5722]"
                            aria-label="TikTok @muiz1182"
                            title="TikTok: @muiz1182"
                        >
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1.04-.1z"/>
                            </svg>
                        </a>

                        <a 
                            href="https://www.youtube.com/@Muiz1182" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="min-w-[44px] min-h-[44px] w-11 h-11 bg-[#121215] border border-[#1F1F24] hover:border-[#FF5722] text-neutral-400 hover:text-white hover:bg-[#FF5722]/15 flex items-center justify-center transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF5722]"
                            aria-label="YouTube @Muiz1182"
                            title="YouTube: @Muiz1182"
                        >
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>

                        <a 
                            href="https://www.linkedin.com/in/mochammad-mu-iz-afdloly-2bb873190/" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="min-w-[44px] min-h-[44px] w-11 h-11 bg-[#121215] border border-[#1F1F24] hover:border-[#FF5722] text-neutral-400 hover:text-white hover:bg-[#FF5722]/15 flex items-center justify-center transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF5722]"
                            aria-label="LinkedIn Mochammad Mu'iz Afdloly"
                            title="LinkedIn: Mochammad Mu'iz Afdloly"
                        >
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>

                        <a 
                            href="https://discord.gg/CTDXJtMZPX" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="min-w-[44px] min-h-[44px] w-11 h-11 bg-[#121215] border border-[#1F1F24] hover:border-[#FF5722] text-neutral-400 hover:text-white hover:bg-[#FF5722]/15 flex items-center justify-center transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF5722]"
                            aria-label="Discord Community"
                            title="Discord: MMA Community"
                        >
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994.021-.041.001-.09-.041-.106a13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.061 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.894.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.028zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/>
                            </svg>
                        </a>

                        <a 
                            href="https://github.com/Muiz1182" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="min-w-[44px] min-h-[44px] w-11 h-11 bg-[#121215] border border-[#1F1F24] hover:border-[#FF5722] text-neutral-400 hover:text-white hover:bg-[#FF5722]/15 flex items-center justify-center transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF5722]"
                            aria-label="GitHub Muiz1182"
                            title="GitHub: Muiz1182"
                        >
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                            </svg>
                        </a>
                    </div>
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
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=muiz1182.business@gmail.com" target="_blank" rel="noopener noreferrer" class="text-white hover:text-[#FF5722] transition-colors font-medium">
                            muiz1182.business@gmail.com
                        </a>
                    </p>
                    <p>
                        <span class="text-neutral-500 block text-[10px] uppercase tracking-widest">WhatsApp</span>
                        <a href="https://wa.me/6285174421182" target="_blank" rel="noopener noreferrer" class="text-neutral-300 hover:text-[#FF5722] transition-colors font-medium">
                            +62 851 7442 1182 (Chat)
                        </a>
                    </p>
                    <p>
                        <span class="text-neutral-500 block text-[10px] uppercase tracking-widest">{{ $isId ? 'Keahlian Inti' : 'Core Disciplines' }}</span>
                        <span class="text-neutral-400">Cinematic &amp; Podcast &bull; UI/UX, Ilustrasi &amp; Poster &bull; Laravel &amp; Vue</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Bottom Copyright -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-6 text-xs text-neutral-500">
            <p class="uppercase tracking-widest text-[11px]">
                &copy; {{ date('Y') }} MMA PRODUCTION. {{ $isId ? 'MOCHAMMAD MUIZ AFDLOLY. HAK CIPTA DILINDUNGI.' : 'MOCHAMMAD MUIZ AFDLOLY. ALL RIGHTS RESERVED.' }}
            </p>
        </div>
    </div>
</footer>
