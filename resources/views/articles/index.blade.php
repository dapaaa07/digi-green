@extends('layouts.app')

@section('title', 'Berita & Kegiatan Desa Cupunagara | Jejaring Desa Wisata Subang')

@section('content')

    <!-- Jadesta Page Banner -->
    <div class="bg-[#07370a] text-white py-12 border-b-4 border-[#1a9120]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex text-xs text-[#ecf2df]/80 gap-1.5 mb-3">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <span>/</span>
                <span class="text-white font-semibold">Berita Desa</span>
            </nav>
            <div class="sec-title__tagline-wrap">
                <span class="text-[#1f9a26]">
                    <svg viewBox="0 0 12 10" fill="currentColor" class="w-3.5 h-3">
                        <path d="M5.8 1.6 C7 2.4 8 4 8 5 C8 6 7 7.6 5.8 8.4 L3.6 10 L6.3 10 C8 10 9.5 9.1 10.6 7.5 C12.1 5.2 12.1 4.8 10.6 2.5 C9.5 0.9 8 0 6.3 0 L3.6 0 L5.8 1.6 Z" />
                    </svg>
                </span>
                <span class="text-xs font-bold uppercase tracking-wider text-[#1f9a26]">Kabar Dari Desa Wisata</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold text-white font-heading mt-1">
                Informasi &amp; Kegiatan Desa Wisata Cupunagara
            </h1>
            <p class="text-sm text-[#d6dfd6] mt-2 max-w-2xl leading-relaxed">
                Dokumentasi kegiatan pengabdian masyarakat, gerakan kebersihan kawasan desa, edukasi budidaya kopi, dan perkembangan ekowisata Cupunagara.
            </p>
        </div>
    </div>

    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $article)
                    <article class="jadesta-blog-card group">
                        <div>
                            <div class="relative aspect-[16/10] bg-[#e7e7e7] overflow-hidden">
                                <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute bottom-3 left-4">
                                    <span class="jadesta-blog-card__date">
                                        {{ $article->published_at ? $article->published_at->translatedFormat('d M Y') : $article->created_at->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7 space-y-3">
                                <span class="text-xs font-bold uppercase tracking-wider text-[#1a9120] block">
                                    {{ $article->category }}
                                </span>
                                <h2 class="text-xl font-bold text-[#07370a] group-hover:text-[#1a9120] transition font-heading leading-snug">
                                    <a href="{{ route('articles.show', $article->slug) }}">
                                        {{ $article->title }}
                                    </a>
                                </h2>
                                <p class="text-sm text-[#626f62] line-clamp-3 leading-relaxed">
                                    {{ $article->excerpt }}
                                </p>
                            </div>
                        </div>

                        <div class="px-6 sm:px-7 pb-6 pt-2 flex items-center justify-between text-xs font-bold text-[#07370a]">
                            <span>Oleh {{ $article->author }}</span>
                            <a href="{{ route('articles.show', $article->slug) }}" class="text-[#1a9120] hover:underline">
                                Baca Selengkapnya &rarr;
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $articles->links() }}
            </div>

        </div>
    </div>
@endsection
