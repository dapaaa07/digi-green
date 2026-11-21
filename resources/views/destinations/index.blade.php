@extends('layouts.app')

@section('title', 'Direktori Wisata Desa Cupunagara | Jejaring Desa Wisata Subang')

@section('content')

    <!-- Jadesta Page Banner -->
    <div class="bg-[#07370a] text-white py-12 border-b-4 border-[#1a9120]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex text-xs text-[#ecf2df]/80 gap-1.5 mb-3">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <span>/</span>
                <span class="text-white font-semibold">Wisata</span>
            </nav>
            <div class="sec-title__tagline-wrap">
                <span class="text-[#1f9a26]">
                    <svg viewBox="0 0 12 10" fill="currentColor" class="w-3.5 h-3">
                        <path d="M5.8 1.6 C7 2.4 8 4 8 5 C8 6 7 7.6 5.8 8.4 L3.6 10 L6.3 10 C8 10 9.5 9.1 10.6 7.5 C12.1 5.2 12.1 4.8 10.6 2.5 C9.5 0.9 8 0 6.3 0 L3.6 0 L5.8 1.6 Z" />
                    </svg>
                </span>
                <span class="text-xs font-bold uppercase tracking-wider text-[#1f9a26]">Direktori Destinasi Wisata</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold text-white font-heading mt-1">
                Destinasi Wisata Desa Cupunagara
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
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama wisata, bukit, curug, kopi..." 
                               class="input-jadesta w-full pl-10">
                    </div>

                    <div class="w-full md:w-64">
                        <select name="category" onchange="this.form.submit()" class="input-jadesta w-full">
                            <option value="">Semua Kategori Wisata</option>
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
                <div class="p-4 bg-[#f2f4ec] border-b border-[#dce6d5] flex flex-wrap items-center justify-between gap-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#07370a] flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#1a9120]"></span>
                        Peta Sebaran Lokasi Wisata Desa Cupunagara
                    </span>
                    <div class="flex items-center gap-3">
                        <button type="button" id="btn-reset-dest-map" class="text-xs font-bold text-[#07370a] hover:text-[#1a9120] flex items-center gap-1.5 transition cursor-pointer" title="Pusatkan peta ke kawasan Desa Cupunagara">
                            <svg class="w-3.5 h-3.5 text-[#1a9120]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Pusatkan Peta
                        </button>
                        <span class="text-[#dce6d5]">|</span>
                        <button type="button" @click="mapOpen = !mapOpen" class="text-xs font-bold text-[#1a9120] hover:underline cursor-pointer">
                            <span x-text="mapOpen ? 'Tutup Peta' : 'Tampilkan Peta'"></span>
                        </button>
                    </div>
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
                                        Detail Wisata
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
                    <h3 class="text-lg font-bold text-[#07370a] font-heading">Tempat wisata tidak ditemukan</h3>
                    <p class="text-sm text-[#626f62]">Silakan ubah kata kunci pencarian atau tampilkan semua kategori wisata.</p>
                    <a href="{{ route('destinations.index') }}" class="grdeen-btn !mt-2">
                        <span>Tampilkan Semua Wisata</span>
                    </a>
                </div>
            @endif

        </div>
    </div>
@endsection

@push('scripts')
<style>
    /* Styling Pin Koordinat Berbasis Teks (Tanpa Gambar) */
    .cupu-marker-wrap {
        background: transparent !important;
        border: none !important;
    }
    .cupu-text-pin {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #ffffff;
        color: #07370a;
        border: 1.5px solid #1a9120;
        padding: 5px 10px;
        border-radius: 9999px;
        font-family: 'DM Sans', system-ui, -apple-system, sans-serif;
        font-size: 11.5px;
        font-weight: 700;
        line-height: 1.2;
        letter-spacing: -0.01em;
        box-shadow: 0 4px 12px rgba(7, 55, 10, 0.22);
        position: relative;
        cursor: pointer;
        user-select: none;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        transform: translate(-50%, -100%);
        margin-top: -6px;
        white-space: nowrap;
    }
    .cupu-text-pin .pin-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #1a9120;
        flex-shrink: 0;
        transition: all 0.2s ease;
    }
    /* Solusi Nama Panjang: Max-Width + Auto Ellipsis (...) */
    .cupu-text-pin .pin-title {
        max-width: 135px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: inline-block;
    }
    /* Segitiga Panah Arah Koordinat */
    .cupu-text-pin .pin-pointer {
        position: absolute;
        bottom: -6px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 6px solid #1a9120;
        transition: border-top-color 0.2s ease;
    }
    .cupu-text-pin .pin-pointer::after {
        content: '';
        position: absolute;
        bottom: 1.5px;
        left: -4.5px;
        width: 0;
        height: 0;
        border-left: 4.5px solid transparent;
        border-right: 4.5px solid transparent;
        border-top: 4.5px solid #ffffff;
        transition: border-top-color 0.2s ease;
    }
    /* Efek Interaktif Hover */
    .cupu-text-pin:hover,
    .cupu-text-pin.active {
        background: #1a9120;
        color: #ffffff;
        border-color: #07370a;
        transform: translate(-50%, -105%) scale(1.06);
        box-shadow: 0 8px 20px rgba(7, 55, 10, 0.35);
        z-index: 9999 !important;
    }
    .cupu-text-pin:hover .pin-dot,
    .cupu-text-pin.active .pin-dot {
        background: #ffffff;
        transform: scale(1.25);
    }
    .cupu-text-pin:hover .pin-pointer,
    .cupu-text-pin.active .pin-pointer {
        border-top-color: #07370a;
    }
    .cupu-text-pin:hover .pin-pointer::after,
    .cupu-text-pin.active .pin-pointer::after {
        border-top-color: #1a9120;
    }
    /* Tooltip Lengkap Saat Hover */
    .leaflet-tooltip.cupu-tooltip {
        background: #07370a !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 6px !important;
        padding: 6px 11px !important;
        font-family: 'DM Sans', sans-serif !important;
        font-size: 11.5px !important;
        font-weight: 700 !important;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25) !important;
    }
    .leaflet-tooltip.cupu-tooltip::before {
        border-top-color: #07370a !important;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (!document.getElementById('destinations-map')) return;

        // 1. Batasan Geografis Khusus Area Desa Cupunagara & Sekitarnya
        var southWest = L.latLng(-6.7920, 107.6650);
        var northEast = L.latLng(-6.7350, 107.7120);
        var cupunagaraBounds = L.latLngBounds(southWest, northEast);

        var map = L.map('destinations-map', {
            maxBounds: cupunagaraBounds,
            maxBoundsViscosity: 1.0, // Batasan kaku: peta memantul kembali jika digeser keluar desa
            minZoom: 13,             // Mencegah zoom-out terlalu jauh
            maxZoom: 18,
            scrollWheelZoom: false   // Cegah scroll halaman menggeser zoom peta secara tidak sengaja
        }).setView([-6.7635, 107.6890], 14);

        map.on('click', function() {
            map.scrollWheelZoom.enable();
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // 2. Fungsi Cerdas Penyederhanaan Label Pin untuk Mengatasi Nama Panjang
        function formatPinLabel(name) {
            if (!name) return '';
            var label = name.replace(/\(.*?\)/g, '').trim();
            label = label.replace(/\s+(Cupunagara|Cipunagara)\b/gi, '').trim();
            if (label.length > 20) {
                label = label.replace(/\bKampung\s+Eco\s+Wisata\b/gi, 'Eco Wisata')
                             .replace(/\bBukit\s+Lestari\b/gi, 'Bukit')
                             .replace(/\bKampung\b/gi, 'Kp.');
            }
            return label;
        }

        var destinations = @json($allDestinations);
        var markersGroup = L.featureGroup();

        destinations.forEach(function(dest) {
            if (dest.latitude && dest.longitude) {
                var shortLabel = formatPinLabel(dest.name);

                var textPinIcon = L.divIcon({
                    className: 'cupu-marker-wrap',
                    html: `
                        <div class="cupu-text-pin">
                            <span class="pin-dot"></span>
                            <span class="pin-title">${shortLabel}</span>
                            <div class="pin-pointer"></div>
                        </div>
                    `,
                    iconSize: [0, 0],
                    iconAnchor: [0, 0],
                    popupAnchor: [0, -32]
                });

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

                var marker = L.marker([dest.latitude, dest.longitude], { icon: textPinIcon })
                    .bindPopup(popupHtml);

                marker.bindTooltip(dest.name, {
                    direction: 'top',
                    offset: [0, -28],
                    className: 'cupu-tooltip'
                });

                markersGroup.addLayer(marker);
            }
        });

        markersGroup.addTo(map);

        if (markersGroup.getLayers().length > 0) {
            map.fitBounds(markersGroup.getBounds().pad(0.12));
        }

        // 3. Tombol Reset / Pusatkan Peta jika Pengguna Tidak Sengaja Menggeser
        var btnReset = document.getElementById('btn-reset-dest-map');
        if (btnReset) {
            btnReset.addEventListener('click', function() {
                if (markersGroup.getLayers().length > 0) {
                    map.flyToBounds(markersGroup.getBounds().pad(0.12), {
                        duration: 0.8
                    });
                } else {
                    map.flyTo([-6.7635, 107.6890], 14, {
                        duration: 0.8
                    });
                }
            });
        }

        // Handle ukuran peta jika tab / accordion dibuka tutup
        window.addEventListener('resize', function() {
            setTimeout(function() { map.invalidateSize(); }, 200);
        });
    });
</script>
@endpush
