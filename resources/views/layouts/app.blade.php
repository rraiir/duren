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
</head>
<body class="relative min-h-screen w-full bg-white text-[#1F261D] overflow-x-hidden font-sans">

    @include('layouts.partials.header')

    @php
        $role = $sidebarRole ?? (auth()->check() ? auth()->user()->role : (request()->is('admin*') ? 'admin' : 'buyer'));
    @endphp

    @if($role === 'admin')
        @include('layouts.partials.sidebar-admin')
    @else
        @include('layouts.partials.sidebar-buyer')
    @endif

    <!-- AREA KONTEN UTAMA (Max 1440px, padding kiri 260px, atas 72px) -->
    <main class="ml-[260px] mt-[72px] p-[48px] max-w-[1440px] relative bg-white min-h-[calc(100vh-72px)]">
        <!-- LINGKARAN BLUR DEKORATIF LATAR BELAKANG -->
        <!-- Kanan atas: hijau #E3F1DC (144px, opacity 60%) -->
        <div class="pointer-events-none absolute top-8 right-16 w-[144px] h-[144px] rounded-full bg-[#E3F1DC] opacity-60 blur-2xl z-0"></div>
        <!-- Kiri tengah: kuning #FAF1CE (176px, opacity 40%) -->
        <div class="pointer-events-none absolute top-[360px] left-8 w-[176px] h-[176px] rounded-full bg-[#FAF1CE] opacity-40 blur-3xl z-0"></div>

        <!-- WRAPPER KONTEN (z-10 di atas ornamen blur) -->
        <div class="relative z-10">
            @yield('content')
        </div>
    </main>

</body>
</html>
