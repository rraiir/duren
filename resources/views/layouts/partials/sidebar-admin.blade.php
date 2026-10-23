@php
    $currentFilter = request()->get('filter');
    $isVerifikasi = request()->is('admin/verifikasi-bayar*') || (request()->is('admin/pesanan*') && $currentFilter === 'verify');
    
    $isDashboardActive = request()->is('admin') && !request()->is('admin/*');
    $isDurianActive = request()->is('admin/durian*');
    $isPesananActive = request()->is('admin/pesanan*') && !$isVerifikasi;
    $isVerifikasiActive = $isVerifikasi;
    $isPembeliActive = request()->is('admin/pembeli*');
    $isLaporanActive = request()->is('admin/laporan*');
    $isPengaturanActive = request()->is('admin/pengaturan*');
@endphp

<!-- SIDEBAR ADMIN TETAP 260px -->
<aside class="fixed top-[72px] left-0 bottom-0 w-[260px] bg-white border-r border-[#E4E9DA] py-6 px-4 z-40 overflow-y-auto">
    <nav class="space-y-[6px]">
        <!-- 1. Dashboard -->
        <a href="{{ url('/admin') }}" class="h-12 rounded-[14px] px-4 flex items-center space-x-3 transition-all {{ $isDashboardActive ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold' : 'text-[#1F261D] hover:bg-[#F8FAF2] hover:text-[#1F3318] font-normal' }}">
            <span class="material-symbols-outlined text-[20px] {{ $isDashboardActive ? 'text-[#1F3318]' : 'text-[#4A5246]' }}">dashboard</span>
            <span class="text-[15px]">Dashboard</span>
        </a>

        <!-- 2. Durian -->
        <a href="{{ url('/admin/durian') }}" class="h-12 rounded-[14px] px-4 flex items-center space-x-3 transition-all {{ $isDurianActive ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold' : 'text-[#1F261D] hover:bg-[#F8FAF2] hover:text-[#1F3318] font-normal' }}">
            <span class="material-symbols-outlined text-[20px] {{ $isDurianActive ? 'text-[#1F3318]' : 'text-[#4A5246]' }}">inventory_2</span>
            <span class="text-[15px]">Durian</span>
        </a>

        <!-- 3. Pesanan -->
        <a href="{{ url('/admin/pesanan') }}" class="h-12 rounded-[14px] px-4 flex items-center space-x-3 transition-all {{ $isPesananActive ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold' : 'text-[#1F261D] hover:bg-[#F8FAF2] hover:text-[#1F3318] font-normal' }}">
            <span class="material-symbols-outlined text-[20px] {{ $isPesananActive ? 'text-[#1F3318]' : 'text-[#4A5246]' }}">receipt_long</span>
            <span class="text-[15px]">Pesanan</span>
        </a>

        <!-- 4. Verifikasi Bayar -->
        <a href="{{ url('/admin/verifikasi-bayar') }}" class="h-12 rounded-[14px] px-4 flex items-center space-x-3 transition-all {{ $isVerifikasiActive ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold' : 'text-[#1F261D] hover:bg-[#F8FAF2] hover:text-[#1F3318] font-normal' }}">
            <span class="material-symbols-outlined text-[20px] {{ $isVerifikasiActive ? 'text-[#1F3318]' : 'text-[#4A5246]' }}">fact_check</span>
            <span class="text-[15px]">Verifikasi Bayar</span>
        </a>

        <!-- 5. Pembeli -->
        <a href="{{ url('/admin/pembeli') }}" class="h-12 rounded-[14px] px-4 flex items-center space-x-3 transition-all {{ $isPembeliActive ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold' : 'text-[#1F261D] hover:bg-[#F8FAF2] hover:text-[#1F3318] font-normal' }}">
            <span class="material-symbols-outlined text-[20px] {{ $isPembeliActive ? 'text-[#1F3318]' : 'text-[#4A5246]' }}">group</span>
            <span class="text-[15px]">Pembeli</span>
        </a>

        <!-- 6. Laporan -->
        <a href="{{ url('/admin/laporan') }}" class="h-12 rounded-[14px] px-4 flex items-center space-x-3 transition-all {{ $isLaporanActive ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold' : 'text-[#1F261D] hover:bg-[#F8FAF2] hover:text-[#1F3318] font-normal' }}">
            <span class="material-symbols-outlined text-[20px] {{ $isLaporanActive ? 'text-[#1F3318]' : 'text-[#4A5246]' }}">bar_chart</span>
            <span class="text-[15px]">Laporan</span>
        </a>

        <!-- 7. Pengaturan -->
        <a href="{{ url('/admin/pengaturan') }}" class="h-12 rounded-[14px] px-4 flex items-center space-x-3 transition-all {{ $isPengaturanActive ? 'bg-[#E3F1DC] text-[#1F3318] font-semibold' : 'text-[#1F261D] hover:bg-[#F8FAF2] hover:text-[#1F3318] font-normal' }}">
            <span class="material-symbols-outlined text-[20px] {{ $isPengaturanActive ? 'text-[#1F3318]' : 'text-[#4A5246]' }}">settings</span>
            <span class="text-[15px]">Pengaturan</span>
        </a>
    </nav>
</aside>
