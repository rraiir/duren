@extends('layouts.app')

@section('title', 'Kelola Pembeli - DuREN')

@section('content')
<div class="space-y-6">
    <!-- 1. KEPALA HALAMAN -->
    <div class="flex items-center justify-between pb-2">
        <div class="flex flex-col">
            <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">Kelola Pembeli</h1>
            <p class="text-[16px] leading-[22px] text-[#6B7366] mt-1">Lihat akun pembeli, ubah data, dan reset password.</p>
        </div>
    </div>

    <!-- 2. KARTU FILTER & PENCARIAN -->
    <div class="rounded-[20px] border border-[#E4E9DA] bg-white shadow-[0_8px_24px_rgba(40,52,30,0.06)] px-6 py-5 flex items-center justify-between gap-6">
        <!-- Kotak Pencarian -->
        <div class="relative w-[320px]">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#7A8275] text-[20px]">search</span>
            <input class="w-full h-12 pl-11 pr-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] transition-colors" id="buyer-search-input" placeholder="Cari nama atau nomor WhatsApp" type="text">
        </div>
        <!-- Status Filter Chips -->
        <div class="flex items-center gap-2" id="buyer-filter-chips">
            <button class="buyer-chip-btn h-10 px-5 rounded-full text-[14px] font-semibold bg-[#E8F3E1] text-[#1F3318] border border-[#CFE6C5] transition-colors cursor-pointer" data-filter="all" type="button">
                Semua
            </button>
            <button class="buyer-chip-btn h-10 px-5 rounded-full text-[14px] font-medium bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2] transition-colors cursor-pointer" data-filter="aktif" type="button">
                Aktif
            </button>
            <button class="buyer-chip-btn h-10 px-5 rounded-full text-[14px] font-medium bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2] transition-colors cursor-pointer" data-filter="nonaktif" type="button">
                Nonaktif
            </button>
        </div>
    </div>

    <!-- 3. KARTU TABEL PEMBELI -->
    <div class="rounded-[20px] border border-[#E4E9DA] bg-white shadow-[0_8px_24px_rgba(40,52,30,0.06)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="h-12 bg-[#F8FAF2] border-b border-[#E4E9DA] text-[14px] font-semibold text-[#6B7366]">
                        <th class="py-3 px-6 font-medium">Pembeli</th>
                        <th class="py-3 px-6 font-medium">Nomor WhatsApp</th>
                        <th class="py-3 px-6 font-medium">Alamat</th>
                        <th class="py-3 px-6 font-medium text-center">Pesanan</th>
                        <th class="py-3 px-6 font-medium text-center">Status</th>
                        <th class="py-3 px-6 font-medium">Terdaftar</th>
                        <th class="py-3 px-6 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E4E9DA]" id="buyer-table-body">
                    <!-- Row 1: Rina -->
                    <tr class="buyer-row h-16 hover:bg-[#F8FAF2] transition-colors" data-status="aktif" data-name="Rina" data-phone="0812-3456-7890">
                        <td class="py-3 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#CFE6C5] flex items-center justify-center text-[14px] font-semibold text-[#1F3318] shrink-0">
                                    R
                                </div>
                                <span class="text-[14px] font-semibold text-[#1F261D]">Rina</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-[14px] text-[#1F261D] font-medium font-mono">0812-3456-7890</td>
                        <td class="py-3 px-6">
                            <span class="block max-w-[220px] text-[14px] text-[#4A5246] truncate" title="Jl. Melati No. 18, Jakarta Selatan">
                                Jl. Melati No. 18, Jakarta Selatan
                            </span>
                        </td>
                        <td class="py-3 px-6 text-center text-[14px] font-semibold text-[#1F261D]">3</td>
                        <td class="py-3 px-6 text-center">
                            <x-badge-status type="aktif" />
                        </td>
                        <td class="py-3 px-6 text-[14px] text-[#6B7366]">12 Okt 2026</td>
                        <td class="py-3 px-6 text-right">
                            <div class="inline-flex items-center gap-1.5 justify-end">
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] hover:bg-white text-[#1F261D] border border-[#E4E9DA] flex items-center justify-center transition-all cursor-pointer" onclick="openBuyerDrawer('Rina', '0812-3456-7890', 'Jl. Melati No. 18, Jakarta Selatan', true)" title="Ubah Pembeli" type="button">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </button>
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] hover:bg-white text-[#5C4A12] border border-[#E4E9DA] flex items-center justify-center transition-all cursor-pointer" onclick="openResetModal('Rina', '0812-3456-7890')" title="Reset Password" type="button">
                                    <span class="material-symbols-outlined text-[18px]">vpn_key</span>
                                </button>
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] hover:bg-white text-[#BA1A1A] border border-[#E4E9DA] flex items-center justify-center transition-all cursor-pointer" title="Blokir Akun" type="button">
                                    <span class="material-symbols-outlined text-[18px]">block</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2: Budi -->
                    <tr class="buyer-row h-16 hover:bg-[#F8FAF2] transition-colors" data-status="aktif" data-name="Budi" data-phone="0813-1111-2222">
                        <td class="py-3 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#F2D98A] flex items-center justify-center text-[14px] font-semibold text-[#5C4A12] shrink-0">
                                    B
                                </div>
                                <span class="text-[14px] font-semibold text-[#1F261D]">Budi</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-[14px] text-[#1F261D] font-medium font-mono">0813-1111-2222</td>
                        <td class="py-3 px-6">
                            <span class="block max-w-[220px] text-[14px] text-[#4A5246] truncate" title="Jl. Kenanga No. 5, Bandung">
                                Jl. Kenanga No. 5, Bandung
                            </span>
                        </td>
                        <td class="py-3 px-6 text-center text-[14px] font-semibold text-[#1F261D]">1</td>
                        <td class="py-3 px-6 text-center">
                            <x-badge-status type="aktif" />
                        </td>
                        <td class="py-3 px-6 text-[14px] text-[#6B7366]">14 Okt 2026</td>
                        <td class="py-3 px-6 text-right">
                            <div class="inline-flex items-center gap-1.5 justify-end">
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] hover:bg-white text-[#1F261D] border border-[#E4E9DA] flex items-center justify-center transition-all cursor-pointer" onclick="openBuyerDrawer('Budi', '0813-1111-2222', 'Jl. Kenanga No. 5, Bandung', true)" title="Ubah Pembeli" type="button">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </button>
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] hover:bg-white text-[#5C4A12] border border-[#E4E9DA] flex items-center justify-center transition-all cursor-pointer" onclick="openResetModal('Budi', '0813-1111-2222')" title="Reset Password" type="button">
                                    <span class="material-symbols-outlined text-[18px]">vpn_key</span>
                                </button>
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] hover:bg-white text-[#BA1A1A] border border-[#E4E9DA] flex items-center justify-center transition-all cursor-pointer" title="Blokir Akun" type="button">
                                    <span class="material-symbols-outlined text-[18px]">block</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3: Sari -->
                    <tr class="buyer-row h-16 hover:bg-[#F8FAF2] transition-colors" data-status="aktif" data-name="Sari" data-phone="0857-4444-5555">
                        <td class="py-3 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#CFE6C5] flex items-center justify-center text-[14px] font-semibold text-[#1F3318] shrink-0">
                                    S
                                </div>
                                <span class="text-[14px] font-semibold text-[#1F261D]">Sari</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-[14px] text-[#1F261D] font-medium font-mono">0857-4444-5555</td>
                        <td class="py-3 px-6">
                            <span class="block max-w-[220px] text-[14px] text-[#4A5246] truncate" title="Jl. Mawar No. 2, Surabaya">
                                Jl. Mawar No. 2, Surabaya
                            </span>
                        </td>
                        <td class="py-3 px-6 text-center text-[14px] font-semibold text-[#1F261D]">2</td>
                        <td class="py-3 px-6 text-center">
                            <x-badge-status type="aktif" />
                        </td>
                        <td class="py-3 px-6 text-[14px] text-[#6B7366]">15 Okt 2026</td>
                        <td class="py-3 px-6 text-right">
                            <div class="inline-flex items-center gap-1.5 justify-end">
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] hover:bg-white text-[#1F261D] border border-[#E4E9DA] flex items-center justify-center transition-all cursor-pointer" onclick="openBuyerDrawer('Sari', '0857-4444-5555', 'Jl. Mawar No. 2, Surabaya', true)" title="Ubah Pembeli" type="button">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </button>
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] hover:bg-white text-[#5C4A12] border border-[#E4E9DA] flex items-center justify-center transition-all cursor-pointer" onclick="openResetModal('Sari', '0857-4444-5555')" title="Reset Password" type="button">
                                    <span class="material-symbols-outlined text-[18px]">vpn_key</span>
                                </button>
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] hover:bg-white text-[#BA1A1A] border border-[#E4E9DA] flex items-center justify-center transition-all cursor-pointer" title="Blokir Akun" type="button">
                                    <span class="material-symbols-outlined text-[18px]">block</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 4: Andi -->
                    <tr class="buyer-row h-16 hover:bg-[#F8FAF2] transition-colors" data-status="nonaktif" data-name="Andi" data-phone="0821-9999-0000">
                        <td class="py-3 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#F2D98A] flex items-center justify-center text-[14px] font-semibold text-[#5C4A12] shrink-0">
                                    A
                                </div>
                                <span class="text-[14px] font-semibold text-[#1F261D]">Andi</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-[14px] text-[#1F261D] font-medium font-mono">0821-9999-0000</td>
                        <td class="py-3 px-6">
                            <span class="block max-w-[220px] text-[14px] text-[#4A5246] truncate" title="Jl. Anggrek No. 9, Semarang">
                                Jl. Anggrek No. 9, Semarang
                            </span>
                        </td>
                        <td class="py-3 px-6 text-center text-[14px] font-semibold text-[#1F261D]">0</td>
                        <td class="py-3 px-6 text-center">
                            <x-badge-status type="nonaktif" />
                        </td>
                        <td class="py-3 px-6 text-[14px] text-[#6B7366]">16 Okt 2026</td>
                        <td class="py-3 px-6 text-right">
                            <div class="inline-flex items-center gap-1.5 justify-end">
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] hover:bg-white text-[#1F261D] border border-[#E4E9DA] flex items-center justify-center transition-all cursor-pointer" onclick="openBuyerDrawer('Andi', '0821-9999-0000', 'Jl. Anggrek No. 9, Semarang', false)" title="Ubah Pembeli" type="button">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </button>
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] hover:bg-white text-[#5C4A12] border border-[#E4E9DA] flex items-center justify-center transition-all cursor-pointer" onclick="openResetModal('Andi', '0821-9999-0000')" title="Reset Password" type="button">
                                    <span class="material-symbols-outlined text-[18px]">vpn_key</span>
                                </button>
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] hover:bg-white text-[#4E6B43] border border-[#E4E9DA] flex items-center justify-center transition-all cursor-pointer" title="Aktifkan Akun" type="button">
                                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 5: Dewi -->
                    <tr class="buyer-row h-16 hover:bg-[#F8FAF2] transition-colors" data-status="aktif" data-name="Dewi" data-phone="0878-1212-3434">
                        <td class="py-3 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#CFE6C5] flex items-center justify-center text-[14px] font-semibold text-[#1F3318] shrink-0">
                                    D
                                </div>
                                <span class="text-[14px] font-semibold text-[#1F261D]">Dewi</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-[14px] text-[#1F261D] font-medium font-mono">0878-1212-3434</td>
                        <td class="py-3 px-6">
                            <span class="block max-w-[220px] text-[14px] text-[#4A5246] truncate" title="Jl. Dahlia No. 7, Yogyakarta">
                                Jl. Dahlia No. 7, Yogyakarta
                            </span>
                        </td>
                        <td class="py-3 px-6 text-center text-[14px] font-semibold text-[#1F261D]">1</td>
                        <td class="py-3 px-6 text-center">
                            <x-badge-status type="aktif" />
                        </td>
                        <td class="py-3 px-6 text-[14px] text-[#6B7366]">18 Okt 2026</td>
                        <td class="py-3 px-6 text-right">
                            <div class="inline-flex items-center gap-1.5 justify-end">
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] hover:bg-white text-[#1F261D] border border-[#E4E9DA] flex items-center justify-center transition-all cursor-pointer" onclick="openBuyerDrawer('Dewi', '0878-1212-3434', 'Jl. Dahlia No. 7, Yogyakarta', true)" title="Ubah Pembeli" type="button">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </button>
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] hover:bg-white text-[#5C4A12] border border-[#E4E9DA] flex items-center justify-center transition-all cursor-pointer" onclick="openResetModal('Dewi', '0878-1212-3434')" title="Reset Password" type="button">
                                    <span class="material-symbols-outlined text-[18px]">vpn_key</span>
                                </button>
                                <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] hover:bg-white text-[#BA1A1A] border border-[#E4E9DA] flex items-center justify-center transition-all cursor-pointer" title="Blokir Akun" type="button">
                                    <span class="material-symbols-outlined text-[18px]">block</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Table Pagination Footer -->
        <div class="py-4 px-6 flex items-center justify-between bg-white border-t border-[#E4E9DA]">
            <span class="text-[14px] text-[#6B7366]">Menampilkan 1–5 dari 12</span>
            <div class="flex items-center gap-1.5">
                <button class="w-9 h-9 rounded-full bg-[#F8FAF2] hover:bg-[#E8E8E8] text-[#4A5246] flex items-center justify-center transition-colors" type="button">
                    <span class="material-symbols-outlined text-[20px]">chevron_left</span>
                </button>
                <button class="w-9 h-9 rounded-full bg-[#E8F3E1] text-[#1F3318] text-[14px] font-semibold border border-[#CFE6C5] flex items-center justify-center" type="button">
                    1
                </button>
                <button class="w-9 h-9 rounded-full hover:bg-[#F8FAF2] text-[#4A5246] text-[14px] font-medium flex items-center justify-center transition-colors" type="button">
                    2
                </button>
                <button class="w-9 h-9 rounded-full hover:bg-[#F8FAF2] text-[#4A5246] text-[14px] font-medium flex items-center justify-center transition-colors" type="button">
                    3
                </button>
                <button class="w-9 h-9 rounded-full bg-[#F8FAF2] hover:bg-[#E8E8E8] text-[#4A5246] flex items-center justify-center transition-colors" type="button">
                    <span class="material-symbols-outlined text-[20px]">chevron_right</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal / Drawer Side Panel "Ubah Pembeli" (420px wide) -->
<div class="fixed inset-0 z-50 flex justify-end hidden" id="drawer-container">
    <!-- Backdrop Overlay -->
    <div class="absolute inset-0 bg-[#1F261D]/25 backdrop-blur-[2px] transition-opacity duration-300" onclick="closeBuyerDrawer()"></div>

    <!-- Right Drawer Surface -->
    <div class="relative w-[420px] h-full bg-white shadow-[-8px_0_32px_rgba(40,52,30,0.12)] border-l border-[#E4E9DA] p-6 sm:p-8 flex flex-col justify-between overflow-y-auto z-10">
        <div class="flex flex-col">
            <!-- Drawer Header -->
            <div class="flex items-center justify-between pb-6 mb-6 border-b border-[#E4E9DA]">
                <h2 class="text-[20px] font-semibold text-[#1F261D]">Ubah Pembeli</h2>
                <button class="w-8 h-8 rounded-[10px] hover:bg-[#F8FAF2] text-[#4A5246] flex items-center justify-center transition-colors cursor-pointer" onclick="closeBuyerDrawer()" type="button">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>

            <!-- Drawer Form Elements -->
            <div class="flex flex-col gap-5">
                <!-- Field: Nama -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-[14px] font-medium text-[#1F261D]" for="edit-name">Nama</label>
                    <input class="w-full h-12 px-4 rounded-[12px] bg-white text-[14px] text-[#1F261D] border border-[#E4E9DA] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] transition-all" id="edit-name" type="text" value="Rina">
                </div>

                <!-- Field: Nomor WhatsApp -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-[14px] font-medium text-[#1F261D]" for="edit-phone">Nomor WhatsApp</label>
                    <input class="w-full h-12 px-4 rounded-[12px] bg-white text-[14px] text-[#1F261D] border border-[#E4E9DA] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] transition-all" id="edit-phone" type="text" value="0812-3456-7890">
                </div>

                <!-- Field: Alamat -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-[14px] font-medium text-[#1F261D]" for="edit-address">Alamat</label>
                    <textarea class="w-full p-4 rounded-[12px] bg-white text-[14px] text-[#1F261D] border border-[#E4E9DA] placeholder-[#7A8275] resize-none focus:outline-none focus:border-[#B7D7A8] transition-all leading-relaxed" id="edit-address" rows="3">Jl. Melati No. 18, Jakarta Selatan</textarea>
                </div>

                <!-- Toggle: Akun Aktif -->
                <div class="pt-2 flex flex-col gap-1.5">
                    <div class="flex items-center justify-between">
                        <span class="text-[14px] font-medium text-[#1F261D]">Akun aktif</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input checked="" class="sr-only peer" id="edit-status" type="checkbox">
                            <div class="w-11 h-6 bg-[#E2E2E2] rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-[#E4E9DA] after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#4E6B43]"></div>
                        </label>
                    </div>
                    <p class="text-[12px] text-[#6B7366]">
                        Akun nonaktif tidak bisa masuk. Riwayat pesanan tetap tersimpan.
                    </p>
                </div>

                <!-- Reset Password Action Button -->
                <div class="pt-3 pb-2 flex flex-col gap-2">
                    <button class="w-full h-11 px-4 rounded-[14px] bg-white hover:bg-[#F8FAF2] text-[#1F261D] text-[14px] font-semibold border border-[#E4E9DA] flex items-center justify-center gap-2 transition-colors cursor-pointer" type="button" onclick="triggerResetFromDrawer()">
                        <span class="material-symbols-outlined text-[#7A6420] text-[20px]">vpn_key</span>
                        <span>Reset Password</span>
                    </button>
                    <p class="text-[12px] text-[#6B7366]">
                        Admin menyetel password baru lalu mengirimkannya lewat WhatsApp.
                    </p>
                </div>
            </div>
        </div>

        <!-- Action Footer Buttons -->
        <div class="flex items-center gap-3 pt-6 mt-6 border-t border-[#E4E9DA]">
            <button class="h-12 px-6 rounded-[14px] bg-white hover:bg-[#F8FAF2] text-[#1F261D] text-[14px] font-medium border border-[#E4E9DA] transition-colors cursor-pointer" onclick="closeBuyerDrawer()" type="button">
                Batal
            </button>
            <button class="flex-1 h-12 px-6 rounded-[14px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[#1F261D] text-[14px] font-semibold flex items-center justify-center transition-colors shadow-sm cursor-pointer" onclick="closeBuyerDrawer()" type="button">
                Simpan
            </button>
        </div>
    </div>
</div>

<!-- Modal Reset Password -->
<div id="reset-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black/40 backdrop-blur-[2px]">
    <div class="bg-white rounded-[20px] border border-[#E4E9DA] p-6 max-w-md w-full mx-4 shadow-xl">
        <div class="flex items-center justify-between pb-3 border-b border-[#E4E9DA]">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-[#7A6420]">vpn_key</span>
                <h3 class="text-[18px] font-bold text-[#1F261D]">Reset Password Pembeli</h3>
            </div>
            <button onclick="closeResetModal()" class="w-8 h-8 rounded-[8px] hover:bg-[#F8FAF2] flex items-center justify-center text-[#4A5246] cursor-pointer">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
        <div class="py-4 space-y-4">
            <p class="text-[14px] text-[#4A5246]">
                Setel password sementara baru untuk akun pembeli <strong id="modal-buyer-name" class="text-[#1F261D]"></strong> (<span id="modal-buyer-phone" class="font-mono text-[13px]"></span>).
            </p>
            <div class="space-y-1.5">
                <label class="text-[13px] font-medium text-[#1F261D]">Password Baru Sementara</label>
                <input type="text" id="modal-new-password" value="duren12345" class="w-full h-11 px-3 rounded-[12px] border border-[#E4E9DA] bg-[#F8FAF2] text-[#1F261D] text-[14px] font-mono focus:outline-none focus:border-[#B7D7A8]">
            </div>
            <p class="text-[12px] text-[#6B7366]">
                Salin dan kirimkan password baru ini secara manual kepada pembeli melalui nomor WhatsApp terdaftar.
            </p>
        </div>
        <div class="flex items-center justify-end gap-3 pt-3 border-t border-[#E4E9DA]">
            <button onclick="closeResetModal()" class="h-10 px-4 rounded-[12px] border border-[#E4E9DA] text-[13px] font-medium hover:bg-[#F8FAF2] transition-colors cursor-pointer">
                Batal
            </button>
            <button onclick="sendViaWhatsApp()" class="h-10 px-5 rounded-[12px] bg-[#E8F3E1] hover:bg-[#D9E7D2] text-[#1F3318] text-[13px] font-semibold flex items-center gap-1.5 transition-colors cursor-pointer">
                <span class="material-symbols-outlined text-[16px] text-[#4E6B43]">send</span>
                <span>Kirim via WhatsApp</span>
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openBuyerDrawer(name, phone, address, isActive) {
        const drawer = document.getElementById('drawer-container');
        const nameInput = document.getElementById('edit-name');
        const phoneInput = document.getElementById('edit-phone');
        const addressInput = document.getElementById('edit-address');
        const statusCheckbox = document.getElementById('edit-status');

        if (nameInput) nameInput.value = name;
        if (phoneInput) phoneInput.value = phone;
        if (addressInput) addressInput.value = address;
        if (statusCheckbox) statusCheckbox.checked = isActive;

        drawer.classList.remove('hidden');
    }

    function closeBuyerDrawer() {
        const drawer = document.getElementById('drawer-container');
        drawer.classList.add('hidden');
    }

    function openResetModal(name, phone) {
        document.getElementById('modal-buyer-name').textContent = name;
        document.getElementById('modal-buyer-phone').textContent = phone;
        document.getElementById('reset-modal').classList.remove('hidden');
    }

    function closeResetModal() {
        document.getElementById('reset-modal').classList.add('hidden');
    }

    function triggerResetFromDrawer() {
        const name = document.getElementById('edit-name').value;
        const phone = document.getElementById('edit-phone').value;
        closeBuyerDrawer();
        openResetModal(name, phone);
    }

    function sendViaWhatsApp() {
        const phone = document.getElementById('modal-buyer-phone').textContent.replace(/[^0-9]/g, '');
        const formattedPhone = phone.startsWith('0') ? '62' + phone.slice(1) : phone;
        const password = document.getElementById('modal-new-password').value;
        const message = encodeURIComponent(`Halo, password akun DuREN Anda telah direset menjadi: ${password}\nSilakan masuk kembali dan segera ganti password Anda.`);
        window.open(`https://wa.me/${formattedPhone}?text=${message}`, '_blank');
        closeResetModal();
    }

    // Filter & Search Script
    (function() {
        const chipButtons = document.querySelectorAll('.buyer-chip-btn');
        const tableRows = document.querySelectorAll('.buyer-row');
        const searchInput = document.getElementById('buyer-search-input');
        let currentFilter = 'all';

        function applyFilter() {
            const query = (searchInput?.value || '').toLowerCase().trim();

            tableRows.forEach(row => {
                const status = (row.getAttribute('data-status') || '').toLowerCase();
                const name = (row.getAttribute('data-name') || '').toLowerCase();
                const phone = (row.getAttribute('data-phone') || '').toLowerCase();

                const matchesFilter = currentFilter === 'all' || status === currentFilter;
                const matchesSearch = !query || name.includes(query) || phone.includes(query);

                if (matchesFilter && matchesSearch) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        chipButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                chipButtons.forEach(b => {
                    b.className = 'buyer-chip-btn h-10 px-5 rounded-full text-[14px] font-medium bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2] transition-colors cursor-pointer';
                });

                btn.className = 'buyer-chip-btn h-10 px-5 rounded-full text-[14px] font-semibold bg-[#E8F3E1] text-[#1F3318] border border-[#CFE6C5] transition-colors cursor-pointer';
                currentFilter = btn.getAttribute('data-filter') || 'all';
                applyFilter();
            });
        });

        searchInput?.addEventListener('input', applyFilter);
    })();
</script>
@endpush
@endsection
