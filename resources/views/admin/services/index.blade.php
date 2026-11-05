@extends('admin.layout')

@section('title', 'Pilar Keahlian')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-[#1F1F24] gap-4">
        <div>
            <p class="text-xs uppercase tracking-[0.25em] font-semibold text-[#FF5722] mb-1">
                Layanan &bull; Technical Mastery
            </p>
            <h1 class="font-display text-3xl font-black uppercase tracking-tight text-white">
                PILAR KEAHLIAN ({{ $services->count() }})
            </h1>
        </div>
        <a 
            href="{{ route('admin.services.create') }}" 
            class="inline-flex items-center space-x-2 bg-[#FF5722] hover:bg-[#F4511E] text-white text-xs font-bold uppercase tracking-widest px-5 py-3 transition-colors duration-200"
        >
            <span>+ Tambah Pilar Keahlian</span>
        </a>
    </div>

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($services as $service)
            <div class="bg-[#0E0E10] border border-[#1F1F24] p-6 flex flex-col justify-between hover:border-neutral-700 transition-colors">
                <div>
                    <div class="flex items-center justify-between border-b border-[#1F1F24] pb-4 mb-4">
                        <span class="font-mono text-xl font-black text-[#FF5722]">{{ $service->number }}</span>
                        <div class="flex items-center space-x-2">
                            @if ($service->status === 'draft')
                                <span class="inline-flex items-center px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-amber-500/10 text-amber-400 border border-amber-500/30">
                                    Draft
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/30">
                                    Publish
                                </span>
                            @endif
                            <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 bg-[#151518] text-neutral-400 border border-[#1F1F24]">
                                Urutan: {{ $service->order }}
                            </span>
                        </div>
                    </div>

                    <h2 class="text-base font-bold text-white mb-2 leading-snug">{{ $service->title }}</h2>
                    <p class="text-xs text-[#FF5722] font-semibold mb-3">{{ $service->tagline }}</p>
                    <p class="text-xs text-neutral-400 line-clamp-3 leading-relaxed mb-4">{{ $service->description }}</p>

                    @if (!empty($service->deliverables))
                        <div class="pt-4 border-t border-[#1F1F24]">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-neutral-300 mb-2">Hasil & Berkas Akhir:</p>
                            <ul class="space-y-1 text-xs text-neutral-400">
                                @foreach ($service->deliverables as $deliv)
                                    <li class="flex items-start space-x-1.5">
                                        <span class="text-[#FF5722]">&bull;</span>
                                        <span class="line-clamp-1">{{ $deliv }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="mt-6 pt-4 border-t border-[#1F1F24] flex items-center justify-between">
                    <a 
                        href="{{ route('admin.services.edit', $service) }}" 
                        class="px-4 py-2 bg-[#151518] hover:bg-[#1d1d22] text-white text-xs font-semibold border border-[#1F1F24] transition-colors"
                    >
                        Edit Layanan
                    </a>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pilar keahlian ini?');">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="px-3 py-2 bg-red-950/40 hover:bg-red-900 text-red-300 text-xs font-semibold border border-red-900/50 transition-colors"
                        >
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-[#0E0E10] border border-[#1F1F24] p-12 text-center text-neutral-400">
                Belum ada pilar keahlian yang ditambahkan.
            </div>
        @endforelse
    </div>
</div>
@endsection

