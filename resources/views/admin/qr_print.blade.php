<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Resmi | Desa Wisata Cupunagara</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo-digi-green-pin-icon-transparent.png') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400..800;1,9..40,400..800&family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; color: #1e2621; }
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
            .print-container {
                padding: 10mm !important;
                margin: 0 !important;
                max-width: 100% !important;
            }
            .qr-item {
                break-inside: avoid;
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body class="bg-[#f4f7f4] min-h-screen text-[#1e2621] p-4 sm:p-8" x-data="qrViewerManager()">

    <!-- Panel Kontrol & Download (Otomatis Disembunyikan Saat Dicetak) -->
    <div class="no-print max-w-4xl mx-auto mb-8 space-y-4">
        
        <!-- Header Navigasi -->
        <div class="bg-white p-5 sm:p-6 rounded-[14px] border border-[#dce6d5] shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-[4px] bg-[#eff6f0] border border-[#dce6d5] text-[11px] font-bold text-[#1a9120] uppercase tracking-wider mb-1.5">
                    <span class="w-2 h-2 rounded-full bg-[#1a9120]"></span>
                    <span>Admin Panel &bull; QR Code Landing Page</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold text-[#07370a] font-heading tracking-tight">
                    QR Code Resmi Desa Wisata Cupunagara
                </h1>
                <p class="text-xs sm:text-sm text-[#4f5345] mt-0.5">
                    QR Code statis mengarahkan pemindai langsung ke portal resmi: <strong class="text-[#07370a]">{{ $landingUrl }}</strong>
                </p>
            </div>
            
            <div class="flex items-center gap-2.5 shrink-0 w-full sm:w-auto">
                <a href="{{ route('admin.dashboard') }}" 
                   class="inline-flex items-center justify-center px-4 py-2.5 rounded-[8px] border border-[#dce6d5] text-xs font-semibold text-[#07370a] hover:bg-[#eff6f0] transition">
                    &larr; Dashboard
                </a>
                <button type="button" @click="triggerPrint()" 
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-[8px] bg-[#1a9120] hover:bg-[#07370a] text-white text-xs font-bold transition shadow-sm">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z"/></svg>
                    <span>Cetak Lembaran QR</span>
                </button>
            </div>
        </div>

        <!-- Toolbar Download & Pilihan Layout Cetak -->
        <div class="bg-white p-5 sm:p-6 rounded-[14px] border border-[#dce6d5] shadow-sm space-y-5">
            
            <!-- Quick Download & Copy Link -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-4 border-b border-[#e7e7e7]">
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold text-[#07370a] uppercase tracking-wider">Unduh Gambar QR Saja:</span>
                    <a :href="qrPngUrl" download="qrcode-cupunagara.png" target="_blank"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[6px] bg-[#eff6f0] hover:bg-[#1a9120] hover:text-white border border-[#dce6d5] text-xs font-bold text-[#07370a] transition">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                        <span>Download PNG</span>
                    </a>
                    <a :href="qrSvgUrl" download="qrcode-cupunagara.svg" target="_blank"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[6px] bg-[#eff6f0] hover:bg-[#1a9120] hover:text-white border border-[#dce6d5] text-xs font-bold text-[#07370a] transition">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                        <span>Download SVG (Vektor)</span>
                    </a>
                </div>

                <div class="flex items-center gap-2">
                    <button type="button" @click="copyLink()" 
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[6px] border border-[#dce6d5] text-xs font-semibold text-[#4f5345] hover:bg-[#f6f7f2] transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <span x-text="copied ? 'Tersalin!' : 'Salin Tautan'"></span>
                    </button>
                </div>
            </div>

            <!-- Pilihan Jumlah QR untuk Lembar Cetak -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <label class="block text-xs font-bold text-[#07370a] uppercase tracking-wider mb-2">
                        Jumlah QR per Halaman Cetak (Grid):
                    </label>
                    <div class="inline-flex rounded-[8px] border border-[#dce6d5] p-1 bg-[#f4f7f4] gap-1">
                        <button type="button" @click="gridCount = 1" 
                                :class="gridCount === 1 ? 'bg-white shadow-xs text-[#07370a] font-bold' : 'text-[#4f5345] font-medium'"
                                class="px-3 py-1.5 rounded-[6px] text-xs transition">
                            1 QR Besar
                        </button>
                        <button type="button" @click="gridCount = 4" 
                                :class="gridCount === 4 ? 'bg-white shadow-xs text-[#07370a] font-bold' : 'text-[#4f5345] font-medium'"
                                class="px-3 py-1.5 rounded-[6px] text-xs transition">
                            4 QR (2x2)
                        </button>
                        <button type="button" @click="gridCount = 6" 
                                :class="gridCount === 6 ? 'bg-white shadow-xs text-[#07370a] font-bold' : 'text-[#4f5345] font-medium'"
                                class="px-3 py-1.5 rounded-[6px] text-xs transition">
                            6 QR (2x3)
                        </button>
                        <button type="button" @click="gridCount = 9" 
                                :class="gridCount === 9 ? 'bg-white shadow-xs text-[#07370a] font-bold' : 'text-[#4f5345] font-medium'"
                                class="px-3 py-1.5 rounded-[6px] text-xs transition">
                            9 QR (3x3)
                        </button>
                        <button type="button" @click="gridCount = 12" 
                                :class="gridCount === 12 ? 'bg-white shadow-xs text-[#07370a] font-bold' : 'text-[#4f5345] font-medium'"
                                class="px-3 py-1.5 rounded-[6px] text-xs transition">
                            12 QR (3x4)
                        </button>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <label class="flex items-center gap-2 cursor-pointer text-xs font-medium text-[#07370a]">
                        <input type="checkbox" x-model="showUrlLabel" class="rounded text-[#1a9120] focus:ring-[#1a9120]">
                        <span>Tampilkan tulisan <code class="font-mono text-[11px]">cupunagara.my.id</code> di bawah QR</span>
                    </label>
                </div>
            </div>

        </div>
    </div>

    <!-- AREA CETAK MURNI QR (Bersih Tanpa Frame Poster / Paragraf) -->
    <div class="print-container max-w-3xl mx-auto">
        
        <!-- Grid Render QR Murni -->
        <div class="grid gap-6 sm:gap-8 justify-items-center items-center"
             :class="{
                'grid-cols-1': gridCount === 1,
                'grid-cols-2': gridCount === 4 || gridCount === 6,
                'grid-cols-3': gridCount === 9 || gridCount === 12,
             }">
            
            <template x-for="n in gridCount" :key="n">
                <div class="qr-item bg-white p-4 sm:p-5 rounded-[12px] border border-[#e0e0e0] flex flex-col items-center justify-center text-center shadow-xs">
                    
                    <!-- Gambar QR Code Murni -->
                    <img :src="qrPngUrl" 
                         alt="QR Code Desa Wisata Cupunagara" 
                         :class="{
                            'w-72 h-72 sm:w-80 sm:h-80': gridCount === 1,
                            'w-48 h-48 sm:w-56 sm:h-56': gridCount === 4,
                            'w-36 h-36 sm:w-44 sm:h-44': gridCount === 6,
                            'w-28 h-28 sm:w-36 sm:h-36': gridCount === 9,
                            'w-24 h-24 sm:w-28 sm:h-28': gridCount === 12,
                         }"
                         class="object-contain mx-auto">
                    
                    <!-- Label Teks Minimalis (Opsional) -->
                    <template x-if="showUrlLabel">
                        <div class="mt-2 text-center">
                            <span class="block font-mono font-bold text-[#07370a]"
                                  :class="gridCount <= 4 ? 'text-xs sm:text-sm' : 'text-[10px] sm:text-xs'">
                                cupunagara.my.id
                            </span>
                        </div>
                    </template>

                </div>
            </template>

        </div>

    </div>

    <!-- Script Interaktif Alpine.js -->
    <script>
        function qrViewerManager() {
            return {
                gridCount: 1, // Default 1 QR besar, bisa pilih 4, 6, 9, 12
                showUrlLabel: true,
                copied: false,
                landingUrl: @js($landingUrl),
                get qrPngUrl() {
                    return 'https://api.qrserver.com/v1/create-qr-code/?size=500x500&margin=4&data=' + encodeURIComponent(this.landingUrl);
                },
                get qrSvgUrl() {
                    return 'https://api.qrserver.com/v1/create-qr-code/?size=500x500&margin=4&format=svg&data=' + encodeURIComponent(this.landingUrl);
                },
                copyLink() {
                    navigator.clipboard.writeText(this.landingUrl).then(() => {
                        this.copied = true;
                        setTimeout(() => this.copied = false, 2000);
                    });
                },
                triggerPrint() {
                    window.print();
                }
            }
        }
    </script>
</body>
</html>
