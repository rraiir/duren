@extends('layouts.app')

@php
    $otherProducts = $otherProducts ?? collect();
@endphp

@section('title', $product->name . ' ' . $product->size . ' - DuREN')

@section('content')
<!-- Navigasi Kembali -->
<div class="mb-5">
    <a class="inline-flex items-center gap-1.5 text-[14px] font-medium text-[#7A6420] hover:underline transition-opacity" href="{{ route('buyer.catalog') }}">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        <span>Kembali ke Katalog</span>
    </a>
</div>

<!-- Bagian Utama Produk -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
    <!-- Kolom Kiri: Kartu Ilustrasi Durian -->
    <div class="lg:col-span-5 custom-card relative min-h-[420px] flex items-center justify-center overflow-hidden">
        <div class="absolute top-6 left-6 z-10">
            <x-badge-status :type="$product->type" />
        </div>
        <div class="relative w-[280px] h-[280px] flex items-center justify-center">
            <div class="absolute w-56 h-56 rounded-full bg-[#FAF1CE] opacity-80 -top-2 -right-2"></div>
            <div class="absolute w-52 h-52 rounded-full bg-[#E8F3E1] opacity-90 -bottom-3 -left-3"></div>
            <svg class="relative z-10 w-64 h-64 drop-shadow-sm" fill="none" viewBox="0 0 240 240" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="120" cy="128" fill="#CFE6C5" rx="72" ry="76"></ellipse>
                <path d="M78 88 C78 72, 162 72, 162 88 C162 135, 154 182, 120 188 C86 182, 78 135, 78 88 Z" fill="#F8FAF2"></path>
                <path d="M96 92 C88 96, 86 114, 94 122 C102 130, 114 126, 115 115 C116 102, 106 87, 96 92 Z" fill="#F2D98A"></path>
                <path d="M144 92 C152 96, 154 114, 146 122 C138 130, 126 126, 125 115 C124 102, 134 87, 144 92 Z" fill="#F2D98A"></path>
                <path d="M120 128 C110 130, 106 148, 114 160 C121 170, 131 168, 133 158 C135 146, 129 126, 120 128 Z" fill="#F2D98A"></path>
            </svg>
        </div>
    </div>

    <!-- Kolom Kanan: Detail Informasi & Form Pembelian -->
    <div class="lg:col-span-7 custom-card p-8 flex flex-col justify-between">
        <div>
            <h1 class="text-[36px] font-bold text-[#1F261D] tracking-tight">
                {{ $product->name }} {{ $product->size }}
            </h1>

            <!-- Rating Bintang & Review Count -->
            <div class="flex items-center gap-2 mt-2">
                <div class="flex items-center text-[#E5A000]">
                    @for($i=1; $i<=5; $i++)
                        <span class="material-symbols-outlined text-[18px] fill-current">star</span>
                    @endfor
                </div>
                <span class="text-[14px] font-bold text-[#1F261D]">{{ number_format($product->average_rating, 1) }}</span>
                <span class="text-[13px] text-[#7A8275]">({{ $product->review_count }} Ulasan Pembeli)</span>
            </div>

            <div class="flex items-center gap-2.5 mt-3">
                <span class="inline-flex items-center bg-[#E3F1DC] rounded-full px-3 py-1 text-[12px] font-bold text-[#1F3318]">
                    {{ $product->size }}
                </span>
                <span class="inline-flex items-center bg-white border border-[#E4E9DA] rounded-full px-3 py-1 text-[12px] font-medium text-[#4A5246]">
                    Est. {{ number_format($product->est_weight_gram / 1000, 1, ',', '.') }} kg
                </span>
            </div>

            <div class="flex items-baseline gap-3 mt-6">
                <span class="text-[36px] font-bold text-[#1F261D]">
                    {{ numberToRupiah($product->price) }}
                </span>
                <span class="text-[14px] text-[#6B7366]">
                    Harga per buah
                </span>
            </div>

            <div class="flex items-center gap-2 mt-4">
                <span class="material-symbols-outlined text-[20px] text-[#4E6B43]">inventory_2</span>
                <span class="text-[14px] text-[#4A5246]">
                    @if($product->type === 'preorder')
                        Kuota tersedia: {{ $product->stock }} buah
                    @else
                        Sisa {{ $product->stock }} buah
                    @endif
                </span>
            </div>

            @if($product->type === 'preorder' && $product->eta_text)
                <p class="text-[13px] text-[#7A6420] mt-2 font-medium flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[17px]">event</span>
                    <span>{{ $product->eta_text }}</span>
                </p>
            @endif

            <hr class="border-t border-[#E4E9DA] my-6">
        </div>

        <!-- Form Pemesanan & Modul Tawar Harga inDrive -->
        <form id="orderForm" method="GET" action="{{ route('buyer.checkout') }}" class="space-y-6">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" id="inputQuantity" value="1">
                <input type="hidden" name="is_negotiated" id="inputIsNego" value="0">
                <input type="hidden" name="proposed_price" id="inputProposedPrice" value="{{ $product->price }}">

                <!-- Pemilihan Jumlah Buah -->
                <div class="flex items-center justify-between">
                    <div>
                        <label class="block text-[14px] font-medium text-[#1F261D]">Jumlah Buah</label>
                        <span class="text-[12px] text-[#6B7366]">Pesan per butir utuh</span>
                    </div>
                    <div class="inline-flex items-center border border-[#E4E9DA] rounded-[12px] bg-white p-1">
                        <button class="w-10 h-10 rounded-[10px] bg-white hover:bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-center text-[#1F261D] transition-colors cursor-pointer" type="button" onclick="updateDetailQty(-1)">
                            <span class="material-symbols-outlined text-[18px]">remove</span>
                        </button>
                        <span class="w-12 text-center text-[16px] font-semibold text-[#1F261D] select-none" id="qty-val">1</span>
                        <button class="w-10 h-10 rounded-[10px] bg-white hover:bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-center text-[#1F261D] transition-colors cursor-pointer" type="button" onclick="updateDetailQty(1, {{ $product->stock }})">
                            <span class="material-symbols-outlined text-[18px]">add</span>
                        </button>
                    </div>
                </div>

                <!-- MODUL TAWAR HARGA ALA INDRIVE -->
                <div class="p-5 rounded-[18px] bg-[#F8FAF2] border-2 border-[#CFE6C5] space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#2E7D32] text-[22px]">handshake</span>
                            <span class="text-[15px] font-bold text-[#1F261D]">Tawarkan Harga Anda (Nego inDrive)</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="toggleNego" class="sr-only peer" onchange="toggleNegoMode(this.checked)">
                            <div class="w-11 h-6 bg-[#E2E2E2] rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-[#E4E9DA] after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#2E7D32]"></div>
                        </label>
                    </div>

                    <div id="negoBox" class="hidden pt-3 border-t border-[#E4E9DA] space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-[13px] text-[#6B7366]">Harga Katalog:</span>
                            <span class="text-[13px] font-semibold text-[#6B7366] line-through">{{ numberToRupiah($product->price) }}</span>
                        </div>

                        <!-- Stepper Tawaran inDrive -->
                        <div class="bg-white p-4 rounded-[14px] border border-[#B7D7A8] flex items-center justify-between shadow-xs">
                            <button type="button" class="w-10 h-10 rounded-[10px] bg-[#F8FAF2] hover:bg-[#E8F5E9] text-[#2E7D32] flex items-center justify-center transition-colors font-bold text-[18px] cursor-pointer" onclick="adjustNego(-5000)">
                                <span class="material-symbols-outlined text-[20px]">remove</span>
                            </button>
                            <div class="text-center">
                                <span class="text-[12px] text-[#6B7366] block">Tawaran Anda per Buah</span>
                                <span class="text-[24px] font-bold text-[#1F261D]" id="displayNegoPrice">{{ numberToRupiah($product->price) }}</span>
                                <span class="text-[11px] text-[#2E7D32] font-semibold block" id="displayHemat">Hemat Rp 0</span>
                            </div>
                            <button type="button" class="w-10 h-10 rounded-[10px] bg-[#F8FAF2] hover:bg-[#E8F5E9] text-[#2E7D32] flex items-center justify-center transition-colors font-bold text-[18px] cursor-pointer" onclick="adjustNego(5000)">
                                <span class="material-symbols-outlined text-[20px]">add</span>
                            </button>
                        </div>
                        <p class="text-[11px] text-[#7A8275] italic leading-tight">
                            *Batas penawaran minimal: {{ numberToRupiah($product->min_negotiation_price) }}. Tawaran akan diverifikasi oleh Admin.
                        </p>
                    </div>
                </div>

                <!-- Tombol Aksi Pesan -->
                <div class="flex flex-col sm:flex-row items-center gap-3 pt-2">
                    @if ($product->stock > 0)
                        <button type="submit" id="btnSubmitOrder" class="w-full sm:flex-1 h-12 px-6 rounded-[14px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[#1F261D] font-semibold text-[14px] flex items-center justify-center gap-2 transition-all shadow-xs cursor-pointer">
                            <span class="material-symbols-outlined text-[20px]">shopping_cart_checkout</span>
                            <span id="btnOrderText">Pesan Sekarang</span>
                        </button>
                    @else
                        <button disabled class="w-full sm:flex-1 h-12 px-6 rounded-[14px] bg-[#E4E9DA] text-[#7A8275] font-semibold text-[14px] flex items-center justify-center gap-2 cursor-not-allowed">
                            Stok Habis
                        </button>
                    @endif
                    <a href="{{ route('buyer.catalog') }}" class="w-full sm:w-auto h-12 px-6 rounded-[14px] bg-white hover:bg-[#F8FAF2] border border-[#E4E9DA] text-[#1F261D] font-medium text-[14px] flex items-center justify-center transition-all">
                        Kembali ke Katalog
                    </a>
                </div>
            </form>
    </div>
</div>

<!-- Dua Kartu Sejajar di Bawah (50/50 Grid) -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
    <!-- Kartu Deskripsi -->
    <div class="custom-card p-6">
        <h2 class="text-[20px] font-semibold text-[#1F261D] mb-3">Deskripsi Karakter Durian</h2>
        <p class="text-[14px] text-[#4A5246] leading-relaxed">
            {{ $product->description ?: 'Durian pilihan berkualitas tinggi dengan aroma wangi semerbak, biji kempes, dan daging tebal yang memanjakan lidah para penikmat durian sejati.' }}
        </p>
    </div>

    <!-- Kartu Info Penting -->
    <div class="custom-card p-6">
        <h2 class="text-[20px] font-semibold text-[#1F261D] mb-4">Info Penting</h2>
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-[#E3F1DC] flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[18px] text-[#1F3318]">scale</span>
                </div>
                <span class="text-[14px] font-medium text-[#1F261D]">Berat hanya estimasi</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-[#F2D98A] flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[18px] text-[#5C4A12]">sell</span>
                </div>
                <span class="text-[14px] font-medium text-[#1F261D]">Harga tetap per buah</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-[#CDEBD9] flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[18px] text-[#1F3318]">verified_user</span>
                </div>
                <span class="text-[14px] font-medium text-[#1F261D]">
                    Baca <a class="text-[#7A6420] underline font-semibold hover:opacity-80" href="{{ route('buyer.rules') }}">Aturan & Garansi</a> sebelum membayar
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Bagian Ulasan & Testimoni Pelanggan -->
<div class="mt-12 custom-card p-6 md:p-8 bg-white">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-5 border-b border-[#E4E9DA] mb-6 gap-3">
        <div>
            <h2 class="text-[22px] font-bold text-[#1F261D]">Ulasan Pembeli ({{ $product->review_count }})</h2>
            <p class="text-[14px] text-[#6B7366] mt-0.5">Penilaian rasa dan kualitas langsung dari penikmat durian terverifikasi.</p>
        </div>
        <div class="flex items-center gap-2 bg-[#E3F1DC] px-4 py-2 rounded-[14px] self-start sm:self-auto">
            <span class="material-symbols-outlined text-[#E5A000] text-[22px] fill-current">star</span>
            <span class="text-[18px] font-bold text-[#1F3318]">{{ number_format($product->average_rating, 1) }}</span>
            <span class="text-[13px] text-[#4A5246]">/ 5.0</span>
        </div>
    </div>

    @if($product->reviews->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($product->reviews as $rev)
                <div class="p-5 rounded-[16px] bg-[#F8FAF2] border border-[#E4E9DA] space-y-2.5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-full bg-[#E3F1DC] text-[#1F3318] font-bold text-[13px] flex items-center justify-center">
                                {{ strtoupper(substr($rev->user->name ?? 'P', 0, 1)) }}
                            </div>
                            <div>
                                <span class="font-semibold text-[14px] text-[#1F261D] block">{{ $rev->user->name ?? 'Pembeli Terverifikasi' }}</span>
                                <span class="text-[11px] text-[#7A8275]">{{ $rev->created_at ? $rev->created_at->diffForHumans() : 'Baru saja' }}</span>
                            </div>
                        </div>
                        <div class="flex items-center text-[#E5A000]">
                            @for($i=1; $i<=$rev->rating; $i++)
                                <span class="material-symbols-outlined text-[15px] fill-current">star</span>
                            @endfor
                        </div>
                    </div>
                    <p class="text-[13px] text-[#4A5246] leading-relaxed italic">
                        "{{ $rev->comment }}"
                    </p>
                </div>
            @endforeach
        </div>
    @else
        <div class="py-8 text-center text-[#6B7366]">
            <span class="material-symbols-outlined text-[36px] text-[#A6AEA0] mb-2 block">rate_review</span>
            <span>Belum ada ulasan untuk varian ini. Jadilah pembeli pertama yang memberikan ulasan!</span>
        </div>
    @endif
</div>

@if ($otherProducts->isNotEmpty())
    <!-- Produk Aktif Lainnya -->
    <div class="mt-12">
        <h2 class="text-[24px] font-bold text-[#1F261D] mb-6">Varian Durian Lainnya</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($otherProducts as $op)
                <a href="{{ route('buyer.product.show', $op->id) }}" class="custom-card p-5 hover-lift flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[18px] font-bold text-[#1F261D] group-hover:text-[#7A6420] transition-colors">
                                {{ $op->name }} {{ $op->size }}
                            </span>
                            <x-badge-status :type="$op->type" />
                        </div>
                        <p class="text-[13px] text-[#6B7366] line-clamp-2 mb-4">
                            {{ $op->description ?: 'Durian utuh pilihan berkualitas dengan rasa nikmat.' }}
                        </p>
                    </div>
                    <div class="flex items-baseline justify-between pt-3 border-t border-[#E4E9DA]">
                        <span class="text-[13px] text-[#6B7366]">Est. {{ number_format($op->est_weight_gram / 1000, 1, ',', '.') }} kg</span>
                        <span class="text-[18px] font-bold text-[#1F261D]">{{ numberToRupiah($op->price) }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif

@push('scripts')
<script>
    const basePrice = {{ $product->price }};
    const minNegoPrice = {{ $product->min_negotiation_price }};
    let currentNegoPrice = basePrice;
    let isNegoActive = false;

    function formatRupiah(num) {
        return 'Rp ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function updateDetailQty(delta, maxStock = 999) {
        const valSpan = document.getElementById('qty-val');
        let current = parseInt(valSpan.textContent) || 1;
        current = Math.max(1, Math.min(maxStock, current + delta));
        valSpan.textContent = current;
        document.getElementById('inputQuantity').value = current;
    }

    function toggleNegoMode(active) {
        isNegoActive = active;
        const box = document.getElementById('negoBox');
        const inputIsNego = document.getElementById('inputIsNego');
        const btnText = document.getElementById('btnOrderText');

        if (active) {
            box.classList.remove('hidden');
            inputIsNego.value = '1';
            currentNegoPrice = Math.max(minNegoPrice, basePrice - 10000);
            updateNegoDisplay();
            btnText.textContent = 'Ajukan Tawaran & Pesan';
        } else {
            box.classList.add('hidden');
            inputIsNego.value = '0';
            currentNegoPrice = basePrice;
            document.getElementById('inputProposedPrice').value = basePrice;
            btnText.textContent = 'Pesan Sekarang';
        }
    }

    function adjustNego(delta) {
        currentNegoPrice = Math.max(minNegoPrice, Math.min(basePrice, currentNegoPrice + delta));
        updateNegoDisplay();
    }

    function updateNegoDisplay() {
        document.getElementById('displayNegoPrice').textContent = formatRupiah(currentNegoPrice);
        document.getElementById('inputProposedPrice').value = currentNegoPrice;
        const hemat = basePrice - currentNegoPrice;
        document.getElementById('displayHemat').textContent = hemat > 0 ? 'Hemat ' + formatRupiah(hemat) + ' per buah' : 'Harga Katalog Normal';
    }
</script>
@endpush
@endsection
