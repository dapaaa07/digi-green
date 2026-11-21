@extends('layouts.admin')

@section('title', 'Kelola Produk & Kopi | Admin Cupunagara')

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
                <span class="text-[11px] font-bold uppercase tracking-wider text-[#1a9120]">Etalase UMKM</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#07370a] font-heading mt-0.5">Kelola Produk &amp; UMKM</h1>
            <p class="text-xs text-[#626f62] mt-0.5">Atur katalog produk desa (kopi, gula aren, hasil tani &amp; suvenir), harga, ketersediaan, dan nomor WhatsApp.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="grdeen-btn self-start sm:self-auto !py-2.5 !px-5 text-xs">
            <span>+ Tambah Produk</span>
        </a>
    </div>

    <!-- Products Table Card -->
    <div class="bg-white rounded-[10px] p-6 border border-[#dce6d5] shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-[#dce6d5] text-[#07370a] uppercase font-bold text-[11px] tracking-wider bg-[#f6f7f2]">
                        <th class="py-3 px-3">Foto</th>
                        <th class="py-3 px-3">Nama Produk &amp; Ukuran</th>
                        <th class="py-3 px-3">Proses &amp; Sangrai</th>
                        <th class="py-3 px-3">Harga</th>
                        <th class="py-3 px-3">Produsen</th>
                        <th class="py-3 px-3">Status</th>
                        <th class="py-3 px-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e7e7e7]">
                    @forelse($products as $product)
                        <tr class="hover:bg-[#f6f7f2]/60 transition">
                            <td class="py-3.5 px-3">
                                <div class="w-14 h-14 rounded-[4px] overflow-hidden bg-slate-100 border border-[#e7e7e7]">
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="py-3.5 px-3">
                                <strong class="text-[#07370a] block text-xs font-heading font-bold">{{ $product->name }}</strong>
                                <span class="text-[11px] text-[#626f62] font-medium">{{ $product->packaging_size }}</span>
                                @if($product->flavor_notes)
                                    <p class="text-[10px] text-[#1a9120] font-mono mt-0.5">Notes: {{ $product->flavor_notes }}</p>
                                @endif
                                @if($product->is_featured)
                                    <span class="inline-block mt-1 px-1.5 py-0.5 rounded-[3px] bg-[#ecf2df] text-[#1a9120] text-[9px] font-bold uppercase tracking-wider">
                                        Unggulan
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-3">
                                <span class="px-2 py-0.5 rounded-[3px] bg-[#eff6f0] text-[#07370a] font-bold border border-[#dce6d5] block w-fit mb-1">
                                    {{ $product->process_type }}
                                </span>
                                <span class="text-[11px] text-[#626f62]">{{ $product->roast_level }}</span>
                            </td>
                            <td class="py-3.5 px-3 font-mono font-bold text-[#1a9120] text-sm">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-3 text-[#4f5345]">
                                <span class="block font-medium">{{ $product->producer_name }}</span>
                                <span class="text-[10px] text-[#626f62] font-mono">WA: {{ $product->contact_whatsapp }}</span>
                            </td>
                            <td class="py-3.5 px-3">
                                @if($product->is_available)
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#ecf2df] text-[#1a9120] border border-[#dce6d5]">
                                        Tersedia
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-50 text-red-600 border border-red-200">
                                        Stok Habis
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-3 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('coffee.index') }}" target="_blank" 
                                       class="px-2.5 py-1.5 rounded-[4px] bg-[#f6f7f2] border border-[#dce6d5] text-[#07370a] font-bold hover:bg-[#ecf2df] transition text-[11px]">
                                        Etalase ↗
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                       class="px-3 py-1.5 rounded-[4px] bg-[#1a9120] hover:bg-[#07370a] text-white font-bold transition text-[11px]">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk {{ $product->name }}?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1.5 rounded-[4px] bg-red-50 border border-red-200 text-red-700 font-bold hover:bg-red-100 transition text-[11px]">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-10 text-center text-[#626f62]">Belum ada produk kopi atau produk lokal. Silakan tambahkan produk baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 pt-4 border-t border-[#e7e7e7]">
            {{ $products->links() }}
        </div>
    </div>

</div>
@endsection
