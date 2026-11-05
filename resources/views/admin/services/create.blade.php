@extends('admin.layout')

@section('title', 'Tambah Pilar Keahlian')

@section('content')
<div class="max-w-3xl space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between pb-6 border-b border-[#1F1F24]">
        <div>
            <p class="text-xs uppercase tracking-[0.25em] font-semibold text-[#FF5722] mb-1">
                Keahlian &bull; Tambah Pilar
            </p>
            <h1 class="font-display text-2xl md:text-3xl font-black uppercase tracking-tight text-white">
                TAMBAH PILAR KEAHLIAN
            </h1>
        </div>
        <a href="{{ route('admin.services.index') }}" class="text-xs font-semibold text-neutral-400 hover:text-white uppercase tracking-wider">
            &larr; Kembali ke Daftar
        </a>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.services.store') }}" method="POST" class="bg-[#0E0E10] border border-[#1F1F24] p-6 md:p-8 space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Nomor Indeks -->
            <div>
                <label for="number" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Nomor Pilar <span class="text-[#FF5722]">*</span>
                </label>
                <input 
                    type="text" 
                    name="number" 
                    id="number" 
                    value="{{ old('number', '04') }}" 
                    required 
                    placeholder="01, 02, 03..."
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Judul Layanan -->
            <div class="md:col-span-2">
                <label for="title" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Nama Pilar Keahlian <span class="text-[#FF5722]">*</span>
                </label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title') }}" 
                    required 
                    placeholder="Contoh: Videografi: Video Cinematic & Podcast"
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Tagline -->
            <div class="md:col-span-3">
                <label for="tagline" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Tagline Ringkas
                </label>
                <input 
                    type="text" 
                    name="tagline" 
                    id="tagline" 
                    value="{{ old('tagline') }}" 
                    placeholder="Visual sinematik berkarakter kuat serta produksi audio studio podcast..."
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Urutan -->
            <div class="md:col-span-1">
                <label for="order" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Nomor Urutan
                </label>
                <input 
                    type="number" 
                    name="order" 
                    id="order" 
                    value="{{ old('order', 1) }}" 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Status Publikasi -->
            <div class="md:col-span-2">
                <label for="status" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Status Publikasi <span class="text-[#FF5722]">*</span>
                </label>
                <select 
                    name="status" 
                    id="status" 
                    required 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
                    <option value="published" {{ old('status', 'published') === 'published' ? 'selected' : '' }}>Publish (Tampil di Landing Page)</option>
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Sembunyikan dari Publik)</option>
                </select>
            </div>

            <!-- Deskripsi -->
            <div class="md:col-span-3">
                <label for="description" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Deskripsi Lengkap Layanan <span class="text-[#FF5722]">*</span>
                </label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="4" 
                    required 
                    placeholder="Jelaskan standar proses, alat yang digunakan, dan keunggulan eksekusi..."
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white p-4 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >{{ old('description') }}</textarea>
            </div>

            <!-- Deliverables -->
            <div class="md:col-span-3">
                <label for="deliverables" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Daftar Hasil & Berkas Akhir (Pisahkan Tiap Butir dengan Baris Baru / Enter)
                </label>
                <textarea 
                    name="deliverables" 
                    id="deliverables" 
                    rows="5" 
                    placeholder="Video Sinematik 4K (Master & Cutdown)&#10;Produksi Rekaman Video Podcast Multi-Kamera&#10;Mastering Audio Studio Podcast&#10;Klip Vertikal Media Sosial (Reels & Shorts 9:16)"
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white p-4 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722] font-mono text-xs"
                >{{ old('deliverables') }}</textarea>
                <p class="text-[11px] text-neutral-400 mt-1">Satu baris akan menjadi satu butir peluru (bullet point) pada tampilan website.</p>
            </div>
        </div>

        <div class="pt-6 border-t border-[#1F1F24] flex items-center justify-end space-x-4">
            <a href="{{ route('admin.services.index') }}" class="px-5 py-3 text-xs uppercase font-semibold text-neutral-400 hover:text-white transition-colors">
                Batal
            </a>
            <button 
                type="submit" 
                class="bg-[#FF5722] hover:bg-[#F4511E] text-white text-xs font-bold uppercase tracking-widest px-7 py-3.5 transition-colors duration-200"
            >
                Simpan Layanan
            </button>
        </div>
    </form>
</div>
@endsection

