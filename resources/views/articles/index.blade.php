@extends('layouts.public')

@section('title', 'Artikel - DuREN')

@section('content')
<!-- KEPALA HALAMAN ARSIP ARTIKEL -->
<section class="py-12 flex flex-col items-start">
    <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">
        Artikel
    </h1>
    <p class="mt-2 text-[16px] text-[#6B7366]">
        Tips dan panduan seputar durian.
    </p>

    <!-- Baris Pencarian -->
    <div class="mt-6 w-full flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="relative w-full">
            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[#7A8275] text-[20px] pointer-events-none">
                search
            </span>
            <input class="w-full h-12 pl-11 pr-4 bg-white border border-[#E4E9DA] rounded-[14px] text-[14px] text-[#1F261D] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] transition-all shadow-sm" id="article-search" placeholder="Cari artikel..." type="text">
        </div>
    </div>
</section>

<!-- GRID KARTU ARTIKEL (3 Kolom) -->
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="article-grid">
    <!-- ARTIKEL 1 -->
    <article class="article-card duren-card p-5 flex flex-col justify-between group" data-title="Cara Memilih Durian Matang">
        <div>
            <div class="h-40 w-full rounded-[14px] bg-[#E8F3E1] flex items-center justify-center relative overflow-hidden mb-4">
                <svg class="w-24 h-24 relative z-10 transition-transform duration-300 group-hover:scale-105" fill="none" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <ellipse cx="50" cy="54" fill="#B7D7A8" rx="34" ry="38"></ellipse>
                    <path d="M50 16 C50 16 52 8 58 10" stroke="#3F5B34" stroke-linecap="round" stroke-width="4"></path>
                    <polygon fill="#88AD76" points="50,16 46,24 54,24"></polygon>
                    <polygon fill="#88AD76" points="30,26 22,34 33,36"></polygon>
                    <polygon fill="#88AD76" points="70,26 78,34 67,36"></polygon>
                    <ellipse cx="42" cy="46" fill="#F2D98A" rx="8" ry="14"></ellipse>
                    <ellipse cx="58" cy="46" fill="#F2D98A" rx="8" ry="14"></ellipse>
                    <ellipse cx="50" cy="64" fill="#F2D98A" rx="10" ry="16"></ellipse>
                </svg>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-[12px] font-medium text-[#6B7366]">20 Okt 2026</span>
            </div>
            <h2 class="mt-2 text-[20px] font-semibold text-[#1F261D] line-clamp-2 group-hover:text-[#7A6420] transition-colors leading-[28px]">
                Cara Memilih Durian Matang
            </h2>
            <p class="mt-2 text-[14px] text-[#4A5246] line-clamp-2 leading-[20px]">
                Kenali tanda durian yang siap dinikmati sebelum membeli.
            </p>
        </div>
        <div class="mt-4 pt-3 flex items-center justify-between border-t border-[#E4E9DA]">
            <a class="inline-flex items-center gap-1.5 text-[#7A6420] text-[14px] font-semibold hover:gap-2.5 transition-all" href="{{ url('/artikel/1') }}">
                <span>Baca selengkapnya</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
    </article>

    <!-- ARTIKEL 2 -->
    <article class="article-card duren-card p-5 flex flex-col justify-between group" data-title="Mengenal Varian Montong dan Musang King">
        <div>
            <div class="h-40 w-full rounded-[14px] bg-[#FAF1CE] flex items-center justify-center relative overflow-hidden mb-4">
                <svg class="w-24 h-24 relative z-10 transition-transform duration-300 group-hover:scale-105" fill="none" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <ellipse cx="38" cy="56" fill="#DDEDCF" rx="22" ry="28"></ellipse>
                    <ellipse cx="62" cy="52" fill="#ECDDA1" rx="20" ry="26"></ellipse>
                    <path d="M38 28 C38 28 36 20 40 18" stroke="#3F5B34" stroke-linecap="round" stroke-width="3"></path>
                    <path d="M62 26 C62 26 64 20 60 18" stroke="#7A6420" stroke-linecap="round" stroke-width="3"></path>
                    <ellipse cx="38" cy="56" fill="#F2D98A" rx="8" ry="14"></ellipse>
                    <ellipse cx="62" cy="52" fill="#F8C757" rx="9" ry="13"></ellipse>
                </svg>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-[12px] font-medium text-[#6B7366]">18 Okt 2026</span>
            </div>
            <h2 class="mt-2 text-[20px] font-semibold text-[#1F261D] line-clamp-2 group-hover:text-[#7A6420] transition-colors leading-[28px]">
                Mengenal Varian Montong dan Musang King
            </h2>
            <p class="mt-2 text-[14px] text-[#4A5246] line-clamp-2 leading-[20px]">
                Perbedaan rasa, tekstur, dan ukuran dua varian populer.
            </p>
        </div>
        <div class="mt-4 pt-3 flex items-center justify-between border-t border-[#E4E9DA]">
            <a class="inline-flex items-center gap-1.5 text-[#7A6420] text-[14px] font-semibold hover:gap-2.5 transition-all" href="{{ url('/artikel/2') }}">
                <span>Baca selengkapnya</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
    </article>

    <!-- ARTIKEL 3 -->
    <article class="article-card duren-card p-5 flex flex-col justify-between group" data-title="Cara Menyimpan Durian Utuh">
        <div>
            <div class="h-40 w-full rounded-[14px] bg-[#FFF3C9] flex items-center justify-center relative overflow-hidden mb-4">
                <svg class="w-24 h-24 relative z-10 transition-transform duration-300 group-hover:scale-105" fill="none" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <rect fill="#FBEFB5" height="42" rx="12" width="50" x="25" y="32"></rect>
                    <path d="M50 18 V32" stroke="#5C4A12" stroke-linecap="round" stroke-width="4"></path>
                    <path d="M38 52 C38 46 50 46 50 52 C50 58 62 58 62 52" stroke="#CFE6C5" stroke-linecap="round" stroke-width="4"></path>
                </svg>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-[12px] font-medium text-[#6B7366]">15 Okt 2026</span>
            </div>
            <h2 class="mt-2 text-[20px] font-semibold text-[#1F261D] line-clamp-2 group-hover:text-[#7A6420] transition-colors leading-[28px]">
                Cara Menyimpan Durian Utuh
            </h2>
            <p class="mt-2 text-[14px] text-[#4A5246] line-clamp-2 leading-[20px]">
                Tips menyimpan durian agar tetap segar lebih lama.
            </p>
        </div>
        <div class="mt-4 pt-3 flex items-center justify-between border-t border-[#E4E9DA]">
            <a class="inline-flex items-center gap-1.5 text-[#7A6420] text-[14px] font-semibold hover:gap-2.5 transition-all" href="{{ url('/artikel/3') }}">
                <span>Baca selengkapnya</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
    </article>

    <!-- ARTIKEL 4 -->
    <article class="article-card duren-card p-5 flex flex-col justify-between group" data-title="Ready Stock dan Pre-Order: Apa Bedanya?">
        <div>
            <div class="h-40 w-full rounded-[14px] bg-[#CDEBD9] flex items-center justify-center relative overflow-hidden mb-4">
                <svg class="w-24 h-24 relative z-10 transition-transform duration-300 group-hover:scale-105" fill="none" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" fill="#E8F3E1" r="32"></circle>
                    <path d="M36 50 C36 40 44 36 50 36 C56 36 64 40 64 50 C64 60 56 64 50 64" stroke="#4E6B43" stroke-linecap="round" stroke-width="4"></path>
                </svg>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-[12px] font-medium text-[#6B7366]">12 Okt 2026</span>
            </div>
            <h2 class="mt-2 text-[20px] font-semibold text-[#1F261D] line-clamp-2 group-hover:text-[#7A6420] transition-colors leading-[28px]">
                Ready Stock dan Pre-Order: Apa Bedanya?
            </h2>
            <p class="mt-2 text-[14px] text-[#4A5246] line-clamp-2 leading-[20px]">
                Penjelasan dua jenis stok dan kapan durian sampai.
            </p>
        </div>
        <div class="mt-4 pt-3 flex items-center justify-between border-t border-[#E4E9DA]">
            <a class="inline-flex items-center gap-1.5 text-[#7A6420] text-[14px] font-semibold hover:gap-2.5 transition-all" href="{{ url('/artikel/4') }}">
                <span>Baca selengkapnya</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
    </article>

    <!-- ARTIKEL 5 -->
    <article class="article-card duren-card p-5 flex flex-col justify-between group" data-title="Ukuran S, M, L: Mana yang Cocok?">
        <div>
            <div class="h-40 w-full rounded-[14px] bg-[#FBDDC6] flex items-center justify-center relative overflow-hidden mb-4">
                <svg class="w-24 h-24 relative z-10 transition-transform duration-300 group-hover:scale-105" fill="none" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="40" cy="56" fill="#FBDDC6" r="16" stroke="#EFC3A3" stroke-width="4"></circle>
                    <circle cx="62" cy="46" fill="#FBEFB5" r="22" stroke="#ECDDA1" stroke-width="4"></circle>
                </svg>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-[12px] font-medium text-[#6B7366]">9 Okt 2026</span>
            </div>
            <h2 class="mt-2 text-[20px] font-semibold text-[#1F261D] line-clamp-2 group-hover:text-[#7A6420] transition-colors leading-[28px]">
                Ukuran S, M, L: Mana yang Cocok?
            </h2>
            <p class="mt-2 text-[14px] text-[#4A5246] line-clamp-2 leading-[20px]">
                Panduan memilih ukuran sesuai jumlah orang.
            </p>
        </div>
        <div class="mt-4 pt-3 flex items-center justify-between border-t border-[#E4E9DA]">
            <a class="inline-flex items-center gap-1.5 text-[#7A6420] text-[14px] font-semibold hover:gap-2.5 transition-all" href="{{ url('/artikel/5') }}">
                <span>Baca selengkapnya</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
    </article>

    <!-- ARTIKEL 6 -->
    <article class="article-card duren-card p-5 flex flex-col justify-between group" data-title="Tips Menikmati Durian Bersama Keluarga">
        <div>
            <div class="h-40 w-full rounded-[14px] bg-[#F1F5E8] flex items-center justify-center relative overflow-hidden mb-4">
                <svg class="w-24 h-24 relative z-10 transition-transform duration-300 group-hover:scale-105" fill="none" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <ellipse cx="50" cy="50" fill="#DDEDCF" rx="28" ry="32"></ellipse>
                    <circle cx="50" cy="50" fill="#F2D98A" r="14"></circle>
                </svg>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-[12px] font-medium text-[#6B7366]">5 Okt 2026</span>
            </div>
            <h2 class="mt-2 text-[20px] font-semibold text-[#1F261D] line-clamp-2 group-hover:text-[#7A6420] transition-colors leading-[28px]">
                Tips Menikmati Durian Bersama Keluarga
            </h2>
            <p class="mt-2 text-[14px] text-[#4A5246] line-clamp-2 leading-[20px]">
                Saran penyajian dan suasana yang pas saat makan durian.
            </p>
        </div>
        <div class="mt-4 pt-3 flex items-center justify-between border-t border-[#E4E9DA]">
            <a class="inline-flex items-center gap-1.5 text-[#7A6420] text-[14px] font-semibold hover:gap-2.5 transition-all" href="{{ url('/artikel/6') }}">
                <span>Baca selengkapnya</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
    </article>
</section>

<!-- PAGINASI -->
<div class="py-12 flex items-center justify-center gap-2">
    <button aria-label="Halaman sebelumnya" class="w-10 h-10 rounded-full border border-[#E4E9DA] bg-white flex items-center justify-center text-[#4A5246] hover:bg-[#F8FAF2] transition-colors">
        <span class="material-symbols-outlined text-[20px]">chevron_left</span>
    </button>
    <button class="w-10 h-10 rounded-full bg-[#E3F1DC] text-[#1F3318] text-[14px] font-bold flex items-center justify-center border border-transparent">
        1
    </button>
    <button class="w-10 h-10 rounded-full border border-[#E4E9DA] bg-white text-[#4A5246] text-[14px] font-medium hover:bg-[#F8FAF2] transition-colors flex items-center justify-center">
        2
    </button>
    <button aria-label="Halaman berikutnya" class="w-10 h-10 rounded-full border border-[#E4E9DA] bg-white flex items-center justify-center text-[#4A5246] hover:bg-[#F8FAF2] transition-colors">
        <span class="material-symbols-outlined text-[20px]">chevron_right</span>
    </button>
</div>

@push('scripts')
<script>
    document.getElementById('article-search')?.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase().trim();
        const cards = document.querySelectorAll('.article-card');
        cards.forEach(card => {
            const title = (card.getAttribute('data-title') || '').toLowerCase();
            if (!query || title.includes(query)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>
@endpush
@endsection
