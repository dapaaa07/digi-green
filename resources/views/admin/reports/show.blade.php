@extends('layouts.admin')

@section('title', 'Tindak Lanjut Laporan ' . $report->ticket_code . ' | Admin Cupunagara')

@section('content')
<div class="space-y-6 max-w-4xl">
    
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.reports.index') }}" class="text-xs text-slate-500 hover:text-slate-800 transition block mb-1">
                &larr; Kembali ke Daftar Laporan
            </a>
            <h1 class="text-2xl font-extrabold text-slate-900 font-heading">
                Detail Laporan #{{ $report->ticket_code }}
            </h1>
        </div>

        <form action="{{ route('admin.reports.destroy', $report) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-3.5 py-2 rounded-xl text-xs font-bold text-rose-700 bg-rose-50 hover:bg-rose-100 border border-rose-200 transition">
                Hapus Laporan
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left: Report Information -->
        <div class="lg:col-span-7 space-y-6">
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-5">
                
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <span class="text-xs text-slate-400">STATUS SAAT INI</span>
                    <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $report->status_badge_class }}">
                        {{ $report->status_label }}
                    </span>
                </div>

                <div class="space-y-3 text-xs sm:text-sm">
                    <div>
                        <span class="text-slate-400 block text-xs">Kategori Masalah</span>
                        <strong class="text-slate-900">{{ $report->category_label }}</strong>
                    </div>

                    <div>
                        <span class="text-slate-400 block text-xs">Waktu Laporan Masuk</span>
                        <strong class="text-slate-900">{{ $report->created_at->translatedFormat('d F Y, H:i') }} WIB</strong>
                    </div>

                    <div>
                        <span class="text-slate-400 block text-xs">Pelapor</span>
                        <strong class="text-slate-900">{{ $report->reporter_name }}</strong>
                        @if($report->reporter_phone)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $report->reporter_phone) }}" target="_blank" class="text-emerald-700 font-bold ml-2 underline text-xs">
                                Hubungi WA ({{ $report->reporter_phone }})
                            </a>
                        @endif
                    </div>

                    <div>
                        <span class="text-slate-400 block text-xs">Lokasi Spesifik / Patokan</span>
                        <strong class="text-slate-900">{{ $report->specific_location }}</strong>
                    </div>

                    <div>
                        <span class="text-slate-400 block text-xs">Terkait Tempat Wisata / Plang QR</span>
                        <strong class="text-slate-900">
                            {{ $report->destination->name ?? ($report->qrPoint->location_name ?? 'Area Umum Desa Cupunagara') }}
                        </strong>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 text-xs sm:text-sm text-slate-700 space-y-1">
                    <span class="font-bold text-slate-900 block text-xs">Keterangan dari Pelapor:</span>
                    <p class="leading-relaxed">{{ $report->description }}</p>
                </div>

                <!-- Foto Bukti Sebelum -->
                <div class="space-y-2 pt-2">
                    <span class="text-xs font-bold text-slate-700 block">📷 Foto Bukti Sebelum (Dari Pelapor):</span>
                    @if($report->image_evidence)
                        <div class="aspect-[16/10] rounded-2xl overflow-hidden bg-slate-100 border border-slate-200">
                            <img src="{{ str_starts_with($report->image_evidence, 'http') ? $report->image_evidence : asset('storage/' . $report->image_evidence) }}" 
                                 alt="Bukti Laporan" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="p-6 rounded-2xl bg-slate-50 border border-dashed border-slate-200 text-center text-xs text-slate-400">
                            Pelapor tidak melampirkan foto.
                        </div>
                    @endif
                </div>

            </div>
        </div>

        <!-- Right: Action / Update Status Form -->
        <div class="lg:col-span-5">
            <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200 shadow-sm space-y-6 sticky top-24">
                <h2 class="text-base font-bold text-slate-900 font-heading">Tindak Lanjut & Update Status</h2>

                <form action="{{ route('admin.reports.update', $report) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <!-- Status Dropdown -->
                    <div>
                        <label for="status" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Ubah Status</label>
                        <select name="status" id="status" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600">
                            <option value="pending" {{ $report->status === 'pending' ? 'selected' : '' }}>Menunggu (Pending)</option>
                            <option value="in_progress" {{ $report->status === 'in_progress' ? 'selected' : '' }}>Sedang Ditindaklanjuti (In Progress)</option>
                            <option value="resolved" {{ $report->status === 'resolved' ? 'selected' : '' }}>Selesai Dibersihkan (Resolved)</option>
                            <option value="rejected" {{ $report->status === 'rejected' ? 'selected' : '' }}>Ditolak / Tidak Valid (Rejected)</option>
                        </select>
                    </div>

                    <!-- Catatan Petugas -->
                    <div>
                        <label for="admin_notes" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Catatan Tindak Lanjut</label>
                        <textarea name="admin_notes" id="admin_notes" rows="4" 
                                  placeholder="Contoh: Sampah plastik telah dibersihkan oleh pemuda Karang Taruna bersama warga saat kerja bakti Minggu pagi..."
                                  class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600">{{ old('admin_notes', $report->admin_notes) }}</textarea>
                    </div>

                    <!-- Foto Bukti Selesai (Resolution Image) -->
                    <div>
                        <label for="resolution_image" class="block text-xs font-bold uppercase text-slate-700 mb-1.5">
                            Unggah Foto Bukti Sesudah Dibersihkan
                        </label>
                        <input type="file" name="resolution_image" id="resolution_image" accept="image/*" 
                               class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-100 file:text-emerald-800 hover:file:bg-emerald-200 cursor-pointer border border-slate-200 rounded-xl p-1">
                        @if($report->resolution_image)
                            <div class="mt-2 text-xs text-emerald-700 font-semibold flex items-center gap-2">
                                <span>Foto saat ini sudah terunggah</span>
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="w-full py-3.5 rounded-xl text-xs font-bold text-white bg-emerald-700 hover:bg-emerald-800 transition shadow-sm">
                        Simpan Pembaruan Laporan
                    </button>
                </form>
            </div>
        </div>

    </div>

</div>
@endsection
