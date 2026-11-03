@extends('admin.layout')

@section('title', 'Edit Pilar Keahlian: ' . $service->title)

@section('content')
<div class="max-w-3xl space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between pb-6 border-b border-[#1F1F24]">
        <div>
            <p class="text-xs uppercase tracking-[0.25em] font-semibold text-[#FF5722] mb-1">
                Keahlian &bull; Perbarui Data
            </p>
            <h1 class="font-display text-2xl md:text-3xl font-black uppercase tracking-tight text-white">
                EDIT PILAR KEAHLIAN
            </h1>
        </div>
        <a href="{{ route('admin.services.index') }}" class="text-xs font-semibold text-neutral-400 hover:text-white uppercase tracking-wider">
            &larr; Kembali ke Daftar
        </a>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.services.update', $service) }}" method="POST" class="bg-[#0E0E10] border border-[#1F1F24] p-6 md:p-8 space-y-6">
        @csrf
        @method('PUT')

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
                    value="{{ old('number', $service->number) }}" 
                    required 
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
                    value="{{ old('title', $service->title) }}" 
                    required 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Tagline -->
            <div class="md:col-span-2">
                <label for="tagline" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Tagline Ringkas
                </label>
                <input 
                    type="text" 
                    name="tagline" 
                    id="tagline" 
                    value="{{ old('tagline', $service->tagline) }}" 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Urutan -->
            <div>
                <label for="order" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Nomor Urutan
                </label>
                <input 
                    type="number" 
                    name="order" 
                    id="order" 
                    value="{{ old('order', $service->order) }}" 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
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
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white p-4 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >{{ old('description', $service->description) }}</textarea>
            </div>

            <!-- Deliverables -->
            <div class="md:col-span-3">
                <label for="deliverables" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Daftar Hasil & Berkas Akhir (Pisahkan Tiap Butir dengan Baris Baru / Enter)
                </label>
                @php
                    $deliverablesText = is_array($service->deliverables) ? implode("\n", $service->deliverables) : $service->deliverables;
                @endphp
                <textarea 
                    name="deliverables" 
                    id="deliverables" 
                    rows="5" 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white p-4 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722] font-mono text-xs"
                >{{ old('deliverables', $deliverablesText) }}</textarea>
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
                Perbarui Layanan
            </button>
        </div>
    </form>
</div>
@endsection

