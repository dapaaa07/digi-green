<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengelola | Digi-Green Desa Cupunagara</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo-digi-green-pin-icon-transparent.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/logo-digi-green-pin-icon-transparent.png') }}">
    
    <!-- Google Fonts: DM Sans + Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400..800;1,9..40,400..800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; color: #4f5345; }
        h1, h2, h3, .font-heading { font-family: 'DM Sans', sans-serif; color: #07370a; }
    </style>
</head>
<body class="bg-[#eff6f0] min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-[10px] p-8 border border-[#dce6d5] shadow-[0_4px_24px_rgba(23,32,0,0.06)] space-y-6">
        
        <div class="text-center space-y-3">
            <a href="{{ route('home') }}" class="inline-block">
                <img src="{{ asset('images/logo/logo-digi-green-pin-horizontal-transparent.png') }}" 
                     alt="Digi-Green Cupunagara" 
                     class="h-11 mx-auto object-contain">
            </a>
            <div>
                <h1 class="text-2xl font-bold text-[#07370a] font-heading">Login Pengelola Desa</h1>
                <p class="text-xs text-[#626f62] mt-0.5">Panel Pokdarwis &amp; Karang Taruna Desa Cupunagara</p>
            </div>
        </div>

        @if($errors->any())
            <div class="p-3.5 rounded-[6px] bg-red-50 border border-red-200 text-red-700 text-xs font-semibold">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-1.5">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', 'admin@cupunagara.desa.id') }}" required 
                       class="input-jadesta w-full">
            </div>

            <div>
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#07370a] mb-1.5">Kata Sandi</label>
                <input type="password" name="password" id="password" required 
                       placeholder="••••••••"
                       class="input-jadesta w-full">
            </div>

            <div class="flex items-center justify-between text-xs text-[#626f62]">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded text-[#1a9120] focus:ring-[#1a9120] border-[#d4dcd4]">
                    <span>Ingat Saya</span>
                </label>
                <span class="text-[#1a9120] font-bold text-[11px]">(Default: password123)</span>
            </div>

            <button type="submit" class="grdeen-btn w-full !py-3">
                <span>Masuk ke Dashboard</span>
            </button>
        </form>

        <div class="text-center pt-2 border-t border-[#e7e7e7]">
            <a href="{{ route('home') }}" class="text-xs font-bold text-[#626f62] hover:text-[#1a9120] transition">
                &larr; Kembali ke Website Publik
            </a>
        </div>

    </div>
</body>
</html>
