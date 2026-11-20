<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jejaring Desa Wisata Cupunagara | Ekowisata Alam & Sentra Kopi Subang')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo-digi-green-pin-icon-transparent.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/logo-digi-green-pin-icon-transparent.png') }}">
    <meta name="description" content="@yield('meta_description', 'Portal Jejaring Desa Wisata Cupunagara, Kecamatan Cisalak, Kabupaten Subang. Temukan informasi wisata alam, produk kopi Canggah, peta sebaran, dan gerakan gotong royong kebersihan desa.')">
    
    <!-- Google Fonts: DM Sans (Headings ala Jadesta Kemenpar) + Inter (Body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400..800;1,9..40,400..800&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-white text-[#626f62] antialiased flex flex-col min-h-screen">

    <!-- Jadesta Main Header (Single-line clean navigation) -->
    <header x-data="{ mobileMenuOpen: false, scrolled: false }" 
            @scroll.window="scrolled = (window.pageYOffset > 10)"
            :class="scrolled ? 'bg-white/95 backdrop-blur-sm shadow-[0_3px_18px_rgba(23,32,0,0.08)]' : 'bg-white border-b border-[#e7e7e7]'"
            class="sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-[72px] gap-4">
                
                <!-- Left: Official Digi-Green Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0 group focus:outline-none">
                    <img src="{{ asset('images/logo/logo-digi-green-pin-horizontal-transparent.png') }}" 
                         alt="Digi-Green Desa Wisata Cupunagara" 
                         class="h-9 sm:h-10 w-auto object-contain transition-transform duration-200 group-hover:scale-[1.02]">
                    <div class="hidden sm:block border-l border-[#e7e7e7] pl-3 py-0.5 whitespace-nowrap">
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-[#1a9120] leading-tight">Jejaring Desa Wisata</span>
                        <span class="block text-sm font-bold text-[#07370a] font-heading leading-tight">Desa Cupunagara</span>
                    </div>
                </a>

                <!-- Center: Single-Line Navigation Links -->
                <nav class="hidden lg:flex items-center gap-7 text-[14px] font-semibold text-[#07370a]">
                    <a href="{{ route('home') }}" 
                       class="whitespace-nowrap hover:text-[#1a9120] transition py-2 relative {{ request()->routeIs('home') ? 'text-[#1a9120] font-bold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:right-0 after:h-[2px] after:bg-[#1a9120]' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('destinations.index') }}" 
                       class="whitespace-nowrap hover:text-[#1a9120] transition py-2 relative {{ request()->routeIs('destinations.*') ? 'text-[#1a9120] font-bold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:right-0 after:h-[2px] after:bg-[#1a9120]' : '' }}">
                        Wisata
                    </a>
                    <a href="{{ route('coffee.index') }}" 
                       class="whitespace-nowrap hover:text-[#1a9120] transition py-2 relative {{ request()->routeIs('coffee.*') ? 'text-[#1a9120] font-bold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:right-0 after:h-[2px] after:bg-[#1a9120]' : '' }}">
                        Produk
                    </a>
                    <a href="{{ route('home') }}#peta-sebaran" 
                       class="whitespace-nowrap hover:text-[#1a9120] transition py-2">
                        Peta
                    </a>
                    <a href="{{ route('reports.index') }}" 
                       class="whitespace-nowrap hover:text-[#1a9120] transition py-2 relative {{ request()->routeIs('reports.index') ? 'text-[#1a9120] font-bold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:right-0 after:h-[2px] after:bg-[#1a9120]' : '' }}">
                        Kebersihan
                    </a>
                    <a href="{{ route('articles.index') }}" 
                       class="whitespace-nowrap hover:text-[#1a9120] transition py-2 relative {{ request()->routeIs('articles.*') ? 'text-[#1a9120] font-bold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:right-0 after:h-[2px] after:bg-[#1a9120]' : '' }}">
                        Berita
                    </a>
                </nav>

                <!-- Right: Compact Lapor Kebersihan Button (Active dark #172000 on /lapor) -->
                <div class="hidden md:flex items-center shrink-0">
                    <a href="{{ route('reports.create') }}" 
                       class="grdeen-btn !py-2.5 !px-5 !text-[12px] !rounded-[10px] {{ request()->routeIs('reports.create') ? 'grdeen-btn--active' : '' }}">
                        <span>Lapor Kebersihan</span>
                    </a>
                </div>

                <!-- Mobile Hamburger Button -->
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="lg:hidden p-2 rounded-[8px] text-[#07370a] hover:bg-[#f2f4ec] border border-[#e7e7e7] transition focus:outline-none"
                        aria-label="Buka Menu Navigasi">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Drawer -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200" 
             x-transition:enter-start="opacity-0 -translate-y-2" 
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150" 
             x-transition:leave-start="opacity-100 translate-y-0" 
             x-transition:leave-end="opacity-0 -translate-y-2"
             x-cloak @click.away="mobileMenuOpen = false" 
             class="lg:hidden border-t border-[#e7e7e7] bg-[#07370a] text-white px-6 pt-4 pb-7 space-y-2 shadow-xl">
            <a href="{{ route('home') }}" class="block px-4 py-3 rounded-[8px] text-sm font-semibold {{ request()->routeIs('home') ? 'bg-[#1a9120] text-white font-bold' : 'text-white/90 hover:bg-white/10' }}">Home</a>
            <a href="{{ route('destinations.index') }}" class="block px-4 py-3 rounded-[8px] text-sm font-semibold {{ request()->routeIs('destinations.*') ? 'bg-[#1a9120] text-white font-bold' : 'text-white/90 hover:bg-white/10' }}">Wisata</a>
            <a href="{{ route('coffee.index') }}" class="block px-4 py-3 rounded-[8px] text-sm font-semibold {{ request()->routeIs('coffee.*') ? 'bg-[#1a9120] text-white font-bold' : 'text-white/90 hover:bg-white/10' }}">Produk</a>
            <a href="{{ route('home') }}#peta-sebaran" @click="mobileMenuOpen = false" class="block px-4 py-3 rounded-[8px] text-sm font-semibold text-white/90 hover:bg-white/10">Peta</a>
            <a href="{{ route('reports.index') }}" class="block px-4 py-3 rounded-[8px] text-sm font-semibold {{ request()->routeIs('reports.index') ? 'bg-[#1a9120] text-white font-bold' : 'text-white/90 hover:bg-white/10' }}">Kebersihan</a>
            <a href="{{ route('articles.index') }}" class="block px-4 py-3 rounded-[8px] text-sm font-semibold {{ request()->routeIs('articles.*') ? 'bg-[#1a9120] text-white font-bold' : 'text-white/90 hover:bg-white/10' }}">Berita</a>
            
            <div class="pt-4 mt-2 border-t border-white/15">
                <a href="{{ route('reports.create') }}" class="block w-full text-center py-3 rounded-[10px] text-xs font-bold uppercase tracking-wider transition {{ request()->routeIs('reports.create') ? 'bg-[#172000] text-white border border-white/25' : 'text-[#07370a] bg-[#faf8ec] hover:bg-white' }}">
                    Lapor Kebersihan
                </a>
            </div>
        </div>
    </header>

    <!-- Flash Notifications -->
    @if(session('success') || session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-5 w-full">
            @if(session('success'))
                <div class="p-4 rounded-[8px] bg-[#edf5ee] border-l-4 border-[#1a9120] text-[#07370a] flex items-start gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-[#1a9120] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="text-sm font-medium leading-relaxed">{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 rounded-[8px] bg-red-50 border-l-4 border-red-600 text-red-900 flex items-start gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-red-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="text-sm font-medium leading-relaxed">{{ session('error') }}</div>
                </div>
            @endif
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Jadesta Dark Forest Footer -->
    <footer class="bg-[#0d190e] text-[#d6dfd6] mt-20 border-t-4 border-[#1a9120]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10">
                
                <!-- Col 1: Logo & Village Identity (4 cols) -->
                <div class="lg:col-span-4 space-y-4">
                    <div class="inline-flex items-center gap-3 bg-white/95 px-4 py-2.5 rounded-[8px]">
                        <img src="{{ asset('images/logo/logo-digi-green-pin-horizontal-transparent.png') }}" 
                             alt="Digi-Green Cupunagara" 
                             class="h-9 w-auto object-contain">
                    </div>
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-[#1f9a26] block">Jejaring Desa Wisata Kabupaten Subang</span>
                        <h3 class="text-xl font-bold text-white font-heading mt-0.5">Desa Wisata Cupunagara</h3>
                    </div>
                    <p class="text-sm text-[#b8c5b8] leading-relaxed">
                        Destinasi ekowisata perbukitan di lereng Gunung Canggah (1.150 mdpl), Kecamatan Cisalak, Kabupaten Subang. Menyajikan daya tarik wisata alam terbuka, agrowisata kopi Arabika, serta gerakan gotong royong kampung bebas sampah.
                    </p>
                    <div class="pt-1">
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-[6px] bg-[#07370a] border border-[#1a9120]/50 text-xs font-semibold text-[#ecf2df]">
                            <svg class="w-4 h-4 text-[#1f9a26] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Terverifikasi &bull; NalarWarga Polsub &times; Pokdarwis
                        </span>
                    </div>
                </div>

                <!-- Col 2: Kategori & Produk Wisata (3 cols) -->
                <div class="lg:col-span-3">
                    <h4 class="text-base font-bold text-white font-heading mb-4 pb-2 border-b border-white/10">Produk &amp; Wisata</h4>
                    <ul class="space-y-2.5 text-sm text-[#b8c5b8]">
                        <li><a href="{{ route('destinations.index', ['category' => 'Wisata Alam']) }}" class="hover:text-[#1f9a26] transition flex items-center gap-2"><span>&rsaquo;</span> Wisata Alam &amp; Bukit</a></li>
                        <li><a href="{{ route('destinations.index', ['category' => 'Agrowisata']) }}" class="hover:text-[#1f9a26] transition flex items-center gap-2"><span>&rsaquo;</span> Agrowisata Kebun Kopi</a></li>
                        <li><a href="{{ route('coffee.index') }}" class="hover:text-[#1f9a26] transition flex items-center gap-2"><span>&rsaquo;</span> Produk Kopi Canggah</a></li>
                        <li><a href="{{ route('home') }}#peta-sebaran" class="hover:text-[#1f9a26] transition flex items-center gap-2"><span>&rsaquo;</span> Peta Sebaran Lokasi</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-[#1f9a26] transition flex items-center gap-2"><span>&rsaquo;</span> Berita &amp; Kegiatan Desa</a></li>
                    </ul>
                </div>

                <!-- Col 3: 3 Titik Plang Bambu QR (2 cols) -->
                <div class="lg:col-span-2">
                    <h4 class="text-base font-bold text-white font-heading mb-4 pb-2 border-b border-white/10">Titik Plang QR</h4>
                    <ul class="space-y-2.5 text-sm text-[#b8c5b8]">
                        <li><a href="{{ route('qr.show', 'pintu-masuk') }}" class="hover:text-[#1f9a26] transition flex items-center gap-2"><span>&rsaquo;</span> Pintu Masuk</a></li>
                        <li><a href="{{ route('qr.show', 'warung-warga') }}" class="hover:text-[#1f9a26] transition flex items-center gap-2"><span>&rsaquo;</span> Warung Warga</a></li>
                        <li><a href="{{ route('qr.show', 'gardu-pandang') }}" class="hover:text-[#1f9a26] transition flex items-center gap-2"><span>&rsaquo;</span> Gardu Pandang</a></li>
                        <li><a href="{{ route('reports.create') }}" class="hover:text-[#1f9a26] transition flex items-center gap-2"><span>&rsaquo;</span> Lapor Kebersihan</a></li>
                        <li><a href="{{ route('reports.index') }}" class="hover:text-[#1f9a26] transition flex items-center gap-2"><span>&rsaquo;</span> Lacak Tiket</a></li>
                    </ul>
                </div>

                <!-- Col 4: Hubungi Kami (3 cols) -->
                <div class="lg:col-span-3">
                    <h4 class="text-base font-bold text-white font-heading mb-4 pb-2 border-b border-white/10">Hubungi Pengelola</h4>
                    <div class="space-y-3 text-sm text-[#b8c5b8]">
                        <p class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-[#1f9a26] mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Desa Cupunagara, Kec. Cisalak, Kabupaten Subang, Jawa Barat 41283</span>
                        </p>
                        <p class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-[#1f9a26] shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771z"/>
                            </svg>
                            <a href="https://wa.me/6285798991234" target="_blank" rel="noopener noreferrer" class="hover:text-white transition">0857-9899-1234 (CS Wisata &amp; Desa)</a>
                        </p>
                        <p class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-[#1f9a26] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <a href="mailto:sekretariat@cupunagara.desa.id" class="hover:text-white transition">sekretariat@cupunagara.desa.id</a>
                        </p>
                        <div class="pt-2">
                            <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-1.5 text-xs text-[#ecf2df] hover:text-[#1f9a26] underline transition">
                                Login Pengelola Desa / Karang Taruna
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="bg-[#031c05] py-5 border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-[#9ab09a]">
                <p>&copy; {{ date('Y') }} Jejaring Desa Wisata Cupunagara &bull; Kabupaten Subang. Didukung oleh Kelompok 2 NalarWarga Politeknik Negeri Subang.</p>
                <div class="flex items-center gap-4">
                    <span>Klasifikasi: Desa Wisata Berkembang</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating Contact Center (CS Wisata & CS Desa Selector) -->
    <div x-data="{ contactOpen: false }" @click.away="contactOpen = false" class="fixed bottom-5 right-5 z-50 flex flex-col items-end gap-3">
        
        <!-- Popover Menu with 2 CS Choices -->
        <div x-show="contactOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-3 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-3 scale-95"
             x-cloak
             class="w-72 bg-white rounded-[12px] border border-[#dce6d5] shadow-[0_14px_40px_rgba(7,55,10,0.22)] overflow-hidden">
            <div class="bg-[#07370a] text-white px-4 py-3 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[#1f9a26] block">Pusat Layanan Resmi</span>
                    <strong class="text-sm font-bold font-heading text-white">Pilih Kontak Layanan</strong>
                </div>
                <button type="button" @click="contactOpen = false" class="text-white/70 hover:text-white p-1" aria-label="Tutup">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="p-3 space-y-2 bg-[#f6f7f2]">
                <!-- Option 1: CS Wisata -->
                <a href="https://wa.me/6285798991234?text={{ rawurlencode('Halo CS Wisata (Pokdarwis) Desa Cupunagara, saya ingin bertanya informasi tempat wisata dan rute kunjungan.') }}"
                   target="_blank" rel="noopener noreferrer"
                   class="flex items-center gap-3 p-3 rounded-[8px] bg-white border border-[#e7e7e7] hover:border-[#1a9120] hover:bg-[#edf5ee] transition group">
                    <div class="w-10 h-10 rounded-full bg-[#1a9120] text-white flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <strong class="block text-sm font-bold text-[#07370a] group-hover:text-[#1a9120] transition">CS Wisata (Pokdarwis)</strong>
                        <span class="block text-[11px] text-[#626f62] truncate">Info destinasi, pemandu, &amp; akses jalan</span>
                    </div>
                    <span class="text-[#1a9120] font-bold text-sm">&rarr;</span>
                </a>

                <!-- Option 2: CS Desa -->
                <a href="https://wa.me/6285798991234?text={{ rawurlencode('Halo CS Desa (Sekretariat) Cupunagara, saya ingin menghubungi perangkat desa / pengelola produk kopi & kebersihan.') }}"
                   target="_blank" rel="noopener noreferrer"
                   class="flex items-center gap-3 p-3 rounded-[8px] bg-white border border-[#e7e7e7] hover:border-[#07370a] hover:bg-[#edf5ee] transition group">
                    <div class="w-10 h-10 rounded-full bg-[#07370a] text-white flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <strong class="block text-sm font-bold text-[#07370a] group-hover:text-[#1a9120] transition">CS Desa (Sekretariat)</strong>
                        <span class="block text-[11px] text-[#626f62] truncate">Layanan desa, UMKM kopi, &amp; koordinasi</span>
                    </div>
                    <span class="text-[#07370a] font-bold text-sm">&rarr;</span>
                </a>
            </div>
        </div>

        <!-- Floating Trigger Button -->
        <button type="button"
                @click="contactOpen = !contactOpen"
                aria-label="Buka Pilihan Kontak Wisata dan Desa"
                class="flex items-center gap-2.5 px-5 py-3 rounded-full bg-[#1a9120] hover:bg-[#07370a] text-white text-xs font-bold shadow-[0_8px_24px_rgba(7,55,10,0.3)] transition-all duration-200 hover:-translate-y-0.5 cursor-pointer">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.698.077-2.106-.505-1.748-.724-2.884-2.493-2.97-2.608-.087-.116-.708-.941-.708-1.792s.448-1.27.607-1.444c.159-.175.348-.219.463-.219.116 0 .232.001.333.007.106.005.249-.04.39.298.144.347.491 1.2.535 1.288.043.088.072.19.014.305-.058.116-.087.188-.173.289l-.26.304c-.087.087-.179.183-.077.358.101.174.45 1.077 1.319 1.849 1.117.994 2.059 1.302 2.35 1.447.29.144.462.13.636-.073.174-.203.751-.871.954-1.173.203-.304.405-.246.68-.145.275.101 1.748.824 2.051.969.304.145.506.217.579.347.072.13.072.753-.072 1.158z"/>
            </svg>
            <span>Kontak Wisata</span>
            <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="contactOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/>
            </svg>
        </button>
    </div>

    <!-- Scroll-Reveal Animation Engine (IntersectionObserver) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var targets = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
            if (!targets.length) return;

            if (!('IntersectionObserver' in window)) {
                targets.forEach(function(el) { el.classList.add('is-visible'); });
                return;
            }

            var observer = new IntersectionObserver(function(entries, obs) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        obs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

            targets.forEach(function(el) { observer.observe(el); });
        });
    </script>

    @stack('scripts')
</body>
</html>
