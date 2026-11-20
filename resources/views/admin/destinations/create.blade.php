@extends('layouts.admin')

@section('title', 'Tambah Tempat Wisata | Admin Cupunagara')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.destinations.index') }}" class="text-xs font-bold text-[#1a9120] hover:underline flex items-center gap-1 mb-1">
                &larr; Kembali ke Daftar Wisata
            </a>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#07370a] font-heading">Tambah Tempat Wisata Baru</h1>
        </div>
    </div>

    <div class="bg-white rounded-[10px] p-6 sm:p-8 border border-[#dce6d5] shadow-sm">
        <form action="{{ route('admin.destinations.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Nama Wisata <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                           placeholder="Contoh: Kafe Bukit Cupumanik / Bukit Pamoyanan"
                           class="input-jadesta w-full">
                    @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="category" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Kategori Wisata <span class="text-red-500">*</span></label>
                    <input type="text" name="category" id="category" value="{{ old('category') }}" required 
                           placeholder="Contoh: Wisata Alam, Wisata Kuliner & Kafe, Agrowisata Kopi"
                           class="input-jadesta w-full">
                    @error('category') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="excerpt" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Ringkasan Singkat (1-2 Kalimat) <span class="text-red-500">*</span></label>
                <input type="text" name="excerpt" id="excerpt" value="{{ old('excerpt') }}" required 
                       placeholder="Contoh: Spot panorama perbukitan di atas awan dengan pemandangan 360 derajat lanskap hijau..."
                       class="input-jadesta w-full">
                @error('excerpt') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Deskripsi Lengkap & Daya Tarik <span class="text-red-500">*</span></label>
                <textarea name="description" id="description" rows="5" required 
                          placeholder="Ceritakan keunikan pemandangan, pesona alam, daya tarik kopi, dan pengalaman yang bisa didapat wisatawan di lokasi ini..."
                          class="input-jadesta w-full !h-auto !py-3">{{ old('description') }}</textarea>
                @error('description') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="thumbnail" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">URL Foto Utama / Thumbnail <span class="text-red-500">*</span></label>
                <input type="text" name="thumbnail" id="thumbnail" value="{{ old('thumbnail') }}" required 
                       placeholder="https://images.unsplash.com/... atau URL foto ekowisata"
                       class="input-jadesta w-full">
                @error('thumbnail') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Interaktif Pemilihan Titik Koordinat di Maps -->
            <div class="bg-[#f6f7f2] p-5 rounded-[8px] border border-[#dce6d5] space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-[#07370a] block flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[#1a9120]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Penentuan Titik Koordinat Peta (Leaflet OpenStreetMap)
                        </span>
                        <p class="text-xs text-[#626f62] mt-0.5">
                            Anda bisa mengetik angka koordinat di bawah ATAU langsung klik &amp; geser pin marker pada peta.
                        </p>
                    </div>
                    <button type="button" id="btn-reset-cupunagara" class="px-3 py-1.5 bg-white border border-[#dce6d5] hover:border-[#1a9120] text-[#07370a] rounded-[6px] text-xs font-bold transition self-start sm:self-auto">
                        Pusatkan ke Cupunagara
                    </button>
                </div>

                <!-- Peta Interaktif -->
                <div id="coord-picker-map" class="w-full h-72 sm:h-80 rounded-[6px] overflow-hidden border border-[#dce6d5] shadow-inner z-10"></div>

                <!-- Input Angka Koordinat -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="latitude" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-1">
                            Latitude (Garis Lintang) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" step="any" name="latitude" id="latitude" 
                               value="{{ old('latitude', '-6.7584100') }}" required 
                               class="input-jadesta w-full font-mono text-sm">
                        @error('latitude') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="longitude" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-1">
                            Longitude (Garis Bujur) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" step="any" name="longitude" id="longitude" 
                               value="{{ old('longitude', '107.6893200') }}" required 
                               class="input-jadesta w-full font-mono text-sm">
                        @error('longitude') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div>
                <label for="google_maps_url" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Link Rute Google Maps (Opsional)</label>
                <input type="url" name="google_maps_url" id="google_maps_url" value="{{ old('google_maps_url') }}" 
                       placeholder="Biarkan kosong untuk dibuatkan otomatis dari koordinat di atas"
                       class="input-jadesta w-full">
            </div>

            <div>
                <label for="facilities_input" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Daftar Fasilitas (Pisahkan dengan koma)</label>
                <input type="text" name="facilities_input" id="facilities_input" value="{{ old('facilities_input', 'Area Parkir, Mushola, Toilet, Kedai Kopi') }}" 
                       placeholder="Area Parkir, Mushola, Toilet, Gazebo, Wi-Fi"
                       class="input-jadesta w-full">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="operating_hours" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Jam Operasional</label>
                    <input type="text" name="operating_hours" id="operating_hours" value="{{ old('operating_hours', '07.00 - 18.00 WIB') }}" 
                           class="input-jadesta w-full">
                </div>

                <div>
                    <label for="price_info" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Info Biaya / Tiket / Retribusi</label>
                    <input type="text" name="price_info" id="price_info" value="{{ old('price_info', 'Gratis / Retribusi Kebersihan Rp 5.000') }}" 
                           class="input-jadesta w-full">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="contact_person" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Nama Pengelola / PIC</label>
                    <input type="text" name="contact_person" id="contact_person" value="{{ old('contact_person', 'Pokdarwis Desa Cupunagara') }}" 
                           class="input-jadesta w-full">
                </div>

                <div>
                    <label for="whatsapp_number" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Nomor WhatsApp Info</label>
                    <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number', '6285798991234') }}" 
                           class="input-jadesta w-full">
                </div>
            </div>

            <div>
                <label for="cleanliness_tips" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Panduan Kebersihan Khusus (Digi-Green)</label>
                <textarea name="cleanliness_tips" id="cleanliness_tips" rows="3" 
                          placeholder="Imbauan khusus bagi wisatawan di titik ini (contoh: Dilarang buang sampah ke lereng bukit...)"
                          class="input-jadesta w-full !h-auto !py-3">{{ old('cleanliness_tips') }}</textarea>
            </div>

            <div class="p-4 bg-[#f6f7f2] rounded-[8px] border border-[#dce6d5] flex items-center gap-3">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} 
                       class="w-4 h-4 rounded text-[#1a9120] focus:ring-[#1a9120] border-[#d4dcd4]">
                <label for="is_featured" class="cursor-pointer text-xs font-bold text-[#07370a]">
                    Tampilkan sebagai Wisata Pilihan Unggulan di Beranda
                </label>
            </div>

            <div class="pt-4 border-t border-[#e7e7e7] flex items-center justify-end gap-3">
                <a href="{{ route('admin.destinations.index') }}" class="px-5 py-2.5 rounded-[6px] text-xs font-bold text-[#626f62] hover:bg-[#f6f7f2] transition">
                    Batal
                </a>
                <button type="submit" class="grdeen-btn">
                    <span>Simpan Tempat Wisata</span>
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var latInput = document.getElementById('latitude');
        var lngInput = document.getElementById('longitude');
        var resetBtn = document.getElementById('btn-reset-cupunagara');

        var defaultLat = parseFloat(latInput.value) || -6.7584100;
        var defaultLng = parseFloat(lngInput.value) || 107.6893200;

        var map = L.map('coord-picker-map').setView([defaultLat, defaultLng], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker = L.marker([defaultLat, defaultLng], {
            draggable: true
        }).addTo(map);

        marker.bindPopup("<b>Titik Lokasi Wisata</b><br>Geser pin atau klik di peta.").openPopup();

        // Update inputs on marker drag
        marker.on('dragend', function(e) {
            var position = marker.getLatLng();
            latInput.value = position.lat.toFixed(7);
            lngInput.value = position.lng.toFixed(7);
        });

        // Update marker and inputs on map click
        map.on('click', function(e) {
            var lat = e.latlng.lat.toFixed(7);
            var lng = e.latlng.lng.toFixed(7);
            latInput.value = lat;
            lngInput.value = lng;
            marker.setLatLng(e.latlng);
            marker.openPopup();
        });

        // Update map marker when typing into inputs
        function syncMapFromInputs() {
            var lat = parseFloat(latInput.value);
            var lng = parseFloat(lngInput.value);
            if (!isNaN(lat) && !isNaN(lng)) {
                var newLatLng = new L.LatLng(lat, lng);
                marker.setLatLng(newLatLng);
                map.panTo(newLatLng);
            }
        }

        latInput.addEventListener('input', syncMapFromInputs);
        lngInput.addEventListener('input', syncMapFromInputs);

        // Reset button to Cupunagara center
        resetBtn.addEventListener('click', function() {
            var cLat = -6.7584100;
            var cLng = 107.6893200;
            latInput.value = cLat.toFixed(7);
            lngInput.value = cLng.toFixed(7);
            marker.setLatLng([cLat, cLng]);
            map.setView([cLat, cLng], 15);
            marker.openPopup();
        });
    });
</script>
@endpush
