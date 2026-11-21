<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Stiker Plang Bambu QR Code | Digi-Green Cupunagara</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo-digi-green-pin-icon-transparent.png') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400..800;1,9..40,400..800&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; color: #1e2621; }
        h1, h2, h3, h4, .font-heading { font-family: 'DM Sans', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }

        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .page-break {
                page-break-after: always;
                break-after: page;
            }
            .print-card {
                box-shadow: none !important;
                border: 3px solid #07370a !important;
                margin: 0 auto 2.5rem auto !important;
                max-width: 100% !important;
                page-break-inside: avoid;
                break-inside: avoid;
            }
        }
    </style>
</head>
<body class="bg-[#f4f7f4] min-h-screen text-[#1e2621] p-4 sm:p-8" x-data="qrPrintManager()">

    <!-- Control Header & Print Settings Panel (Hidden when printing) -->
    <div class="no-print max-w-5xl mx-auto mb-8 space-y-4">
        
        <!-- Top Navigation -->
        <div class="bg-white p-5 sm:p-6 rounded-[14px] border border-[#dce6d5] shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-[4px] bg-[#eff6f0] border border-[#dce6d5] text-[11px] font-bold text-[#1a9120] uppercase tracking-wider mb-1.5">
                    <span class="w-2 h-2 rounded-full bg-[#1a9120]"></span>
                    <span>Admin Panel &bull; Plang Fisik Bambu</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold text-[#07370a] font-heading tracking-tight">
                    Template Cetak Stiker Plang Bambu QR Code
                </h1>
                <p class="text-xs sm:text-sm text-[#4f5345] mt-0.5">
                    Tentukan jumlah salinan stiker yang ingin dicetak untuk masing-masing titik plang sebelum mencetak atau menyimpan sebagai PDF.
                </p>
            </div>
            <div class="flex items-center gap-3 shrink-0 w-full sm:w-auto">
                <a href="{{ route('admin.dashboard') }}" 
                   class="inline-flex items-center justify-center px-4 py-2.5 rounded-[8px] border border-[#dce6d5] text-xs font-semibold text-[#07370a] hover:bg-[#eff6f0] transition w-1/2 sm:w-auto">
                    &larr; Dashboard
                </a>
                <button @click="triggerPrint()" 
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-[8px] bg-[#1a9120] hover:bg-[#07370a] text-white text-xs font-bold transition shadow-sm w-1/2 sm:w-auto">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z"/></svg>
                    <span>Cetak Sekarang (<span x-text="totalPrints"></span> Lembar)</span>
                </button>
            </div>
        </div>

        <!-- Quantity & Target Customization Box -->
        <div class="bg-white p-5 sm:p-6 rounded-[14px] border border-[#dce6d5] shadow-sm space-y-5">
            
            <!-- Quick Bulk Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-[#e7e7e7]">
                <div class="flex items-center gap-3 flex-wrap">
                    <span class="text-xs font-bold text-[#07370a] uppercase tracking-wider">Aksi Cepat Semua:</span>
                    <div class="inline-flex items-center border border-[#dce6d5] rounded-[6px] overflow-hidden bg-[#eff6f0]">
                        <span class="text-xs text-[#4f5345] px-3 font-medium">Set semua titik:</span>
                        <input type="number" 
                               min="1" 
                               max="50" 
                               x-model.number="bulkQty" 
                               class="w-16 py-1.5 px-2 text-center text-xs font-bold text-[#07370a] border-l border-r border-[#dce6d5] focus:outline-none bg-white">
                        <button type="button" 
                                @click="applyBulkQuantity()" 
                                class="px-3 py-1.5 text-xs font-bold text-white bg-[#1a9120] hover:bg-[#07370a] transition">
                            Terapkan
                        </button>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <button type="button" @click="selectAll()" class="text-xs font-semibold text-[#1a9120] hover:underline px-2 py-1">
                        Pilih Semua
                    </button>
                    <span class="text-[#dce6d5]">&bull;</span>
                    <button type="button" @click="deselectAll()" class="text-xs font-semibold text-[#8b3a2b] hover:underline px-2 py-1">
                        Hapus Semua
                    </button>
                </div>
            </div>

            <!-- Per Point Cards Selector -->
            <div>
                <label class="block text-xs font-bold text-[#07370a] uppercase tracking-wider mb-3">
                    Pilih Titik Plang &amp; Tentukan Jumlah Lembar Cetak:
                </label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5">
                    <template x-for="(point, idx) in points" :key="point.id">
                        <div class="p-3.5 rounded-[10px] border transition"
                             :class="point.selected ? 'bg-[#eff6f0] border-[#1a9120]/40 shadow-xs' : 'bg-white border-[#e7e7e7] opacity-60'">
                            
                            <div class="flex items-start gap-2.5">
                                <input type="checkbox" 
                                       :id="'pt-' + point.id" 
                                       x-model="point.selected" 
                                       class="mt-1 h-4 w-4 rounded text-[#1a9120] focus:ring-[#1a9120] border-[#dce6d5]">
                                <div class="flex-1 min-w-0">
                                    <label :for="'pt-' + point.id" class="text-xs font-bold text-[#07370a] block truncate cursor-pointer" x-text="point.location_name"></label>
                                    <span class="text-[10px] font-mono text-[#626f62] block uppercase" x-text="point.code"></span>
                                </div>
                            </div>

                            <div class="mt-3 pt-2.5 border-t border-[#dce6d5]/70 flex items-center justify-between" x-show="point.selected">
                                <span class="text-[11px] font-medium text-[#4f5345]">Jumlah cetak:</span>
                                <div class="inline-flex items-center border border-[#dce6d5] rounded-[6px] overflow-hidden bg-white shadow-xs">
                                    <button type="button" 
                                            @click="decreaseQty(point)" 
                                            class="w-7 h-7 flex items-center justify-center text-xs font-bold text-[#07370a] hover:bg-[#eff6f0] transition">
                                        -
                                    </button>
                                    <input type="number" 
                                           min="1" 
                                           max="50" 
                                           x-model.number="point.quantity" 
                                           class="w-12 h-7 text-center text-xs font-bold text-[#07370a] border-x border-[#dce6d5] focus:outline-none">
                                    <button type="button" 
                                            @click="increaseQty(point)" 
                                            class="w-7 h-7 flex items-center justify-center text-xs font-bold text-[#07370a] hover:bg-[#eff6f0] transition">
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Footer summary inside box -->
            <div class="pt-3 border-t border-[#e7e7e7] flex flex-col sm:flex-row items-start sm:items-center justify-between text-xs text-[#4f5345] gap-2">
                <div>
                    Status: <strong class="text-[#07370a]" x-text="selectedCount"></strong> dari <strong class="text-[#07370a]" x-text="points.length"></strong> titik dipilih.
                    Total stiker yang akan dicetak: <strong class="text-[#1a9120] text-sm" x-text="totalPrints + ' Lembar'"></strong>.
                </div>
                <div class="text-[11px] text-[#626f62]">
                    💡 <em>Tips: Gunakan kertas stiker vinyl tahan air dan laminasi doff/glossy untuk daya tahan maksimal di cuaca pegunungan.</em>
                </div>
            </div>

        </div>
    </div>

    <!-- Printable Cards Area (Rendered dynamically based on copies selected) -->
    <div class="max-w-xl mx-auto space-y-12">
        <template x-for="(card, cardIdx) in printableCards" :key="cardIdx">
            <div class="print-card bg-white rounded-[20px] border-4 border-[#07370a] p-8 sm:p-10 shadow-lg text-center max-w-xl mx-auto page-break relative overflow-hidden">
                
                <!-- Corner Accents in Jadesta Nature Green -->
                <div class="absolute top-0 left-0 w-8 h-8 border-t-8 border-l-8 border-[#1a9120]"></div>
                <div class="absolute top-0 right-0 w-8 h-8 border-t-8 border-r-8 border-[#1a9120]"></div>
                <div class="absolute bottom-0 left-0 w-8 h-8 border-b-8 border-l-8 border-[#1a9120]"></div>
                <div class="absolute bottom-0 right-0 w-8 h-8 border-b-8 border-r-8 border-[#1a9120]"></div>

                <!-- Header with Digi-Green Logo -->
                <div class="border-b-2 border-[#e7e7e7] pb-4 mb-6">
                    <img src="{{ asset('images/logo/logo-digi-green-pin-horizontal-transparent.png') }}" 
                         onerror="this.onerror=null; this.src='/images/logo/logo-digi-green-pin-horizontal-transparent.png';"
                         alt="Digi-Green Logo" 
                         class="h-10 mx-auto object-contain mb-3">
                    
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-[4px] bg-[#eff6f0] border border-[#dce6d5] text-[11px] font-bold text-[#1a9120] uppercase tracking-wider mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#1a9120]"></span>
                        <span>Titik Plang Informasi 0<span x-text="card.pointIndex"></span></span>
                        <template x-if="card.totalCopies > 1">
                            <span class="text-[10px] text-[#07370a] font-mono border-l border-[#dce6d5] pl-1.5">
                                [Salinan <span x-text="card.copyNumber"></span>/<span x-text="card.totalCopies"></span>]
                            </span>
                        </template>
                    </div>

                    <h2 class="text-2xl font-black text-[#07370a] font-heading tracking-tight">
                        DESA WISATA CUPUNAGARA
                    </h2>
                    <p class="text-xs font-mono font-semibold text-[#1a9120] tracking-wider uppercase mt-1">
                        Gerakan Gotong Royong Kebersihan &amp; Ekowisata
                    </p>
                </div>

                <!-- Location Highlight -->
                <div class="bg-[#eff6f0] rounded-[10px] p-4 border border-[#dce6d5] mb-6">
                    <span class="text-[11px] font-mono text-[#1a9120] uppercase tracking-wider block font-bold">Lokasi Plang Ini</span>
                    <h3 class="text-xl font-black text-[#07370a] font-heading mt-0.5" x-text="card.location_name"></h3>
                </div>

                <!-- QR Code Box -->
                <div class="inline-block p-4 bg-white rounded-[14px] border-2 border-[#dce6d5] shadow-inner mb-6">
                    <img :src="card.qr_image" 
                         :alt="'QR Code ' + card.location_name" 
                         class="w-56 h-56 mx-auto object-contain">
                    <span class="text-xs font-mono font-bold text-[#07370a] mt-2.5 block uppercase tracking-widest" x-text="'KODE: ' + card.code"></span>
                    <span class="text-[10px] font-mono text-[#626f62] block mt-0.5" x-text="card.qr_url"></span>
                </div>

                <!-- Instructions with Gotong Royong Ethos -->
                <div class="text-left bg-[#fafbf9] rounded-[10px] p-4 border border-[#dce6d5] mb-6 space-y-2 text-xs">
                    <p class="font-bold text-[#07370a] font-mono uppercase tracking-wide">
                        Arahkan Kamera HP ke QR Code untuk:
                    </p>
                    <ul class="text-[#4f5345] space-y-1.5 pl-5 list-disc font-medium">
                        <li>Membaca panduan etika &amp; imbauan <strong>Bawa Pulang Sampahmu</strong>.</li>
                        <li><strong>Laporkan tumpukan sampah liar / fasilitas penuh</strong> langsung ke pengelola desa.</li>
                        <li>Petunjuk arah &amp; rute Google Maps ke curug, kebun kopi, &amp; bukit.</li>
                        <li>Katalog produk kopi specialty asli warga Cupunagara.</li>
                    </ul>
                </div>

                <!-- Footer Credential -->
                <div class="text-[10px] font-mono text-[#626f62] uppercase tracking-wider border-t border-[#e7e7e7] pt-3 flex items-center justify-between">
                    <span>NalarWarga Politeknik Negeri Subang</span>
                    <span>Desa Cupunagara &bull; Subang</span>
                </div>

            </div>
        </template>

        <!-- Fallback if no cards selected -->
        <template x-if="printableCards.length === 0">
            <div class="no-print bg-white p-8 rounded-[12px] border border-[#dce6d5] text-center space-y-3">
                <p class="text-sm font-semibold text-[#8b3a2b]">Tidak ada titik plang yang dipilih untuk dicetak.</p>
                <button type="button" @click="selectAll()" class="text-xs font-bold text-[#1a9120] underline">
                    Klik di sini untuk memilih semua titik
                </button>
            </div>
        </template>
    </div>

    <!-- Alpine.js Manager Script -->
    <script>
        function qrPrintManager() {
            return {
                bulkQty: 1,
                points: [
                    @foreach($qrPoints as $index => $qr)
                    {
                        id: {{ $qr->id }},
                        pointIndex: {{ $index + 1 }},
                        code: @js($qr->code),
                        location_name: @js($qr->location_name),
                        description: @js($qr->description),
                        cleaning_guide: @js($qr->cleaning_guide),
                        qr_url: @js(route('qr.show', $qr->code)),
                        qr_image: 'https://api.qrserver.com/v1/create-qr-code/?size=260x260&margin=8&data=' + encodeURIComponent(@js(route('qr.show', $qr->code))),
                        selected: true,
                        quantity: 1
                    },
                    @endforeach
                ],
                applyBulkQuantity() {
                    const q = Math.max(1, Math.min(50, parseInt(this.bulkQty) || 1));
                    this.points.forEach(p => {
                        p.quantity = q;
                        p.selected = true;
                    });
                },
                selectAll() {
                    this.points.forEach(p => p.selected = true);
                },
                deselectAll() {
                    this.points.forEach(p => p.selected = false);
                },
                increaseQty(point) {
                    if (point.quantity < 50) point.quantity++;
                },
                decreaseQty(point) {
                    if (point.quantity > 1) point.quantity--;
                },
                get selectedCount() {
                    return this.points.filter(p => p.selected).length;
                },
                get totalPrints() {
                    return this.points.reduce((total, p) => {
                        return total + (p.selected ? (Math.max(1, parseInt(p.quantity) || 1)) : 0);
                    }, 0);
                },
                get printableCards() {
                    const cards = [];
                    this.points.forEach(p => {
                        if (p.selected) {
                            const count = Math.max(1, parseInt(p.quantity) || 1);
                            for (let i = 1; i <= count; i++) {
                                cards.push({
                                    ...p,
                                    copyNumber: i,
                                    totalCopies: count
                                });
                            }
                        }
                    });
                    return cards;
                },
                triggerPrint() {
                    if (this.totalPrints === 0) {
                        alert('Silakan pilih minimal 1 titik plang untuk dicetak.');
                        return;
                    }
                    window.print();
                }
            }
        }
    </script>
</body>
</html>
