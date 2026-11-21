@extends('layouts.admin')

@section('title', 'Tulis Berita Baru | Admin Cupunagara')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.articles.index') }}" class="text-xs font-bold text-[#1a9120] hover:underline flex items-center gap-1 mb-1">
                &larr; Kembali ke Daftar Berita
            </a>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#07370a] font-heading">Tulis Berita &amp; Artikel Baru</h1>
            <p class="text-xs text-[#626f62] mt-0.5">Publikasikan informasi kegiatan desa, edukasi kebersihan, atau potensi ekowisata Cupunagara.</p>
        </div>
    </div>

    <div class="bg-white rounded-[10px] p-6 sm:p-8 border border-[#dce6d5] shadow-sm">
        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Judul Berita -->
            <div>
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">
                    Judul Berita / Artikel <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required 
                       placeholder="Contoh: Sinergi Digi-Green: Gerakan Kampung Bebas Sampah di Desa Cupunagara"
                       class="input-jadesta w-full text-sm font-semibold">
                @error('title') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Kategori & Penulis -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="category" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">
                        Kategori Berita <span class="text-red-500">*</span>
                    </label>
                    <input list="category-options" name="category" id="category" value="{{ old('category', 'Kegiatan Desa') }}" required 
                           placeholder="Pilih atau ketik kategori..."
                           class="input-jadesta w-full">
                    <datalist id="category-options">
                        <option value="Kegiatan Desa">
                        <option value="Aksi Lingkungan & Bela Negara">
                        <option value="Potensi Desa & UMKM">
                        <option value="Ekowisata & Alam">
                        <option value="Inovasi Digital">
                        <option value="Seni & Budaya Lokal">
                    </datalist>
                    @error('category') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="author" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">
                        Penulis / Kontributor <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="author" id="author" value="{{ old('author', 'Tim Digi-Green & Karang Taruna') }}" required 
                           placeholder="Contoh: Tim NalarWarga & Karang Taruna"
                           class="input-jadesta w-full">
                    @error('author') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Foto Thumbnail / Gambar Utama -->
            <div class="space-y-3 p-4 bg-[#f6f7f2] rounded-[8px] border border-[#dce6d5]">
                <label class="block text-xs font-bold uppercase tracking-wider text-[#07370a]">
                    Foto Utama / Thumbnail Artikel
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <span class="text-[11px] font-bold text-[#626f62] block mb-1">Opsi 1: Upload File Gambar</span>
                        <input type="file" name="thumbnail_file" id="thumbnail_file" accept="image/*"
                               class="text-xs text-[#626f62] file:mr-3 file:py-2 file:px-3 file:rounded-[4px] file:border-0 file:text-xs file:font-bold file:bg-[#1a9120] file:text-white hover:file:bg-[#07370a] file:cursor-pointer">
                        <p class="text-[10px] text-[#626f62] mt-1">Format: JPG, PNG, WebP (Maks. 3MB)</p>
                        @error('thumbnail_file') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <span class="text-[11px] font-bold text-[#626f62] block mb-1">Opsi 2: URL Gambar (Unsplash / Eksternal)</span>
                        <input type="url" name="thumbnail" id="thumbnail" value="{{ old('thumbnail') }}"
                               placeholder="https://images.unsplash.com/photo-..."
                               class="input-jadesta w-full text-xs">
                        <p class="text-[10px] text-[#626f62] mt-1">Kosongkan jika mengupload file gambar di sebelah kiri.</p>
                        @error('thumbnail') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Ringkasan / Cuplikan Singkat -->
            <div>
                <label for="excerpt" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">
                    Ringkasan / Cuplikan Berita (Excerpt) <span class="text-red-500">*</span>
                </label>
                <textarea name="excerpt" id="excerpt" rows="2" required 
                          placeholder="Tulis ringkasan singkat artikel dalam 1-2 kalimat untuk kartu pratinjau berita..."
                          class="input-jadesta w-full text-xs">{{ old('excerpt') }}</textarea>
                <p class="text-[10px] text-[#626f62] mt-1">Maksimal 500 karakter. Ditampilkan pada halaman depan dan beranda.</p>
                @error('excerpt') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Isi Berita Lengkap -->
            <div>
                <label for="content" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">
                    Isi Berita Lengkap <span class="text-red-500">*</span>
                </label>
                <textarea name="content" id="content" rows="12" required 
                          placeholder="Tulis narasi berita lengkap di sini. Anda dapat memisahkan paragraf dengan baris baru (enter)..."
                          class="input-jadesta w-full text-xs leading-relaxed font-sans">{{ old('content') }}</textarea>
                @error('content') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Pengaturan Status & Tanggal Publikasi -->
            <div class="p-4 bg-[#eff6f0] rounded-[8px] border border-[#dce6d5] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_published" id="is_published" value="1" 
                           {{ old('is_published', '1') ? 'checked' : '' }}
                           class="w-4 h-4 text-[#1a9120] border-[#dce6d5] rounded focus:ring-[#1a9120] cursor-pointer">
                    <label for="is_published" class="text-xs font-bold text-[#07370a] cursor-pointer">
                        Terbitkan Berita Sekarang
                        <span class="block text-[11px] font-normal text-[#626f62]">Jika tidak dicentang, berita akan disimpan sebagai draf.</span>
                    </label>
                </div>

                <div class="w-full sm:w-auto">
                    <label for="published_at" class="block text-[11px] font-bold text-[#07370a] mb-1">
                        Tanggal Publikasi (Opsional)
                    </label>
                    <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}"
                           class="input-jadesta text-xs">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#e7e7e7]">
                <a href="{{ route('admin.articles.index') }}" class="px-5 py-2.5 rounded-[6px] border border-[#dce6d5] text-xs font-bold text-[#626f62] hover:bg-[#f6f7f2] transition">
                    Batal
                </a>
                <button type="submit" class="grdeen-btn !py-2.5 !px-6 text-xs">
                    <span>Simpan &amp; Terbitkan Berita</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
