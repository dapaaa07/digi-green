@extends('layouts.app')

@section('title', 'Produk Pariwisata & Kopi Cupunagara | Jejaring Desa Wisata Subang')

@section('content')

    <!-- Jadesta Page Banner -->
    <div class="bg-[#07370a] text-white py-12 border-b-4 border-[#1a9120]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex text-xs text-[#ecf2df]/80 gap-1.5 mb-3">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <span>/</span>
                <span class="text-white font-semibold">Produk &amp; Suvenir Kopi</span>
            </nav>
            <div class="sec-title__tagline-wrap">
                <span class="text-[#1f9a26]">
                    <svg viewBox="0 0 12 10" fill="currentColor" class="w-3.5 h-3">
                        <path d="M5.8 1.6 C7 2.4 8 4 8 5 C8 6 7 7.6 5.8 8.4 L3.6 10 L6.3 10 C8 10 9.5 9.1 10.6 7.5 C12.1 5.2 12.1 4.8 10.6 2.5 C9.5 0.9 8 0 6.3 0 L3.6 0 L5.8 1.6 Z" />
                    </svg>
                </span>
                <span class="text-xs font-bold uppercase tracking-wider text-[#1f9a26]">Produk Pariwisata &amp; Ekonomi Kreatif</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold text-white font-heading mt-1">
                Kopi Specialty Lereng Gunung Canggah
            </h1>
            <p class="text-sm text-[#d6dfd6] mt-2 max-w-2xl leading-relaxed">
                Desa Cupunagara memiliki lahan vulkanik subur di ketinggian 1.000 hingga 1.200 mdpl. Setiap kemasan kopi dipetik dari ceri merah matang dan diolah langsung oleh kelompok tani desa.
            </p>
        </div>
    </div>

    <div class="py-16 bg-[#eff6f0]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Coffee Products Grid in Jadesta Project Card Style -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($coffees as $coffee)
                    <div class="jadesta-project-card flex flex-col justify-between group">
                        <div>
                            <!-- Product Image -->
                            <div class="jadesta-project-card__image aspect-[4/3]">
                                <img src="{{ $coffee->image }}" alt="{{ $coffee->name }}">
                                <span class="absolute top-3 left-3 px-3 py-1 rounded-[3px] text-[11px] font-bold uppercase bg-[#1a9120] text-white shadow-sm">
                                    {{ $coffee->process_type }}
                                </span>
                                <span class="absolute top-3 right-3 px-2.5 py-1 rounded-[3px] text-[11px] font-bold bg-[#faf8ec] text-[#07370a] border border-[#dce6d5] shadow-sm">
                                    {{ $coffee->packaging_size }}
                                </span>
                            </div>

                            <!-- Signature Jadesta Right-Rounded Cream Overlay -->
                            <div class="jadesta-project-card__overlay">
                                <strong class="jadesta-project-card__tag">
                                    {{ $coffee->roast_level }} &bull; Suvenir Desa
                                </strong>
                                <h2 class="jadesta-project-card__title !text-lg">
                                    {{ $coffee->name }}
                                </h2>
                                <a href="{{ $coffee->whatsapp_order_url }}" 
                                   target="_blank" rel="noopener noreferrer"
                                   class="jadesta-project-card__arrow"
                                   aria-label="Pesan {{ $coffee->name }} via WhatsApp">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771z"/>
                                    </svg>
                                </a>
                            </div>

                            <!-- Product Details -->
                            <div class="px-6 pb-5 space-y-3">
                                <p class="text-xs sm:text-sm text-[#626f62] line-clamp-3 leading-relaxed">
                                    {{ $coffee->description }}
                                </p>

                                <div class="p-3 rounded-[4px] bg-[#f2f4ec] border border-[#dce6d5] text-xs text-[#07370a]">
                                    <strong>Cita Rasa:</strong> {{ $coffee->flavor_notes }}
                                </div>

                                <div class="text-xs text-[#626f62] pt-1">
                                    Kelompok Tani: <strong class="text-[#07370a]">{{ $coffee->producer_name }}</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Price & WhatsApp Order Button -->
                        <div class="px-6 py-4 bg-[#f6f7f2] border-t border-[#e7e7e7] flex items-center justify-between">
                            <div>
                                <span class="text-[10px] font-bold uppercase text-[#626f62] block">Harga Produk</span>
                                <span class="text-xl font-extrabold text-[#07370a] font-heading">
                                    Rp {{ number_format($coffee->price, 0, ',', '.') }}
                                </span>
                            </div>

                            <a href="{{ $coffee->whatsapp_order_url }}" 
                               target="_blank" rel="noopener noreferrer"
                               class="grdeen-btn !py-2.5 !px-5 !text-xs">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771z"/>
                                </svg>
                                <span>Pesan via WA</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Info Agrowisata Callout Box -->
            <div class="mt-16 bg-white rounded-[6px] p-7 sm:p-8 border border-[#dce6d5] shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="space-y-1.5 text-center md:text-left">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#1a9120] block">Paket Edukasi Agrowisata</span>
                    <h3 class="text-xl font-bold text-[#07370a] font-heading">Kunjungi Kebun Kopi Langsung di Desa Cupunagara</h3>
                    <p class="text-xs sm:text-sm text-[#626f62] max-w-xl leading-relaxed">
                        Wisatawan dapat mengunjungi langsung Agrowisata Perkebunan Kopi Canggah untuk menyaksikan proses panen petik merah, penjemuran, hingga penyangraian bersama petani desa.
                    </p>
                </div>
                <a href="{{ route('destinations.show', 'agrowisata-kebun-kopi-canggah') }}" 
                   class="grdeen-btn shrink-0">
                    <span>Lihat Agrowisata Kopi</span>
                </a>
            </div>

        </div>
    </div>
@endsection
