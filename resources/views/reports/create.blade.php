@extends('layouts.app')

@section('title', 'Lapor Fasilitas & Kebersihan Kawasan | Jejaring Desa Wisata Cupunagara')

@section('content')

    <!-- Jadesta Page Banner -->
    <div class="bg-[#07370a] text-white py-12 border-b-4 border-[#1a9120]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex text-xs text-[#ecf2df]/80 gap-1.5 mb-3">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <span>/</span>
                <a href="{{ route('reports.index') }}" class="hover:text-white">Aksi Kebersihan</a>
                <span>/</span>
                <span class="text-white font-semibold">Kirim Laporan</span>
            </nav>
            <div class="sec-title__tagline-wrap">
                <span class="text-[#1f9a26]">
                    <svg viewBox="0 0 12 10" fill="currentColor" class="w-3.5 h-3">
                        <path d="M5.8 1.6 C7 2.4 8 4 8 5 C8 6 7 7.6 5.8 8.4 L3.6 10 L6.3 10 C8 10 9.5 9.1 10.6 7.5 C12.1 5.2 12.1 4.8 10.6 2.5 C9.5 0.9 8 0 6.3 0 L3.6 0 L5.8 1.6 Z" />
                    </svg>
                </span>
                <span class="text-xs font-bold uppercase tracking-wider text-[#1f9a26]">Koordinasi Kebersihan Kawasan</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold text-white font-heading mt-1">
                Lapor Sampah Liar &amp; Fasilitas Publik
            </h1>
            <p class="text-sm text-[#d6dfd6] mt-2 leading-relaxed">
                Sistem koordinasi penanganan tumpukan sampah liar dan perawatan fasilitas kawasan ekowisata Desa Cupunagara bersama Karang Taruna dan warga desa.
            </p>
        </div>
    </div>

    <div class="py-14 bg-[#f6f7f2]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Gotong Royong Ethos Callout Box -->
            <div class="bg-[#edf5ee] border-l-4 border-[#1a9120] rounded-[6px] p-6 shadow-sm space-y-3">
                <div class="flex items-center gap-2.5">
                    <span class="px-2.5 py-0.5 rounded-[3px] bg-[#1a9120] text-white text-[11px] font-bold uppercase">
                        Etika Wisata
                    </span>
                    <h2 class="text-base sm:text-lg font-bold text-[#07370a] font-heading">
                        Budaya Gotong Royong: Bawa Pulang Sampah Kecil Pribadimu
                    </h2>
                </div>
                <p class="text-xs sm:text-sm leading-relaxed text-[#4f5345]">
                    Formulir ini <strong>bukan layanan pembersih panggilan untuk sampah kecil pribadi</strong> (seperti botol minum, bungkus cemilan, atau tisu). Setiap wisatawan dan warga diharapkan membuang sampah pribadi ke tempat sampah terdekat atau membawanya kembali (<em>Leave No Trace</em>).
                </p>
                <div class="pt-2 border-t border-[#1a9120]/20 text-xs text-[#07370a] space-y-1">
                    <p class="font-bold">Gunakan tiket laporan ini untuk eskalasi masalah yang membutuhkan armada atau peralatan desa:</p>
                    <ul class="list-disc pl-5 space-y-0.5 text-[#4f5345]">
                        <li>Tumpukan sampah liar bervolume besar di lereng tebing, semak, atau aliran air.</li>
                        <li>Tempat sampah umum yang sudah penuh (overkapasitas) atau plang informasi yang rusak.</li>
                        <li>Penjemputan karung sampah yang sudah dikumpulkan warga/komunitas saat kerja bakti.</li>
                    </ul>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-[6px] p-6 sm:p-10 border border-[#e7e7e7] shadow-sm">
                <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Kategori Laporan -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2.5">
                            Kategori Laporan <span class="text-red-600">*</span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <label class="p-3.5 rounded-[4px] border border-[#d4dcd4] bg-white cursor-pointer flex items-center gap-3 hover:bg-[#f6f7f2] transition has-[:checked]:border-[#1a9120] has-[:checked]:bg-[#edf5ee]">
                                <input type="radio" name="report_category" value="sampah_menumpuk" class="text-[#1a9120] focus:ring-[#1a9120]" checked>
                                <span class="text-xs font-bold text-[#07370a]">Tumpukan Sampah Liar (Volume Besar)</span>
                            </label>
                            <label class="p-3.5 rounded-[4px] border border-[#d4dcd4] bg-white cursor-pointer flex items-center gap-3 hover:bg-[#f6f7f2] transition has-[:checked]:border-[#1a9120] has-[:checked]:bg-[#edf5ee]">
                                <input type="radio" name="report_category" value="fasilitas_rusak" class="text-[#1a9120] focus:ring-[#1a9120]">
                                <span class="text-xs font-bold text-[#07370a]">Tempat Sampah Penuh / Fasilitas Rusak</span>
                            </label>
                            <label class="p-3.5 rounded-[4px] border border-[#d4dcd4] bg-white cursor-pointer flex items-center gap-3 hover:bg-[#f6f7f2] transition has-[:checked]:border-[#1a9120] has-[:checked]:bg-[#edf5ee]">
                                <input type="radio" name="report_category" value="titik_rawan" class="text-[#1a9120] focus:ring-[#1a9120]">
                                <span class="text-xs font-bold text-[#07370a]">Titik Rawan Pembuangan Sampah Liar</span>
                            </label>
                            <label class="p-3.5 rounded-[4px] border border-[#d4dcd4] bg-white cursor-pointer flex items-center gap-3 hover:bg-[#f6f7f2] transition has-[:checked]:border-[#1a9120] has-[:checked]:bg-[#edf5ee]">
                                <input type="radio" name="report_category" value="saran_kebersihan" class="text-[#1a9120] focus:ring-[#1a9120]">
                                <span class="text-xs font-bold text-[#07370a]">Penjemputan Karung Sampah Gotong Royong</span>
                            </label>
                        </div>
                        @error('report_category')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Titik Terdekat (Opsional: Plang QR / Destinasi) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="destination_id" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">
                                Area Atraksi Wisata (Opsional)
                            </label>
                            <select name="destination_id" id="destination_id" class="input-jadesta w-full">
                                <option value="">-- Pilih Jika di Area Atraksi Wisata --</option>
                                @foreach($destinations as $dest)
                                    <option value="{{ $dest->id }}" {{ (old('destination_id') == $dest->id || (isset($selectedDestination) && $selectedDestination->id == $dest->id)) ? 'selected' : '' }}>
                                        {{ $dest->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="qr_point_id" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">
                                Titik Plang Bambu QR (Opsional)
                            </label>
                            <select name="qr_point_id" id="qr_point_id" class="input-jadesta w-full">
                                <option value="">-- Pilih Jika Dekat Plang QR --</option>
                                @foreach($qrPoints as $qr)
                                    <option value="{{ $qr->id }}" {{ (old('qr_point_id') == $qr->id || (isset($selectedQr) && $selectedQr->id == $qr->id)) ? 'selected' : '' }}>
                                        {{ $qr->location_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Lokasi Spesifik / Patokan -->
                    <div>
                        <label for="specific_location" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">
                            Lokasi Spesifik / Patokan Titik <span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="specific_location" id="specific_location" value="{{ old('specific_location') }}" required 
                               placeholder="Contoh: Lereng tebing 50m sebelum gazebo Bukit Pamoyanan, dekat parit warung kopi"
                               class="input-jadesta w-full">
                        @error('specific_location')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Foto Bukti -->
                    <div>
                        <label for="image_evidence" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">
                            Unggah Foto Kondisi di Lokasi
                        </label>
                        <input type="file" name="image_evidence" id="image_evidence" accept="image/*" 
                               class="w-full text-xs text-[#4f5345] file:mr-4 file:py-2.5 file:px-4 file:rounded-[4px] file:border-0 file:text-xs file:font-bold file:bg-[#1a9120] file:text-white hover:file:bg-[#07370a] cursor-pointer border border-[#d4dcd4] rounded-[4px] p-1.5 bg-[#f6f7f2]">
                        <p class="text-[11px] text-[#626f62] mt-1">Maksimal 5MB (Format: JPG, PNG, WEBP). Foto membantu tim desa menyiapkan alat dan armada angkut yang sesuai.</p>
                        @error('image_evidence')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi Laporan -->
                    <div>
                        <label for="description" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">
                            Keterangan Kondisi Sampah / Fasilitas <span class="text-red-600">*</span>
                        </label>
                        <textarea name="description" id="description" rows="4" required 
                                  placeholder="Jelaskan perkiraan volume sampah atau kondisi kerusakan tempat sampah/fasilitas umum..."
                                  class="w-full p-3.5 rounded-[4px] bg-white border border-[#d4dcd4] text-sm text-[#07370a] focus:outline-none focus:border-[#1a9120] focus:ring-2 focus:ring-[#1a9120]/20 transition">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gotong Royong Commitment Checkbox -->
                    <div class="p-4 rounded-[4px] bg-[#f2f4ec] border border-[#dce6d5]">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" name="gotong_royong_agreement" value="1" checked class="mt-0.5 rounded text-[#1a9120] focus:ring-[#1a9120]">
                            <span class="text-xs text-[#07370a] leading-relaxed">
                                <strong>Komitmen Gotong Royong:</strong> Saya mengonfirmasi bahwa laporan ini adalah tumpukan sampah besar atau fasilitas publik yang memerlukan penanganan armada desa, dan saya ikut menjaga kebersihan dengan membuang sampah kecil pribadi pada tempatnya.
                            </span>
                        </label>
                    </div>

                    <!-- Identitas Pelapor (Opsional) -->
                    <div class="pt-4 border-t border-[#e7e7e7] grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="reporter_name" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">
                                Nama Pelapor (Opsional)
                            </label>
                            <input type="text" name="reporter_name" id="reporter_name" value="{{ old('reporter_name') }}" 
                                   placeholder="Boleh dikosongkan (Anonim)"
                                   class="input-jadesta w-full">
                        </div>

                        <div>
                            <label for="reporter_phone" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">
                                Nomor WhatsApp (Opsional)
                            </label>
                            <input type="text" name="reporter_phone" id="reporter_phone" value="{{ old('reporter_phone') }}" 
                                   placeholder="Contoh: 08123456789"
                                   class="input-jadesta w-full">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-3 space-y-2">
                        <button type="submit" class="grdeen-btn w-full !py-4 !text-sm">
                            <span>Kirim Laporan Kebersihan Sekarang</span>
                        </button>
                        <p class="text-center text-xs text-[#626f62]">
                            Setelah dikirim, sistem akan menerbitkan Kode Tiket unik untuk memantau progres tindak lanjut.
                        </p>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
