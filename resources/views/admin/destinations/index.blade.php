@extends('layouts.admin')

@section('title', 'Kelola Tempat Wisata | Admin Cupunagara')

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="sec-title__tagline-wrap">
                <span class="text-[#1a9120]">
                    <svg viewBox="0 0 12 10" fill="currentColor" class="w-3.5 h-3">
                        <path d="M5.8 1.6 C7 2.4 8 4 8 5 C8 6 7 7.6 5.8 8.4 L3.6 10 L6.3 10 C8 10 9.5 9.1 10.6 7.5 C12.1 5.2 12.1 4.8 10.6 2.5 C9.5 0.9 8 0 6.3 0 L3.6 0 L5.8 1.6 Z" />
                    </svg>
                </span>
                <span class="text-[11px] font-bold uppercase tracking-wider text-[#1a9120]">Direktori Wisata</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#07370a] font-heading mt-0.5">Kelola Tempat Wisata</h1>
            <p class="text-xs text-[#626f62] mt-0.5">Atur destinasi, foto lanskap, koordinat maps interaktif, jam buka, dan fasilitas ekowisata.</p>
        </div>
        <a href="{{ route('admin.destinations.create') }}" class="grdeen-btn self-start sm:self-auto !py-2.5 !px-5 text-xs">
            <span>+ Tambah Tempat Wisata</span>
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-[10px] p-6 border border-[#dce6d5] shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-[#dce6d5] text-[#07370a] uppercase font-bold text-[11px] tracking-wider bg-[#f6f7f2]">
                        <th class="py-3 px-3">Foto</th>
                        <th class="py-3 px-3">Nama Wisata</th>
                        <th class="py-3 px-3">Kategori</th>
                        <th class="py-3 px-3">Koordinat (Lat, Lng)</th>
                        <th class="py-3 px-3">Jam &amp; Biaya</th>
                        <th class="py-3 px-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e7e7e7]">
                    @forelse($destinations as $dest)
                        <tr class="hover:bg-[#f6f7f2]/60 transition">
                            <td class="py-3.5 px-3">
                                <div class="w-14 h-10 rounded-[4px] overflow-hidden bg-slate-100 border border-[#e7e7e7]">
                                    <img src="{{ $dest->thumbnail }}" alt="{{ $dest->name }}" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="py-3.5 px-3">
                                <strong class="text-[#07370a] block text-xs font-heading font-bold">{{ $dest->name }}</strong>
                                <span class="text-[10px] text-[#626f62] font-mono">{{ $dest->slug }}</span>
                                @if($dest->is_featured)
                                    <span class="inline-block mt-0.5 px-1.5 py-0.5 rounded-[3px] bg-[#ecf2df] text-[#1a9120] text-[9px] font-bold uppercase tracking-wider">
                                        Pilihan
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-3">
                                <span class="px-2 py-0.5 rounded-[3px] bg-[#eff6f0] text-[#1a9120] font-bold border border-[#dce6d5]">
                                    {{ $dest->category }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3 font-mono text-[#626f62] text-[11px]">
                                {{ number_format($dest->latitude, 4) }}, {{ number_format($dest->longitude, 4) }}
                            </td>
                            <td class="py-3.5 px-3 text-[#4f5345]">
                                <span class="block font-medium">{{ $dest->operating_hours }}</span>
                                <span class="text-[11px] text-[#1a9120] font-bold">{{ $dest->price_info }}</span>
                            </td>
                            <td class="py-3.5 px-3 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('destinations.show', $dest->slug) }}" target="_blank" 
                                       class="px-2.5 py-1.5 rounded-[4px] bg-[#f6f7f2] border border-[#dce6d5] text-[#07370a] font-bold hover:bg-[#ecf2df] transition text-[11px]">
                                        Web ↗
                                    </a>
                                    <a href="{{ route('admin.destinations.edit', $dest) }}" 
                                       class="px-3 py-1.5 rounded-[4px] bg-[#1a9120] hover:bg-[#07370a] text-white font-bold transition text-[11px]">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.destinations.destroy', $dest) }}" method="POST" onsubmit="return confirm('Hapus tempat wisata ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1.5 rounded-[4px] bg-red-50 border border-red-200 text-red-700 font-bold hover:bg-red-100 transition text-[11px]">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-[#626f62]">Belum ada data tempat wisata.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 pt-4 border-t border-[#e7e7e7]">
            {{ $destinations->links() }}
        </div>
    </div>

</div>
@endsection
