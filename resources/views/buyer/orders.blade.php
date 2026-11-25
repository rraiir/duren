@extends('layouts.app')

@section('title', 'Pesanan Saya - DuREN')

@section('content')
<!-- Header Halaman -->
<div class="flex flex-col mb-6">
    <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">Pesanan Saya</h1>
    <p class="text-[16px] text-[#6B7366] mt-1">Pantau status pesanan durian Anda, konfirmasi pembayaran, dan berikan ulasan.</p>
</div>

@if (session('success'))
    <div class="mb-6 p-4 rounded-[14px] bg-[#E3F1DC] border border-[#CFE6C5] text-[#1F3318] text-[14px] flex items-center gap-2.5 shadow-xs">
        <span class="material-symbols-outlined text-[20px] text-[#3F5B34]">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
@endif

<!-- Filter Chip Status -->
<div class="flex items-center gap-2 overflow-x-auto pb-4 mb-6">
    <button class="order-filter-btn px-4 py-2 rounded-full text-[13px] font-semibold bg-[#E3F1DC] text-[#1F3318] border border-transparent whitespace-nowrap cursor-pointer" data-filter="all" type="button">
        Semua
    </button>
    <button class="order-filter-btn px-4 py-2 rounded-full text-[13px] font-medium bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2] whitespace-nowrap cursor-pointer" data-filter="waiting_price_approval" type="button">
        Tawaran Harga (Nego)
    </button>
    <button class="order-filter-btn px-4 py-2 rounded-full text-[13px] font-medium bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2] whitespace-nowrap cursor-pointer" data-filter="waiting_payment" type="button">
        Menunggu Bayar
    </button>
    <button class="order-filter-btn px-4 py-2 rounded-full text-[13px] font-medium bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2] whitespace-nowrap cursor-pointer" data-filter="waiting_verification" type="button">
        Menunggu Verifikasi
    </button>
    <button class="order-filter-btn px-4 py-2 rounded-full text-[13px] font-medium bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2] whitespace-nowrap cursor-pointer" data-filter="processing" type="button">
        Diproses
    </button>
    <button class="order-filter-btn px-4 py-2 rounded-full text-[13px] font-medium bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2] whitespace-nowrap cursor-pointer" data-filter="shipped" type="button">
        Dikirim
    </button>
    <button class="order-filter-btn px-4 py-2 rounded-full text-[13px] font-medium bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2] whitespace-nowrap cursor-pointer" data-filter="completed" type="button">
        Selesai
    </button>
</div>

<!-- Daftar Kartu Pesanan -->
<div class="space-y-4" id="order-list">
    @if(isset($orders) && $orders->isNotEmpty())
        @foreach($orders as $o)
            @php
                $itemCount = $o->orderItems->sum('quantity') ?: 1;
                $itemNames = $o->orderItems->map(fn($it) => ($it->product->name ?? 'Durian') . ' ' . ($it->product->size ?? ''))->join(', ') ?: 'Durian Pilihan';
            @endphp
            <div class="buyer-order-card custom-card p-6 bg-white transition-all" data-status="{{ $o->status }}">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-[#E4E9DA] gap-2">
                    <div class="flex items-center gap-3">
                        <span class="font-bold text-[18px] text-[#1F261D]">{{ $o->code }}</span>
                        <span class="text-[12px] text-[#6B7366]">{{ $o->created_at ? $o->created_at->format('d M Y, H:i') . ' WIB' : '-' }}</span>
                        @if($o->negotiation_status === 'pending')
                            <span class="px-2 py-0.5 rounded-full bg-[#FAF1CE] border border-[#ECDDA1] text-[#7A6420] text-[11px] font-bold">
                                inDrive Nego
                            </span>
                        @endif
                    </div>
                    <x-badge-status :type="$o->status" />
                </div>

                <div class="py-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-[12px] bg-[#E3F1DC] flex items-center justify-center text-[#1F3318] font-bold text-[14px]">
                            {{ $itemCount }}
                        </div>
                        <div>
                            <h4 class="font-semibold text-[15px] text-[#1F261D]">{{ $itemNames }}</h4>
                            <p class="text-[13px] text-[#6B7366]">Total {{ $itemCount }} buah • {{ $o->type === 'preorder' ? 'Pre-Order' : 'Ready Stock' }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-[12px] text-[#6B7366] block">
                            {{ $o->status === 'waiting_price_approval' ? 'Tawaran Harga' : 'Total Tagihan' }}
                        </span>
                        <span class="text-[20px] font-bold {{ $o->status === 'waiting_price_approval' ? 'text-[#1F3318]' : 'text-[#1F261D]' }}">
                            {{ numberToRupiah($o->total_price) }}
                        </span>
                    </div>
                </div>

                <div class="pt-4 border-t border-[#E4E9DA] flex items-center justify-between flex-wrap gap-2">
                    <div>
                        @if($o->status === 'waiting_price_approval')
                            <span class="text-[12px] text-[#7A6420] font-medium flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">hourglass_top</span>
                                <span>Menunggu persetujuan admin toko</span>
                            </span>
                        @elseif($o->status === 'waiting_payment')
                            <span class="text-[12px] text-[#BA1A1A] font-medium">
                                Batas bayar: {{ $o->pay_deadline ? $o->pay_deadline->format('H:i') . ' WIB' : '15 menit' }}
                            </span>
                        @elseif($o->status === 'completed')
                            @if($o->review)
                                <span class="text-[12px] text-[#2E7D32] font-semibold flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px] text-[#D4A017]">star</span>
                                    <span>Sudah Diulas ({{ $o->review->rating }}.0)</span>
                                </span>
                            @else
                                <span class="text-[12px] text-[#7A6420] font-medium">Durian telah diterima</span>
                            @endif
                        @elseif($o->status === 'shipped')
                            <span class="text-[12px] text-[#3F5B34] font-medium">Dalam perjalanan menuju alamat</span>
                        @else
                            <span class="text-[12px] text-[#6B7366]">Pesanan diproses toko</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('buyer.orders.show', $o->code) }}" class="h-10 px-4 rounded-[12px] border border-[#E4E9DA] text-[13px] font-medium text-[#1F261D] hover:bg-[#F8FAF2] flex items-center justify-center transition-colors">
                            Lihat Detail
                        </a>
                        @if($o->status === 'waiting_payment')
                            <a href="{{ route('buyer.payment', $o->code) }}" class="h-10 px-5 rounded-[12px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[13px] font-semibold text-[#1F261D] flex items-center justify-center shadow-xs transition-colors">
                                Bayar Sekarang
                            </a>
                        @elseif($o->status === 'completed' && !$o->review)
                            <a href="{{ route('buyer.orders.show', $o->code) }}" class="h-10 px-4 rounded-[12px] bg-[#E3F1DC] hover:bg-[#CFE6C5] text-[13px] font-semibold text-[#1F3318] flex items-center gap-1 shadow-xs transition-colors">
                                <span class="material-symbols-outlined text-[16px]">grade</span>
                                <span>Beri Ulasan Buah</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <!-- Fallback Sample Pesanan jika akun belum bertransaksi -->
        <!-- Pesanan 1: Menunggu Pembayaran -->
        <div class="buyer-order-card custom-card p-6 bg-white" data-status="waiting_payment">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-[#E4E9DA] gap-2">
                <div class="flex items-center gap-3">
                    <span class="font-bold text-[18px] text-[#1F261D]">DRN-0042</span>
                    <span class="text-[12px] text-[#6B7366]">20 Okt 2026, 14:30 WIB</span>
                </div>
                <x-badge-status type="waiting_payment" />
            </div>

            <div class="py-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-[12px] bg-[#E3F1DC] flex items-center justify-center text-[#1F3318] font-bold text-[14px]">
                        2
                    </div>
                    <div>
                        <h4 class="font-semibold text-[15px] text-[#1F261D]">Montong L & Montong M</h4>
                        <p class="text-[13px] text-[#6B7366]">Total 2 buah • Ready Stock</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-[12px] text-[#6B7366] block">Total Tagihan</span>
                    <span class="text-[20px] font-bold text-[#1F261D]">Rp 440.000</span>
                </div>
            </div>

            <div class="pt-4 border-t border-[#E4E9DA] flex items-center justify-between">
                <span class="text-[12px] text-[#BA1A1A] font-medium">Batas bayar: 15 menit</span>
                <div class="flex items-center gap-3">
                    <a href="{{ url('/pesanan-saya/DRN-0042') }}" class="h-10 px-4 rounded-[12px] border border-[#E4E9DA] text-[13px] font-medium text-[#1F261D] hover:bg-[#F8FAF2] flex items-center justify-center">
                        Lihat Detail
                    </a>
                    <a href="{{ url('/pembayaran/DRN-0042') }}" class="h-10 px-5 rounded-[12px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[13px] font-semibold text-[#1F261D] flex items-center justify-center shadow-sm">
                        Bayar Sekarang
                    </a>
                </div>
            </div>
        </div>

        <!-- Pesanan 2: Selesai dengan Tombol Ulasan -->
        <div class="buyer-order-card custom-card p-6 bg-white" data-status="completed">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-[#E4E9DA] gap-2">
                <div class="flex items-center gap-3">
                    <span class="font-bold text-[18px] text-[#1F261D]">DRN-0025</span>
                    <span class="text-[12px] text-[#6B7366]">10 Okt 2026, 11:20 WIB</span>
                </div>
                <x-badge-status type="completed" />
            </div>

            <div class="py-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-[12px] bg-[#E8F3E1] flex items-center justify-center text-[#1F3318] font-bold text-[14px]">
                        1
                    </div>
                    <div>
                        <h4 class="font-semibold text-[15px] text-[#1F261D]">Montong L (1 buah)</h4>
                        <p class="text-[13px] text-[#6B7366]">Ready Stock • Selesai diterima</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-[12px] text-[#6B7366] block">Total Pembelian</span>
                    <span class="text-[20px] font-bold text-[#1F261D]">Rp 250.000</span>
                </div>
            </div>

            <div class="pt-4 border-t border-[#E4E9DA] flex items-center justify-between">
                <span class="text-[12px] text-[#4E6B43] font-medium">Durian telah diterima</span>
                <div class="flex items-center gap-2">
                    <a href="{{ url('/pesanan-saya/DRN-0025') }}" class="h-10 px-4 rounded-[12px] bg-[#E3F1DC] hover:bg-[#CFE6C5] text-[13px] font-semibold text-[#1F3318] flex items-center gap-1 shadow-xs">
                        <span class="material-symbols-outlined text-[16px]">grade</span>
                        <span>Beri Ulasan Buah</span>
                    </a>
                    <a href="{{ url('/pesanan-saya/DRN-0025') }}" class="h-10 px-4 rounded-[12px] border border-[#E4E9DA] text-[13px] font-medium text-[#1F261D] hover:bg-[#F8FAF2] flex items-center justify-center">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    const filterBtns = document.querySelectorAll('.order-filter-btn');
    const cards = document.querySelectorAll('.buyer-order-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => {
                b.className = 'order-filter-btn px-4 py-2 rounded-full text-[13px] font-medium bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2] whitespace-nowrap cursor-pointer';
            });
            btn.className = 'order-filter-btn px-4 py-2 rounded-full text-[13px] font-semibold bg-[#E3F1DC] text-[#1F3318] border border-transparent whitespace-nowrap cursor-pointer';

            const filter = btn.getAttribute('data-filter');
            cards.forEach(card => {
                const status = card.getAttribute('data-status');
                if (filter === 'all' || status === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush
@endsection
