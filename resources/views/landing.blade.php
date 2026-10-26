@extends('layouts.public')

@section('title', 'DuREN - Pesan Durian Utuh, Langsung dari Layar')

@section('content')
<!-- 1. HERO SECTION -->
<section class="min-h-[560px] pt-14 pb-8 flex items-center">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center w-full">
        <!-- Kolom Kiri Teks -->
        <div class="lg:col-span-7 pr-4">
            <!-- Chip Mint -->
            <div class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-[#CDEBD9] border border-[#ABD9C0] text-[#1F3318] text-[12px] font-medium mb-6">
                <span class="material-symbols-outlined text-[16px] text-[#3F5B34]">workspace_premium</span>
                <span>Durian Utuh Pilihan</span>
            </div>

            <!-- Judul Hero 56px/64px Bold -->
            <h1 class="text-[44px] md:text-[56px] leading-[52px] md:leading-[64px] font-bold tracking-[-0.03em] text-[#1F261D] mb-6">
                Pesan <span class="inline-block bg-[#F2D98A] text-[#1F261D] px-3 py-1 rounded-[12px] rotate-[-2deg] shadow-sm">durian utuh</span>, langsung dari layar
            </h1>

            <!-- Paragraf -->
            <p class="text-[16px] leading-[24px] text-[#6B7366] mb-8 max-w-[500px]">
                Pilih varian dan ukuran, bayar lewat QRIS, lalu pantau pesananmu sampai tiba.
            </p>

            <!-- Dua Tombol Aksi -->
            <div class="flex items-center gap-4">
                <a href="{{ url('/login') }}" class="h-12 px-7 rounded-[14px] bg-[#F2D98A] text-[#1F261D] font-semibold text-[16px] flex items-center justify-center hover:brightness-95 transition-all shadow-sm">
                    Masuk untuk Memesan
                </a>
                <a href="{{ url('/artikel') }}" class="h-12 px-7 rounded-[14px] bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2] font-medium text-[16px] flex items-center justify-center transition-colors">
                    Baca Artikel
                </a>
            </div>
        </div>

        <!-- Kolom Kanan Ilustrasi Durian Datar + 3 Chip Melayang -->
        <div class="lg:col-span-5 relative flex items-center justify-center min-h-[460px]">
            <!-- Background Organic Blobs -->
            <div class="absolute w-[360px] h-[360px] bg-[#FAF1CE] rounded-[48%_52%_60%_40%/45%_55%_45%_55%] opacity-80 -top-4 -right-2 transform rotate-12 -z-10"></div>
            <div class="absolute w-[380px] h-[380px] bg-[#E8F3E1] rounded-[55%_45%_40%_60%/50%_45%_55%_50%] top-6 left-2 -z-10"></div>

            <!-- SVG Komposisi Durian Utuh Berduri & Irisan Terbelah -->
            <div class="relative w-[420px] h-[380px] flex items-center justify-center">
                <svg viewBox="0 0 420 380" class="w-full h-full drop-shadow-sm select-none" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Tangkai durian utuh kiri -->
                    <path d="M165 48 C163 32, 178 20, 184 15 C186 26, 178 44, 174 54 Z" fill="#6B7366"/>
                    
                    <!-- Kulit Durian Utuh Belakang -->
                    <ellipse cx="170" cy="190" rx="100" ry="125" fill="#CFE6C5" />
                    <!-- Duri-duri durian luar kiri & atas -->
                    <path d="M72 170 L58 176 L74 186 Z" fill="#B7D7A8"/>
                    <path d="M78 140 L62 142 L78 154 Z" fill="#B7D7A8"/>
                    <path d="M92 110 L78 106 L92 122 Z" fill="#B7D7A8"/>
                    <path d="M115 85 L102 76 L118 96 Z" fill="#B7D7A8"/>
                    <path d="M142 66 L134 52 L150 72 Z" fill="#B7D7A8"/>
                    <path d="M170 65 L170 48 L178 68 Z" fill="#B7D7A8"/>
                    <path d="M198 68 L206 52 L206 72 Z" fill="#B7D7A8"/>
                    <path d="M80 205 L66 215 L82 225 Z" fill="#B7D7A8"/>
                    <path d="M94 240 L82 254 L100 258 Z" fill="#B7D7A8"/>
                    <path d="M118 270 L110 288 L130 286 Z" fill="#B7D7A8"/>
                    <path d="M150 295 L148 315 L168 308 Z" fill="#B7D7A8"/>
                    <path d="M185 305 L190 322 L202 305 Z" fill="#B7D7A8"/>

                    <!-- Tekstur Duri Datar Tubuh Durian Utuh -->
                    <polygon points="120,130 110,140 126,144" fill="#B7D7A8"/>
                    <polygon points="150,110 142,122 158,124" fill="#B7D7A8"/>
                    <polygon points="135,160 122,170 140,174" fill="#B7D7A8"/>
                    <polygon points="110,185 98,195 116,200" fill="#B7D7A8"/>
                    <polygon points="130,215 120,228 138,230" fill="#B7D7A8"/>
                    <polygon points="155,185 145,198 162,200" fill="#B7D7A8"/>
                    <polygon points="175,140 168,154 184,152" fill="#B7D7A8"/>
                    <polygon points="150,245 142,258 160,258" fill="#B7D7A8"/>

                    <!-- Durian Terbelah -->
                    <path d="M220 120 C310 120, 360 190, 360 250 C360 300, 310 330, 240 330 C190 330, 190 280, 200 220 Z" fill="#DDEDCF" />
                    <path d="M220 120 C310 120, 360 190, 360 250 C360 300, 310 330, 240 330 C190 330, 190 280, 200 220 Z" stroke="#C3DCAF" stroke-width="4"/>

                    <!-- Duri-duri Luar Irisan Durian -->
                    <path d="M358 220 L376 226 L356 238 Z" fill="#B7D7A8"/>
                    <path d="M352 255 L368 266 L346 272 Z" fill="#B7D7A8"/>
                    <path d="M330 290 L342 308 L320 306 Z" fill="#B7D7A8"/>
                    <path d="M295 318 L300 336 L284 326 Z" fill="#B7D7A8"/>
                    <path d="M255 330 L250 348 L238 330 Z" fill="#B7D7A8"/>

                    <!-- Juring Cangkang Dalam Irisan -->
                    <path d="M215 140 C285 135, 335 190, 335 245 C335 285, 290 310, 235 310 C200 310, 198 270, 205 220 Z" fill="#FFF3C9" />

                    <!-- Daging Buah Segmen 1 (Lobus Kuning Atas) -->
                    <ellipse cx="270" cy="180" rx="34" ry="24" transform="rotate(35 270 180)" fill="#F2D98A"/>
                    <ellipse cx="266" cy="182" rx="10" ry="6" transform="rotate(35 266 182)" fill="#FFF3C9"/>

                    <!-- Daging Buah Segmen 2 (Lobus Kuning Tengah Bawah) -->
                    <ellipse cx="280" cy="245" rx="38" ry="26" transform="rotate(-15 280 245)" fill="#F2D98A"/>
                    <ellipse cx="282" cy="243" rx="11" ry="7" transform="rotate(-15 282 243)" fill="#FFF3C9"/>

                    <!-- Daging Buah Segmen 3 (Lobus Kuning Samping Kiri) -->
                    <ellipse cx="230" cy="225" rx="28" ry="20" transform="rotate(-65 230 225)" fill="#F2D98A"/>
                    <ellipse cx="228" cy="223" rx="8" ry="5" transform="rotate(-65 228 223)" fill="#FFF3C9"/>
                </svg>

                <!-- Tiga Chip Melayang -->
                <div class="absolute -top-1 left-2 px-3.5 py-1.5 rounded-full bg-[#CDEBD9] border border-[#ABD9C0] text-[#1F3318] text-[12px] font-medium shadow-sm transform -rotate-6 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-[#3F5B34]"></span>
                    <span>Ready Stock</span>
                </div>
                <div class="absolute bottom-6 -left-6 px-3.5 py-1.5 rounded-full bg-[#FBEFB5] border border-[#ECDDA1] text-[#5C4A12] text-[12px] font-medium shadow-sm transform rotate-6 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[14px]">event_available</span>
                    <span>Pre-Order</span>
                </div>
                <div class="absolute top-16 -right-4 px-3.5 py-1.5 rounded-full bg-[#DDEDCF] border border-[#C3DCAF] text-[#1F3318] text-[12px] font-medium shadow-sm transform rotate-3 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[14px]">qr_code_2</span>
                    <span>Bayar QRIS</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. BAGIAN "Kenapa DuREN" -->
<section class="mt-20">
    <div class="text-center mb-12">
        <h2 class="text-[32px] leading-[40px] font-bold text-[#1F261D] mb-3">Kenapa DuREN</h2>
        <p class="text-[16px] text-[#6B7366]">Kemudahan memesan durian utuh berkualitas langsung dari web.</p>
    </div>

    <!-- Tiga Kartu Sejajar -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="duren-card p-6 flex flex-col items-start">
            <div class="w-12 h-12 rounded-[12px] bg-[#CFE6C5] flex items-center justify-center mb-5 text-[#1F3318]">
                <span class="material-symbols-outlined text-[24px]">inventory_2</span>
            </div>
            <h3 class="text-[20px] leading-[28px] font-semibold text-[#1F261D] mb-2">Ready Stock dan Pre-Order</h3>
            <p class="text-[14px] leading-[20px] text-[#4A5246]">Pilih durian yang sudah tersedia atau pesan untuk panen berikutnya.</p>
        </div>

        <div class="duren-card p-6 flex flex-col items-start">
            <div class="w-12 h-12 rounded-[12px] bg-[#F2D98A] flex items-center justify-center mb-5 text-[#5C4A12]">
                <span class="material-symbols-outlined text-[24px]">qr_code_2</span>
            </div>
            <h3 class="text-[20px] leading-[28px] font-semibold text-[#1F261D] mb-2">Bayar dengan QRIS</h3>
            <p class="text-[14px] leading-[20px] text-[#4A5246]">Scan, bayar, lalu unggah bukti. Admin memeriksa pembayaranmu.</p>
        </div>

        <div class="duren-card p-6 flex flex-col items-start">
            <div class="w-12 h-12 rounded-[12px] bg-[#CFE6C5] flex items-center justify-center mb-5 text-[#1F3318]">
                <span class="material-symbols-outlined text-[24px]">local_shipping</span>
            </div>
            <h3 class="text-[20px] leading-[28px] font-semibold text-[#1F261D] mb-2">Pantau Pesanan</h3>
            <p class="text-[14px] leading-[20px] text-[#4A5246]">Lihat status dan nomor resi pesananmu kapan saja.</p>
        </div>
    </div>
</section>

<!-- 3. BAGIAN "Durian Tersedia" -->
<section class="mt-20">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-[32px] leading-[40px] font-bold text-[#1F261D]">Durian Tersedia</h2>
        </div>
        <a href="{{ url('/login') }}" class="inline-flex items-center gap-1.5 text-[14px] font-semibold text-[#7A6420] hover:underline">
            <span>Lihat Katalog</span>
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
    </div>

    <!-- Tiga Kartu Produk (tanpa harga/tombol beli, mengarah ke login) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Produk 1: Montong L -->
        <a href="{{ url('/login') }}" class="duren-card p-6 flex flex-col justify-between group">
            <div>
                <div class="w-full h-[180px] rounded-[16px] bg-[#F8FAF2] flex items-center justify-center relative overflow-hidden mb-5">
                    <div class="w-32 h-32 rounded-full bg-[#E8F3E1] flex items-center justify-center">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none">
                            <ellipse cx="36" cy="38" rx="26" ry="30" fill="#CFE6C5"/>
                            <path d="M12 36 L6 38 L14 42 Z" fill="#B7D7A8"/>
                            <path d="M60 36 L66 38 L58 42 Z" fill="#B7D7A8"/>
                            <path d="M36 8 L36 4 L38 8 Z" fill="#6B7366"/>
                            <polygon points="26,24 22,28 30,30" fill="#B7D7A8"/>
                            <polygon points="46,24 42,28 50,30" fill="#B7D7A8"/>
                            <polygon points="36,44 30,50 42,50" fill="#B7D7A8"/>
                        </svg>
                    </div>
                    <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#CDEBD9] border border-[#ABD9C0] text-[#1F3318] text-[12px] font-medium">
                        Ready Stock
                    </span>
                </div>

                <h3 class="text-[20px] font-semibold text-[#1F261D] mb-2 group-hover:text-[#7A6420] transition-colors">Montong L</h3>
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-6 h-6 rounded-full bg-[#E3F1DC] text-[#1F3318] font-bold text-[12px] flex items-center justify-center">
                        L
                    </span>
                    <span class="text-[14px] text-[#4A5246] font-medium">Est. 3,2 kg</span>
                </div>
            </div>

            <div class="pt-4 border-t border-[#E4E9DA]">
                <p class="text-[12px] text-[#6B7366] font-medium flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px] text-[#7A6420]">lock</span>
                    <span>Masuk untuk melihat harga</span>
                </p>
            </div>
        </a>

        <!-- Produk 2: Musang King M -->
        <a href="{{ url('/login') }}" class="duren-card p-6 flex flex-col justify-between group">
            <div>
                <div class="w-full h-[180px] rounded-[16px] bg-[#F8FAF2] flex items-center justify-center relative overflow-hidden mb-5">
                    <div class="w-32 h-32 rounded-full bg-[#FAF1CE] flex items-center justify-center">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none">
                            <ellipse cx="36" cy="38" rx="24" ry="28" fill="#F2D98A"/>
                            <path d="M14 36 L8 38 L16 42 Z" fill="#ECDDA1"/>
                            <path d="M58 36 L64 38 L56 42 Z" fill="#ECDDA1"/>
                            <path d="M36 10 L36 5 L38 10 Z" fill="#6B7366"/>
                            <polygon points="28,26 24,30 32,32" fill="#5C4A12" opacity="0.3"/>
                            <polygon points="44,26 40,30 48,32" fill="#5C4A12" opacity="0.3"/>
                            <polygon points="36,46 30,52 42,52" fill="#5C4A12" opacity="0.3"/>
                        </svg>
                    </div>
                    <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#CDEBD9] border border-[#ABD9C0] text-[#1F3318] text-[12px] font-medium">
                        Ready Stock
                    </span>
                </div>

                <h3 class="text-[20px] font-semibold text-[#1F261D] mb-2 group-hover:text-[#7A6420] transition-colors">Musang King M</h3>
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-6 h-6 rounded-full bg-[#FBEFB5] text-[#5C4A12] font-bold text-[12px] flex items-center justify-center">
                        M
                    </span>
                    <span class="text-[14px] text-[#4A5246] font-medium">Est. 2,0 kg</span>
                </div>
            </div>

            <div class="pt-4 border-t border-[#E4E9DA]">
                <p class="text-[12px] text-[#6B7366] font-medium flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px] text-[#7A6420]">lock</span>
                    <span>Masuk untuk melihat harga</span>
                </p>
            </div>
        </a>

        <!-- Produk 3: Bawor L -->
        <a href="{{ url('/login') }}" class="duren-card p-6 flex flex-col justify-between group">
            <div>
                <div class="w-full h-[180px] rounded-[16px] bg-[#F8FAF2] flex items-center justify-center relative overflow-hidden mb-5">
                    <div class="w-32 h-32 rounded-full bg-[#FFF3C9] flex items-center justify-center">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none">
                            <ellipse cx="36" cy="38" rx="27" ry="31" fill="#CFE6C5"/>
                            <path d="M11 36 L5 38 L13 42 Z" fill="#B7D7A8"/>
                            <path d="M61 36 L67 38 L59 42 Z" fill="#B7D7A8"/>
                            <polygon points="26,24 22,28 30,30" fill="#B7D7A8"/>
                            <polygon points="46,24 42,28 50,30" fill="#B7D7A8"/>
                        </svg>
                    </div>
                    <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#FBEFB5] border border-[#ECDDA1] text-[#5C4A12] text-[12px] font-medium">
                        Pre-Order
                    </span>
                </div>

                <h3 class="text-[20px] font-semibold text-[#1F261D] mb-2 group-hover:text-[#7A6420] transition-colors">Bawor L</h3>
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-6 h-6 rounded-full bg-[#E3F1DC] text-[#1F3318] font-bold text-[12px] flex items-center justify-center">
                        L
                    </span>
                    <span class="text-[14px] text-[#4A5246] font-medium">Est. 3,5 kg</span>
                </div>
            </div>

            <div class="pt-4 border-t border-[#E4E9DA]">
                <p class="text-[12px] text-[#6B7366] font-medium flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px] text-[#7A6420]">lock</span>
                    <span>Masuk untuk melihat harga</span>
                </p>
            </div>
        </a>
    </div>
</section>

<!-- 4. BAGIAN "Cara Memesan" -->
<section class="mt-20">
    <div class="text-center mb-10">
        <h2 class="text-[32px] leading-[40px] font-bold text-[#1F261D] mb-2">Cara Memesan</h2>
        <p class="text-[16px] text-[#6B7366]">Empat langkah praktis sampai durian utuh tiba di tujuan.</p>
    </div>

    <div class="bg-[#F8FAF2] border border-[#E4E9DA] rounded-[20px] p-8 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
            <!-- Langkah 1 -->
            <div class="flex flex-col items-center text-center relative z-10">
                <div class="w-10 h-10 rounded-full bg-[#CFE6C5] text-[#1F3318] font-bold text-[16px] flex items-center justify-center mb-4 shadow-sm border border-[#B7D7A8]">
                    1
                </div>
                <h4 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] mb-1">Daftar dan masuk</h4>
                <p class="text-[14px] leading-[20px] text-[#4A5246]">Buat akun dengan nomor WhatsApp aktif.</p>
            </div>

            <!-- Langkah 2 -->
            <div class="flex flex-col items-center text-center relative z-10">
                <div class="w-10 h-10 rounded-full bg-[#F2D98A] text-[#5C4A12] font-bold text-[16px] flex items-center justify-center mb-4 shadow-sm border border-[#ECDDA1]">
                    2
                </div>
                <h4 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] mb-1">Pilih durian</h4>
                <p class="text-[14px] leading-[20px] text-[#4A5246]">Tentukan varian dan ukuran yang diinginkan.</p>
            </div>

            <!-- Langkah 3 -->
            <div class="flex flex-col items-center text-center relative z-10">
                <div class="w-10 h-10 rounded-full bg-[#CFE6C5] text-[#1F3318] font-bold text-[16px] flex items-center justify-center mb-4 shadow-sm border border-[#B7D7A8]">
                    3
                </div>
                <h4 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] mb-1">Bayar dengan QRIS</h4>
                <p class="text-[14px] leading-[20px] text-[#4A5246]">Scan QRIS dan unggah bukti transfer.</p>
            </div>

            <!-- Langkah 4 -->
            <div class="flex flex-col items-center text-center relative z-10">
                <div class="w-10 h-10 rounded-full bg-[#F2D98A] text-[#5C4A12] font-bold text-[16px] flex items-center justify-center mb-4 shadow-sm border border-[#ECDDA1]">
                    4
                </div>
                <h4 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] mb-1">Tunggu durian tiba</h4>
                <p class="text-[14px] leading-[20px] text-[#4A5246]">Pantau status pesanan dan nomor resi pengiriman.</p>
            </div>
        </div>
    </div>
</section>

<!-- 5. BAGIAN "Artikel Seputar Durian" -->
<section class="mt-20">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-[32px] leading-[40px] font-bold text-[#1F261D]">Artikel Seputar Durian</h2>
            <p class="text-[16px] text-[#6B7366] mt-1">Tips memilih, menyimpan, dan menikmati durian.</p>
        </div>
        <a href="{{ url('/artikel') }}" class="inline-flex items-center gap-1.5 text-[14px] font-semibold text-[#7A6420] hover:underline">
            <span>Lihat Semua Artikel</span>
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
    </div>

    <!-- Tiga Kartu Artikel -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Artikel 1 -->
        <article class="duren-card p-6 flex flex-col justify-between">
            <div>
                <div class="w-full h-[160px] rounded-[16px] bg-[#F8FAF2] flex items-center justify-center relative overflow-hidden mb-5">
                    <div class="w-28 h-28 rounded-full bg-[#E8F3E1] flex items-center justify-center">
                        <svg width="64" height="64" viewBox="0 0 64 64" fill="none">
                            <circle cx="32" cy="34" r="22" fill="#CFE6C5"/>
                            <path d="M12 34 L6 36 L14 40 Z" fill="#B7D7A8"/>
                            <path d="M52 34 L58 36 L50 40 Z" fill="#B7D7A8"/>
                        </svg>
                    </div>
                </div>
                <span class="text-[12px] leading-[17px] font-medium text-[#6B7366] mb-2 block">
                    20 Okt 2026
                </span>
                <h3 class="text-[20px] leading-[28px] font-semibold text-[#1F261D] line-clamp-2 mb-2">
                    Cara Memilih Durian Matang
                </h3>
                <p class="text-[14px] leading-[20px] text-[#4A5246] line-clamp-2 mb-4">
                    Kenali tanda durian yang siap dinikmati sebelum membeli.
                </p>
            </div>
            <div class="pt-3">
                <a href="{{ url('/artikel/1') }}" class="inline-flex items-center gap-1.5 text-[14px] font-semibold text-[#7A6420] hover:underline">
                    <span>Baca selengkapnya</span>
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>
        </article>

        <!-- Artikel 2 -->
        <article class="duren-card p-6 flex flex-col justify-between">
            <div>
                <div class="w-full h-[160px] rounded-[16px] bg-[#F8FAF2] flex items-center justify-center relative overflow-hidden mb-5">
                    <div class="w-28 h-28 rounded-full bg-[#FAF1CE] flex items-center justify-center">
                        <svg width="64" height="64" viewBox="0 0 64 64" fill="none">
                            <circle cx="32" cy="34" r="22" fill="#F2D98A"/>
                            <path d="M12 34 L6 36 L14 40 Z" fill="#ECDDA1"/>
                            <path d="M52 34 L58 36 L50 40 Z" fill="#ECDDA1"/>
                        </svg>
                    </div>
                </div>
                <span class="text-[12px] leading-[17px] font-medium text-[#6B7366] mb-2 block">
                    18 Okt 2026
                </span>
                <h3 class="text-[20px] leading-[28px] font-semibold text-[#1F261D] line-clamp-2 mb-2">
                    Mengenal Varian Montong dan Musang King
                </h3>
                <p class="text-[14px] leading-[20px] text-[#4A5246] line-clamp-2 mb-4">
                    Perbedaan rasa, tekstur, dan ukuran dua varian populer.
                </p>
            </div>
            <div class="pt-3">
                <a href="{{ url('/artikel/2') }}" class="inline-flex items-center gap-1.5 text-[14px] font-semibold text-[#7A6420] hover:underline">
                    <span>Baca selengkapnya</span>
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>
        </article>

        <!-- Artikel 3 -->
        <article class="duren-card p-6 flex flex-col justify-between">
            <div>
                <div class="w-full h-[160px] rounded-[16px] bg-[#F8FAF2] flex items-center justify-center relative overflow-hidden mb-5">
                    <div class="w-28 h-28 rounded-full bg-[#FFF3C9] flex items-center justify-center">
                        <svg width="64" height="64" viewBox="0 0 64 64" fill="none">
                            <ellipse cx="32" cy="34" rx="22" ry="24" fill="#CFE6C5"/>
                            <polygon points="24,24 20,28 28,29" fill="#B7D7A8"/>
                            <polygon points="40,24 36,28 44,29" fill="#B7D7A8"/>
                        </svg>
                    </div>
                </div>
                <span class="text-[12px] leading-[17px] font-medium text-[#6B7366] mb-2 block">
                    15 Okt 2026
                </span>
                <h3 class="text-[20px] leading-[28px] font-semibold text-[#1F261D] line-clamp-2 mb-2">
                    Cara Menyimpan Durian Utuh
                </h3>
                <p class="text-[14px] leading-[20px] text-[#4A5246] line-clamp-2 mb-4">
                    Tips menyimpan durian agar tetap segar lebih lama.
                </p>
            </div>
            <div class="pt-3">
                <a href="{{ url('/artikel/3') }}" class="inline-flex items-center gap-1.5 text-[14px] font-semibold text-[#7A6420] hover:underline">
                    <span>Baca selengkapnya</span>
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>
        </article>
    </div>
</section>

<!-- 6. BAND AJAKAN -->
<section class="mt-20 mb-12">
    <div class="relative bg-[#E3F1DC] border border-[#C3DCAF] rounded-[20px] p-8 md:p-12 overflow-hidden shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="absolute -top-12 -left-12 w-48 h-48 bg-[#FAF1CE] rounded-full opacity-60 blur-xl pointer-events-none"></div>
        <div class="absolute -bottom-12 -right-12 w-48 h-48 bg-[#CDEBD9] rounded-full opacity-60 blur-xl pointer-events-none"></div>

        <div class="relative z-10 max-w-[540px]">
            <h2 class="text-[28px] md:text-[32px] leading-[36px] md:leading-[40px] font-bold text-[#1F3318] mb-2">Siap memesan durian?</h2>
            <p class="text-[16px] text-[#3F5B34]">Daftar sekarang dan mulai memesan.</p>
        </div>

        <div class="relative z-10 flex items-center gap-4">
            <a href="{{ url('/daftar') }}" class="h-12 px-7 rounded-[14px] bg-[#F2D98A] text-[#1F261D] font-semibold text-[16px] flex items-center justify-center hover:brightness-95 transition-all shadow-sm">
                Daftar Sekarang
            </a>
            <a href="{{ url('/login') }}" class="h-12 px-7 rounded-[14px] bg-white border border-[#E4E9DA] text-[#1F261D] hover:bg-[#F8FAF2] font-medium text-[16px] flex items-center justify-center transition-colors">
                Masuk
            </a>
        </div>
    </div>
</section>
@endsection
