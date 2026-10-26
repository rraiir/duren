@extends('layouts.app')

@section('title', 'Dashboard Pembeli - DuREN')

@section('content')
<!-- Sapaan & Subjudul -->
<section class="flex flex-col space-y-2 mb-8">
    <div class="flex items-center space-x-3">
        <span class="text-[40px] font-bold text-[#1F261D] tracking-tight leading-none">Halo,</span>
        <div class="inline-flex items-center justify-center bg-[#E3F1DC] border border-[#CFE6C5] px-4 py-1.5 rounded-xl shadow-sm">
            <span class="text-[40px] font-bold text-[#1F3318] tracking-tight leading-none">Rina</span>
        </div>
    </div>
    <p class="text-[16px] leading-[22px] font-normal text-[#6B7366]">Selamat datang! Pilih durian terbaik dan pantau pesananmu di sini.</p>
</section>

<!-- 4 Kartu Statistik -->
<section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
    <!-- Stat 1 -->
    <div class="custom-card h-[156px] flex flex-col justify-between p-6">
        <div class="flex items-center justify-between">
            <span class="text-[14px] leading-[20px] font-medium text-[#4A5246] whitespace-nowrap">Menunggu Bayar</span>
            <span class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-full bg-[#F2D98A] text-[#5C4A12] text-[12px] font-semibold whitespace-nowrap">
                <span class="material-symbols-outlined text-[14px]">schedule</span>
                <span>Segera</span>
            </span>
        </div>
        <div class="flex items-baseline justify-between">
            <span class="text-[40px] leading-none font-bold text-[#1F261D] tracking-tight">1</span>
            <span class="text-[12px] leading-[17px] font-medium text-[#4A5246] text-right whitespace-nowrap">Sisa 01:42:10</span>
        </div>
    </div>

    <!-- Stat 2 -->
    <div class="custom-card h-[156px] flex flex-col justify-between p-6">
        <div class="flex items-center justify-between">
            <span class="text-[14px] leading-[20px] font-medium text-[#4A5246] whitespace-nowrap">Menunggu Verifikasi</span>
            <div class="w-8 h-8 rounded-full bg-[#E3F1DC] flex items-center justify-center text-[#3F5B34] flex-shrink-0">
                <span class="material-symbols-outlined text-[18px]">hourglass_top</span>
            </div>
        </div>
        <div class="flex items-baseline justify-between">
            <span class="text-[40px] leading-none font-bold text-[#1F261D] tracking-tight">1</span>
            <span class="text-[12px] leading-[17px] font-medium text-[#4A5246] text-right whitespace-nowrap">Sedang dicek Admin</span>
        </div>
    </div>

    <!-- Stat 3 -->
    <div class="custom-card h-[156px] flex flex-col justify-between p-6">
        <div class="flex items-center justify-between">
            <span class="text-[14px] leading-[20px] font-medium text-[#4A5246] whitespace-nowrap">Dalam Proses</span>
            <div class="w-8 h-8 rounded-full bg-[#E3F1DC] flex items-center justify-center text-[#3F5B34] flex-shrink-0">
                <span class="material-symbols-outlined text-[18px]">local_shipping</span>
            </div>
        </div>
        <div class="flex items-baseline justify-between">
            <span class="text-[40px] leading-none font-bold text-[#1F261D] tracking-tight">2</span>
            <span class="text-[12px] leading-[17px] font-medium text-[#4A5246] text-right whitespace-nowrap">Pesanan Aktif</span>
        </div>
    </div>

    <!-- Stat 4 -->
    <div class="custom-card h-[156px] flex flex-col justify-between p-6">
        <div class="flex items-center justify-between">
            <span class="text-[14px] leading-[20px] font-medium text-[#4A5246] whitespace-nowrap">Selesai</span>
            <span class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-full bg-[#CDEBD9] text-[#1F3318] text-[12px] font-semibold whitespace-nowrap">
                <span class="material-symbols-outlined text-[14px]">check_circle</span>
                <span>Diterima</span>
            </span>
        </div>
        <div class="flex items-baseline justify-between">
            <span class="text-[40px] leading-none font-bold text-[#1F261D] tracking-tight">5</span>
            <span class="text-[12px] leading-[17px] font-medium text-[#4A5246] text-right whitespace-nowrap">Total Pembelian</span>
        </div>
    </div>
</section>

<!-- Kartu Akses Cepat -->
<section class="custom-card mb-8">
    <div class="flex items-center justify-between mb-5">
        <h2 class="text-[20px] leading-[28px] font-semibold text-[#1F261D] whitespace-nowrap">Akses Cepat</h2>
        <span class="text-[12px] font-medium text-[#6B7366] whitespace-nowrap">Pilih menu navigasi utama</span>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <!-- Ubin 1: Katalog Durian -->
        <a class="h-[92px] p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center space-x-4 hover:bg-[#F1F5E8] transition-all cursor-pointer" href="{{ url('/katalog') }}">
            <div class="w-12 h-12 rounded-[12px] bg-[#F2D98A] flex items-center justify-center flex-shrink-0 text-[#5C4A12]">
                <span class="material-symbols-outlined text-[24px]">storefront</span>
            </div>
            <div class="overflow-hidden min-w-0">
                <h3 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] truncate">Katalog Durian</h3>
                <p class="text-[12px] leading-[17px] text-[#4A5246] truncate">Varian, ukuran & harga</p>
            </div>
        </a>

        <!-- Ubin 2: Keranjang -->
        <a class="h-[92px] p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center space-x-4 hover:bg-[#F1F5E8] transition-all cursor-pointer" href="{{ url('/keranjang') }}">
            <div class="w-12 h-12 rounded-[12px] bg-[#CFE6C5] flex items-center justify-center flex-shrink-0 text-[#1F3318]">
                <span class="material-symbols-outlined text-[24px]">shopping_cart</span>
            </div>
            <div class="overflow-hidden min-w-0">
                <h3 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] truncate">Keranjang</h3>
                <p class="text-[12px] leading-[17px] text-[#4A5246] truncate">Durian pilihanmu</p>
            </div>
        </a>

        <!-- Ubin 3: Pesanan Saya -->
        <a class="h-[92px] p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center space-x-4 hover:bg-[#F1F5E8] transition-all cursor-pointer" href="{{ url('/pesanan-saya') }}">
            <div class="w-12 h-12 rounded-[12px] bg-[#F2D98A] flex items-center justify-center flex-shrink-0 text-[#5C4A12]">
                <span class="material-symbols-outlined text-[24px]">receipt_long</span>
            </div>
            <div class="overflow-hidden min-w-0">
                <h3 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] truncate">Pesanan Saya</h3>
                <p class="text-[12px] leading-[17px] text-[#4A5246] truncate">Status & resi</p>
            </div>
        </a>

        <!-- Ubin 4: Unggah Bukti Bayar -->
        <a class="h-[92px] p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center space-x-4 hover:bg-[#F1F5E8] transition-all cursor-pointer" href="{{ url('/pembayaran/DRN-0042') }}">
            <div class="w-12 h-12 rounded-[12px] bg-[#CFE6C5] flex items-center justify-center flex-shrink-0 text-[#1F3318]">
                <span class="material-symbols-outlined text-[24px]">upload_file</span>
            </div>
            <div class="overflow-hidden min-w-0">
                <h3 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] truncate">Unggah Bukti Bayar</h3>
                <p class="text-[12px] leading-[17px] text-[#4A5246] truncate">Bukti transfer QRIS</p>
            </div>
        </a>

        <!-- Ubin 5: Aturan & Garansi -->
        <a class="h-[92px] p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center space-x-4 hover:bg-[#F1F5E8] transition-all cursor-pointer" href="{{ url('/aturan-garansi') }}">
            <div class="w-12 h-12 rounded-[12px] bg-[#F2D98A] flex items-center justify-center flex-shrink-0 text-[#5C4A12]">
                <span class="material-symbols-outlined text-[24px]">verified_user</span>
            </div>
            <div class="overflow-hidden min-w-0">
                <h3 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] truncate">Aturan & Garansi</h3>
                <p class="text-[12px] leading-[17px] text-[#4A5246] truncate">Ketentuan sebelum bayar</p>
            </div>
        </a>

        <!-- Ubin 6: Hubungi Admin -->
        <a class="h-[92px] p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center space-x-4 hover:bg-[#F1F5E8] transition-all cursor-pointer" href="https://wa.me/62881081111833" target="_blank">
            <div class="w-12 h-12 rounded-[12px] bg-[#CFE6C5] flex items-center justify-center flex-shrink-0 text-[#1F3318]">
                <span class="material-symbols-outlined text-[24px]">chat</span>
            </div>
            <div class="overflow-hidden min-w-0">
                <h3 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] truncate">Hubungi Admin</h3>
                <p class="text-[12px] leading-[17px] text-[#4A5246] truncate">Tanya ongkir via WhatsApp</p>
            </div>
        </a>
    </div>
</section>

<!-- Dua Kartu Bawah Sejajar -->
<section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Kartu Kiri: Status Pesanan Aktif -->
    <div class="custom-card p-6 flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-[20px] leading-[28px] font-semibold text-[#1F261D] whitespace-nowrap">Pesanan DRN-0042</h3>
                <x-badge-status type="waiting_payment" />
            </div>
            <p class="text-[14px] leading-[20px] text-[#4A5246] mb-6">
                Segera unggah bukti bayar sebelum batas waktu agar pesanan tidak dibatalkan otomatis.
            </p>
            <!-- Visual Progres 5 Segmen -->
            <div class="grid grid-cols-5 gap-2.5 mb-6">
                <div class="flex flex-col space-y-2 items-center">
                    <div class="h-2 w-full bg-[#F2D98A] rounded-full"></div>
                    <span class="text-[13px] font-semibold text-[#1F261D] text-center whitespace-nowrap">Bayar</span>
                </div>
                <div class="flex flex-col space-y-2 items-center">
                    <div class="h-2 w-full bg-[#E3F1DC] rounded-full"></div>
                    <span class="text-[12px] font-medium text-[#6B7366] text-center whitespace-nowrap">Verifikasi</span>
                </div>
                <div class="flex flex-col space-y-2 items-center">
                    <div class="h-2 w-full bg-[#E3F1DC] rounded-full"></div>
                    <span class="text-[12px] font-medium text-[#6B7366] text-center whitespace-nowrap">Ongkir</span>
                </div>
                <div class="flex flex-col space-y-2 items-center">
                    <div class="h-2 w-full bg-[#E3F1DC] rounded-full"></div>
                    <span class="text-[12px] font-medium text-[#6B7366] text-center whitespace-nowrap">Proses</span>
                </div>
                <div class="flex flex-col space-y-2 items-center">
                    <div class="h-2 w-full bg-[#E3F1DC] rounded-full"></div>
                    <span class="text-[12px] font-medium text-[#6B7366] text-center whitespace-nowrap">Kirim</span>
                </div>
            </div>
        </div>
        <div class="pt-4 border-t border-[#E4E9DA] flex items-center justify-between">
            <span class="text-[14px] font-medium text-[#1F261D]">Total: <strong>Rp 490.000</strong></span>
            <a href="{{ url('/pembayaran/DRN-0042') }}" class="h-10 px-5 rounded-[12px] bg-[#F2D98A] text-[#1F261D] font-semibold text-[13px] flex items-center justify-center hover:bg-[#ECDDA1] transition-colors">
                Bayar Sekarang
            </a>
        </div>
    </div>

    <!-- Kartu Kanan: Ringkasan Pengiriman & Bantuan -->
    <div class="custom-card p-6 flex flex-col justify-between">
        <div>
            <h3 class="text-[20px] leading-[28px] font-semibold text-[#1F261D] mb-4">Informasi Pengiriman</h3>
            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-[#4E6B43] mt-0.5">location_on</span>
                    <div>
                        <span class="text-[12px] text-[#6B7366] block">Alamat Penerima</span>
                        <p class="text-[14px] text-[#1F261D] font-medium">Jl. Melati No. 18, Jakarta Selatan (0812-3456-7890)</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-[#7A6420] mt-0.5">verified_user</span>
                    <div>
                        <span class="text-[12px] text-[#6B7366] block">Garansi Durian Utuh</span>
                        <p class="text-[14px] text-[#4A5246]">Sertakan video unboxing tanpa jeda untuk klaim ganti buah jika mentah atau busuk.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-4 border-t border-[#E4E9DA] flex items-center justify-between">
            <a href="{{ url('/aturan-garansi') }}" class="text-[13px] font-semibold text-[#7A6420] hover:underline">
                Pelajari Syarat Garansi →
            </a>
            <a href="{{ url('/katalog') }}" class="h-10 px-5 rounded-[12px] bg-[#E3F1DC] text-[#1F3318] font-semibold text-[13px] flex items-center justify-center hover:bg-[#CFE6C5] transition-colors">
                Beli Durian Lagi
            </a>
        </div>
    </div>
</section>
@endsection
