@extends('layouts.app')

@php
    $isVerifyPage = request()->is('admin/verifikasi-bayar*') || $activeFilter === 'verify';
@endphp

@section('title', $isVerifyPage ? 'Verifikasi Bayar - DuREN' : 'Pesanan Masuk - DuREN')

@section('content')
<div class="space-y-6">
    <!-- 1. KEPALA HALAMAN -->
    <div class="flex items-center justify-between pb-2">
        <div class="flex flex-col">
            <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">
                {{ $isVerifyPage ? 'Verifikasi Bayar' : 'Pesanan Masuk' }}
            </h1>
            <p class="text-[16px] leading-[22px] text-[#6B7366] mt-1">
                {{ $isVerifyPage ? 'Periksa bukti transfer dan cocokkan dengan mutasi rekening secara manual.' : 'Pantau pesanan, verifikasi pembayaran, dan perbarui pengiriman.' }}
            </p>
        </div>
    </div>

    @if (session('success'))
        <div class="p-4 rounded-[14px] bg-[#E3F1DC] border border-[#CFE6C5] text-[#1F3318] text-[14px] flex items-center gap-2.5 shadow-xs">
            <span class="material-symbols-outlined text-[20px] text-[#3F5B34]">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- 2. KARTU FILTER -->
    <div class="custom-card flex flex-col gap-4 !p-6">
        <!-- Baris Atas: Input Pencarian & Dropdown Tipe -->
        <form method="GET" action="{{ $isVerifyPage ? route('admin.verification') : route('admin.orders') }}" class="flex items-center justify-between gap-4">
            @if(request('filter'))
                <input type="hidden" name="filter" value="{{ request('filter') }}">
            @endif
            <div class="relative w-80">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#7A8275] text-[20px] pointer-events-none">search</span>
                <input class="w-full h-12 pl-11 pr-4 bg-white border border-[#E4E9DA] rounded-[12px] text-[14px] text-[#1F261D] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] transition-colors" name="search" placeholder="Cari kode atau nama pembeli" type="text" value="{{ request('search') }}">
            </div>
            <div class="flex items-center gap-2">
                <select name="type" onchange="this.form.submit()" class="h-12 px-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] focus:outline-none focus:border-[#B7D7A8] cursor-pointer">
                    <option value="">Semua Tipe</option>
                    <option value="ready" {{ request('type') === 'ready' ? 'selected' : '' }}>Ready Stock</option>
                    <option value="preorder" {{ request('type') === 'preorder' ? 'selected' : '' }}>Pre-Order</option>
                </select>
            </div>
        </form>

        <!-- Baris Bawah: Chip Status Filter -->
        <div class="flex items-center gap-2.5 overflow-x-auto pb-1">
            <a href="{{ route('admin.orders', array_filter(['search' => request('search'), 'type' => request('type')])) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-[12px] font-semibold whitespace-nowrap transition-all {{ $activeFilter === 'all' && ! $isVerifyPage ? 'bg-[#E3F1DC] text-[#1F3318] border border-[#B7D7A8] shadow-xs' : 'bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2]' }}">
                <span>Semua</span>
                <span class="w-5 h-5 rounded-full {{ $activeFilter === 'all' && ! $isVerifyPage ? 'bg-white/80' : 'bg-[#E8F3E1]' }} flex items-center justify-center text-[11px] font-bold text-[#1F3318]">{{ $counts['all'] ?? 0 }}</span>
            </a>

            <a href="{{ route('admin.orders', array_filter(['filter' => 'verify', 'search' => request('search'), 'type' => request('type')])) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-[12px] font-semibold whitespace-nowrap transition-all {{ $activeFilter === 'verify' ? 'bg-[#F2D98A] text-[#5C4A12] border border-[#ECDDA1] shadow-xs' : 'bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2]' }}">
                <span>Perlu Verifikasi</span>
                <span class="w-5 h-5 rounded-full {{ $activeFilter === 'verify' ? 'bg-white/80' : 'bg-[#FAF1CE]' }} flex items-center justify-center text-[11px] font-bold text-[#5C4A12]">{{ $counts['verify'] ?? 0 }}</span>
            </a>

            @if(! $isVerifyPage)
                <a href="{{ route('admin.orders', array_filter(['filter' => 'shipping', 'search' => request('search'), 'type' => request('type')])) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-[12px] font-medium whitespace-nowrap transition-all {{ $activeFilter === 'shipping' ? 'bg-[#E3F1DC] text-[#1F3318] border border-[#B7D7A8] shadow-xs' : 'bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2]' }}">
                    <span>Menunggu Ongkir</span>
                    <span class="w-5 h-5 rounded-full bg-[#E8F3E1] flex items-center justify-center text-[11px] font-semibold text-[#1F3318]">{{ $counts['shipping'] ?? 0 }}</span>
                </a>

                <a href="{{ route('admin.orders', array_filter(['filter' => 'process', 'search' => request('search'), 'type' => request('type')])) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-[12px] font-medium whitespace-nowrap transition-all {{ $activeFilter === 'process' ? 'bg-[#E3F1DC] text-[#1F3318] border border-[#B7D7A8] shadow-xs' : 'bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2]' }}">
                    <span>Diproses</span>
                    <span class="w-5 h-5 rounded-full bg-[#E8F3E1] flex items-center justify-center text-[11px] font-semibold text-[#1F3318]">{{ $counts['process'] ?? 0 }}</span>
                </a>

                <a href="{{ route('admin.orders', array_filter(['filter' => 'sent', 'search' => request('search'), 'type' => request('type')])) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-[12px] font-medium whitespace-nowrap transition-all {{ $activeFilter === 'sent' ? 'bg-[#E3F1DC] text-[#1F3318] border border-[#B7D7A8] shadow-xs' : 'bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2]' }}">
                    <span>Dikirim</span>
                    <span class="w-5 h-5 rounded-full bg-[#E8F3E1] flex items-center justify-center text-[11px] font-semibold text-[#1F3318]">{{ $counts['sent'] ?? 0 }}</span>
                </a>

                <a href="{{ route('admin.orders', array_filter(['filter' => 'done', 'search' => request('search'), 'type' => request('type')])) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-[12px] font-medium whitespace-nowrap transition-all {{ $activeFilter === 'done' ? 'bg-[#E3F1DC] text-[#1F3318] border border-[#B7D7A8] shadow-xs' : 'bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2]' }}">
                    <span>Selesai</span>
                    <span class="w-5 h-5 rounded-full bg-[#E8F3E1] flex items-center justify-center text-[11px] font-semibold text-[#1F3318]">{{ $counts['done'] ?? 0 }}</span>
                </a>

                <a href="{{ route('admin.orders', array_filter(['filter' => 'cancel', 'search' => request('search'), 'type' => request('type')])) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-[12px] font-medium whitespace-nowrap transition-all {{ $activeFilter === 'cancel' ? 'bg-[#FBDDC6] text-[#8C4A1A] border border-[#EFC3A3] shadow-xs' : 'bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2]' }}">
                    <span>Batal</span>
                    <span class="w-5 h-5 rounded-full bg-[#FBDDC6] flex items-center justify-center text-[11px] font-semibold text-[#8C4A1A]">{{ $counts['cancel'] ?? 0 }}</span>
                </a>
            @endif
        </div>
    </div>

    <!-- 3. KARTU TABEL PESANAN -->
    <div class="custom-card !p-6 flex flex-col">
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse min-w-[960px]">
                <thead>
                    <tr class="h-11 bg-[#F8FAF2] rounded-[12px]">
                        <th class="pl-4 pr-3 rounded-l-[12px] font-medium text-[12px] text-[#4A5246] uppercase tracking-wider">Kode</th>
                        <th class="px-3 font-medium text-[12px] text-[#4A5246] uppercase tracking-wider">Pembeli</th>
                        <th class="px-3 font-medium text-[12px] text-[#4A5246] uppercase tracking-wider">Item</th>
                        <th class="px-3 font-medium text-[12px] text-[#4A5246] uppercase tracking-wider">Total</th>
                        <th class="px-3 font-medium text-[12px] text-[#4A5246] uppercase tracking-wider">Tipe</th>
                        <th class="px-3 font-medium text-[12px] text-[#4A5246] uppercase tracking-wider">Status</th>
                        <th class="px-3 font-medium text-[12px] text-[#4A5246] uppercase tracking-wider">Batas Bayar</th>
                        <th class="pr-4 pl-3 rounded-r-[12px] text-right font-medium text-[12px] text-[#4A5246] uppercase tracking-wider sticky right-0 bg-[#F8FAF2]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E4E9DA] text-[14px] text-[#1F261D]">
                    @forelse ($orders as $order)
                        <tr class="h-16 hover:bg-[#F8FAF2] transition-colors group">
                            <td class="pl-4 pr-3 font-semibold text-[14px] text-[#7A6420]">
                                {{ $order->code }}
                            </td>
                            <td class="px-3">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-full bg-[#CFE6C5] text-[#1F3318] flex items-center justify-center text-xs font-semibold">
                                        {{ strtoupper(substr($order->user->name ?? 'P', 0, 1)) }}
                                    </div>
                                    <span class="font-medium text-[#1F261D]">{{ $order->user->name ?? 'Pembeli' }}</span>
                                </div>
                            </td>
                            <td class="px-3 text-[#4A5246]">
                                @php
                                    $itemSummaries = $order->orderItems->map(function($item) {
                                        return ($item->product->name ?? 'Durian') . ' ' . ($item->product->size ?? '') . ' ×' . $item->quantity;
                                    })->join(', ');
                                @endphp
                                <span class="block max-w-[240px] truncate" title="{{ $itemSummaries }}">{{ $itemSummaries }}</span>
                            </td>
                            <td class="px-3 font-semibold text-[#1F261D]">
                                {{ numberToRupiah($order->total_price) }}
                            </td>
                            <td class="px-3">
                                <x-badge-status :type="$order->type" />
                            </td>
                            <td class="px-3">
                                <x-badge-status :type="$order->status" />
                            </td>
                            <td class="px-3 text-[#7A8275] font-mono text-xs">
                                @if($order->status === 'waiting_payment')
                                    <span class="text-[#7A6420] font-semibold">{{ $order->pay_deadline ? $order->pay_deadline->format('H:i') . ' WIB' : '-' }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="pr-4 pl-3 text-right sticky right-0 bg-white group-hover:bg-[#F8FAF2] transition-colors">
                                <a href="{{ route('admin.orders.show', $order->code) }}" class="inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-[12px] border border-[#E4E9DA] bg-white text-xs font-semibold text-[#1F261D] hover:bg-[#F8FAF2] transition-all shadow-xs">
                                    <span>Lihat</span>
                                    <span class="material-symbols-outlined text-[16px] text-[#4A5246]">chevron_right</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-8 text-[#6B7366]">
                                Tidak ada data pesanan yang sesuai filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
