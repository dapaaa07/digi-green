@extends('layouts.admin')

@section('title', 'Dashboard Pengelola | Digi-Green Cupunagara')

@section('content')
<div class="space-y-8">
    
    <div>
        <div class="sec-title__tagline-wrap">
            <span class="text-[#1a9120]">
                <svg viewBox="0 0 12 10" fill="currentColor" class="w-3.5 h-3">
                    <path d="M5.8 1.6 C7 2.4 8 4 8 5 C8 6 7 7.6 5.8 8.4 L3.6 10 L6.3 10 C8 10 9.5 9.1 10.6 7.5 C12.1 5.2 12.1 4.8 10.6 2.5 C9.5 0.9 8 0 6.3 0 L3.6 0 L5.8 1.6 Z" />
                </svg>
            </span>
            <span class="text-[11px] font-bold uppercase tracking-wider text-[#1a9120]">Ikhtisar Pengelolaan</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-bold text-[#07370a] font-heading mt-0.5">Ringkasan Pengelolaan Desa</h1>
        <p class="text-xs text-[#626f62] mt-0.5">Pantau laporan kebersihan dari wisatawan dan kelola informasi ekowisata serta produk kopi Cupunagara.</p>
    </div>

    <!-- Stats Grid in Jadesta Theme -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4">
        <div class="bg-white p-5 rounded-[10px] border border-[#dce6d5] shadow-sm">
            <span class="text-[11px] text-[#626f62] font-bold uppercase tracking-wider block">Tempat Wisata</span>
            <span class="text-3xl font-bold text-[#07370a] font-heading mt-1 block">{{ $stats['total_destinations'] }}</span>
            <a href="{{ route('admin.destinations.index') }}" class="text-[11px] text-[#1a9120] font-bold hover:underline mt-2 inline-block">Kelola Wisata &rarr;</a>
        </div>

        <div class="bg-white p-5 rounded-[10px] border border-[#dce6d5] shadow-sm">
            <span class="text-[11px] text-[#626f62] font-bold uppercase tracking-wider block">Produk Kopi</span>
            <span class="text-3xl font-bold text-[#07370a] font-heading mt-1 block">{{ $stats['total_coffees'] }}</span>
            <a href="{{ route('admin.products.index') }}" class="text-[11px] text-[#1a9120] font-bold hover:underline mt-2 inline-block">Kelola Produk &rarr;</a>
        </div>

        <div class="bg-white p-5 rounded-[10px] border border-[#dce6d5] shadow-sm">
            <span class="text-[11px] text-[#626f62] font-bold uppercase tracking-wider block">Berita Desa</span>
            <span class="text-3xl font-bold text-[#07370a] font-heading mt-1 block">{{ $stats['total_articles'] ?? 0 }}</span>
            <a href="{{ route('admin.articles.index') }}" class="text-[11px] text-[#1a9120] font-bold hover:underline mt-2 inline-block">Kelola Berita &rarr;</a>
        </div>

        <div class="bg-white p-5 rounded-[10px] border border-[#dce6d5] shadow-sm">
            <span class="text-[11px] text-[#626f62] font-bold uppercase tracking-wider block">Total Laporan</span>
            <span class="text-3xl font-bold text-[#07370a] font-heading mt-1 block">{{ $stats['total_reports'] }}</span>
            <a href="{{ route('admin.reports.index') }}" class="text-[11px] text-[#1a9120] font-bold hover:underline mt-2 inline-block">Semua Laporan &rarr;</a>
        </div>

        <div class="bg-[#fdfaf3] p-5 rounded-[10px] border border-[#f0e3cc] shadow-sm">
            <span class="text-[11px] text-amber-800 font-bold uppercase tracking-wider block">Menunggu</span>
            <span class="text-3xl font-bold text-amber-900 font-heading mt-1 block">{{ $stats['pending_reports'] }}</span>
            <a href="{{ route('admin.reports.index', ['status' => 'pending']) }}" class="text-[11px] text-amber-800 font-bold hover:underline mt-2 inline-block">Tindak Lanjut &rarr;</a>
        </div>

        <div class="bg-[#f4f7f4] p-5 rounded-[10px] border border-[#dce6d5] shadow-sm">
            <span class="text-[11px] text-[#07370a] font-bold uppercase tracking-wider block">Diproses</span>
            <span class="text-3xl font-bold text-[#07370a] font-heading mt-1 block">{{ $stats['in_progress_reports'] }}</span>
            <a href="{{ route('admin.reports.index', ['status' => 'in_progress']) }}" class="text-[11px] text-[#1a9120] font-bold hover:underline mt-2 inline-block">Lihat Progres &rarr;</a>
        </div>

        <div class="bg-[#ecf2df] p-5 rounded-[10px] border border-[#dce6d5] shadow-sm">
            <span class="text-[11px] text-[#1a9120] font-bold uppercase tracking-wider block">Selesai Bersih</span>
            <span class="text-3xl font-bold text-[#07370a] font-heading mt-1 block">{{ $stats['resolved_reports'] }}</span>
            <span class="text-[11px] text-[#1a9120] font-bold mt-2 block">Telah Ditangani</span>
        </div>
    </div>

    <!-- Quick Action Banner -->
    <div class="bg-white rounded-[10px] p-6 border border-[#dce6d5] shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-[#ecf2df] text-[#1a9120] flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-[#07370a] font-heading">Cetak Stiker Plang QR Code Resmi</h3>
                <p class="text-xs text-[#626f62] mt-0.5">Cetak stiker kode QR resmi portal Desa Wisata Cupunagara untuk dipasang pada plang bambu dan fasilitas desa.</p>
            </div>
        </div>
        <a href="{{ route('admin.qr.print') }}" target="_blank" class="grdeen-btn !py-2.5 !px-5 text-xs whitespace-nowrap self-start md:self-auto">
            <span>Buka Cetak Stiker QR &rarr;</span>
        </a>
    </div>

    <!-- Recent Reports Table in Jadesta Theme -->
    <div class="bg-white rounded-[10px] p-6 border border-[#dce6d5] shadow-sm space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-bold text-[#07370a] font-heading">Laporan Kebersihan Terbaru</h2>
            <a href="{{ route('admin.reports.index') }}" class="text-xs font-bold text-[#1a9120] hover:underline">
                Lihat Semua Laporan &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-[#dce6d5] text-[#07370a] uppercase font-bold text-[11px] tracking-wider bg-[#f6f7f2]">
                        <th class="py-3 px-3">Kode Tiket</th>
                        <th class="py-3 px-3">Kategori</th>
                        <th class="py-3 px-3">Lokasi</th>
                        <th class="py-3 px-3">Pelapor</th>
                        <th class="py-3 px-3">Status</th>
                        <th class="py-3 px-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e7e7e7]">
                    @forelse($recentReports as $report)
                        <tr class="hover:bg-[#f6f7f2]/60 transition">
                            <td class="py-3.5 px-3 font-mono font-bold text-[#07370a]">
                                {{ $report->ticket_code }}
                            </td>
                            <td class="py-3.5 px-3">
                                <span class="capitalize text-[#4f5345]">{{ str_replace('_', ' ', $report->report_category) }}</span>
                            </td>
                            <td class="py-3.5 px-3 text-[#4f5345] max-w-xs truncate">
                                {{ $report->specific_location }}
                            </td>
                            <td class="py-3.5 px-3 text-[#626f62]">
                                {{ $report->reporter_name }}
                            </td>
                            <td class="py-3.5 px-3">
                                @if($report->status === 'resolved')
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#ecf2df] text-[#1a9120] border border-[#dce6d5]">
                                        Selesai Bersih
                                    </span>
                                @elseif($report->status === 'in_progress')
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        Ditangani
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        Menunggu
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-3 text-right whitespace-nowrap">
                                <a href="{{ route('admin.reports.show', $report) }}" 
                                   class="px-3 py-1.5 rounded-[4px] bg-[#1a9120] hover:bg-[#07370a] text-white font-bold transition text-[11px]">
                                    Tangani &rarr;
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-[#626f62]">Belum ada laporan kebersihan yang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
