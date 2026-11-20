@extends('layouts.admin')

@section('title', 'Dashboard Pengelola | Digi-Green Cupunagara')

@section('content')
<div class="space-y-8">
    
    <div>
        <h1 class="text-2xl font-extrabold text-stone-900 font-heading">Ringkasan Pengelolaan Desa</h1>
        <p class="text-xs sm:text-sm text-stone-500 mt-1">Pantau laporan kebersihan dari wisatawan dan kelola informasi ekowisata Cupunagara.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-stone-200 shadow-sm">
            <span class="text-xs text-stone-400 font-medium block">Total Wisata</span>
            <span class="text-2xl font-extrabold text-stone-900 font-heading mt-1 block">{{ $stats['total_destinations'] }}</span>
            <a href="{{ route('admin.destinations.index') }}" class="text-[11px] text-[#1E4620] font-semibold hover:underline mt-2 inline-block">Kelola Wisata &rarr;</a>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-stone-200 shadow-sm">
            <span class="text-xs text-stone-400 font-medium block">Total Laporan</span>
            <span class="text-2xl font-extrabold text-stone-900 font-heading mt-1 block">{{ $stats['total_reports'] }}</span>
            <a href="{{ route('admin.reports.index') }}" class="text-[11px] text-[#1E4620] font-semibold hover:underline mt-2 inline-block">Semua Laporan &rarr;</a>
        </div>

        <div class="bg-stone-50 p-5 rounded-2xl border border-stone-200 shadow-sm">
            <span class="text-xs text-stone-600 font-medium block">Menunggu (Pending)</span>
            <span class="text-2xl font-extrabold text-amber-900 font-heading mt-1 block">{{ $stats['pending_reports'] }}</span>
            <a href="{{ route('admin.reports.index', ['status' => 'pending']) }}" class="text-[11px] text-amber-800 font-bold hover:underline mt-2 inline-block">Tindak Lanjut &rarr;</a>
        </div>

        <div class="bg-stone-50 p-5 rounded-2xl border border-stone-200 shadow-sm">
            <span class="text-xs text-stone-600 font-medium block">Sedang Ditangani</span>
            <span class="text-2xl font-extrabold text-stone-900 font-heading mt-1 block">{{ $stats['in_progress_reports'] }}</span>
            <a href="{{ route('admin.reports.index', ['status' => 'in_progress']) }}" class="text-[11px] text-stone-700 font-bold hover:underline mt-2 inline-block">Lihat Progres &rarr;</a>
        </div>

        <div class="bg-stone-50 p-5 rounded-2xl border border-stone-200 shadow-sm">
            <span class="text-xs text-[#1E4620] font-medium block">Selesai Bersih</span>
            <span class="text-2xl font-extrabold text-[#1E4620] font-heading mt-1 block">{{ $stats['resolved_reports'] }}</span>
            <span class="text-[11px] text-[#1E4620] mt-2 block">Telah Ditangani</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-stone-200 shadow-sm">
            <span class="text-xs text-stone-400 font-medium block">Scan Plang QR</span>
            <span class="text-2xl font-extrabold text-stone-900 font-heading mt-1 block">{{ $stats['total_qr_scans'] }}</span>
            <span class="text-[11px] text-stone-400 mt-2 block">Kunjungan Plang</span>
        </div>
    </div>

    <!-- 3 Plang Bambu Status -->
    <div class="bg-white rounded-3xl p-6 border border-stone-200 shadow-sm space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-bold text-stone-900 font-heading flex items-center gap-2">
                Status 3 Titik Plang Informasi QR Code
            </h2>
            <a href="{{ route('admin.qr.print') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-800 text-xs font-bold border border-stone-200 transition">
                Cetak Stiker Plang QR
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($qrPoints as $qr)
                <div class="p-4 rounded-2xl border border-stone-200 bg-stone-50 flex items-start justify-between">
                    <div>
                        <span class="text-[10px] font-bold text-[#1E4620] bg-stone-200 px-2 py-0.5 rounded uppercase">{{ $qr->code }}</span>
                        <h4 class="text-xs font-bold text-stone-900 mt-2">{{ $qr->location_name }}</h4>
                        <span class="text-[11px] text-stone-500 mt-1 block">{{ $qr->scan_count }} kali dipindai</span>
                    </div>
                    <a href="{{ route('qr.show', $qr->code) }}" target="_blank" class="text-xs text-[#1E4620] font-semibold hover:underline">
                        Lihat ↗
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Reports Table -->
    <div class="bg-white rounded-3xl p-6 border border-stone-200 shadow-sm space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-bold text-stone-900 font-heading">Laporan Kebersihan Terbaru</h2>
            <a href="{{ route('admin.reports.index') }}" class="text-xs font-semibold text-[#1E4620] hover:underline">
                Lihat Semua Laporan &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-stone-100 text-stone-400 uppercase font-semibold">
                        <th class="pb-3">Kode Tiket</th>
                        <th class="pb-3">Kategori</th>
                        <th class="pb-3">Lokasi</th>
                        <th class="pb-3">Pelapor</th>
                        <th class="pb-3">Status</th>
                        <th class="pb-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($recentReports as $report)
                        <tr class="hover:bg-stone-50/50">
                            <td class="py-3 font-mono font-bold text-stone-900">{{ $report->ticket_code }}</td>
                            <td class="py-3 text-stone-600">{{ $report->category_label }}</td>
                            <td class="py-3 text-stone-600 max-w-xs truncate">{{ $report->specific_location }}</td>
                            <td class="py-3 text-stone-600">{{ $report->reporter_name }}</td>
                            <td class="py-3">
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold border {{ $report->status_badge_class }}">
                                    {{ $report->status_label }}
                                </span>
                            </td>
                            <td class="py-3 text-right">
                                <a href="{{ route('admin.reports.show', $report) }}" class="text-[#1E4620] font-bold hover:underline">
                                    Tindak Lanjut &rarr;
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-stone-400">Belum ada laporan masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
