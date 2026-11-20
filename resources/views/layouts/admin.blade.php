<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel | Digi-Green Desa Cupunagara')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo-digi-green-pin-icon-transparent.png') }}">
    
    <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; color: #363C47; }
        h1, h2, h3, h4, .font-heading { font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: -0.035em; color: #0D1117; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body class="bg-[#F7F8FA] text-[#363C47] antialiased min-h-screen flex flex-col">

    <!-- Top Admin Header (72px Sticky Bar) -->
    <header class="bg-white border-b border-[#E7EAEF] sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 flex items-center justify-between h-[72px]">
            <div class="flex items-center gap-8">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo/logo-digi-green-pin-horizontal-transparent.png') }}" 
                         alt="Digi-Green Admin" 
                         class="h-9 w-auto object-contain">
                    <span class="hidden sm:inline-block px-2.5 py-0.5 rounded-full text-[10px] font-mono font-medium tracking-wider uppercase bg-[#EEFAF5] text-[#065F43] border border-[#B9E6D6]">
                        Pengelola
                    </span>
                </a>

                <nav class="hidden md:flex items-center gap-6 text-[13px] font-semibold text-[#5B6472]">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#087A58] transition {{ request()->routeIs('admin.dashboard') ? 'text-[#087A58] font-bold' : '' }}">Dashboard</a>
                    <a href="{{ route('admin.reports.index') }}" class="hover:text-[#087A58] transition {{ request()->routeIs('admin.reports.*') ? 'text-[#087A58] font-bold' : '' }}">Laporan Kebersihan</a>
                    <a href="{{ route('admin.destinations.index') }}" class="hover:text-[#087A58] transition {{ request()->routeIs('admin.destinations.*') ? 'text-[#087A58] font-bold' : '' }}">Kelola Tempat Wisata</a>
                    <a href="{{ route('admin.qr.print') }}" target="_blank" class="hover:text-[#087A58] transition">Cetak QR Plang</a>
                    <a href="{{ route('home') }}" target="_blank" class="text-[#697382] hover:text-[#0D1117] transition flex items-center gap-1 font-mono text-xs">
                        Lihat Web ↗
                    </a>
                </nav>
            </div>

            <!-- User Menu & Logout -->
            <div class="flex items-center gap-3">
                <span class="text-xs text-[#5B6472] hidden sm:inline-block">Halo, <strong>{{ Auth::user()->name ?? 'Pengelola' }}</strong></span>
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-1.5 rounded-full text-xs font-semibold text-[#D61F26] bg-[#FDF2F2] hover:bg-[#FDE8E8] border border-[#F8B4B4] transition">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Admin Content Area -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-5 sm:px-8 py-8">
        @if(session('success'))
            <div class="mb-6 p-4 rounded-[14px] bg-[#EEFAF5] border border-[#B9E6D6] text-[#065F43] text-xs font-semibold flex items-center gap-2">
                <span class="font-bold">Berhasil:</span> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded-[14px] bg-[#FDF2F2] border border-[#F8B4B4] text-[#D61F26] text-xs font-semibold flex items-center gap-2">
                <span class="font-bold">Perhatian:</span> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Admin Footer -->
    <footer class="bg-white border-t border-[#E7EAEF] py-4 text-center text-xs text-[#697382] font-mono">
        Digi-Green Cupunagara &bull; Panel Administrasi &amp; Penanganan Lapangan
    </footer>

    @stack('scripts')
</body>
</html>
