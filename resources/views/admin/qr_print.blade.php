<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Stiker Plang Bambu QR Code | Digi-Green Cupunagara</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo-digi-green-pin-icon-transparent.png') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; color: #363C47; }
        h1, h2, h3, h4, .font-heading { font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: -0.035em; color: #0D1117; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }

        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white !important;
                padding: 0 !important;
            }
            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>
<body class="bg-[#F7F8FA] min-h-screen text-[#363C47] p-4 sm:p-8">

    <!-- Control Header (No Print) -->
    <div class="no-print max-w-5xl mx-auto mb-8 bg-white p-6 sm:p-7 rounded-[18px] border border-[#E7EAEF] shadow-[0_1px_3px_rgba(13,17,23,0.05)] flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="pill-label">
                <span class="w-1.5 h-1.5 rounded-full bg-[#087A58]"></span>
                <span>Template Resmi Plang Fisik</span>
            </div>
            <h1 class="text-xl font-extrabold text-[#0D1117] font-heading">Template Cetak Stiker Plang Bambu QR Code</h1>
            <p class="text-xs text-[#5B6472]">Stiker ini dapat dicetak pada kertas vinyl tahan air lalu dilaminasi untuk ditempelkan pada plang bambu di 3 titik kawasan desa.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.dashboard') }}" class="btn-editorial-ghost text-xs py-2.5 px-4">
                &larr; Dashboard
            </a>
            <button onclick="window.print()" class="btn-editorial-primary text-xs py-2.5 px-5 flex items-center gap-2">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z"/></svg>
                <span>Cetak / Simpan PDF</span>
            </button>
        </div>
    </div>

    <!-- Signage Placards Container -->
    <div class="max-w-5xl mx-auto space-y-12">
        @foreach($qrPoints as $index => $qr)
            <div class="bg-white rounded-[26px] border-4 border-[#087A58] p-8 sm:p-10 shadow-lg text-center max-w-xl mx-auto page-break relative overflow-hidden">
                
                <!-- Corner Accents in Emerald -->
                <div class="absolute top-0 left-0 w-8 h-8 border-t-8 border-l-8 border-[#087A58]"></div>
                <div class="absolute top-0 right-0 w-8 h-8 border-t-8 border-r-8 border-[#087A58]"></div>
                <div class="absolute bottom-0 left-0 w-8 h-8 border-b-8 border-l-8 border-[#087A58]"></div>
                <div class="absolute bottom-0 right-0 w-8 h-8 border-b-8 border-r-8 border-[#087A58]"></div>

                <!-- Header with Digi-Green Logo -->
                <div class="border-b-2 border-[#E7EAEF] pb-4 mb-6">
                    <img src="{{ asset('images/logo/logo-digi-green-pin-horizontal-transparent.png') }}" 
                         alt="Digi-Green Logo" 
                         class="h-10 mx-auto object-contain mb-3">
                    <div class="pill-label mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#087A58]"></span>
                        <span>Titik Plang Informasi 0{{ $index + 1 }}</span>
                    </div>
                    <h2 class="text-2xl font-black text-[#0D1117] font-heading tracking-tight">
                        DESA WISATA CUPUNAGARA
                    </h2>
                    <p class="text-xs font-mono font-semibold text-[#087A58] tracking-wider uppercase mt-1">
                        Gerakan Kampung Bebas Sampah & Ekowisata
                    </p>
                </div>

                <!-- Location Highlight -->
                <div class="bg-[#EEFAF5] rounded-[14px] p-4 border border-[#B9E6D6] mb-6">
                    <span class="text-[11px] font-mono text-[#065F43] uppercase tracking-wider block font-medium">Lokasi Plang Ini</span>
                    <h3 class="text-lg font-extrabold text-[#065F43] font-heading mt-0.5">
                        {{ $qrPoint->location_name ?? $qr->location_name }}
                    </h3>
                </div>

                <!-- QR Code Box -->
                <div class="inline-block p-4 bg-white rounded-[18px] border-2 border-[#E7EAEF] shadow-inner mb-6">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=260x260&margin=8&data={{ urlencode(route('qr.show', $qr->code)) }}" 
                         alt="QR Code {{ $qr->location_name }}" 
                         class="w-52 h-52 sm:w-60 sm:h-60 mx-auto object-contain">
                    <span class="text-[11px] font-mono font-bold text-[#697382] mt-2 block uppercase tracking-widest">
                        KODE: {{ $qr->code }}
                    </span>
                </div>

                <!-- Instructions with Gotong Royong Ethos -->
                <div class="text-left bg-[#F7F8FA] rounded-[14px] p-4 border border-[#E7EAEF] mb-6 space-y-2 text-xs">
                    <p class="font-bold text-[#0D1117] font-mono uppercase">
                        Arahkan Kamera HP ke QR Code untuk:
                    </p>
                    <ul class="text-[#5B6472] space-y-1.5 pl-5 list-disc font-medium">
                        <li>Membaca panduan etika & imbauan <strong>Bawa Pulang Sampahmu</strong>.</li>
                        <li><strong>Laporkan tumpukan sampah liar / fasilitas penuh</strong> langsung ke pengelola desa.</li>
                        <li>Petunjuk arah & rute Google Maps ke curug, kebun kopi, & bukit.</li>
                        <li>Katalog produk kopi specialty asli warga Cupunagara.</li>
                    </ul>
                </div>

                <!-- Footer Credential -->
                <div class="text-[10px] font-mono text-[#697382] uppercase tracking-wider border-t border-[#E7EAEF] pt-3 flex items-center justify-between">
                    <span>Kelompok 2 - NalarWarga Politeknik Negeri Subang</span>
                    <span>Desa Cupunagara &bull; Subang</span>
                </div>

            </div>
        @endforeach
    </div>

</body>
</html>
