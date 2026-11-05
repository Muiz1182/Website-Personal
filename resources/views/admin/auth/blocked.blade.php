<!DOCTYPE html>
<html lang="id" class="h-full bg-[#070707]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Diblokir Permanen | MMA Production</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-[#070707] text-[#F5F5F7] font-sans antialiased flex items-center justify-center p-6 selection:bg-red-500 selection:text-white">

    <div class="w-full max-w-lg">
        <!-- Logo Branding -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-500 rounded py-1 transition-opacity duration-200 hover:opacity-90">
                <img src="{{ asset('images/mma-logo.png') }}" alt="MMA PRODUCTION" class="h-8 md:h-[34px] w-auto object-contain">
            </a>
            <p class="mt-3 text-[11px] uppercase tracking-[0.25em] text-red-400 font-semibold">
                Sistem Keamanan CMS &bull; Perlindungan Intrusi
            </p>
        </div>

        <!-- Blocked Card -->
        <div class="bg-[#0E0E10] border border-red-500/40 p-8 md:p-10 shadow-2xl shadow-red-950/30 relative overflow-hidden">
            <!-- Top Red Glow Line -->
            <div class="absolute top-0 left-0 right-0 h-[2.5px] bg-gradient-to-r from-transparent via-red-500 to-transparent"></div>

            <div class="mb-7 border-b border-[#1F1F24] pb-6 flex items-start space-x-4">
                <div class="w-12 h-12 bg-red-950/40 border border-red-500/50 flex items-center justify-center shrink-0 text-red-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold uppercase tracking-wider text-white">Akses Diblokir Permanen</h1>
                    <p class="text-xs text-red-400 font-medium mt-1">
                        Status: 403 Forbidden &bull; Batas 3/3 Kesalahan Tercapai
                    </p>
                </div>
            </div>

            <div class="space-y-4 text-xs text-neutral-300 leading-relaxed mb-8">
                <p>
                    Akses menuju gerbang administrator untuk alamat IP Anda telah diblokir secara permanen oleh sistem keamanan otomatis karena telah memasukkan kunci akses yang salah sebanyak <strong class="text-white">3 kali berturut-turut</strong>.
                </p>
                <p class="text-neutral-400">
                    Setiap upaya untuk mengakses URL login atau memverifikasi gerbang sandi dari jaringan ini tidak akan lagi diproses.
                </p>
            </div>

            <!-- Lockout Record Details -->
            <div class="bg-[#070707] border border-[#1F1F24] p-4 text-xs space-y-2.5 mb-8">
                <div class="flex justify-between items-center text-neutral-400">
                    <span class="text-[10px] uppercase tracking-widest text-neutral-500 font-semibold">Alamat IP Klien:</span>
                    <span class="font-mono text-white text-[11px]">{{ $ip }}</span>
                </div>
                <div class="flex justify-between items-center text-neutral-400 pt-2 border-t border-[#1F1F24]">
                    <span class="text-[10px] uppercase tracking-widest text-neutral-500 font-semibold">Waktu Pemblokiran:</span>
                    <span class="font-mono text-neutral-300 text-[11px]">{{ $blockedAt ?? now()->format('d M Y - H:i:s T') }}</span>
                </div>
                <div class="flex justify-between items-center text-neutral-400 pt-2 border-t border-[#1F1F24]">
                    <span class="text-[10px] uppercase tracking-widest text-neutral-500 font-semibold">Tindakan Keamanan:</span>
                    <span class="text-red-400 font-semibold uppercase text-[10px] tracking-wider">Permanent Lockout</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-3">
                <a 
                    href="{{ route('home') }}" 
                    class="w-full text-center bg-[#151518] hover:bg-neutral-800 border border-[#1F1F24] text-white py-3.5 px-4 text-xs font-bold uppercase tracking-widest transition-colors duration-200"
                >
                    &larr; Kembali ke Beranda Publik
                </a>
            </div>
        </div>

        <p class="text-center text-[11px] text-neutral-600 mt-8 tracking-wider uppercase">
            &copy; {{ date('Y') }} MMA PRODUCTION. SECURITY INCIDENT RECORDED.
        </p>
    </div>

</body>
</html>

