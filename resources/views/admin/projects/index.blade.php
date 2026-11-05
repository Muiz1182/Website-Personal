@extends('admin.layout')

@section('title', 'Karya Portofolio')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-[#1F1F24] gap-4">
        <div>
            <p class="text-xs uppercase tracking-[0.25em] font-semibold text-[#FF5722] mb-1">
                Portofolio &bull; Selected Works
            </p>
            <h1 class="font-display text-3xl font-black uppercase tracking-tight text-white">
                KELOLA KARYA ({{ $projects->count() }})
            </h1>
        </div>
        <a 
            href="{{ route('admin.projects.create') }}" 
            class="inline-flex items-center space-x-2 bg-[#FF5722] hover:bg-[#F4511E] text-white text-xs font-bold uppercase tracking-widest px-5 py-3 transition-colors duration-200"
        >
            <span>+ Tambah Karya Baru</span>
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-[#0E0E10] border border-[#1F1F24] overflow-hidden">
        @if ($projects->isEmpty())
            <div class="p-12 text-center">
                <p class="text-neutral-400 text-sm mb-4">Belum ada karya yang tersimpan di database.</p>
                <a href="{{ route('admin.projects.create') }}" class="text-xs font-bold text-[#FF5722] uppercase tracking-wider hover:underline">
                    Tambah karya pertama Anda &rarr;
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#151518] text-neutral-400 uppercase tracking-wider font-semibold border-b border-[#1F1F24]">
                        <tr>
                            <th class="px-6 py-4">Visual</th>
                            <th class="px-6 py-4">Judul & Tagline</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Tahun</th>
                            <th class="px-6 py-4">Urutan</th>
                            <th class="px-6 py-4 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#1F1F24] text-neutral-300">
                        @foreach ($projects as $item)
                            <tr class="hover:bg-[#121215] transition-colors">
                                <td class="px-6 py-4">
                                    @if ($item->image)
                                        <img src="{{ $item->image }}" alt="{{ $item->title }}" class="w-16 h-11 object-cover bg-neutral-900 border border-[#1F1F24]">
                                    @else
                                        <div class="w-16 h-11 bg-neutral-900 border border-[#1F1F24] flex items-center justify-center text-[10px] text-neutral-400">NO IMG</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-white text-sm">{{ $item->title }}</p>
                                    <p class="text-[11px] text-neutral-400 mt-0.5">{{ $item->tag }}</p>
                                    <p class="text-[11px] text-[#FF5722] mt-0.5">{{ $item->specs }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-block text-[11px] font-bold uppercase tracking-wider px-2.5 py-1 bg-[#151518] text-white border border-[#1F1F24]">
                                        {{ $item->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($item->status === 'draft')
                                        <span class="inline-flex items-center px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-amber-500/10 text-amber-400 border border-amber-500/30">
                                            Draft
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/30">
                                            Publish
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-mono text-neutral-400">
                                    {{ $item->year }}
                                </td>
                                <td class="px-6 py-4 font-mono text-neutral-400">
                                    {{ $item->order }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="inline-flex items-center space-x-2">
                                        <a 
                                            href="{{ route('admin.projects.edit', $item) }}" 
                                            class="px-3 py-1.5 bg-[#151518] hover:bg-[#1d1d22] text-white border border-[#1F1F24] font-semibold transition-colors"
                                        >
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.projects.destroy', $item) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus karya ini dari portofolio?');">
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit" 
                                                class="px-3 py-1.5 bg-red-950/40 hover:bg-red-900 text-red-300 border border-red-900/50 font-semibold transition-colors"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection

