@php
    $isDashboardActive = (isset($activeMenu) && $activeMenu === 'dashboard') || request()->is('dashboard');
    $isCatalogActive = (isset($activeMenu) && $activeMenu === 'katalog') || request()->is('katalog*');
    $isCartActive = (isset($activeMenu) && $activeMenu === 'keranjang') || request()->is('keranjang*');
    $isOrdersActive = (isset($activeMenu) && $activeMenu === 'pesanan') || request()->is('pesanan*');
    $isRulesActive = (isset($activeMenu) && $activeMenu === 'aturan-garansi') || request()->is('aturan-garansi*');
@endphp

<!-- SIDEBAR PEMBELI TETAP 260px -->
<aside class="fixed top-[72px] left-0 bottom-0 w-[260px] bg-white border-r border-[#E4E9DA] py-6 px-4 z-40 overflow-y-auto">
    <nav class="space-y-[6px]">
        <!-- 1. Dashboard -->
        <a href="{{ url('/dashboard') }}" class="h-12 rounded-[14px] px-4 flex items-center space-x-3 transition-all {{ $isDashboardActive ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold' : 'text-[#1F261D] hover:bg-[#F8FAF2] hover:text-[#1F3318] font-normal' }}">
            <span class="material-symbols-outlined text-[20px] {{ $isDashboardActive ? 'text-[#1F3318]' : 'text-[#4A5246]' }}">dashboard</span>
            <span class="text-[15px]">Dashboard</span>
        </a>

        <!-- 2. Katalog Durian -->
        <a href="{{ url('/katalog') }}" class="h-12 rounded-[14px] px-4 flex items-center space-x-3 transition-all {{ $isCatalogActive ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold' : 'text-[#1F261D] hover:bg-[#F8FAF2] hover:text-[#1F3318] font-normal' }}">
            <span class="material-symbols-outlined text-[20px] {{ $isCatalogActive ? 'text-[#1F3318]' : 'text-[#4A5246]' }}">storefront</span>
            <span class="text-[15px]">Katalog Durian</span>
        </a>

        <!-- 3. Keranjang -->
        <a href="{{ url('/keranjang') }}" class="h-12 rounded-[14px] px-4 flex items-center space-x-3 transition-all {{ $isCartActive ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold' : 'text-[#1F261D] hover:bg-[#F8FAF2] hover:text-[#1F3318] font-normal' }}">
            <span class="material-symbols-outlined text-[20px] {{ $isCartActive ? 'text-[#1F3318]' : 'text-[#4A5246]' }}">shopping_cart</span>
            <span class="text-[15px]">Keranjang</span>
        </a>

        <!-- 4. Pesanan Saya -->
        <a href="{{ url('/pesanan') }}" class="h-12 rounded-[14px] px-4 flex items-center space-x-3 transition-all {{ $isOrdersActive ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold' : 'text-[#1F261D] hover:bg-[#F8FAF2] hover:text-[#1F3318] font-normal' }}">
            <span class="material-symbols-outlined text-[20px] {{ $isOrdersActive ? 'text-[#1F3318]' : 'text-[#4A5246]' }}">receipt_long</span>
            <span class="text-[15px]">Pesanan Saya</span>
        </a>

        <!-- 5. Aturan & Garansi -->
        <a href="{{ url('/aturan-garansi') }}" class="h-12 rounded-[14px] px-4 flex items-center space-x-3 transition-all {{ $isRulesActive ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold' : 'text-[#1F261D] hover:bg-[#F8FAF2] hover:text-[#1F3318] font-normal' }}">
            <span class="material-symbols-outlined text-[20px] {{ $isRulesActive ? 'text-[#1F3318]' : 'text-[#4A5246]' }}">verified_user</span>
            <span class="text-[15px]">Aturan & Garansi</span>
        </a>
    </nav>
</aside>
