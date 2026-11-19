@extends('layouts.app')

@section('title', 'Profil Saya - DuREN')

@section('content')
<div class="space-y-8">

    {{-- Judul Halaman --}}
    <div>
        <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">Profil Saya</h1>
        <p class="mt-1 text-[16px] leading-[22px] text-[#6B7366]">Lihat dan kelola informasi akun Anda.</p>
    </div>

    {{-- Kartu Informasi Akun --}}
    <x-card judul="Informasi Akun">
        <div class="flex items-center gap-6 mb-6">
            <div class="w-16 h-16 rounded-full bg-[#E3F1DC] flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[36px] text-[#3F5B34]">person</span>
            </div>
            <div>
                <h2 class="text-[24px] font-bold text-[#1F261D]">{{ $user->name }}</h2>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[12px] font-medium
                    {{ $user->role === 'admin' ? 'bg-[#F2D98A] text-[#5C4A12]' : 'bg-[#E3F1DC] text-[#1F3318]' }}">
                    {{ $user->role === 'admin' ? 'Administrator' : 'Pembeli' }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            {{-- Nama --}}
            <div class="p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA]">
                <div class="flex items-center gap-2 mb-1">
                    <span class="material-symbols-outlined text-[18px] text-[#4A5246]">badge</span>
                    <span class="text-[12px] font-medium text-[#6B7366] uppercase tracking-wide">Nama Lengkap</span>
                </div>
                <p class="text-[16px] font-semibold text-[#1F261D]">{{ $user->name }}</p>
            </div>

            {{-- No. WhatsApp --}}
            <div class="p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA]">
                <div class="flex items-center gap-2 mb-1">
                    <span class="material-symbols-outlined text-[18px] text-[#4A5246]">phone</span>
                    <span class="text-[12px] font-medium text-[#6B7366] uppercase tracking-wide">No. WhatsApp</span>
                </div>
                <p class="text-[16px] font-semibold text-[#1F261D]">{{ $user->phone }}</p>
            </div>

            {{-- Alamat --}}
            <div class="p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] md:col-span-2">
                <div class="flex items-center gap-2 mb-1">
                    <span class="material-symbols-outlined text-[18px] text-[#4A5246]">location_on</span>
                    <span class="text-[12px] font-medium text-[#6B7366] uppercase tracking-wide">Alamat Pengiriman</span>
                </div>
                <p class="text-[16px] font-semibold text-[#1F261D]">
                    {{ $user->address ?: 'Belum diisi' }}
                </p>
            </div>

            {{-- Status Akun --}}
            <div class="p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA]">
                <div class="flex items-center gap-2 mb-1">
                    <span class="material-symbols-outlined text-[18px] text-[#4A5246]">verified_user</span>
                    <span class="text-[12px] font-medium text-[#6B7366] uppercase tracking-wide">Status Akun</span>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[13px] font-semibold
                    {{ $user->is_active ? 'bg-[#CDEBD9] border border-[#ABD9C0] text-[#1F3318]' : 'bg-[#FBDDC6] border border-[#EFC3A3] text-[#8C4A1A]' }}">
                    {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>

            {{-- Bergabung Sejak --}}
            <div class="p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA]">
                <div class="flex items-center gap-2 mb-1">
                    <span class="material-symbols-outlined text-[18px] text-[#4A5246]">calendar_today</span>
                    <span class="text-[12px] font-medium text-[#6B7366] uppercase tracking-wide">Bergabung Sejak</span>
                </div>
                <p class="text-[16px] font-semibold text-[#1F261D]">
                    {{ $user->created_at ? $user->created_at->locale('id')->isoFormat('D MMMM YYYY') : '-' }}
                </p>
            </div>
        </div>
    </x-card>

    {{-- Kartu Statistik Pesanan (khusus pembeli) --}}
    @if($user->role === 'buyer')
    <x-card judul="Ringkasan Pesanan">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="text-center p-4 rounded-[14px] bg-[#FAF1CE] border border-[#ECDDA1]">
                <div class="text-[32px] font-bold text-[#5C4A12]">{{ $totalOrders }}</div>
                <div class="text-[12px] font-medium text-[#7A6420] mt-1">Total Pesanan</div>
            </div>
            <div class="text-center p-4 rounded-[14px] bg-[#CDEBD9] border border-[#ABD9C0]">
                <div class="text-[32px] font-bold text-[#1F3318]">{{ $completedOrders }}</div>
                <div class="text-[12px] font-medium text-[#3F5B34] mt-1">Selesai</div>
            </div>
            <div class="text-center p-4 rounded-[14px] bg-[#E3F1DC] border border-[#B7D7A8]">
                <div class="text-[32px] font-bold text-[#1F3318]">{{ $activeOrders }}</div>
                <div class="text-[12px] font-medium text-[#3F5B34] mt-1">Aktif</div>
            </div>
            <div class="text-center p-4 rounded-[14px] bg-[#FBDDC6] border border-[#EFC3A3]">
                <div class="text-[32px] font-bold text-[#8C4A1A]">{{ $cancelledOrders }}</div>
                <div class="text-[12px] font-medium text-[#8C4A1A] mt-1">Dibatalkan</div>
            </div>
        </div>
    </x-card>
    @endif

    {{-- Tombol Navigasi --}}
    <div class="flex gap-3 flex-wrap">
        @if($user->role === 'buyer')
            <a href="{{ route('buyer.catalog') }}"
               class="inline-flex items-center gap-2 h-10 px-5 rounded-[14px] bg-[#F2D98A] text-[#1F261D] hover:brightness-95 font-semibold text-[14px] transition-all shadow-sm">
                <span class="material-symbols-outlined text-[18px]">storefront</span>
                Belanja Durian
            </a>
            <a href="{{ route('buyer.orders') }}"
               class="inline-flex items-center gap-2 h-10 px-5 rounded-[14px] bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2] font-medium text-[14px] transition-colors">
                <span class="material-symbols-outlined text-[18px]">receipt_long</span>
                Pesanan Saya
            </a>
        @else
            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center gap-2 h-10 px-5 rounded-[14px] bg-[#F2D98A] text-[#1F261D] hover:brightness-95 font-semibold text-[14px] transition-all shadow-sm">
                <span class="material-symbols-outlined text-[18px]">dashboard</span>
                Dashboard Admin
            </a>
        @endif
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit"
                    class="inline-flex items-center gap-2 h-10 px-5 rounded-[14px] bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2] font-medium text-[14px] transition-colors cursor-pointer">
                <span class="material-symbols-outlined text-[18px]">logout</span>
                Keluar
            </button>
        </form>
    </div>

</div>
@endsection
