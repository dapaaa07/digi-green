@extends('layouts.admin')

@section('title', 'Kelola Tempat Wisata | Admin Cupunagara')

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 font-heading">Kelola Tempat Wisata</h1>
            <p class="text-xs text-slate-500 mt-0.5">Tambah atau perbarui destinasi, foto, koordinat maps, dan fasilitas wisata.</p>
        </div>
        <a href="{{ route('admin.destinations.create') }}" class="px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold transition shadow-sm self-start sm:self-auto">
            + Tambah Tempat Wisata
        </a>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-slate-100 text-slate-400 uppercase font-semibold">
                        <th class="pb-3">Foto</th>
                        <th class="pb-3">Nama Wisata</th>
                        <th class="pb-3">Kategori</th>
                        <th class="pb-3">Koordinat (Lat, Lng)</th>
                        <th class="pb-3">Jam & Biaya</th>
                        <th class="pb-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($destinations as $dest)
                        <tr class="hover:bg-slate-50/50">
                            <td class="py-3">
                                <div class="w-14 h-10 rounded-lg overflow-hidden bg-slate-100">
                                    <img src="{{ $dest->thumbnail }}" alt="{{ $dest->name }}" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="py-3">
                                <strong class="text-slate-900 block text-xs">{{ $dest->name }}</strong>
                                <span class="text-[11px] text-slate-400 font-mono">{{ $dest->slug }}</span>
                            </td>
                            <td class="py-3 text-emerald-700 font-semibold">{{ $dest->category }}</td>
                            <td class="py-3 font-mono text-slate-500 text-[11px]">{{ number_format($dest->latitude, 4) }}, {{ number_format($dest->longitude, 4) }}</td>
                            <td class="py-3 text-slate-600">
                                <span class="block">{{ $dest->operating_hours }}</span>
                                <span class="text-[11px] text-slate-400">{{ $dest->price_info }}</span>
                            </td>
                            <td class="py-3 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('destinations.show', $dest->slug) }}" target="_blank" class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-600 font-bold hover:bg-slate-200 transition text-[11px]">
                                        Web ↗
                                    </a>
                                    <a href="{{ route('admin.destinations.edit', $dest) }}" class="px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 font-bold hover:bg-blue-100 transition text-[11px]">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.destinations.destroy', $dest) }}" method="POST" onsubmit="return confirm('Hapus tempat wisata ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 rounded-lg bg-rose-50 text-rose-700 font-bold hover:bg-rose-100 transition text-[11px]">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400">Belum ada data tempat wisata.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 pt-4 border-t border-slate-100">
            {{ $destinations->links() }}
        </div>
    </div>

</div>
@endsection
