@extends('layouts.app')

@php
    $activeFilter = request()->get('filter', 'all');
    $isVerifyPage = request()->is('admin/verifikasi-bayar*') || $activeFilter === 'verify';
    if ($isVerifyPage) {
        $activeFilter = 'verify';
    }
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

    <!-- 2. KARTU FILTER -->
    <div class="custom-card flex flex-col gap-4 !p-6">
        <!-- Baris Atas: Input Pencarian & Dropdown Tipe -->
        <div class="flex items-center justify-between gap-4">
            <div class="relative w-80">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#7A8275] text-[20px] pointer-events-none">search</span>
                <input class="w-full h-12 pl-11 pr-4 bg-white border border-[#E4E9DA] rounded-[12px] text-[14px] text-[#1F261D] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] transition-colors" placeholder="Cari kode atau nama pembeli" type="text">
            </div>
            <div class="relative inline-block">
                <button class="h-12 px-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] hover:bg-[#F8FAF2] text-[14px] font-medium flex items-center gap-2 transition-colors cursor-pointer" type="button">
                    <span class="material-symbols-outlined text-[#4A5246] text-[20px]">filter_list</span>
                    <span>Semua Tipe</span>
                    <span class="material-symbols-outlined text-[#4A5246] text-[18px]">expand_more</span>
                </button>
            </div>
        </div>

        <!-- Baris Bawah: Chip Status Filter -->
        <div class="flex items-center gap-2.5 overflow-x-auto pb-1">
            <a href="{{ url('/admin/pesanan') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-[12px] font-semibold whitespace-nowrap transition-all {{ $activeFilter === 'all' ? 'bg-[#E3F1DC] text-[#1F3318] border border-[#B7D7A8] shadow-sm' : 'bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2]' }}">
                <span>Semua</span>
                <span class="w-5 h-5 rounded-full {{ $activeFilter === 'all' ? 'bg-white/80' : 'bg-[#E8F3E1]' }} flex items-center justify-center text-[11px] font-bold text-[#1F3318]">24</span>
            </a>

            <a href="{{ url('/admin/pesanan?filter=verify') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-[12px] font-semibold whitespace-nowrap transition-all {{ $activeFilter === 'verify' ? 'bg-[#F2D98A] text-[#5C4A12] border border-[#ECDDA1] shadow-sm' : 'bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2]' }}">
                <span>Perlu Verifikasi</span>
                <span class="w-5 h-5 rounded-full {{ $activeFilter === 'verify' ? 'bg-white/80' : 'bg-[#FAF1CE]' }} flex items-center justify-center text-[11px] font-bold text-[#5C4A12]">3</span>
            </a>

            <a href="{{ url('/admin/pesanan?filter=shipping') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-[12px] font-medium whitespace-nowrap transition-all {{ $activeFilter === 'shipping' ? 'bg-[#E3F1DC] text-[#1F3318] border border-[#B7D7A8] shadow-sm' : 'bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2]' }}">
                <span>Menunggu Ongkir</span>
                <span class="w-5 h-5 rounded-full bg-[#E8F3E1] flex items-center justify-center text-[11px] font-semibold text-[#1F3318]">2</span>
            </a>

            <a href="{{ url('/admin/pesanan?filter=process') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-[12px] font-medium whitespace-nowrap transition-all {{ $activeFilter === 'process' ? 'bg-[#E3F1DC] text-[#1F3318] border border-[#B7D7A8] shadow-sm' : 'bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2]' }}">
                <span>Diproses</span>
                <span class="w-5 h-5 rounded-full bg-[#E8F3E1] flex items-center justify-center text-[11px] font-semibold text-[#1F3318]">5</span>
            </a>

            <a href="{{ url('/admin/pesanan?filter=sent') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-[12px] font-medium whitespace-nowrap transition-all {{ $activeFilter === 'sent' ? 'bg-[#E3F1DC] text-[#1F3318] border border-[#B7D7A8] shadow-sm' : 'bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2]' }}">
                <span>Dikirim</span>
                <span class="w-5 h-5 rounded-full bg-[#E8F3E1] flex items-center justify-center text-[11px] font-semibold text-[#1F3318]">4</span>
            </a>

            <a href="{{ url('/admin/pesanan?filter=done') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-[12px] font-medium whitespace-nowrap transition-all {{ $activeFilter === 'done' ? 'bg-[#E3F1DC] text-[#1F3318] border border-[#B7D7A8] shadow-sm' : 'bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2]' }}">
                <span>Selesai</span>
                <span class="w-5 h-5 rounded-full bg-[#E8F3E1] flex items-center justify-center text-[11px] font-semibold text-[#1F3318]">8</span>
            </a>

            <a href="{{ url('/admin/pesanan?filter=cancel') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-[12px] font-medium whitespace-nowrap transition-all {{ $activeFilter === 'cancel' ? 'bg-[#FBDDC6] text-[#8C4A1A] border border-[#EFC3A3] shadow-sm' : 'bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2]' }}">
                <span>Batal</span>
                <span class="w-5 h-5 rounded-full bg-[#FBDDC6] flex items-center justify-center text-[11px] font-semibold text-[#8C4A1A]">2</span>
            </a>
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
                    <!-- Baris 1: DRN-0042 (Waiting Verification) -->
                    <tr class="h-16 hover:bg-[#F8FAF2] transition-colors group">
                        <td class="pl-4 pr-3 font-semibold text-[14px] text-[#7A6420]">
                            DRN-0042
                        </td>
                        <td class="px-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-full bg-[#CFE6C5] text-[#1F3318] flex items-center justify-center text-xs font-semibold">
                                    R
                                </div>
                                <span class="font-medium text-[#1F261D]">Rina</span>
                            </div>
                        </td>
                        <td class="px-3 text-[#4A5246]">Montong L ×1, Montong M ×1</td>
                        <td class="px-3 font-semibold text-[#1F261D]">Rp 440.000</td>
                        <td class="px-3">
                            <x-badge-status type="ready" />
                        </td>
                        <td class="px-3">
                            <x-badge-status type="waiting_verification" />
                        </td>
                        <td class="px-3 text-[#7A8275] font-mono text-xs">-</td>
                        <td class="pr-4 pl-3 text-right sticky right-0 bg-white group-hover:bg-[#F8FAF2] transition-colors">
                            <a href="{{ url('/admin/pesanan/DRN-0042') }}" class="inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-[12px] border border-[#E4E9DA] bg-white text-xs font-semibold text-[#1F261D] hover:bg-[#F8FAF2] transition-all shadow-sm">
                                <span>Lihat</span>
                                <span class="material-symbols-outlined text-[16px] text-[#4A5246]">chevron_right</span>
                            </a>
                        </td>
                    </tr>

                    @if($activeFilter !== 'verify')
                    <!-- Baris 2: DRN-0043 (Waiting Payment) -->
                    <tr class="h-16 hover:bg-[#F8FAF2] transition-colors group">
                        <td class="pl-4 pr-3 font-semibold text-[14px] text-[#7A6420]">
                            DRN-0043
                        </td>
                        <td class="px-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-full bg-[#F2D98A] text-[#5C4A12] flex items-center justify-center text-xs font-semibold">
                                    B
                                </div>
                                <span class="font-medium text-[#1F261D]">Budi</span>
                            </div>
                        </td>
                        <td class="px-3 text-[#4A5246]">Musang King M ×1</td>
                        <td class="px-3 font-semibold text-[#1F261D]">Rp 420.000</td>
                        <td class="px-3">
                            <x-badge-status type="ready" />
                        </td>
                        <td class="px-3">
                            <x-badge-status type="waiting_payment" />
                        </td>
                        <td class="px-3 font-mono text-sm text-[#7A6420] font-semibold">01:12:30</td>
                        <td class="pr-4 pl-3 text-right sticky right-0 bg-white group-hover:bg-[#F8FAF2] transition-colors">
                            <a href="{{ url('/admin/pesanan/DRN-0042') }}" class="inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-[12px] border border-[#E4E9DA] bg-white text-xs font-semibold text-[#1F261D] hover:bg-[#F8FAF2] transition-all shadow-sm">
                                <span>Lihat</span>
                                <span class="material-symbols-outlined text-[16px] text-[#4A5246]">chevron_right</span>
                            </a>
                        </td>
                    </tr>

                    <!-- Baris 3: DRN-0040 (Waiting Shipping Fee) -->
                    <tr class="h-16 hover:bg-[#F8FAF2] transition-colors group">
                        <td class="pl-4 pr-3 font-semibold text-[14px] text-[#7A6420]">
                            DRN-0040
                        </td>
                        <td class="px-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-full bg-[#CFE6C5] text-[#1F3318] flex items-center justify-center text-xs font-semibold">
                                    S
                                </div>
                                <span class="font-medium text-[#1F261D]">Siti</span>
                            </div>
                        </td>
                        <td class="px-3 text-[#4A5246]">Black Thorn L ×1</td>
                        <td class="px-3 font-semibold text-[#1F261D]">Rp 580.000</td>
                        <td class="px-3">
                            <x-badge-status type="preorder" />
                        </td>
                        <td class="px-3">
                            <x-badge-status type="waiting_shipping_fee" />
                        </td>
                        <td class="px-3 text-[#7A8275] font-mono text-xs">-</td>
                        <td class="pr-4 pl-3 text-right sticky right-0 bg-white group-hover:bg-[#F8FAF2] transition-colors">
                            <a href="{{ url('/admin/pesanan/DRN-0042') }}" class="inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-[12px] border border-[#E4E9DA] bg-white text-xs font-semibold text-[#1F261D] hover:bg-[#F8FAF2] transition-all shadow-sm">
                                <span>Lihat</span>
                                <span class="material-symbols-outlined text-[16px] text-[#4A5246]">chevron_right</span>
                            </a>
                        </td>
                    </tr>

                    <!-- Baris 4: DRN-0038 (Processing) -->
                    <tr class="h-16 hover:bg-[#F8FAF2] transition-colors group">
                        <td class="pl-4 pr-3 font-semibold text-[14px] text-[#7A6420]">
                            DRN-0038
                        </td>
                        <td class="px-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-full bg-[#E3F1DC] text-[#3F5B34] flex items-center justify-center text-xs font-semibold">
                                    A
                                </div>
                                <span class="font-medium text-[#1F261D]">Andi</span>
                            </div>
                        </td>
                        <td class="px-3 text-[#4A5246]">Montong L ×2</td>
                        <td class="px-3 font-semibold text-[#1F261D]">Rp 500.000</td>
                        <td class="px-3">
                            <x-badge-status type="ready" />
                        </td>
                        <td class="px-3">
                            <x-badge-status type="processing" />
                        </td>
                        <td class="px-3 text-[#7A8275] font-mono text-xs">-</td>
                        <td class="pr-4 pl-3 text-right sticky right-0 bg-white group-hover:bg-[#F8FAF2] transition-colors">
                            <a href="{{ url('/admin/pesanan/DRN-0042') }}" class="inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-[12px] border border-[#E4E9DA] bg-white text-xs font-semibold text-[#1F261D] hover:bg-[#F8FAF2] transition-all shadow-sm">
                                <span>Lihat</span>
                                <span class="material-symbols-outlined text-[16px] text-[#4A5246]">chevron_right</span>
                            </a>
                        </td>
                    </tr>

                    <!-- Baris 5: DRN-0036 (Shipped) -->
                    <tr class="h-16 hover:bg-[#F8FAF2] transition-colors group">
                        <td class="pl-4 pr-3 font-semibold text-[14px] text-[#7A6420]">
                            DRN-0036
                        </td>
                        <td class="px-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-full bg-[#FAF1CE] text-[#7A6420] flex items-center justify-center text-xs font-semibold">
                                    D
                                </div>
                                <span class="font-medium text-[#1F261D]">Dewi</span>
                            </div>
                        </td>
                        <td class="px-3 text-[#4A5246]">Musang King M ×2</td>
                        <td class="px-3 font-semibold text-[#1F261D]">Rp 840.000</td>
                        <td class="px-3">
                            <x-badge-status type="ready" />
                        </td>
                        <td class="px-3">
                            <x-badge-status type="shipped" />
                        </td>
                        <td class="px-3 text-[#7A8275] font-mono text-xs">-</td>
                        <td class="pr-4 pl-3 text-right sticky right-0 bg-white group-hover:bg-[#F8FAF2] transition-colors">
                            <a href="{{ url('/admin/pesanan/DRN-0042') }}" class="inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-[12px] border border-[#E4E9DA] bg-white text-xs font-semibold text-[#1F261D] hover:bg-[#F8FAF2] transition-all shadow-sm">
                                <span>Lihat</span>
                                <span class="material-symbols-outlined text-[16px] text-[#4A5246]">chevron_right</span>
                            </a>
                        </td>
                    </tr>

                    <!-- Baris 6: DRN-0035 (Completed) -->
                    <tr class="h-16 hover:bg-[#F8FAF2] transition-colors group">
                        <td class="pl-4 pr-3 font-semibold text-[14px] text-[#7A6420]">
                            DRN-0035
                        </td>
                        <td class="px-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-full bg-[#CFE6C5] text-[#1F3318] flex items-center justify-center text-xs font-semibold">
                                    E
                                </div>
                                <span class="font-medium text-[#1F261D]">Eko</span>
                            </div>
                        </td>
                        <td class="px-3 text-[#4A5246]">Montong L ×1</td>
                        <td class="px-3 font-semibold text-[#1F261D]">Rp 250.000</td>
                        <td class="px-3">
                            <x-badge-status type="ready" />
                        </td>
                        <td class="px-3">
                            <x-badge-status type="completed" />
                        </td>
                        <td class="px-3 text-[#7A8275] font-mono text-xs">-</td>
                        <td class="pr-4 pl-3 text-right sticky right-0 bg-white group-hover:bg-[#F8FAF2] transition-colors">
                            <a href="{{ url('/admin/pesanan/DRN-0042') }}" class="inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-[12px] border border-[#E4E9DA] bg-white text-xs font-semibold text-[#1F261D] hover:bg-[#F8FAF2] transition-all shadow-sm">
                                <span>Lihat</span>
                                <span class="material-symbols-outlined text-[16px] text-[#4A5246]">chevron_right</span>
                            </a>
                        </td>
                    </tr>

                    <!-- Baris 7: DRN-0034 (Auto Cancelled) -->
                    <tr class="h-16 hover:bg-[#F8FAF2] transition-colors group opacity-75">
                        <td class="pl-4 pr-3 font-semibold text-[14px] text-[#7A6420]">
                            DRN-0034
                        </td>
                        <td class="px-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-full bg-[#FBDDC6] text-[#8C4A1A] flex items-center justify-center text-xs font-semibold">
                                    H
                                </div>
                                <span class="font-medium text-[#1F261D]">Hendra</span>
                            </div>
                        </td>
                        <td class="px-3 text-[#4A5246]">Montong M ×1</td>
                        <td class="px-3 font-semibold text-[#1F261D]">Rp 190.000</td>
                        <td class="px-3">
                            <x-badge-status type="ready" />
                        </td>
                        <td class="px-3">
                            <x-badge-status type="cancelled" label="Batal Otomatis" />
                        </td>
                        <td class="px-3 text-[#BA1A1A] font-mono text-xs font-medium">Lewat batas</td>
                        <td class="pr-4 pl-3 text-right sticky right-0 bg-white group-hover:bg-[#F8FAF2] transition-colors">
                            <a href="{{ url('/admin/pesanan/DRN-0042') }}" class="inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-[12px] border border-[#E4E9DA] bg-white text-xs font-semibold text-[#1F261D] hover:bg-[#F8FAF2] transition-all shadow-sm">
                                <span>Lihat</span>
                                <span class="material-symbols-outlined text-[16px] text-[#4A5246]">chevron_right</span>
                            </a>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
