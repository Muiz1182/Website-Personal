@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-10">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between pb-6 border-b border-[#1F1F24] gap-4">
        <div>
            <p class="text-xs uppercase tracking-[0.25em] font-semibold text-[#FF5722] mb-1">
                Panel Kontrol Utama &bull; CMS
            </p>
            <h1 class="font-display text-3xl md:text-4xl font-black uppercase tracking-tight text-white">
                RINGKASAN KONTEN
            </h1>
        </div>
        <div class="flex flex-wrap gap-3">
            <form action="{{ route('admin.storage.clean') }}" method="POST" onsubmit="return confirm('Pindai dan bersihkan seluruh berkas gambar lama yang tidak terhubung ke database?');">
                @csrf
                <button 
                    type="submit" 
                    class="inline-flex items-center space-x-2 bg-[#151518] hover:bg-[#202026] border border-[#1F1F24] hover:border-emerald-600/60 text-emerald-400 text-xs font-bold uppercase tracking-widest px-5 py-3 transition-colors duration-200"
                    title="Hapus berkas gambar lama yang tidak lagi dipakai database untuk menghemat storage VPS"
                >
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span>Bersihkan Storage Yatim</span>
                </button>
            </form>
            <a 
                href="{{ route('admin.projects.create') }}" 
                class="inline-flex items-center space-x-2 bg-[#FF5722] hover:bg-[#F4511E] text-white text-xs font-bold uppercase tracking-widest px-5 py-3 transition-colors duration-200"
            >
                <span>+ Tambah Karya</span>
            </a>
            <a 
                href="{{ route('home') }}" 
                target="_blank" 
                class="inline-flex items-center space-x-2 bg-[#0E0E10] hover:bg-[#151518] border border-[#1F1F24] text-neutral-300 text-xs font-bold uppercase tracking-widest px-5 py-3 transition-colors duration-200"
            >
                <span>Lihat Web Utama</span>
            </a>
        </div>
    </div>

    <!-- Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: Karya -->
        <div class="bg-[#0E0E10] border border-[#1F1F24] p-6 flex flex-col justify-between hover:border-neutral-700 transition-colors">
            <div class="flex items-center justify-between">
                <span class="text-xs uppercase tracking-widest font-semibold text-neutral-400">Karya Portofolio</span>
                <span class="p-2 bg-[#151518] text-[#FF5722]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </span>
            </div>
            <div class="mt-4">
                <p class="text-4xl font-black text-white font-display">{{ $counts['projects'] }}</p>
                <p class="text-xs text-neutral-400 mt-1">Item aktif ditampilkan di website</p>
            </div>
            <div class="mt-6 pt-4 border-t border-[#1F1F24]">
                <a href="{{ route('admin.projects.index') }}" class="text-xs font-bold text-[#FF5722] hover:underline uppercase tracking-wider inline-flex items-center space-x-1">
                    <span>Kelola Karya</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>

        <!-- Card 2: Keahlian -->
        <div class="bg-[#0E0E10] border border-[#1F1F24] p-6 flex flex-col justify-between hover:border-neutral-700 transition-colors">
            <div class="flex items-center justify-between">
                <span class="text-xs uppercase tracking-widest font-semibold text-neutral-400">Pilar Keahlian</span>
                <span class="p-2 bg-[#151518] text-[#FF5722]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </span>
            </div>
            <div class="mt-4">
                <p class="text-4xl font-black text-white font-display">{{ $counts['services'] }}</p>
                <p class="text-xs text-neutral-400 mt-1">Videografi, Desain & Web Dev</p>
            </div>
            <div class="mt-6 pt-4 border-t border-[#1F1F24]">
                <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-[#FF5722] hover:underline uppercase tracking-wider inline-flex items-center space-x-1">
                    <span>Kelola Keahlian</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>

        <!-- Card 3: Profil Kreator -->
        <div class="bg-[#0E0E10] border border-[#1F1F24] p-6 flex flex-col justify-between hover:border-neutral-700 transition-colors">
            <div class="flex items-center justify-between">
                <span class="text-xs uppercase tracking-widest font-semibold text-neutral-400">Profil Kreator</span>
                <span class="p-2 bg-[#151518] text-[#FF5722]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
            </div>
            <div class="mt-4">
                <p class="text-4xl font-black text-white font-display">{{ $counts['creator'] }}</p>
                <p class="text-xs text-neutral-400 mt-1">{{ $creator ? $creator->name : 'Belum diatur' }}</p>
            </div>
            <div class="mt-6 pt-4 border-t border-[#1F1F24]">
                <a href="{{ route('admin.creator.edit') }}" class="text-xs font-bold text-[#FF5722] hover:underline uppercase tracking-wider inline-flex items-center space-x-1">
                    <span>Edit Profil & Bio</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>

        <!-- Card 4: Ulasan Klien -->
        <div class="bg-[#0E0E10] border border-[#1F1F24] p-6 flex flex-col justify-between hover:border-neutral-700 transition-colors">
            <div class="flex items-center justify-between">
                <span class="text-xs uppercase tracking-widest font-semibold text-neutral-400">Ulasan Klien</span>
                <span class="p-2 bg-[#151518] text-[#FF5722]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </span>
            </div>
            <div class="mt-4">
                <p class="text-4xl font-black text-white font-display">{{ $counts['testimonials'] }}</p>
                <p class="text-xs text-neutral-400 mt-1">Ulasan kepuasan klien</p>
            </div>
            <div class="mt-6 pt-4 border-t border-[#1F1F24]">
                <a href="{{ route('admin.testimonials.index') }}" class="text-xs font-bold text-[#FF5722] hover:underline uppercase tracking-wider inline-flex items-center space-x-1">
                    <span>Kelola Ulasan</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Two Columns: Recent Projects & Creator Snapshot -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Projects (2 Cols) -->
        <div class="lg:col-span-2 bg-[#0E0E10] border border-[#1F1F24] p-6 md:p-8">
            <div class="flex items-center justify-between pb-4 mb-6 border-b border-[#1F1F24]">
                <h2 class="text-base font-bold uppercase tracking-wider text-white">Karya Portofolio Terbaru</h2>
                <a href="{{ route('admin.projects.index') }}" class="text-xs text-[#FF5722] font-semibold uppercase hover:underline">Semua Karya &rarr;</a>
            </div>

            @if ($recentProjects->isEmpty())
                <p class="text-xs text-neutral-400 py-6 text-center">Belum ada karya yang ditambahkan.</p>
            @else
                <div class="divide-y divide-[#1F1F24]">
                    @foreach ($recentProjects as $item)
                        <div class="py-4 flex items-center justify-between gap-4">
                            <div class="flex items-center space-x-4 min-w-0">
                                @if ($item->image)
                                    <img src="{{ $item->image }}" alt="{{ $item->title }}" class="w-14 h-10 object-cover bg-neutral-900 border border-[#1F1F24] shrink-0">
                                @else
                                    <div class="w-14 h-10 bg-neutral-900 border border-[#1F1F24] flex items-center justify-center text-[10px] text-neutral-400 shrink-0">NO IMG</div>
                                @endif
                                <div class="min-w-0">
                                    <h3 class="text-sm font-bold text-white truncate">{{ $item->title }}</h3>
                                    <div class="flex items-center space-x-2 mt-1">
                                        <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 bg-[#151518] text-[#FF5722] border border-[#1F1F24]">
                                            {{ $item->category }}
                                        </span>
                                        <span class="text-[11px] text-neutral-400">{{ $item->year }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3 shrink-0">
                                <a href="{{ route('admin.projects.edit', $item) }}" class="text-xs font-semibold text-neutral-300 hover:text-white px-3 py-1.5 bg-[#151518] border border-[#1F1F24] transition-colors">
                                    Edit
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Creator Profile Card -->
        <div class="bg-[#0E0E10] border border-[#1F1F24] p-6 md:p-8 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 mb-6 border-b border-[#1F1F24]">
                    <h2 class="text-base font-bold uppercase tracking-wider text-white">Profil Kreator</h2>
                    <span class="text-[10px] text-emerald-400 font-bold uppercase tracking-widest px-2 py-0.5 bg-emerald-950/40 border border-emerald-800/60">Aktif</span>
                </div>

                @if ($creator)
                    <div class="space-y-4">
                        @if ($creator->image)
                            <img src="{{ $creator->image }}" alt="{{ $creator->name }}" class="w-20 h-20 object-cover border-2 border-[#1F1F24]">
                        @endif
                        <div>
                            <h3 class="text-base font-extrabold text-white">{{ $creator->name }}</h3>
                            <p class="text-xs text-[#FF5722] font-semibold mt-0.5">{{ $creator->role }}</p>
                        </div>
                        <p class="text-xs text-neutral-400 line-clamp-3 leading-relaxed">
                            {{ $creator->bio }}
                        </p>
                    </div>
                @else
                    <p class="text-xs text-neutral-400">Profil kreator belum diatur.</p>
                @endif
            </div>

            <div class="mt-8 pt-4 border-t border-[#1F1F24]">
                <a 
                    href="{{ route('admin.creator.edit') }}" 
                    class="block w-full text-center bg-[#151518] hover:bg-[#1d1d22] border border-[#1F1F24] text-white text-xs font-bold uppercase tracking-widest py-3 transition-colors"
                >
                    Edit Profil & Standar Alat
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

