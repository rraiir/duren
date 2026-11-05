@extends('layouts.public')

@section('title', 'DuREN - Pesan Durian Utuh')

@section('content')
<!-- 1. HERO SECTION -->
<section class="pt-8 pb-16 flex flex-col items-center text-center relative">
    <!-- Judul Utama + Durian Pill -->
    <div class="flex flex-wrap items-center justify-center gap-3 md:gap-4 mb-4">
        <h1 class="text-[44px] md:text-[56px] lg:text-[64px] font-bold text-[#1F261D] tracking-tight leading-none">
            Selamat Datang di
        </h1>
        <div class="inline-flex items-center justify-center px-6 py-2 rounded-full bg-[#E3F1DC] border border-[#B7D7A8] shadow-xs transform hover:rotate-1 transition-transform">
            <span class="text-[36px] md:text-[44px] lg:text-[52px] font-bold tracking-tight text-[#1F3318] leading-none">
                DuREN
            </span>
        </div>
    </div>

    <!-- Subjudul / Ringkasan -->
    <p class="max-w-[560px] text-[16px] md:text-[18px] leading-[26px] text-[#4A5246] mb-8 font-normal">
        Pesan durian utuh berkualitas. Bayar praktis lewat QRIS, pantau pesanan sampai tiba di tujuan.
    </p>

    <!-- Tombol Aksi Utama -->
    <div class="flex items-center gap-4 mb-16">
        <a href="{{ url('/login') }}" class="h-12 px-8 rounded-[14px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[#1F261D] font-semibold text-[16px] flex items-center justify-center transition-all shadow-sm">
            Masuk untuk Memesan
        </a>
        <a href="{{ url('/daftar') }}" class="h-12 px-6 rounded-[14px] bg-white border border-[#E4E9DA] hover:bg-[#F8FAF2] text-[#1F261D] font-medium text-[16px] flex items-center justify-center transition-colors">
            Daftar Akun
        </a>
    </div>

    <!-- Ilustrasi Vektor Pastel Durian -->
    <div class="relative w-full max-w-[540px] h-[340px] flex items-center justify-center">
        <!-- Floating Chip Kiri: Durian Utuh Segar -->
        <div class="absolute left-0 top-12 z-20 flex items-center gap-2 px-4 py-2 rounded-full bg-[#CDEBD9] border border-[#ABD9C0] text-[#1F3318] shadow-xs -rotate-6 transform hover:rotate-0 transition-transform">
            <span class="material-symbols-outlined text-[18px] text-[#2C4825]">eco</span>
            <span class="text-[13px] font-medium">Durian Utuh Pilihan</span>
        </div>

        <!-- Floating Chip Kanan: Bayar Praktis QRIS -->
        <div class="absolute right-0 bottom-12 z-20 flex items-center gap-2 px-4 py-2 rounded-full bg-[#FAF1CE] border border-[#ECDDA1] text-[#5C4A12] shadow-xs rotate-6 transform hover:rotate-0 transition-transform">
            <span class="material-symbols-outlined text-[18px] text-[#7A6420]">qr_code_2</span>
            <span class="text-[13px] font-medium">Bayar Praktis QRIS</span>
        </div>

        <!-- SVG Ilustrasi Durian Utuh + Irisan Belah -->
        <div class="w-full h-full flex items-center justify-center select-none">
            <svg viewBox="0 0 460 340" class="w-full h-full drop-shadow-sm" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="durian-art">
                    <!-- Tangkai Durian Utuh -->
                    <path d="M170 65 C170 35, 175 25, 185 20 C195 25, 192 45, 185 65 Z" fill="#6B7366" stroke="#4A5246" stroke-width="2"/>
                    <ellipse cx="185" cy="20" rx="6" ry="3" fill="#4A5246"/>

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

                    <!-- Biji Bayangan Halus pada Daging -->
                    <ellipse cx="278" cy="178" rx="8" ry="5" fill="#ECDDA1" opacity="0.6"/>
                    <ellipse cx="288" cy="246" rx="9" ry="6" fill="#ECDDA1" opacity="0.6"/>
                </g>
            </svg>
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

    <!-- Tiga Kartu Produk (tanpa harga/tombol beli, mengarah ke login per PRD) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse ($featuredProducts as $fp)
            <a href="{{ url('/login') }}" class="duren-card p-6 flex flex-col justify-between group">
                <div>
                    <div class="w-full h-[180px] rounded-[16px] bg-[#F8FAF2] flex items-center justify-center relative overflow-hidden mb-5">
                        <div class="w-32 h-32 rounded-full bg-[#E8F3E1] flex items-center justify-center">
                            <svg width="72" height="72" viewBox="0 0 72 72" fill="none">
                                <ellipse cx="36" cy="38" rx="26" ry="30" fill="#CFE6C5"/>
                                <path d="M12 36 L6 38 L14 42 Z" fill="#B7D7A8"/>
                                <path d="M60 36 L66 38 L58 42 Z" fill="#B7D7A8"/>
                                <polygon points="26,24 22,28 30,30" fill="#B7D7A8"/>
                                <polygon points="46,24 42,28 50,30" fill="#B7D7A8"/>
                            </svg>
                        </div>
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#CDEBD9] border border-[#ABD9C0] text-[#1F3318] text-[12px] font-medium">
                            {{ $fp->type === 'preorder' ? 'Pre-Order' : 'Ready Stock' }}
                        </span>
                    </div>

                    <h3 class="text-[20px] font-semibold text-[#1F261D] mb-2 group-hover:text-[#7A6420] transition-colors">
                        {{ $fp->name }} {{ $fp->size }}
                    </h3>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-6 h-6 rounded-full bg-[#E3F1DC] text-[#1F3318] font-bold text-[12px] flex items-center justify-center">
                            {{ $fp->size }}
                        </span>
                        <span class="text-[14px] text-[#4A5246] font-medium">Est. {{ number_format($fp->est_weight_gram / 1000, 1, ',', '.') }} kg</span>
                    </div>
                </div>

                <div class="pt-4 border-t border-[#E4E9DA]">
                    <p class="text-[12px] text-[#6B7366] font-medium flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px] text-[#7A6420]">lock</span>
                        <span>Masuk untuk melihat harga</span>
                    </p>
                </div>
            </a>
        @empty
            <div class="col-span-3 text-center py-8 text-[#6B7366]">
                Belum ada produk aktif yang ditampilkan.
            </div>
        @endforelse
    </div>
</section>

<!-- 4. BAGIAN "Cara Memesan" -->
<section class="mt-20">
    <div class="text-center mb-10">
        <h2 class="text-[32px] leading-[40px] font-bold text-[#1F261D] mb-2">Cara Memesan</h2>
        <p class="text-[16px] text-[#6B7366]">Empat langkah praktis sampai durian utuh tiba di tujuan.</p>
    </div>

    <div class="bg-[#F8FAF2] border border-[#E4E9DA] rounded-[20px] p-8 shadow-xs">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
            <div class="flex flex-col items-center text-center relative z-10">
                <div class="w-10 h-10 rounded-full bg-[#CFE6C5] text-[#1F3318] font-bold text-[16px] flex items-center justify-center mb-4 shadow-xs border border-[#B7D7A8]">1</div>
                <h4 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] mb-1">Daftar dan masuk</h4>
                <p class="text-[14px] leading-[20px] text-[#4A5246]">Buat akun dengan nomor WhatsApp aktif.</p>
            </div>
            <div class="flex flex-col items-center text-center relative z-10">
                <div class="w-10 h-10 rounded-full bg-[#F2D98A] text-[#5C4A12] font-bold text-[16px] flex items-center justify-center mb-4 shadow-xs border border-[#ECDDA1]">2</div>
                <h4 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] mb-1">Pilih durian</h4>
                <p class="text-[14px] leading-[20px] text-[#4A5246]">Tentukan varian dan ukuran yang diinginkan.</p>
            </div>
            <div class="flex flex-col items-center text-center relative z-10">
                <div class="w-10 h-10 rounded-full bg-[#CFE6C5] text-[#1F3318] font-bold text-[16px] flex items-center justify-center mb-4 shadow-xs border border-[#B7D7A8]">3</div>
                <h4 class="text-[16px] leading-[22px] font-semibold text-[#1F261D] mb-1">Bayar dengan QRIS</h4>
                <p class="text-[14px] leading-[20px] text-[#4A5246]">Scan QRIS dan unggah bukti transfer.</p>
            </div>
            <div class="flex flex-col items-center text-center relative z-10">
                <div class="w-10 h-10 rounded-full bg-[#F2D98A] text-[#5C4A12] font-bold text-[16px] flex items-center justify-center mb-4 shadow-xs border border-[#ECDDA1]">4</div>
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

    <!-- Tiga Kartu Artikel Terbit -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse ($latestArticles as $la)
            <article class="duren-card p-6 flex flex-col justify-between">
                <div>
                    <div class="w-full h-[160px] rounded-[16px] bg-[#F8FAF2] flex items-center justify-center relative overflow-hidden mb-5">
                        @if ($la->cover_path)
                            <img src="{{ asset('storage/' . $la->cover_path) }}" alt="{{ $la->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-28 h-28 rounded-full bg-[#E8F3E1] flex items-center justify-center">
                                <svg width="64" height="64" viewBox="0 0 64 64" fill="none">
                                    <circle cx="32" cy="34" r="22" fill="#CFE6C5"/>
                                    <path d="M12 34 L6 36 L14 40 Z" fill="#B7D7A8"/>
                                    <path d="M52 34 L58 36 L50 40 Z" fill="#B7D7A8"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <span class="text-[12px] leading-[17px] font-medium text-[#6B7366] mb-2 block">
                        {{ $la->published_at ? $la->published_at->format('d M Y') : $la->created_at->format('d M Y') }}
                    </span>
                    <h3 class="text-[20px] leading-[28px] font-semibold text-[#1F261D] line-clamp-2 mb-2">
                        {{ $la->title }}
                    </h3>
                    <p class="text-[14px] leading-[20px] text-[#4A5246] line-clamp-2 mb-4">
                        {{ $la->summary }}
                    </p>
                </div>

                <div class="pt-4 border-t border-[#E4E9DA]">
                    <a href="{{ route('articles.show', $la->id) }}" class="inline-flex items-center gap-1.5 text-[14px] font-semibold text-[#7A6420] hover:underline">
                        <span>Baca selengkapnya</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </article>
        @empty
            <div class="col-span-3 text-center py-8 text-[#6B7366]">
                Belum ada artikel yang diterbitkan.
            </div>
        @endforelse
    </div>
</section>

<!-- 6. AJAKAN BERTINDAK DI BAWAH (CTA) -->
<section class="mt-20 mb-12">
    <div class="rounded-[24px] bg-[#E3F1DC] border border-[#CFE6C5] p-8 md:p-12 text-center flex flex-col items-center shadow-xs">
        <h2 class="text-[32px] md:text-[36px] font-bold text-[#1F3318] mb-3">
            Ingin Menikmati Durian Terbaik?
        </h2>
        <p class="max-w-[480px] text-[16px] text-[#3F5B34] mb-8 leading-relaxed">
            Daftar sekarang dan pesan durian favoritmu. Nikmati kemudahan memesan dengan garansi kualitas terpercaya.
        </p>
        <a href="{{ url('/daftar') }}" class="h-12 px-8 rounded-[14px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[#1F261D] font-semibold text-[16px] flex items-center justify-center transition-all shadow-xs">
            Daftar Sekarang
        </a>
    </div>
</section>
@endsection
