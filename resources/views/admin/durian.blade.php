@extends('layouts.app')

@section('title', 'Kelola Durian - DuREN')

@section('content')
<div class="space-y-6">
    <!-- 1. KEPALA HALAMAN -->
    <div class="flex items-center justify-between pb-2">
        <div class="flex flex-col">
            <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">Kelola Durian</h1>
            <p class="text-[16px] leading-[22px] text-[#6B7366] mt-1">Atur varian, ukuran, harga, dan stok durian.</p>
        </div>
        <!-- Tombol Tambah Durian -->
        <button class="h-12 px-6 rounded-[14px] bg-[#F2D98A] hover:bg-[#ebd07d] text-[#5C4A12] text-[15px] font-semibold flex items-center space-x-2 transition-all shadow-sm cursor-pointer hover-lift" id="btnOpenDrawer" type="button">
            <span class="material-symbols-outlined text-[20px]">add</span>
            <span>Tambah Durian</span>
        </button>
    </div>

    <!-- 2. KARTU FILTER -->
    <div class="custom-card flex items-center justify-between !py-4">
        <!-- Kotak Pencarian -->
        <div class="relative w-[320px]">
            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[#7A8275] text-[20px]">search</span>
            <input class="w-full h-12 pl-11 pr-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] transition-colors" placeholder="Cari nama varian..." type="text">
        </div>
        <!-- 4 Filter Chips -->
        <div class="flex items-center space-x-2.5">
            <button class="h-9 px-4 rounded-full bg-[#E3F1DC] text-[#1F3318] border border-[#B7D7A8] text-[12px] font-medium transition-colors flex items-center shadow-sm cursor-pointer" type="button">
                Semua
            </button>
            <button class="h-9 px-4 rounded-full bg-[#F8FAF2] text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F1F5E8] text-[12px] font-medium transition-colors flex items-center cursor-pointer" type="button">
                Ready Stock
            </button>
            <button class="h-9 px-4 rounded-full bg-[#F8FAF2] text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F1F5E8] text-[12px] font-medium transition-colors flex items-center cursor-pointer" type="button">
                Pre-Order
            </button>
            <button class="h-9 px-4 rounded-full bg-[#F8FAF2] text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F1F5E8] text-[12px] font-medium transition-colors flex items-center cursor-pointer" type="button">
                Nonaktif
            </button>
        </div>
    </div>

    <!-- 3. KARTU TABEL DURIAN -->
    <div class="custom-card !p-6 flex flex-col">
        <div class="w-full overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="h-11 bg-[#F8FAF2] rounded-[12px]">
                        <th class="px-4 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider rounded-l-[12px]">Varian</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider text-center">Ukuran</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider">Est. Berat</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider">Harga</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider">Stok</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider">Tipe</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider">Status</th>
                        <th class="px-4 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider text-right rounded-r-[12px]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E4E9DA] text-[14px] text-[#1F261D]">
                    <!-- Baris 1: Montong L -->
                    <tr class="h-16 hover:bg-[#F8FAF2] transition-colors">
                        <td class="px-4 py-3 font-semibold text-[#1F261D]">Montong</td>
                        <td class="px-3 py-3 text-center">
                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-[#F8FAF2] border border-[#E4E9DA] font-medium text-[#1F261D] text-[13px]">L</span>
                        </td>
                        <td class="px-3 py-3 text-[#4A5246]">3.200 gr</td>
                        <td class="px-3 py-3 font-medium text-[#1F261D]">Rp 250.000</td>
                        <td class="px-3 py-3 font-semibold text-[#1F261D]">12</td>
                        <td class="px-3 py-3">
                            <x-badge-status type="ready" />
                        </td>
                        <td class="px-3 py-3">
                            <x-badge-status type="active" />
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex items-center space-x-1.5">
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] hover:bg-white text-[#4A5246] hover:text-[#1F261D] flex items-center justify-center transition-colors cursor-pointer" title="Ubah data" type="button" onclick="openDrawer('Montong', 'L', '3200', '250.000', '12', 'ready', '')">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </button>
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] hover:bg-white text-[#4A5246] hover:text-[#1F261D] flex items-center justify-center transition-colors cursor-pointer" title="Nonaktifkan" type="button">
                                    <span class="material-symbols-outlined text-[18px]">visibility_off</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Baris 2: Montong M -->
                    <tr class="h-16 hover:bg-[#F8FAF2] transition-colors">
                        <td class="px-4 py-3 font-semibold text-[#1F261D]">Montong</td>
                        <td class="px-3 py-3 text-center">
                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-[#F8FAF2] border border-[#E4E9DA] font-medium text-[#1F261D] text-[13px]">M</span>
                        </td>
                        <td class="px-3 py-3 text-[#4A5246]">2.400 gr</td>
                        <td class="px-3 py-3 font-medium text-[#1F261D]">Rp 190.000</td>
                        <td class="px-3 py-3 font-semibold text-[#1F261D]">20</td>
                        <td class="px-3 py-3">
                            <x-badge-status type="ready" />
                        </td>
                        <td class="px-3 py-3">
                            <x-badge-status type="active" />
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex items-center space-x-1.5">
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] hover:bg-white text-[#4A5246] hover:text-[#1F261D] flex items-center justify-center transition-colors cursor-pointer" title="Ubah data" type="button" onclick="openDrawer('Montong', 'M', '2400', '190.000', '20', 'ready', '')">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </button>
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] hover:bg-white text-[#4A5246] hover:text-[#1F261D] flex items-center justify-center transition-colors cursor-pointer" title="Nonaktifkan" type="button">
                                    <span class="material-symbols-outlined text-[18px]">visibility_off</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Baris 3: Musang King M (Menipis) -->
                    <tr class="h-16 hover:bg-[#F8FAF2] transition-colors">
                        <td class="px-4 py-3 font-semibold text-[#1F261D]">Musang King</td>
                        <td class="px-3 py-3 text-center">
                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-[#F8FAF2] border border-[#E4E9DA] font-medium text-[#1F261D] text-[13px]">M</span>
                        </td>
                        <td class="px-3 py-3 text-[#4A5246]">1.800 gr</td>
                        <td class="px-3 py-3 font-medium text-[#1F261D]">Rp 420.000</td>
                        <td class="px-3 py-3">
                            <div class="flex items-center space-x-2">
                                <span class="font-semibold text-[#1F261D]">4</span>
                                <x-badge-status type="menipis" />
                            </div>
                        </td>
                        <td class="px-3 py-3">
                            <x-badge-status type="ready" />
                        </td>
                        <td class="px-3 py-3">
                            <x-badge-status type="active" />
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex items-center space-x-1.5">
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] hover:bg-white text-[#4A5246] hover:text-[#1F261D] flex items-center justify-center transition-colors cursor-pointer" title="Ubah data" type="button" onclick="openDrawer('Musang King', 'M', '1800', '420.000', '4', 'ready', '')">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </button>
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] hover:bg-white text-[#4A5246] hover:text-[#1F261D] flex items-center justify-center transition-colors cursor-pointer" title="Nonaktifkan" type="button">
                                    <span class="material-symbols-outlined text-[18px]">visibility_off</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Baris 4: Musang King S (Habis) -->
                    <tr class="h-16 hover:bg-[#F8FAF2] transition-colors">
                        <td class="px-4 py-3 font-semibold text-[#1F261D]">Musang King</td>
                        <td class="px-3 py-3 text-center">
                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-[#F8FAF2] border border-[#E4E9DA] font-medium text-[#1F261D] text-[13px]">S</span>
                        </td>
                        <td class="px-3 py-3 text-[#4A5246]">1.200 gr</td>
                        <td class="px-3 py-3 font-medium text-[#1F261D]">Rp 310.000</td>
                        <td class="px-3 py-3">
                            <div class="flex items-center space-x-2">
                                <span class="font-semibold text-[#BA1A1A]">0</span>
                                <x-badge-status type="habis" />
                            </div>
                        </td>
                        <td class="px-3 py-3">
                            <x-badge-status type="ready" />
                        </td>
                        <td class="px-3 py-3">
                            <x-badge-status type="active" />
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex items-center space-x-1.5">
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] hover:bg-white text-[#4A5246] hover:text-[#1F261D] flex items-center justify-center transition-colors cursor-pointer" title="Ubah data" type="button" onclick="openDrawer('Musang King', 'S', '1200', '310.000', '0', 'ready', '')">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </button>
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] hover:bg-white text-[#4A5246] hover:text-[#1F261D] flex items-center justify-center transition-colors cursor-pointer" title="Nonaktifkan" type="button">
                                    <span class="material-symbols-outlined text-[18px]">visibility_off</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Baris 5: Black Thorn L (Pre-Order) -->
                    <tr class="h-16 hover:bg-[#F8FAF2] transition-colors">
                        <td class="px-4 py-3 font-semibold text-[#1F261D]">Black Thorn</td>
                        <td class="px-3 py-3 text-center">
                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-[#F8FAF2] border border-[#E4E9DA] font-medium text-[#1F261D] text-[13px]">L</span>
                        </td>
                        <td class="px-3 py-3 text-[#4A5246]">2.800 gr</td>
                        <td class="px-3 py-3 font-medium text-[#1F261D]">Rp 580.000</td>
                        <td class="px-3 py-3 font-semibold text-[#1F261D]">15</td>
                        <td class="px-3 py-3">
                            <x-badge-status type="preorder" />
                        </td>
                        <td class="px-3 py-3">
                            <x-badge-status type="active" />
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex items-center space-x-1.5">
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] hover:bg-white text-[#4A5246] hover:text-[#1F261D] flex items-center justify-center transition-colors cursor-pointer" title="Ubah data" type="button" onclick="openDrawer('Black Thorn', 'L', '2800', '580.000', '15', 'preorder', 'Panen akhir bulan')">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </button>
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] hover:bg-white text-[#4A5246] hover:text-[#1F261D] flex items-center justify-center transition-colors cursor-pointer" title="Nonaktifkan" type="button">
                                    <span class="material-symbols-outlined text-[18px]">visibility_off</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Baris 6: Bawor L (Nonaktif) -->
                    <tr class="h-16 hover:bg-[#F8FAF2] transition-colors opacity-75">
                        <td class="px-4 py-3 font-semibold text-[#6B7366]">Bawor</td>
                        <td class="px-3 py-3 text-center">
                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-[#F8FAF2] border border-[#E4E9DA] font-medium text-[#6B7366] text-[13px]">L</span>
                        </td>
                        <td class="px-3 py-3 text-[#7A8275]">3.500 gr</td>
                        <td class="px-3 py-3 font-medium text-[#6B7366]">Rp 230.000</td>
                        <td class="px-3 py-3 font-semibold text-[#7A8275]">0</td>
                        <td class="px-3 py-3">
                            <x-badge-status type="ready" />
                        </td>
                        <td class="px-3 py-3">
                            <x-badge-status type="inactive" />
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex items-center space-x-1.5">
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] hover:bg-white text-[#4A5246] hover:text-[#1F261D] flex items-center justify-center transition-colors cursor-pointer" title="Ubah data" type="button" onclick="openDrawer('Bawor', 'L', '3500', '230.000', '0', 'ready', '')">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </button>
                                <button class="w-9 h-9 rounded-[12px] bg-[#E3F1DC] border border-[#B7D7A8] hover:bg-[#cfe6c5] text-[#1F3318] flex items-center justify-center transition-colors cursor-pointer" title="Aktifkan kembali" type="button">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ==================== DRAWER PANEL TAMBAH/UBAH DURIAN ==================== -->
<!-- Backdrop -->
<div class="fixed inset-0 bg-black/30 backdrop-blur-xs z-50 transition-opacity duration-300 opacity-0 pointer-events-none" id="drawerBackdrop" onclick="closeDrawer()"></div>

<!-- Slide-over Container -->
<div class="fixed inset-y-0 right-0 max-w-full flex z-50 pointer-events-none">
    <div class="w-screen max-w-[480px] bg-white border-l border-[#E4E9DA] shadow-2xl flex flex-col justify-between transform translate-x-full transition-transform duration-300 ease-in-out pointer-events-auto" id="drawerPanel">
        <!-- Header Drawer -->
        <div class="p-6 border-b border-[#E4E9DA] flex items-center justify-between">
            <div>
                <h2 class="text-[20px] font-semibold text-[#1F261D]" id="drawerTitle">Tambah Durian</h2>
                <p class="text-[13px] text-[#6B7366] mt-0.5">Isi data varian durian baru.</p>
            </div>
            <button class="w-9 h-9 rounded-full bg-[#F8FAF2] hover:bg-[#F1F5E8] text-[#4A5246] hover:text-[#1F261D] flex items-center justify-center transition-colors cursor-pointer" id="btnCloseDrawer" onclick="closeDrawer()" type="button">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <!-- Body Drawer / Form -->
        <div class="p-6 overflow-y-auto flex-1 space-y-4">
            <form id="durianForm" class="space-y-4" onsubmit="event.preventDefault();">
                <!-- 1. Nama Varian -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-1.5">Nama Varian</label>
                    <input class="w-full h-12 px-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] focus:outline-none focus:border-[#B7D7A8] transition-colors" id="inputName" placeholder="Contoh: Montong, Musang King" type="text" value="Musang King">
                </div>

                <!-- 2. Ukuran -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-1.5">Ukuran</label>
                    <div class="grid grid-cols-3 gap-2.5" id="sizeOptions">
                        <button class="h-11 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] text-[#4A5246] text-[14px] font-medium hover:bg-[#F1F5E8] transition-colors flex items-center justify-center cursor-pointer size-btn" type="button" onclick="selectSize('S')">
                            S
                        </button>
                        <button class="h-11 rounded-[12px] bg-[#E3F1DC] border border-[#B7D7A8] text-[#1F3318] text-[14px] font-semibold flex items-center justify-center cursor-pointer size-btn" type="button" onclick="selectSize('M')">
                            M
                        </button>
                        <button class="h-11 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] text-[#4A5246] text-[14px] font-medium hover:bg-[#F1F5E8] transition-colors flex items-center justify-center cursor-pointer size-btn" type="button" onclick="selectSize('L')">
                            L
                        </button>
                    </div>
                </div>

                <!-- 3. Estimasi Berat -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-1.5">Estimasi berat</label>
                    <div class="relative">
                        <input class="w-full h-12 pl-4 pr-16 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] focus:outline-none focus:border-[#B7D7A8] transition-colors" id="inputWeight" type="number" value="1800">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[12px] text-[#6B7366]">gram</span>
                    </div>
                </div>

                <!-- 4. Harga -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-1.5">Harga</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[13px] text-[#6B7366] font-medium">Rp</span>
                        <input class="w-full h-12 pl-11 pr-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] focus:outline-none focus:border-[#B7D7A8] transition-colors" id="inputPrice" type="text" value="420.000">
                    </div>
                </div>

                <!-- 5. Stok -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-1.5">Stok</label>
                    <input class="w-full h-12 px-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] focus:outline-none focus:border-[#B7D7A8] transition-colors" id="inputStock" type="number" value="10">
                    <p class="text-[12px] text-[#6B7366] mt-1.5">Untuk Pre-Order, stok berfungsi sebagai kuota pesanan.</p>
                </div>

                <!-- 6. Tipe -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-1.5">Tipe</label>
                    <div class="grid grid-cols-2 gap-2.5">
                        <button class="h-11 rounded-[12px] bg-[#E3F1DC] border border-[#B7D7A8] text-[#1F3318] text-[13px] font-semibold flex items-center justify-center space-x-1.5 cursor-pointer type-btn" id="btnTypeReady" type="button" onclick="selectType('ready')">
                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                            <span>Ready Stock</span>
                        </button>
                        <button class="h-11 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] text-[#4A5246] text-[13px] font-medium hover:bg-[#F1F5E8] transition-colors flex items-center justify-center cursor-pointer type-btn" id="btnTypePreorder" type="button" onclick="selectType('preorder')">
                            <span>Pre-Order</span>
                        </button>
                    </div>
                </div>

                <!-- 7. Estimasi Tiba (Pre-Order) -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-[14px] font-medium text-[#1F261D]">Estimasi tiba</label>
                        <span class="px-2 py-0.5 rounded-full bg-[#F8FAF2] border border-[#E4E9DA] text-[11px] text-[#7A8275] font-medium">Hanya untuk Pre-Order</span>
                    </div>
                    <input class="w-full h-12 px-4 rounded-[12px] border border-[#E4E9DA] bg-[#F8FAF2] text-[#1F261D] text-[14px] focus:outline-none focus:border-[#B7D7A8] transition-colors" id="inputEta" placeholder="Contoh: panen akhir Oktober" type="text" disabled>
                </div>

                <!-- 8. Sakelar Status Durian -->
                <div class="pt-2 flex items-center justify-between">
                    <div>
                        <span class="block text-[14px] font-medium text-[#1F261D]">Status Durian</span>
                        <span class="text-[12px] text-[#6B7366]">Tampilkan varian ke pembeli</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-[12px] font-semibold text-[#3F5B34]" id="switchStatusLabel">Aktif</span>
                        <button class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-[#B7D7A8] transition-colors duration-200 ease-in-out focus:outline-none" id="btnToggleActive" onclick="toggleActiveStatus()" type="button">
                            <span class="translate-x-5 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-[#1F3318] shadow ring-0 transition duration-200 ease-in-out" id="switchKnob"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Footer Drawer -->
        <div class="p-6 border-t border-[#E4E9DA] flex items-center gap-3">
            <button class="flex-1 h-12 rounded-[14px] border border-[#E4E9DA] bg-white hover:bg-[#F8FAF2] text-[#4A5246] text-[14px] font-medium transition-colors cursor-pointer" onclick="closeDrawer()" type="button">
                Batal
            </button>
            <button class="flex-1 h-12 rounded-[14px] bg-[#F2D98A] text-[#5C4A12] hover:bg-[#ebd07d] text-[14px] font-semibold shadow-sm transition-colors cursor-pointer" onclick="closeDrawer()" type="button">
                Simpan
            </button>
        </div>
    </div>
</div>

<script>
    const drawerPanel = document.getElementById('drawerPanel');
    const drawerBackdrop = document.getElementById('drawerBackdrop');
    const btnOpen = document.getElementById('btnOpenDrawer');

    let currentActive = true;

    function openDrawer(name = '', size = 'M', weight = '1800', price = '250.000', stock = '10', type = 'ready', eta = '') {
        if (!drawerPanel || !drawerBackdrop) return;
        
        document.getElementById('drawerTitle').textContent = name ? 'Ubah Durian' : 'Tambah Durian';
        document.getElementById('inputName').value = name || '';
        document.getElementById('inputWeight').value = weight || '1800';
        document.getElementById('inputPrice').value = price || '250.000';
        document.getElementById('inputStock').value = stock || '10';
        document.getElementById('inputEta').value = eta || '';
        
        selectSize(size);
        selectType(type);

        drawerPanel.classList.remove('translate-x-full');
        drawerBackdrop.classList.remove('opacity-0', 'pointer-events-none');
    }

    function closeDrawer() {
        if (!drawerPanel || !drawerBackdrop) return;
        drawerPanel.classList.add('translate-x-full');
        drawerBackdrop.classList.add('opacity-0', 'pointer-events-none');
    }

    btnOpen.addEventListener('click', () => openDrawer());

    function selectSize(size) {
        const buttons = document.querySelectorAll('#sizeOptions button');
        buttons.forEach(btn => {
            if (btn.textContent.trim() === size) {
                btn.className = 'h-11 rounded-[12px] bg-[#E3F1DC] border border-[#B7D7A8] text-[#1F3318] text-[14px] font-semibold flex items-center justify-center cursor-pointer size-btn';
            } else {
                btn.className = 'h-11 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] text-[#4A5246] text-[14px] font-medium hover:bg-[#F1F5E8] transition-colors flex items-center justify-center cursor-pointer size-btn';
            }
        });
    }

    function selectType(type) {
        const btnReady = document.getElementById('btnTypeReady');
        const btnPreorder = document.getElementById('btnTypePreorder');
        const inputEta = document.getElementById('inputEta');

        if (type === 'ready') {
            btnReady.className = 'h-11 rounded-[12px] bg-[#E3F1DC] border border-[#B7D7A8] text-[#1F3318] text-[13px] font-semibold flex items-center justify-center space-x-1.5 cursor-pointer type-btn';
            btnPreorder.className = 'h-11 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] text-[#4A5246] text-[13px] font-medium hover:bg-[#F1F5E8] transition-colors flex items-center justify-center cursor-pointer type-btn';
            inputEta.disabled = true;
            inputEta.classList.add('bg-[#F8FAF2]', 'opacity-60');
        } else {
            btnPreorder.className = 'h-11 rounded-[12px] bg-[#E3F1DC] border border-[#B7D7A8] text-[#1F3318] text-[13px] font-semibold flex items-center justify-center space-x-1.5 cursor-pointer type-btn';
            btnReady.className = 'h-11 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] text-[#4A5246] text-[13px] font-medium hover:bg-[#F1F5E8] transition-colors flex items-center justify-center cursor-pointer type-btn';
            inputEta.disabled = false;
            inputEta.classList.remove('bg-[#F8FAF2]', 'opacity-60');
        }
    }

    function toggleActiveStatus() {
        currentActive = !currentActive;
        const knob = document.getElementById('switchKnob');
        const btn = document.getElementById('btnToggleActive');
        const label = document.getElementById('switchStatusLabel');

        if (currentActive) {
            knob.className = 'translate-x-5 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-[#1F3318] shadow ring-0 transition duration-200 ease-in-out';
            btn.className = 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-[#B7D7A8] transition-colors duration-200 ease-in-out focus:outline-none';
            label.textContent = 'Aktif';
            label.className = 'text-[12px] font-semibold text-[#3F5B34]';
        } else {
            knob.className = 'translate-x-0 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-[#7A8275] shadow ring-0 transition duration-200 ease-in-out';
            btn.className = 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-[#E4E9DA] transition-colors duration-200 ease-in-out focus:outline-none';
            label.textContent = 'Nonaktif';
            label.className = 'text-[12px] font-semibold text-[#7A8275]';
        }
    }
</script>
@endsection
