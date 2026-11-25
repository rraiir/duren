<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? ($namaSistem ?? 'DuREN') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="relative min-h-screen w-full bg-white text-[#1F261D] overflow-x-hidden font-sans">

    @include('layouts.partials.header')

    @php
        $role = $sidebarRole ?? (auth()->check() ? auth()->user()->role : (request()->is('admin*') ? 'admin' : 'buyer'));
    @endphp

    @if($role === 'admin')
        @include('layouts.partials.sidebar-admin')
        <!-- AREA KONTEN ADMIN (Padding kiri 260px untuk sidebar admin) -->
        <main class="ml-[260px] mt-[72px] p-[48px] max-w-[1440px] relative bg-white min-h-[calc(100vh-72px)]">
    @else
        <!-- AREA KONTEN PEMBELI (Toko Modern Consumer, Lebar Penuh Tanpa Sidebar Kaku) -->
        <main class="max-w-[1240px] mx-auto mt-[72px] px-6 py-8 relative bg-white min-h-[calc(100vh-72px)]">
    @endif
        <!-- LINGKARAN BLUR DEKORATIF LATAR BELAKANG -->
        <!-- Kanan atas: hijau #E3F1DC (144px, opacity 60%) -->
        <div class="pointer-events-none absolute top-8 right-16 w-[144px] h-[144px] rounded-full bg-[#E3F1DC] opacity-60 blur-2xl z-0"></div>
        <!-- Kiri tengah: kuning #FAF1CE (176px, opacity 40%) -->
        <div class="pointer-events-none absolute top-[360px] left-8 w-[176px] h-[176px] rounded-full bg-[#FAF1CE] opacity-40 blur-3xl z-0"></div>

        <!-- WRAPPER KONTEN (z-10 di atas ornamen blur) -->
        <div class="relative z-10">
            {{-- Pesan flash terpusat --}}
            @if(session('success'))
                <div id="flash-success" class="mb-6 flex items-start gap-3 px-4 py-3 rounded-[14px] bg-[#CDEBD9] border border-[#ABD9C0] text-[#1F3318]">
                    <span class="material-symbols-outlined text-[20px] mt-0.5 shrink-0">check_circle</span>
                    <span class="text-[14px] font-medium leading-[20px]">{{ session('success') }}</span>
                    <button onclick="document.getElementById('flash-success').remove()" class="ml-auto text-[#1F3318] hover:opacity-70 shrink-0 cursor-pointer">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div id="flash-error" class="mb-6 flex items-start gap-3 px-4 py-3 rounded-[14px] bg-[#FBDDC6] border border-[#EFC3A3] text-[#8C4A1A]">
                    <span class="material-symbols-outlined text-[20px] mt-0.5 shrink-0">error</span>
                    <span class="text-[14px] font-medium leading-[20px]">{{ session('error') }}</span>
                    <button onclick="document.getElementById('flash-error').remove()" class="ml-auto text-[#8C4A1A] hover:opacity-70 shrink-0 cursor-pointer">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </button>
                </div>
            @endif
            @if(session('info'))
                <div id="flash-info" class="mb-6 flex items-start gap-3 px-4 py-3 rounded-[14px] bg-[#E3F1DC] border border-[#B7D7A8] text-[#1F3318]">
                    <span class="material-symbols-outlined text-[20px] mt-0.5 shrink-0">info</span>
                    <span class="text-[14px] font-medium leading-[20px]">{{ session('info') }}</span>
                    <button onclick="document.getElementById('flash-info').remove()" class="ml-auto text-[#1F3318] hover:opacity-70 shrink-0 cursor-pointer">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

</body>
</html>
@stack('scripts')
