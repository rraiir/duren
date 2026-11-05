@extends('layouts.app')

@section('title', 'Dashboard Admin - DuREN')

@section('content')
<div class="space-y-8">
    <!-- 1. SAPAAN & SUBJUDUL -->
    <div>
        <div class="flex items-center space-x-3">
            <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">Halo,</h1>
            <span class="inline-flex items-center px-4 py-1 rounded-[12px] bg-[#E8F3E1] text-[#3C5732] border border-[#CFE6C5] text-[40px] leading-[48px] font-bold tracking-[-0.02em]">
                {{ auth()->user()->name ?? 'Admin' }}
            </span>
        </div>
        <p class="mt-2 text-[16px] leading-[22px] text-[#6B7366]">
            Selamat datang kembali! Pantau pesanan, pembayaran, dan stok durian DuREN hari ini.
        </p>
    </div>

    <!-- 2. EMPAT KARTU STATISTIK (Grid 4 Kolom, Gap 24px, Tinggi 156px) -->
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Kartu 1: Perlu Verifikasi -->
        <x-card-stat 
            title="Perlu Verifikasi"
            :value="$needVerifyCount"
            caption="Bukti Bayar Masuk"
            badgeText="Prioritas"
            badgeIcon="schedule"
            badgeClass="bg-[#FAF1CE] border border-[#ECDDA1] text-[#5C4A12]"
        />

        <!-- Kartu 2: Pesanan Aktif -->
        <x-card-stat 
            title="Pesanan Aktif"
            :value="$activeOrdersCount"
            caption="Sedang Diproses"
            icon="receipt_long"
            iconBg="bg-[#E3F1DC]"
            iconColor="text-[#3F5B34]"
        />

        <!-- Kartu 3: Stok Ready -->
        <x-card-stat 
            title="Stok Ready"
            :value="$readyStockCount"
            caption="Total Buah"
            badgeText="Tersedia"
            badgeIcon="check_circle"
            badgeClass="bg-[#CDEBD9] border border-[#ABD9C0] text-[#1F3318]"
        />

        <!-- Kartu 4: Omzet Bulan Ini -->
        <x-card-stat 
            title="Omzet<br>Bulan Ini"
            :value="'Rp ' . number_format($monthlyRevenue, 0, ',', '.')"
            caption="Pesanan Selesai"
            badgeText="Selesai"
            badgeClass="bg-[#DDEDCF] border border-[#C3DCAF] text-[#3F5B34]"
        />
    </section>

    <!-- 3. KARTU AKSES CEPAT (Grid 3 Kolom, Ubin Tinggi 92px, Gap 20px) -->
    <section class="custom-card">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-[20px] leading-[28px] font-semibold text-[#1F261D]">Akses Cepat</h2>
            <span class="text-[14px] font-medium text-[#6B7366]">Pilih menu navigasi utama</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Ubin 1: Durian -->
            <a href="{{ route('admin.durian') }}" class="h-[92px] p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center space-x-4 hover-lift">
                <div class="w-12 h-12 rounded-[12px] bg-[#F2D98A] flex items-center justify-center shrink-0 text-[#5C4A12]">
                    <span class="material-symbols-outlined text-[24px]">inventory_2</span>
                </div>
                <div class="overflow-hidden">
                    <h3 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] truncate">Durian</h3>
                    <p class="text-[12px] leading-[17px] text-[#6B7366] truncate">Kelola varian, ukuran &amp; stok</p>
                </div>
            </a>

            <!-- Ubin 2: Pesanan -->
            <a href="{{ route('admin.orders') }}" class="h-[92px] p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center space-x-4 hover-lift">
                <div class="w-12 h-12 rounded-[12px] bg-[#CFE6C5] flex items-center justify-center shrink-0 text-[#1F3318]">
                    <span class="material-symbols-outlined text-[24px]">receipt_long</span>
                </div>
                <div class="overflow-hidden">
                    <h3 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] truncate">Pesanan</h3>
                    <p class="text-[12px] leading-[17px] text-[#6B7366] truncate">Pantau pesanan masuk</p>
                </div>
            </a>

            <!-- Ubin 3: Verifikasi Bayar -->
            <a href="{{ route('admin.verification') }}" class="h-[92px] p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center space-x-4 hover-lift">
                <div class="w-12 h-12 rounded-[12px] bg-[#F2D98A] flex items-center justify-center shrink-0 text-[#5C4A12]">
                    <span class="material-symbols-outlined text-[24px]">fact_check</span>
                </div>
                <div class="overflow-hidden">
                    <h3 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] truncate">Verifikasi Bayar</h3>
                    <p class="text-[12px] leading-[17px] text-[#6B7366] truncate">Cek bukti &amp; mutasi</p>
                </div>
            </a>
        </div>
    </section>

    <!-- 4. DUA KARTU SEJAJAR: GRAFIK & AKTIVITAS -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-stretch">
        <!-- Kartu Kiri: Grafik Pesanan 5 Hari Terakhir -->
        <div class="custom-card flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-[20px] leading-[28px] font-semibold text-[#1F261D]">Tren Pesanan Masuk</h2>
                    <span class="text-[13px] font-medium text-[#7A6420]">5 Hari Terakhir</span>
                </div>
                <p class="text-[13px] text-[#6B7366] mb-6">Aktivitas volume transaksi pesanan harian.</p>

                <div class="h-[140px] flex items-end justify-between px-6 pt-4">
                    <div class="flex flex-col items-center space-y-2">
                        <span class="text-[11px] font-medium text-[#6B7366]">2</span>
                        <div class="w-10 bg-[#CFE6C5] rounded-t-[8px]" style="height: 48px;"></div>
                        <span class="text-[12px] font-medium text-[#4A5246] pt-1">Sen</span>
                    </div>
                    <div class="flex flex-col items-center space-y-2">
                        <span class="text-[11px] font-medium text-[#6B7366]">3</span>
                        <div class="w-10 bg-[#CFE6C5] rounded-t-[8px]" style="height: 64px;"></div>
                        <span class="text-[12px] font-medium text-[#4A5246] pt-1">Sel</span>
                    </div>
                    <div class="flex flex-col items-center space-y-2">
                        <span class="text-[11px] font-medium text-[#6B7366]">5</span>
                        <div class="w-10 bg-[#B7D7A8] rounded-t-[8px]" style="height: 96px;"></div>
                        <span class="text-[12px] font-medium text-[#4A5246] pt-1">Rab</span>
                    </div>
                    <div class="flex flex-col items-center space-y-2">
                        <span class="text-[11px] font-medium text-[#6B7366]">4</span>
                        <div class="w-10 bg-[#CFE6C5] rounded-t-[8px]" style="height: 80px;"></div>
                        <span class="text-[12px] font-medium text-[#4A5246] pt-1">Kam</span>
                    </div>
                    <div class="flex flex-col items-center space-y-2">
                        <span class="text-[11px] font-semibold text-[#1F3318]">6</span>
                        <div class="w-10 bg-[#F2D98A] rounded-t-[8px]" style="height: 112px;"></div>
                        <span class="text-[12px] font-bold text-[#1F261D] pt-1">Hari Ini</span>
                    </div>
                </div>
            </div>

            <!-- Footer Bergaris Atas -->
            <div class="pt-4 mt-6 border-t border-[#E4E9DA] flex items-center justify-between text-[12px] leading-[17px] text-[#6B7366]">
                <span>Pembaruan otomatis</span>
                <span class="font-medium text-[#4A5246]">{{ now()->format('H:i') }} WIB</span>
            </div>
        </div>

        <!-- Kartu Kanan: Aktivitas Terkini -->
        <div class="custom-card flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-[20px] leading-[28px] font-semibold text-[#1F261D]">Aktivitas Terkini</h2>
                    <a href="{{ route('admin.orders') }}" class="text-[14px] font-semibold text-[#7A6420] hover:underline">
                        Lihat Semua
                    </a>
                </div>

                <!-- Baris Aktivitas -->
                <div class="space-y-2.5">
                    @forelse ($recentOrders as $ro)
                        <div class="h-[56px] px-3.5 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-between hover:bg-[#F1F5E8] transition-colors">
                            <div class="flex items-center space-x-3 overflow-hidden pr-2">
                                <div class="w-8 h-8 rounded-full {{ $ro->status === 'completed' ? 'bg-[#CFE6C5] text-[#1F3318]' : ($ro->status === 'waiting_verification' ? 'bg-[#FAF1CE] text-[#7A6420]' : 'bg-[#E3F1DC] text-[#3F5B34]') }} flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[18px]">
                                        @if($ro->status === 'completed') check_circle
                                        @elseif($ro->status === 'waiting_verification') fact_check
                                        @elseif($ro->status === 'shipped') local_shipping
                                        @else receipt @endif
                                    </span>
                                </div>
                                <span class="text-[14px] leading-[20px] font-medium text-[#1F261D] truncate">
                                    Pesanan <strong>{{ $ro->code }}</strong> ({{ $ro->user->name ?? 'Pembeli' }}) — <span class="capitalize">{{ str_replace('_', ' ', $ro->status) }}</span>
                                </span>
                            </div>
                            <span class="text-[12px] leading-[17px] font-medium text-[#6B7366] shrink-0">
                                {{ $ro->updated_at ? $ro->updated_at->diffForHumans() : '-' }}
                            </span>
                        </div>
                    @empty
                        <div class="py-6 text-center text-[#6B7366] text-[14px]">
                            Belum ada aktivitas pesanan baru.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Footer Bergaris Atas -->
            <div class="pt-4 mt-6 border-t border-[#E4E9DA] flex items-center justify-between text-[12px] leading-[17px] text-[#6B7366]">
                <span>Tercatat di sistem</span>
                <span class="font-medium text-[#4A5246]">Tabel orders</span>
            </div>
        </div>
    </section>
</div>
@endsection
