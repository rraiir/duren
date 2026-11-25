@extends('layouts.app')

@section('title', 'Detail Pesanan DRN-0042 - DuREN')

@section('content')
<div class="flex flex-col w-full relative space-y-6">
    <!-- KEPALA HALAMAN -->
    <div class="relative z-10 flex flex-col gap-3">
        <!-- Tautan Kembali -->
        <a class="inline-flex items-center gap-2 text-[14px] leading-[20px] font-medium text-[#4A5246] hover:text-[#1F3318] transition-colors w-fit cursor-pointer" href="{{ url('/admin/pesanan') }}">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Pesanan</span>
        </a>
        <!-- Baris Judul & Badge Status -->
        <div class="flex items-center gap-4 flex-wrap">
            <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">
                Pesanan DRN-0042
            </h1>
            <x-badge-status type="waiting_verification" />
        </div>
        <!-- Baris Info Caption -->
        <div class="flex items-center gap-4 flex-wrap text-[#6B7366] text-[14px]">
            <x-badge-status type="ready" />
            <span class="w-1.5 h-1.5 rounded-full bg-[#E4E9DA]"></span>
            <span class="flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px] text-[#6B7366]">schedule</span>
                <span>Dibuat 20 Okt 2026, 14:20 WIB</span>
            </span>
            <span class="w-1.5 h-1.5 rounded-full bg-[#E4E9DA]"></span>
            <span class="flex items-center gap-1 text-[#4A5246]">
                <span class="material-symbols-outlined text-[16px] text-[#6B7366]">timer</span>
                <span>Batas bayar 16:20 WIB</span>
            </span>
        </div>
    </div>

    <!-- LAYOUT KONTEN UTAMA (2 Kolom: Kiri 2/3, Kanan 1/3) -->
    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <!-- ========================================== -->
        <!-- KOLOM KIRI (span 2) -->
        <!-- ========================================== -->
        <div class="lg:col-span-2 flex flex-col gap-6">
            @if(isset($order) && ($order->status === 'waiting_price_approval' || $order->negotiation_status === 'pending'))
                <!-- KARTU PERSETUJUAN TAWARAN HARGA (ala inDrive) -->
                <section class="custom-card flex flex-col gap-5 bg-[#FFF9E6] border border-[#ECDDA1] p-6 rounded-[16px] shadow-xs">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-[#FAF1CE] flex items-center justify-center text-[#7A6420]">
                                <span class="material-symbols-outlined text-[24px]">handshake</span>
                            </div>
                            <div>
                                <h2 class="text-[18px] font-bold text-[#1F261D]">Pengajuan Tawaran Harga (inDrive)</h2>
                                <p class="text-[13px] text-[#5C4A12]">Pembeli mengajukan penawaran harga untuk pesanan ini dan menunggu persetujuan Anda.</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-[#FAF1CE] text-[#5C4A12] border border-[#ECDDA1] text-[12px] font-bold">
                            Menunggu Approval
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 rounded-[12px] bg-white border border-[#E4E9DA]">
                        <div>
                            <span class="text-[12px] text-[#6B7366]">Total Harga Normal Katalog</span>
                            <p class="text-[16px] font-semibold text-[#1F261D] line-through">
                                {{ numberToRupiah($order->orderItems->sum(fn($i) => ($i->product->price ?? 0) * $i->quantity)) }}
                            </p>
                        </div>
                        <div>
                            <span class="text-[12px] text-[#6B7366]">Harga yang Ditawar Pembeli</span>
                            <p class="text-[20px] font-bold text-[#1F3318]">
                                {{ numberToRupiah($order->proposed_price ?? $order->total_price) }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <form method="POST" action="{{ route('admin.orders.nego.approve', $order->code) }}" class="inline">
                            @csrf
                            <button type="submit" class="h-11 px-6 rounded-[14px] bg-[#E3F1DC] hover:bg-[#CFE6C5] text-[#1F3318] text-[14px] font-semibold flex items-center gap-2 shadow-xs transition-colors cursor-pointer">
                                <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                <span>Setujui Tawaran Harga</span>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.orders.nego.reject', $order->code) }}" class="inline">
                            @csrf
                            <button type="submit" class="h-11 px-5 rounded-[14px] bg-[#FBDDC6] hover:bg-[#F8CBB0] text-[#8C4A1A] text-[14px] font-semibold flex items-center gap-2 shadow-xs transition-colors cursor-pointer">
                                <span class="material-symbols-outlined text-[18px]">cancel</span>
                                <span>Tolak Tawaran</span>
                            </button>
                        </form>
                    </div>
                </section>
            @endif

            <!-- 1. KARTU ALUR STATUS -->
            <section class="custom-card flex flex-col gap-6 bg-[#F8FAF2]">
                <div class="flex items-center justify-between">
                    <h2 class="text-[20px] font-semibold text-[#1F261D]">Alur Status</h2>
                    <span class="text-[12px] text-[#1F3318] font-semibold bg-[#E3F1DC] border border-[#B7D7A8] px-3 py-1 rounded-full">
                        Tahap 2 dari 6
                    </span>
                </div>
                <!-- Alur Horizontal Steps -->
                <div class="flex items-center justify-between w-full overflow-x-auto py-3 px-4 rounded-[14px] bg-white border border-[#E4E9DA] shadow-xs">
                    <!-- Langkah 1: Bayar (Selesai) -->
                    <div class="flex flex-col items-center gap-1.5 min-w-[64px]">
                        <div class="w-9 h-9 rounded-full bg-[#B7D7A8] text-[#1F3318] flex items-center justify-center shadow-xs">
                            <span class="material-symbols-outlined text-[20px] font-bold">check</span>
                        </div>
                        <span class="text-[13px] text-[#1F3318] font-semibold">Bayar</span>
                    </div>
                    <!-- Garis 1-2 -->
                    <div class="flex-1 h-[2px] bg-[#B7D7A8] mx-2 min-w-[20px] rounded-full"></div>
                    <!-- Langkah 2: Verifikasi (Aktif) -->
                    <div class="flex flex-col items-center gap-1 min-w-[64px]">
                        <div class="w-9 h-9 rounded-full bg-[#F2D98A] text-[#5C4A12] flex items-center justify-center font-bold text-[15px] shadow-xs border border-[#ECDDA1]">
                            2
                        </div>
                        <div class="flex flex-col items-center">
                            <span class="text-[13px] text-[#5C4A12] font-bold">Verifikasi</span>
                            <span class="px-1.5 py-0.5 rounded-full bg-[#FAF1CE] text-[#5C4A12] text-[10px] font-semibold leading-none">Aktif</span>
                        </div>
                    </div>
                    <!-- Garis 2-3 -->
                    <div class="flex-1 h-[2px] bg-[#E4E9DA] mx-2 min-w-[20px] rounded-full"></div>
                    <!-- Langkah 3: Ongkir -->
                    <div class="flex flex-col items-center gap-1.5 min-w-[64px]">
                        <div class="w-9 h-9 rounded-full bg-white border border-[#E4E9DA] text-[#6B7366] flex items-center justify-center text-[12px] font-medium shadow-xs">
                            3
                        </div>
                        <span class="text-[13px] text-[#6B7366]">Ongkir</span>
                    </div>
                    <!-- Garis 3-4 -->
                    <div class="flex-1 h-[2px] bg-[#E4E9DA] mx-2 min-w-[20px] rounded-full"></div>
                    <!-- Langkah 4: Proses -->
                    <div class="flex flex-col items-center gap-1.5 min-w-[64px]">
                        <div class="w-9 h-9 rounded-full bg-white border border-[#E4E9DA] text-[#6B7366] flex items-center justify-center text-[12px] font-medium shadow-xs">
                            4
                        </div>
                        <span class="text-[13px] text-[#6B7366]">Proses</span>
                    </div>
                    <!-- Garis 4-5 -->
                    <div class="flex-1 h-[2px] bg-[#E4E9DA] mx-2 min-w-[20px] rounded-full"></div>
                    <!-- Langkah 5: Kirim -->
                    <div class="flex flex-col items-center gap-1.5 min-w-[64px]">
                        <div class="w-9 h-9 rounded-full bg-white border border-[#E4E9DA] text-[#6B7366] flex items-center justify-center text-[12px] font-medium shadow-xs">
                            5
                        </div>
                        <span class="text-[13px] text-[#6B7366]">Kirim</span>
                    </div>
                    <!-- Garis 5-6 -->
                    <div class="flex-1 h-[2px] bg-[#E4E9DA] mx-2 min-w-[20px] rounded-full"></div>
                    <!-- Langkah 6: Selesai -->
                    <div class="flex flex-col items-center gap-1.5 min-w-[64px]">
                        <div class="w-9 h-9 rounded-full bg-white border border-[#E4E9DA] text-[#6B7366] flex items-center justify-center text-[12px] font-medium shadow-xs">
                            6
                        </div>
                        <span class="text-[13px] text-[#6B7366]">Selesai</span>
                    </div>
                </div>
            </section>

            <!-- 2. KARTU BUKTI PEMBAYARAN -->
            <section class="custom-card flex flex-col gap-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-[20px] font-semibold text-[#1F261D]">Bukti Pembayaran</h2>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#FAF1CE] border border-[#ECDDA1] text-[#5C4A12] text-[12px] font-medium">
                        <span class="material-symbols-outlined text-[16px]">info</span>
                        <span>Cek mutasi rekening secara manual</span>
                    </span>
                </div>

                <!-- Info Visual & Metrik Bukti -->
                <div class="flex flex-col sm:flex-row gap-6 items-start">
                    <!-- Placeholder Bukti Transfer -->
                    <div class="w-full sm:w-[260px] h-[240px] shrink-0 rounded-[14px] bg-[#F1F5E8] border border-dashed border-[#E4E9DA] flex flex-col items-center justify-center p-4 text-center group cursor-pointer transition-colors hover:bg-[#E3F1DC]/30">
                        <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center mb-3 text-[#7A8275] group-hover:scale-105 transition-transform shadow-xs">
                            <span class="material-symbols-outlined text-[36px]">receipt_long</span>
                        </div>
                        <span class="text-[14px] font-medium text-[#4A5246]">Bukti transfer QRIS</span>
                        <span class="mt-2 inline-flex items-center gap-1 px-3 py-1 bg-white text-[#1F261D] rounded-full text-[12px] shadow-xs">
                            <span class="material-symbols-outlined text-[14px]">zoom_in</span>
                            <span>Klik untuk perbesar</span>
                        </span>
                    </div>

                    <!-- Deskripsi Metrik Bukti -->
                    <div class="flex flex-col justify-between h-full w-full gap-4 py-1">
                        <div class="flex flex-col gap-1">
                            <span class="text-[12px] text-[#6B7366]">Waktu Unggah</span>
                            <p class="text-[16px] font-semibold text-[#1F261D] flex items-center gap-2">
                                Diunggah 10 mnt lalu
                                <span class="text-[14px] text-[#6B7366] font-normal">(20 Okt 2026, 14:35 WIB)</span>
                            </p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-[12px] text-[#6B7366]">Riwayat Bukti</span>
                            <p class="text-[16px] font-semibold text-[#1F261D]">Unggahan ke-1 dari 2</p>
                        </div>
                        <div class="p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex flex-col gap-1">
                            <span class="text-[12px] text-[#6B7366]">Total Tagihan Durian</span>
                            <p class="text-[20px] text-[#1F261D] font-bold">
                                Rp 440.000
                            </p>
                            <p class="text-[12px] text-[#6B7366] flex items-center gap-1 mt-0.5">
                                <span class="material-symbols-outlined text-[14px] text-[#7A6420]">verified</span>
                                <span>Cek mutasi rekening sebelum menerima pembayaran.</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Kolom Alasan Penolakan -->
                <div class="flex flex-col gap-2 pt-2">
                    <label class="text-[14px] font-medium text-[#4A5246] flex items-center justify-between" for="reject-reason">
                        <span>Alasan penolakan <span class="text-[#BA1A1A] font-normal">(wajib diisi jika menolak)</span></span>
                        <span class="text-[12px] text-[#6B7366]">Maks 150 karakter</span>
                    </label>
                    <textarea class="w-full rounded-[12px] border border-[#E4E9DA] p-3 text-[#1F261D] text-[14px] placeholder-[#7A8275] focus:outline-none focus:border-[#F2D98A] bg-white resize-none transition-colors" id="reject-reason" placeholder="Contoh: Bukti buram, nominal transfer kurang, atau nama pengirim tidak cocok..." rows="2"></textarea>
                </div>

                <!-- Baris Tombol Aksi Pembayaran -->
                <div class="flex items-center gap-3 pt-2 flex-wrap">
                    <button class="h-11 px-6 rounded-[14px] bg-[#F2D98A] hover:bg-[#ebd07d] text-[#5C4A12] text-[14px] font-semibold flex items-center gap-2 transition-colors shadow-sm cursor-pointer" type="button">
                        <span class="material-symbols-outlined text-[18px]">check</span>
                        <span>Terima Pembayaran</span>
                    </button>
                    <button class="h-11 px-5 rounded-[14px] bg-white border border-[#E4E9DA] hover:bg-[#FBDDC6] hover:border-[#EFC3A3] text-[#BA1A1A] text-[14px] font-semibold flex items-center gap-2 transition-colors cursor-pointer" type="button">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                        <span>Tolak</span>
                    </button>
                    <button class="h-11 px-3 text-[#7A6420] hover:underline text-[14px] font-semibold flex items-center gap-1.5 transition-colors cursor-pointer" type="button">
                        <span class="material-symbols-outlined text-[18px]">update</span>
                        <span>Perpanjang 1 Jam</span>
                    </button>
                </div>
            </section>

            <!-- 3. KARTU ITEM PESANAN -->
            <section class="custom-card flex flex-col gap-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-[20px] font-semibold text-[#1F261D]">Item Pesanan</h2>
                    <span class="text-[12px] text-[#6B7366]">2 Durian Utuh</span>
                </div>
                <!-- Tabel Item Pesanan -->
                <div class="flex flex-col w-full">
                    <!-- Table Header -->
                    <div class="grid grid-cols-12 px-4 py-3 bg-[#F8FAF2] rounded-[10px] text-[#6B7366] text-[12px] font-medium uppercase tracking-wider mb-3">
                        <div class="col-span-6">Item</div>
                        <div class="col-span-2 text-center">Jumlah</div>
                        <div class="col-span-2 text-right">Harga</div>
                        <div class="col-span-2 text-right">Subtotal</div>
                    </div>
                    <!-- Baris 1: Montong L -->
                    <div class="grid grid-cols-12 px-4 py-3 items-center border-b border-[#E4E9DA]">
                        <div class="col-span-6 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-[12px] bg-[#E3F1DC] flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[#4E6B43] text-[20px]">nutrition</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[14px] font-semibold text-[#1F261D]">Durian Montong (L)</span>
                                <span class="text-[12px] text-[#6B7366]">Est. Berat ~3.200 gr</span>
                            </div>
                        </div>
                        <div class="col-span-2 text-center text-[14px] text-[#1F261D]">
                            1
                        </div>
                        <div class="col-span-2 text-right text-[14px] text-[#4A5246]">
                            Rp 250.000
                        </div>
                        <div class="col-span-2 text-right text-[14px] font-semibold text-[#1F261D]">
                            Rp 250.000
                        </div>
                    </div>
                    <!-- Baris 2: Montong M -->
                    <div class="grid grid-cols-12 px-4 py-3 items-center border-b border-[#E4E9DA]">
                        <div class="col-span-6 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-[12px] bg-[#E3F1DC] flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[#4E6B43] text-[20px]">nutrition</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[14px] font-semibold text-[#1F261D]">Durian Montong (M)</span>
                                <span class="text-[12px] text-[#6B7366]">Est. Berat ~2.400 gr</span>
                            </div>
                        </div>
                        <div class="col-span-2 text-center text-[14px] text-[#1F261D]">
                            1
                        </div>
                        <div class="col-span-2 text-right text-[14px] text-[#4A5246]">
                            Rp 190.000
                        </div>
                        <div class="col-span-2 text-right text-[14px] font-semibold text-[#1F261D]">
                            Rp 190.000
                        </div>
                    </div>
                    <!-- Baris Total -->
                    <div class="grid grid-cols-12 px-4 py-4 items-center">
                        <div class="col-span-6 text-[18px] font-semibold text-[#1F261D]">
                            Total Tagihan Durian
                        </div>
                        <div class="col-span-6 text-right text-[20px] text-[#1F261D] font-bold">
                            Rp 440.000
                        </div>
                    </div>
                </div>
                <!-- Info Ongkir -->
                <div class="p-3.5 rounded-[10px] bg-[#F8FAF2] flex items-start gap-2.5 text-[#6B7366] text-[13px]">
                    <span class="material-symbols-outlined text-[18px] text-[#4A5246] shrink-0 mt-0.5">info</span>
                    <span>Ongkir tidak termasuk dalam tagihan ini, dikonfirmasi dan ditagih terpisah lewat WhatsApp.</span>
                </div>
            </section>
        </div>

        <!-- ========================================== -->
        <!-- KOLOM KANAN (span 1) -->
        <!-- ========================================== -->
        <div class="flex flex-col gap-6">
            <!-- 1. KARTU PEMBELI -->
            <section class="custom-card flex flex-col gap-5">
                <h2 class="text-[20px] font-semibold text-[#1F261D]">Pembeli</h2>
                <!-- Profil Pembeli -->
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-[#E3F1DC] text-[#3F5B34] flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[24px]">person</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[16px] font-bold text-[#1F261D]">Rina</span>
                        <span class="text-[14px] text-[#6B7366]">0812-3456-7890</span>
                    </div>
                </div>
                <!-- Tombol Chat WA -->
                <a class="h-11 px-4 rounded-[14px] bg-[#E3F1DC] hover:bg-[#cfe6c5] text-[#1F3318] text-[14px] font-semibold flex items-center justify-center gap-2 transition-colors w-full cursor-pointer" href="https://wa.me/6281234567890" rel="noopener noreferrer" target="_blank">
                    <span class="material-symbols-outlined text-[20px]">chat</span>
                    <span>Chat WhatsApp</span>
                </a>
                <!-- Pemisah -->
                <div class="h-[1px] bg-[#E4E9DA] w-full"></div>
                <!-- Detail Alamat -->
                <div class="flex flex-col gap-2">
                    <span class="text-[12px] text-[#6B7366] font-medium">Alamat Pengiriman</span>
                    <p class="text-[14px] text-[#1F261D] leading-relaxed">
                        Jl. Melati No. 18, RT 03/RW 05, Cilandak Barat, Jakarta Selatan, 12430
                    </p>
                </div>
            </section>

            <!-- 2. KARTU PENGIRIMAN -->
            <section class="custom-card flex flex-col gap-5">
                <h2 class="text-[20px] font-semibold text-[#1F261D]">Pengiriman</h2>
                <!-- Tombol Status Ongkir (Non-aktif) -->
                <div class="flex flex-col gap-1">
                    <button class="h-11 px-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] text-[#7A8275] text-[14px] font-medium w-full flex items-center justify-center gap-2 cursor-not-allowed opacity-80" disabled type="button">
                        <span class="material-symbols-outlined text-[18px]">payments</span>
                        <span>Tandai Ongkir Lunas</span>
                    </button>
                    <span class="text-[11px] text-[#6B7366] flex items-center gap-1 px-1">
                        <span class="material-symbols-outlined text-[14px]">lock</span>
                        <span>Aktif setelah pembayaran durian diterima</span>
                    </span>
                </div>
                <!-- Segmented Control Tipe Kurir -->
                <div class="flex flex-col gap-2">
                    <span class="text-[14px] font-medium text-[#4A5246]">Metode Pengiriman</span>
                    <div class="grid grid-cols-2 gap-2 p-1 bg-[#F8FAF2] rounded-[14px] border border-[#E4E9DA]">
                        <button class="h-9 rounded-[10px] bg-white border border-[#E4E9DA] text-[#4A5246] text-[13px] font-medium hover:text-[#1F261D] transition-colors cursor-pointer" type="button">
                            Antar Sendiri
                        </button>
                        <button class="h-9 rounded-[10px] bg-[#E3F1DC] border border-[#B7D7A8] text-[#1F3318] text-[13px] font-semibold flex items-center justify-center gap-1 cursor-pointer" type="button">
                            <span class="material-symbols-outlined text-[16px]">check</span>
                            <span>Kurir</span>
                        </button>
                    </div>
                </div>
                <!-- Input Nama Kurir -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-[14px] font-medium text-[#4A5246]" for="courier-name">Nama Kurir</label>
                    <input class="h-11 px-3.5 rounded-[12px] border border-[#E4E9DA] text-[#1F261D] text-[14px] focus:outline-none focus:border-[#B7D7A8] bg-white transition-colors" id="courier-name" placeholder="Masukkan nama kurir" type="text" value="Lalamove">
                </div>
                <!-- Input Nomor Resi -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-[14px] font-medium text-[#4A5246]" for="tracking-num">Nomor Resi / Pelacakan</label>
                    <input class="h-11 px-3.5 rounded-[12px] border border-[#E4E9DA] text-[#1F261D] text-[14px] focus:outline-none focus:border-[#B7D7A8] bg-white transition-colors" id="tracking-num" placeholder="Masukkan resi / link pelacakan" type="text" value="LLM-892104-JKT">
                </div>
                <!-- Tombol Simpan Pengiriman -->
                <button class="h-11 px-4 rounded-[14px] bg-white border border-[#E4E9DA] hover:bg-[#F8FAF2] text-[#1F261D] text-[14px] font-medium w-full transition-colors mt-1 shadow-sm cursor-pointer" type="button">
                    Simpan Pengiriman
                </button>
                <!-- Tombol Batalkan Pesanan -->
                <button class="text-[14px] font-semibold text-[#BA1A1A] hover:underline flex items-center justify-center gap-1.5 pt-1 cursor-pointer" type="button">
                    <span class="material-symbols-outlined text-[18px]">cancel</span>
                    <span>Batalkan Pesanan</span>
                </button>
            </section>
        </div>
    </div>
</div>
@endsection
