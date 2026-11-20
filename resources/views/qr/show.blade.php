@extends('layouts.app')

@section('title', 'Plang QR: ' . $qrPoint->location_name . ' | Jejaring Desa Wisata Cupunagara')

@section('content')

    <!-- Jadesta QR Point Banner -->
    <div class="bg-[#07370a] text-white py-12 border-b-4 border-[#1a9120]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between gap-4">
                <div class="space-y-2">
                    <span class="inline-block px-3 py-1 rounded-[3px] bg-[#1a9120] text-white text-xs font-bold uppercase tracking-wider">
                        Plang Informasi Bambu QR Code
                    </span>
                    <h1 class="text-2xl sm:text-4xl font-bold text-white font-heading">
                        {{ $qrPoint->location_name }}
                    </h1>
                    <p class="text-xs sm:text-sm text-[#d6dfd6] leading-relaxed max-w-2xl">
                        {{ $qrPoint->description }}
                    </p>
                </div>
                <img src="{{ asset('images/logo/logo-digi-green-pin-icon-transparent.png') }}" 
                     alt="Digi-Green Pin" 
                     class="hidden sm:block w-16 h-16 object-contain bg-white/95 p-2 rounded-[6px] shrink-0">
            </div>

            <!-- Action Buttons -->
            <div class="pt-6 grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                <a href="{{ route('reports.create', ['qr' => $qrPoint->code]) }}" 
                   class="grdeen-btn !py-3.5 !px-5 w-full">
                    <span>Lapor Sampah di Titik Ini</span>
                </a>
                <a href="{{ $qrPoint->google_maps_navigation_url }}" 
                   target="_blank" rel="noopener noreferrer"
                   class="grdeen-btn !bg-white !text-[#07370a] hover:!text-white !py-3.5 !px-5 w-full">
                    <svg class="w-4 h-4 fill-current text-[#1a9120]" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    <span>Buka Google Maps</span>
                </a>
            </div>
        </div>
    </div>

    <div class="py-12 bg-[#f6f7f2]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Cleaning Guidelines & Gotong Royong Ethos -->
            <div class="bg-white rounded-[6px] p-6 sm:p-8 border border-[#dce6d5] shadow-sm space-y-4">
                <h2 class="text-lg sm:text-xl font-bold text-[#07370a] font-heading pb-2 border-b border-[#e7e7e7]">
                    Aturan Kebersihan &amp; Budaya Gotong Royong di Titik Ini
                </h2>
                <div class="p-4 rounded-[4px] bg-[#edf5ee] border-l-4 border-[#1a9120] text-xs sm:text-sm text-[#07370a] leading-relaxed font-medium">
                    {{ $qrPoint->cleaning_guide }}
                </div>
                <div class="text-xs sm:text-sm text-[#4f5345] space-y-2 pt-1">
                    <p>1. <strong>Bawa Pulang Sampah Pribadi:</strong> Kemasan makanan, botol plastik, dan tisu wajib dibawa kembali atau dibuang ke tempat sampah terpilah terdekat.</p>
                    <p>2. <strong>Jaga Keamanan Lereng:</strong> Dilarang membuang puntung rokok di area rumput kering dan semak perbukitan.</p>
                    <p>3. <strong>Koordinasi Armada Desa:</strong> Apabila Anda menemukan tumpukan sampah liar bervolume besar atau tempat sampah yang sudah penuh, kirim laporan melalui tombol di atas agar tim Karang Taruna dapat mengangkutnya.</p>
                </div>
            </div>

            <!-- Mini Map of this QR Point -->
            @if($qrPoint->latitude && $qrPoint->longitude)
                <div class="bg-white rounded-[6px] p-6 sm:p-8 border border-[#dce6d5] shadow-sm space-y-4">
                    <h3 class="text-lg font-bold text-[#07370a] font-heading">Posisi Titik Plang di Peta Desa</h3>
                    <div id="qr-map" class="w-full h-60 rounded-[4px] overflow-hidden border border-[#e7e7e7]"></div>
                </div>
            @endif

            <!-- Destinations Nearby in Jadesta Listing Card Style -->
            <div class="bg-white rounded-[6px] p-6 sm:p-8 border border-[#dce6d5] shadow-sm space-y-4">
                <h3 class="text-lg font-bold text-[#07370a] font-heading">Wisata di Sekitar Titik Ini</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach($nearbyDestinations as $dest)
                        <a href="{{ route('destinations.show', $dest->slug) }}" class="jadesta-listing-card !h-48 group">
                            <img src="{{ $dest->thumbnail }}" alt="{{ $dest->name }}">
                            <div class="jadesta-listing-card__content !bottom-3 !left-3 !right-3">
                                <span class="jadesta-listing-card__tag !text-[10px] !py-0.5 !px-2">{{ $dest->category }}</span>
                                <h4 class="text-sm font-bold text-white font-heading line-clamp-1">{{ $dest->name }}</h4>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Other QR Points Navigation -->
            <div class="bg-white rounded-[6px] p-6 border border-[#dce6d5] shadow-sm space-y-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[#1a9120]">Titik Plang Bambu QR Lainnya</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($allQrPoints as $otherQr)
                        <a href="{{ route('qr.show', $otherQr->code) }}" class="p-3.5 rounded-[4px] border border-[#dce6d5] bg-[#f2f4ec] hover:bg-[#ecf2df] transition flex items-center justify-between text-xs font-bold text-[#07370a]">
                            <span>{{ $otherQr->location_name }}</span>
                            <span class="text-[#1a9120]">&rarr;</span>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
@if($qrPoint->latitude && $qrPoint->longitude)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (!document.getElementById('qr-map')) return;

        var lat = {{ $qrPoint->latitude }};
        var lng = {{ $qrPoint->longitude }};

        var map = L.map('qr-map').setView([lat, lng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        L.marker([lat, lng]).addTo(map)
            .bindPopup('<b>{{ $qrPoint->location_name }}</b><br>Plang Bambu QR Code')
            .openPopup();
    });
</script>
@endif
@endpush
