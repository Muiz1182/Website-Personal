<!DOCTYPE html>
<html lang="id" class="h-full bg-[#070707]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Admin MMA Production</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

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
<body class="h-full bg-[#070707] text-[#F5F5F7] font-sans antialiased selection:bg-[#FF5722] selection:text-white" x-data="{ sidebarOpen: false }">

    <div class="min-h-full flex flex-col lg:flex-row">
        <!-- Mobile Sidebar Backdrop -->
        <div 
            x-show="sidebarOpen" 
            x-cloak
            @click="sidebarOpen = false" 
            class="fixed inset-0 z-40 bg-black/80 lg:hidden backdrop-blur-sm"
        ></div>

        <!-- Sidebar Navigation -->
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed lg:sticky top-0 left-0 z-50 h-screen w-72 bg-[#0E0E10] border-r border-[#1F1F24] flex flex-col justify-between transition-transform duration-300 ease-in-out"
        >
            <div>
                <!-- Brand Header -->
                <div class="h-20 px-6 flex items-center justify-between border-b border-[#1F1F24]">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF5722] rounded py-1 transition-opacity duration-200 hover:opacity-90">
                        <img src="{{ asset('images/mma-logo.png') }}" alt="MMA PRODUCTION" class="h-6 w-auto object-contain">
                    </a>
                    <button @click="sidebarOpen = false" class="lg:hidden text-neutral-400 hover:text-white p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation Links -->
                <nav class="p-4 space-y-1.5 text-xs font-semibold uppercase tracking-wider">
                    <a 
                        href="{{ route('admin.dashboard') }}" 
                        class="flex items-center space-x-3 px-4 py-3 rounded-none transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#FF5722] text-white font-bold' : 'text-neutral-400 hover:text-white hover:bg-[#151518]' }}"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span>Ringkasan Dashboard</span>
                    </a>

                    <a 
                        href="{{ route('admin.projects.index') }}" 
                        class="flex items-center space-x-3 px-4 py-3 rounded-none transition-colors {{ request()->routeIs('admin.projects.*') ? 'bg-[#FF5722] text-white font-bold' : 'text-neutral-400 hover:text-white hover:bg-[#151518]' }}"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span>Karya Portofolio</span>
                    </a>

                    <a 
                        href="{{ route('admin.services.index') }}" 
                        class="flex items-center space-x-3 px-4 py-3 rounded-none transition-colors {{ request()->routeIs('admin.services.*') ? 'bg-[#FF5722] text-white font-bold' : 'text-neutral-400 hover:text-white hover:bg-[#151518]' }}"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <span>Pilar Keahlian</span>
                    </a>

                    <a 
                        href="{{ route('admin.creator.edit') }}" 
                        class="flex items-center space-x-3 px-4 py-3 rounded-none transition-colors {{ request()->routeIs('admin.creator.*') ? 'bg-[#FF5722] text-white font-bold' : 'text-neutral-400 hover:text-white hover:bg-[#151518]' }}"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Profil Kreator</span>
                    </a>

                    <a 
                        href="{{ route('admin.testimonials.index') }}" 
                        class="flex items-center space-x-3 px-4 py-3 rounded-none transition-colors {{ request()->routeIs('admin.testimonials.*') ? 'bg-[#FF5722] text-white font-bold' : 'text-neutral-400 hover:text-white hover:bg-[#151518]' }}"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        <span>Ulasan Klien</span>
                    </a>

                    <a 
                        href="{{ route('admin.announcements.index') }}" 
                        class="flex items-center space-x-3 px-4 py-3 rounded-none transition-colors {{ request()->routeIs('admin.announcements.*') ? 'bg-[#FF5722] text-white font-bold' : 'text-neutral-400 hover:text-white hover:bg-[#151518]' }}"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                        <span>Pengumuman</span>
                    </a>
                </nav>
            </div>

            <!-- Sidebar Bottom: Live Site Link & Admin Info -->
            <div class="p-4 border-t border-[#1F1F24] space-y-3">
                <a 
                    href="{{ route('home') }}" 
                    target="_blank" 
                    class="flex items-center justify-between px-4 py-2.5 bg-[#151518] hover:bg-[#1d1d22] text-neutral-300 text-xs font-semibold tracking-wider transition-colors border border-[#1F1F24]"
                >
                    <span class="flex items-center space-x-2">
                        <svg class="w-3.5 h-3.5 text-[#FF5722]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        <span>Lihat Website Utama</span>
                    </span>
                    <span class="text-neutral-400">&rarr;</span>
                </a>

                <div class="px-2 pt-2 flex items-center justify-between text-xs text-neutral-400">
                    <div class="truncate max-w-[170px]">
                        <p class="font-medium text-white truncate">{{ auth()->user()->name ?? 'Administrator' }}</p>
                        <p class="text-[11px] text-neutral-400 truncate">{{ auth()->user()->email }}</p>
                    </div>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" title="Keluar dari sesi admin" class="p-2 text-neutral-400 hover:text-[#FF5722] transition-colors focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 bg-[#070707]">
            <!-- Top Mobile Bar -->
            <header class="lg:hidden h-16 bg-[#0E0E10] border-b border-[#1F1F24] px-6 flex items-center justify-between sticky top-0 z-30">
                <button @click="sidebarOpen = true" class="text-neutral-300 hover:text-white p-2 -ml-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF5722] rounded transition-opacity duration-200 hover:opacity-90">
                    <img src="{{ asset('images/mma-logo.png') }}" alt="MMA PRODUCTION" class="h-5 w-auto object-contain">
                </a>
                <a href="{{ route('home') }}" target="_blank" class="text-xs text-[#FF5722] font-semibold uppercase">Situs &rarr;</a>
            </header>

            <!-- Page Body -->
            <main class="flex-1 p-6 md:p-10 lg:p-12 max-w-7xl w-full mx-auto">
                @if ($errors->any())
                    <div class="mb-8 p-4 bg-[#180A0A] border-l-4 border-red-500 border-y border-r border-red-900/40 text-sm text-red-200">
                        <p class="font-bold mb-1">Periksa kembali data yang dimasukkan:</p>
                        <ul class="list-disc list-inside space-y-1 text-xs text-red-300">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Global Toast Notifications -->
    <x-toast />

</body>
</html>

