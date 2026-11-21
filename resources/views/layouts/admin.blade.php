<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel | Digi-Green Desa Cupunagara')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo-digi-green-pin-icon-transparent.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/logo-digi-green-pin-icon-transparent.png') }}">
    
    <!-- Google Fonts: DM Sans (Headings ala Jadesta Kemenpar) + Inter (Body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400..800;1,9..40,400..800&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
    
    <!-- Leaflet CSS for Map Coordinate Pickers & Previews -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; color: #4f5345; }
        h1, h2, h3, h4, .font-heading { font-family: 'DM Sans', sans-serif; color: #07370a; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body class="bg-[#eff6f0] text-[#4f5345] antialiased min-h-screen flex flex-col">

    <!-- Top Admin Header (72px Sticky Bar ala Jadesta Kemenpar) -->
    <header class="bg-white border-b border-[#dce6d5] sticky top-0 z-40 shadow-[0_2px_12px_rgba(23,32,0,0.04)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-[72px]">
            <div class="flex items-center gap-6 lg:gap-8">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 shrink-0">
                    <img src="{{ asset('images/logo/logo-digi-green-pin-horizontal-transparent.png') }}" 
                         alt="Digi-Green Admin" 
                         class="h-8 sm:h-9 w-auto object-contain">
                    <span class="hidden sm:inline-block px-2.5 py-0.5 rounded-[4px] text-[10px] font-mono font-bold tracking-wider uppercase bg-[#ecf2df] text-[#1a9120] border border-[#dce6d5]">
                        Pengelola
                    </span>
                </a>

                <nav class="hidden md:flex items-center gap-1 sm:gap-2 text-xs font-bold text-[#626f62]">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="px-3 py-2 rounded-[6px] transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#ecf2df] text-[#07370a] font-extrabold' : 'hover:text-[#1a9120] hover:bg-[#f6f7f2]' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.reports.index') }}" 
                       class="px-3 py-2 rounded-[6px] transition {{ request()->routeIs('admin.reports.*') ? 'bg-[#ecf2df] text-[#07370a] font-extrabold' : 'hover:text-[#1a9120] hover:bg-[#f6f7f2]' }}">
                        Laporan Kebersihan
                    </a>
                    <a href="{{ route('admin.destinations.index') }}" 
                       class="px-3 py-2 rounded-[6px] transition {{ request()->routeIs('admin.destinations.*') ? 'bg-[#ecf2df] text-[#07370a] font-extrabold' : 'hover:text-[#1a9120] hover:bg-[#f6f7f2]' }}">
                        Kelola Wisata
                    </a>
                    <a href="{{ route('admin.products.index') }}" 
                       class="px-3 py-2 rounded-[6px] transition {{ request()->routeIs('admin.products.*') ? 'bg-[#ecf2df] text-[#07370a] font-extrabold' : 'hover:text-[#1a9120] hover:bg-[#f6f7f2]' }}">
                        Kelola Produk Kopi
                    </a>
                    <a href="{{ route('admin.qr.print') }}" target="_blank" 
                       class="px-3 py-2 rounded-[6px] transition hover:text-[#1a9120] hover:bg-[#f6f7f2]">
                        Cetak QR Plang
                    </a>
                    <a href="{{ route('home') }}" target="_blank" 
                       class="px-3 py-2 rounded-[6px] text-[#1a9120] hover:bg-[#ecf2df] transition flex items-center gap-1 font-mono text-xs">
                        Lihat Web ↗
                    </a>
                </nav>
            </div>

            <!-- User Menu & Logout -->
            <div class="flex items-center gap-3">
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-3.5 py-1.5 rounded-[6px] text-xs font-bold text-red-700 bg-red-50 hover:bg-red-100 border border-red-200 transition">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Admin Content Area -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="mb-6 p-4 rounded-[8px] bg-white border-l-4 border-[#1a9120] shadow-sm text-[#07370a] text-xs font-medium flex items-center gap-3">
                <span class="w-6 h-6 rounded-full bg-[#ecf2df] text-[#1a9120] flex items-center justify-center font-bold shrink-0">&check;</span>
                <div>
                    <strong class="font-bold">Berhasil:</strong> {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded-[8px] bg-white border-l-4 border-red-500 shadow-sm text-red-800 text-xs font-medium flex items-center gap-3">
                <span class="w-6 h-6 rounded-full bg-red-100 text-red-600 flex items-center justify-center font-bold shrink-0">&times;</span>
                <div>
                    <strong class="font-bold">Perhatian:</strong> {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Admin Footer -->
    <footer class="bg-white border-t border-[#dce6d5] py-4 text-center text-xs text-[#626f62]">
        Digi-Green Cupunagara &bull; Panel Administrasi Desa Wisata &amp; Penanganan Gotong Royong
    </footer>

    <!-- Leaflet JS for Maps -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    @stack('scripts')
</body>
</html>
