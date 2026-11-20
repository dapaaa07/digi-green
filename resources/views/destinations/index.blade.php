@extends('layouts.app')

@section('title', 'Direktori Atraksi Wisata Desa Cupunagara | Jejaring Desa Wisata Subang')

@section('content')

    <!-- Jadesta Page Banner -->
    <div class="bg-[#07370a] text-white py-12 border-b-4 border-[#1a9120]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex text-xs text-[#ecf2df]/80 gap-1.5 mb-3">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <span>/</span>
                <span class="text-white font-semibold">Atraksi Wisata</span>
            </nav>
            <div class="sec-title__tagline-wrap">
                <span class="text-[#1f9a26]">
                    <svg viewBox="0 0 12 10" fill="currentColor" class="w-3.5 h-3">
                        <path d="M5.8 1.6 C7 2.4 8 4 8 5 C8 6 7 7.6 5.8 8.4 L3.6 10 L6.3 10 C8 10 9.5 9.1 10.6 7.5 C12.1 5.2 12.1 4.8 10.6 2.5 C9.5 0.9 8 0 6.3 0 L3.6 0 L5.8 1.6 Z" />
                    </svg>
                </span>
                <span class="text-xs font-bold uppercase tracking-wider text-[#1f9a26]">Direktori Daya Tarik Wisata</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold text-white font-heading mt-1">
                Atraksi &amp; Tempat Wisata Desa Cupunagara
            </h1>
            <p class="text-sm text-[#d6dfd6] mt-2 max-w-2xl leading-relaxed">
                Temukan panorama bukit awan Bukit Pamoyanan, agrowisata kebun kopi Canggah, air terjun alami, dan sentra kuliner warga di Kecamatan Cisalak, Kabupaten Subang.
            </p>
        </div>
    </div>

    <div class="py-14 bg-[#eff6f0]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Jadesta Filter & Search Bar -->
            <div class="bg-white p-5 rounded-[6px] border border-[#dce6d5] shadow-sm mb-10">
                <form action="{{ route('destinations.index') }}" method="GET" class="flex flex-col md:flex-row items-center gap-3">
                    <div class="relative flex-1 w-full">
                        <svg class="w-4 h-4 text-[#626f62] absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atraksi wisata, bukit, curug, kopi..." 
                               class="input-jadesta w-full pl-10">
                    </div>

                    <div class="w-full md:w-64">
                        <select name="category" onchange="this.form.submit()" class="input-jadesta w-full">
                            <option value="">Semua Kategori Atraksi</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center gap-2 w-full md:w-auto">
                        <button type="submit" class="grdeen-btn !py-3 !px-7 w-full md:w-auto">
                            <span>Cari</span>
                        </button>
                        @if(request()->filled('q') || request()->filled('category'))
                            <a href="{{ route('destinations.index') }}" class="grdeen-btn grdeen-btn--outline !py-3 !px-5 text-center">
                                <span>Reset</span>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Interactive Map Sebaran Toggle -->
            <div class="mb-12 bg-white rounded-[6px] border border-[#dce6d5] overflow-hidden shadow-sm" x-data="{ mapOpen: true }">
                <div class="p-4 bg-[#f2f4ec] border-b border-[#dce6d5] flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#07370a] flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#1a9120]"></span>
                        Peta Sebaran Lokasi Atraksi &amp; 3 Titik Plang Bambu QR (OpenStreetMap)
                    </span>
                    <button type="button" @click="mapOpen = !mapOpen" class="text-xs font-bold text-[#1a9120] hover:underline">
                        <span x-text="mapOpen ? 'Tutup Peta' : 'Tampilkan Peta'"></span>
                    </button>
                </div>
                <div x-show="mapOpen" class="w-full h-80 sm:h-96" id="destinations-map"></div>
            </div>

            <!-- Destinations Grid in Jadesta Signature Project Card Style -->
            @if($destinations->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($destinations as $destination)
                        <div class="jadesta-project-card flex flex-col justify-between group">
                            <div>
                                <div class="jadesta-project-card__image aspect-[16/10]">
                                    <img src="{{ $destination->thumbnail }}" 
                                         alt="{{ $destination->name }}" 
                                         loading="lazy">
                                </div>

                                <!-- Jadesta Right-Rounded Cream Overlay -->
                                <div class="jadesta-project-card__overlay">
                                    <strong class="jadesta-project-card__tag">
                                        {{ $destination->category }} &bull; Desa Wisata Cupunagara
                                    </strong>
                                    <h2 class="jadesta-project-card__title">
                                        <a href="{{ route('destinations.show', $destination->slug) }}">
                                            {{ $destination->name }}
                                        </a>
                                    </h2>
                                    <a href="{{ route('destinations.show', $destination->slug) }}" 
                                       class="jadesta-project-card__arrow"
                                       aria-label="Lihat {{ $destination->name }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </div>

                                <div class="px-6 pb-4 space-y-2">
                                    <p class="text-sm text-[#626f62] line-clamp-2 leading-relaxed">
                                        {{ $destination->excerpt }}
                                    </p>
                                </div>
                            </div>

                            <div class="px-6 py-4 bg-[#f6f7f2] border-t border-[#e7e7e7] flex flex-wrap items-center justify-between gap-2 text-xs">
                                <div class="text-[#4f5345] font-medium">
                                    <span>Jam: <strong>{{ $destination->operating_hours }}</strong></span>
                                    <span class="mx-1.5">&bull;</span>
                                    <span class="text-[#1a9120] font-bold">{{ $destination->price_info }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ $destination->google_maps_navigation_url }}" 
                                       target="_blank" rel="noopener noreferrer"
                                       class="px-3 py-1.5 rounded-[4px] bg-white border border-[#dce6d5] text-[#07370a] hover:bg-[#ecf2df] font-bold transition">
                                        Google Maps
                                    </a>
                                    <a href="{{ route('destinations.show', $destination->slug) }}" 
                                       class="px-3.5 py-1.5 rounded-[4px] bg-[#1a9120] hover:bg-[#07370a] text-white font-bold transition">
                                        Detail Atraksi
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $destinations->links() }}
                </div>
            @else
                <div class="bg-white rounded-[6px] p-12 text-center border border-[#dce6d5] space-y-3">
                    <h3 class="text-lg font-bold text-[#07370a] font-heading">Atraksi wisata tidak ditemukan</h3>
                    <p class="text-sm text-[#626f62]">Silakan ubah kata kunci pencarian atau tampilkan semua kategori wisata.</p>
                    <a href="{{ route('destinations.index') }}" class="grdeen-btn !mt-2">
                        <span>Tampilkan Semua Atraksi</span>
                    </a>
                </div>
            @endif

        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (!document.getElementById('destinations-map')) return;

        var map = L.map('destinations-map').setView([-6.7562000, 107.6881000], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var destinations = @json($allDestinations);
        destinations.forEach(function(dest) {
            if (dest.latitude && dest.longitude) {
                var popupHtml = `
                    <div style="width: 220px; font-family: 'Inter', sans-serif;">
                        <img src="${dest.thumbnail}" style="width: 100%; height: 110px; object-fit: cover; border-radius: 4px; margin-bottom: 8px;">
                        <span style="font-size: 10px; font-weight: 700; color: #1a9120; text-transform: uppercase;">${dest.category}</span>
                        <h4 style="font-size: 14px; font-weight: 700; margin: 3px 0 6px; color: #07370a; font-family: 'DM Sans', sans-serif;">${dest.name}</h4>
                        <div style="display: flex; gap: 6px; margin-top: 8px;">
                            <a href="/wisata/${dest.slug}" style="flex: 1; padding: 6px; font-size: 11px; text-align: center; background: #1a9120; color: #fff; text-decoration: none; border-radius: 4px; font-weight: 600;">Detail</a>
                            <a href="${dest.google_maps_navigation_url}" target="_blank" rel="noopener noreferrer" style="flex: 1; padding: 6px; font-size: 11px; text-align: center; background: #faf8ec; color: #07370a; text-decoration: none; border-radius: 4px; font-weight: 600; border: 1px solid #dce6d5;">Maps</a>
                        </div>
                    </div>
                `;
                L.marker([dest.latitude, dest.longitude]).addTo(map).bindPopup(popupHtml);
            }
        });

        var qrPoints = @json($qrPoints);
        qrPoints.forEach(function(qr) {
            if (qr.latitude && qr.longitude) {
                var qrPopup = `
                    <div style="width: 210px; font-family: 'Inter', sans-serif;">
                        <span style="font-size: 10px; font-weight: 700; color: #fff; background: #1a9120; padding: 2px 8px; border-radius: 3px;">PLANG BAMBU QR</span>
                        <h4 style="font-size: 13px; font-weight: 700; margin: 8px 0 4px; color: #07370a;">${qr.location_name}</h4>
                        <a href="/qr/${qr.code}" style="display: block; width: 100%; padding: 6px; font-size: 11px; text-align: center; background: #07370a; color: #fff; text-decoration: none; border-radius: 4px; font-weight: 600;">Panduan Titik</a>
                    </div>
                `;
                L.marker([qr.latitude, qr.longitude]).addTo(map).bindPopup(qrPopup);
            }
        });
    });
</script>
@endpush
