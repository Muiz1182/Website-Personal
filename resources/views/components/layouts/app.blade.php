<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ app()->getLocale() === 'id' ? 'MMA PRODUCTION: Portofolio Mochammad Muiz Afdloly. Video Cinematic & Podcast, Desain UI/UX & Poster/Ilustrasi, serta Web Developer Laravel, Vue, PHP & JS.' : 'MMA PRODUCTION: Portfolio of Mochammad Muiz Afdloly. Cinematic Video & Podcasts, UI/UX & Poster/Illustration Design, and Web Development (Laravel, Vue, PHP, JS).' }}">
    <title>{{ app()->getLocale() === 'id' ? 'MMA PRODUCTION | Video Cinematic, Desain UI/UX & Web Developer Laravel' : 'MMA PRODUCTION | Cinematic Video, UI/UX Design & Laravel Web Developer' }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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

</body>
</html>
