@extends('layouts.app')

@section('title', 'Aturan & Garansi - DuREN')

@section('content')
<!-- Header Halaman -->
<div class="flex flex-col mb-8">
    <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">Aturan & Garansi</h1>
    <p class="text-[16px] text-[#6B7366] mt-1">Ketentuan pembelian, pembayaran QRIS, dan garansi penggantian durian utuh.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Card 1: Ketentuan Pembelian & Keranjang -->
    <div class="custom-card p-6 bg-white">
        <div class="w-12 h-12 rounded-[14px] bg-[#E3F1DC] flex items-center justify-center text-[#1F3318] mb-4">
            <span class="material-symbols-outlined text-[24px]">shopping_cart</span>
        </div>
        <h2 class="text-[20px] font-semibold text-[#1F261D] mb-2">1. Ketentuan Keranjang</h2>
        <p class="text-[14px] text-[#4A5246] leading-relaxed">
            Satu pesanan hanya dapat memuat satu tipe produk: <strong>Ready Stock</strong> atau <strong>Pre-Order</strong>. Jika ingin memesan kedua tipe tersebut, silakan lakukan dua kali transaksi checkout secara terpisah.
        </p>
    </div>

    <!-- Card 2: Pembayaran QRIS & Batas Waktu -->
    <div class="custom-card p-6 bg-white">
        <div class="w-12 h-12 rounded-[14px] bg-[#F2D98A] flex items-center justify-center text-[#5C4A12] mb-4">
            <span class="material-symbols-outlined text-[24px]">qr_code_2</span>
        </div>
        <h2 class="text-[20px] font-semibold text-[#1F261D] mb-2">2. Batas Waktu Pembayaran</h2>
        <p class="text-[14px] text-[#4A5246] leading-relaxed">
            Pembayaran dilakukan menggunakan QRIS statis dengan batas waktu maksimal <strong>2 jam</strong> setelah pesanan dibuat. Pembeli dapat mengunggah bukti transfer maksimal 2 kali. Admin memeriksa bukti secara manual dan mencocokkannya dengan mutasi rekening.
        </p>
    </div>

    <!-- Card 3: Konfirmasi Ongkos Kirim -->
    <div class="custom-card p-6 bg-white">
        <div class="w-12 h-12 rounded-[14px] bg-[#CFE6C5] flex items-center justify-center text-[#1F3318] mb-4">
            <span class="material-symbols-outlined text-[24px]">local_shipping</span>
        </div>
        <h2 class="text-[20px] font-semibold text-[#1F261D] mb-2">3. Konfirmasi Ongkos Kirim</h2>
        <p class="text-[14px] text-[#4A5246] leading-relaxed">
            Nominal ongkos kirim tidak dicantumkan di sistem web saat checkout. Setelah pesanan terverifikasi, Admin akan menghubungi pembeli via nomor WhatsApp terdaftar untuk mengonfirmasikan ongkir dan metode pengiriman sesuai jarak lokasi.
        </p>
    </div>

    <!-- Card 4: Garansi & Klaim Buah -->
    <div class="custom-card p-6 bg-white">
        <div class="w-12 h-12 rounded-[14px] bg-[#FBDDC6] flex items-center justify-center text-[#8C4A1A] mb-4">
            <span class="material-symbols-outlined text-[24px]">verified_user</span>
        </div>
        <h2 class="text-[20px] font-semibold text-[#1F261D] mb-2">4. Garansi & Klaim Penggantian</h2>
        <p class="text-[14px] text-[#4A5246] leading-relaxed">
            Jika durian yang diterima terbukti mentah atau busuk, pembeli berhak mendapatkan penggantian buah. Syarat klaim wajib menyertakan video unboxing utuh tanpa jeda/potongan saat membuka paket durian, lalu dikirimkan ke Admin via WhatsApp.
        </p>
    </div>
</div>
@endsection
