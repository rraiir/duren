@extends('layouts.app')

@section('title', 'Dashboard Admin - DuREN')

@section('content')
<div class="space-y-8">
    <!-- 1. SAPAAN & SUBJUDUL -->
    <div>
        <div class="flex items-center space-x-3">
            <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">Halo,</h1>
            <span class="inline-flex items-center px-4 py-1 rounded-[12px] bg-[#E8F3E1] text-[#3C5732] border border-[#CFE6C5] text-[40px] leading-[48px] font-bold tracking-[-0.02em]">
                Admin
            </span>
        </div>
        <p class="mt-2 text-[16px] leading-[22px] text-[#6B7366]">
            Selamat datang kembali! Pantau pesanan, pembayaran, dan stok durian DuREN hari ini.
        </p>
    </div>

    <!-- 2. EMPAT KARTU STATISTIK (Grid 4 Kolom, Gap 24px, Tinggi 156px) -->
    <section class="grid grid-cols-4 gap-6">
        <!-- Kartu 1: Perlu Verifikasi -->
        <x-card-stat 
            title="Perlu Verifikasi"
            value="3"
            caption="Bukti Bayar Masuk"
            badgeText="Prioritas"
            badgeIcon="schedule"
            badgeClass="bg-[#FAF1CE] border border-[#ECDDA1] text-[#5C4A12]"
        />

        <!-- Kartu 2: Pesanan Aktif -->
        <x-card-stat 
            title="Pesanan Aktif"
            value="8"
            caption="Sedang Diproses"
            icon="receipt_long"
            iconBg="bg-[#E3F1DC]"
            iconColor="text-[#3F5B34]"
        />

        <!-- Kartu 3: Stok Ready -->
        <x-card-stat 
            title="Stok Ready"
            value="42"
            caption="Total Buah"
            badgeText="Tersedia"
            badgeIcon="check_circle"
            badgeClass="bg-[#CDEBD9] border border-[#ABD9C0] text-[#1F3318]"
        />

        <!-- Kartu 4: Omzet Bulan Ini -->
        <x-card-stat 
            title="Omzet<br>Bulan Ini"
            value="Rp 12,5 jt"
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
        <div class="grid grid-cols-3 gap-5">
            <!-- Ubin 1: Durian (Kotak Kuning) -->
            <a href="{{ url('/admin/durian') }}" class="h-[92px] p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center space-x-4 hover-lift">
                <div class="w-12 h-12 rounded-[12px] bg-[#F2D98A] flex items-center justify-center flex-shrink-0 text-[#5C4A12]">
                    <span class="material-symbols-outlined text-[24px]">inventory_2</span>
                </div>
                <div class="overflow-hidden">
                    <h3 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] truncate">Durian</h3>
                    <p class="text-[12px] leading-[17px] text-[#6B7366] truncate">Kelola varian, ukuran &amp; stok</p>
                </div>
            </a>

            <!-- Ubin 2: Pesanan (Kotak Hijau) -->
            <a href="{{ url('/admin/pesanan') }}" class="h-[92px] p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center space-x-4 hover-lift">
                <div class="w-12 h-12 rounded-[12px] bg-[#CFE6C5] flex items-center justify-center flex-shrink-0 text-[#1F3318]">
                    <span class="material-symbols-outlined text-[24px]">receipt_long</span>
                </div>
                <div class="overflow-hidden">
                    <h3 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] truncate">Pesanan</h3>
                    <p class="text-[12px] leading-[17px] text-[#6B7366] truncate">Pantau pesanan masuk</p>
                </div>
            </a>

            <!-- Ubin 3: Verifikasi Bayar (Kotak Kuning) -->
            <a href="{{ url('/admin/verifikasi-bayar') }}" class="h-[92px] p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center space-x-4 hover-lift">
                <div class="w-12 h-12 rounded-[12px] bg-[#F2D98A] flex items-center justify-center flex-shrink-0 text-[#5C4A12]">
                    <span class="material-symbols-outlined text-[24px]">fact_check</span>
                </div>
                <div class="overflow-hidden">
                    <h3 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] truncate">Verifikasi Bayar</h3>
                    <p class="text-[12px] leading-[17px] text-[#6B7366] truncate">Cek bukti &amp; mutasi</p>
                </div>
            </a>

            <!-- Ubin 4: Pembeli (Kotak Hijau) -->
            <a href="{{ url('/admin/pembeli') }}" class="h-[92px] p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center space-x-4 hover-lift">
                <div class="w-12 h-12 rounded-[12px] bg-[#CFE6C5] flex items-center justify-center flex-shrink-0 text-[#1F3318]">
                    <span class="material-symbols-outlined text-[24px]">group</span>
                </div>
                <div class="overflow-hidden">
                    <h3 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] truncate">Pembeli</h3>
                    <p class="text-[12px] leading-[17px] text-[#6B7366] truncate">Daftar akun &amp; reset password</p>
                </div>
            </a>

            <!-- Ubin 5: Laporan (Kotak Kuning) -->
            <a href="{{ url('/admin/laporan') }}" class="h-[92px] p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center space-x-4 hover-lift">
                <div class="w-12 h-12 rounded-[12px] bg-[#F2D98A] flex items-center justify-center flex-shrink-0 text-[#5C4A12]">
                    <span class="material-symbols-outlined text-[24px]">bar_chart</span>
                </div>
                <div class="overflow-hidden">
                    <h3 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] truncate">Laporan</h3>
                    <p class="text-[12px] leading-[17px] text-[#6B7366] truncate">Rekap penjualan per tanggal</p>
                </div>
            </a>

            <!-- Ubin 6: Pengaturan (Kotak Hijau) -->
            <a href="{{ url('/admin/pengaturan') }}" class="h-[92px] p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center space-x-4 hover-lift">
                <div class="w-12 h-12 rounded-[12px] bg-[#CFE6C5] flex items-center justify-center flex-shrink-0 text-[#1F3318]">
                    <span class="material-symbols-outlined text-[24px]">settings</span>
                </div>
                <div class="overflow-hidden">
                    <h3 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] truncate">Pengaturan</h3>
                    <p class="text-[12px] leading-[17px] text-[#6B7366] truncate">QRIS, garansi &amp; aturan ongkir</p>
                </div>
            </a>
        </div>
    </section>

    <!-- 4. DUA KARTU SEJAJAR (Grid 2 Kolom, Gap 24px, Min Height 300px) -->
    <section class="grid grid-cols-2 gap-6 min-h-[300px]">
        <!-- Kartu Kiri: Pesanan Minggu Ini -->
        <div class="custom-card flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <h2 class="text-[20px] leading-[28px] font-semibold text-[#1F261D]">Pesanan Minggu Ini</h2>
                    <span class="inline-flex items-center space-x-1 text-[14px] font-semibold text-[#3F5B34]">
                        <span class="material-symbols-outlined text-[16px]">trending_up</span>
                        <span>Naik</span>
                    </span>
                </div>
                <p class="mt-1 text-[14px] leading-[20px] text-[#6B7366]">
                    Jumlah pesanan terbayar naik dibanding minggu lalu.
                </p>

                <!-- Grafik Batang 5 Batang (Sen, Sel, Rab, Kam, Jum) -->
                <div class="mt-6 pt-4 flex items-end justify-between px-6 h-[120px] border-b border-[#E4E9DA]">
                    <!-- Sen: hijau #CFE6C5 -->
                    <div class="flex flex-col items-center space-y-2">
                        <span class="text-[11px] font-medium text-[#6B7366]">14</span>
                        <div class="w-10 bg-[#CFE6C5] rounded-t-[8px]" style="height: 52px;"></div>
                        <span class="text-[12px] font-medium text-[#4A5246] pt-1">Sen</span>
                    </div>
                    <!-- Sel: kuning #F2D98A -->
                    <div class="flex flex-col items-center space-y-2">
                        <span class="text-[11px] font-medium text-[#6B7366]">18</span>
                        <div class="w-10 bg-[#F2D98A] rounded-t-[8px]" style="height: 68px;"></div>
                        <span class="text-[12px] font-medium text-[#4A5246] pt-1">Sel</span>
                    </div>
                    <!-- Rab: Hari Ini (Tertinggi, hijau #CFE6C5, label semibold) -->
                    <div class="flex flex-col items-center space-y-2">
                        <span class="text-[11px] font-bold text-[#1F3318]">26</span>
                        <div class="w-10 bg-[#CFE6C5] rounded-t-[8px] border-2 border-[#B7D7A8]" style="height: 94px;"></div>
                        <span class="text-[12px] font-bold text-[#1F3318] pt-1">Rab</span>
                    </div>
                    <!-- Kam: kuning #F2D98A -->
                    <div class="flex flex-col items-center space-y-2">
                        <span class="text-[11px] font-medium text-[#6B7366]">15</span>
                        <div class="w-10 bg-[#F2D98A] rounded-t-[8px]" style="height: 58px;"></div>
                        <span class="text-[12px] font-medium text-[#4A5246] pt-1">Kam</span>
                    </div>
                    <!-- Jum: pucat #F1F5E8 (estimasi/berjalan) -->
                    <div class="flex flex-col items-center space-y-2">
                        <span class="text-[11px] font-medium text-[#7A8275]">8</span>
                        <div class="w-10 bg-[#F1F5E8] rounded-t-[8px] border border-dashed border-[#E4E9DA]" style="height: 32px;"></div>
                        <span class="text-[12px] font-medium text-[#7A8275] pt-1">Jum</span>
                    </div>
                </div>
            </div>

            <!-- Footer Bergaris Atas -->
            <div class="pt-4 mt-6 border-t border-[#E4E9DA] flex items-center justify-between text-[12px] leading-[17px] text-[#6B7366]">
                <span>Pembaruan otomatis</span>
                <span class="font-medium text-[#4A5246]">Hari ini, 14:30 WIB</span>
            </div>
        </div>

        <!-- Kartu Kanan: Aktivitas Terkini -->
        <div class="custom-card flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-[20px] leading-[28px] font-semibold text-[#1F261D]">Aktivitas Terkini</h2>
                    <a href="{{ url('/admin/pesanan') }}" class="text-[14px] font-semibold text-[#7A6420] hover:underline">
                        Lihat Semua
                    </a>
                </div>

                <!-- Tiga Baris Aktivitas Tinggi 56px -->
                <div class="space-y-2">
                    <!-- Baris 1: Hijau (fact_check) -->
                    <div class="h-[56px] px-3.5 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-between hover:bg-[#F1F5E8] transition-colors">
                        <div class="flex items-center space-x-3 overflow-hidden pr-2">
                            <div class="w-8 h-8 rounded-full bg-[#CFE6C5] flex items-center justify-center flex-shrink-0 text-[#1F3318]">
                                <span class="material-symbols-outlined text-[18px]">fact_check</span>
                            </div>
                            <span class="text-[14px] leading-[20px] font-medium text-[#1F261D] truncate">
                                Bukti bayar baru dari Rina, pesanan DRN-0042
                            </span>
                        </div>
                        <span class="text-[12px] leading-[17px] font-medium text-[#6B7366] flex-shrink-0">
                            10 mnt lalu
                        </span>
                    </div>

                    <!-- Baris 2: Kuning (timer_off) -->
                    <div class="h-[56px] px-3.5 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-between hover:bg-[#F1F5E8] transition-colors">
                        <div class="flex items-center space-x-3 overflow-hidden pr-2">
                            <div class="w-8 h-8 rounded-full bg-[#F2D98A] flex items-center justify-center flex-shrink-0 text-[#5C4A12]">
                                <span class="material-symbols-outlined text-[18px]">timer_off</span>
                            </div>
                            <span class="text-[14px] leading-[20px] font-medium text-[#1F261D] truncate">
                                Pesanan DRN-0039 batal otomatis (batas waktu habis)
                            </span>
                        </div>
                        <span class="text-[12px] leading-[17px] font-medium text-[#6B7366] flex-shrink-0">
                            1 jam lalu
                        </span>
                    </div>

                    <!-- Baris 3: Hijau (check_circle) -->
                    <div class="h-[56px] px-3.5 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-between hover:bg-[#F1F5E8] transition-colors">
                        <div class="flex items-center space-x-3 overflow-hidden pr-2">
                            <div class="w-8 h-8 rounded-full bg-[#CFE6C5] flex items-center justify-center flex-shrink-0 text-[#1F3318]">
                                <span class="material-symbols-outlined text-[18px]">check_circle</span>
                            </div>
                            <span class="text-[14px] leading-[20px] font-medium text-[#1F261D] truncate">
                                Pesanan DRN-0036 selesai diantar kurir
                            </span>
                        </div>
                        <span class="text-[12px] leading-[17px] font-medium text-[#6B7366] flex-shrink-0">
                            3 jam lalu
                        </span>
                    </div>
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
