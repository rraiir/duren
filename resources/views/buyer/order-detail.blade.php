@extends('layouts.app')

@php
    $displayCode = $order->code ?? ($code ?? 'DRN-0042');
    $orderStatus = $order->status ?? 'shipped';
    $orderType = $order->type ?? 'ready';
    $orderTotal = $order ? $order->total_price : 570000;
    $orderCreatedAt = $order && $order->created_at ? $order->created_at->format('d M Y, H:i') . ' WIB' : '18 Okt 2026, 10:05 WIB';
    $hasReview = $order && $order->review;
@endphp

@section('title', 'Detail Pesanan ' . $displayCode . ' - DuREN')

@section('content')
<!-- Navigasi Kembali -->
<div class="mb-5">
    <a class="inline-flex items-center gap-1.5 text-[14px] font-medium text-[#7A6420] hover:underline" href="{{ url('/pesanan-saya') }}">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        <span>Kembali ke Pesanan Saya</span>
    </a>
</div>

@if (session('success'))
    <div class="mb-6 p-4 rounded-[14px] bg-[#E3F1DC] border border-[#CFE6C5] text-[#1F3318] text-[14px] flex items-center gap-2.5 shadow-xs">
        <span class="material-symbols-outlined text-[20px] text-[#3F5B34]">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if (session('info'))
    <div class="mb-6 p-4 rounded-[14px] bg-[#FAF1CE] border border-[#ECDDA1] text-[#5C4A12] text-[14px] flex items-center gap-2.5 shadow-xs">
        <span class="material-symbols-outlined text-[20px] text-[#7A6420]">info</span>
        <span>{{ session('info') }}</span>
    </div>
@endif

<!-- Header Title & Status -->
<div class="flex flex-col gap-1 pb-6">
    <div class="flex items-center gap-3 flex-wrap">
        <h1 class="text-[36px] font-bold text-[#1F261D] tracking-tight">
            Pesanan {{ $displayCode }}
        </h1>
        <x-badge-status :type="$orderStatus" />
    </div>
    <div class="flex items-center gap-2 text-[13px] text-[#6B7366]">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-[#F1F5E8] text-[#1F3318] font-medium text-[12px]">
            {{ $orderType === 'preorder' ? 'Pre-Order' : 'Ready Stock' }}
        </span>
        <span class="text-[#7A8275]">•</span>
        <span>Dibuat {{ $orderCreatedAt }}</span>
    </div>
</div>

@if ($orderStatus === 'waiting_price_approval' || ($order && $order->negotiation_status === 'pending'))
    <!-- BANNER PERSETUJUAN NEGO inDrive -->
    <div class="mb-6 p-5 rounded-[16px] bg-[#FFF9E6] border border-[#ECDDA1] flex items-start gap-3.5 shadow-xs">
        <span class="material-symbols-outlined text-[#7A6420] text-[26px] shrink-0 mt-0.5">hourglass_top</span>
        <div class="flex-1 text-[14px] text-[#5C4A12] leading-relaxed">
            <h3 class="font-bold text-[16px] text-[#1F261D] mb-1">Tawaran Harga Anda Sedang Ditinjau Admin Toko</h3>
            <p>
                Anda mengajukan tawaran harga sebesar <strong>{{ numberToRupiah($orderTotal) }}</strong>.
                Admin sedang meninjau permohonan diskon Anda. Begitu disetujui, pesanan akan beralih status ke <em>Menunggu Pembayaran</em> dan Anda dapat langsung scan QRIS.
            </p>
        </div>
    </div>
@endif

<!-- 2-Column Dashboard Grid: 8 Cols (Left) and 4 Cols (Right) -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
    <!-- LEFT COLUMN (8 COLS) -->
    <div class="lg:col-span-8 space-y-6">
        <!-- CARD 1: Alur Status -->
        <div class="custom-card p-6 bg-white">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-[18px] font-semibold text-[#1F261D]">Alur Status</h2>
                <span class="text-[13px] text-[#6B7366] flex items-center gap-1.5">
                    @if ($orderStatus === 'waiting_price_approval')
                        <span class="inline-block w-2 h-2 rounded-full bg-[#FAF1CE] animate-pulse"></span>
                        <span>Menunggu Approval Admin</span>
                    @elseif ($orderStatus === 'waiting_payment')
                        <span class="inline-block w-2 h-2 rounded-full bg-[#F2D98A] animate-pulse"></span>
                        <span>Menunggu Pembayaran</span>
                    @elseif ($orderStatus === 'waiting_verification')
                        <span class="inline-block w-2 h-2 rounded-full bg-[#F2D98A] animate-pulse"></span>
                        <span>Menunggu Verifikasi Admin</span>
                    @elseif ($orderStatus === 'shipped')
                        <span class="inline-block w-2 h-2 rounded-full bg-[#F2D98A] animate-pulse"></span>
                        <span>Dalam perjalanan</span>
                    @elseif ($orderStatus === 'completed')
                        <span class="inline-block w-2 h-2 rounded-full bg-[#3F5B34]"></span>
                        <span>Pesanan Selesai</span>
                    @else
                        <span>{{ ucfirst($orderStatus) }}</span>
                    @endif
                </span>
            </div>

            <!-- Steps Tracker Horizontal -->
            <div class="w-full overflow-x-auto pb-2">
                <div class="min-w-[580px] flex items-center justify-between relative px-2">
                    <!-- Step 1: Bayar -->
                    <div class="flex flex-col items-center gap-1.5 relative z-10">
                        <div class="w-8 h-8 rounded-full {{ in_array($orderStatus, ['waiting_verification', 'waiting_shipping_fee', 'processing', 'shipped', 'completed']) ? 'bg-[#E3F1DC] text-[#1F3318]' : ($orderStatus === 'waiting_payment' ? 'bg-[#F2D98A] text-[#5C4A12] ring-4 ring-[#FAF1CE]' : 'bg-[#F1F5E8] text-[#7A8275]') }} flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">
                                {{ in_array($orderStatus, ['waiting_verification', 'waiting_shipping_fee', 'processing', 'shipped', 'completed']) ? 'check' : 'qr_code_2' }}
                            </span>
                        </div>
                        <span class="text-[12px] font-medium text-[#1F261D]">Bayar</span>
                    </div>
                    <div class="flex-1 h-[2px] {{ in_array($orderStatus, ['waiting_verification', 'waiting_shipping_fee', 'processing', 'shipped', 'completed']) ? 'bg-[#E3F1DC]' : 'bg-[#E4E9DA]' }} mx-2"></div>

                    <!-- Step 2: Verifikasi -->
                    <div class="flex flex-col items-center gap-1.5 relative z-10">
                        <div class="w-8 h-8 rounded-full {{ in_array($orderStatus, ['waiting_shipping_fee', 'processing', 'shipped', 'completed']) ? 'bg-[#E3F1DC] text-[#1F3318]' : ($orderStatus === 'waiting_verification' ? 'bg-[#F2D98A] text-[#5C4A12] ring-4 ring-[#FAF1CE]' : 'bg-[#F1F5E8] text-[#7A8275]') }} flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">check</span>
                        </div>
                        <span class="text-[12px] font-medium text-[#1F261D]">Verifikasi</span>
                    </div>
                    <div class="flex-1 h-[2px] {{ in_array($orderStatus, ['waiting_shipping_fee', 'processing', 'shipped', 'completed']) ? 'bg-[#E3F1DC]' : 'bg-[#E4E9DA]' }} mx-2"></div>

                    <!-- Step 3: Ongkir -->
                    <div class="flex flex-col items-center gap-1.5 relative z-10">
                        <div class="w-8 h-8 rounded-full {{ in_array($orderStatus, ['processing', 'shipped', 'completed']) ? 'bg-[#E3F1DC] text-[#1F3318]' : ($orderStatus === 'waiting_shipping_fee' ? 'bg-[#F2D98A] text-[#5C4A12] ring-4 ring-[#FAF1CE]' : 'bg-[#F1F5E8] text-[#7A8275]') }} flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">check</span>
                        </div>
                        <span class="text-[12px] font-medium text-[#1F261D]">Ongkir</span>
                    </div>
                    <div class="flex-1 h-[2px] {{ in_array($orderStatus, ['processing', 'shipped', 'completed']) ? 'bg-[#E3F1DC]' : 'bg-[#E4E9DA]' }} mx-2"></div>

                    <!-- Step 4: Proses -->
                    <div class="flex flex-col items-center gap-1.5 relative z-10">
                        <div class="w-8 h-8 rounded-full {{ in_array($orderStatus, ['shipped', 'completed']) ? 'bg-[#E3F1DC] text-[#1F3318]' : ($orderStatus === 'processing' ? 'bg-[#F2D98A] text-[#5C4A12] ring-4 ring-[#FAF1CE]' : 'bg-[#F1F5E8] text-[#7A8275]') }} flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">check</span>
                        </div>
                        <span class="text-[12px] font-medium text-[#1F261D]">Proses</span>
                    </div>
                    <div class="flex-1 h-[2px] {{ in_array($orderStatus, ['shipped', 'completed']) ? 'bg-[#E3F1DC]' : 'bg-[#E4E9DA]' }} mx-2"></div>

                    <!-- Step 5: Kirim -->
                    <div class="flex flex-col items-center gap-1.5 relative z-10">
                        <div class="w-8 h-8 rounded-full {{ $orderStatus === 'completed' ? 'bg-[#E3F1DC] text-[#1F3318]' : ($orderStatus === 'shipped' ? 'bg-[#F2D98A] text-[#5C4A12] ring-4 ring-[#FAF1CE]' : 'bg-[#F1F5E8] text-[#7A8275]') }} flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">local_shipping</span>
                        </div>
                        <span class="text-[12px] font-medium {{ $orderStatus === 'shipped' ? 'text-[#5C4A12] font-bold' : 'text-[#6B7366]' }}">Kirim</span>
                    </div>
                    <div class="flex-1 h-[2px] {{ $orderStatus === 'completed' ? 'bg-[#E3F1DC]' : 'bg-[#E4E9DA]' }} mx-2"></div>

                    <!-- Step 6: Selesai -->
                    <div class="flex flex-col items-center gap-1.5 relative z-10">
                        <div class="w-8 h-8 rounded-full {{ $orderStatus === 'completed' ? 'bg-[#E3F1DC] text-[#1F3318] ring-4 ring-[#CFE6C5]' : 'bg-[#F1F5E8] text-[#7A8275]' }} flex items-center justify-center">
                            <span class="material-symbols-outlined text-[16px]">check</span>
                        </div>
                        <span class="text-[12px] {{ $orderStatus === 'completed' ? 'text-[#1F3318] font-bold' : 'text-[#6B7366]' }}">Selesai</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD 2: Item Pesanan -->
        <div class="custom-card p-6 bg-white">
            <h2 class="text-[18px] font-semibold text-[#1F261D] mb-4">Item Pesanan</h2>
            <div class="space-y-3">
                @if ($order && $order->orderItems && $order->orderItems->isNotEmpty())
                    @foreach ($order->orderItems as $item)
                        <div class="p-3.5 rounded-xl bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-[#E8F3E1] flex items-center justify-center text-[#1F3318]">
                                    <span class="material-symbols-outlined text-[20px]">eco</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-[14px] text-[#1F261D]">{{ $item->product->name ?? 'Durian' }} {{ $item->product->size ?? '' }} ({{ $item->quantity }} buah)</h4>
                                    <span class="text-[12px] text-[#6B7366]">Est. {{ number_format(($item->product->est_weight_gram ?? 2400) / 1000, 1, ',', '.') }} kg per buah</span>
                                </div>
                            </div>
                            <span class="font-bold text-[16px] text-[#1F261D]">{{ numberToRupiah($item->price_at_purchase * $item->quantity) }}</span>
                        </div>
                    @endforeach
                @else
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
                @endif
            </div>
        </div>

        <!-- CARD 3: Info Pengiriman & Resi -->
        <div class="custom-card p-6 bg-white">
            <h2 class="text-[18px] font-semibold text-[#1F261D] mb-4">Info Pengiriman</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="p-3.5 rounded-xl bg-[#F8FAF2] border border-[#E4E9DA]">
                    <span class="text-[12px] text-[#6B7366] block">Kurir Pengiriman</span>
                    <span class="font-semibold text-[14px] text-[#1F261D] mt-0.5 block">
                        {{ $order->courier_name ?? 'Lalamove' }}
                    </span>
                </div>
                <div class="p-3.5 rounded-xl bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-between">
                    <div>
                        <span class="text-[12px] text-[#6B7366] block">Nomor Resi</span>
                        <span class="font-mono font-bold text-[14px] text-[#1F261D] mt-0.5 block">
                            {{ $order->tracking_number ?? 'LLM-892104-JKT' }}
                        </span>
                    </div>
                    <button type="button" class="px-2.5 py-1 rounded-[8px] bg-white border border-[#E4E9DA] text-[12px] font-medium text-[#1F261D] hover:bg-[#F8FAF2] cursor-pointer" onclick="navigator.clipboard.writeText('{{ $order->tracking_number ?? 'LLM-892104-JKT' }}'); this.innerText='Tersalin!';">
                        Salin
                    </button>
                </div>
            </div>
        </div>

        <!-- CARD 4: FITUR ULASAN & RATING (Jika status completed) -->
        @if ($orderStatus === 'completed' || $hasReview)
            <div class="custom-card p-6 bg-white border border-[#CFE6C5]">
                <div class="flex items-center justify-between pb-3 border-b border-[#E4E9DA] mb-4">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[#F2D98A] text-[24px]">grade</span>
                        <h2 class="text-[18px] font-bold text-[#1F261D]">Ulasan Kualitas Durian</h2>
                    </div>
                    <span class="text-[12px] font-semibold text-[#1F3318] bg-[#E3F1DC] px-2.5 py-0.5 rounded-full">
                        {{ $hasReview ? 'Sudah Diulas' : 'Beri Ulasan' }}
                    </span>
                </div>

                @if ($hasReview)
                    <!-- Tampilan Ulasan yang Sudah Diberikan -->
                    <div class="p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] space-y-2">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1 text-[#F2D98A]">
                                @for ($s = 1; $s <= 5; $s++)
                                    <span class="material-symbols-outlined text-[20px] {{ $s <= $order->review->rating ? 'text-[#D4A017]' : 'text-[#E4E9DA]' }}">star</span>
                                @endfor
                                <span class="font-bold text-[14px] text-[#1F261D] ml-1">{{ $order->review->rating }}.0</span>
                            </div>
                            <span class="text-[12px] text-[#6B7366]">{{ $order->review->created_at->format('d M Y') }}</span>
                        </div>
                        <p class="text-[14px] text-[#1F261D] leading-relaxed italic">
                            "{{ $order->review->comment }}"
                        </p>
                        <span class="block text-[12px] text-[#4E6B43] font-medium pt-1">
                            ✓ Ulasan Anda telah terbit dan tampil di landing page toko.
                        </span>
                    </div>
                @else
                    <!-- Form Pengisian Ulasan -->
                    <form action="{{ route('buyer.review.store', $displayCode) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-[13px] font-semibold text-[#1F261D] mb-2">Berapa bintang untuk rasa dan kualitas buah durian ini?</label>
                            <div class="flex items-center gap-2" id="star-rating-container">
                                @for ($i = 1; $i <= 5; $i++)
                                    <button type="button" class="star-btn text-[#D4A017] hover:scale-110 transition-transform cursor-pointer" data-val="{{ $i }}" onclick="setRating({{ $i }})">
                                        <span class="material-symbols-outlined text-[32px] star-icon">star</span>
                                    </button>
                                @endfor
                                <span class="text-[14px] font-bold text-[#1F261D] ml-2" id="rating-label">5.0 (Sangat Puas)</span>
                            </div>
                            <input type="hidden" name="rating" id="rating-input" value="5">
                        </div>

                        <div>
                            <label class="block text-[13px] font-semibold text-[#1F261D] mb-1">Ulasan & Testimoni Buah:</label>
                            <textarea name="comment" rows="3" required placeholder="Ceritakan bagaimana kelezatan, ketebalan daging buah, aroma, dan kepuasan Anda..." class="w-full p-3 rounded-[12px] border border-[#E4E9DA] text-[13px] text-[#1F261D] bg-white focus:outline-none focus:border-[#4E6B43]">{{ old('comment') }}</textarea>
                        </div>

                        <button type="submit" class="h-11 px-6 rounded-[12px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[#1F261D] font-semibold text-[13px] flex items-center gap-2 transition-all shadow-xs cursor-pointer">
                            <span class="material-symbols-outlined text-[18px]">send</span>
                            <span>Kirim Ulasan Buah</span>
                        </button>
                    </form>
                @endif
            </div>
        @endif
    </div>

    <!-- RIGHT COLUMN (4 COLS) -->
    <div class="lg:col-span-4 space-y-6">
        <!-- CARD: Rincian Pembayaran -->
        <div class="custom-card p-6 bg-white">
            <h2 class="text-[18px] font-semibold text-[#1F261D] mb-4">Rincian Pembayaran</h2>
            <div class="space-y-3 pb-4 border-b border-[#E4E9DA]">
                <div class="flex items-center justify-between text-[14px]">
                    <span class="text-[#4A5246]">Tagihan Buah</span>
                    <span class="font-bold text-[#1F261D]">{{ numberToRupiah($orderTotal) }}</span>
                </div>
                <div class="flex items-center justify-between text-[14px]">
                    <span class="text-[#4A5246]">Status Pembayaran</span>
                    @if (in_array($orderStatus, ['processing', 'shipped', 'completed']))
                        <span class="text-[12px] font-semibold text-[#1F3318] bg-[#E8F3E1] px-2.5 py-0.5 rounded-full">Lunas QRIS</span>
                    @elseif ($orderStatus === 'waiting_payment')
                        <span class="text-[12px] font-semibold text-[#5C4A12] bg-[#FAF1CE] px-2.5 py-0.5 rounded-full">Menunggu QRIS</span>
                    @elseif ($orderStatus === 'waiting_price_approval')
                        <span class="text-[12px] font-semibold text-[#7A6420] bg-[#FAF1CE] px-2.5 py-0.5 rounded-full">Nego Pending</span>
                    @else
                        <span class="text-[12px] font-semibold text-[#1F3318] bg-[#E8F3E1] px-2.5 py-0.5 rounded-full">Lunas QRIS</span>
                    @endif
                </div>
                <div class="flex items-center justify-between text-[14px]">
                    <span class="text-[#4A5246]">Ongkos Kirim</span>
                    <span class="text-[12px] font-semibold text-[#1F3318] bg-[#CDEBD9] px-2.5 py-0.5 rounded-full">
                        {{ in_array($orderStatus, ['processing', 'shipped', 'completed']) ? 'Lunas via WA' : 'Dikonfirmasi via WA' }}
                    </span>
                </div>
            </div>

            <div class="pt-4 flex flex-col gap-3">
                @if ($orderStatus === 'waiting_payment')
                    <a href="{{ route('buyer.payment', $displayCode) }}" class="w-full h-11 rounded-[12px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[#1F261D] font-bold text-[13px] flex items-center justify-center gap-2 transition-colors shadow-xs">
                        <span class="material-symbols-outlined text-[18px]">qr_code_2</span>
                        <span>Bayar Sekarang via QRIS</span>
                    </a>
                @elseif ($orderStatus === 'shipped')
                    <button type="button" class="w-full h-11 rounded-[12px] bg-[#E3F1DC] hover:bg-[#CFE6C5] text-[#1F3318] font-semibold text-[13px] flex items-center justify-center transition-colors">
                        Konfirmasi Pesanan Diterima
                    </button>
                @endif

                <a href="https://wa.me/{{ $waAdminSistem ?? '62881081111833' }}?text=Halo%20Admin%20DuREN,%20saya%20ingin%20menanyakan%20pesanan%20saya%20{{ $displayCode }}" target="_blank" class="w-full h-11 rounded-[12px] bg-white hover:bg-[#F8FAF2] border border-[#E4E9DA] text-[#1F261D] font-medium text-[13px] flex items-center justify-center gap-1.5 transition-colors">
                    <span class="material-symbols-outlined text-[16px] text-[#4E6B43]">chat</span>
                    <span>Hubungi Admin WhatsApp</span>
                </a>
            </div>
        </div>

        <!-- CARD: Alamat Pengiriman -->
        <div class="custom-card p-6 bg-white">
            <h2 class="text-[18px] font-semibold text-[#1F261D] mb-3">Alamat Pengiriman</h2>
            <div class="space-y-1">
                @if ($order && $order->shipping_address)
                    <p class="text-[13px] text-[#4A5246] leading-relaxed">
                        {{ $order->shipping_address }}
                    </p>
                @else
                    <span class="font-semibold text-[14px] text-[#1F261D] block">Rina (0812-3456-7890)</span>
                    <p class="text-[13px] text-[#4A5246] leading-relaxed">
                        Jl. Melati No. 18, Cilandak Barat, Jakarta Selatan, DKI Jakarta 12430
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function setRating(val) {
        document.getElementById('rating-input').value = val;
        const labels = {
            1: '1.0 (Kecewa)',
            2: '2.0 (Kurang Puas)',
            3: '3.0 (Cukup Baik)',
            4: '4.0 (Puas & Lezat)',
            5: '5.0 (Sangat Puas)'
        };
        document.getElementById('rating-label').textContent = labels[val] || val + '.0';

        const buttons = document.querySelectorAll('.star-btn');
        buttons.forEach((btn, idx) => {
            const icon = btn.querySelector('.star-icon');
            if (idx < val) {
                icon.style.color = '#D4A017';
            } else {
                icon.style.color = '#E4E9DA';
            }
        });
    }
</script>
@endpush
@endsection
