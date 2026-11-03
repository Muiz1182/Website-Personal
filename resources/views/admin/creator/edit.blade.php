@extends('admin.layout')

@section('title', 'Profil Kreator')

@section('content')
<div class="max-w-4xl space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between pb-6 border-b border-[#1F1F24]">
        <div>
            <p class="text-xs uppercase tracking-[0.25em] font-semibold text-[#FF5722] mb-1">
                Tentang &bull; Profil Kreator Utama
            </p>
            <h1 class="font-display text-2xl md:text-3xl font-black uppercase tracking-tight text-white">
                KELOLA PROFIL KREATOR
            </h1>
        </div>
        <a href="{{ route('home') }}#director" target="_blank" class="text-xs font-semibold text-[#FF5722] hover:underline uppercase tracking-wider">
            Lihat Bagian di Web &rarr;
        </a>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.creator.update') }}" method="POST" enctype="multipart/form-data" class="bg-[#0E0E10] border border-[#1F1F24] p-6 md:p-8 space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nama Kreator -->
            <div>
                <label for="name" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Nama Lengkap Kreator <span class="text-[#FF5722]">*</span>
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name', $creator->name) }}" 
                    required 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Gelar / Peran -->
            <div>
                <label for="role" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Gelar Peran Profesional <span class="text-[#FF5722]">*</span>
                </label>
                <input 
                    type="text" 
                    name="role" 
                    id="role" 
                    value="{{ old('role', $creator->role) }}" 
                    required 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Headline Utama -->
            <div class="md:col-span-2">
                <label for="headline" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Pernyataan Visi / Headline Utama
                </label>
                <input 
                    type="text" 
                    name="headline" 
                    id="headline" 
                    value="{{ old('headline', $creator->headline) }}" 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Bio Lengkap -->
            <div class="md:col-span-2">
                <label for="bio" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Biografi & Narasi Kreator <span class="text-[#FF5722]">*</span>
                </label>
                <textarea 
                    name="bio" 
                    id="bio" 
                    rows="4" 
                    required 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white p-4 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722] leading-relaxed"
                >{{ old('bio', $creator->bio) }}</textarea>
            </div>

            <!-- Foto Profil -->
            <div class="md:col-span-2 p-4 bg-[#151518] border border-[#1F1F24] space-y-4">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-bold uppercase tracking-wider text-white">Foto Profil Kreator</p>
                    @if ($creator->image)
                        <span class="text-[10px] text-neutral-400">Tersimpan</span>
                    @endif
                </div>

                @if ($creator->image)
                    <div class="flex items-center space-x-4 p-2 bg-[#070707] border border-[#1F1F24]">
                        <img src="{{ $creator->image }}" alt="{{ $creator->name }}" class="w-20 h-20 object-cover border border-[#1F1F24]">
                        <div class="text-xs text-neutral-400 truncate">
                            <p class="font-mono text-neutral-300 truncate">{{ $creator->image }}</p>
                            <p class="text-[10px] text-neutral-400 mt-1">Unggah berkas baru atau masukkan URL di bawah untuk mengganti foto profil.</p>
                        </div>
                    </div>
                @endif

                <div>
                    <label for="image_file" class="block text-xs uppercase text-neutral-300 mb-1">
                        Pilihan A: Unggah Foto Baru dari Komputer
                    </label>
                    <input 
                        type="file" 
                        name="image_file" 
                        id="image_file" 
                        accept="image/*"
                        class="w-full text-xs text-neutral-400 file:mr-4 file:py-2 file:px-4 file:border file:border-[#1F1F24] file:text-xs file:font-semibold file:bg-[#070707] file:text-white hover:file:bg-[#1a1a1f] cursor-pointer"
                    >
                </div>

                <div>
                    <label for="image_url" class="block text-xs uppercase text-neutral-300 mb-1">
                        Pilihan B: Atau Masukkan URL Gambar Eksternal
                    </label>
                    <input 
                        type="text" 
                        name="image_url" 
                        id="image_url" 
                        value="{{ old('image_url', $creator->image) }}" 
                        placeholder="https://..."
                        class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-2.5 text-xs focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                    >
                </div>
            </div>

            <!-- Foto / Desain Kartu Lanyard 3D -->
            <div class="md:col-span-2 p-5 bg-[#151518] border border-[#1F1F24] space-y-4">
                <div class="flex items-center justify-between border-b border-[#1F1F24] pb-3">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-white">Visual Kartu Lanyard 3D (Hero Pass)</p>
                        <p class="text-[11px] text-neutral-400 mt-0.5">Foto atau kartu tanda pengenal interaktif 3D yang tampil melayang di bagian Hero.</p>
                    </div>
                    @if ($creator->lanyard_image)
                        <span class="text-[10px] text-emerald-400 font-bold uppercase tracking-wider px-2 py-0.5 bg-emerald-950/40 border border-emerald-800/60">Kustom Aktif</span>
                    @else
                        <span class="text-[10px] text-neutral-400 font-bold uppercase tracking-wider px-2 py-0.5 bg-[#0E0E10] border border-[#1F1F24]">Desain Default</span>
                    @endif
                </div>

                <!-- Preview Kartu Saat Ini -->
                <div class="flex items-center space-x-5 p-3 bg-[#070707] border border-[#1F1F24]">
                    <div class="w-16 h-24 bg-neutral-900 border border-[#1F1F24] shrink-0 overflow-hidden flex items-center justify-center">
                        <img 
                            src="{{ $creator->lanyard_image ?: '/images/lanyard-front.svg' }}" 
                            alt="Pratinjau Kartu Lanyard" 
                            class="w-full h-full object-cover"
                        >
                    </div>
                    <div class="text-xs text-neutral-300 min-w-0 space-y-1">
                        <p class="font-bold text-white">Pratinjau Visual Lanyard</p>
                        <p class="font-mono text-[11px] text-neutral-400 truncate">{{ $creator->lanyard_image ?: 'Menggunakan berkas default: /images/lanyard-front.svg' }}</p>
                        <p class="text-[11px] text-neutral-400">Rekomendasi rasio potret (~2:3 atau 3:4) dalam format JPG, PNG, WebP, atau SVG.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                    <div>
                        <label for="lanyard_image_file" class="block text-xs uppercase text-neutral-300 mb-1">
                            Unggah Foto / Kartu Baru dari Perangkat
                        </label>
                        <input 
                            type="file" 
                            name="lanyard_image_file" 
                            id="lanyard_image_file" 
                            accept="image/*"
                            class="w-full text-xs text-neutral-400 file:mr-4 file:py-2 file:px-4 file:border file:border-[#1F1F24] file:text-xs file:font-semibold file:bg-[#070707] file:text-white hover:file:bg-[#1a1a1f] cursor-pointer"
                        >
                    </div>

                    <div>
                        <label for="lanyard_image_url" class="block text-xs uppercase text-neutral-300 mb-1">
                            Atau Masukkan Tautan / URL Gambar Kartu
                        </label>
                        <input 
                            type="text" 
                            name="lanyard_image_url" 
                            id="lanyard_image_url" 
                            value="{{ old('lanyard_image_url', $creator->lanyard_image) }}" 
                            placeholder="https://..."
                            class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-2.5 text-xs focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                        >
                    </div>
                </div>

                @if ($creator->lanyard_image)
                    <div class="pt-2 border-t border-[#1F1F24]">
                        <label class="inline-flex items-center space-x-2 text-xs text-neutral-300 cursor-pointer select-none">
                            <input type="checkbox" name="reset_lanyard" value="1" class="accent-[#FF5722] w-4 h-4 bg-[#070707] border-[#1F1F24]">
                            <span>Kembalikan ke kartu grafis bawaan (reset to default)</span>
                        </label>
                    </div>
                @endif
            </div>

            <!-- Daftar Disiplin Keahlian -->
            <div class="md:col-span-2">
                <label for="disciplines" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Tag Disiplin Keahlian (Satu Per Baris / Enter)
                </label>
                @php
                    $disciplinesText = is_array($creator->disciplines) ? implode("\n", $creator->disciplines) : $creator->disciplines;
                @endphp
                <textarea 
                    name="disciplines" 
                    id="disciplines" 
                    rows="4" 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white p-4 text-xs font-mono focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >{{ old('disciplines', $disciplinesText) }}</textarea>
                <p class="text-[11px] text-neutral-400 mt-1">Item ini akan muncul sebagai lencana keahlian di samping foto kreator.</p>
            </div>

            <!-- Statistik & Standar Alat -->
            <div class="md:col-span-2 p-4 bg-[#151518] border border-[#1F1F24] space-y-4">
                <p class="text-xs font-bold uppercase tracking-wider text-white">Ringkasan Parameter & Standar Alat</p>
                
                @php
                    $stats = is_array($creator->stats) ? $creator->stats : [];
                    // Pad up to 3 slots
                    while (count($stats) < 3) {
                        $stats[] = ['label' => '', 'value' => ''];
                    }
                @endphp

                <div class="space-y-3">
                    @foreach ($stats as $idx => $st)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 p-3 bg-[#070707] border border-[#1F1F24]">
                            <div>
                                <label class="block text-[11px] uppercase text-neutral-400 mb-1">Label Parameter {{ $idx + 1 }}</label>
                                <input 
                                    type="text" 
                                    name="stat_labels[]" 
                                    value="{{ old('stat_labels.' . $idx, $st['label'] ?? '') }}" 
                                    placeholder="Contoh: Keahlian Inti"
                                    class="w-full bg-[#0E0E10] border border-[#1F1F24] text-white px-3 py-2 text-xs focus:outline-none focus:border-[#FF5722]"
                                >
                            </div>
                            <div>
                                <label class="block text-[11px] uppercase text-neutral-400 mb-1">Nilai Parameter {{ $idx + 1 }}</label>
                                <input 
                                    type="text" 
                                    name="stat_values[]" 
                                    value="{{ old('stat_values.' . $idx, $st['value'] ?? '') }}" 
                                    placeholder="Contoh: Video, Desain & Web Dev"
                                    class="w-full bg-[#0E0E10] border border-[#1F1F24] text-white px-3 py-2 text-xs focus:outline-none focus:border-[#FF5722]"
                                >
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="pt-6 border-t border-[#1F1F24] flex items-center justify-end space-x-4">
            <button 
                type="submit" 
                class="bg-[#FF5722] hover:bg-[#F4511E] text-white text-xs font-bold uppercase tracking-widest px-8 py-3.5 transition-colors duration-200"
            >
                Simpan Perubahan Profil
            </button>
        </div>
    </form>
</div>
@endsection

