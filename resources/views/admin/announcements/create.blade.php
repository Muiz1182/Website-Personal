@extends('admin.layout')

@section('title', 'Tambah Pengumuman Popup Baru')

@section('content')
<div class="max-w-4xl space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between pb-6 border-b border-[#1F1F24]">
        <div>
            <p class="text-xs uppercase tracking-[0.25em] font-semibold text-[#FF5722] mb-1">
                Sistem Notifikasi &bull; Tambah Popup
            </p>
            <h1 class="font-display text-2xl md:text-3xl font-black uppercase tracking-tight text-white">
                TAMBAH PENGUMUMAN POPUP
            </h1>
        </div>
        <a href="{{ route('admin.announcements.index') }}" class="text-xs font-semibold text-neutral-400 hover:text-white uppercase tracking-wider">
            &larr; Kembali ke Daftar
        </a>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.announcements.store') }}" method="POST" class="bg-[#0E0E10] border border-[#1F1F24] p-6 md:p-8 space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Judul Pengumuman -->
            <div class="md:col-span-2">
                <label for="title" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Judul Pengumuman <span class="text-[#FF5722]">*</span>
                </label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title') }}" 
                    required 
                    placeholder="Contoh: SLOT PRODUKSI BULAN INI TELAH DIBUKA"
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Label Kategori / Badge -->
            <div>
                <label for="badge" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Label Badge / Tag Pengumuman
                </label>
                <input 
                    type="text" 
                    name="badge" 
                    id="badge" 
                    value="{{ old('badge', 'PENGUMUMAN PENTING') }}" 
                    placeholder="Contoh: PENGUMUMAN PENTING, UPDATE STUDIO, INFO PROYEK"
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Status Publikasi -->
            <div>
                <label for="status" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Status Publikasi <span class="text-[#FF5722]">*</span>
                </label>
                <select 
                    name="status" 
                    id="status" 
                    required 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
                    <option value="published" {{ old('status', 'published') === 'published' ? 'selected' : '' }}>Publish (Siap Tayang)</option>
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Sembunyikan / Konsep)</option>
                </select>
            </div>

            <!-- Isi Pesan Pengumuman -->
            <div class="md:col-span-2">
                <label for="content" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Isi Pesan Pengumuman <span class="text-[#FF5722]">*</span>
                </label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="5" 
                    required 
                    placeholder="Tuliskan pesan atau pengumuman yang ingin disampaikan kepada pengunjung saat pertama kali masuk website..."
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white p-4 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722] leading-relaxed"
                >{{ old('content') }}</textarea>
            </div>

            <!-- Teks Tombol Aksi (Opsional) -->
            <div>
                <label for="action_text" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Teks Tombol Aksi (Opsional)
                </label>
                <input 
                    type="text" 
                    name="action_text" 
                    id="action_text" 
                    value="{{ old('action_text') }}" 
                    placeholder="Contoh: Mulai Konsultasi, Lihat Detail, Hubungi WhatsApp"
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Tautan Tombol Aksi (Opsional) -->
            <div>
                <label for="action_url" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Tautan URL Tombol Aksi (Opsional)
                </label>
                <input 
                    type="text" 
                    name="action_url" 
                    id="action_url" 
                    value="{{ old('action_url') }}" 
                    placeholder="Contoh: #contact atau https://wa.me/6285174421182"
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Opsi Jadikan Popup Utama -->
            <div class="md:col-span-2 p-4 bg-[#151518] border border-[#1F1F24]">
                <label class="flex items-start space-x-3 cursor-pointer">
                    <input 
                        type="checkbox" 
                        name="is_active" 
                        value="1" 
                        {{ old('is_active', true) ? 'checked' : '' }}
                        class="mt-1 h-4 w-4 bg-[#070707] border-[#1F1F24] text-[#FF5722] focus:ring-[#FF5722]"
                    >
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-white">Jadikan Popup Aktif Utama di Landing Page</span>
                        <p class="text-[11px] text-neutral-400 mt-0.5">
                            Jika dicentang dan statusnya Publish, pengumuman ini akan langsung aktif sebagai popup tengah layar saat user pertama kali mengunjungi beranda.
                        </p>
                    </div>
                </label>
            </div>
        </div>

        <div class="pt-6 border-t border-[#1F1F24] flex items-center justify-end space-x-4">
            <a href="{{ route('admin.announcements.index') }}" class="px-5 py-3 text-xs uppercase font-semibold text-neutral-400 hover:text-white transition-colors">
                Batal
            </a>
            <button 
                type="submit" 
                class="bg-[#FF5722] hover:bg-[#F4511E] text-white text-xs font-bold uppercase tracking-widest px-7 py-3.5 transition-colors duration-200"
            >
                Simpan &amp; Terbitkan
            </button>
        </div>
    </form>
</div>
@endsection

