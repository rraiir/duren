@extends('layouts.app')

@section('title', 'Checkout - DuREN')

@section('content')
<!-- Header Halaman -->
<div class="flex flex-col mb-8 relative z-10">
    <div class="mb-3">
        <a class="inline-flex items-center gap-1.5 text-[14px] font-medium text-[#7A6420] hover:underline" href="{{ url('/keranjang') }}">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Keranjang</span>
        </a>
    </div>
    <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em] mb-1">Checkout Pesanan</h1>
    <p class="text-[16px] text-[#6B7366]">Periksa alamat dan setujui aturan sebelum memesan.</p>
</div>

<!-- Layout Utama Grid: Kiri 8 Kolom, Kanan 4 Kolom -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 relative z-10 items-start">
    <!-- KOLOM KIRI (8 COLS) -->
    <div class="lg:col-span-8 space-y-6">
        <!-- 1. Alamat Pengiriman -->
        <div class="custom-card p-6 bg-white">
            <div class="flex items-center justify-between pb-4 border-b border-[#E4E9DA] mb-4">
                <div class="flex items-center space-x-2.5">
                    <span class="material-symbols-outlined text-[#3F5B34] text-[22px]">location_on</span>
                    <h2 class="text-[18px] font-semibold text-[#1F261D]">Alamat Pengiriman</h2>
                </div>
                <button type="button" class="text-[13px] font-semibold text-[#7A6420] hover:underline cursor-pointer" onclick="toggleEditAddress()">
                    Ubah Alamat
                </button>
            </div>

            <div id="address-display">
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="font-semibold text-[15px] text-[#1F261D]">Rina</span>
                    <span class="text-[#7A8275]">•</span>
                    <span class="text-[14px] text-[#4A5246] font-mono">0812-3456-7890</span>
                </div>
                <p class="text-[14px] text-[#4A5246] leading-relaxed" id="address-text">
                    Jl. Melati No. 18, Cilandak Barat, Jakarta Selatan, DKI Jakarta 12430
                </p>
            </div>

            <div id="address-edit" class="hidden mt-3">
                <textarea class="w-full p-3 rounded-[12px] border border-[#E4E9DA] text-[14px] text-[#1F261D] focus:outline-none focus:border-[#B7D7A8]" rows="3" id="address-input">Jl. Melati No. 18, Cilandak Barat, Jakarta Selatan, DKI Jakarta 12430</textarea>
                <div class="flex justify-end gap-2 mt-2">
                    <button type="button" class="px-4 py-1.5 rounded-[10px] border border-[#E4E9DA] text-[13px] hover:bg-[#F8FAF2]" onclick="toggleEditAddress()">Batal</button>
                    <button type="button" class="px-4 py-1.5 rounded-[10px] bg-[#E3F1DC] text-[#1F3318] font-semibold text-[13px]" onclick="saveAddress()">Simpan</button>
                </div>
            </div>
        </div>

        <!-- 2. Rincian Barang -->
        <div class="custom-card p-6 bg-white">
            <div class="flex items-center justify-between pb-4 border-b border-[#E4E9DA] mb-4">
                <div class="flex items-center space-x-2.5">
                    <span class="material-symbols-outlined text-[#3F5B34] text-[22px]">inventory_2</span>
                    <h2 class="text-[18px] font-semibold text-[#1F261D]">Durian yang Dipesan</h2>
                </div>
                <x-badge-status type="ready" />
            </div>

            <div class="divide-y divide-[#E4E9DA]">
                <div class="py-3 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-[10px] bg-[#E3F1DC] flex items-center justify-center text-[#1F3318] font-bold text-[13px]">
                            L
                        </div>
                        <div>
                            <h4 class="font-semibold text-[14px] text-[#1F261D]">Montong L (1 buah)</h4>
                            <span class="text-[12px] text-[#6B7366]">Est. 3,2 kg</span>
                        </div>
                    </div>
                    <span class="font-bold text-[15px] text-[#1F261D]">Rp 250.000</span>
                </div>

                <div class="py-3 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-[10px] bg-[#FBEFB5] flex items-center justify-center text-[#5C4A12] font-bold text-[13px]">
                            M
                        </div>
                        <div>
                            <h4 class="font-semibold text-[14px] text-[#1F261D]">Montong M (1 buah)</h4>
                            <span class="text-[12px] text-[#6B7366]">Est. 2,4 kg</span>
                        </div>
                    </div>
                    <span class="font-bold text-[15px] text-[#1F261D]">Rp 190.000</span>
                </div>
            </div>
        </div>

        <!-- 3. Persetujuan Aturan & Garansi -->
        <div class="custom-card p-6 bg-[#F8FAF2] border border-[#E4E9DA]">
            <label class="flex items-start gap-3 cursor-pointer">
                <input type="checkbox" id="agree-terms" checked class="mt-1 w-4 h-4 rounded text-[#4E6B43] border-[#E4E9DA] focus:ring-0">
                <span class="text-[14px] text-[#1F261D] leading-relaxed">
                    Saya telah membaca dan menyetujui seluruh ketentuan pada <a href="{{ url('/aturan-garansi') }}" target="_blank" class="text-[#7A6420] underline font-semibold">Aturan & Garansi</a>, termasuk batas waktu transfer pembayaran dan ketentuan klaim buah jika mentah atau busuk.
                </span>
            </label>
        </div>
    </div>

    <!-- KOLOM KANAN (4 COLS) -->
    <aside class="lg:col-span-4 custom-card p-6 flex flex-col justify-between sticky top-28 bg-white">
        <div>
            <h2 class="text-[20px] font-semibold text-[#1F261D] mb-5">Ringkasan Pembayaran</h2>

            <div class="space-y-3 pb-5 border-b border-[#E4E9DA]">
                <div class="flex items-center justify-between text-[14px]">
                    <span class="text-[#4A5246]">Total Durian (2 buah)</span>
                    <span class="font-medium text-[#1F261D]">Rp 440.000</span>
                </div>
                <div class="flex items-center justify-between text-[14px]">
                    <span class="text-[#4A5246]">Ongkos Kirim</span>
                    <span class="text-[12px] font-semibold text-[#7A6420] bg-[#FAF1CE] px-2 py-0.5 rounded-full">Dikonfirmasi via WA</span>
                </div>
                <div class="flex items-center justify-between text-[16px] pt-2 border-t border-[#E4E9DA]">
                    <span class="font-semibold text-[#1F261D]">Total Pembayaran</span>
                    <span class="font-bold text-[20px] text-[#1F261D]">Rp 440.000</span>
                </div>
            </div>

            <div class="py-4 text-[12px] text-[#6B7366] leading-relaxed">
                Pembayaran dilakukan menggunakan QRIS statis dengan batas waktu 2 jam setelah pesanan dibuat.
            </div>
        </div>

        <div class="pt-4 border-t border-[#E4E9DA]">
            <a href="{{ url('/pembayaran/DRN-0042') }}" class="w-full h-12 rounded-[14px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[#1F261D] font-semibold text-[14px] flex items-center justify-center gap-2 transition-all shadow-sm">
                <span>Buat Pesanan & Bayar QRIS</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
    </aside>
</div>

@push('scripts')
<script>
    function toggleEditAddress() {
        document.getElementById('address-display').classList.toggle('hidden');
        document.getElementById('address-edit').classList.toggle('hidden');
    }

    function saveAddress() {
        const val = document.getElementById('address-input').value;
        document.getElementById('address-text').textContent = val;
        toggleEditAddress();
    }
</script>
@endpush
@endsection
