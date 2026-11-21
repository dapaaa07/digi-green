<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Stiker Plang QR Code | Desa Wisata Cupunagara</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo-digi-green-pin-icon-transparent.png') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400..800;1,9..40,400..800&family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
    
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
            .print-card-single {
                page-break-after: always;
                break-after: page;
                margin-bottom: 0 !important;
                box-shadow: none !important;
                border: 3px solid #07370a !important;
            }
            .print-page-grid {
                page-break-after: always;
                break-after: page;
                margin-bottom: 0 !important;
            }
            .print-card {
                box-shadow: none !important;
                border: 2px solid #07370a !important;
                break-inside: avoid;
            }
        }
    </style>
</head>
<body class="bg-[#f4f7f4] min-h-screen text-[#1e2621] p-4 sm:p-8" x-data="qrStaticPrintManager()">

    <!-- Control Header & Print Settings Panel (Hidden when printing) -->
    <div class="no-print max-w-4xl mx-auto mb-8 space-y-4">
        
        <!-- Top Navigation Bar -->
        <div class="bg-white p-5 sm:p-6 rounded-[14px] border border-[#dce6d5] shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-[4px] bg-[#eff6f0] border border-[#dce6d5] text-[11px] font-bold text-[#1a9120] uppercase tracking-wider mb-1.5">
                    <span class="w-2 h-2 rounded-full bg-[#1a9120]"></span>
                    <span>Admin Panel &bull; QR Code Statis Landing Page</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold text-[#07370a] font-heading tracking-tight">
                    Cetak Stiker Plang QR Code Resmi
                </h1>
                <p class="text-xs sm:text-sm text-[#4f5345] mt-0.5">
                    QR Code mengarahkan pengunjung dan masyarakat langsung ke portal landing page <strong>cupunagara.my.id</strong>.
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
                    <span>Cetak Sekarang (<span x-text="quantity"></span> Stiker)</span>
                </button>
            </div>
        </div>

        <!-- Quantity & Layout Settings Box -->
        <div class="bg-white p-5 sm:p-6 rounded-[14px] border border-[#dce6d5] shadow-sm space-y-5">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Quantity Selector -->
                <div>
                    <label class="block text-xs font-bold text-[#07370a] uppercase tracking-wider mb-2">
                        Jumlah Stiker yang Ingin Dicetak:
                    </label>
                    <div class="flex items-center gap-3">
                        <div class="inline-flex items-center border-2 border-[#dce6d5] rounded-[8px] overflow-hidden bg-white shadow-xs">
                            <button type="button" 
                                    @click="decreaseQty()" 
                                    class="w-10 h-10 flex items-center justify-center text-base font-bold text-[#07370a] hover:bg-[#eff6f0] transition">
                                -
                            </button>
                            <input type="number" 
                                   min="1" 
                                   max="100" 
                                   x-model.number="quantity" 
                                   class="w-16 h-10 text-center text-sm font-bold text-[#07370a] border-x border-[#dce6d5] focus:outline-none">
                            <button type="button" 
                                    @click="increaseQty()" 
                                    class="w-10 h-10 flex items-center justify-center text-base font-bold text-[#07370a] hover:bg-[#eff6f0] transition">
                                +
                            </button>
                        </div>
                        <div class="flex items-center gap-1.5 flex-wrap">
                            <button type="button" @click="setQty(1)" class="px-2.5 py-1.5 rounded-[6px] border border-[#dce6d5] text-xs font-bold text-[#07370a] hover:bg-[#eff6f0]">1</button>
                            <button type="button" @click="setQty(2)" class="px-2.5 py-1.5 rounded-[6px] border border-[#dce6d5] text-xs font-bold text-[#07370a] hover:bg-[#eff6f0]">2</button>
                            <button type="button" @click="setQty(4)" class="px-2.5 py-1.5 rounded-[6px] border border-[#dce6d5] text-xs font-bold text-[#07370a] hover:bg-[#eff6f0]">4</button>
                            <button type="button" @click="setQty(6)" class="px-2.5 py-1.5 rounded-[6px] border border-[#dce6d5] text-xs font-bold text-[#07370a] hover:bg-[#eff6f0]">6</button>
                            <button type="button" @click="setQty(10)" class="px-2.5 py-1.5 rounded-[6px] border border-[#dce6d5] text-xs font-bold text-[#07370a] hover:bg-[#eff6f0]">10</button>
                        </div>
                    </div>
                    <p class="text-[11px] text-[#626f62] mt-2">
                        Pilih berapa salinan stiker plang yang ingin dicetak dalam satu sesi.
                    </p>
                </div>

                <!-- Layout Mode -->
                <div>
                    <label class="block text-xs font-bold text-[#07370a] uppercase tracking-wider mb-2">
                        Pilihan Ukuran Stiker / Kertas:
                    </label>
                    <div class="grid grid-cols-2 gap-2.5">
                        <label class="p-3 rounded-[8px] border cursor-pointer transition flex items-center gap-2.5"
                               :class="layoutMode === 'single' ? 'bg-[#eff6f0] border-[#1a9120] text-[#07370a] font-bold' : 'bg-white border-[#dce6d5] text-[#4f5345]'">
                            <input type="radio" name="layout" value="single" x-model="layoutMode" class="text-[#1a9120] focus:ring-[#1a9120]">
                            <div>
                                <span class="text-xs block">Plang Besar</span>
                                <span class="text-[10px] text-[#626f62] block font-normal">1 Stiker per Lembar A4</span>
                            </div>
                        </label>
                        <label class="p-3 rounded-[8px] border cursor-pointer transition flex items-center gap-2.5"
                               :class="layoutMode === 'grid2' ? 'bg-[#eff6f0] border-[#1a9120] text-[#07370a] font-bold' : 'bg-white border-[#dce6d5] text-[#4f5345]'">
                            <input type="radio" name="layout" value="grid2" x-model="layoutMode" class="text-[#1a9120] focus:ring-[#1a9120]">
                            <div>
                                <span class="text-xs block">Stiker Sedang</span>
                                <span class="text-[10px] text-[#626f62] block font-normal">2 Stiker per Lembar A4</span>
                            </div>
                        </label>
                    </div>
                    <p class="text-[11px] text-[#626f62] mt-2">
                        Gunakan <em>Plang Besar</em> untuk plang bambu/kayu jalur wisata, atau <em>Stiker Sedang</em> untuk gazebo & meja.
                    </p>
                </div>
            </div>

            <!-- Link Details -->
            <div class="pt-3 border-t border-[#e7e7e7] flex flex-col sm:flex-row sm:items-center justify-between text-xs text-[#4f5345] gap-2">
                <div>
                    Tautan QR Code: <code class="text-[#1a9120] font-bold bg-[#eff6f0] px-2 py-0.5 rounded-[4px] font-mono text-[11px]">{{ $landingUrl }}</code>
                </div>
                <div class="text-[11px] text-[#626f62]">
                    💡 <em>Tips: Gunakan stiker bahan vinyl waterproof agar tahan panas & hujan pegunungan.</em>
                </div>
            </div>

        </div>
    </div>

    <!-- Printable Cards Area: Mode Single (1 card per page) -->
    <template x-if="layoutMode === 'single'">
        <div class="max-w-xl mx-auto space-y-10">
            <template x-for="i in countArray" :key="'single-' + i">
                <div class="print-card-single bg-white rounded-[20px] border-4 border-[#07370a] p-8 sm:p-10 shadow-lg text-center max-w-xl mx-auto relative overflow-hidden">
                    
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
                            <span>Portal Resmi Desa Wisata &bull; Stiker #<span x-text="i"></span></span>
                        </div>

                        <h2 class="text-2xl sm:text-3xl font-black text-[#07370a] font-heading tracking-tight">
                            DESA WISATA CUPUNAGARA
                        </h2>
                        <p class="text-xs font-mono font-semibold text-[#1a9120] tracking-wider uppercase mt-1">
                            Kecamatan Cisalak &bull; Kabupaten Subang &bull; Jawa Barat
                        </p>
                    </div>

                    <!-- QR Code Box -->
                    <div class="inline-block p-4 sm:p-5 bg-white rounded-[16px] border-2 border-[#07370a] shadow-inner mb-6">
                        <img :src="qrImageUrl" 
                             alt="QR Code Desa Wisata Cupunagara" 
                             class="w-60 h-60 mx-auto object-contain">
                        <span class="text-xs font-mono font-black text-[#07370a] mt-3 block uppercase tracking-widest">
                            PINDAI DENGAN KAMERA HP
                        </span>
                        <span class="text-xs font-mono font-bold text-[#1a9120] block mt-0.5">
                            cupunagara.my.id
                        </span>
                    </div>

                    <!-- Instructions / Features List -->
                    <div class="text-left bg-[#fafbf9] rounded-[12px] p-5 border border-[#dce6d5] mb-6 space-y-2.5 text-xs">
                        <p class="font-bold text-[#07370a] font-heading text-sm">
                            📱 Pindai QR Code ini untuk Mengakses:
                        </p>
                        <ul class="text-[#4f5345] space-y-1.5 pl-5 list-disc font-medium leading-relaxed">
                            <li><strong>Peta &amp; Navigasi Wisata Alam:</strong> Titik lokasi Curug Cileat, Bukit Pamoyanan, dan perkebunan kopi.</li>
                            <li><strong>Layanan Lapor Kebersihan:</strong> Laporkan tumpukan sampah liar dan fasilitas desa yang perlu penanganan.</li>
                            <li><strong>Wisata Kuliner:</strong> Informasi Kafe Bukit Cupumanik &amp; Kopi Specialty asli petani Cupunagara.</li>
                        </ul>
                    </div>

                    <!-- Gotong Royong Ethos Banner -->
                    <div class="bg-[#eff6f0] border border-[#dce6d5] rounded-[8px] p-3 text-xs text-[#07370a] font-semibold mb-6">
                        🍃 <strong>Budaya Gotong Royong:</strong> Nikmati keindahan alam Cupunagara, dan bawa kembali sampah kecil pribadi Anda.
                    </div>

                    <!-- Footer Credential -->
                    <div class="text-[10px] font-mono text-[#626f62] uppercase tracking-wider border-t border-[#e7e7e7] pt-3 flex items-center justify-between">
                        <span>NalarWarga Politeknik Negeri Subang</span>
                        <span>Desa Cupunagara &bull; Subang</span>
                    </div>

                </div>
            </template>
        </div>
    </template>

    <!-- Printable Cards Area: Mode Grid2 (2 cards per A4 sheet) -->
    <template x-if="layoutMode === 'grid2'">
        <div class="max-w-4xl mx-auto grid grid-cols-1 sm:grid-cols-2 gap-6 print:grid-cols-2 print:gap-4">
            <template x-for="i in countArray" :key="'grid2-' + i">
                <div class="print-card bg-white rounded-[16px] border-2 border-[#07370a] p-6 shadow-md text-center relative overflow-hidden flex flex-col justify-between">
                    
                    <div>
                        <!-- Header -->
                        <div class="border-b border-[#e7e7e7] pb-3 mb-4">
                            <img src="{{ asset('images/logo/logo-digi-green-pin-horizontal-transparent.png') }}" 
                                 onerror="this.onerror=null; this.src='/images/logo/logo-digi-green-pin-horizontal-transparent.png';"
                                 alt="Digi-Green Logo" 
                                 class="h-7 mx-auto object-contain mb-2">
                            
                            <h2 class="text-lg font-black text-[#07370a] font-heading tracking-tight leading-tight">
                                DESA WISATA CUPUNAGARA
                            </h2>
                            <p class="text-[10px] font-mono font-semibold text-[#1a9120] uppercase mt-0.5">
                                Portal Ekowisata &amp; Kebersihan Lingkungan
                            </p>
                        </div>

                        <!-- QR Code -->
                        <div class="inline-block p-3 bg-white rounded-[12px] border border-[#07370a] shadow-xs mb-4">
                            <img :src="qrImageUrl" 
                                 alt="QR Code Desa Wisata Cupunagara" 
                                 class="w-44 h-44 mx-auto object-contain">
                            <span class="text-[11px] font-mono font-bold text-[#07370a] mt-2 block uppercase">
                                Pindai dengan Kamera HP
                            </span>
                            <span class="text-[11px] font-mono font-bold text-[#1a9120] block">
                                cupunagara.my.id
                            </span>
                        </div>

                        <!-- Highlights -->
                        <div class="text-left bg-[#eff6f0] rounded-[8px] p-3 border border-[#dce6d5] mb-3 text-[11px] text-[#07370a] space-y-1">
                            <p class="font-bold">📱 Akses Langsung:</p>
                            <p>&bull; Navigasi Wisata Curug &amp; Bukit</p>
                            <p>&bull; Lapor Sampah Liar &amp; Fasilitas Rusak</p>
                            <p>&bull; Kafe Bukit Cupumanik &amp; Kopi Lokal</p>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="text-[9px] font-mono text-[#626f62] border-t border-[#e7e7e7] pt-2 flex items-center justify-between">
                        <span>Desa Cupunagara, Subang</span>
                        <span>Stiker #<span x-text="i"></span></span>
                    </div>

                </div>
            </template>
        </div>
    </template>

    <!-- Alpine.js Manager Script -->
    <script>
        function qrStaticPrintManager() {
            return {
                quantity: 4,
                layoutMode: 'single', // 'single' atau 'grid2'
                landingUrl: @js($landingUrl),
                get qrImageUrl() {
                    return 'https://api.qrserver.com/v1/create-qr-code/?size=350x350&margin=8&data=' + encodeURIComponent(this.landingUrl);
                },
                get countArray() {
                    const q = Math.max(1, Math.min(100, parseInt(this.quantity) || 1));
                    return Array.from({ length: q }, (_, i) => i + 1);
                },
                setQty(val) {
                    this.quantity = val;
                },
                increaseQty() {
                    if (this.quantity < 100) this.quantity++;
                },
                decreaseQty() {
                    if (this.quantity > 1) this.quantity--;
                },
                triggerPrint() {
                    window.print();
                }
            }
        }
    </script>
</body>
</html>
