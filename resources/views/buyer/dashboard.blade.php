@extends('layouts.app')

@section('title', 'Dashboard Pembeli - DuREN')

@section('content')
<!-- Sapaan & Subjudul -->
<section class="flex flex-col space-y-2 mb-8">
    <div class="flex items-center space-x-3">
        <span class="text-[40px] font-bold text-[#1F261D] tracking-tight leading-none">Halo,</span>
        <div class="inline-flex items-center justify-center bg-[#E3F1DC] border border-[#CFE6C5] px-4 py-1.5 rounded-xl shadow-xs">
            <span class="text-[40px] font-bold text-[#1F3318] tracking-tight leading-none">{{ auth()->user()->name ?? 'Sahabat DuREN' }}</span>
        </div>
    </div>
    <p class="text-[16px] leading-[22px] font-normal text-[#6B7366]">Selamat datang! Pilih durian terbaik dan pantau pesananmu di sini.</p>
</section>

<!-- 4 Kartu Statistik -->
<section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
    <!-- Stat 1: Menunggu Bayar -->
    <div class="custom-card h-[156px] flex flex-col justify-between p-6">
        <div class="flex items-center justify-between">
            <span class="text-[14px] leading-[20px] font-medium text-[#4A5246] whitespace-nowrap">Menunggu Bayar</span>
            <span class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-full bg-[#F2D98A] text-[#5C4A12] text-[12px] font-semibold whitespace-nowrap">
                <span class="material-symbols-outlined text-[14px]">schedule</span>
                <span>Batas Waktu</span>
            </span>
        </div>
        <div class="flex items-baseline justify-between">
            <span class="text-[40px] leading-none font-bold text-[#1F261D] tracking-tight">{{ $waitingPaymentCount }}</span>
            <span class="text-[12px] leading-[17px] font-medium text-[#4A5246] text-right whitespace-nowrap">Tagihan Durian</span>
        </div>
    </div>

    <!-- Stat 2: Menunggu Verifikasi -->
    <div class="custom-card h-[156px] flex flex-col justify-between p-6">
        <div class="flex items-center justify-between">
            <span class="text-[14px] leading-[20px] font-medium text-[#4A5246] whitespace-nowrap">Menunggu Verifikasi</span>
            <div class="w-8 h-8 rounded-full bg-[#E3F1DC] flex items-center justify-center text-[#3F5B34] shrink-0">
                <span class="material-symbols-outlined text-[18px]">hourglass_top</span>
            </div>
        </div>
        <div class="flex items-baseline justify-between">
            <span class="text-[40px] leading-none font-bold text-[#1F261D] tracking-tight">{{ $waitingVerificationCount }}</span>
            <span class="text-[12px] leading-[17px] font-medium text-[#4A5246] text-right whitespace-nowrap">Dicek Admin</span>
        </div>
    </div>

    <!-- Stat 3: Dalam Proses -->
    <div class="custom-card h-[156px] flex flex-col justify-between p-6">
        <div class="flex items-center justify-between">
            <span class="text-[14px] leading-[20px] font-medium text-[#4A5246] whitespace-nowrap">Dalam Proses</span>
            <div class="w-8 h-8 rounded-full bg-[#E3F1DC] flex items-center justify-center text-[#3F5B34] shrink-0">
                <span class="material-symbols-outlined text-[18px]">local_shipping</span>
            </div>
        </div>
        <div class="flex items-baseline justify-between">
            <span class="text-[40px] leading-none font-bold text-[#1F261D] tracking-tight">{{ $activeCount }}</span>
            <span class="text-[12px] leading-[17px] font-medium text-[#4A5246] text-right whitespace-nowrap">Pesanan Aktif</span>
        </div>
    </div>

    <!-- Stat 4: Selesai -->
    <div class="custom-card h-[156px] flex flex-col justify-between p-6">
        <div class="flex items-center justify-between">
            <span class="text-[14px] leading-[20px] font-medium text-[#4A5246] whitespace-nowrap">Selesai</span>
            <span class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-full bg-[#CDEBD9] text-[#1F3318] text-[12px] font-semibold whitespace-nowrap">
                <span class="material-symbols-outlined text-[14px]">check_circle</span>
                <span>Diterima</span>
            </span>
        </div>
        <div class="flex items-baseline justify-between">
            <span class="text-[40px] leading-none font-bold text-[#1F261D] tracking-tight">{{ $completedCount }}</span>
            <span class="text-[12px] leading-[17px] font-medium text-[#4A5246] text-right whitespace-nowrap">Total Pesanan</span>
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
        <a class="h-[92px] p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center space-x-4 hover:bg-[#F1F5E8] transition-all cursor-pointer" href="{{ route('buyer.catalog') }}">
            <div class="w-12 h-12 rounded-[12px] bg-[#F2D98A] flex items-center justify-center shrink-0 text-[#5C4A12]">
                <span class="material-symbols-outlined text-[24px]">storefront</span>
            </div>
            <div class="overflow-hidden min-w-0">
                <h3 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] truncate">Katalog Durian</h3>
                <p class="text-[12px] leading-[17px] text-[#4A5246] truncate">Varian, ukuran &amp; harga</p>
            </div>
        </a>

        <!-- Ubin 2: Keranjang -->
        <a class="h-[92px] p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center space-x-4 hover:bg-[#F1F5E8] transition-all cursor-pointer" href="{{ route('buyer.cart') }}">
            <div class="w-12 h-12 rounded-[12px] bg-[#CFE6C5] flex items-center justify-center shrink-0 text-[#1F3318]">
                <span class="material-symbols-outlined text-[24px]">shopping_cart</span>
            </div>
            <div class="overflow-hidden min-w-0">
                <h3 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] truncate">Keranjang</h3>
                <p class="text-[12px] leading-[17px] text-[#4A5246] truncate">Kelola item belanja</p>
            </div>
        </a>

        <!-- Ubin 3: Pesanan Saya -->
        <a class="h-[92px] p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center space-x-4 hover:bg-[#F1F5E8] transition-all cursor-pointer" href="{{ route('buyer.orders') }}">
            <div class="w-12 h-12 rounded-[12px] bg-[#F2D98A] flex items-center justify-center shrink-0 text-[#5C4A12]">
                <span class="material-symbols-outlined text-[24px]">receipt_long</span>
            </div>
            <div class="overflow-hidden min-w-0">
                <h3 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] truncate">Pesanan Saya</h3>
                <p class="text-[12px] leading-[17px] text-[#4A5246] truncate">Pantau status pengiriman</p>
            </div>
        </a>
    </div>
</section>

<!-- 2 Kolom: Pesanan Terbaru & Riwayat -->
<section class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    <!-- Kolom Kiri: Pesanan Terbaru (7 Cols) -->
    <div class="lg:col-span-7 custom-card flex flex-col justify-between min-h-[300px]">
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-[20px] leading-[28px] font-semibold text-[#1F261D]">Pesanan Terbaru</h2>
                @if ($latestOrder)
                    <x-badge-status :type="$latestOrder->status" />
                @endif
            </div>

            @if ($latestOrder)
                <div class="p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-bold text-[16px] text-[#7A6420]">{{ $latestOrder->code }}</span>
                        <span class="text-[12px] text-[#6B7366]">{{ $latestOrder->created_at->format('d M Y, H:i') }} WIB</span>
                    </div>
                    <p class="text-[14px] text-[#1F261D] mb-1">
                        {{ $latestOrder->orderItems->map(fn($i) => ($i->product->name ?? 'Durian') . ' ' . ($i->product->size ?? '') . ' ×' . $i->quantity)->join(', ') }}
                    </p>
                    <p class="text-[15px] font-bold text-[#1F261D]">
                        Total: {{ numberToRupiah($latestOrder->total_price) }}
                    </p>
                </div>
            @else
                <div class="py-12 text-center text-[#6B7366]">
                    <span class="material-symbols-outlined text-[36px] text-[#A6AEA0] mb-2 block">shopping_basket</span>
                    <span>Belum ada pesanan aktif. Yuk pesan durian pertamamu!</span>
                </div>
            @endif
        </div>

        @if ($latestOrder)
            <div class="pt-4 border-t border-[#E4E9DA]">
                <a href="{{ route('buyer.orders.show', $latestOrder->code) }}" class="inline-flex items-center gap-1.5 text-[14px] font-semibold text-[#7A6420] hover:underline">
                    <span>Lihat Detail Pesanan</span>
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>
        @else
            <div class="pt-4 border-t border-[#E4E9DA]">
                <a href="{{ route('buyer.catalog') }}" class="inline-flex items-center gap-1.5 text-[14px] font-semibold text-[#7A6420] hover:underline">
                    <span>Buka Katalog Durian</span>
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>
        @endif
    </div>

    <!-- Kolom Kanan: Riwayat Pesanan (5 Cols) -->
    <div class="lg:col-span-5 custom-card flex flex-col justify-between min-h-[300px]">
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-[20px] leading-[28px] font-semibold text-[#1F261D]">Riwayat Terakhir</h2>
                <a href="{{ route('buyer.orders') }}" class="text-[13px] font-semibold text-[#7A6420] hover:underline">Semua</a>
            </div>

            <div class="space-y-3">
                @forelse ($orderHistory as $oh)
                    <a href="{{ route('buyer.orders.show', $oh->code) }}" class="p-3 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-between hover:bg-[#F1F5E8] transition-colors block">
                        <div>
                            <span class="text-[14px] font-bold text-[#1F261D]">{{ $oh->code }}</span>
                            <span class="text-[12px] text-[#6B7366] block">{{ $oh->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-[13px] font-semibold text-[#1F261D] block">{{ numberToRupiah($oh->total_price) }}</span>
                            <x-badge-status :type="$oh->status" />
                        </div>
                    </a>
                @empty
                    <div class="py-8 text-center text-[13px] text-[#6B7366]">
                        Belum ada riwayat pesanan sebelumnya.
                    </div>
                @endforelse
            </div>
        </div>

        <div class="pt-4 mt-4 border-t border-[#E4E9DA] text-right">
            <a href="{{ route('buyer.orders') }}" class="inline-flex items-center gap-1 text-[13px] font-medium text-[#7A6420] hover:underline">
                <span>Lihat riwayat lengkap</span>
                <span class="material-symbols-outlined text-[15px]">chevron_right</span>
            </a>
        </div>
    </div>
</section>
@endsection
