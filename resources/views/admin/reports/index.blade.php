@extends('layouts.admin')

@section('title', 'Manajemen Laporan Kebersihan | Admin Cupunagara')

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="sec-title__tagline-wrap">
                <span class="text-[#1a9120]">
                    <svg viewBox="0 0 12 10" fill="currentColor" class="w-3.5 h-3">
                        <path d="M5.8 1.6 C7 2.4 8 4 8 5 C8 6 7 7.6 5.8 8.4 L3.6 10 L6.3 10 C8 10 9.5 9.1 10.6 7.5 C12.1 5.2 12.1 4.8 10.6 2.5 C9.5 0.9 8 0 6.3 0 L3.6 0 L5.8 1.6 Z" />
                    </svg>
                </span>
                <span class="text-[11px] font-bold uppercase tracking-wider text-[#1a9120]">Gotong Royong Kebersihan</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#07370a] font-heading mt-0.5">Daftar Laporan Kebersihan</h1>
            <p class="text-xs text-[#626f62] mt-0.5">Pantau dan verifikasi aduan titik sampah liar, tempat sampah penuh, dan jadwal ronda kebersihan desa.</p>
        </div>
        <a href="{{ route('reports.create') }}" target="_blank" class="grdeen-btn self-start sm:self-auto !py-2.5 !px-5 text-xs">
            <span>+ Tambah Laporan Manual</span>
        </a>
    </div>

    <!-- Status Tabs in Jadesta Style -->
    <div class="flex flex-wrap gap-2 text-xs font-bold">
        <a href="{{ route('admin.reports.index') }}" 
           class="px-3.5 py-2 rounded-[6px] border transition {{ !request()->filled('status') ? 'bg-[#07370a] text-white border-[#07370a]' : 'bg-white text-[#4f5345] border-[#dce6d5] hover:bg-[#f6f7f2]' }}">
            Semua ({{ $statusCounts['all'] }})
        </a>
        <a href="{{ route('admin.reports.index', ['status' => 'pending']) }}" 
           class="px-3.5 py-2 rounded-[6px] border transition {{ request('status') === 'pending' ? 'bg-amber-600 text-white border-amber-600' : 'bg-white text-amber-800 border-amber-200 hover:bg-amber-50' }}">
            Menunggu ({{ $statusCounts['pending'] }})
        </a>
        <a href="{{ route('admin.reports.index', ['status' => 'in_progress']) }}" 
           class="px-3.5 py-2 rounded-[6px] border transition {{ request('status') === 'in_progress' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-blue-700 border-blue-200 hover:bg-blue-50' }}">
            Sedang Ditangani ({{ $statusCounts['in_progress'] }})
        </a>
        <a href="{{ route('admin.reports.index', ['status' => 'resolved']) }}" 
           class="px-3.5 py-2 rounded-[6px] border transition {{ request('status') === 'resolved' ? 'bg-[#1a9120] text-white border-[#1a9120]' : 'bg-white text-[#1a9120] border-[#dce6d5] hover:bg-[#ecf2df]' }}">
            Selesai Bersih ({{ $statusCounts['resolved'] }})
        </a>
        <a href="{{ route('admin.reports.index', ['status' => 'rejected']) }}" 
           class="px-3.5 py-2 rounded-[6px] border transition {{ request('status') === 'rejected' ? 'bg-red-600 text-white border-red-600' : 'bg-white text-red-700 border-red-200 hover:bg-red-50' }}">
            Ditolak ({{ $statusCounts['rejected'] }})
        </a>
    </div>

    <!-- Reports Table Card -->
    <div class="bg-white rounded-[10px] p-6 border border-[#dce6d5] shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-[#dce6d5] text-[#07370a] uppercase font-bold text-[11px] tracking-wider bg-[#f6f7f2]">
                        <th class="py-3 px-3">Kode Tiket</th>
                        <th class="py-3 px-3">Waktu</th>
                        <th class="py-3 px-3">Kategori</th>
                        <th class="py-3 px-3">Lokasi / Titik</th>
                        <th class="py-3 px-3">Pelapor</th>
                        <th class="py-3 px-3">Foto Bukti</th>
                        <th class="py-3 px-3">Status</th>
                        <th class="py-3 px-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e7e7e7]">
                    @forelse($reports as $report)
                        <tr class="hover:bg-[#f6f7f2]/60 transition">
                            <td class="py-3.5 px-3 font-mono font-bold text-[#07370a]">
                                {{ $report->ticket_code }}
                            </td>
                            <td class="py-3.5 px-3 text-[#626f62] whitespace-nowrap">
                                {{ $report->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="py-3.5 px-3">
                                <span class="capitalize text-[#4f5345] font-semibold">{{ str_replace('_', ' ', $report->report_category) }}</span>
                            </td>
                            <td class="py-3.5 px-3 text-[#4f5345] max-w-xs">
                                <p class="line-clamp-2 leading-relaxed">{{ $report->specific_location }}</p>
                                @if($report->destination)
                                    <span class="text-[10px] text-[#1a9120] font-bold block mt-0.5">Kawasan: {{ $report->destination->name }}</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-3 text-[#626f62]">
                                <span class="block text-[#07370a] font-bold">{{ $report->reporter_name }}</span>
                                <span class="text-[11px] font-mono">{{ $report->reporter_phone ?? '-' }}</span>
                            </td>
                            <td class="py-3.5 px-3">
                                @if($report->image_evidence)
                                    <a href="{{ $report->image_url }}" target="_blank" class="block w-10 h-10 rounded-[4px] overflow-hidden bg-slate-100 border border-[#dce6d5]">
                                        <img src="{{ $report->image_url }}" alt="Bukti" class="w-full h-full object-cover">
                                    </a>
                                @else
                                    <span class="text-slate-400 text-[11px]">Tanpa foto</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap">
                                @if($report->status === 'resolved')
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#ecf2df] text-[#1a9120] border border-[#dce6d5]">
                                        Selesai Bersih
                                    </span>
                                @elseif($report->status === 'in_progress')
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        Ditangani
                                    </span>
                                @elseif($report->status === 'pending')
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        Menunggu
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-red-50 text-red-600 border border-red-200">
                                        Ditolak
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
                            <td colspan="8" class="py-10 text-center text-[#626f62]">Tidak ada laporan dengan status ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 pt-4 border-t border-[#e7e7e7]">
            {{ $reports->links() }}
        </div>
    </div>

</div>
@endsection
