<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Desa Cupunagara</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Inter', sans-serif; } h1, .font-heading { font-family: 'Manrope', sans-serif; }</style>
</head>
<body class="bg-[#FBFBF9] min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-3xl p-8 border border-stone-200 shadow-sm space-y-6">
        
        <div class="text-center space-y-2">
            <div class="w-12 h-12 rounded-2xl bg-[#1E4620] text-white flex items-center justify-center font-bold text-xl mx-auto shadow-sm">
                C
            </div>
            <h1 class="text-2xl font-extrabold text-stone-900 font-heading">Login Pengelola Desa</h1>
            <p class="text-xs text-stone-500">Panel Karang Taruna & Pengelola Ekowisata Cupunagara</p>
        </div>

        @if($errors->any())
            <div class="p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-medium">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-xs font-bold uppercase text-stone-700 mb-1.5">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', 'admin@cupunagara.desa.id') }}" required 
                       class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1E4620]/20 focus:border-[#1E4620]">
            </div>

            <div>
                <label for="password" class="block text-xs font-bold uppercase text-stone-700 mb-1.5">Kata Sandi</label>
                <input type="password" name="password" id="password" required 
                       placeholder="••••••••"
                       class="w-full px-4 py-2.5 rounded-xl border border-stone-200 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-[#1E4620]/20 focus:border-[#1E4620]">
            </div>

            <div class="flex items-center justify-between text-xs text-stone-500">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded text-[#1E4620] focus:ring-[#1E4620]">
                    <span>Ingat Saya</span>
                </label>
                <span class="text-[#1E4620] font-semibold text-[11px]">(Default: password123)</span>
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-[#1E4620] hover:bg-[#163518] text-white text-xs font-bold transition shadow-sm">
                Masuk ke Dashboard
            </button>
        </form>

        <div class="text-center pt-2 border-t border-stone-100">
            <a href="{{ route('home') }}" class="text-xs text-stone-400 hover:text-stone-600">
                &larr; Kembali ke Website Publik
            </a>
        </div>

    </div>
</body>
</html>
