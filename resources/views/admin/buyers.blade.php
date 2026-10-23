@extends('layouts.app')

@section('title', 'Daftar Pembeli - DuREN')

@section('content')
<div class="space-y-6">
    <!-- 1. KEPALA HALAMAN -->
    <div class="flex items-center justify-between pb-2">
        <div class="flex flex-col">
            <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">Daftar Pembeli</h1>
            <p class="text-[16px] leading-[22px] text-[#6B7366] mt-1">Kelola data pembeli terdaftar dan layanan reset password via WhatsApp.</p>
        </div>
    </div>

    <!-- 2. KARTU FILTER & PENCARIAN -->
    <div class="custom-card flex items-center justify-between !py-4">
        <!-- Kotak Pencarian -->
        <div class="relative w-[360px]">
            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[#7A8275] text-[20px]">search</span>
            <input class="w-full h-12 pl-11 pr-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] transition-colors" placeholder="Cari nama atau nomor WhatsApp..." type="text">
        </div>
        <div class="text-[13px] text-[#6B7366]">
            Total: <strong class="text-[#1F261D] font-semibold">18 Pembeli Terdaftar</strong>
        </div>
    </div>

    <!-- 3. KARTU TABEL PEMBELI -->
    <div class="custom-card !p-6 flex flex-col">
        <div class="w-full overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="h-11 bg-[#F8FAF2] rounded-[12px]">
                        <th class="px-4 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider rounded-l-[12px]">Pembeli</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider">Nomor WhatsApp</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider">Alamat Pengiriman</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider">Tanggal Daftar</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider">Status</th>
                        <th class="px-4 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider text-right rounded-r-[12px]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E4E9DA] text-[14px] text-[#1F261D]">
                    <!-- Baris 1: Rina -->
                    <tr class="h-16 hover:bg-[#F8FAF2] transition-colors">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-full bg-[#E3F1DC] text-[#1F3318] flex items-center justify-center font-bold text-[13px]">
                                    R
                                </div>
                                <span class="font-semibold text-[#1F261D]">Rina</span>
                            </div>
                        </td>
                        <td class="px-3 py-3 text-[#4A5246] font-mono text-[13px]">0812-3456-7890</td>
                        <td class="px-3 py-3 text-[#4A5246] max-w-[280px] truncate" title="Jl. Melati No. 18, Cilandak Barat, Jakarta Selatan">
                            Jl. Melati No. 18, Cilandak Barat, Jakarta Selatan
                        </td>
                        <td class="px-3 py-3 text-[#6B7366]">12 Okt 2026</td>
                        <td class="px-3 py-3">
                            <x-badge-status type="active" />
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex items-center space-x-2">
                                <a href="https://wa.me/6281234567890" target="_blank" class="h-9 px-3 rounded-[10px] bg-[#F8FAF2] border border-[#E4E9DA] hover:bg-[#E3F1DC] text-[#1F3318] text-[12px] font-medium flex items-center gap-1.5 transition-colors cursor-pointer">
                                    <span class="material-symbols-outlined text-[16px] text-[#3F5B34]">chat</span>
                                    <span>WhatsApp</span>
                                </a>
                                <button class="h-9 px-3 rounded-[10px] bg-[#FAF1CE] border border-[#ECDDA1] hover:bg-[#F2D98A] text-[#5C4A12] text-[12px] font-medium flex items-center gap-1.5 transition-colors cursor-pointer" onclick="openResetModal('Rina', '0812-3456-7890')" type="button">
                                    <span class="material-symbols-outlined text-[16px]">lock_reset</span>
                                    <span>Reset Password</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Baris 2: Budi -->
                    <tr class="h-16 hover:bg-[#F8FAF2] transition-colors">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-full bg-[#FAF1CE] text-[#5C4A12] flex items-center justify-center font-bold text-[13px]">
                                    B
                                </div>
                                <span class="font-semibold text-[#1F261D]">Budi</span>
                            </div>
                        </td>
                        <td class="px-3 py-3 text-[#4A5246] font-mono text-[13px]">0812-9876-5432</td>
                        <td class="px-3 py-3 text-[#4A5246] max-w-[280px] truncate" title="Jl. Kenanga No. 5, Kebayoran Baru, Jakarta Selatan">
                            Jl. Kenanga No. 5, Kebayoran Baru, Jakarta Selatan
                        </td>
                        <td class="px-3 py-3 text-[#6B7366]">14 Okt 2026</td>
                        <td class="px-3 py-3">
                            <x-badge-status type="active" />
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex items-center space-x-2">
                                <a href="https://wa.me/6281298765432" target="_blank" class="h-9 px-3 rounded-[10px] bg-[#F8FAF2] border border-[#E4E9DA] hover:bg-[#E3F1DC] text-[#1F3318] text-[12px] font-medium flex items-center gap-1.5 transition-colors cursor-pointer">
                                    <span class="material-symbols-outlined text-[16px] text-[#3F5B34]">chat</span>
                                    <span>WhatsApp</span>
                                </a>
                                <button class="h-9 px-3 rounded-[10px] bg-[#FAF1CE] border border-[#ECDDA1] hover:bg-[#F2D98A] text-[#5C4A12] text-[12px] font-medium flex items-center gap-1.5 transition-colors cursor-pointer" onclick="openResetModal('Budi', '0812-9876-5432')" type="button">
                                    <span class="material-symbols-outlined text-[16px]">lock_reset</span>
                                    <span>Reset Password</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Baris 3: Siti -->
                    <tr class="h-16 hover:bg-[#F8FAF2] transition-colors">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-full bg-[#CDEBD9] text-[#14382A] flex items-center justify-center font-bold text-[13px]">
                                    S
                                </div>
                                <span class="font-semibold text-[#1F261D]">Siti</span>
                            </div>
                        </td>
                        <td class="px-3 py-3 text-[#4A5246] font-mono text-[13px]">0813-4567-8901</td>
                        <td class="px-3 py-3 text-[#4A5246] max-w-[280px] truncate" title="Jl. Dahlia No. 10, Kemang, Jakarta Selatan">
                            Jl. Dahlia No. 10, Kemang, Jakarta Selatan
                        </td>
                        <td class="px-3 py-3 text-[#6B7366]">15 Okt 2026</td>
                        <td class="px-3 py-3">
                            <x-badge-status type="active" />
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex items-center space-x-2">
                                <a href="https://wa.me/6281345678901" target="_blank" class="h-9 px-3 rounded-[10px] bg-[#F8FAF2] border border-[#E4E9DA] hover:bg-[#E3F1DC] text-[#1F3318] text-[12px] font-medium flex items-center gap-1.5 transition-colors cursor-pointer">
                                    <span class="material-symbols-outlined text-[16px] text-[#3F5B34]">chat</span>
                                    <span>WhatsApp</span>
                                </a>
                                <button class="h-9 px-3 rounded-[10px] bg-[#FAF1CE] border border-[#ECDDA1] hover:bg-[#F2D98A] text-[#5C4A12] text-[12px] font-medium flex items-center gap-1.5 transition-colors cursor-pointer" onclick="openResetModal('Siti', '0813-4567-8901')" type="button">
                                    <span class="material-symbols-outlined text-[16px]">lock_reset</span>
                                    <span>Reset Password</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Baris 4: Andi -->
                    <tr class="h-16 hover:bg-[#F8FAF2] transition-colors">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-full bg-[#FBDDC6] text-[#8C4A1A] flex items-center justify-center font-bold text-[13px]">
                                    A
                                </div>
                                <span class="font-semibold text-[#1F261D]">Andi</span>
                            </div>
                        </td>
                        <td class="px-3 py-3 text-[#4A5246] font-mono text-[13px]">0812-1122-3344</td>
                        <td class="px-3 py-3 text-[#4A5246] max-w-[280px] truncate" title="Jl. Mawar No. 3, Tebet, Jakarta Selatan">
                            Jl. Mawar No. 3, Tebet, Jakarta Selatan
                        </td>
                        <td class="px-3 py-3 text-[#6B7366]">16 Okt 2026</td>
                        <td class="px-3 py-3">
                            <x-badge-status type="active" />
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex items-center space-x-2">
                                <a href="https://wa.me/6281211223344" target="_blank" class="h-9 px-3 rounded-[10px] bg-[#F8FAF2] border border-[#E4E9DA] hover:bg-[#E3F1DC] text-[#1F3318] text-[12px] font-medium flex items-center gap-1.5 transition-colors cursor-pointer">
                                    <span class="material-symbols-outlined text-[16px] text-[#3F5B34]">chat</span>
                                    <span>WhatsApp</span>
                                </a>
                                <button class="h-9 px-3 rounded-[10px] bg-[#FAF1CE] border border-[#ECDDA1] hover:bg-[#F2D98A] text-[#5C4A12] text-[12px] font-medium flex items-center gap-1.5 transition-colors cursor-pointer" onclick="openResetModal('Andi', '0812-1122-3344')" type="button">
                                    <span class="material-symbols-outlined text-[16px]">lock_reset</span>
                                    <span>Reset Password</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ==================== MODAL RESET PASSWORD PEMBELI ==================== -->
<div class="fixed inset-0 bg-black/30 backdrop-blur-xs z-50 transition-opacity duration-200 opacity-0 pointer-events-none flex items-center justify-center p-4" id="resetModal">
    <div class="w-full max-w-[460px] bg-white rounded-[20px] border border-[#E4E9DA] shadow-2xl p-6 space-y-5">
        <div class="flex items-center justify-between">
            <h2 class="text-[20px] font-semibold text-[#1F261D]">Reset Password Pembeli</h2>
            <button class="w-8 h-8 rounded-full bg-[#F8FAF2] text-[#4A5246] hover:text-[#1F261D] flex items-center justify-center cursor-pointer" onclick="closeResetModal()" type="button">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>

        <div class="p-3.5 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] space-y-1">
            <div class="flex items-center justify-between text-[13px]">
                <span class="text-[#6B7366]">Pembeli:</span>
                <span class="font-semibold text-[#1F261D]" id="modalBuyerName">Rina</span>
            </div>
            <div class="flex items-center justify-between text-[13px]">
                <span class="text-[#6B7366]">WhatsApp:</span>
                <span class="font-mono text-[#4A5246]" id="modalBuyerPhone">0812-3456-7890</span>
            </div>
        </div>

        <div class="space-y-1.5">
            <label class="block text-[14px] font-medium text-[#1F261D]">Password Baru</label>
            <input class="w-full h-12 px-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] focus:outline-none focus:border-[#B7D7A8]" placeholder="Minimal 8 karakter" type="text" value="DurenBaru2026!">
            <p class="text-[12px] text-[#6B7366]">
                Password baru akan disimpan di akun ini. Salin password untuk dikirimkan ke pembeli via chat WhatsApp.
            </p>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button class="flex-1 h-12 rounded-[14px] border border-[#E4E9DA] bg-white hover:bg-[#F8FAF2] text-[#4A5246] text-[14px] font-medium transition-colors cursor-pointer" onclick="closeResetModal()" type="button">
                Batal
            </button>
            <button class="flex-1 h-12 rounded-[14px] bg-[#F2D98A] text-[#5C4A12] hover:bg-[#ebd07d] text-[14px] font-semibold transition-colors cursor-pointer" onclick="closeResetModal()" type="button">
                Simpan Password
            </button>
        </div>
    </div>
</div>

<script>
    function openResetModal(name, phone) {
        document.getElementById('modalBuyerName').textContent = name;
        document.getElementById('modalBuyerPhone').textContent = phone;
        const modal = document.getElementById('resetModal');
        modal.classList.remove('opacity-0', 'pointer-events-none');
    }

    function closeResetModal() {
        const modal = document.getElementById('resetModal');
        modal.classList.add('opacity-0', 'pointer-events-none');
    }
</script>
@endsection
