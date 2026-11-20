@extends('layouts.app')

@section('title', $article->title . ' | Jejaring Desa Wisata Cupunagara')

@section('content')

    <!-- Jadesta Page Banner -->
    <div class="bg-[#07370a] text-white py-10 border-b-4 border-[#1a9120]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex text-xs text-[#ecf2df]/80 gap-1.5 mb-3">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <span>/</span>
                <a href="{{ route('articles.index') }}" class="hover:text-white">Berita Desa</a>
                <span>/</span>
                <span class="text-white font-semibold line-clamp-1">{{ $article->title }}</span>
            </nav>
            <span class="inline-block px-3 py-1 rounded-[3px] bg-[#1a9120] text-white text-xs font-bold uppercase tracking-wider mb-2">
                {{ $article->category }}
            </span>
            <h1 class="text-2xl sm:text-4xl font-bold text-white font-heading leading-tight">
                {{ $article->title }}
            </h1>
            <div class="flex items-center gap-4 text-xs text-[#d6dfd6] pt-3">
                <span>Oleh <strong class="text-white">{{ $article->author }}</strong></span>
                <span>&bull;</span>
                <span>{{ $article->published_at ? $article->published_at->translatedFormat('d F Y, H:i') : $article->created_at->translatedFormat('d F Y') }} WIB</span>
            </div>
        </div>
    </div>

    <div class="py-14 bg-[#f6f7f2]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <div class="bg-white rounded-[6px] p-6 sm:p-10 border border-[#dce6d5] shadow-sm space-y-6">
                @if($article->thumbnail)
                    <div class="aspect-[16/9] rounded-[4px] overflow-hidden bg-[#f2f4ec] border border-[#e7e7e7]">
                        <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="text-[#4f5345] text-[15.5px] leading-[1.85] space-y-4">
                    {!! nl2br(e($article->content)) !!}
                </div>
            </div>

            @if($relatedArticles->count() > 0)
                <div class="pt-4">
                    <h3 class="text-xl font-bold text-[#07370a] font-heading mb-6">Berita &amp; Kegiatan Lainnya</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        @foreach($relatedArticles as $rel)
                            <a href="{{ route('articles.show', $rel->slug) }}" class="jadesta-blog-card p-5 block group">
                                <span class="text-[11px] font-bold uppercase text-[#1a9120] block mb-1">{{ $rel->category }}</span>
                                <h4 class="text-sm font-bold text-[#07370a] group-hover:text-[#1a9120] transition line-clamp-2 font-heading">{{ $rel->title }}</h4>
                                <span class="text-xs text-[#626f62] mt-3 block">{{ $rel->created_at->translatedFormat('d M Y') }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
