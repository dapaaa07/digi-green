@extends('layouts.admin')

@section('title', 'Kelola Berita & Kabar Desa | Admin Cupunagara')

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
                <span class="text-[11px] font-bold uppercase tracking-wider text-[#1a9120]">Publikasi &amp; Kabar Desa</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#07370a] font-heading mt-0.5">Kelola Berita &amp; Artikel</h1>
            <p class="text-xs text-[#626f62] mt-0.5">Tulis, perbarui, dan atur artikel berita seputar kegiatan desa, aksi gotong royong kebersihan, dan kabar ekowisata Cupunagara.</p>
        </div>
        <a href="{{ route('admin.articles.create') }}" class="grdeen-btn self-start sm:self-auto !py-2.5 !px-5 text-xs">
            <span>+ Tulis Berita Baru</span>
        </a>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-white rounded-[10px] p-4 sm:p-5 border border-[#dce6d5] shadow-sm">
        <form action="{{ route('admin.articles.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3">
            <div class="relative flex-1 w-full">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari berdasarkan judul, kategori, atau penulis..." 
                       class="input-jadesta w-full text-xs pl-9">
                <svg class="w-4 h-4 text-[#626f62] absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <div class="flex items-center gap-2 w-full sm:w-auto">
                <select name="status" class="input-jadesta text-xs !py-2">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Diterbitkan</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draf</option>
                </select>

                <button type="submit" class="px-4 py-2 bg-[#1a9120] hover:bg-[#07370a] text-white rounded-[6px] text-xs font-bold transition">
                    Filter
                </button>

                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.articles.index') }}" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-[6px] text-xs font-bold transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Articles Table Card -->
    <div class="bg-white rounded-[10px] p-6 border border-[#dce6d5] shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-[#dce6d5] text-[#07370a] uppercase font-bold text-[11px] tracking-wider bg-[#f6f7f2]">
                        <th class="py-3 px-3">Thumbnail</th>
                        <th class="py-3 px-3">Judul Berita &amp; Kategori</th>
                        <th class="py-3 px-3">Penulis</th>
                        <th class="py-3 px-3">Tanggal Terbit</th>
                        <th class="py-3 px-3">Status</th>
                        <th class="py-3 px-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e7e7e7]">
                    @forelse($articles as $article)
                        <tr class="hover:bg-[#f6f7f2]/60 transition">
                            <td class="py-3.5 px-3">
                                <div class="w-16 h-12 rounded-[4px] overflow-hidden bg-slate-100 border border-[#e7e7e7]">
                                    <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="py-3.5 px-3 max-w-md">
                                <strong class="text-[#07370a] block text-xs font-heading font-bold hover:text-[#1a9120] transition">
                                    <a href="{{ route('admin.articles.edit', $article) }}">
                                        {{ $article->title }}
                                    </a>
                                </strong>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="px-2 py-0.5 rounded-[3px] bg-[#eff6f0] text-[#1a9120] font-bold border border-[#dce6d5] text-[10px]">
                                        {{ $article->category }}
                                    </span>
                                    <span class="text-[10px] text-[#626f62] font-mono truncate max-w-[200px]">/kabar/{{ $article->slug }}</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-3 text-[#4f5345]">
                                <span class="font-medium block">{{ $article->author }}</span>
                            </td>
                            <td class="py-3.5 px-3 text-[#626f62]">
                                @if($article->published_at)
                                    <span class="font-bold text-[#07370a] block">{{ $article->published_at->translatedFormat('d M Y') }}</span>
                                    <span class="text-[10px]">{{ $article->published_at->format('H:i') }} WIB</span>
                                @else
                                    <span class="text-gray-400 italic">Belum dijadwalkan</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-3">
                                @if($article->is_published)
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#ecf2df] text-[#1a9120] border border-[#dce6d5]">
                                        Diterbitkan
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        Draf
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-3 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    @if($article->is_published)
                                        <a href="{{ route('articles.show', $article->slug) }}" target="_blank" 
                                           class="px-2.5 py-1.5 rounded-[4px] bg-[#f6f7f2] border border-[#dce6d5] text-[#07370a] font-bold hover:bg-[#ecf2df] transition text-[11px]" title="Lihat di halaman publik">
                                            Lihat ↗
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.articles.edit', $article) }}" 
                                       class="px-3 py-1.5 rounded-[4px] bg-[#1a9120] hover:bg-[#07370a] text-white font-bold transition text-[11px]">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Hapus artikel &quot;{{ $article->title }}&quot;?')" class="inline">
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
                            <td colspan="6" class="py-12 text-center text-[#626f62]">
                                <p class="text-sm font-bold text-[#07370a]">Belum ada berita / artikel yang sesuai.</p>
                                <p class="text-xs mt-1">Mulai tulis berita baru untuk mempublikasikan kabar kegiatan desa.</p>
                                <a href="{{ route('admin.articles.create') }}" class="inline-block mt-3 px-4 py-2 bg-[#1a9120] text-white rounded-[6px] text-xs font-bold">
                                    + Tulis Berita Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($articles->hasPages())
            <div class="mt-6 pt-4 border-t border-[#e7e7e7]">
                {{ $articles->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
