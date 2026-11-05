@extends('layouts.app')

@section('title', 'Katalog Durian - DuREN')

@section('content')
<!-- Header Konten Halaman -->
<div class="flex flex-col mb-5">
    <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">Katalog Durian</h1>
    <p class="text-[16px] leading-[22px] text-[#6B7366] mt-1">Pilih varian dan ukuran durian utuh favoritmu.</p>
</div>

<!-- Kartu Info Perhatian -->
<div class="flex items-center gap-3 bg-[#FAF1CE] border border-[#ECDDA1] rounded-[14px] px-5 py-3.5 mb-6 shadow-xs">
    <span class="material-symbols-outlined text-[20px] text-[#7A6420] shrink-0">info</span>
    <p class="text-[14px] leading-[20px] text-[#5C4A12]">
        Klik 2 kali pada kartu untuk melihat detail durian. Berat hanya estimasi. Baca <a class="font-semibold text-[#7A6420] hover:underline" href="{{ route('buyer.rules') }}">Aturan & Garansi</a> sebelum membayar.
    </p>
</div>

<!-- Baris Filter & Pencarian -->
@php
    $currentType = request('type');
@endphp
<div class="flex flex-col md:flex-row items-center gap-4 mb-8 justify-between">
    <!-- Input Pencarian -->
    <div class="relative w-full md:w-[320px] h-12">
        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#7A8275] text-[20px]">search</span>
        <input class="w-full h-full pl-11 pr-4 bg-white border border-[#E4E9DA] rounded-[12px] text-[#1F261D] text-[14px] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] transition-colors shadow-xs" id="catalog-search" placeholder="Cari varian..." type="text">
    </div>

    <!-- Filter Chip Status -->
    <div class="flex items-center gap-2 self-start md:self-auto" id="filter-chips">
        <a href="{{ route('buyer.catalog') }}" class="catalog-filter-btn px-4 py-2 rounded-full text-[13px] {{ empty($currentType) ? 'font-semibold bg-[#E3F1DC] text-[#1F3318] border border-transparent' : 'font-medium bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2]' }} transition-all cursor-pointer">
            Semua
        </a>
        <a href="{{ route('buyer.catalog', ['type' => 'ready']) }}" class="catalog-filter-btn px-4 py-2 rounded-full text-[13px] {{ $currentType === 'ready' ? 'font-semibold bg-[#E3F1DC] text-[#1F3318] border border-transparent' : 'font-medium bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2]' }} transition-all cursor-pointer">
            Ready Stock
        </a>
        <a href="{{ route('buyer.catalog', ['type' => 'preorder']) }}" class="catalog-filter-btn px-4 py-2 rounded-full text-[13px] {{ $currentType === 'preorder' ? 'font-semibold bg-[#E3F1DC] text-[#1F3318] border border-transparent' : 'font-medium bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2]' }} transition-all cursor-pointer">
            Pre-Order
        </a>
    </div>
</div>

<!-- Grid Kartu Produk -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6" id="catalog-grid">
    @forelse ($products as $p)
        <div class="catalog-card custom-card flex flex-col justify-between group cursor-pointer {{ $p->stock == 0 ? 'opacity-70' : '' }}" data-id="{{ $p->id }}" data-name="{{ $p->name }} {{ $p->size }}" data-type="{{ $p->type }}" ondblclick="location.href='{{ route('buyer.product.show', $p->id) }}'">
            <div>
                <div class="relative w-full h-[180px] rounded-[16px] bg-[#F8FAF2] flex items-center justify-center overflow-hidden mb-5">
                    <div class="absolute top-3 left-3 z-10">
                        <x-badge-status :type="$p->type" />
                    </div>
                    @if ($p->stock == 0)
                        <div class="absolute top-3 right-3 z-10">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-[#FBDDC6] text-[#8C4A1A]">
                                Habis
                            </span>
                        </div>
                    @elseif ($p->stock <= 5)
                        <div class="absolute top-3 right-3 z-10">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-[#FAF1CE] text-[#7A6420]">
                                Menipis (Sisa {{ $p->stock }})
                            </span>
                        </div>
                    @endif
                    <div class="w-32 h-32 rounded-full bg-[#E8F3E1] flex items-center justify-center">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none">
                            <ellipse cx="36" cy="38" rx="26" ry="30" fill="#CFE6C5"/>
                            <polygon points="26,24 22,28 30,30" fill="#B7D7A8"/>
                            <polygon points="46,24 42,28 50,30" fill="#B7D7A8"/>
                        </svg>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-1.5">
                    <a href="{{ route('buyer.product.show', $p->id) }}" class="text-[20px] font-semibold text-[#1F261D] group-hover:text-[#7A6420] transition-colors truncate">
                        {{ $p->name }} {{ $p->size }}
                    </a>
                    <span class="text-[12px] text-[#6B7366] shrink-0">
                        @if($p->type === 'preorder')
                            Kuota: {{ $p->stock }}
                        @else
                            Sisa {{ $p->stock }} buah
                        @endif
                    </span>
                </div>

                <div class="flex items-center gap-2 mb-2">
                    <span class="w-6 h-6 rounded-full bg-[#CDEBD9] text-[#1F3318] font-bold text-[12px] flex items-center justify-center">
                        {{ $p->size }}
                    </span>
                    <span class="text-[14px] text-[#4A5246] font-medium">Est. {{ number_format($p->est_weight_gram / 1000, 1, ',', '.') }} kg</span>
                </div>

                @if($p->type === 'preorder' && $p->eta_text)
                    <p class="text-[12px] text-[#7A6420] mb-3 flex items-center gap-1 font-medium">
                        <span class="material-symbols-outlined text-[15px]">event</span>
                        <span>{{ $p->eta_text }}</span>
                    </p>
                @endif

                <div class="text-[24px] font-bold text-[#1F261D] mb-4">
                    Rp {{ number_format($p->price, 0, ',', '.') }}
                </div>
            </div>

            <div class="pt-4 border-t border-[#E4E9DA] flex items-center gap-3" onclick="event.stopPropagation()">
                @if($p->stock > 0)
                    <div class="flex items-center border border-[#E4E9DA] rounded-[10px] bg-white p-0.5">
                        <button type="button" class="w-8 h-8 rounded-[8px] flex items-center justify-center hover:bg-[#F8FAF2] text-[#4A5246] transition-colors" onclick="changeQty(this, -1)">
                            <span class="material-symbols-outlined text-[16px]">remove</span>
                        </button>
                        <span class="w-8 text-center text-[14px] font-semibold text-[#1F261D] select-none qty-number">1</span>
                        <button type="button" class="w-8 h-8 rounded-[8px] flex items-center justify-center hover:bg-[#F8FAF2] text-[#4A5246] transition-colors" onclick="changeQty(this, 1)">
                            <span class="material-symbols-outlined text-[16px]">add</span>
                        </button>
                    </div>
                    <a href="{{ route('buyer.cart') }}" class="flex-1 h-10 rounded-[12px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[#1F261D] text-[13px] font-semibold flex items-center justify-center gap-1.5 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                        <span>Tambah</span>
                    </a>
                @else
                    <button disabled class="w-full h-10 rounded-[12px] bg-[#E4E9DA] text-[#7A8275] text-[13px] font-semibold flex items-center justify-center gap-1.5 cursor-not-allowed">
                        <span>Stok Habis</span>
                    </button>
                @endif
            </div>
        </div>
    @empty
        <div class="col-span-3 text-center py-12 text-[#6B7366]">
            Tidak ada varian durian yang tersedia saat ini.
        </div>
    @endforelse
</div>

@push('scripts')
<script>
    function changeQty(btn, delta) {
        const parent = btn.parentElement;
        const numberSpan = parent.querySelector('.qty-number');
        let current = parseInt(numberSpan.textContent) || 1;
        current += delta;
        if (current < 1) current = 1;
        numberSpan.textContent = current;
    }

    // Client search filter
    const searchInput = document.getElementById('catalog-search');
    const cards = document.querySelectorAll('.catalog-card');

    searchInput?.addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();
        cards.forEach(card => {
            const name = (card.getAttribute('data-name') || '').toLowerCase();
            if (!query || name.includes(query)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>
@endpush
@endsection
