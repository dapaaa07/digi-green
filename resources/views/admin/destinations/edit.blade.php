@extends('layouts.admin')

@section('title', 'Edit Tempat Wisata ' . $destination->name . ' | Admin Cupunagara')

@section('content')
<div class="max-w-3xl space-y-6">
    <div>
        <a href="{{ route('admin.destinations.index') }}" class="text-xs text-slate-500 hover:text-slate-800 transition block mb-1">
            &larr; Kembali ke Kelola Wisata
        </a>
        <h1 class="text-2xl font-extrabold text-slate-900 font-heading">Edit: {{ $destination->name }}</h1>
    </div>

    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
        <form action="{{ route('admin.destinations.update', $destination) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Nama Wisata <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $destination->name) }}" required 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600">
                </div>

                <div>
                    <label for="category" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Kategori <span class="text-rose-500">*</span></label>
                    <input type="text" name="category" id="category" value="{{ old('category', $destination->category) }}" required 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600">
                </div>
            </div>

            <div>
                <label for="excerpt" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Ringkasan Singkat (1-2 Kalimat) <span class="text-rose-500">*</span></label>
                <input type="text" name="excerpt" id="excerpt" value="{{ old('excerpt', $destination->excerpt) }}" required 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600">
            </div>

            <div>
                <label for="description" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Deskripsi Lengkap & Daya Tarik <span class="text-rose-500">*</span></label>
                <textarea name="description" id="description" rows="5" required 
                          class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600">{{ old('description', $destination->description) }}</textarea>
            </div>

            <div>
                <label for="thumbnail" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">URL Foto Utama / Thumbnail <span class="text-rose-500">*</span></label>
                <input type="text" name="thumbnail" id="thumbnail" value="{{ old('thumbnail', $destination->thumbnail) }}" required 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600">
            </div>

            <!-- Koordinat & Google Maps -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="latitude" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Latitude (Lintang) <span class="text-rose-500">*</span></label>
                    <input type="number" step="any" name="latitude" id="latitude" value="{{ old('latitude', $destination->latitude) }}" required 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm font-mono text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600">
                </div>

                <div>
                    <label for="longitude" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Longitude (Bujur) <span class="text-rose-500">*</span></label>
                    <input type="number" step="any" name="longitude" id="longitude" value="{{ old('longitude', $destination->longitude) }}" required 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm font-mono text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600">
                </div>
            </div>

            <div>
                <label for="google_maps_url" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Link Rute Google Maps (Opsional)</label>
                <input type="url" name="google_maps_url" id="google_maps_url" value="{{ old('google_maps_url', $destination->google_maps_url) }}" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600">
            </div>

            <div>
                <label for="facilities_input" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Daftar Fasilitas (Pisahkan dengan koma)</label>
                @php
                    $facString = is_array($destination->facilities) ? implode(', ', $destination->facilities) : '';
                @endphp
                <input type="text" name="facilities_input" id="facilities_input" value="{{ old('facilities_input', $facString) }}" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="operating_hours" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Jam Operasional</label>
                    <input type="text" name="operating_hours" id="operating_hours" value="{{ old('operating_hours', $destination->operating_hours) }}" 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600">
                </div>

                <div>
                    <label for="price_info" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Info Biaya / Retribusi</label>
                    <input type="text" name="price_info" id="price_info" value="{{ old('price_info', $destination->price_info) }}" 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="contact_person" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Nama Pengelola / PIC</label>
                    <input type="text" name="contact_person" id="contact_person" value="{{ old('contact_person', $destination->contact_person) }}" 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600">
                </div>

                <div>
                    <label for="whatsapp_number" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Nomor WhatsApp Info</label>
                    <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number', $destination->whatsapp_number) }}" 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600">
                </div>
            </div>

            <div>
                <label for="cleanliness_tips" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Panduan Kebersihan Khusus (Digi-Green)</label>
                <textarea name="cleanliness_tips" id="cleanliness_tips" rows="3" 
                          class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600">{{ old('cleanliness_tips', $destination->cleanliness_tips) }}</textarea>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <label class="flex items-center gap-2 cursor-pointer text-xs font-semibold text-slate-700">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $destination->is_featured) ? 'checked' : '' }} class="rounded text-emerald-600 focus:ring-emerald-500">
                    <span>Tampilkan sebagai Destinasi Pilihan di Beranda</span>
                </label>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.destinations.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold transition shadow-sm">
                    Perbarui Tempat Wisata
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
