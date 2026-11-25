<!-- HEADER TETAP 72px -->
<header class="fixed top-0 left-0 right-0 h-[72px] bg-white border-b border-[#E4E9DA] px-6 lg:px-[48px] flex items-center justify-between z-50">
    <!-- Kiri: Logo Kotak + Teks -->
    <a href="{{ (auth()->check() && auth()->user()->role === 'admin') ? url('/admin') : url('/katalog') }}" class="flex items-center space-x-3 shrink-0">
        <div class="w-9 h-9 rounded-[12px] bg-[#E3F1DC] flex items-center justify-center">
            <span class="material-symbols-outlined text-[#4E6B43] text-[22px]">eco</span>
        </div>
        <span class="text-[20px] font-semibold text-[#1F261D] tracking-tight">DuREN</span>
    </a>

    <!-- Tengah: Navigasi Khusus Pembeli (Storefront E-Commerce Navbar) -->
    @if(auth()->check() && auth()->user()->role === 'buyer')
        <nav class="hidden md:flex items-center space-x-1 lg:space-x-3">
            <a href="{{ route('buyer.catalog') }}" class="px-3.5 py-2 rounded-[12px] text-[14px] font-medium transition-all {{ request()->is('katalog*') ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold' : 'text-[#4A5246] hover:bg-[#F8FAF2] hover:text-[#1F261D]' }}">
                Katalog Durian
            </a>
            <a href="{{ route('buyer.cart') }}" class="px-3.5 py-2 rounded-[12px] text-[14px] font-medium transition-all flex items-center gap-1.5 {{ request()->is('keranjang*') ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold' : 'text-[#4A5246] hover:bg-[#F8FAF2] hover:text-[#1F261D]' }}">
                <span>Keranjang</span>
                <span class="w-5 h-5 rounded-full bg-[#F2D98A] text-[#5C4A12] text-[11px] font-bold flex items-center justify-center">1</span>
            </a>
            <a href="{{ route('buyer.orders') }}" class="px-3.5 py-2 rounded-[12px] text-[14px] font-medium transition-all {{ request()->is('pesanan*') ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold' : 'text-[#4A5246] hover:bg-[#F8FAF2] hover:text-[#1F261D]' }}">
                Pesanan Saya
            </a>
            <a href="{{ route('articles.index') }}" class="px-3.5 py-2 rounded-[12px] text-[14px] font-medium transition-all {{ request()->is('artikel*') ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold' : 'text-[#4A5246] hover:bg-[#F8FAF2] hover:text-[#1F261D]' }}">
                Artikel
            </a>
            <a href="{{ route('buyer.rules') }}" class="px-3.5 py-2 rounded-[12px] text-[14px] font-medium transition-all {{ request()->is('aturan-garansi*') ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold' : 'text-[#4A5246] hover:bg-[#F8FAF2] hover:text-[#1F261D]' }}">
                Aturan & Garansi
            </a>
        </nav>
    @endif

    <!-- Kanan: Profil & Tombol Keluar -->
    <div class="flex items-center space-x-3 lg:space-x-5">
        <a href="{{ (auth()->check() && auth()->user()->role === 'admin') ? route('admin.profile') : route('buyer.profile') }}" class="flex items-center space-x-2.5 hover:opacity-80 transition-opacity">
            <div class="w-8 h-8 rounded-full bg-[#E3F1DC] flex items-center justify-center text-[#3F5B34]">
                <span class="material-symbols-outlined text-[18px]">person</span>
            </div>
            <span class="text-[14px] font-medium text-[#1F261D] hidden sm:inline">{{ auth()->user()->name ?? 'Pengguna' }}</span>
        </a>
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="h-10 px-3.5 lg:px-4 rounded-[14px] border border-[#E4E9DA] bg-white hover:bg-[#F8FAF2] text-[#4A5246] hover:text-[#1F261D] flex items-center space-x-1.5 lg:space-x-2 text-[14px] font-medium transition-colors cursor-pointer" title="Keluar">
                <span class="material-symbols-outlined text-[18px]">logout</span>
                <span class="hidden sm:inline">Keluar</span>
            </button>
        </form>
    </div>
</header>
