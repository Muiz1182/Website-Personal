@extends('admin.layout')

@section('title', 'Kelola Pengumuman Popup')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-[#1F1F24] gap-4">
        <div>
            <p class="text-xs uppercase tracking-[0.25em] font-semibold text-[#FF5722] mb-1">
                Sistem Notifikasi &bull; Announcement Modal
            </p>
            <h1 class="font-display text-3xl font-black uppercase tracking-tight text-white">
                PENGUMUMAN POPUP ({{ $announcements->count() }})
            </h1>
        </div>
        <a 
            href="{{ route('admin.announcements.create') }}" 
            class="inline-flex items-center space-x-2 bg-[#FF5722] hover:bg-[#F4511E] text-white text-xs font-bold uppercase tracking-widest px-5 py-3 transition-colors duration-200"
        >
            <span>+ Tambah Pengumuman</span>
        </a>
    </div>

    <!-- Info Banner -->
    <div class="p-4 bg-[#121215] border border-[#1F1F24] flex items-start space-x-3 text-xs text-neutral-300">
        <svg class="w-5 h-5 text-[#FF5722] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <p class="leading-relaxed">
            Pengumuman yang berstatus <strong class="text-white">Publish</strong> dan bertanda <strong class="text-emerald-400">Aktif (Popup Menyala)</strong> akan muncul otomatis di bagian tengah layar dengan tombol silang (x) saat pengunjung pertama kali membuka website. Setelah ditutup oleh pengunjung, popup tidak akan mengganggu lagi pada kunjungan tersebut.
        </p>
    </div>

    <!-- Table Card -->
    <div class="bg-[#0E0E10] border border-[#1F1F24] overflow-hidden">
        @if ($announcements->isEmpty())
            <div class="p-12 text-center">
                <p class="text-neutral-400 text-sm mb-4">Belum ada pengumuman yang dibuat.</p>
                <a href="{{ route('admin.announcements.create') }}" class="text-xs font-bold text-[#FF5722] uppercase tracking-wider hover:underline">
                    Buat pengumuman pertama Anda &rarr;
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#151518] text-neutral-400 uppercase tracking-wider font-semibold border-b border-[#1F1F24]">
                        <tr>
                            <th class="px-6 py-4">Status Popup</th>
                            <th class="px-6 py-4">Judul &amp; Badge</th>
                            <th class="px-6 py-4">Isi Pesan</th>
                            <th class="px-6 py-4">Tautan Aksi</th>
                            <th class="px-6 py-4">Publikasi</th>
                            <th class="px-6 py-4 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#1F1F24] text-neutral-300">
                        @foreach ($announcements as $item)
                            <tr class="hover:bg-[#121215] transition-colors {{ $item->is_active ? 'bg-[#151518]/50' : '' }}">
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.announcements.toggle', $item) }}" method="POST">
                                        @csrf
                                        <button 
                                            type="submit" 
                                            title="Klik untuk beralih aktif/nonaktif"
                                            class="inline-flex items-center space-x-1.5 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider transition-colors border {{ $item->is_active ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30 hover:bg-emerald-500/20' : 'bg-neutral-800 text-neutral-400 border-neutral-700 hover:bg-neutral-700 hover:text-white' }}"
                                        >
                                            <span class="w-2 h-2 rounded-full {{ $item->is_active ? 'bg-emerald-400 animate-pulse' : 'bg-neutral-500' }}"></span>
                                            <span>{{ $item->is_active ? 'Aktif (Popup)' : 'Nonaktif' }}</span>
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#151518] text-[#FF5722] border border-[#1F1F24] mb-1">
                                        {{ $item->badge ?? 'PENGUMUMAN' }}
                                    </span>
                                    <p class="font-bold text-white text-sm">{{ $item->title }}</p>
                                </td>
                                <td class="px-6 py-4 max-w-sm text-neutral-400">
                                    <p class="line-clamp-2 leading-relaxed">{{ $item->content }}</p>
                                </td>
                                <td class="px-6 py-4 text-neutral-400">
                                    @if ($item->action_text && $item->action_url)
                                        <a href="{{ $item->action_url }}" target="_blank" class="inline-flex items-center space-x-1 text-[#FF5722] hover:underline font-semibold">
                                            <span>{{ $item->action_text }}</span>
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    @else
                                        <span class="text-neutral-600 text-[11px]">&bull; Tanpa Tautan</span>
                                    @endif
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
                                <td class="px-6 py-4 text-right">
                                    <div class="inline-flex items-center space-x-2">
                                        <a 
                                            href="{{ route('admin.announcements.edit', $item) }}" 
                                            class="px-3 py-1.5 bg-[#151518] hover:bg-[#1d1d22] text-white border border-[#1F1F24] font-semibold transition-colors"
                                        >
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.announcements.destroy', $item) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?');">
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

