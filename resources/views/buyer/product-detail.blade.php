@extends('layouts.app')

@section('title', 'Detail Durian - DuREN')

@section('content')
<!-- Navigasi Kembali -->
<div class="mb-5">
    <a class="inline-flex items-center gap-1.5 text-[14px] font-medium text-[#7A6420] hover:underline transition-opacity" href="{{ url('/katalog') }}">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        <span>Kembali ke Katalog</span>
    </a>
</div>

<!-- Bagian Utama Produk -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
    <!-- Kolom Kiri: Kartu Ilustrasi Durian -->
    <div class="lg:col-span-5 custom-card relative min-h-[420px] flex items-center justify-center overflow-hidden">
        <div class="absolute top-6 left-6 z-10">
            <x-badge-status type="ready" />
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
                Montong L
            </h1>

            <div class="flex items-center gap-2.5 mt-3">
                <span class="inline-flex items-center bg-[#E3F1DC] rounded-full px-3 py-1 text-[12px] font-bold text-[#1F3318]">
                    L
                </span>
                <span class="inline-flex items-center bg-white border border-[#E4E9DA] rounded-full px-3 py-1 text-[12px] font-medium text-[#4A5246]">
                    Est. 3,2 kg
                </span>
            </div>

            <div class="flex items-baseline gap-3 mt-6">
                <span class="text-[36px] font-bold text-[#1F261D]">
                    Rp 250.000
                </span>
                <span class="text-[14px] text-[#6B7366]">
                    Harga per buah
                </span>
            </div>

            <div class="flex items-center gap-2 mt-4">
                <span class="material-symbols-outlined text-[20px] text-[#4E6B43]">inventory_2</span>
                <span class="text-[14px] text-[#4A5246]">Sisa 12 buah</span>
            </div>

            <hr class="border-t border-[#E4E9DA] my-6">

            <!-- Form Pemilihan Jumlah -->
            <div>
                <label class="block text-[14px] font-medium text-[#1F261D] mb-2">Jumlah</label>
                <div class="inline-flex items-center border border-[#E4E9DA] rounded-[12px] bg-white p-1">
                    <button class="w-10 h-10 rounded-[10px] bg-white hover:bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-center text-[#1F261D] transition-colors cursor-pointer" id="btn-minus" type="button" onclick="updateDetailQty(-1)">
                        <span class="material-symbols-outlined text-[18px]">remove</span>
                    </button>
                    <span class="w-12 text-center text-[16px] font-semibold text-[#1F261D] select-none" id="qty-val">1</span>
                    <button class="w-10 h-10 rounded-[10px] bg-white hover:bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-center text-[#1F261D] transition-colors cursor-pointer" id="btn-plus" type="button" onclick="updateDetailQty(1)">
                        <span class="material-symbols-outlined text-[18px]">add</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi Keranjang -->
        <div class="flex flex-col sm:flex-row items-center gap-4 mt-8">
            <a href="{{ url('/keranjang') }}" class="w-full sm:flex-1 h-12 px-6 rounded-[14px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[#1F261D] font-semibold text-[14px] flex items-center justify-center gap-2 transition-all shadow-sm">
                <span class="material-symbols-outlined text-[20px]">add_shopping_cart</span>
                <span>Tambah ke Keranjang</span>
            </a>
            <a href="{{ url('/keranjang') }}" class="w-full sm:w-auto h-12 px-6 rounded-[14px] bg-white hover:bg-[#F8FAF2] border border-[#E4E9DA] text-[#1F261D] font-medium text-[14px] flex items-center justify-center transition-all">
                Lihat Keranjang
            </a>
        </div>
    </div>
</div>

<!-- Dua Kartu Sejajar di Bawah (50/50 Grid) -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
    <!-- Kartu Deskripsi -->
    <div class="custom-card p-6">
        <h2 class="text-[20px] font-semibold text-[#1F261D] mb-3">Deskripsi</h2>
        <p class="text-[14px] text-[#4A5246] leading-relaxed">
            Durian Montong ukuran L dengan estimasi berat 3,2 kg. Daging buah tebal berwarna kuning keemasan dengan tekstur lembut, rasa manis legit yang dominan, serta aroma harum khas yang menggugah selera.
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
                    Baca <a class="text-[#7A6420] underline font-semibold hover:opacity-80" href="{{ url('/aturan-garansi') }}">Aturan & Garansi</a> sebelum membayar
                </span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function updateDetailQty(delta) {
        const valSpan = document.getElementById('qty-val');
        let current = parseInt(valSpan.textContent) || 1;
        current = Math.max(1, current + delta);
        valSpan.textContent = current;
    }
</script>
@endpush
@endsection
