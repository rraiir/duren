<!-- HEADER TETAP 72px -->
<header class="fixed top-0 left-0 right-0 h-[72px] bg-white border-b border-[#E4E9DA] px-[48px] flex items-center justify-between z-50">
    <!-- Kiri: Logo Kotak + Teks -->
    <a href="{{ (auth()->check() && auth()->user()->role === 'admin') ? url('/admin') : url('/dashboard') }}" class="flex items-center space-x-3">
        <div class="w-9 h-9 rounded-[12px] bg-[#E3F1DC] flex items-center justify-center">
            <span class="material-symbols-outlined text-[#4E6B43] text-[22px]">eco</span>
        </div>
        <span class="text-[20px] font-semibold text-[#1F261D] tracking-tight">DuREN</span>
    </a>

    <!-- Kanan: Profil & Tombol Keluar -->
    <div class="flex items-center space-x-5">
        <div class="flex items-center space-x-2.5">
            <div class="w-8 h-8 rounded-full bg-[#E3F1DC] flex items-center justify-center text-[#3F5B34]">
                <span class="material-symbols-outlined text-[18px]">person</span>
            </div>
            <span class="text-[14px] font-medium text-[#1F261D]">{{ auth()->user()->name ?? 'Admin' }}</span>
        </div>
        <a href="{{ url('/login') }}" class="h-10 px-4 rounded-[14px] border border-[#E4E9DA] bg-white hover:bg-[#F8FAF2] text-[#4A5246] hover:text-[#1F261D] flex items-center space-x-2 text-[14px] font-medium transition-colors cursor-pointer">
            <span class="material-symbols-outlined text-[18px]">logout</span>
            <span>Keluar</span>
        </a>
    </div>
</header>
