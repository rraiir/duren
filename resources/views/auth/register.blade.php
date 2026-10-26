@extends('layouts.auth')

@section('title', 'Daftar - DuREN')

@section('content')
<div class="flex flex-col items-center justify-center h-full w-full">
    <!-- Header Section -->
    <div class="flex flex-col items-center text-center mb-8">
        <div class="flex items-center justify-center gap-3 mb-2">
            <h1 class="text-[56px] md:text-[72px] font-bold tracking-[-0.03em] text-[#1F261D] leading-none">
                Welcome to
            </h1>
            <div class="highlight-badge">
                <span class="text-[40px] md:text-[52px] font-bold tracking-[-0.03em] leading-none text-[#1F261D] block">
                    DuREN
                </span>
            </div>
        </div>
        <p class="text-[16px] leading-[24px] text-[#6B7366] font-normal">
            Buat akun untuk mulai memesan durian.
        </p>
    </div>

    <!-- Container Kartu Register & Floating Chips -->
    <div class="relative w-full max-w-[480px] px-4">
        <!-- 3 Floating Chips di Sisi Kiri (Hidden on small screens) -->
        <div class="hidden xl:flex absolute top-2 right-[100%] mr-7 transform -rotate-6 bg-[#CDEBD9] border border-[#ABD9C0] text-[#1F3318] px-3.5 py-1.5 rounded-full items-center gap-1.5 shadow-sm whitespace-nowrap">
            <span class="material-symbols-outlined text-[17px] text-[#2C4825]">workspace_premium</span>
            <span class="text-[12px] font-medium leading-[17px]">Durian premium</span>
        </div>
        <div class="hidden xl:flex absolute top-1/2 -translate-y-1/2 right-[100%] mr-7 transform -rotate-3 bg-[#FBEFB5] border border-[#ECDDA1] text-[#5C4A12] px-3.5 py-1.5 rounded-full items-center gap-1.5 shadow-sm whitespace-nowrap">
            <span class="material-symbols-outlined text-[17px] text-[#7A6420]">verified</span>
            <span class="text-[12px] font-medium leading-[17px]">Kualitas terjamin</span>
        </div>
        <div class="hidden xl:flex absolute bottom-3 right-[100%] mr-7 transform -rotate-6 bg-[#DDEDCF] border border-[#C3DCAF] text-[#1F3318] px-3.5 py-1.5 rounded-full items-center gap-1.5 shadow-sm whitespace-nowrap">
            <span class="material-symbols-outlined text-[17px] text-[#3F5B34]">event_available</span>
            <span class="text-[12px] font-medium leading-[17px]">Pre-order panen</span>
        </div>

        <!-- 3 Floating Chips di Sisi Kanan (Hidden on small screens) -->
        <div class="hidden xl:flex absolute top-2 left-[100%] ml-7 transform rotate-6 bg-[#FBEFB5] border border-[#ECDDA1] text-[#5C4A12] px-3.5 py-1.5 rounded-full items-center gap-1.5 shadow-sm whitespace-nowrap">
            <span class="material-symbols-outlined text-[17px] text-[#7A6420]">stars</span>
            <span class="text-[12px] font-medium leading-[17px]">Daging tebal</span>
        </div>
        <div class="hidden xl:flex absolute top-1/2 -translate-y-1/2 left-[100%] ml-7 transform rotate-3 bg-[#CDEBD9] border border-[#ABD9C0] text-[#1F3318] px-3.5 py-1.5 rounded-full items-center gap-1.5 shadow-sm whitespace-nowrap">
            <span class="material-symbols-outlined text-[17px] text-[#2C4825]">eco</span>
            <span class="text-[12px] font-medium leading-[17px]">Durian utuh segar</span>
        </div>
        <div class="hidden xl:flex absolute bottom-3 left-[100%] ml-7 transform rotate-6 bg-[#FBDDC6] border border-[#EFC3A3] text-[#1F261D] px-3.5 py-1.5 rounded-full items-center gap-1.5 shadow-sm whitespace-nowrap">
            <span class="material-symbols-outlined text-[17px] text-[#8C4A1A]">local_shipping</span>
            <span class="text-[12px] font-medium leading-[17px]">Pengiriman aman</span>
        </div>

        <!-- Kartu Register 480px, Padding 32px, Radius 20px, Border #E4E9DA -->
        <div class="w-full bg-white rounded-[20px] border border-[#E4E9DA] shadow-[0_8px_24px_rgba(40,52,30,0.06)] p-6 md:p-[32px] transition-all duration-200">
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Input Nama Lengkap -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-1.5 leading-[20px]">
                        Nama lengkap
                    </label>
                    <div class="relative">
                        <input class="w-full h-[48px] px-4 rounded-[12px] border @error('name') border-red-400 focus:border-red-500 focus:ring-2 focus:ring-red-100 @else border-[#E4E9DA] focus:border-[#F2D98A] focus:ring-2 focus:ring-[#FAF1CE] @enderror bg-white text-[#1F261D] placeholder-[#7A8275] text-[14px] leading-[20px] focus:outline-none transition" name="name" placeholder="Masukkan nama lengkap" type="text" value="{{ old('name') }}" required autofocus>
                    </div>
                    @error('name')
                        <p class="text-[12px] text-red-600 mt-1 font-medium leading-[17px] flex items-center gap-1">
                            <span class="material-symbols-outlined text-[15px]">error</span>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Input WhatsApp -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-1.5 leading-[20px]">
                        Nomor WhatsApp
                    </label>
                    <div class="relative">
                        <input class="w-full h-[48px] px-4 rounded-[12px] border @error('phone') border-red-400 focus:border-red-500 focus:ring-2 focus:ring-red-100 @else border-[#E4E9DA] focus:border-[#F2D98A] focus:ring-2 focus:ring-[#FAF1CE] @enderror bg-white text-[#1F261D] placeholder-[#7A8275] text-[14px] leading-[20px] focus:outline-none transition" name="phone" placeholder="Contoh 0812xxxxxxx" type="text" value="{{ old('phone') }}" required>
                    </div>
                    @error('phone')
                        <p class="text-[12px] text-red-600 mt-1 font-medium leading-[17px] flex items-center gap-1">
                            <span class="material-symbols-outlined text-[15px]">error</span>
                            <span>{{ $message }}</span>
                        </p>
                    @else
                        <p class="text-[12px] leading-[17px] text-[#6B7366] mt-1 font-normal">
                            Harus aktif. Admin memakainya untuk konfirmasi ongkir dan garansi.
                        </p>
                    @enderror
                </div>

                <!-- Input Alamat Lengkap -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-1.5 leading-[20px]">
                        Alamat lengkap
                    </label>
                    <div class="relative">
                        <textarea class="w-full rounded-[12px] border @error('address') border-red-400 focus:border-red-500 focus:ring-2 focus:ring-red-100 @else border-[#E4E9DA] focus:border-[#F2D98A] focus:ring-2 focus:ring-[#FAF1CE] @enderror bg-white text-[#1F261D] placeholder-[#7A8275] text-[14px] leading-[20px] p-3 focus:outline-none transition resize-none" name="address" placeholder="Jalan, nomor, RT/RW, kelurahan, kota" rows="3" required>{{ old('address') }}</textarea>
                    </div>
                    @error('address')
                        <p class="text-[12px] text-red-600 mt-1 font-medium leading-[17px] flex items-center gap-1">
                            <span class="material-symbols-outlined text-[15px]">error</span>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <!-- Input Password -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-1.5 leading-[20px]">
                        Password
                    </label>
                    <div class="relative flex items-center">
                        <input class="w-full h-[48px] pl-4 pr-11 rounded-[12px] border @error('password') border-red-400 focus:border-red-500 focus:ring-2 focus:ring-red-100 @else border-[#E4E9DA] focus:border-[#F2D98A] focus:ring-2 focus:ring-[#FAF1CE] @enderror bg-white text-[#1F261D] placeholder-[#7A8275] text-[14px] leading-[20px] focus:outline-none transition" id="regPasswordInput" name="password" placeholder="Masukkan password" type="password" required>
                        <button aria-label="Toggle password visibility" class="absolute right-3.5 text-[#7A8275] hover:text-[#1F261D] transition p-1 flex items-center justify-center cursor-pointer" onclick="toggleRegPassword()" type="button">
                            <span class="material-symbols-outlined text-[20px]" id="regEyeIcon">visibility</span>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-[12px] text-red-600 mt-1 font-medium leading-[17px] flex items-center gap-1">
                            <span class="material-symbols-outlined text-[15px]">error</span>
                            <span>{{ $message }}</span>
                        </p>
                    @else
                        <p class="text-[12px] leading-[17px] text-[#6B7366] mt-1 font-normal">
                            Minimal 8 karakter
                        </p>
                    @enderror
                </div>

                <!-- Tombol Daftar (#F2D98A) -->
                <div class="pt-2">
                    <button type="submit" class="w-full h-[48px] rounded-[14px] bg-[#F2D98A] hover:bg-[#ebd07c] active:bg-[#dfc572] text-[#1F261D] font-semibold text-[16px] leading-[22px] transition flex items-center justify-center cursor-pointer shadow-sm">
                        Daftar
                    </button>
                </div>

                <!-- Footer Link -->
                <div class="text-center pt-2">
                    <p class="text-[14px] leading-[20px] text-[#4A5246]">
                        Sudah punya akun? <a class="font-medium text-[#7A6420] hover:underline" href="{{ route('login') }}">Masuk</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function toggleRegPassword() {
        const input = document.getElementById('regPasswordInput');
        const icon = document.getElementById('regEyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility';
        }
    }
</script>
@endpush
@endsection
