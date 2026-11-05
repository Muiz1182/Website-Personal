@extends('admin.layout')

@section('title', 'Edit Karya: ' . $project->title)

@section('content')
<div class="max-w-4xl space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between pb-6 border-b border-[#1F1F24]">
        <div>
            <p class="text-xs uppercase tracking-[0.25em] font-semibold text-[#FF5722] mb-1">
                Portofolio &bull; Perbarui Data
            </p>
            <h1 class="font-display text-2xl md:text-3xl font-black uppercase tracking-tight text-white">
                EDIT KARYA
            </h1>
        </div>
        <a href="{{ route('admin.projects.index') }}" class="text-xs font-semibold text-neutral-400 hover:text-white uppercase tracking-wider">
            &larr; Kembali ke Daftar
        </a>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="bg-[#0E0E10] border border-[#1F1F24] p-6 md:p-8 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Judul Karya -->
            <div class="md:col-span-2">
                <label for="title" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Judul Karya <span class="text-[#FF5722]">*</span>
                </label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title', $project->title) }}" 
                    required 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Kategori Utama -->
            <div>
                <label for="category" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Pilar Kategori <span class="text-[#FF5722]">*</span>
                </label>
                <select 
                    name="category" 
                    id="category" 
                    required 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
                    <option value="Videography" {{ old('category', $project->category) === 'Videography' ? 'selected' : '' }}>Videography (Video Cinematic & Podcast)</option>
                    <option value="Design" {{ old('category', $project->category) === 'Design' ? 'selected' : '' }}>Design (UI/UX, Ilustrasi & Poster)</option>
                    <option value="Web Developer" {{ old('category', $project->category) === 'Web Developer' ? 'selected' : '' }}>Web Developer (Laravel, Vue, PHP, JS)</option>
                </select>
            </div>

            <!-- Tahun -->
            <div>
                <label for="year" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Tahun Rilis / Produksi <span class="text-[#FF5722]">*</span>
                </label>
                <input 
                    type="text" 
                    name="year" 
                    id="year" 
                    value="{{ old('year', $project->year) }}" 
                    required 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Tagline / Sub-Label -->
            <div>
                <label for="tag" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Label Sub-Judul (Tagline)
                </label>
                <input 
                    type="text" 
                    name="tag" 
                    id="tag" 
                    value="{{ old('tag', $project->tag) }}" 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Spesifikasi Alat / Stack -->
            <div>
                <label for="specs" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Spesifikasi Alat / Tech Stack
                </label>
                <input 
                    type="text" 
                    name="specs" 
                    id="specs" 
                    value="{{ old('specs', $project->specs) }}" 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
            </div>

            <!-- Format Tata Letak Grid (Span) -->
            <div>
                <label for="span" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Ukuran Grid Portofolio <span class="text-[#FF5722]">*</span>
                </label>
                <select 
                    name="span" 
                    id="span" 
                    required 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
                    <option value="col-span-1 md:col-span-1" {{ old('span', $project->span) === 'col-span-1 md:col-span-1' ? 'selected' : '' }}>1 Kolom (Standar)</option>
                    <option value="col-span-1 md:col-span-2" {{ old('span', $project->span) === 'col-span-1 md:col-span-2' ? 'selected' : '' }}>2 Kolom (Lebar / Sorotan Hero)</option>
                </select>
            </div>

            <!-- Rasio Aspek Gambar -->
            <div>
                <label for="aspect" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Rasio Aspek Visual <span class="text-[#FF5722]">*</span>
                </label>
                <select 
                    name="aspect" 
                    id="aspect" 
                    required 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-3 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >
                    <option value="aspect-[4/3]" {{ old('aspect', $project->aspect) === 'aspect-[4/3]' ? 'selected' : '' }}>4:3 (Foto Standar)</option>
                    <option value="aspect-[16/9]" {{ old('aspect', $project->aspect) === 'aspect-[16/9]' ? 'selected' : '' }}>16:9 (Sinematik Widescreen)</option>
                </select>
            </div>

            <!-- Urutan Tampil -->
            <div>
                <label for="order" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Nomor Urutan
                </label>
                <input 
                    type="number" 
                    name="order" 
                    id="order" 
                    value="{{ old('order', $project->order) }}" 
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
                    <option value="published" {{ old('status', $project->status) === 'published' ? 'selected' : '' }}>Publish (Tampil di Landing Page)</option>
                    <option value="draft" {{ old('status', $project->status) === 'draft' ? 'selected' : '' }}>Draft (Sembunyikan dari Publik)</option>
                </select>
            </div>

            <!-- Gambar: Upload File & Pratinjau -->
            <div class="md:col-span-2 p-4 bg-[#151518] border border-[#1F1F24] space-y-4">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-bold uppercase tracking-wider text-white">Visual / Gambar Karya</p>
                    @if ($project->image)
                        <span class="text-[10px] text-neutral-400">Gambar saat ini tersimpan</span>
                    @endif
                </div>

                @if ($project->image)
                    <div class="flex items-center space-x-4 p-2 bg-[#070707] border border-[#1F1F24]">
                        <img src="{{ $project->image }}" alt="{{ $project->title }}" class="w-24 h-16 object-cover border border-[#1F1F24]">
                        <div class="text-xs text-neutral-400 truncate">
                            <p class="font-mono text-neutral-300 truncate">{{ $project->image }}</p>
                            <p class="text-[10px] text-neutral-400 mt-1">Unggah berkas baru atau masukkan URL di bawah untuk mengganti.</p>
                        </div>
                    </div>
                @endif
                
                <div>
                    <label for="image_file" class="block text-xs uppercase text-neutral-300 mb-1">
                        Ganti dengan Unggah Berkas Baru
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
                        Atau Perbarui URL Gambar Eksternal
                    </label>
                    <input 
                        type="text" 
                        name="image_url" 
                        id="image_url" 
                        value="{{ old('image_url', $project->image) }}" 
                        placeholder="https://..."
                        class="w-full bg-[#070707] border border-[#1F1F24] text-white px-4 py-2.5 text-xs focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                    >
                </div>
            </div>

            <!-- Deskripsi Proyek -->
            <div class="md:col-span-2">
                <label for="description" class="block text-xs uppercase tracking-wider font-semibold text-neutral-300 mb-2">
                    Deskripsi Ringkas Proyek
                </label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="4" 
                    class="w-full bg-[#070707] border border-[#1F1F24] text-white p-4 text-sm focus:outline-none focus:border-[#FF5722] focus:ring-1 focus:ring-[#FF5722]"
                >{{ old('description', $project->description) }}</textarea>
            </div>
        </div>

        <div class="pt-6 border-t border-[#1F1F24] flex items-center justify-end space-x-4">
            <a href="{{ route('admin.projects.index') }}" class="px-5 py-3 text-xs uppercase font-semibold text-neutral-400 hover:text-white transition-colors">
                Batal
            </a>
            <button 
                type="submit" 
                class="bg-[#FF5722] hover:bg-[#F4511E] text-white text-xs font-bold uppercase tracking-widest px-7 py-3.5 transition-colors duration-200"
            >
                Perbarui Karya
            </button>
        </div>
    </form>
</div>
@endsection

