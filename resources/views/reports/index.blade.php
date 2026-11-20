@extends('layouts.app')

@section('title', 'Aksi Kebersihan & Lacak Tiket Laporan | Jejaring Desa Wisata Cupunagara')

@section('content')

    <!-- Jadesta Page Banner -->
    <div class="bg-[#07370a] text-white py-12 border-b-4 border-[#1a9120]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex text-xs text-[#ecf2df]/80 gap-1.5 mb-3">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <span>/</span>
                <span class="text-white font-semibold">Aksi Kebersihan</span>
            </nav>
            <div class="sec-title__tagline-wrap">
                <span class="text-[#1f9a26]">
                    <svg viewBox="0 0 12 10" fill="currentColor" class="w-3.5 h-3">
                        <path d="M5.8 1.6 C7 2.4 8 4 8 5 C8 6 7 7.6 5.8 8.4 L3.6 10 L6.3 10 C8 10 9.5 9.1 10.6 7.5 C12.1 5.2 12.1 4.8 10.6 2.5 C9.5 0.9 8 0 6.3 0 L3.6 0 L5.8 1.6 Z" />
                    </svg>
                </span>
                <span class="text-xs font-bold uppercase tracking-wider text-[#1f9a26]">Transparansi Pengelolaan Lingkungan</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold text-white font-heading mt-1">
                Pantau Tindak Lanjut Kebersihan Desa
            </h1>
            <p class="text-sm text-[#d6dfd6] mt-2 max-w-2xl leading-relaxed">
                Setiap laporan tumpukan sampah liar dan fasilitas rusak ditindaklanjuti oleh pemuda Karang Taruna bersama warga Desa Cupunagara. Masukkan kode tiket Anda untuk melihat dokumentasi penanganan.
            </p>
        </div>
    </div>

    <div class="py-14 bg-[#f6f7f2]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Tracking Search Box -->
            <div class="max-w-2xl mx-auto mb-12">
                <div class="bg-white p-4 rounded-[6px] border border-[#dce6d5] shadow-sm">
                    <form action="{{ route('reports.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3">
                        <div class="relative flex-1 w-full">
                            <svg class="w-5 h-5 text-[#626f62] absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                            <input type="text" name="ticket" value="{{ request('ticket') }}" required 
                                   placeholder="Masukkan Kode Tiket (Contoh: CPN-202611-001)" 
                                   class="input-jadesta w-full pl-11 uppercase font-mono tracking-wider font-bold text-xs sm:text-sm">
                        </div>
                        <button type="submit" class="grdeen-btn !py-3 !px-7 w-full sm:w-auto">
                            <span>Lacak Status</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Result of Tracked Report (If Searched) -->
            @if(request()->filled('ticket'))
                <div class="max-w-3xl mx-auto mb-14">
                    @if($trackedReport)
                        <div class="bg-white rounded-[6px] p-6 sm:p-8 border border-[#dce6d5] shadow-sm space-y-6">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-[#e7e7e7] gap-3">
                                <div>
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-[#626f62] block">KODE TIKET LAPORAN</span>
                                    <span class="text-xl font-extrabold text-[#07370a] font-mono tracking-wider">{{ $trackedReport->ticket_code }}</span>
                                </div>
                                <div>
                                    <span class="inline-flex items-center px-3.5 py-1.5 rounded-[4px] text-xs font-bold border {{ $trackedReport->status_badge_class }}">
                                        {{ $trackedReport->status_label }}
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm">
                                <div class="p-3.5 rounded-[4px] bg-[#f6f7f2] border border-[#e7e7e7]">
                                    <span class="text-[#626f62] block text-xs">Kategori Masalah</span>
                                    <strong class="text-[#07370a]">{{ $trackedReport->category_label }}</strong>
                                </div>
                                <div class="p-3.5 rounded-[4px] bg-[#f6f7f2] border border-[#e7e7e7]">
                                    <span class="text-[#626f62] block text-xs">Waktu Dilaporkan</span>
                                    <strong class="text-[#07370a]">{{ $trackedReport->created_at->translatedFormat('d F Y, H:i') }} WIB</strong>
                                </div>
                                <div class="p-3.5 rounded-[4px] bg-[#f6f7f2] border border-[#e7e7e7]">
                                    <span class="text-[#626f62] block text-xs">Lokasi / Patokan</span>
                                    <strong class="text-[#07370a]">{{ $trackedReport->specific_location }}</strong>
                                </div>
                                <div class="p-3.5 rounded-[4px] bg-[#f6f7f2] border border-[#e7e7e7]">
                                    <span class="text-[#626f62] block text-xs">Area / Titik Plang QR</span>
                                    <strong class="text-[#07370a]">
                                        {{ $trackedReport->destination->name ?? ($trackedReport->qrPoint->location_name ?? 'Area Umum Desa Cupunagara') }}
                                    </strong>
                                </div>
                            </div>

                            <div class="p-4 rounded-[4px] bg-[#edf5ee] border-l-4 border-[#1a9120] text-xs sm:text-sm text-[#07370a] space-y-1">
                                <span class="font-bold block text-xs uppercase">Keterangan Pelapor:</span>
                                <p class="leading-relaxed text-[#4f5345]">{{ $trackedReport->description }}</p>
                            </div>

                            <!-- Photos (Before & After) -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                                <div class="space-y-2">
                                    <span class="text-xs font-bold text-[#07370a] block uppercase">Foto Kondisi Awal:</span>
                                    @if($trackedReport->image_evidence)
                                        <div class="aspect-[4/3] rounded-[4px] overflow-hidden bg-[#f2f4ec] border border-[#e7e7e7]">
                                            <img src="{{ str_starts_with($trackedReport->image_evidence, 'http') ? $trackedReport->image_evidence : asset('storage/' . $trackedReport->image_evidence) }}" 
                                                 alt="Foto Bukti Laporan" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="aspect-[4/3] rounded-[4px] bg-[#f6f7f2] border border-dashed border-[#d4dcd4] flex items-center justify-center text-xs text-[#626f62]">
                                            Tidak ada foto dilampirkan
                                        </div>
                                    @endif
                                </div>

                                <div class="space-y-2">
                                    <span class="text-xs font-bold text-[#1a9120] block uppercase">Foto Setelah Ditindaklanjuti:</span>
                                    @if($trackedReport->resolution_image)
                                        <div class="aspect-[4/3] rounded-[4px] overflow-hidden bg-[#f2f4ec] border border-[#e7e7e7]">
                                            <img src="{{ str_starts_with($trackedReport->resolution_image, 'http') ? $trackedReport->resolution_image : asset('storage/' . $trackedReport->resolution_image) }}" 
                                                 alt="Foto Bukti Penyelesaian" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="aspect-[4/3] rounded-[4px] bg-[#edf5ee] border border-dashed border-[#1a9120]/40 flex flex-col items-center justify-center text-xs text-[#07370a] p-4 text-center">
                                            <span class="font-semibold">Menunggu penanganan di lapangan</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if($trackedReport->admin_notes)
                                <div class="p-4 rounded-[4px] bg-[#f6f7f2] border border-[#e7e7e7] text-xs sm:text-sm text-[#4f5345] space-y-1">
                                    <strong class="block text-[#07370a] font-bold">Catatan Tim Kebersihan Desa:</strong>
                                    <p class="leading-relaxed">{{ $trackedReport->admin_notes }}</p>
                                    @if($trackedReport->resolved_at)
                                        <span class="block text-[11px] text-[#626f62] mt-1">Diselesaikan pada: {{ $trackedReport->resolved_at->translatedFormat('d F Y, H:i') }} WIB</span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="bg-white rounded-[6px] p-10 text-center border border-[#dce6d5] space-y-2">
                            <h3 class="text-base font-bold text-[#07370a] font-heading">Kode Tiket Tidak Ditemukan</h3>
                            <p class="text-xs text-[#626f62] max-w-md mx-auto">Kode tiket "{{ request('ticket') }}" tidak terdaftar. Pastikan format penulisan kode sudah sesuai (contoh: CPN-202611-001).</p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Quick Stats Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-14">
                <div class="bg-white p-5 rounded-[6px] border border-[#dce6d5] shadow-sm text-center">
                    <span class="text-2xl sm:text-3xl font-extrabold text-[#07370a] font-heading block">{{ $stats['total'] }}</span>
                    <span class="text-xs font-medium text-[#626f62] mt-1 block">Total Laporan Masuk</span>
                </div>
                <div class="bg-white p-5 rounded-[6px] border border-[#dce6d5] shadow-sm text-center">
                    <span class="text-2xl sm:text-3xl font-extrabold text-[#1a9120] font-heading block">{{ $stats['resolved'] }}</span>
                    <span class="text-xs font-medium text-[#626f62] mt-1 block">Tuntas Ditangani</span>
                </div>
                <div class="bg-white p-5 rounded-[6px] border border-[#dce6d5] shadow-sm text-center">
                    <span class="text-2xl sm:text-3xl font-extrabold text-[#07370a] font-heading block">{{ $stats['in_progress'] }}</span>
                    <span class="text-xs font-medium text-[#626f62] mt-1 block">Sedang Ditindaklanjuti</span>
                </div>
                <div class="bg-white p-5 rounded-[6px] border border-[#dce6d5] shadow-sm text-center">
                    <span class="text-2xl sm:text-3xl font-extrabold text-[#626f62] font-heading block">{{ $stats['pending'] }}</span>
                    <span class="text-xs font-medium text-[#626f62] mt-1 block">Menunggu Penjadwalan</span>
                </div>
            </div>

            <!-- Recently Resolved Reports Showcase -->
            <div class="space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <div class="sec-title__tagline-wrap">
                            <span class="sec-title__chevron">
                                <svg viewBox="0 0 12 10" fill="currentColor" class="w-3.5 h-3">
                                    <path d="M5.8 1.6 C7 2.4 8 4 8 5 C8 6 7 7.6 5.8 8.4 L3.6 10 L6.3 10 C8 10 9.5 9.1 10.6 7.5 C12.1 5.2 12.1 4.8 10.6 2.5 C9.5 0.9 8 0 6.3 0 L3.6 0 L5.8 1.6 Z" />
                                </svg>
                            </span>
                            <span class="sec-title__tagline">Bukti Penanganan Warga</span>
                        </div>
                        <h2 class="text-2xl font-bold text-[#07370a] font-heading">Dokumentasi Aksi Bersih Lapangan</h2>
                    </div>
                    <a href="{{ route('reports.create') }}" class="grdeen-btn self-start sm:self-auto">
                        <span>Kirim Laporan Baru</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($resolvedReports as $report)
                        <div class="jadesta-blog-card !bg-white border border-[#dce6d5] p-5 space-y-4">
                            <div>
                                <div class="flex items-center justify-between text-xs mb-2">
                                    <span class="font-mono font-bold text-[#07370a]">{{ $report->ticket_code }}</span>
                                    <span class="px-2.5 py-0.5 rounded-[3px] bg-[#1a9120] text-white font-bold text-[11px]">Selesai</span>
                                </div>
                                <h4 class="text-base font-bold text-[#07370a] font-heading">{{ $report->specific_location }}</h4>
                                <p class="text-xs text-[#626f62] mt-1 line-clamp-2">{{ $report->description }}</p>

                                @if($report->resolution_image)
                                    <div class="mt-3 aspect-[16/9] rounded-[4px] overflow-hidden bg-[#f2f4ec] border border-[#e7e7e7]">
                                        <img src="{{ str_starts_with($report->resolution_image, 'http') ? $report->resolution_image : asset('storage/' . $report->resolution_image) }}" 
                                             alt="Bukti Selesai" class="w-full h-full object-cover">
                                    </div>
                                @endif
                            </div>

                            <div class="pt-3 border-t border-[#e7e7e7] text-xs text-[#626f62] flex items-center justify-between">
                                <span>{{ $report->category_label }}</span>
                                <a href="{{ route('reports.index', ['ticket' => $report->ticket_code]) }}" class="font-bold text-[#1a9120] hover:underline">
                                    Rincian &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection
