@extends('layouts.app')

@section('title', 'Pembayaran QRIS - DuREN')

@section('content')
<!-- 1. Header Halaman -->
<div class="flex flex-col mb-8">
    <div class="mb-3">
        <a class="inline-flex items-center gap-1.5 text-[14px] font-medium text-[#7A6420] hover:underline" href="{{ url('/pesanan-saya') }}">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Pesanan Saya</span>
        </a>
    </div>
    <div class="flex items-center gap-3 flex-wrap">
        <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">Pembayaran</h1>
        <x-badge-status type="waiting_payment" />
    </div>
    <p class="text-[16px] text-[#6B7366]">Pesanan {{ $code ?? 'DRN-0042' }}</p>
</div>

<!-- 2. Kartu Sisa Waktu Bayar -->
<div class="w-full rounded-[20px] bg-white p-6 shadow-[0_8px_24px_rgba(40,52,30,0.06)] border border-[#E4E9DA] flex flex-col gap-4 mb-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-2">
        <div class="flex flex-col">
            <span class="text-[18px] font-semibold text-[#1F261D]">Sisa Waktu Bayar</span>
            <span class="text-[36px] font-bold text-[#1F261D] tracking-tight font-mono" id="countdown-timer">01:40:03</span>
        </div>
        <div class="flex items-center gap-2 text-[#6B7366] text-[14px]">
            <span class="material-symbols-outlined text-[18px] text-[#4E6B43]">schedule</span>
            <span>Pesanan dibatalkan otomatis jika belum dibayar dalam 2 jam.</span>
        </div>
    </div>
    <div class="w-full h-2 rounded-full bg-[#F1F5E8] overflow-hidden">
        <div class="h-full bg-[#F2D98A] rounded-full transition-all duration-500 ease-out" style="width: 65%;"></div>
    </div>
</div>

<!-- 3. Grid Dua Kolom (1:1) -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-stretch">
    <!-- Kolom Kiri: QRIS Card -->
    <div class="rounded-[20px] bg-white p-6 shadow-[0_8px_24px_rgba(40,52,30,0.06)] border border-[#E4E9DA] flex flex-col justify-between gap-6">
        <div class="flex flex-col gap-5">
            <div class="flex items-center justify-between">
                <h2 class="text-[20px] font-semibold text-[#1F261D]">Bayar dengan QRIS</h2>
            </div>

            <!-- QR Display Container -->
            <div class="flex flex-col items-center justify-center p-6 bg-[#F8FAF2] rounded-[16px] border border-[#E4E9DA]">
                <div class="relative w-[240px] h-[240px] bg-white rounded-[14px] p-3 flex flex-col items-center justify-center border border-[#E4E9DA] shadow-sm">
                    <!-- Crisp Geometric QR SVG -->
                    <svg class="w-[190px] h-[190px] text-[#1F261D]" fill="currentColor" viewBox="0 0 100 100">
                        <rect fill="none" height="28" rx="4" stroke="currentColor" stroke-width="6" width="28" x="2" y="2"></rect>
                        <rect fill="currentColor" height="14" rx="2" width="14" x="9" y="9"></rect>
                        <rect fill="none" height="28" rx="4" stroke="currentColor" stroke-width="6" width="28" x="70" y="2"></rect>
                        <rect fill="currentColor" height="14" rx="2" width="14" x="77" y="9"></rect>
                        <rect fill="none" height="28" rx="4" stroke="currentColor" stroke-width="6" width="28" x="2" y="70"></rect>
                        <rect fill="currentColor" height="14" rx="2" width="14" x="9" y="77"></rect>
                        <rect height="6" rx="1" width="6" x="36" y="4"></rect>
                        <rect height="12" rx="1" width="6" x="46" y="4"></rect>
                        <rect height="6" rx="1" width="6" x="58" y="4"></rect>
                        <rect height="10" rx="1" width="6" x="4" y="36"></rect>
                        <rect height="6" rx="1" width="8" x="14" y="40"></rect>
                        <rect height="6" rx="1" width="6" x="26" y="36"></rect>
                        <rect height="6" rx="1" width="10" x="36" y="22"></rect>
                        <rect height="6" rx="1" width="12" x="52" y="22"></rect>
                        <rect height="8" rx="1" width="8" x="36" y="34"></rect>
                        <rect height="8" rx="1" width="8" x="48" y="34"></rect>
                        <rect height="6" rx="1" width="12" x="60" y="34"></rect>
                        <rect height="14" rx="1" width="6" x="34" y="48"></rect>
                        <rect height="6" rx="1" width="12" x="44" y="46"></rect>
                        <rect height="12" rx="1" width="8" x="60" y="46"></rect>
                        <rect height="6" rx="1" width="8" x="72" y="40"></rect>
                        <rect height="8" rx="1" width="12" x="84" y="36"></rect>
                        <rect height="12" rx="1" width="6" x="84" y="48"></rect>
                        <rect height="12" rx="1" width="8" x="44" y="58"></rect>
                        <rect height="6" rx="1" width="6" x="56" y="64"></rect>
                        <rect height="8" rx="1" width="10" x="66" y="62"></rect>
                        <rect height="6" rx="1" width="16" x="80" y="64"></rect>
                        <rect height="6" rx="1" width="8" x="36" y="76"></rect>
                        <rect height="6" rx="1" width="14" x="48" y="74"></rect>
                        <rect height="8" rx="1" width="14" x="36" y="86"></rect>
                        <rect height="8" rx="1" width="12" x="54" y="86"></rect>
                        <rect height="18" rx="1" width="8" x="70" y="76"></rect>
                        <rect height="8" rx="1" width="14" x="82" y="76"></rect>
                        <rect height="6" rx="1" width="12" x="82" y="88"></rect>
                    </svg>
                    <div class="mt-2 inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-[#E8F3E1] border border-[#CFE6C5]">
                        <span class="material-symbols-outlined text-[13px] text-[#4E6B43]">qr_code_2</span>
                        <span class="text-[12px] font-semibold text-[#1F3318]">QRIS DuREN</span>
                    </div>
                </div>
                <span class="mt-3 text-[13px] text-[#6B7366]">Scan dengan aplikasi e-wallet atau mobile banking apa pun.</span>
            </div>

            <!-- Total Tagihan -->
            <div class="p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-between">
                <div class="flex flex-col">
                    <span class="text-[13px] text-[#6B7366]">Total tagihan</span>
                    <span class="text-[32px] font-bold text-[#1F261D] tracking-tight">Rp 440.000</span>
                </div>
            </div>
        </div>

        <!-- 3 Petunjuk -->
        <div class="pt-4 border-t border-[#E4E9DA] flex flex-col gap-2">
            <span class="text-[14px] font-semibold text-[#4A5246]">Petunjuk Pembayaran:</span>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 text-[13px]">
                <div class="flex items-center gap-2 p-1">
                    <div class="w-6 h-6 rounded-full bg-[#E8F3E1] text-[#1F3318] flex items-center justify-center font-bold shrink-0">1</div>
                    <span class="text-[#1F261D]">Scan kode QRIS</span>
                </div>
                <div class="flex items-center gap-2 p-1">
                    <div class="w-6 h-6 rounded-full bg-[#E8F3E1] text-[#1F3318] flex items-center justify-center font-bold shrink-0">2</div>
                    <span class="text-[#1F261D]">Bayar sesuai nominal</span>
                </div>
                <div class="flex items-center gap-2 p-1">
                    <div class="w-6 h-6 rounded-full bg-[#E8F3E1] text-[#1F3318] flex items-center justify-center font-bold shrink-0">3</div>
                    <span class="text-[#1F261D]">Unggah bukti transfer</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Upload Bukti Card -->
    <div class="rounded-[20px] bg-white p-6 shadow-[0_8px_24px_rgba(40,52,30,0.06)] border border-[#E4E9DA] flex flex-col justify-between gap-6">
        <div class="flex flex-col gap-4 flex-1">
            <div class="flex items-center justify-between">
                <h2 class="text-[20px] font-semibold text-[#1F261D]">Unggah Bukti Bayar</h2>
                <span class="text-[13px] text-[#6B7366] font-medium">Unggahan 0 dari 2</span>
            </div>

            <!-- Dropzone Area -->
            <div class="border-2 border-dashed border-[#B7D7A8] bg-[#F8FAF2] rounded-[16px] p-8 flex flex-col items-center justify-center text-center cursor-pointer hover:bg-[#F1F5E8] transition-colors group">
                <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center mb-3 shadow-sm group-hover:scale-105 transition-transform">
                    <span class="material-symbols-outlined text-[24px] text-[#4E6B43]">upload_file</span>
                </div>
                <span class="text-[14px] font-semibold text-[#1F261D]">Pilih foto atau screenshot bukti transfer</span>
                <span class="text-[12px] text-[#6B7366] mt-1">Format JPG atau PNG, ukuran maksimal 2 MB</span>
            </div>

            <!-- Informasi Verifikasi -->
            <div class="p-4 rounded-[14px] bg-[#FAF1CE] border border-[#ECDDA1] flex items-start gap-3">
                <span class="material-symbols-outlined text-[20px] text-[#7A6420] shrink-0 mt-0.5">verified_user</span>
                <p class="text-[13px] text-[#5C4A12] leading-relaxed">
                    Admin memeriksa bukti transfer secara manual dan mencocokkannya dengan mutasi rekening.
                </p>
            </div>
        </div>

        <div class="pt-4 border-t border-[#E4E9DA]">
            <a href="{{ url('/pesanan-saya/' . ($code ?? 'DRN-0042')) }}" class="w-full h-12 rounded-[14px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[#1F261D] font-semibold text-[14px] flex items-center justify-center gap-2 transition-all shadow-sm">
                <span>Kirim Bukti Pembayaran</span>
                <span class="material-symbols-outlined text-[18px]">send</span>
            </a>
        </div>
    </div>
</div>
@endsection
