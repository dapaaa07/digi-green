@extends('layouts.admin')

@section('title', 'Tindak Lanjut Laporan ' . $report->ticket_code . ' | Admin Cupunagara')

@section('content')
<div class="space-y-6 max-w-4xl">
    
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.reports.index') }}" class="text-xs font-bold text-[#1a9120] hover:underline flex items-center gap-1 mb-1">
                &larr; Kembali ke Daftar Laporan
            </a>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#07370a] font-heading">
                Detail Laporan #{{ $report->ticket_code }}
            </h1>
        </div>

        <form action="{{ route('admin.reports.destroy', $report) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-3.5 py-2 rounded-[6px] text-xs font-bold text-red-700 bg-red-50 hover:bg-red-100 border border-red-200 transition">
                Hapus Laporan
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left: Report Information -->
        <div class="lg:col-span-7 space-y-6">
            <div class="bg-white rounded-[10px] p-6 sm:p-8 border border-[#dce6d5] shadow-sm space-y-5">
                
                <div class="flex items-center justify-between pb-4 border-b border-[#e7e7e7]">
                    <span class="text-xs text-[#626f62] font-bold uppercase tracking-wider">Status Saat Ini</span>
                    @if($report->status === 'resolved')
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-[#ecf2df] text-[#1a9120] border border-[#dce6d5]">
                            Selesai Bersih
                        </span>
                    @elseif($report->status === 'in_progress')
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                            Sedang Ditangani
                        </span>
                    @elseif($report->status === 'pending')
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                            Menunggu Penanganan
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-600 border border-red-200">
                            Ditolak / Tidak Valid
                        </span>
                    @endif
                </div>

                <div class="space-y-3.5 text-xs sm:text-sm">
                    <div>
                        <span class="text-[#626f62] block text-[11px] font-bold uppercase tracking-wider">Kategori Aduan</span>
                        <strong class="text-[#07370a] capitalize text-sm">{{ str_replace('_', ' ', $report->report_category) }}</strong>
                    </div>

                    <div>
                        <span class="text-[#626f62] block text-[11px] font-bold uppercase tracking-wider">Waktu Laporan Masuk</span>
                        <strong class="text-[#07370a]">{{ $report->created_at->translatedFormat('d F Y, H:i') }} WIB</strong>
                    </div>

                    <div>
                        <span class="text-[#626f62] block text-[11px] font-bold uppercase tracking-wider">Pelapor</span>
                        <strong class="text-[#07370a]">{{ $report->reporter_name }}</strong>
                        @if($report->reporter_phone)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $report->reporter_phone) }}" target="_blank" class="text-[#1a9120] font-bold ml-2 underline text-xs">
                                Hubungi WA ({{ $report->reporter_phone }})
                            </a>
                        @endif
                    </div>

                    <div>
                        <span class="text-[#626f62] block text-[11px] font-bold uppercase tracking-wider">Lokasi Spesifik / Patokan Titik</span>
                        <strong class="text-[#07370a]">{{ $report->specific_location }}</strong>
                    </div>

                    @if($report->destination)
                        <div>
                            <span class="text-[#626f62] block text-[11px] font-bold uppercase tracking-wider">Kawasan Wisata Terkait</span>
                            <strong class="text-[#1a9120]">{{ $report->destination->name }}</strong>
                        </div>
                    @endif
                </div>

                <div class="p-4 rounded-[6px] bg-[#f6f7f2] border border-[#dce6d5] text-xs sm:text-sm text-[#4f5345] space-y-1">
                    <span class="font-bold text-[#07370a] block text-xs">Keterangan dari Pelapor:</span>
                    <p class="leading-relaxed">{{ $report->description }}</p>
                </div>

                <!-- Foto Bukti Sebelum -->
                <div class="space-y-2 pt-2">
                    <span class="text-xs font-bold text-[#07370a] block uppercase tracking-wider">Foto Bukti dari Pelapor:</span>
                    @if($report->image_evidence)
                        <div class="aspect-[16/10] rounded-[6px] overflow-hidden bg-slate-100 border border-[#dce6d5]">
                            <img src="{{ str_starts_with($report->image_evidence, 'http') ? $report->image_evidence : asset('storage/' . $report->image_evidence) }}" 
                                 alt="Bukti Laporan" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="p-6 rounded-[6px] bg-[#f6f7f2] border border-dashed border-[#dce6d5] text-center text-xs text-[#626f62]">
                            Pelapor tidak melampirkan foto.
                        </div>
                    @endif
                </div>

                @if($report->resolution_image)
                    <!-- Foto Bukti Sesudah Pembersihan -->
                    <div class="space-y-2 pt-4 border-t border-[#e7e7e7]">
                        <span class="text-xs font-bold text-[#1a9120] block uppercase tracking-wider">Foto Hasil Penanganan (Selesai Bersih):</span>
                        <div class="aspect-[16/10] rounded-[6px] overflow-hidden bg-slate-100 border border-[#dce6d5]">
                            <img src="{{ str_starts_with($report->resolution_image, 'http') ? $report->resolution_image : asset('storage/' . $report->resolution_image) }}" 
                                 alt="Hasil Penanganan" class="w-full h-full object-cover">
                        </div>
                    </div>
                @endif

            </div>
        </div>

        <!-- Right: Action / Update Status Form -->
        <div class="lg:col-span-5">
            <div class="bg-white rounded-[10px] p-6 sm:p-7 border border-[#dce6d5] shadow-sm space-y-5 sticky top-24">
                <h2 class="text-base font-bold text-[#07370a] font-heading">Tindak Lanjut &amp; Update Status</h2>
                
                <form action="{{ route('admin.reports.update', $report) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="status" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Pilih Status Penanganan</label>
                        <select name="status" id="status" class="input-jadesta w-full">
                            <option value="pending" {{ $report->status === 'pending' ? 'selected' : '' }}>Menunggu (Pending)</option>
                            <option value="in_progress" {{ $report->status === 'in_progress' ? 'selected' : '' }}>Sedang Ditangani (In Progress)</option>
                            <option value="resolved" {{ $report->status === 'resolved' ? 'selected' : '' }}>Selesai Bersih (Resolved)</option>
                            <option value="rejected" {{ $report->status === 'rejected' ? 'selected' : '' }}>Ditolak / Tidak Valid (Rejected)</option>
                        </select>
                    </div>

                    <div>
                        <label for="admin_notes" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-2">Catatan Tindak Lanjut Pengelola</label>
                        <textarea name="admin_notes" id="admin_notes" rows="4" 
                                  placeholder="Tuliskan tindakan yang dilakukan, misalnya: Sampah telah dibersihkan oleh Karang Taruna dan tempat sampah baru telah diletakkan..."
                                  class="input-jadesta w-full !h-auto !py-2.5">{{ old('admin_notes', $report->admin_notes) }}</textarea>
                    </div>

                    <div>
                        <label for="resolution_image" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-1">Unggah Foto Bukti Selesai Bersih</label>
                        <input type="file" name="resolution_image" id="resolution_image" accept="image/*"
                               class="block w-full text-xs text-[#626f62] file:mr-3 file:py-2 file:px-3 file:rounded-[4px] file:border-0 file:text-xs file:font-bold file:bg-[#1a9120] file:text-white hover:file:bg-[#07370a] file:cursor-pointer">
                        <p class="text-[10px] text-[#626f62] mt-1">Lampirkan foto lokasi yang sudah bersih (opsional).</p>
                    </div>

                    <button type="submit" class="grdeen-btn w-full !py-3">
                        <span>Simpan Pembaruan Status</span>
                    </button>
                </form>
            </div>
        </div>

    </div>

</div>
@endsection
