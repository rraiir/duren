@extends('layouts.app')

@section('title', 'Pengaturan - DuREN')

@section('content')
<div class="space-y-6 max-w-[800px]">
    <!-- 1. KEPALA HALAMAN -->
    <div class="flex items-center justify-between pb-2">
        <div class="flex flex-col">
            <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">Pengaturan Toko</h1>
            <p class="text-[16px] leading-[22px] text-[#6B7366] mt-1">Konfigurasi QRIS statis, nomor kontak WhatsApp, dan aturan toko.</p>
        </div>
    </div>

    <!-- 2. KARTU FORM PENGATURAN -->
    <div class="custom-card !p-8">
        <form class="space-y-6" onsubmit="event.preventDefault();">
            <!-- 1. Gambar QRIS Statis -->
            <div>
                <label class="block text-[14px] font-semibold text-[#1F261D] mb-1.5">Gambar QRIS Pembayaran</label>
                <p class="text-[12px] text-[#6B7366] mb-3">Tampil di halaman pembayaran pembeli saat checkout.</p>
                <div class="flex items-center gap-5">
                    <div class="w-32 h-32 rounded-[14px] bg-[#F8FAF2] border-2 border-dashed border-[#E4E9DA] flex flex-col items-center justify-center p-2 text-center text-[#7A8275]">
                        <span class="material-symbols-outlined text-[36px] text-[#7A8275] mb-1">qr_code_2</span>
                        <span class="text-[11px] font-medium">QRIS Toko</span>
                    </div>
                    <div class="space-y-2">
                        <button class="h-10 px-4 rounded-[12px] bg-white border border-[#E4E9DA] hover:bg-[#F8FAF2] text-[#1F261D] text-[13px] font-medium flex items-center gap-2 transition-colors cursor-pointer" type="button">
                            <span class="material-symbols-outlined text-[18px]">upload</span>
                            <span>Unggah Gambar Baru</span>
                        </button>
                        <p class="text-[12px] text-[#6B7366]">Format JPG atau PNG, maksimal 2 MB.</p>
                    </div>
                </div>
            </div>

            <!-- Pemisah -->
            <div class="h-[1px] bg-[#E4E9DA] w-full"></div>

            <!-- 2. Nomor WhatsApp Admin -->
            <div>
                <label class="block text-[14px] font-semibold text-[#1F261D] mb-1.5" for="admin-wa">Nomor WhatsApp Admin</label>
                <p class="text-[12px] text-[#6B7366] mb-2">Digunakan untuk tombol chat bantuan dan konfirmasi ongkir oleh pembeli.</p>
                <div class="relative max-w-[400px]">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[#7A8275] text-[20px]">chat</span>
                    <input class="w-full h-12 pl-11 pr-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] focus:outline-none focus:border-[#B7D7A8] transition-colors" id="admin-wa" placeholder="Contoh: 62812xxxxxxxx" type="text" value="6281234567890">
                </div>
            </div>

            <!-- Pemisah -->
            <div class="h-[1px] bg-[#E4E9DA] w-full"></div>

            <!-- 3. Batas Hari Pembayaran Ongkir -->
            <div>
                <label class="block text-[14px] font-semibold text-[#1F261D] mb-1.5" for="deadline-days">Batas Waktu Pelunasan Ongkir</label>
                <p class="text-[12px] text-[#6B7366] mb-2">Pesanan yang belum lunas ongkir setelah batas hari ini akan ditandai lewat batas pada daftar pesanan.</p>
                <div class="relative max-w-[200px]">
                    <input class="w-full h-12 pl-4 pr-14 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] focus:outline-none focus:border-[#B7D7A8] transition-colors" id="deadline-days" type="number" value="2">
                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[13px] text-[#6B7366]">hari</span>
                </div>
            </div>

            <!-- Pemisah -->
            <div class="h-[1px] bg-[#E4E9DA] w-full"></div>

            <!-- 4. Teks Aturan Ongkir -->
            <div>
                <label class="block text-[14px] font-semibold text-[#1F261D] mb-1.5" for="shipping-rules">Teks Aturan Ongkir &amp; Wilayah Layanan</label>
                <p class="text-[12px] text-[#6B7366] mb-2">Tampil pada halaman checkout dan aturan garansi pembeli.</p>
                <textarea class="w-full rounded-[12px] border border-[#E4E9DA] p-3.5 text-[#1F261D] text-[14px] leading-relaxed focus:outline-none focus:border-[#B7D7A8] bg-white resize-none transition-colors" id="shipping-rules" rows="3">Ongkir dikonfirmasi Admin lewat WhatsApp setelah pembayaran durian diterima, lalu dibayar terpisah. Pesanan dikirim setelah ongkir lunas.</textarea>
            </div>

            <!-- Pemisah -->
            <div class="h-[1px] bg-[#E4E9DA] w-full"></div>

            <!-- 5. Teks Aturan Garansi -->
            <div>
                <label class="block text-[14px] font-semibold text-[#1F261D] mb-1.5" for="warranty-text">Teks Aturan Garansi</label>
                <p class="text-[12px] text-[#6B7366] mb-2">Wajib disetujui oleh pembeli saat checkout sebelum melakukan pemesanan.</p>
                <textarea class="w-full rounded-[12px] border border-[#E4E9DA] p-3.5 text-[#1F261D] text-[14px] leading-relaxed focus:outline-none focus:border-[#B7D7A8] bg-white resize-none transition-colors" id="warranty-text" rows="4">Klaim wajib disertai video unboxing tanpa dipotong dan diajukan maksimal 24 jam setelah durian diterima. Durian busuk atau tidak layak makan diganti atau direfund setelah Admin memeriksa video. Selisih kecil dari estimasi berat dan selera rasa (misalnya kurang manis) tidak dijamin.</textarea>
            </div>

            <!-- Tombol Aksi Simpan -->
            <div class="pt-4 flex items-center justify-end gap-3">
                <button class="h-12 px-6 rounded-[14px] bg-[#F2D98A] hover:bg-[#ebd07d] text-[#5C4A12] text-[14px] font-semibold transition-colors shadow-xs cursor-pointer flex items-center gap-2" type="submit">
                    <span class="material-symbols-outlined text-[18px]">check</span>
                    <span>Simpan Pengaturan</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
