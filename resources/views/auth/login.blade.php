@extends('layouts.auth')

@section('title', 'Login - DuREN')

@section('content')
<div class="flex flex-col items-center justify-center h-full w-full">
    <!-- Header Section -->
    <div class="flex flex-col items-center text-center mb-8">
        <div class="flex items-center justify-center gap-3 mb-2">
            <h1 class="text-[72px] font-bold tracking-[-0.03em] text-[#1F261D] leading-[90px]">
                Welcome to
            </h1>
            <div class="highlight-badge">
                <span class="text-[52px] font-bold tracking-[-0.03em] leading-none text-[#1F261D] block">
                    DuREN
                </span>
            </div>
        </div>
        <p class="text-[16px] leading-[24px] text-[#6B7366] font-normal">
            Pilih durian terbaik, pesan, dan bayar dengan mudah.
        </p>
    </div>

    <!-- Container Kartu Login & Floating Chips -->
    <div class="relative w-[480px]">
        <!-- 3 Floating Chips di Sisi Kiri -->
        <div class="absolute top-2 right-[100%] mr-7 transform -rotate-6 bg-[#CDEBD9] border border-[#ABD9C0] text-[#1F3318] px-3.5 py-1.5 rounded-full flex items-center gap-1.5 shadow-sm whitespace-nowrap">
            <span class="material-symbols-outlined text-[17px] text-[#2C4825]">workspace_premium</span>
            <span class="text-[12px] font-medium leading-[17px]">Durian premium</span>
        </div>
        <div class="absolute top-1/2 -translate-y-1/2 right-[100%] mr-7 transform -rotate-3 bg-[#FBEFB5] border border-[#ECDDA1] text-[#5C4A12] px-3.5 py-1.5 rounded-full flex items-center gap-1.5 shadow-sm whitespace-nowrap">
            <span class="material-symbols-outlined text-[17px] text-[#7A6420]">verified</span>
            <span class="text-[12px] font-medium leading-[17px]">Kualitas terjamin</span>
        </div>
        <div class="absolute bottom-3 right-[100%] mr-7 transform -rotate-6 bg-[#DDEDCF] border border-[#C3DCAF] text-[#1F3318] px-3.5 py-1.5 rounded-full flex items-center gap-1.5 shadow-sm whitespace-nowrap">
            <span class="material-symbols-outlined text-[17px] text-[#3F5B34]">event_available</span>
            <span class="text-[12px] font-medium leading-[17px]">Pre-order panen</span>
        </div>

        <!-- 3 Floating Chips di Sisi Kanan -->
        <div class="absolute top-2 left-[100%] ml-7 transform rotate-6 bg-[#FBEFB5] border border-[#ECDDA1] text-[#5C4A12] px-3.5 py-1.5 rounded-full flex items-center gap-1.5 shadow-sm whitespace-nowrap">
            <span class="material-symbols-outlined text-[17px] text-[#7A6420]">stars</span>
            <span class="text-[12px] font-medium leading-[17px]">Daging tebal</span>
        </div>
        <div class="absolute top-1/2 -translate-y-1/2 left-[100%] ml-7 transform rotate-3 bg-[#CDEBD9] border border-[#ABD9C0] text-[#1F3318] px-3.5 py-1.5 rounded-full flex items-center gap-1.5 shadow-sm whitespace-nowrap">
            <span class="material-symbols-outlined text-[17px] text-[#2C4825]">eco</span>
            <span class="text-[12px] font-medium leading-[17px]">Durian utuh segar</span>
        </div>
        <div class="absolute bottom-3 left-[100%] ml-7 transform rotate-6 bg-[#FBDDC6] border border-[#EFC3A3] text-[#1F261D] px-3.5 py-1.5 rounded-full flex items-center gap-1.5 shadow-sm whitespace-nowrap">
            <span class="material-symbols-outlined text-[17px] text-[#8C4A1A]">local_shipping</span>
            <span class="text-[12px] font-medium leading-[17px]">Pengiriman aman</span>
        </div>

        <!-- Kartu Login 480px, Padding 32px, Radius 20px, Border #E4E9DA -->
        <div class="w-full bg-white rounded-[20px] border border-[#E4E9DA] shadow-[0_8px_24px_rgba(40,52,30,0.06)] p-[32px] transition-all duration-200">
            @if (session('success'))
                <div class="mb-5 p-3.5 rounded-[12px] bg-[#E3F1DC] border border-[#CFE6C5] text-[#1F3318] text-[14px] flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-[20px] text-[#3F5B34]">check_circle</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Input WhatsApp -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-2 leading-[20px]">
                        Nomor WhatsApp
                    </label>
                    <div class="relative">
                        <input class="w-full h-[48px] px-4 rounded-[12px] border @error('phone') border-red-400 focus:border-red-500 focus:ring-2 focus:ring-red-100 @else border-[#E4E9DA] focus:border-[#F2D98A] focus:ring-2 focus:ring-[#FAF1CE] @enderror bg-white text-[#1F261D] placeholder-[#7A8275] text-[14px] leading-[20px] focus:outline-none transition" name="phone" placeholder="Masukkan nomor WhatsApp, contoh 0812xxxxxxx" type="text" value="{{ old('phone') }}" required autofocus>
                    </div>
                    @error('phone')
                        <p class="text-[12px] text-red-600 mt-1.5 font-medium leading-[17px] flex items-center gap-1">
                            <span class="material-symbols-outlined text-[15px]">error</span>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Input Password -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-2 leading-[20px]">
                        Password
                    </label>
                    <div class="relative flex items-center">
                        <input class="w-full h-[48px] pl-4 pr-11 rounded-[12px] border @error('password') border-red-400 focus:border-red-500 focus:ring-2 focus:ring-red-100 @else border-[#E4E9DA] focus:border-[#F2D98A] focus:ring-2 focus:ring-[#FAF1CE] @enderror bg-white text-[#1F261D] placeholder-[#7A8275] text-[14px] leading-[20px] focus:outline-none transition" id="passwordInput" name="password" placeholder="Masukkan password" type="password" required>
                        <button aria-label="Toggle password visibility" class="absolute right-3.5 text-[#7A8275] hover:text-[#1F261D] transition p-1 flex items-center justify-center cursor-pointer" onclick="togglePassword()" type="button">
                            <span class="material-symbols-outlined text-[20px]" id="eyeIcon">visibility</span>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-[12px] text-red-600 mt-1.5 font-medium leading-[17px] flex items-center gap-1">
                            <span class="material-symbols-outlined text-[15px]">error</span>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Tombol Masuk (#F2D98A) -->
                <div class="pt-1">
                    <button type="submit" class="w-full h-[48px] rounded-[14px] bg-[#F2D98A] hover:bg-[#ebd07c] active:bg-[#dfc572] text-[#1F261D] font-semibold text-[16px] leading-[22px] transition flex items-center justify-center cursor-pointer shadow-sm">
                        Masuk
                    </button>
                </div>

                <!-- Footer Link -->
                <div class="text-center pt-1">
                    <p class="text-[14px] leading-[20px] text-[#4A5246]">
                        Belum punya akun? <a class="font-medium text-[#7A6420] hover:underline" href="{{ route('register') }}">Daftar</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('passwordInput');
        const icon = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility';
        }
    }
</script>
@endsection
