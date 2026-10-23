@extends('layouts.app')

@section('title', 'Laporan Penjualan - DuREN')

@section('content')
<div class="space-y-6">
    <!-- 1. KEPALA HALAMAN -->
    <div class="flex items-center justify-between pb-2">
        <div class="flex flex-col">
            <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">Laporan Penjualan</h1>
            <p class="text-[16px] leading-[22px] text-[#6B7366] mt-1">Rekapitulasi pesanan selesai dan omzet durian.</p>
        </div>
    </div>

    <!-- 2. KARTU FILTER RENTANG TANGGAL -->
    <div class="custom-card !p-5 flex flex-wrap items-center justify-between gap-4">
        <div class="flex flex-wrap items-center gap-4">
            <!-- Dari Tanggal -->
            <div class="flex flex-col">
                <label class="text-[12px] font-medium text-[#4A5246] mb-1.5" for="date-from">Dari tanggal</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-[18px] text-[#7A8275] pointer-events-none">calendar_today</span>
                    <input class="h-[44px] pl-10 pr-3 rounded-[12px] border border-[#E4E9DA] bg-white text-[14px] text-[#1F261D] focus:outline-none focus:border-[#B7D7A8] transition-colors" id="date-from" type="text" value="01 Okt 2026">
                </div>
            </div>
            <!-- Sampai Tanggal -->
            <div class="flex flex-col">
                <label class="text-[12px] font-medium text-[#4A5246] mb-1.5" for="date-to">Sampai tanggal</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-[18px] text-[#7A8275] pointer-events-none">calendar_today</span>
                    <input class="h-[44px] pl-10 pr-3 rounded-[12px] border border-[#E4E9DA] bg-white text-[14px] text-[#1F261D] focus:outline-none focus:border-[#B7D7A8] transition-colors" id="date-to" type="text" value="20 Okt 2026">
                </div>
            </div>
            <!-- Preset Chips -->
            <div class="flex items-center gap-2 pt-5 ml-1">
                <button class="px-4 py-2 rounded-full bg-white border border-[#E4E9DA] hover:bg-[#F8FAF2] text-[#4A5246] text-[13px] font-medium transition-colors shadow-xs cursor-pointer" type="button">7 Hari</button>
                <button class="px-4 py-2 rounded-full bg-white border border-[#E4E9DA] hover:bg-[#F8FAF2] text-[#4A5246] text-[13px] font-medium transition-colors shadow-xs cursor-pointer" type="button">30 Hari</button>
                <button class="px-4 py-2 rounded-full bg-[#E3F1DC] border border-[#B7D7A8] text-[#1F3318] text-[13px] font-semibold shadow-xs cursor-pointer" type="button">Bulan Ini</button>
            </div>
        </div>
        <!-- Tombol Tampilkan -->
        <div class="pt-5">
            <button class="h-[44px] px-6 rounded-[14px] bg-[#F2D98A] hover:bg-[#ebd07d] text-[#5C4A12] text-[14px] font-semibold flex items-center gap-2 transition-all shadow-xs cursor-pointer" type="button">
                <span class="material-symbols-outlined text-[19px]">filter_alt</span>
                <span>Tampilkan</span>
            </button>
        </div>
    </div>

    <!-- 3. TIGA KARTU STATISTIK -->
    <section class="grid grid-cols-3 gap-6">
        <x-card-stat 
            title="Jumlah Pesanan"
            value="24"
            caption="Pesanan Selesai"
            icon="shopping_bag"
            iconBg="bg-[#E3F1DC]"
            iconColor="text-[#3F5B34]"
        />

        <x-card-stat 
            title="Jumlah Item"
            value="41"
            caption="Buah Terjual"
            icon="inventory_2"
            iconBg="bg-[#FAF1CE]"
            iconColor="text-[#5C4A12]"
        />

        <x-card-stat 
            title="Total Omzet"
            value="Rp 12,48 jt"
            caption="Tanpa Ongkir"
            badgeText="Durian Saja"
            badgeClass="bg-[#CDEBD9] border border-[#ABD9C0] text-[#14382A]"
        />
    </section>

    <!-- 4. KARTU OMZET HARIAN (Grafik Batang) -->
    <section class="custom-card !p-6">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-[20px] font-semibold text-[#1F261D]">Omzet Harian</h2>
                <p class="text-[14px] text-[#6B7366] mt-0.5">Tren pendapatan harian dari 10 hari terakhir (11–20 Okt 2026)</p>
            </div>
            <div class="flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#F8FAF2] border border-[#E4E9DA]">
                <span class="w-2.5 h-2.5 rounded-full bg-[#F2D98A]"></span>
                <span class="text-[12px] text-[#4A5246]">Tertinggi: <strong class="text-[#1F261D] font-semibold">20 Okt (Rp 1.840.000)</strong></span>
            </div>
        </div>

        <!-- Area Chart Batang -->
        <div class="h-64 w-full flex items-end justify-between gap-3 px-2 pt-8 pb-3 relative">
            <div class="absolute inset-x-0 top-10 h-px bg-[#E4E9DA]/50 pointer-events-none"></div>
            <div class="absolute inset-x-0 top-28 h-px bg-[#E4E9DA]/50 pointer-events-none"></div>
            <div class="absolute inset-x-0 top-44 h-px bg-[#E4E9DA]/50 pointer-events-none"></div>

            <!-- 11 Okt -->
            <div class="flex-1 flex flex-col items-center h-full justify-end group cursor-pointer">
                <span class="text-[11px] text-[#6B7366] opacity-0 group-hover:opacity-100 transition-opacity mb-2 whitespace-nowrap">Rp 820rb</span>
                <div class="w-full max-w-[52px] h-[45%] bg-[#CFE6C5] rounded-t-lg transition-all group-hover:brightness-95 shadow-xs"></div>
                <span class="text-[12px] text-[#4A5246] mt-3 group-hover:text-[#1F261D] transition-colors">11 Okt</span>
            </div>
            <!-- 12 Okt -->
            <div class="flex-1 flex flex-col items-center h-full justify-end group cursor-pointer">
                <span class="text-[11px] text-[#6B7366] opacity-0 group-hover:opacity-100 transition-opacity mb-2 whitespace-nowrap">Rp 1.150rb</span>
                <div class="w-full max-w-[52px] h-[60%] bg-[#F2D98A] rounded-t-lg transition-all group-hover:brightness-95 shadow-xs"></div>
                <span class="text-[12px] text-[#4A5246] mt-3 group-hover:text-[#1F261D] transition-colors">12 Okt</span>
            </div>
            <!-- 13 Okt -->
            <div class="flex-1 flex flex-col items-center h-full justify-end group cursor-pointer">
                <span class="text-[11px] text-[#6B7366] opacity-0 group-hover:opacity-100 transition-opacity mb-2 whitespace-nowrap">Rp 960rb</span>
                <div class="w-full max-w-[52px] h-[55%] bg-[#CFE6C5] rounded-t-lg transition-all group-hover:brightness-95 shadow-xs"></div>
                <span class="text-[12px] text-[#4A5246] mt-3 group-hover:text-[#1F261D] transition-colors">13 Okt</span>
            </div>
            <!-- 14 Okt -->
            <div class="flex-1 flex flex-col items-center h-full justify-end group cursor-pointer">
                <span class="text-[11px] text-[#6B7366] opacity-0 group-hover:opacity-100 transition-opacity mb-2 whitespace-nowrap">Rp 1.340rb</span>
                <div class="w-full max-w-[52px] h-[70%] bg-[#F2D98A] rounded-t-lg transition-all group-hover:brightness-95 shadow-xs"></div>
                <span class="text-[12px] text-[#4A5246] mt-3 group-hover:text-[#1F261D] transition-colors">14 Okt</span>
            </div>
            <!-- 15 Okt -->
            <div class="flex-1 flex flex-col items-center h-full justify-end group cursor-pointer">
                <span class="text-[11px] text-[#6B7366] opacity-0 group-hover:opacity-100 transition-opacity mb-2 whitespace-nowrap">Rp 780rb</span>
                <div class="w-full max-w-[52px] h-[45%] bg-[#CFE6C5] rounded-t-lg transition-all group-hover:brightness-95 shadow-xs"></div>
                <span class="text-[12px] text-[#4A5246] mt-3 group-hover:text-[#1F261D] transition-colors">15 Okt</span>
            </div>
            <!-- 16 Okt -->
            <div class="flex-1 flex flex-col items-center h-full justify-end group cursor-pointer">
                <span class="text-[11px] text-[#6B7366] opacity-0 group-hover:opacity-100 transition-opacity mb-2 whitespace-nowrap">Rp 1.050rb</span>
                <div class="w-full max-w-[52px] h-[65%] bg-[#F2D98A] rounded-t-lg transition-all group-hover:brightness-95 shadow-xs"></div>
                <span class="text-[12px] text-[#4A5246] mt-3 group-hover:text-[#1F261D] transition-colors">16 Okt</span>
            </div>
            <!-- 17 Okt -->
            <div class="flex-1 flex flex-col items-center h-full justify-end group cursor-pointer">
                <span class="text-[11px] text-[#6B7366] opacity-0 group-hover:opacity-100 transition-opacity mb-2 whitespace-nowrap">Rp 1.220rb</span>
                <div class="w-full max-w-[52px] h-[65%] bg-[#CFE6C5] rounded-t-lg transition-all group-hover:brightness-95 shadow-xs"></div>
                <span class="text-[12px] text-[#4A5246] mt-3 group-hover:text-[#1F261D] transition-colors">17 Okt</span>
            </div>
            <!-- 18 Okt -->
            <div class="flex-1 flex flex-col items-center h-full justify-end group cursor-pointer">
                <span class="text-[11px] text-[#6B7366] opacity-0 group-hover:opacity-100 transition-opacity mb-2 whitespace-nowrap">Rp 1.480rb</span>
                <div class="w-full max-w-[52px] h-[80%] bg-[#F2D98A] rounded-t-lg transition-all group-hover:brightness-95 shadow-xs"></div>
                <span class="text-[12px] text-[#4A5246] mt-3 group-hover:text-[#1F261D] transition-colors">18 Okt</span>
            </div>
            <!-- 19 Okt -->
            <div class="flex-1 flex flex-col items-center h-full justify-end group cursor-pointer">
                <span class="text-[11px] text-[#6B7366] opacity-0 group-hover:opacity-100 transition-opacity mb-2 whitespace-nowrap">Rp 1.560rb</span>
                <div class="w-full max-w-[52px] h-[85%] bg-[#CFE6C5] rounded-t-lg transition-all group-hover:brightness-95 shadow-xs"></div>
                <span class="text-[12px] text-[#4A5246] mt-3 group-hover:text-[#1F261D] transition-colors">19 Okt</span>
            </div>
            <!-- 20 Okt (Tertinggi) -->
            <div class="flex-1 flex flex-col items-center h-full justify-end group cursor-pointer">
                <span class="text-[11px] font-semibold text-[#5C4A12] mb-2 whitespace-nowrap">Rp 1.840rb</span>
                <div class="w-full max-w-[52px] h-[100%] bg-[#F2D98A] rounded-t-lg border-2 border-[#ECDDA1] transition-all group-hover:brightness-95 shadow-xs"></div>
                <span class="text-[12px] text-[#1F261D] font-bold mt-3">20 Okt</span>
            </div>
        </div>
    </section>

    <!-- 5. KARTU RINCIAN TRANSAKSI -->
    <section class="custom-card !p-6">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-[20px] font-semibold text-[#1F261D]">Rincian Transaksi</h2>
            <span class="text-[13px] text-[#6B7366]">Menampilkan 6 dari 24 transaksi selesai</span>
        </div>

        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="h-11 bg-[#F8FAF2] rounded-[10px]">
                        <th class="px-4 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider rounded-l-[10px]">Tanggal</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider">Kode</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider">Pembeli</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider">Item Durian</th>
                        <th class="px-4 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider text-right rounded-r-[10px]">Total Omzet</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E4E9DA] text-[14px] text-[#1F261D]">
                    <tr class="h-14 hover:bg-[#F8FAF2] transition-colors">
                        <td class="px-4 py-3 text-[#4A5246]">20 Okt 2026</td>
                        <td class="px-3 py-3 font-semibold text-[#7A6420]">DRN-0031</td>
                        <td class="px-3 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-[#FBDDC6] flex items-center justify-center text-[11px] font-semibold text-[#8C4A1A]">M</div>
                                <span>Maya</span>
                            </div>
                        </td>
                        <td class="px-3 py-3 text-[#4A5246]">Musang King M ×1</td>
                        <td class="px-4 py-3 text-right font-semibold text-[#1F261D]">Rp 420.000</td>
                    </tr>
                    <tr class="h-14 hover:bg-[#F8FAF2] transition-colors">
                        <td class="px-4 py-3 text-[#4A5246]">19 Okt 2026</td>
                        <td class="px-3 py-3 font-semibold text-[#7A6420]">DRN-0029</td>
                        <td class="px-3 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-[#E3F1DC] flex items-center justify-center text-[11px] font-semibold text-[#1F3318]">R</div>
                                <span>Rudi</span>
                            </div>
                        </td>
                        <td class="px-3 py-3 text-[#4A5246]">Montong L ×2</td>
                        <td class="px-4 py-3 text-right font-semibold text-[#1F261D]">Rp 500.000</td>
                    </tr>
                    <tr class="h-14 hover:bg-[#F8FAF2] transition-colors">
                        <td class="px-4 py-3 text-[#4A5246]">19 Okt 2026</td>
                        <td class="px-3 py-3 font-semibold text-[#7A6420]">DRN-0028</td>
                        <td class="px-3 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-[#FAF1CE] flex items-center justify-center text-[11px] font-semibold text-[#5C4A12]">T</div>
                                <span>Tina</span>
                            </div>
                        </td>
                        <td class="px-3 py-3 text-[#4A5246]">Bawor L ×1</td>
                        <td class="px-4 py-3 text-right font-semibold text-[#1F261D]">Rp 230.000</td>
                    </tr>
                    <tr class="h-14 hover:bg-[#F8FAF2] transition-colors">
                        <td class="px-4 py-3 text-[#4A5246]">18 Okt 2026</td>
                        <td class="px-3 py-3 font-semibold text-[#7A6420]">DRN-0026</td>
                        <td class="px-3 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-[#FBDDC6] flex items-center justify-center text-[11px] font-semibold text-[#8C4A1A]">J</div>
                                <span>Joko</span>
                            </div>
                        </td>
                        <td class="px-3 py-3 text-[#4A5246]">Montong M ×3</td>
                        <td class="px-4 py-3 text-right font-semibold text-[#1F261D]">Rp 570.000</td>
                    </tr>
                    <tr class="h-14 hover:bg-[#F8FAF2] transition-colors">
                        <td class="px-4 py-3 text-[#4A5246]">17 Okt 2026</td>
                        <td class="px-3 py-3 font-semibold text-[#7A6420]">DRN-0024</td>
                        <td class="px-3 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-[#E3F1DC] flex items-center justify-center text-[11px] font-semibold text-[#1F3318]">L</div>
                                <span>Lia</span>
                            </div>
                        </td>
                        <td class="px-3 py-3 text-[#4A5246]">Petruk M ×2</td>
                        <td class="px-4 py-3 text-right font-semibold text-[#1F261D]">Rp 400.000</td>
                    </tr>
                    <tr class="h-14 hover:bg-[#F8FAF2] transition-colors">
                        <td class="px-4 py-3 text-[#4A5246]">16 Okt 2026</td>
                        <td class="px-3 py-3 font-semibold text-[#7A6420]">DRN-0022</td>
                        <td class="px-3 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-[#FAF1CE] flex items-center justify-center text-[11px] font-semibold text-[#5C4A12]">E</div>
                                <span>Eko</span>
                            </div>
                        </td>
                        <td class="px-3 py-3 text-[#4A5246]">Musang King S ×1</td>
                        <td class="px-4 py-3 text-right font-semibold text-[#1F261D]">Rp 310.000</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="h-14 bg-[#F8FAF2] font-semibold text-[#1F261D] border-t border-[#E4E9DA]">
                        <td class="px-4 py-3" colspan="3">Total Terpilih</td>
                        <td class="px-3 py-3 text-[#4A5246]">10 Buah</td>
                        <td class="px-4 py-3 text-right text-[16px] text-[#1F261D]">Rp 2.430.000</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Paginasi Sederhana -->
        <div class="mt-5 flex items-center justify-between border-t border-[#E4E9DA] pt-4">
            <span class="text-[13px] text-[#6B7366]">Halaman 1 dari 4</span>
            <div class="flex items-center gap-1.5">
                <button class="w-9 h-9 rounded-[10px] border border-[#E4E9DA] bg-white text-[#7A8275] flex items-center justify-center cursor-not-allowed opacity-60" disabled type="button">
                    <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                </button>
                <button class="w-9 h-9 rounded-[10px] bg-[#E3F1DC] border border-[#B7D7A8] text-[#1F3318] font-semibold text-[13px] flex items-center justify-center cursor-pointer" type="button">
                    1
                </button>
                <button class="w-9 h-9 rounded-[10px] border border-[#E4E9DA] bg-white text-[#4A5246] hover:bg-[#F8FAF2] text-[13px] font-medium flex items-center justify-center cursor-pointer" type="button">
                    2
                </button>
                <button class="w-9 h-9 rounded-[10px] border border-[#E4E9DA] bg-white text-[#4A5246] hover:bg-[#F8FAF2] text-[13px] font-medium flex items-center justify-center cursor-pointer" type="button">
                    3
                </button>
                <button class="w-9 h-9 rounded-[10px] border border-[#E4E9DA] bg-white text-[#4A5246] hover:bg-[#F8FAF2] text-[13px] font-medium flex items-center justify-center cursor-pointer" type="button">
                    4
                </button>
                <button class="w-9 h-9 rounded-[10px] border border-[#E4E9DA] bg-white text-[#4A5246] hover:bg-[#F8FAF2] flex items-center justify-center cursor-pointer" type="button">
                    <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                </button>
            </div>
        </div>
    </section>
</div>
@endsection
