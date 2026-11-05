<!DOCTYPE html>
<html lang="id" class="h-full bg-[#070707]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerbang Keamanan | MMA Production</title>
    
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
        /* Hilangkan icon bawaan browser (Edge/Chrome) agar tidak menumpuk dengan icon custom */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none !important;
        }
        input[type="password"]::-webkit-credentials-auto-fill-button {
            visibility: hidden !important;
            pointer-events: none !important;
            position: absolute !important;
            right: 0 !important;
        }
    </style>
</head>
<body class="h-full bg-[#070707] text-[#F5F5F7] font-sans antialiased flex items-center justify-center p-6 selection:bg-[#FF5722] selection:text-white">

    <div class="w-full max-w-md">
        <!-- Logo Branding -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#FF5722] rounded py-1 transition-opacity duration-200 hover:opacity-90">
                <img src="{{ asset('images/mma-logo.png') }}" alt="MMA PRODUCTION" class="h-8 md:h-[34px] w-auto object-contain">
            </a>
            <p class="mt-3 text-[11px] uppercase tracking-[0.25em] text-neutral-400 font-semibold">
                Sistem Keamanan CMS &bull; Gerbang Akses
            </p>
        </div>

        <!-- Security Gate Card -->
        <div class="bg-[#0E0E10] border border-[#1F1F24] p-8 md:p-10 shadow-2xl shadow-black/80 relative overflow-hidden">
            <!-- Subtle Top Orange Glow Line -->
            <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-[#FF5722] to-transparent"></div>

            <div class="mb-7 border-b border-[#1F1F24] pb-6 flex items-start space-x-4">
                <div class="w-11 h-11 bg-[#151518] border border-[#1F1F24] flex items-center justify-center shrink-0 text-[#FF5722]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-bold uppercase tracking-wider text-white">Verifikasi Gerbang Akses</h1>
                    <p class="text-xs text-neutral-400 mt-1 leading-relaxed">
                        Masukkan kunci akses keamanan khusus untuk membuka pintu masuk administrator.
                    </p>
                </div>
            </div>

            @if ($errors->has('gate_key'))
                <div class="mb-6 p-4 bg-[#180A0A] border-l-2 border-red-500 text-xs text-red-300 flex items-start space-x-2.5">
                    <svg class="w-4 h-4 text-red-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span>{{ $errors->first('gate_key') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.gate.verify') }}" method="POST" class="space-y-6" x-data="{ show: false }">
                @csrf

                <div>
                    <label for="gate_key" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                        Kunci Akses Gerbang (Security Key)
                    </label>
                    <div style="position: relative; width: 100%;">
                        <input 
                            :type="show ? 'text' : 'password'" 
                            name="gate_key" 
                            id="gate_key" 
                            required 
                            autofocus
                            class="w-full bg-[#070707] border border-[#1F1F24] text-white text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722] transition-colors tracking-wider"
                            style="width: 100%; height: 48px; padding-left: 16px; padding-right: 48px; box-sizing: border-box; display: block;"
                            placeholder="Masukkan kunci akses gerbang..."
                            autocomplete="off"
                        >
                        <button 
                            type="button" 
                            @click="show = !show" 
                            class="text-neutral-400 hover:text-white transition-colors focus:outline-none cursor-pointer"
                            style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; background: transparent; border: none; z-index: 30;"
                            aria-label="Tampilkan atau sembunyikan kunci sandi"
                        >
                            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" x-cloak class="w-5 h-5 text-[#FF5722]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-[11px] text-neutral-500 mt-2 flex items-center justify-between">
                        <span>Batas toleransi kesalahan: <strong>3 kali</strong></span>
                        <span class="text-neutral-500 font-mono">Sensitif huruf besar/kecil</span>
                    </p>
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-[#FF5722] hover:bg-[#F4511E] text-white py-3.5 px-4 text-xs font-bold uppercase tracking-widest transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#FF5722] focus:ring-offset-2 focus:ring-offset-[#070707] shadow-lg shadow-[#FF5722]/20 cursor-pointer"
                >
                    Verifikasi &amp; Buka Akses Login
                </button>

                <div class="pt-4 border-t border-[#1F1F24] flex items-center justify-between text-xs text-neutral-400">
                    <span class="text-neutral-500 text-[11px]">&bull; Proteksi Intrusi Permanen</span>
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">
                        &larr; Kembali ke Beranda
                    </a>
                </div>
            </form>
        </div>

        <p class="text-center text-[11px] text-neutral-600 mt-8 tracking-wider uppercase">
            &copy; {{ date('Y') }} MMA PRODUCTION. ALL RIGHTS RESERVED.
        </p>
    </div>

    <!-- Global Toast Notifications -->
    <x-toast />

</body>
</html>

