@extends('layouts.app')

@section('title', 'Detail Pesanan - DuREN')

@section('content')
<!-- Navigasi Kembali -->
<div class="mb-5">
    <a class="inline-flex items-center gap-1.5 text-[14px] font-medium text-[#7A6420] hover:underline" href="{{ url('/pesanan-saya') }}">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        <span>Kembali ke Pesanan Saya</span>
    </a>
</div>

<!-- Header Title & Status -->
<div class="flex flex-col gap-1 pb-6">
    <div class="flex items-center gap-3 flex-wrap">
        <h1 class="text-[36px] font-bold text-[#1F261D] tracking-tight">
            Pesanan {{ $code ?? 'DRN-0039' }}
        </h1>
        <x-badge-status type="shipped" />
    </div>
    <div class="flex items-center gap-2 text-[13px] text-[#6B7366]">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-[#F1F5E8] text-[#1F3318] font-medium text-[12px]">
            Ready Stock
        </span>
        <span class="text-[#7A8275]">•</span>
        <span>Dibuat 18 Okt 2026, 10:05 WIB</span>
    </div>
</div>

<!-- 2-Column Dashboard Grid: 8 Cols (Left) and 4 Cols (Right) -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
    <!-- LEFT COLUMN (8 COLS) -->
    <div class="lg:col-span-8 space-y-6">
        <!-- CARD 1: Alur Status -->
        <div class="custom-card p-6 bg-white">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-[18px] font-semibold text-[#1F261D]">Alur Status</h2>
                <span class="text-[13px] text-[#6B7366] flex items-center gap-1.5">
                    <span class="inline-block w-2 h-2 rounded-full bg-[#F2D98A] animate-pulse"></span>
                    <span>Dalam perjalanan</span>
                </span>
            </div>

            <!-- Steps Tracker Horizontal -->
            <div class="w-full overflow-x-auto pb-2">
                <div class="min-w-[580px] flex items-center justify-between relative px-2">
                    <!-- Step 1: Bayar -->
                    <div class="flex flex-col items-center gap-1.5 relative z-10">
                        <div class="w-8 h-8 rounded-full bg-[#E3F1DC] flex items-center justify-center text-[#1F3318]">
                            <span class="material-symbols-outlined text-[18px]">check</span>
                        </div>
                        <span class="text-[12px] font-medium text-[#1F261D]">Bayar</span>
                    </div>
                    <div class="flex-1 h-[2px] bg-[#E3F1DC] mx-2"></div>

                    <!-- Step 2: Verifikasi -->
                    <div class="flex flex-col items-center gap-1.5 relative z-10">
                        <div class="w-8 h-8 rounded-full bg-[#E3F1DC] flex items-center justify-center text-[#1F3318]">
                            <span class="material-symbols-outlined text-[18px]">check</span>
                        </div>
                        <span class="text-[12px] font-medium text-[#1F261D]">Verifikasi</span>
                    </div>
                    <div class="flex-1 h-[2px] bg-[#E3F1DC] mx-2"></div>

                    <!-- Step 3: Ongkir -->
                    <div class="flex flex-col items-center gap-1.5 relative z-10">
                        <div class="w-8 h-8 rounded-full bg-[#E3F1DC] flex items-center justify-center text-[#1F3318]">
                            <span class="material-symbols-outlined text-[18px]">check</span>
                        </div>
                        <span class="text-[12px] font-medium text-[#1F261D]">Ongkir</span>
                    </div>
                    <div class="flex-1 h-[2px] bg-[#E3F1DC] mx-2"></div>

                    <!-- Step 4: Proses -->
                    <div class="flex flex-col items-center gap-1.5 relative z-10">
                        <div class="w-8 h-8 rounded-full bg-[#E3F1DC] flex items-center justify-center text-[#1F3318]">
                            <span class="material-symbols-outlined text-[18px]">check</span>
                        </div>
                        <span class="text-[12px] font-medium text-[#1F261D]">Proses</span>
                    </div>
                    <div class="flex-1 h-[2px] bg-[#E3F1DC] mx-2"></div>

                    <!-- Step 5: Kirim -->
                    <div class="flex flex-col items-center gap-1.5 relative z-10">
                        <div class="w-8 h-8 rounded-full bg-[#F2D98A] flex items-center justify-center text-[#5C4A12] ring-4 ring-[#FAF1CE]">
                            <span class="material-symbols-outlined text-[18px]">local_shipping</span>
                        </div>
                        <span class="text-[12px] font-bold text-[#5C4A12]">Kirim</span>
                    </div>
                    <div class="flex-1 h-[2px] bg-[#E4E9DA] mx-2"></div>

                    <!-- Step 6: Selesai -->
                    <div class="flex flex-col items-center gap-1.5 relative z-10">
                        <div class="w-8 h-8 rounded-full bg-[#F1F5E8] flex items-center justify-center text-[#7A8275]">
                            <span class="material-symbols-outlined text-[16px]">check</span>
                        </div>
                        <span class="text-[12px] text-[#6B7366]">Selesai</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD 2: Item Pesanan -->
        <div class="custom-card p-6 bg-white">
            <h2 class="text-[18px] font-semibold text-[#1F261D] mb-4">Item Pesanan</h2>
            <div class="space-y-3">
                <div class="p-3 rounded-xl bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#E8F3E1] flex items-center justify-center text-[#1F3318]">
                            <span class="material-symbols-outlined text-[20px]">eco</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-[14px] text-[#1F261D]">Montong M (3 buah)</h4>
                            <span class="text-[12px] text-[#6B7366]">Est. 2,4 kg per buah</span>
                        </div>
                    </div>
                    <span class="font-bold text-[16px] text-[#1F261D]">Rp 570.000</span>
                </div>
            </div>
        </div>

        <!-- CARD 3: Info Pengiriman & Resi -->
        <div class="custom-card p-6 bg-white">
            <h2 class="text-[18px] font-semibold text-[#1F261D] mb-4">Info Pengiriman</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="p-3.5 rounded-xl bg-[#F8FAF2] border border-[#E4E9DA]">
                    <span class="text-[12px] text-[#6B7366] block">Kurir Pengiriman</span>
                    <span class="font-semibold text-[14px] text-[#1F261D] mt-0.5 block">Lalamove</span>
                </div>
                <div class="p-3.5 rounded-xl bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-between">
                    <div>
                        <span class="text-[12px] text-[#6B7366] block">Nomor Resi</span>
                        <span class="font-mono font-bold text-[14px] text-[#1F261D] mt-0.5 block">LLM-892104-JKT</span>
                    </div>
                    <button type="button" class="px-2.5 py-1 rounded-[8px] bg-white border border-[#E4E9DA] text-[12px] font-medium text-[#1F261D] hover:bg-[#F8FAF2]" onclick="navigator.clipboard.writeText('LLM-892104-JKT'); this.innerText='Tersalin!';">
                        Salin
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT COLUMN (4 COLS) -->
    <div class="lg:col-span-4 space-y-6">
        <!-- CARD: Rincian Pembayaran -->
        <div class="custom-card p-6 bg-white">
            <h2 class="text-[18px] font-semibold text-[#1F261D] mb-4">Rincian Pembayaran</h2>
            <div class="space-y-3 pb-4 border-b border-[#E4E9DA]">
                <div class="flex items-center justify-between text-[14px]">
                    <span class="text-[#4A5246]">Tagihan Buah</span>
                    <span class="font-bold text-[#1F261D]">Rp 570.000</span>
                </div>
                <div class="flex items-center justify-between text-[14px]">
                    <span class="text-[#4A5246]">Status Pembayaran</span>
                    <span class="text-[12px] font-semibold text-[#1F3318] bg-[#E8F3E1] px-2.5 py-0.5 rounded-full">Lunas QRIS</span>
                </div>
                <div class="flex items-center justify-between text-[14px]">
                    <span class="text-[#4A5246]">Ongkos Kirim</span>
                    <span class="text-[12px] font-semibold text-[#1F3318] bg-[#CDEBD9] px-2.5 py-0.5 rounded-full">Lunas via WA</span>
                </div>
            </div>

            <div class="pt-4 flex flex-col gap-3">
                <button type="button" class="w-full h-11 rounded-[12px] bg-[#E3F1DC] hover:bg-[#CFE6C5] text-[#1F3318] font-semibold text-[13px] flex items-center justify-center transition-colors">
                    Konfirmasi Pesanan Diterima
                </button>
                <a href="https://wa.me/62881081111833" target="_blank" class="w-full h-11 rounded-[12px] bg-white hover:bg-[#F8FAF2] border border-[#E4E9DA] text-[#1F261D] font-medium text-[13px] flex items-center justify-center gap-1.5 transition-colors">
                    <span class="material-symbols-outlined text-[16px] text-[#4E6B43]">chat</span>
                    <span>Hubungi Admin WhatsApp</span>
                </a>
            </div>
        </div>

        <!-- CARD: Alamat Pengiriman -->
        <div class="custom-card p-6 bg-white">
            <h2 class="text-[18px] font-semibold text-[#1F261D] mb-3">Alamat Pengiriman</h2>
            <div class="space-y-1">
                <span class="font-semibold text-[14px] text-[#1F261D] block">Rina (0812-3456-7890)</span>
                <p class="text-[13px] text-[#4A5246] leading-relaxed">
                    Jl. Melati No. 18, Cilandak Barat, Jakarta Selatan, DKI Jakarta 12430
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
