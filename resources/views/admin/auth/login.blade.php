<!DOCTYPE html>
<html lang="id" class="h-full bg-[#070707]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Panel Admin | MMA Production</title>
    
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
<body class="h-full bg-[#070707] text-[#F5F5F7] font-sans antialiased flex items-center justify-center p-6 selection:bg-[#FF5722] selection:text-white">

    <div class="w-full max-w-md">
        <!-- Logo Branding -->
        <div class="text-center mb-10">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF5722] rounded transition-opacity duration-200 hover:opacity-90">
                <img src="{{ asset('images/mma-logo.png') }}" alt="MMA PRODUCTION" class="h-8 md:h-[34px] w-auto object-contain">
            </a>
            <p class="mt-3 text-xs uppercase tracking-[0.25em] text-neutral-400 font-medium">
                Panel Kontrol CMS &bull; Akses Terbatas
            </p>
        </div>

        <!-- Login Card -->
        <div class="bg-[#0E0E10] border border-[#1F1F24] p-8 md:p-10 shadow-2xl shadow-black/80">
            <div class="mb-8 border-b border-[#1F1F24] pb-5">
                <h1 class="text-xl font-bold uppercase tracking-wide text-white">Masuk Administrator</h1>
                <p class="text-xs text-neutral-400 mt-1">Gunakan akun admin terdaftar untuk mengelola konten website.</p>
            </div>

            @if (session('status'))
                <div class="mb-6 p-3 bg-[#151518] border-l-2 border-[#FF5722] text-xs text-neutral-200">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-3 bg-[#180A0A] border-l-2 border-red-500 text-xs text-red-300">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                        Alamat Email Admin
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', 'admin@mmaproduction.com') }}"
                        required 
                        autofocus
                        class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722] transition-colors"
                        placeholder="admin@mmaproduction.com"
                    >
                </div>

                <div>
                    <label for="password" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                        Kata Sandi
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        required 
                        class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722] transition-colors"
                        placeholder="••••••••"
                    >
                </div>

                <div class="flex items-center justify-between text-xs text-neutral-400">
                    <label class="flex items-center space-x-2 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="accent-[#FF5722] w-4 h-4 rounded-none bg-[#070707] border-[#1F1F24]">
                        <span>Ingat sesi masuk</span>
                    </label>
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">
                        Kembali ke Situs
                    </a>
                </div>

                <div>
                    <button 
                        type="submit" 
                        class="w-full bg-[#FF5722] hover:bg-[#F4511E] text-white font-bold text-xs uppercase tracking-widest py-3.5 px-6 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#FF5722] focus:ring-offset-2 focus:ring-offset-[#070707]"
                    >
                        Masuk ke Dashboard
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center mt-8 text-neutral-400 text-xs tracking-wider">
            MMA PRODUCTION &bull; SISTEM MANAJEMEN KONTEN
        </div>
    </div>

    <!-- Global Toast Notifications -->
    <x-toast />

</body>
</html>

