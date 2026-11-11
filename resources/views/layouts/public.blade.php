<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DuREN - Pesan Durian Utuh')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .duren-card {
            background: #FFFFFF;
            border: 1px solid #E4E9DA;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(40,52,30,0.06);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .duren-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(40,52,30,0.09);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-white min-h-screen relative overflow-x-hidden selection:bg-[#E3F1DC] selection:text-[#1F3318]">

    <!-- Decorative blur blobs -->
    <div class="fixed top-24 -right-12 w-[380px] h-[380px] rounded-full bg-[#E3F1DC] opacity-60 blur-3xl pointer-events-none -z-10"></div>
    <div class="fixed top-[650px] -left-20 w-[420px] h-[420px] rounded-full bg-[#FAF1CE] opacity-40 blur-3xl pointer-events-none -z-10"></div>
    <div class="fixed top-[1500px] right-0 w-[360px] h-[360px] rounded-full bg-[#E8F3E1] opacity-50 blur-3xl pointer-events-none -z-10"></div>

    <!-- Header 72px -->
    <header class="fixed top-0 left-0 right-0 h-[72px] bg-white border-b border-[#E4E9DA] z-50 px-6 md:px-12">
        <div class="max-w-[1200px] h-full mx-auto flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-[12px] bg-[#E3F1DC] flex items-center justify-center">
                        <span class="material-symbols-outlined text-[#4E6B43] text-[22px]">eco</span>
                    </div>
                    <span class="font-semibold text-[20px] tracking-tight text-[#1F261D]">DuREN</span>
                </a>

                <nav class="flex items-center gap-1">
                    <a href="{{ url('/') }}" class="h-10 px-4 rounded-[14px] {{ request()->is('/') ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold shadow-sm' : 'text-[#1F261D] hover:bg-[#F8FAF2] font-medium' }} text-[14px] flex items-center justify-center transition-colors">
                        Beranda
                    </a>
                    <a href="{{ url('/artikel') }}" class="h-10 px-4 rounded-[14px] {{ request()->is('artikel*') ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold shadow-sm' : 'text-[#1F261D] hover:bg-[#F8FAF2] font-medium' }} text-[14px] flex items-center justify-center transition-colors">
                        Artikel
                    </a>
                </nav>
            </div>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ auth()->user()->role === 'admin' ? url('/admin') : url('/dashboard') }}" class="h-10 px-5 rounded-[14px] bg-[#E3F1DC] text-[#1F3318] hover:bg-[#d5ebd0] font-semibold text-[14px] flex items-center gap-2 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">dashboard</span>
                        <span>Dashboard</span>
                    </a>
                @else
                    <a href="{{ url('/login') }}" class="h-10 px-5 rounded-[14px] bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2] font-medium text-[14px] flex items-center justify-center transition-colors">
                        Masuk
                    </a>
                    <a href="{{ url('/daftar') }}" class="h-10 px-5 rounded-[14px] bg-[#F2D98A] text-[#1F261D] hover:brightness-95 font-semibold text-[14px] flex items-center justify-center transition-all shadow-sm">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-[72px] max-w-[1200px] mx-auto px-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="w-full bg-[#F8FAF2] border-t border-[#E4E9DA] py-12 px-6 md:px-12 mt-12">
        <div class="max-w-[1200px] mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-[12px] bg-[#E3F1DC] flex items-center justify-center">
                    <span class="material-symbols-outlined text-[#4E6B43] text-[22px]">eco</span>
                </div>
                <span class="font-semibold text-[20px] tracking-tight text-[#1F261D]">DuREN</span>
            </div>

            <nav class="flex items-center gap-8">
                <a href="{{ url('/') }}" class="text-[14px] font-medium text-[#1F261D] hover:text-[#7A6420] transition-colors">Beranda</a>
                <a href="{{ url('/artikel') }}" class="text-[14px] font-medium text-[#1F261D] hover:text-[#7A6420] transition-colors">Artikel</a>
                <a href="{{ url('/login') }}" class="text-[14px] font-medium text-[#1F261D] hover:text-[#7A6420] transition-colors">Masuk</a>
                <a href="{{ url('/daftar') }}" class="text-[14px] font-medium text-[#1F261D] hover:text-[#7A6420] transition-colors">Daftar</a>
            </nav>

            <div class="text-[14px] text-[#6B7366] font-medium text-center md:text-right">
                <div>© 2026 {{ $namaSistem ?? 'DuREN' }}</div>
                <div class="text-[12px] text-[#7A8275]">{{ $taglineSistem ?? 'Pusat Durian Utuh' }}</div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
