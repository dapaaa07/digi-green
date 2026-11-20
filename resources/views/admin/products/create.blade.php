@extends('layouts.admin')

@section('title', 'Tambah Produk Kopi | Admin Cupunagara')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.products.index') }}" class="text-xs font-bold text-[#1a9120] hover:underline flex items-center gap-1 mb-1">
                &larr; Kembali ke Daftar Produk
            </a>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#07370a] font-heading">Tambah Produk Kopi Baru</h1>
        </div>
    </div>

    <div class="bg-white rounded-[10px] p-6 sm:p-8 border border-[#dce6d5] shadow-sm">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                           placeholder="Contoh: Kopi Arabika Canggah Cupunagara (Full Wash)"
                           class="input-jadesta w-full">
                    @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="packaging_size" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Ukuran Kemasan <span class="text-red-500">*</span></label>
                    <input type="text" name="packaging_size" id="packaging_size" value="{{ old('packaging_size', '200 gram (Biji / Bubuk)') }}" required 
                           placeholder="Contoh: 200 gram (Biji / Bubuk) atau 250gr"
                           class="input-jadesta w-full">
                    @error('packaging_size') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="process_type" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Metode Proses <span class="text-red-500">*</span></label>
                    <input type="text" name="process_type" id="process_type" value="{{ old('process_type', 'Full Wash Process') }}" required 
                           placeholder="Contoh: Full Wash, Honey, Natural, Wine"
                           class="input-jadesta w-full">
                    @error('process_type') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="roast_level" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Tingkat Sangrai (Roast) <span class="text-red-500">*</span></label>
                    <input type="text" name="roast_level" id="roast_level" value="{{ old('roast_level', 'Medium Roast') }}" required 
                           placeholder="Contoh: Light, Medium, Dark"
                           class="input-jadesta w-full">
                    @error('roast_level') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="price" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Harga (Rupiah) <span class="text-red-500">*</span></label>
                    <input type="number" step="500" name="price" id="price" value="{{ old('price', '65000') }}" required 
                           placeholder="65000"
                           class="input-jadesta w-full font-mono text-sm">
                    @error('price') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="flavor_notes" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Profil Rasa (Flavor Notes)</label>
                <input type="text" name="flavor_notes" id="flavor_notes" value="{{ old('flavor_notes', 'Brown Sugar, Citrus Fresh, Jasmine Aroma, Sweet Aftertaste') }}" 
                       placeholder="Contoh: Floral, Honeycomb, Ripe Apple, Smooth Body"
                       class="input-jadesta w-full">
                @error('flavor_notes') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Deskripsi Produk &amp; Cerita Petani</label>
                <textarea name="description" id="description" rows="4" 
                          placeholder="Ceritakan keistimewaan biji kopi lereng Gunung Canggah, proses petik merah, dan cita rasanya..."
                          class="input-jadesta w-full !h-auto !py-3">{{ old('description') }}</textarea>
                @error('description') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="producer_name" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Nama Produsen / Kelompok Tani <span class="text-red-500">*</span></label>
                    <input type="text" name="producer_name" id="producer_name" value="{{ old('producer_name', 'Kelompok Tani Kopi Canggah Cupunagara') }}" required 
                           class="input-jadesta w-full">
                    @error('producer_name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="contact_whatsapp" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Nomor WhatsApp Pemesanan <span class="text-red-500">*</span></label>
                    <input type="text" name="contact_whatsapp" id="contact_whatsapp" value="{{ old('contact_whatsapp', '6285798991234') }}" required 
                           placeholder="6285798991234"
                           class="input-jadesta w-full">
                    @error('contact_whatsapp') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Foto Produk -->
            <div class="p-4 bg-[#f6f7f2] rounded-[8px] border border-[#dce6d5] space-y-4">
                <span class="text-xs font-bold uppercase tracking-wider text-[#07370a] block">
                    Foto Produk Kopi
                </span>
                
                <div>
                    <label for="image" class="block text-xs font-semibold text-[#07370a] mb-1">Pilihan 1: URL Foto (Unsplash / Cloud Storage)</label>
                    <input type="text" name="image" id="image" value="{{ old('image', 'https://images.unsplash.com/photo-1587734195503-904fca47e0e9?auto=format&fit=crop&w=800&q=80') }}" 
                           placeholder="https://images.unsplash.com/photo-..."
                           class="input-jadesta w-full">
                </div>

                <div>
                    <label for="image_file" class="block text-xs font-semibold text-[#07370a] mb-1">Pilihan 2: Unggah File Foto dari Komputer</label>
                    <input type="file" name="image_file" id="image_file" accept="image/*" 
                           class="block w-full text-xs text-[#626f62] file:mr-4 file:py-2 file:px-4 file:rounded-[4px] file:border-0 file:text-xs file:font-bold file:bg-[#1a9120] file:text-white hover:file:bg-[#07370a] file:cursor-pointer">
                    <p class="text-[11px] text-[#626f62] mt-1">Format: JPG, PNG, WEBP. Maksimal 3MB.</p>
                </div>
            </div>

            <!-- Checkbox Ketersediaan & Unggulan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="p-4 bg-[#f6f7f2] rounded-[8px] border border-[#dce6d5] flex items-center gap-3">
                    <input type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available', '1') ? 'checked' : '' }} 
                           class="w-4 h-4 rounded text-[#1a9120] focus:ring-[#1a9120] border-[#d4dcd4]">
                    <label for="is_available" class="cursor-pointer text-xs font-bold text-[#07370a]">
                        Stok Tersedia untuk Dipesan
                    </label>
                </div>

                <div class="p-4 bg-[#f6f7f2] rounded-[8px] border border-[#dce6d5] flex items-center gap-3">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} 
                           class="w-4 h-4 rounded text-[#1a9120] focus:ring-[#1a9120] border-[#d4dcd4]">
                    <label for="is_featured" class="cursor-pointer text-xs font-bold text-[#07370a]">
                        Tampilkan sebagai Produk Pilihan di Beranda
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-[#e7e7e7] flex items-center justify-end gap-3">
                <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 rounded-[6px] text-xs font-bold text-[#626f62] hover:bg-[#f6f7f2] transition">
                    Batal
                </a>
                <button type="submit" class="grdeen-btn">
                    <span>Simpan Produk Kopi</span>
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
