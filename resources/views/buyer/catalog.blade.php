@extends('layouts.app')

@section('title', 'Katalog Durian - DuREN')

@section('content')
<!-- Header Konten Halaman -->
<div class="flex flex-col mb-5">
    <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">Katalog Durian</h1>
    <p class="text-[16px] leading-[22px] text-[#6B7366] mt-1">Pilih varian dan ukuran durian utuh favoritmu.</p>
</div>

<!-- Kartu Info Perhatian -->
<div class="flex items-center gap-3 bg-[#FAF1CE] border border-[#ECDDA1] rounded-[14px] px-5 py-3.5 mb-6 shadow-sm">
    <span class="material-symbols-outlined text-[20px] text-[#7A6420] flex-shrink-0">info</span>
    <p class="text-[14px] leading-[20px] text-[#5C4A12]">
        Klik 2 kali pada kartu untuk melihat detail durian. Berat hanya estimasi. Baca <a class="font-semibold text-[#7A6420] hover:underline" href="{{ url('/aturan-garansi') }}">Aturan & Garansi</a> sebelum membayar.
    </p>
</div>

<!-- Baris Filter & Pencarian -->
<div class="flex flex-col md:flex-row items-center gap-4 mb-8 justify-between">
    <!-- Input Pencarian -->
    <div class="relative w-full md:w-[320px] h-12">
        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#7A8275] text-[20px]">search</span>
        <input class="w-full h-full pl-11 pr-4 bg-white border border-[#E4E9DA] rounded-[12px] text-[#1F261D] text-[14px] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] transition-colors shadow-sm" id="catalog-search" placeholder="Cari varian..." type="text">
    </div>

    <!-- Filter Chip Status -->
    <div class="flex items-center gap-2 self-start md:self-auto" id="filter-chips">
        <button class="catalog-filter-btn px-4 py-2 rounded-full text-[13px] font-semibold bg-[#E3F1DC] text-[#1F3318] border border-transparent transition-all cursor-pointer" data-filter="all" type="button">
            Semua
        </button>
        <button class="catalog-filter-btn px-4 py-2 rounded-full text-[13px] font-medium bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2] transition-all cursor-pointer" data-filter="ready" type="button">
            Ready Stock
        </button>
        <button class="catalog-filter-btn px-4 py-2 rounded-full text-[13px] font-medium bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2] transition-all cursor-pointer" data-filter="preorder" type="button">
            Pre-Order
        </button>
    </div>
</div>

<!-- Grid Kartu Produk -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6" id="catalog-grid">
    <!-- Produk 1: Montong L -->
    <div class="catalog-card custom-card flex flex-col justify-between group cursor-pointer" data-id="1" data-name="Montong L" data-type="ready" ondblclick="location.href='{{ url('/katalog/1') }}'">
        <div>
            <div class="relative w-full h-[180px] rounded-[16px] bg-[#F8FAF2] flex items-center justify-center overflow-hidden mb-5">
                <div class="absolute top-3 left-3 z-10">
                    <x-badge-status type="ready" />
                </div>
                <div class="w-32 h-32 rounded-full bg-[#E8F3E1] flex items-center justify-center">
                    <svg width="72" height="72" viewBox="0 0 72 72" fill="none">
                        <ellipse cx="36" cy="38" rx="26" ry="30" fill="#CFE6C5"/>
                        <polygon points="26,24 22,28 30,30" fill="#B7D7A8"/>
                        <polygon points="46,24 42,28 50,30" fill="#B7D7A8"/>
                    </svg>
                </div>
            </div>

            <div class="flex items-center justify-between mb-1.5">
                <a href="{{ url('/katalog/1') }}" class="text-[20px] font-semibold text-[#1F261D] group-hover:text-[#7A6420] transition-colors">
                    Montong L
                </a>
                <span class="text-[12px] text-[#6B7366]">Sisa 12 buah</span>
            </div>

            <div class="flex items-center gap-2 mb-4">
                <span class="w-6 h-6 rounded-full bg-[#E3F1DC] text-[#1F3318] font-bold text-[12px] flex items-center justify-center">
                    L
                </span>
                <span class="text-[14px] text-[#4A5246] font-medium">Est. 3,2 kg</span>
            </div>

            <div class="text-[24px] font-bold text-[#1F261D] mb-4">
                Rp 250.000
            </div>
        </div>

        <div class="pt-4 border-t border-[#E4E9DA] flex items-center gap-3" onclick="event.stopPropagation()">
            <div class="flex items-center border border-[#E4E9DA] rounded-[10px] bg-white p-0.5">
                <button type="button" class="w-8 h-8 rounded-[8px] flex items-center justify-center hover:bg-[#F8FAF2] text-[#4A5246] transition-colors" onclick="changeQty(this, -1)">
                    <span class="material-symbols-outlined text-[16px]">remove</span>
                </button>
                <span class="w-8 text-center text-[14px] font-semibold text-[#1F261D] select-none qty-number">1</span>
                <button type="button" class="w-8 h-8 rounded-[8px] flex items-center justify-center hover:bg-[#F8FAF2] text-[#4A5246] transition-colors" onclick="changeQty(this, 1)">
                    <span class="material-symbols-outlined text-[16px]">add</span>
                </button>
            </div>
            <a href="{{ url('/keranjang') }}" class="flex-1 h-10 rounded-[12px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[#1F261D] text-[13px] font-semibold flex items-center justify-center gap-1.5 transition-colors">
                <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                <span>Tambah</span>
            </a>
        </div>
    </div>

    <!-- Produk 2: Montong M -->
    <div class="catalog-card custom-card flex flex-col justify-between group cursor-pointer" data-id="2" data-name="Montong M" data-type="ready" ondblclick="location.href='{{ url('/katalog/2') }}'">
        <div>
            <div class="relative w-full h-[180px] rounded-[16px] bg-[#F8FAF2] flex items-center justify-center overflow-hidden mb-5">
                <div class="absolute top-3 left-3 z-10">
                    <x-badge-status type="ready" />
                </div>
                <div class="w-32 h-32 rounded-full bg-[#FAF1CE] flex items-center justify-center">
                    <svg width="72" height="72" viewBox="0 0 72 72" fill="none">
                        <ellipse cx="36" cy="38" rx="24" ry="28" fill="#F2D98A"/>
                        <polygon points="26,24 22,28 30,30" fill="#ECDDA1"/>
                    </svg>
                </div>
            </div>

            <div class="flex items-center justify-between mb-1.5">
                <a href="{{ url('/katalog/2') }}" class="text-[20px] font-semibold text-[#1F261D] group-hover:text-[#7A6420] transition-colors">
                    Montong M
                </a>
                <span class="text-[12px] text-[#6B7366]">Sisa 8 buah</span>
            </div>

            <div class="flex items-center gap-2 mb-4">
                <span class="w-6 h-6 rounded-full bg-[#FBEFB5] text-[#5C4A12] font-bold text-[12px] flex items-center justify-center">
                    M
                </span>
                <span class="text-[14px] text-[#4A5246] font-medium">Est. 2,4 kg</span>
            </div>

            <div class="text-[24px] font-bold text-[#1F261D] mb-4">
                Rp 190.000
            </div>
        </div>

        <div class="pt-4 border-t border-[#E4E9DA] flex items-center gap-3" onclick="event.stopPropagation()">
            <div class="flex items-center border border-[#E4E9DA] rounded-[10px] bg-white p-0.5">
                <button type="button" class="w-8 h-8 rounded-[8px] flex items-center justify-center hover:bg-[#F8FAF2] text-[#4A5246] transition-colors" onclick="changeQty(this, -1)">
                    <span class="material-symbols-outlined text-[16px]">remove</span>
                </button>
                <span class="w-8 text-center text-[14px] font-semibold text-[#1F261D] select-none qty-number">1</span>
                <button type="button" class="w-8 h-8 rounded-[8px] flex items-center justify-center hover:bg-[#F8FAF2] text-[#4A5246] transition-colors" onclick="changeQty(this, 1)">
                    <span class="material-symbols-outlined text-[16px]">add</span>
                </button>
            </div>
            <a href="{{ url('/keranjang') }}" class="flex-1 h-10 rounded-[12px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[#1F261D] text-[13px] font-semibold flex items-center justify-center gap-1.5 transition-colors">
                <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                <span>Tambah</span>
            </a>
        </div>
    </div>

    <!-- Produk 3: Musang King M -->
    <div class="catalog-card custom-card flex flex-col justify-between group cursor-pointer" data-id="3" data-name="Musang King M" data-type="ready" ondblclick="location.href='{{ url('/katalog/3') }}'">
        <div>
            <div class="relative w-full h-[180px] rounded-[16px] bg-[#F8FAF2] flex items-center justify-center overflow-hidden mb-5">
                <div class="absolute top-3 left-3 z-10">
                    <x-badge-status type="ready" />
                </div>
                <div class="w-32 h-32 rounded-full bg-[#E8F3E1] flex items-center justify-center">
                    <svg width="72" height="72" viewBox="0 0 72 72" fill="none">
                        <circle cx="36" cy="38" r="26" fill="#CFE6C5"/>
                    </svg>
                </div>
            </div>

            <div class="flex items-center justify-between mb-1.5">
                <a href="{{ url('/katalog/3') }}" class="text-[20px] font-semibold text-[#1F261D] group-hover:text-[#7A6420] transition-colors">
                    Musang King M
                </a>
                <span class="text-[12px] text-[#6B7366]">Sisa 5 buah</span>
            </div>

            <div class="flex items-center gap-2 mb-4">
                <span class="w-6 h-6 rounded-full bg-[#FBEFB5] text-[#5C4A12] font-bold text-[12px] flex items-center justify-center">
                    M
                </span>
                <span class="text-[14px] text-[#4A5246] font-medium">Est. 2,0 kg</span>
            </div>

            <div class="text-[24px] font-bold text-[#1F261D] mb-4">
                Rp 320.000
            </div>
        </div>

        <div class="pt-4 border-t border-[#E4E9DA] flex items-center gap-3" onclick="event.stopPropagation()">
            <div class="flex items-center border border-[#E4E9DA] rounded-[10px] bg-white p-0.5">
                <button type="button" class="w-8 h-8 rounded-[8px] flex items-center justify-center hover:bg-[#F8FAF2] text-[#4A5246] transition-colors" onclick="changeQty(this, -1)">
                    <span class="material-symbols-outlined text-[16px]">remove</span>
                </button>
                <span class="w-8 text-center text-[14px] font-semibold text-[#1F261D] select-none qty-number">1</span>
                <button type="button" class="w-8 h-8 rounded-[8px] flex items-center justify-center hover:bg-[#F8FAF2] text-[#4A5246] transition-colors" onclick="changeQty(this, 1)">
                    <span class="material-symbols-outlined text-[16px]">add</span>
                </button>
            </div>
            <a href="{{ url('/keranjang') }}" class="flex-1 h-10 rounded-[12px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[#1F261D] text-[13px] font-semibold flex items-center justify-center gap-1.5 transition-colors">
                <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                <span>Tambah</span>
            </a>
        </div>
    </div>

    <!-- Produk 4: Bawor L (Pre-Order) -->
    <div class="catalog-card custom-card flex flex-col justify-between group cursor-pointer" data-id="4" data-name="Bawor L" data-type="preorder" ondblclick="location.href='{{ url('/katalog/4') }}'">
        <div>
            <div class="relative w-full h-[180px] rounded-[16px] bg-[#F8FAF2] flex items-center justify-center overflow-hidden mb-5">
                <div class="absolute top-3 left-3 z-10">
                    <x-badge-status type="preorder" />
                </div>
                <div class="w-32 h-32 rounded-full bg-[#FFF3C9] flex items-center justify-center">
                    <svg width="72" height="72" viewBox="0 0 72 72" fill="none">
                        <ellipse cx="36" cy="38" rx="27" ry="31" fill="#CFE6C5"/>
                    </svg>
                </div>
            </div>

            <div class="flex items-center justify-between mb-1.5">
                <a href="{{ url('/katalog/4') }}" class="text-[20px] font-semibold text-[#1F261D] group-hover:text-[#7A6420] transition-colors">
                    Bawor L
                </a>
                <span class="text-[12px] text-[#7A6420] font-medium">Panen: 28 Okt 2026</span>
            </div>

            <div class="flex items-center gap-2 mb-4">
                <span class="w-6 h-6 rounded-full bg-[#E3F1DC] text-[#1F3318] font-bold text-[12px] flex items-center justify-center">
                    L
                </span>
                <span class="text-[14px] text-[#4A5246] font-medium">Est. 3,5 kg</span>
            </div>

            <div class="text-[24px] font-bold text-[#1F261D] mb-4">
                Rp 280.000
            </div>
        </div>

        <div class="pt-4 border-t border-[#E4E9DA] flex items-center gap-3" onclick="event.stopPropagation()">
            <div class="flex items-center border border-[#E4E9DA] rounded-[10px] bg-white p-0.5">
                <button type="button" class="w-8 h-8 rounded-[8px] flex items-center justify-center hover:bg-[#F8FAF2] text-[#4A5246] transition-colors" onclick="changeQty(this, -1)">
                    <span class="material-symbols-outlined text-[16px]">remove</span>
                </button>
                <span class="w-8 text-center text-[14px] font-semibold text-[#1F261D] select-none qty-number">1</span>
                <button type="button" class="w-8 h-8 rounded-[8px] flex items-center justify-center hover:bg-[#F8FAF2] text-[#4A5246] transition-colors" onclick="changeQty(this, 1)">
                    <span class="material-symbols-outlined text-[16px]">add</span>
                </button>
            </div>
            <a href="{{ url('/keranjang') }}" class="flex-1 h-10 rounded-[12px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[#1F261D] text-[13px] font-semibold flex items-center justify-center gap-1.5 transition-colors">
                <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                <span>Pre-Order</span>
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function changeQty(btn, delta) {
        const span = btn.parentElement.querySelector('.qty-number');
        let current = parseInt(span.textContent) || 1;
        current = Math.max(1, current + delta);
        span.textContent = current;
    }

    // Filter & Search Script
    (function() {
        const filterBtns = document.querySelectorAll('.catalog-filter-btn');
        const cards = document.querySelectorAll('.catalog-card');
        const searchInput = document.getElementById('catalog-search');
        let currentFilter = 'all';

        function applyFilter() {
            const query = (searchInput?.value || '').toLowerCase().trim();

            cards.forEach(card => {
                const type = card.getAttribute('data-type');
                const name = (card.getAttribute('data-name') || '').toLowerCase();

                const matchesFilter = currentFilter === 'all' || type === currentFilter;
                const matchesSearch = !query || name.includes(query);

                if (matchesFilter && matchesSearch) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => {
                    b.className = 'catalog-filter-btn px-4 py-2 rounded-full text-[13px] font-medium bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2] transition-all cursor-pointer';
                });
                btn.className = 'catalog-filter-btn px-4 py-2 rounded-full text-[13px] font-semibold bg-[#E3F1DC] text-[#1F3318] border border-transparent transition-all cursor-pointer';
                currentFilter = btn.getAttribute('data-filter') || 'all';
                applyFilter();
            });
        });

        searchInput?.addEventListener('input', applyFilter);
    })();
</script>
@endpush
@endsection
