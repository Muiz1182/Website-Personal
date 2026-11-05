<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ app()->getLocale() === 'id' ? 'MMA PRODUCTION: Portofolio Mochammad Muiz Afdloly. Video Cinematic & Podcast, Desain UI/UX & Poster/Ilustrasi, serta Web Developer Laravel, Vue, PHP & JS.' : 'MMA PRODUCTION: Portfolio of Mochammad Muiz Afdloly. Cinematic Video & Podcasts, UI/UX & Poster/Illustration Design, and Web Development (Laravel, Vue, PHP, JS).' }}">
    <title>{{ $title ?? 'MMA PRODUCTION' }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#070707] text-[#F5F5F7] antialiased selection:bg-[#FF5722] selection:text-white">

    <!-- Keyboard Accessibility: Skip to Content -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[200] focus:px-4 focus:py-2 focus:bg-[#FF5722] focus:text-white focus:text-xs focus:font-bold focus:uppercase focus:tracking-wider">
        {{ app()->getLocale() === 'id' ? 'Lompat ke konten utama' : 'Skip to main content' }}
    </a>

    <x-navbar :strings="$strings['nav'] ?? []" />

    <main id="main-content" class="min-h-screen">
        {{ $slot }}
    </main>

    <x-footer :strings="$strings['footer'] ?? []" />

    <!-- Back to Top Button -->
    <div 
        x-data="{ show: false }" 
        x-init="window.addEventListener('scroll', () => { show = window.scrollY > 400 })"
        x-cloak
    >
        <button
            type="button"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 scale-90"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 scale-90"
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            aria-label="{{ app()->getLocale() === 'id' ? 'Kembali ke bagian atas' : 'Back to top' }}"
            title="{{ app()->getLocale() === 'id' ? 'Kembali ke atas' : 'Back to top' }}"
            class="fixed bottom-6 right-6 z-40 w-11 h-11 md:w-12 md:h-12 bg-[#121215]/90 hover:bg-[#FF5722] text-neutral-300 hover:text-white border border-[#26262B] hover:border-[#FF5722] shadow-xl shadow-black/60 hover:shadow-[#FF5722]/25 backdrop-blur-md flex items-center justify-center transition-all duration-300 group focus:outline-none focus-visible:ring-2 focus-visible:ring-[#FF5722] focus-visible:ring-offset-2 focus-visible:ring-offset-[#070707]"
        >
            <svg 
                class="w-5 h-5 transition-transform duration-300 group-hover:-translate-y-0.5" 
                fill="none" 
                stroke="currentColor" 
                viewBox="0 0 24 24"
                aria-hidden="true"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7" />
            </svg>
        </button>
    </div>

    <!-- Global Toast Notifications -->
    <x-toast />

</body>
</html>
