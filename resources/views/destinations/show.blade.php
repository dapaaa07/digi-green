@extends('layouts.app')

@section('title', $destination->name . ' | Jejaring Desa Wisata Cupunagara')
@section('meta_description', $destination->excerpt)

@section('content')

    <!-- Jadesta Top Photo Strip / Gallery Banner -->
    <div class="bg-[#07370a] border-b border-[#e7e7e7]">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-1 bg-[#07370a]">
                <div class="md:col-span-8 aspect-[16/9] md:aspect-auto md:h-[380px] overflow-hidden relative">
                    <img src="{{ $destination->thumbnail }}" 
                         alt="{{ $destination->name }}" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute bottom-4 left-5 right-5 text-white flex items-center justify-between">
                        <span class="px-3 py-1 rounded-[3px] bg-[#1a9120] text-xs font-bold uppercase tracking-wider">
                            {{ $destination->category }}
                        </span>
                        <span class="text-xs font-mono bg-black/50 px-2.5 py-1 rounded-[3px]">
                            {{ number_format($destination->latitude, 4) }}, {{ number_format($destination->longitude, 4) }}
                        </span>
                    </div>
                </div>
                <div class="hidden md:grid md:col-span-4 grid-rows-2 gap-1 h-[380px]">
                    @php
                        $gallery = !empty($destination->gallery_images) ? $destination->gallery_images : [];
                        $sideImg1 = $gallery[0] ?? 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=800&q=80';
                        $sideImg2 = $gallery[1] ?? 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=800&q=80';
                    @endphp
                    <div class="overflow-hidden relative">
                        <img src="{{ $sideImg1 }}" alt="Suasana {{ $destination->name }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="overflow-hidden relative">
                        <img src="{{ $sideImg2 }}" alt="Lanskap {{ $destination->name }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Jadesta Profile Container -->
    <div class="py-10 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex text-xs text-[#626f62] gap-1.5 mb-5">
                <a href="{{ route('home') }}" class="hover:text-[#1a9120]">Home</a>
                <span>/</span>
                <a href="{{ route('destinations.index') }}" class="hover:text-[#1a9120]">Wisata</a>
                <span>/</span>
                <span class="text-[#07370a] font-semibold">{{ $destination->name }}</span>
            </nav>

            <!-- Main Grid: Left Content (8 cols) & Right Jadesta Boxed Widgets Sidebar (4 cols) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                
                <!-- Left Column: Jadesta Titlebar, Sub-nav, Profile, Facilities, Gallery -->
                <div class="lg:col-span-8 space-y-8">
                    
                    <!-- Jadesta Listing Titlebar (#titlebar) -->
                    <div class="pb-6 border-b border-[#e7e7e7] space-y-2">
                        <div class="flex flex-wrap items-center gap-2.5">
                            <h1 class="text-2xl sm:text-4xl font-bold text-[#07370a] font-heading">
                                {{ $destination->name }}
                            </h1>
                            <span class="px-3 py-1 rounded-[3px] bg-[#ecf2df] text-[#1a9120] border border-[#1a9120]/30 text-xs font-bold uppercase">
                                {{ $destination->category }}
                            </span>
                        </div>
                        <p class="text-sm text-[#626f62] flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[#1a9120] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Desa Cupunagara, Kecamatan Cisalak, Kabupaten Subang, Jawa Barat</span>
                        </p>
                    </div>

                    <!-- Jadesta Listing Sub-Navigation (#listing-nav) -->
                    <div class="bg-[#f6f7f2] border border-[#e7e7e7] rounded-[4px] p-1.5 flex flex-wrap gap-1 text-xs sm:text-sm font-semibold">
                        <a href="#listing-profile" class="px-4 py-2 rounded-[3px] bg-[#1a9120] text-white">Profil</a>
                        <a href="#listing-fasilitas" class="px-4 py-2 rounded-[3px] text-[#07370a] hover:bg-[#ecf2df] transition">Fasilitas</a>
                        <a href="#listing-etika" class="px-4 py-2 rounded-[3px] text-[#07370a] hover:bg-[#ecf2df] transition">Etika &amp; Gotong Royong</a>
                        @if(!empty($destination->gallery_images) && count($destination->gallery_images) > 0)
                            <a href="#listing-galeri" class="px-4 py-2 rounded-[3px] text-[#07370a] hover:bg-[#ecf2df] transition">Galeri Foto</a>
                        @endif
                    </div>

                    <!-- Section: Profil (#listing-profile) -->
                    <div id="listing-profile" class="space-y-4">
                        <h2 class="text-xl font-bold text-[#07370a] font-heading pb-2 border-b border-[#e7e7e7]">
                            Profil Daya Tarik Wisata
                        </h2>
                        <p class="text-[15.5px] font-medium text-[#07370a] leading-relaxed bg-[#f2f4ec] p-4 rounded-[4px] border-l-4 border-[#1a9120]">
                            {{ $destination->excerpt }}
                        </p>
                        <div class="text-[#4f5345] text-[15px] leading-[1.8] space-y-4">
                            {!! nl2br(e($destination->description)) !!}
                        </div>
                    </div>

                    <!-- Section: Fasilitas (#listing-fasilitas) -->
                    @if(!empty($destination->facilities) && count($destination->facilities) > 0)
                        <div id="listing-fasilitas" class="pt-4 space-y-4">
                            <h2 class="text-xl font-bold text-[#07370a] font-heading pb-2 border-b border-[#e7e7e7]">
                                Fasilitas
                            </h2>
                            <ul class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach($destination->facilities as $facility)
                                    <li class="flex items-center gap-2.5 p-3 rounded-[4px] bg-[#f6f7f2] border border-[#e7e7e7] text-xs sm:text-sm font-semibold text-[#07370a]">
                                        <span class="w-5 h-5 rounded-[3px] bg-[#1a9120] text-white flex items-center justify-center text-xs font-bold shrink-0">&check;</span>
                                        <span>{{ $facility }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Section: Etika & Gotong Royong (#listing-etika) -->
                    <div id="listing-etika" class="pt-4">
                        <div class="bg-[#edf5ee] border border-[#1a9120]/30 rounded-[6px] p-6 space-y-3">
                            <div class="flex items-center gap-2.5">
                                <span class="px-2.5 py-0.5 rounded-[3px] bg-[#1a9120] text-white text-[11px] font-bold uppercase">
                                    Panduan Digi-Green
                                </span>
                                <h2 class="text-lg font-bold text-[#07370a] font-heading">
                                    Budaya Gotong Royong &amp; Kebersihan Kawasan
                                </h2>
                            </div>
                            <p class="text-sm text-[#4f5345] leading-relaxed">
                                {{ $destination->cleanliness_tips ?? 'Mari jaga keasrian kawasan wisata bersama. Bawa kembali sampah kemasan plastik dan botol minum pribadi Anda ke tempat sampah terdekat. Gunakan formulir laporan apabila Anda menemukan tumpukan sampah liar atau kerusakan fasilitas yang memerlukan penanganan armada desa.' }}
                            </p>
                            <div class="pt-1">
                                <a href="{{ route('reports.create', ['destination_id' => $destination->id]) }}" 
                                   class="inline-flex items-center gap-1.5 text-xs font-bold text-[#1a9120] hover:text-[#07370a] underline">
                                    Temukan tumpukan sampah liar atau fasilitas rusak di lokasi ini? Lapor ke Pengelola &rarr;
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Galeri Foto (#listing-galeri) -->
                    @if(!empty($destination->gallery_images) && count($destination->gallery_images) > 0)
                        <div id="listing-galeri" class="pt-4 space-y-4">
                            <h2 class="text-xl font-bold text-[#07370a] font-heading pb-2 border-b border-[#e7e7e7]">
                                Dokumentasi &amp; Galeri Lokasi
                            </h2>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                @foreach($destination->gallery_images as $img)
                                    <div class="overflow-hidden rounded-[4px] aspect-[4/3] bg-[#f2f4ec] border border-[#e7e7e7] group">
                                        <img src="{{ $img }}" alt="Galeri {{ $destination->name }}" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Right Column: Jadesta Boxed Widgets Sidebar (4 cols) -->
                <div class="lg:col-span-4 space-y-6">
                    
                    <!-- 1. Jadesta Verified Badge (.verified-badge) -->
                    <div class="jadesta-verified-badge shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span>Terverifikasi &bull; Desa Wisata Cupunagara</span>
                    </div>

                    <!-- 2. Boxed Widget: Lokasi Desa Wisata & OpenStreetMap -->
                    <div class="jadesta-boxed-widget space-y-4">
                        <h3 class="jadesta-boxed-widget__title">Lokasi Wisata</h3>
                        <p class="text-xs text-[#626f62] leading-relaxed">
                            <strong class="text-[#07370a]">Alamat:</strong> Desa Cupunagara, Kecamatan Cisalak, Kabupaten Subang, Jawa Barat
                        </p>
                        <div id="detail-map" class="w-full h-56 rounded-[4px] overflow-hidden border border-[#e7e7e7]"></div>
                        <a href="{{ $destination->google_maps_navigation_url }}" 
                           target="_blank" rel="noopener noreferrer"
                           class="grdeen-btn w-full !py-3 !px-4 !text-xs">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                            <span>Petunjuk Arah (Google Maps)</span>
                        </a>
                    </div>

                    <!-- 3. Boxed Widget: Informasi Kunjungan -->
                    <div class="jadesta-boxed-widget space-y-3">
                        <h3 class="jadesta-boxed-widget__title">Informasi Kunjungan</h3>
                        <div class="space-y-3 text-xs sm:text-sm">
                            <div class="flex items-center justify-between py-2 border-b border-[#e7e7e7]">
                                <span class="text-[#626f62]">Jam Operasional</span>
                                <strong class="text-[#07370a]">{{ $destination->operating_hours }}</strong>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-[#e7e7e7]">
                                <span class="text-[#626f62]">Tiket / Retribusi</span>
                                <strong class="text-[#1a9120]">{{ $destination->price_info }}</strong>
                            </div>
                            <div class="flex items-center justify-between py-2">
                                <span class="text-[#626f62]">Klasifikasi</span>
                                <span class="px-2.5 py-0.5 rounded-[3px] bg-[#1a9120] text-white text-xs font-bold">{{ $destination->category }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Boxed Widget: Contact Person Pengelola -->
                    <div class="jadesta-boxed-widget space-y-4">
                        <div class="flex items-center gap-3 pb-3 border-b border-[#e7e7e7]">
                            <img src="{{ asset('images/logo/logo-digi-green-pin-icon-transparent.png') }}" 
                                 alt="Pokdarwis Cupunagara" 
                                 class="w-11 h-11 object-contain rounded-full bg-white p-1 border border-[#e7e7e7]">
                            <div>
                                <span class="text-[11px] font-bold uppercase tracking-wider text-[#1a9120] block">Contact Person</span>
                                <h4 class="text-base font-bold text-[#07370a] font-heading">{{ $destination->contact_person ?? 'Pokdarwis Desa Cupunagara' }}</h4>
                            </div>
                        </div>
                        <ul class="space-y-2 text-xs text-[#626f62]">
                            <li class="flex items-center gap-2">
                                <span class="font-bold text-[#07370a]">Telepon / WA:</span>
                                <span>+62 857-9899-1234</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="font-bold text-[#07370a]">Email:</span>
                                <span>sekretariat@cupunagara.desa.id</span>
                            </li>
                        </ul>
                        <a href="{{ $destination->whatsapp_inquiry_url }}" 
                           target="_blank" rel="noopener noreferrer"
                           class="grdeen-btn grdeen-btn--dark w-full !py-3 !px-4 !text-xs">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771z"/>
                            </svg>
                            <span>Tanya Info via WhatsApp</span>
                        </a>
                    </div>

                </div>

            </div>

            <!-- Other Destinations in Jadesta Directory Listing Card Style -->
            @if($otherDestinations->count() > 0)
                <div class="mt-20 pt-12 border-t border-[#e7e7e7]">
                    <div class="text-center mb-10">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#1a9120] block">Jelajahi Lebih Banyak</span>
                        <h3 class="text-2xl sm:text-3xl font-bold text-[#07370a] font-heading mt-1">Wisata Lainnya di Sekitar</h3>
                        <div class="w-16 h-1 bg-[#1a9120] mx-auto mt-3"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($otherDestinations as $other)
                            <a href="{{ route('destinations.show', $other->slug) }}" class="jadesta-listing-card group">
                                <span class="jadesta-listing-card__badge">{{ $other->price_info }}</span>
                                <img src="{{ $other->thumbnail }}" alt="{{ $other->name }}" loading="lazy">
                                <div class="jadesta-listing-card__content">
                                    <span class="jadesta-listing-card__tag">{{ $other->category }}</span>
                                    <h4 class="text-xl font-bold text-white font-heading group-hover:text-[#ecf2df] transition">
                                        {{ $other->name }}
                                    </h4>
                                    <span class="text-xs text-white/80 block mt-0.5">Desa Cupunagara, Kabupaten Subang</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (!document.getElementById('detail-map')) return;

        var lat = {{ $destination->latitude }};
        var lng = {{ $destination->longitude }};

        var map = L.map('detail-map').setView([lat, lng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        L.marker([lat, lng]).addTo(map)
            .bindPopup('<b>{{ $destination->name }}</b><br>{{ $destination->category }}')
            .openPopup();
    });
</script>
@endpush
