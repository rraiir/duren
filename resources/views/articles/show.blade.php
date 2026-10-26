@extends('layouts.public')

@section('title', 'Cara Memilih Durian Matang - DuREN')

@section('content')
<div class="py-12 w-full grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
    <!-- KOLOM KIRI (8 COLS) -->
    <article class="lg:col-span-8 flex flex-col">
        <!-- Tautan Kembali -->
        <div class="mb-5">
            <a class="inline-flex items-center gap-1.5 text-[#7A6420] hover:underline text-[14px] font-medium transition-all group" href="{{ url('/artikel') }}">
                <span class="material-symbols-outlined text-[18px] transition-transform group-hover:-translate-x-0.5">arrow_back</span>
                <span>Kembali ke Artikel</span>
            </a>
        </div>

        <!-- Judul & Metadata -->
        <h1 class="text-[36px] md:text-[40px] font-bold leading-tight tracking-[-0.02em] text-[#1F261D] mb-3">
            Cara Memilih Durian Matang
        </h1>
        <div class="flex items-center gap-2 mb-8">
            <span class="material-symbols-outlined text-[#6B7366] text-[16px]">calendar_today</span>
            <span class="text-[14px] text-[#6B7366]">20 Okt 2026</span>
        </div>

        <!-- Sampul Ilustrasi Vektor Pastel Bersih -->
        <div class="w-full h-[320px] rounded-[20px] bg-[#F8FAF2] border border-[#E4E9DA] shadow-sm overflow-hidden relative flex items-center justify-center mb-10 select-none">
            <div class="absolute w-[260px] h-[260px] rounded-full bg-[#E8F3E1] -left-8 -bottom-10 pointer-events-none"></div>
            <div class="absolute w-[220px] h-[220px] rounded-full bg-[#FAF1CE] -right-4 -top-6 pointer-events-none"></div>
            <svg class="w-[280px] h-[220px] relative z-10 drop-shadow-sm" fill="none" viewBox="0 0 280 220" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="140" cy="195" fill="#E4E9DA" fill-opacity="0.8" rx="80" ry="12"></ellipse>
                <path d="M140 25 C136 40 134 52 138 68 C141 52 144 40 146 25 Z" fill="#4E6B43"></path>
                <circle cx="143" cy="24" fill="#3C5732" r="4.5"></circle>
                <path d="M85 105 L65 100 L84 116 L62 118 L83 130 L66 136 L86 148 L72 156 L95 165 L88 174 L110 178 L124 186 L140 188 L156 186 L170 178 L192 174 L185 165 L208 156 L194 148 L214 136 L197 130 L218 118 L196 116 L215 100 L195 105 L205 85 L186 92 L192 72 L174 82 L176 64 L160 76 L154 58 L140 70 L126 58 L120 76 L104 64 L106 82 L88 72 L94 92 L75 85 Z" fill="#CFE6C5" stroke="#B7D7A8" stroke-linejoin="round" stroke-width="2"></path>
                <path d="M96 115 C96 85 116 68 140 68 C164 68 184 85 184 115 C184 150 166 174 140 174 C114 174 96 150 96 115 Z" fill="#FFFFFF" stroke="#E4E9DA" stroke-width="2"></path>
                <path d="M104 115 C104 90 120 76 140 76 C160 76 176 90 176 115 C176 144 162 166 140 166 C118 166 104 144 104 115 Z" fill="#FAF1CE"></path>
                <g>
                    <ellipse cx="124" cy="118" fill="#FBEFB5" rx="15" ry="24" stroke="#ECDDA1" stroke-width="1.5" transform="rotate(-18 124 118)"></ellipse>
                    <ellipse cx="127" cy="128" fill="#FFF3C9" opacity="0.9" rx="5" ry="9" transform="rotate(-18 127 128)"></ellipse>
                </g>
                <g>
                    <ellipse cx="156" cy="118" fill="#FBEFB5" rx="15" ry="24" stroke="#ECDDA1" stroke-width="1.5" transform="rotate(18 156 118)"></ellipse>
                    <ellipse cx="153" cy="128" fill="#FFF3C9" opacity="0.9" rx="5" ry="9" transform="rotate(18 153 128)"></ellipse>
                </g>
                <g>
                    <ellipse cx="140" cy="136" fill="#FBEFB5" rx="14" ry="20" stroke="#ECDDA1" stroke-width="1.5"></ellipse>
                    <ellipse cx="140" cy="144" fill="#FFF3C9" opacity="0.9" rx="4.5" ry="7"></ellipse>
                </g>
            </svg>
        </div>

        <!-- Isi Artikel -->
        <div class="max-w-[720px] text-[#1F261D] text-[16px] leading-[26px]">
            <p class="mb-6">
                Mengenali tingkat kematangan buah durian utuh secara tepat sebelum dibuka merupakan langkah penting untuk mendapatkan kenikmatan rasa manis legit yang seimbang dengan tekstur daging buah yang lembut. Kematangan yang pas tidak hanya menentukan kelezatan aroma khasnya, tetapi juga menjamin kepuasan saat buah dinikmati bersama keluarga tanpa kekecewaan akibat buah yang masih mengkal atau justru lewat matang.
            </p>

            <h2 class="text-[20px] font-semibold text-[#1F261D] mt-8 mb-3">Perhatikan bentuk dan duri</h2>
            <p class="mb-6">
                Langkah pertama yang dapat dilakukan adalah mengamati geometri kulit luar buah. Durian yang matang alami umumnya memiliki susunan duri yang tampak lebih renggang, mekar, dan sedikit tumpul di bagian ujungnya, bukan duri yang rapat atau kaku meruncing rapat seperti durian mentah. Selain itu, pilihlah durian dengan bentuk bulat simetris dan proporsional, karena bentuk ini menandakan bahwa setiap kantung juring di dalam kulit terisi penuh oleh daging buah yang berkembang sempurna.
            </p>

            <h2 class="text-[20px] font-semibold text-[#1F261D] mt-8 mb-3">Cek aroma dan ketukan</h2>
            <p class="mb-6">
                Aroma merupakan indikator kematangan yang sangat terpercaya. Dekatkan hidung pada kulit buah, terutama pada bagian lekukan pangkal tangkai atau garis belahan juring. Durian yang siap konsumsi akan mengeluarkan aroma manis harum yang khas tanpa ada bau asam menyengat. Selain itu, lakukan tes ketukan menggunakan gagang pisau secara perlahan; durian yang matang akan menghasilkan suara ketukan yang sedikit kopong atau bergema lembut karena daging buah telah sedikit terlepas dari dinding cangkang dalam.
            </p>

            <h2 class="text-[20px] font-semibold text-[#1F261D] mt-8 mb-3">Pilih varian yang sesuai selera</h2>
            <p class="mb-6">
                Setiap varian durian memiliki profil rasa dan kelembutan yang berbeda. Jika Anda menyukai rasa manis legit yang dominan dengan daging buah yang tebal dan biji kempis, varian Montong merupakan pilihan tepat. Namun, jika Anda menyukai kombinasi rasa manis berpadu semburat pahit lembut dengan tekstur creamy pekat seperti mentega, Musang King atau Bawor adalah opsi yang patut dicoba. Pastikan Anda memilih varian yang tepat sesuai preferensi Anda.
            </p>
        </div>
    </article>

    <!-- KOLOM KANAN (4 COLS) -->
    <aside class="lg:col-span-4 flex flex-col gap-6 sticky top-28">
        <!-- KARTU 1: Artikel Lainnya -->
        <div class="duren-card p-6 bg-white border border-[#E4E9DA] rounded-[20px]">
            <h3 class="text-[20px] font-semibold text-[#1F261D] mb-5">
                Artikel Lainnya
            </h3>
            <div class="flex flex-col gap-4">
                <!-- Item 1 -->
                <a class="group flex items-center gap-4 p-2 -mx-2 rounded-[14px] hover:bg-[#F8FAF2] transition-colors" href="{{ url('/artikel/2') }}">
                    <div class="w-[56px] h-[56px] rounded-[12px] bg-[#E8F3E1] border border-[#E4E9DA] flex items-center justify-center shrink-0">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                            <ellipse cx="16" cy="18" fill="#F2D98A" rx="8" ry="9" stroke="#ECDDA1" stroke-width="1.2"></ellipse>
                        </svg>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="text-[14px] font-semibold text-[#1F261D] group-hover:text-[#7A6420] transition-colors line-clamp-2 leading-[19px]">
                            Mengenal Varian Montong dan Musang King
                        </span>
                        <span class="text-[12px] text-[#6B7366] mt-1">
                            18 Okt 2026
                        </span>
                    </div>
                </a>
                <div class="h-[1px] w-full bg-[#E4E9DA]"></div>

                <!-- Item 2 -->
                <a class="group flex items-center gap-4 p-2 -mx-2 rounded-[14px] hover:bg-[#F8FAF2] transition-colors" href="{{ url('/artikel/3') }}">
                    <div class="w-[56px] h-[56px] rounded-[12px] bg-[#FAF1CE] border border-[#ECDDA1] flex items-center justify-center shrink-0">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="18" fill="#F2D98A" r="8"></circle>
                        </svg>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="text-[14px] font-semibold text-[#1F261D] group-hover:text-[#7A6420] transition-colors line-clamp-2 leading-[19px]">
                            Cara Menyimpan Durian Utuh
                        </span>
                        <span class="text-[12px] text-[#6B7366] mt-1">
                            15 Okt 2026
                        </span>
                    </div>
                </a>
                <div class="h-[1px] w-full bg-[#E4E9DA]"></div>

                <!-- Item 3 -->
                <a class="group flex items-center gap-4 p-2 -mx-2 rounded-[14px] hover:bg-[#F8FAF2] transition-colors" href="{{ url('/artikel/4') }}">
                    <div class="w-[56px] h-[56px] rounded-[12px] bg-[#FFF3C9] border border-[#EEDFA6] flex items-center justify-center shrink-0">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                            <rect fill="#FBEFB5" height="12" rx="3" width="16" x="8" y="10"></rect>
                        </svg>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="text-[14px] font-semibold text-[#1F261D] group-hover:text-[#7A6420] transition-colors line-clamp-2 leading-[19px]">
                            Ready Stock dan Pre-Order: Apa Bedanya?
                        </span>
                        <span class="text-[12px] text-[#6B7366] mt-1">
                            12 Okt 2026
                        </span>
                    </div>
                </a>
            </div>
        </div>

        <!-- KARTU 2: Ajakan Pemesanan -->
        <div class="rounded-[20px] bg-[#E3F1DC] p-6 border border-[#C3DCAF] shadow-sm flex flex-col">
            <div class="w-10 h-10 rounded-[12px] bg-white flex items-center justify-center mb-4 shadow-sm">
                <span class="material-symbols-outlined text-[#4E6B43] text-[22px]">eco</span>
            </div>
            <h4 class="text-[20px] font-semibold text-[#1F3318] mb-1">Siap memesan?</h4>
            <p class="text-[14px] text-[#3F5B34] mb-5">Masuk untuk melihat katalog durian.</p>
            <a class="w-full h-10 rounded-[14px] bg-[#F2D98A] hover:brightness-95 text-[#1F261D] font-semibold text-[14px] flex items-center justify-center transition-all shadow-sm" href="{{ url('/login') }}">
                Masuk
            </a>
        </div>
    </aside>
</div>
@endsection
