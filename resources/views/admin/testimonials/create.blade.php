@extends('admin.layout')

@section('title', 'Tambah Ulasan Klien')

@section('content')
<div class="max-w-3xl space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between pb-6 border-b border-[#1F1F24]">
        <div>
            <p class="text-xs uppercase tracking-[0.25em] font-semibold text-[#FF5722] mb-1">
                Kredit &bull; Tambah Ulasan
            </p>
            <h1 class="font-display text-2xl md:text-3xl font-black uppercase tracking-tight text-white">
                TAMBAH ULASAN KLIEN
            </h1>
        </div>
        <a href="{{ route('admin.testimonials.index') }}" class="text-xs font-semibold text-neutral-400 hover:text-white uppercase tracking-wider">
            &larr; Kembali ke Daftar
        </a>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.testimonials.store') }}" method="POST" class="bg-[#0E0E10] border border-[#1F1F24] p-6 md:p-8 space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nama Klien -->
            <div>
                <label for="name" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Nama Klien / Partner <span class="text-[#FF5722]">*</span>
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name') }}" 
                    required 
                    placeholder="Contoh: Alice Sandra"
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Peran / Jabatan / Perusahaan -->
            <div>
                <label for="role" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Peran / Perusahaan Klien
                </label>
                <input 
                    type="text" 
                    name="role" 
                    id="role" 
                    value="{{ old('role') }}" 
                    placeholder="Contoh: Direktur Pemasaran, Retail Group"
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Lingkup Proyek -->
            <div>
                <label for="project" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Kategori / Lingkup Proyek
                </label>
                <input 
                    type="text" 
                    name="project" 
                    id="project" 
                    value="{{ old('project') }}" 
                    placeholder="Contoh: Seri Video Sinematik & Podcast"
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Urutan -->
            <div>
                <label for="order" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Nomor Urutan Tampil
                </label>
                <input 
                    type="number" 
                    name="order" 
                    id="order" 
                    value="{{ old('order', 1) }}" 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Isi Kutipan Ulasan -->
            <div class="md:col-span-2">
                <label for="quote" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Kutipan Testimoni / Ulasan Klien <span class="text-[#FF5722]">*</span>
                </label>
                <textarea 
                    name="quote" 
                    id="quote" 
                    rows="4" 
                    required 
                    placeholder="Tuliskan pengalaman atau kepuasan klien terhadap hasil pengerjaan proyek..."
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white p-4 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722] leading-relaxed"
                >{{ old('quote') }}</textarea>
            </div>
        </div>

        <div class="pt-6 border-t border-[#1F1F24] flex items-center justify-end space-x-4">
            <a href="{{ route('admin.testimonials.index') }}" class="px-5 py-3 text-xs uppercase font-semibold text-neutral-400 hover:text-white transition-colors">
                Batal
            </a>
            <button 
                type="submit" 
                class="bg-[#FF5722] hover:bg-[#F4511E] text-white text-xs font-bold uppercase tracking-widest px-7 py-3.5 transition-colors duration-200"
            >
                Simpan Ulasan
            </button>
        </div>
    </form>
</div>
@endsection

