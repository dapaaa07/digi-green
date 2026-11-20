@extends('layouts.admin')

@section('title', 'Manajemen Laporan Kebersihan | Admin Cupunagara')

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 font-heading">Daftar Laporan Kebersihan</h1>
            <p class="text-xs text-slate-500 mt-0.5">Kelola dan tindak lanjuti laporan sampah dari warga dan wisatawan.</p>
        </div>
        <a href="{{ route('reports.create') }}" target="_blank" class="px-4 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold transition self-start sm:self-auto">
            + Tambah Laporan Manual
        </a>
    </div>

    <!-- Status Tabs -->
    <div class="flex flex-wrap gap-2 text-xs font-semibold">
        <a href="{{ route('admin.reports.index') }}" 
           class="px-3.5 py-2 rounded-xl border transition {{ !request()->filled('status') ? 'bg-slate-900 text-white border-slate-900' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
            Semua ({{ $statusCounts['all'] }})
        </a>
        <a href="{{ route('admin.reports.index', ['status' => 'pending']) }}" 
           class="px-3.5 py-2 rounded-xl border transition {{ request('status') === 'pending' ? 'bg-amber-600 text-white border-amber-600' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
            Menunggu ({{ $statusCounts['pending'] }})
        </a>
        <a href="{{ route('admin.reports.index', ['status' => 'in_progress']) }}" 
           class="px-3.5 py-2 rounded-xl border transition {{ request('status') === 'in_progress' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
            Sedang Ditangani ({{ $statusCounts['in_progress'] }})
        </a>
        <a href="{{ route('admin.reports.index', ['status' => 'resolved']) }}" 
           class="px-3.5 py-2 rounded-xl border transition {{ request('status') === 'resolved' ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
            Selesai Bersih ({{ $statusCounts['resolved'] }})
        </a>
        <a href="{{ route('admin.reports.index', ['status' => 'rejected']) }}" 
           class="px-3.5 py-2 rounded-xl border transition {{ request('status') === 'rejected' ? 'bg-rose-600 text-white border-rose-600' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
            Ditolak ({{ $statusCounts['rejected'] }})
        </a>
    </div>

    <!-- Reports Table Card -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-slate-100 text-slate-400 uppercase font-semibold">
                        <th class="pb-3">Kode Tiket</th>
                        <th class="pb-3">Waktu</th>
                        <th class="pb-3">Kategori</th>
                        <th class="pb-3">Lokasi / Titik</th>
                        <th class="pb-3">Pelapor</th>
                        <th class="pb-3">Foto Bukti</th>
                        <th class="pb-3">Status</th>
                        <th class="pb-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($reports as $report)
                        <tr class="hover:bg-slate-50/50">
                            <td class="py-3.5 font-mono font-bold text-slate-900">{{ $report->ticket_code }}</td>
                            <td class="py-3.5 text-slate-500 whitespace-nowrap">{{ $report->created_at->format('d/m/Y H:i') }}</td>
                            <td class="py-3.5 text-slate-700">{{ $report->category_label }}</td>
                            <td class="py-3.5 text-slate-700 max-w-xs truncate">{{ $report->specific_location }}</td>
                            <td class="py-3.5 text-slate-600">{{ $report->reporter_name }}</td>
                            <td class="py-3.5">
                                @if($report->image_evidence)
                                    <span class="text-emerald-700 font-semibold">Ada Foto</span>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="py-3.5">
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold border {{ $report->status_badge_class }}">
                                    {{ $report->status_label }}
                                </span>
                            </td>
                            <td class="py-3.5 text-right whitespace-nowrap">
                                <a href="{{ route('admin.reports.show', $report) }}" class="px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-800 font-bold hover:bg-emerald-100 transition">
                                    Detail &rarr;
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-8 text-center text-slate-400">Tidak ada laporan dengan filter ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 pt-4 border-t border-slate-100">
            {{ $reports->links() }}
        </div>
    </div>

</div>
@endsection
