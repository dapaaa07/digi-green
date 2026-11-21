@extends('layouts.app')

@section('title', 'Jejaring Desa Wisata Cupunagara | Ekowisata Alam & Sentra Kopi Subang')
@section('meta_description', 'Portal Jejaring Desa Wisata Cupunagara di lereng Gunung Canggah, Kecamatan Cisalak, Kabupaten Subang. Informasi wisata alam, produk kopi Canggah, peta sebaran, dan gerakan gotong royong kebersihan desa.')

@section('content')

    <!-- 1. JADESTA HERO SECTION -->
    <section class="relative bg-white pt-10 sm:pt-16 pb-16 sm:pb-24 overflow-hidden border-b border-[#e7e7e7]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
                
                <!-- Left Column: Jadesta Layered Visual Showcase -->
                <div class="lg:col-span-6 relative reveal-left">
                    <div class="relative mx-auto max-w-lg lg:max-w-none">
                        <div class="hidden sm:block absolute -top-4 -left-4 w-72 h-72 rounded-[12px] bg-[#ecf2df] -z-10"></div>
                        <div class="hidden sm:block absolute -bottom-4 -right-4 w-64 h-64 rounded-[12px] bg-[#f2f4ec] border border-[#1a9120]/20 -z-10"></div>

                        <!-- Main Hero Photo -->
                        <div class="rounded-[10px] overflow-hidden border-4 border-white shadow-[0_12px_38px_rgba(7,55,10,0.13)] bg-[#f2f4ec] aspect-[4/3] relative group">
                            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1000&q=80" 
                                 alt="Panorama Bukit Pamoyanan Desa Wisata Cupunagara" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            
                            <div class="absolute top-4 left-4 bg-[#1a9120] text-white text-xs font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-[6px] shadow-md flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                <span>Desa Wisata Terverifikasi</span>
                            </div>
                        </div>

                        <!-- Overlapping Elevation Card -->
                        <div class="mt-4 sm:mt-0 sm:absolute sm:-bottom-6 sm:left-6 sm:right-6 bg-[#faf8ec] border border-[#e7e7e7] rounded-[10px] p-4 shadow-lg flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3.5">
                                <img src="{{ asset('images/logo/logo-digi-green-pin-icon-transparent.png') }}" 
                                     alt="Digi-Green Pin" 
                                     class="w-11 h-11 object-contain shrink-0">
                                <div>
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-[#1a9120] block">Kec. Cisalak &bull; Kab. Subang</span>
                                    <strong class="text-sm sm:text-base font-bold text-[#07370a] font-heading block">Kawasan Lereng Gunung Canggah (1.150 mdpl)</strong>
                                </div>
                            </div>
                            <a href="#peta-sebaran" class="hidden sm:inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#1a9120] hover:bg-[#07370a] text-white transition shrink-0" title="Lihat Peta Sebaran">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Jadesta Section Title & Intro Copy -->
                <div class="lg:col-span-6 space-y-6 lg:pl-6 pt-4 sm:pt-6 lg:pt-0 reveal-right">
                    <div class="sec-title">
                        <div class="sec-title__tagline-wrap">
                            <span class="sec-title__chevron">
                                <svg viewBox="0 0 12 10" fill="currentColor" class="w-3.5 h-3">
                                    <path d="M5.8 1.6 C7 2.4 8 4 8 5 C8 6 7 7.6 5.8 8.4 L3.6 10 L6.3 10 C8 10 9.5 9.1 10.6 7.5 C12.1 5.2 12.1 4.8 10.6 2.5 C9.5 0.9 8 0 6.3 0 L3.6 0 L5.8 1.6 Z" />
                                </svg>
                            </span>
                            <span class="sec-title__tagline">Jejaring Desa Wisata</span>
                        </div>
                        <h1 class="text-3xl sm:text-4xl lg:text-[40px] font-bold text-[#07370a] font-heading leading-[1.15]">
                            Membangun Kemandirian <br class="hidden sm:inline"> Dari Desa Wisata Cupunagara
                        </h1>
                    </div>

                    <p class="text-[15.5px] text-[#626f62] leading-[1.8]">
                        Inovasi dan adaptasi masyarakat Desa Cupunagara membuka ruang untuk berkarya, memperkuat ekonomi petani kopi lokal, serta menjaga kelestarian bentang alam pegunungan Subang Selatan. Menyajikan pilihan bagi wisatawan untuk menikmati alam terbuka sembari merasakan pengalaman berwisata di tengah kehidupan masyarakat pedesaan yang sejuk dan asri.
                    </p>

                    <!-- Jadesta Interactive Sebaran & Quick Stats Box -->
                    <div class="bg-[#f2f4ec] border border-[#dce6d5] rounded-[10px] p-5 sm:p-6 space-y-4">
                        <div class="grid grid-cols-3 gap-3 text-center border-b border-[#dce6d5] pb-4">
                            <div>
                                <span class="text-2xl sm:text-3xl font-extrabold text-[#1a9120] font-heading block">1.150</span>
                                <span class="text-xs font-medium text-[#4f5345]">mdpl Ketinggian</span>
                            </div>
                            <div class="border-x border-[#dce6d5]">
                                <span class="text-2xl sm:text-3xl font-extrabold text-[#07370a] font-heading block">{{ $allDestinations->count() }}</span>
                                <span class="text-xs font-medium text-[#4f5345]">Wisata Utama</span>
                            </div>
                            <div>
                                <span class="text-2xl sm:text-3xl font-extrabold text-[#07370a] font-heading block">85+ Ha</span>
                                <span class="text-xs font-medium text-[#4f5345]">Kebun Kopi</span>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center gap-3 pt-1">
                            <a href="{{ route('destinations.index') }}" class="grdeen-btn">
                                <span>Jelajah Wisata</span>
                            </a>
                            <a href="#peta-sebaran" class="grdeen-btn grdeen-btn--outline">
                                <span>Lihat Peta</span>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- 2. JADESTA SCENIC HIGHLAND BANNER (High-contrast crisp white typography) -->
    <section class="relative py-20 sm:py-28 bg-[#07370a] text-white overflow-hidden">
        <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1600&q=80" 
             alt="Bentang Alam Pegunungan Cupunagara" 
             class="absolute inset-0 w-full h-full object-cover opacity-25">
        <div class="absolute inset-0 bg-[#052607]/75"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6 reveal">
            <span class="inline-block px-4 py-1.5 rounded-[6px] bg-[#1a9120] text-white text-xs font-bold uppercase tracking-widest shadow-sm">
                Anugerah Potensi Alam &amp; Budaya Lokal
            </span>
            <h2 class="text-2xl sm:text-4xl lg:text-[42px] font-bold !text-white font-heading leading-tight drop-shadow-sm">
                Desa Wisata Menuju Pariwisata Hijau Berkelanjutan
            </h2>
            <p class="text-sm sm:text-base text-white/90 leading-relaxed max-w-2xl mx-auto">
                Menggali potensi lokal perkebunan kopi rakyat, menjaga keasrian mata air curug, dan mendorong gerakan gotong royong kampung bebas sampah sebagai penggerak ekonomi desa.
            </p>
            <div class="pt-3 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('destinations.index') }}" class="grdeen-btn">
                    <span>Direktori Wisata</span>
                </a>
                <a href="{{ route('coffee.index') }}" class="grdeen-btn !bg-white !text-[#07370a] hover:!text-white">
                    <span>Produk Kopi Desa</span>
                </a>
            </div>
        </div>
    </section>

    <!-- 3. PROFIL & KEUNGGULAN DESA -->
    <section class="py-20 sm:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left Column: Quality Wrap & Checkmarks -->
                <div class="lg:col-span-6 space-y-6 reveal-left">
                    <div class="sec-title">
                        <div class="sec-title__tagline-wrap">
                            <span class="sec-title__chevron">
                                <svg viewBox="0 0 12 10" fill="currentColor" class="w-3.5 h-3">
                                    <path d="M5.8 1.6 C7 2.4 8 4 8 5 C8 6 7 7.6 5.8 8.4 L3.6 10 L6.3 10 C8 10 9.5 9.1 10.6 7.5 C12.1 5.2 12.1 4.8 10.6 2.5 C9.5 0.9 8 0 6.3 0 L3.6 0 L5.8 1.6 Z" />
                                </svg>
                            </span>
                            <span class="sec-title__tagline">Profil Kawasan Ekowisata</span>
                        </div>
                        <h2 class="sec-title__title">
                            Keunggulan Alam &amp; Komoditas Desa Wisata Cupunagara
                        </h2>
                    </div>

                    <p class="text-[15px] text-[#626f62] leading-[1.8]">
                        Dengan bangga mempersembahkan daya tarik utama Desa Cupunagara di Kecamatan Cisalak, Kabupaten Subang yang dikelola langsung oleh kelompok sadar wisata (Pokdarwis), petani, dan pemuda Karang Taruna:
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                        <div class="flex items-center gap-3.5 p-3.5 rounded-[8px] bg-[#f6f7f2] border border-[#e7e7e7] hover:border-[#1a9120]/40 transition">
                            <div class="w-11 h-11 rounded-full bg-[#1a9120] text-white flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/></svg>
                            </div>
                            <h4 class="text-sm font-bold text-[#07370a] font-heading leading-snug">Bukit Pamoyanan (Lautan Awan)</h4>
                        </div>

                        <div class="flex items-center gap-3.5 p-3.5 rounded-[8px] bg-[#f6f7f2] border border-[#e7e7e7] hover:border-[#1a9120]/40 transition">
                            <div class="w-11 h-11 rounded-full bg-[#1a9120] text-white flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                            </div>
                            <h4 class="text-sm font-bold text-[#07370a] font-heading leading-snug">Agrowisata Kopi Arabika Canggah</h4>
                        </div>

                        <div class="flex items-center gap-3.5 p-3.5 rounded-[8px] bg-[#f6f7f2] border border-[#e7e7e7] hover:border-[#1a9120]/40 transition">
                            <div class="w-11 h-11 rounded-full bg-[#1a9120] text-white flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <h4 class="text-sm font-bold text-[#07370a] font-heading leading-snug">Air Terjun Alami Curug Masigit</h4>
                        </div>

                        <div class="flex items-center gap-3.5 p-3.5 rounded-[8px] bg-[#f6f7f2] border border-[#e7e7e7] hover:border-[#1a9120]/40 transition">
                            <div class="w-11 h-11 rounded-full bg-[#1a9120] text-white flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 8h1a4 4 0 010 8h-1M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8zM6 1v3M10 1v3M14 1v3"/></svg>
                            </div>
                            <h4 class="text-sm font-bold text-[#07370a] font-heading leading-snug">Kafe &amp; Kedai Kopi Cupumanik</h4>
                        </div>
                    </div>

                    <ul class="space-y-2.5 text-sm text-[#4f5345] pt-2">
                        <li class="flex items-center gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-[#ecf2df] text-[#1a9120] flex items-center justify-center text-xs font-bold shrink-0">&check;</span>
                            <span>Informasi wisata terbuka tanpa pungutan tiket masuk online</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-[#ecf2df] text-[#1a9120] flex items-center justify-center text-xs font-bold shrink-0">&check;</span>
                            <span>Integrasi koordinat OpenStreetMap &amp; rute langsung Google Maps</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-[#ecf2df] text-[#1a9120] flex items-center justify-center text-xs font-bold shrink-0">&check;</span>
                            <span>Budaya gotong royong menjaga kebersihan sungai, bukit, dan jalur wisata</span>
                        </li>
                    </ul>

                    <div class="pt-2">
                        <a href="{{ route('destinations.index') }}" class="grdeen-btn">
                            <span>Lebih Lengkap</span>
                        </a>
                    </div>
                </div>

                <!-- Right Column: Layered Image with Circular Badge -->
                <div class="lg:col-span-6 reveal-right">
                    <div class="relative pr-0 sm:pr-10 pb-10">
                        <img src="https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=900&q=80" 
                             alt="Perkebunan Kopi dan Alam Desa Cupunagara" 
                             class="w-full h-80 sm:h-[420px] object-cover rounded-[10px] shadow-md">
                        
                        <div class="absolute bottom-0 right-2 sm:right-0 w-36 h-36 sm:w-44 sm:h-44 rounded-full bg-white p-3 shadow-xl border-4 border-[#ecf2df] flex flex-col items-center justify-center text-center">
                            <img src="{{ asset('images/logo/logo-digi-green-pin-stacked-transparent.png') }}" 
                                 alt="Digi-Green Cupunagara" 
                                 class="w-24 h-24 sm:w-28 sm:h-28 object-contain">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 4. JADESTA 4-COLUMN DASHED-CIRCLE CLASSIFICATION / PILLARS -->
    <section class="py-20 bg-[#f6f7f2] border-y border-[#e7e7e7]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-end mb-12 reveal">
                <div class="lg:col-span-6">
                    <div class="sec-title">
                        <div class="sec-title__tagline-wrap">
                            <span class="sec-title__chevron">
                                <svg viewBox="0 0 12 10" fill="currentColor" class="w-3.5 h-3">
                                    <path d="M5.8 1.6 C7 2.4 8 4 8 5 C8 6 7 7.6 5.8 8.4 L3.6 10 L6.3 10 C8 10 9.5 9.1 10.6 7.5 C12.1 5.2 12.1 4.8 10.6 2.5 C9.5 0.9 8 0 6.3 0 L3.6 0 L5.8 1.6 Z" />
                                </svg>
                            </span>
                            <span class="sec-title__tagline">Pilar Pengelolaan Kawasan</span>
                        </div>
                        <h2 class="sec-title__title">Klasifikasi &amp; Pilar Ekowisata</h2>
                    </div>
                </div>
                <div class="lg:col-span-6 lg:pl-12">
                    <p class="text-[15.5px] text-[#626f62] leading-relaxed">
                        Penataan Desa Wisata Cupunagara bertumpu pada tiga pilar utama yang memadukan pelestarian alam, kemandirian ekonomi warga, dan tanggung jawab kebersihan bersama.
                    </p>
                </div>
            </div>

            <!-- 3 Dashed-Circle Cards with Staggered Scroll Reveals -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="jadesta-process-card !bg-white reveal reveal-delay-100">
                    <div class="jadesta-process-card__circle">
                        <span class="jadesta-process-card__number">01</span>
                        <div class="jadesta-process-card__icon">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-[#07370a] font-heading mb-2">Wisata Alam</h3>
                    <p class="text-sm text-[#626f62] leading-relaxed">
                        Bentang perbukitan awan, hutan pinus, dan air terjun alami yang dijaga keasriannya oleh masyarakat desa.
                    </p>
                </div>

                <div class="jadesta-process-card !bg-white reveal reveal-delay-200">
                    <div class="jadesta-process-card__circle">
                        <span class="jadesta-process-card__number">02</span>
                        <div class="jadesta-process-card__icon">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-[#07370a] font-heading mb-2">Agrowisata Kopi &amp; Kafe</h3>
                    <p class="text-sm text-[#626f62] leading-relaxed">
                        Sentra perkebunan, pengolahan kopi Arabika lereng Gunung Canggah, serta kedai seduh lokal Cupumanik.
                    </p>
                </div>

                <div class="jadesta-process-card !bg-white reveal reveal-delay-300">
                    <div class="jadesta-process-card__circle">
                        <span class="jadesta-process-card__number">03</span>
                        <div class="jadesta-process-card__icon">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-[#07370a] font-heading mb-2">Gotong Royong</h3>
                    <p class="text-sm text-[#626f62] leading-relaxed">
                        Gerakan membawa pulang sampah pribadi serta pelaporan kolaboratif warga untuk merawat keasrian desa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. WISATA DESA & PETA SEBARAN -->
    <section id="wisata" class="py-20 sm:py-24 bg-[#eff6f0]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-12 gap-6 reveal">
                <div class="sec-title">
                    <div class="sec-title__tagline-wrap">
                        <span class="sec-title__chevron">
                            <svg viewBox="0 0 12 10" fill="currentColor" class="w-3.5 h-3">
                                <path d="M5.8 1.6 C7 2.4 8 4 8 5 C8 6 7 7.6 5.8 8.4 L3.6 10 L6.3 10 C8 10 9.5 9.1 10.6 7.5 C12.1 5.2 12.1 4.8 10.6 2.5 C9.5 0.9 8 0 6.3 0 L3.6 0 L5.8 1.6 Z" />
                            </svg>
                        </span>
                        <span class="sec-title__tagline">Pesonanya Memikat Wisatawan</span>
                    </div>
                    <h2 class="sec-title__title">Wisata Desa Cupunagara</h2>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center gap-4 lg:max-w-xl">
                    <p class="text-sm text-[#4f5345] leading-relaxed">
                        Dapatkan pengalaman berwisata alam terbuka dan agrowisata perkebunan yang menyatu dengan keramahan warga Desa Cupunagara.
                    </p>
                    <a href="{{ route('destinations.index') }}" class="grdeen-btn shrink-0">
                        <span>Lebih Lengkap</span>
                    </a>
                </div>
            </div>

            <!-- Jadesta Signature Project Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($featuredDestinations as $index => $destination)
                    <div class="jadesta-project-card group reveal {{ $index % 2 === 1 ? 'reveal-delay-100' : '' }}">
                        <div class="jadesta-project-card__image aspect-[16/10]">
                            <img src="{{ $destination->thumbnail }}" 
                                 alt="{{ $destination->name }}" 
                                 loading="lazy">
                        </div>

                        <div class="jadesta-project-card__overlay">
                            <strong class="jadesta-project-card__tag">
                                {{ $destination->category }} &bull; Desa Wisata Cupunagara
                            </strong>
                            <h3 class="jadesta-project-card__title">
                                <a href="{{ route('destinations.show', $destination->slug) }}">
                                    {{ $destination->name }}
                                </a>
                            </h3>
                            <p class="text-xs text-[#626f62] mt-1.5 line-clamp-1">
                                {{ $destination->operating_hours }} &bull; {{ $destination->price_info }}
                            </p>
                            <a href="{{ route('destinations.show', $destination->slug) }}" 
                               class="jadesta-project-card__arrow"
                               aria-label="Detail {{ $destination->name }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>

                        <div class="px-6 pb-4 flex items-center justify-between text-xs text-[#626f62]">
                            <span class="line-clamp-1">{{ $destination->excerpt }}</span>
                            <a href="{{ $destination->google_maps_navigation_url }}" 
                               target="_blank" rel="noopener noreferrer"
                               class="shrink-0 ml-4 font-bold text-[#1a9120] hover:text-[#07370a] flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                                <span>Rute Maps</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- PETA SEBARAN INTERAKTIF OPENSTREETMAP (#peta-sebaran / #master-map) -->
            <div id="peta-sebaran" class="mt-16 bg-white rounded-[10px] p-6 sm:p-8 border border-[#dce6d5] shadow-[0_3px_18px_rgba(23,32,0,0.06)] space-y-5 reveal-scale">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-[#e7e7e7]">
                    <div>
                        <div class="sec-title__tagline-wrap">
                            <span class="sec-title__chevron">
                                <svg viewBox="0 0 12 10" fill="currentColor" class="w-3.5 h-3">
                                    <path d="M5.8 1.6 C7 2.4 8 4 8 5 C8 6 7 7.6 5.8 8.4 L3.6 10 L6.3 10 C8 10 9.5 9.1 10.6 7.5 C12.1 5.2 12.1 4.8 10.6 2.5 C9.5 0.9 8 0 6.3 0 L3.6 0 L5.8 1.6 Z" />
                                </svg>
                            </span>
                            <span class="sec-title__tagline">Geospasial Desa Wisata</span>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold text-[#07370a] font-heading">Peta Sebaran Destinasi Wisata Desa</h3>
                    </div>
                    <div class="flex flex-wrap items-center gap-4 text-xs font-semibold">
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-[6px] bg-[#eff6f0] text-[#07370a] border border-[#1a9120]/30">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#1a9120]"></span> Destinasi Wisata Cupunagara
                        </span>
                    </div>
                </div>

                <div id="master-map" class="w-full h-80 sm:h-[420px] rounded-[8px] overflow-hidden border border-[#e7e7e7]"></div>
            </div>

        </div>
    </section>

    <!-- 6. PRODUK PARIWISATA & KOPI CUPUNAGARA -->
    <section id="paket" class="py-20 sm:py-24 bg-white border-b border-[#e7e7e7]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-12 gap-6 reveal">
                <div class="sec-title">
                    <div class="sec-title__tagline-wrap">
                        <span class="sec-title__chevron">
                            <svg viewBox="0 0 12 10" fill="currentColor" class="w-3.5 h-3">
                                <path d="M5.8 1.6 C7 2.4 8 4 8 5 C8 6 7 7.6 5.8 8.4 L3.6 10 L6.3 10 C8 10 9.5 9.1 10.6 7.5 C12.1 5.2 12.1 4.8 10.6 2.5 C9.5 0.9 8 0 6.3 0 L3.6 0 L5.8 1.6 Z" />
                            </svg>
                        </span>
                        <span class="sec-title__tagline">Produk Pariwisata &amp; Suvenir</span>
                    </div>
                    <h2 class="sec-title__title">Kopi Khas Lereng Gunung Canggah</h2>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center gap-4 lg:max-w-xl">
                    <p class="text-sm text-[#626f62] leading-relaxed">
                        Biji kopi pilihan yang dipetik merah dan disangrai oleh kelompok tani Desa Cupunagara sebagai buah tangan khas Subang Selatan.
                    </p>
                    <a href="{{ route('coffee.index') }}" class="grdeen-btn shrink-0">
                        <span>Lebih Lengkap</span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($featuredCoffees as $index => $coffee)
                    <div class="jadesta-project-card border border-[#e7e7e7] flex flex-col justify-between reveal reveal-delay-{{ ($index + 1) * 100 }}">
                        <div>
                            <div class="jadesta-project-card__image aspect-[4/3]">
                                <img src="{{ $coffee->image }}" alt="{{ $coffee->name }}" loading="lazy">
                            </div>

                            <div class="jadesta-project-card__overlay">
                                <strong class="jadesta-project-card__tag">
                                    {{ $coffee->process_type }} &bull; {{ $coffee->packaging_size }}
                                </strong>
                                <h3 class="jadesta-project-card__title !text-lg">
                                    <a href="{{ route('coffee.index') }}">{{ $coffee->name }}</a>
                                </h3>
                                <a href="{{ $coffee->whatsapp_order_url }}" 
                                   target="_blank" rel="noopener noreferrer"
                                   class="jadesta-project-card__arrow"
                                   title="Pesan via WhatsApp">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771z"/>
                                    </svg>
                                </a>
                            </div>

                            <div class="px-6 pb-4 space-y-2">
                                <p class="text-xs text-[#626f62] line-clamp-2 leading-relaxed">
                                    {{ $coffee->description }}
                                </p>
                                <p class="text-xs text-[#07370a] bg-[#f2f4ec] px-3 py-1.5 rounded-[6px]">
                                    <strong>Cita Rasa:</strong> {{ $coffee->flavor_notes }}
                                </p>
                            </div>
                        </div>

                        <div class="px-6 py-4 bg-[#f6f7f2] border-t border-[#e7e7e7] flex items-center justify-between">
                            <div>
                                <span class="text-[10px] uppercase font-bold text-[#626f62] block">Harga Suvenir</span>
                                <span class="text-lg font-extrabold text-[#07370a] font-heading">Rp {{ number_format($coffee->price, 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ $coffee->whatsapp_order_url }}" 
                               target="_blank" rel="noopener noreferrer"
                               class="px-4 py-2 rounded-[8px] bg-[#1a9120] hover:bg-[#07370a] text-white text-xs font-bold uppercase tracking-wider transition">
                                Pesan via WA
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- 7. GERAKAN GOTONG ROYONG & 3 TITIK PLANG BAMBU QR CODE -->
    <section class="py-20 bg-[#f2f4ec] border-b border-[#e7e7e7]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#07370a] rounded-[12px] p-7 sm:p-12 text-white shadow-xl relative overflow-hidden reveal-scale">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                    
                    <div class="lg:col-span-8 space-y-5">
                        <div class="sec-title__tagline-wrap">
                            <span class="text-[#1f9a26]">
                                <svg viewBox="0 0 12 10" fill="currentColor" class="w-3.5 h-3">
                                    <path d="M5.8 1.6 C7 2.4 8 4 8 5 C8 6 7 7.6 5.8 8.4 L3.6 10 L6.3 10 C8 10 9.5 9.1 10.6 7.5 C12.1 5.2 12.1 4.8 10.6 2.5 C9.5 0.9 8 0 6.3 0 L3.6 0 L5.8 1.6 Z" />
                                </svg>
                            </span>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#1f9a26]">Inisiatif Digi-Green &times; Karang Taruna Cupunagara</span>
                        </div>

                        <h2 class="text-2xl sm:text-4xl font-bold !text-white font-heading leading-tight">
                            Budaya Gotong Royong: Bawa Pulang Sampahmu, Lapor Masalah Fasilitas Bersama
                        </h2>

                        <p class="text-sm sm:text-[15.5px] text-white/85 leading-relaxed">
                            Kebersihan desa wisata adalah tanggung jawab kolektif. Setiap pengunjung wajib menerapkan prinsip <strong class="text-white underline decoration-[#1f9a26]">Bawa Pulang Sampah Pribadi (Leave No Trace)</strong> untuk kemasan makanan dan botol minum. Sementara itu, sistem tiket laporan digunakan untuk mengoordinasikan warga dan Karang Taruna apabila ditemukan tumpukan sampah liar bervolume besar atau tempat sampah umum yang penuh dan rusak.
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                            <div class="p-4 rounded-[8px] bg-white/10 border border-white/15">
                                <span class="text-[11px] font-bold text-[#34d399] uppercase tracking-wider block">Prinsip 01</span>
                                <strong class="text-base font-bold text-white font-heading block mt-1">Bawa Pulang Sampahmu</strong>
                                <span class="text-xs text-white/75 mt-1 block">Kantongi sampah kecil pribadi hingga menemukan tempat sampah.</span>
                            </div>

                            <div class="p-4 rounded-[8px] bg-white/10 border border-white/15">
                                <span class="text-[11px] font-bold text-[#34d399] uppercase tracking-wider block">Prinsip 02</span>
                                <strong class="text-base font-bold text-white font-heading block mt-1">Jaga Keasrian Alam</strong>
                                <span class="text-xs text-white/75 mt-1 block">Dilarang membuang sampah di lereng bukit dan aliran air.</span>
                            </div>

                            <div class="p-4 rounded-[8px] bg-white/10 border border-white/15">
                                <span class="text-[11px] font-bold text-[#34d399] uppercase tracking-wider block">Prinsip 03</span>
                                <strong class="text-base font-bold text-white font-heading block mt-1">Lapor Fasilitas Publik</strong>
                                <span class="text-xs text-white/75 mt-1 block">Koordinasi penanganan tumpukan sampah besar bersama desa.</span>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-4">
                        <div class="bg-[#faf8ec] text-[#07370a] rounded-[10px] p-6 sm:p-7 space-y-4 shadow-lg">
                            <span class="inline-block px-3 py-1 rounded-[6px] bg-[#1a9120] text-white text-[11px] font-bold uppercase tracking-wider">
                                Eskalasi Lapangan
                            </span>
                            <h3 class="text-xl font-bold text-[#07370a] font-heading">
                                Temukan Tumpukan Sampah Liar atau Fasilitas Rusak?
                            </h3>
                            <p class="text-xs sm:text-sm text-[#4f5345] leading-relaxed">
                                Laporkan titik koordinat atau patokan lokasi agar tim kebersihan desa dapat menjadwalkan pengangkutan menggunakan armada desa.
                            </p>
                            <div class="pt-1 space-y-2.5">
                                <a href="{{ route('reports.create') }}" class="grdeen-btn w-full">
                                    <span>Kirim Laporan</span>
                                </a>
                                <a href="{{ route('reports.index') }}" class="block text-center text-xs font-bold text-[#1a9120] hover:underline pt-1">
                                    Lacak Status Tiket Laporan &rarr;
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- 8. KABAR DARI DESA WISATA -->
    <section id="blog" class="py-20 sm:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 gap-4 reveal">
                <div class="sec-title">
                    <div class="sec-title__tagline-wrap">
                        <span class="sec-title__chevron">
                            <svg viewBox="0 0 12 10" fill="currentColor" class="w-3.5 h-3">
                                <path d="M5.8 1.6 C7 2.4 8 4 8 5 C8 6 7 7.6 5.8 8.4 L3.6 10 L6.3 10 C8 10 9.5 9.1 10.6 7.5 C12.1 5.2 12.1 4.8 10.6 2.5 C9.5 0.9 8 0 6.3 0 L3.6 0 L5.8 1.6 Z" />
                            </svg>
                        </span>
                        <span class="sec-title__tagline">Kabar Dari Desa Wisata</span>
                    </div>
                    <h2 class="sec-title__title">Berita &amp; Kegiatan Desa Cupunagara</h2>
                </div>
                <a href="{{ route('articles.index') }}" class="grdeen-btn">
                    <span>Semua Berita</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($latestArticles as $index => $article)
                    <article class="jadesta-blog-card group reveal reveal-delay-{{ ($index + 1) * 100 }}">
                        <div>
                            <div class="relative aspect-[16/10] bg-[#e7e7e7] overflow-hidden">
                                <img src="{{ $article->thumbnail }}" 
                                     alt="{{ $article->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                <div class="absolute bottom-3 left-4">
                                    <span class="jadesta-blog-card__date">
                                        {{ $article->published_at ? $article->published_at->translatedFormat('d M Y') : $article->created_at->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6 sm:p-7 space-y-3">
                                <span class="text-xs font-bold uppercase tracking-wider text-[#1a9120] block">
                                    {{ $article->category }}
                                </span>
                                <h3 class="text-lg font-bold text-[#07370a] font-heading group-hover:text-[#1a9120] transition leading-snug">
                                    <a href="{{ route('articles.show', $article->slug) }}">
                                        {{ $article->title }}
                                    </a>
                                </h3>
                                <p class="text-sm text-[#626f62] line-clamp-3 leading-relaxed">
                                    {{ $article->excerpt }}
                                </p>
                            </div>
                        </div>

                        <div class="px-6 sm:px-7 pb-6 pt-2 flex items-center justify-between text-xs font-bold text-[#07370a]">
                            <span>Oleh {{ $article->author }}</span>
                            <a href="{{ route('articles.show', $article->slug) }}" class="text-[#1a9120] hover:underline">
                                Baca Artikel &rarr;
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (!document.getElementById('master-map')) return;

        var map = L.map('master-map').setView([-6.7562000, 107.6881000], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var destinations = @json($allDestinations);
        destinations.forEach(function(dest) {
            if (dest.latitude && dest.longitude) {
                var popupHtml = `
                    <div style="width: 220px; font-family: 'Inter', sans-serif;">
                        <img src="${dest.thumbnail}" style="width: 100%; height: 110px; object-fit: cover; border-radius: 6px; margin-bottom: 8px;">
                        <span style="font-size: 10px; font-weight: 700; color: #1a9120; text-transform: uppercase;">${dest.category}</span>
                        <h4 style="font-size: 14px; font-weight: 700; margin: 3px 0 6px; color: #07370a; font-family: 'DM Sans', sans-serif;">${dest.name}</h4>
                        <div style="display: flex; gap: 6px; margin-top: 8px;">
                            <a href="/wisata/${dest.slug}" style="flex: 1; padding: 6px; font-size: 11px; text-align: center; background: #1a9120; color: #fff; text-decoration: none; border-radius: 6px; font-weight: 600;">Detail</a>
                            <a href="${dest.google_maps_navigation_url}" target="_blank" rel="noopener noreferrer" style="flex: 1; padding: 6px; font-size: 11px; text-align: center; background: #faf8ec; color: #07370a; text-decoration: none; border-radius: 6px; font-weight: 600; border: 1px solid #dce6d5;">Maps</a>
                        </div>
                    </div>
                `;
                L.marker([dest.latitude, dest.longitude]).addTo(map).bindPopup(popupHtml);
            }
        });

    });
</script>
@endpush
