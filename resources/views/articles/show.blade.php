@extends('layouts.public')

@section('title', $article->title . ' - DuREN')

@section('content')
<div class="py-12 w-full grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
    <!-- KOLOM KIRI (8 COLS) -->
    <article class="lg:col-span-8 flex flex-col">
        <!-- Tautan Kembali -->
        <div class="mb-5">
            <a class="inline-flex items-center gap-1.5 text-[#7A6420] hover:underline text-[14px] font-medium transition-all group" href="{{ route('articles.index') }}">
                <span class="material-symbols-outlined text-[18px] transition-transform group-hover:-translate-x-0.5">arrow_back</span>
                <span>Kembali ke Artikel</span>
            </a>
        </div>

        <!-- Judul & Metadata -->
        <h1 class="text-[36px] md:text-[40px] font-bold leading-tight tracking-[-0.02em] text-[#1F261D] mb-3">
            {{ $article->title }}
        </h1>
        <div class="flex items-center gap-2 mb-8">
            <span class="material-symbols-outlined text-[#6B7366] text-[16px]">calendar_today</span>
            <span class="text-[14px] text-[#6B7366]">
                {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
            </span>
        </div>

        <!-- Sampul Ilustrasi / Gambar -->
        <div class="w-full h-[320px] rounded-[20px] bg-[#F8FAF2] border border-[#E4E9DA] shadow-xs overflow-hidden relative flex items-center justify-center mb-10 select-none">
            @if ($article->cover_path)
                <img src="{{ asset('storage/' . $article->cover_path) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
            @else
                <div class="absolute w-[260px] h-[260px] rounded-full bg-[#E8F3E1] -left-8 -bottom-10 pointer-events-none"></div>
                <div class="absolute w-[220px] h-[220px] rounded-full bg-[#FAF1CE] -right-4 -top-6 pointer-events-none"></div>
                <svg class="w-[280px] h-[220px] relative z-10 drop-shadow-xs" fill="none" viewBox="0 0 280 220" xmlns="http://www.w3.org/2000/svg">
                    <ellipse cx="140" cy="195" fill="#E4E9DA" fill-opacity="0.8" rx="80" ry="12"></ellipse>
                    <path d="M140 25 C136 40 134 52 138 68 C141 52 144 40 146 25 Z" fill="#4E6B43"></path>
                    <path d="M85 105 L65 100 L84 116 L62 118 L83 130 L66 136 L86 148 L72 156 L95 165 L88 174 L110 178 L124 186 L140 188 L156 186 L170 178 L192 174 L185 165 L208 156 L194 148 L214 136 L197 130 L218 118 L196 116 L215 100 L195 105 L205 85 L186 92 L192 72 L174 82 L176 64 L160 76 L154 58 L140 70 L126 58 L120 76 L104 64 L106 82 L88 72 L94 92 L75 85 Z" fill="#CFE6C5" stroke="#B7D7A8" stroke-linejoin="round" stroke-width="2"></path>
                    <path d="M96 115 C96 85 116 68 140 68 C164 68 184 85 184 115 C184 150 166 174 140 174 C114 174 96 150 96 115 Z" fill="#FFFFFF" stroke="#E4E9DA" stroke-width="2"></path>
                    <ellipse cx="124" cy="118" fill="#FBEFB5" rx="15" ry="24" stroke="#ECDDA1" stroke-width="1.5" transform="rotate(-18 124 118)"></ellipse>
                    <ellipse cx="156" cy="118" fill="#FBEFB5" rx="15" ry="24" stroke="#ECDDA1" stroke-width="1.5" transform="rotate(18 156 118)"></ellipse>
                </svg>
            @endif
        </div>

        <!-- Isi Artikel (Paragraf demi paragraf) -->
        <div class="max-w-[720px] text-[#1F261D] text-[16px] leading-[28px] space-y-5">
            @foreach (preg_split('/\r\n\r\n|\n\n/', $article->body) as $paragraph)
                @if (trim($paragraph))
                    <p class="text-[#333C30]">{{ trim($paragraph) }}</p>
                @endif
            @endforeach
        </div>
    </article>

    <!-- KOLOM KANAN / SIDEBAR (4 COLS) -->
    <aside class="lg:col-span-4 flex flex-col gap-8 w-full sticky top-[96px]">
        @if ($relatedArticles->isNotEmpty())
            <!-- KARTU 1: Artikel Lainnya -->
            <div class="rounded-[20px] bg-white p-6 border border-[#E4E9DA] shadow-xs flex flex-col">
                <h3 class="text-[18px] font-bold text-[#1F261D] mb-4">Artikel Lainnya</h3>
                <div class="flex flex-col gap-4">
                    @foreach ($relatedArticles as $ra)
                        <a class="group flex items-center gap-4 p-2 -mx-2 rounded-[14px] hover:bg-[#F8FAF2] transition-colors" href="{{ route('articles.show', $ra->id) }}">
                            <div class="w-[56px] h-[56px] rounded-[12px] bg-[#E8F3E1] border border-[#CFE6C5] flex items-center justify-center shrink-0 overflow-hidden">
                                @if ($ra->cover_path)
                                    <img src="{{ asset('storage/' . $ra->cover_path) }}" alt="{{ $ra->title }}" class="w-full h-full object-cover">
                                @else
                                    <span class="material-symbols-outlined text-[24px] text-[#4E6B43]">article</span>
                                @endif
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="text-[14px] font-semibold text-[#1F261D] group-hover:text-[#7A6420] transition-colors line-clamp-2 leading-[19px]">
                                    {{ $ra->title }}
                                </span>
                                <span class="text-[12px] text-[#6B7366] mt-1">
                                    {{ $ra->published_at ? $ra->published_at->format('d M Y') : $ra->created_at->format('d M Y') }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- KARTU 2: Ajakan Pemesanan -->
        <div class="rounded-[20px] bg-[#E3F1DC] p-6 border border-[#C3DCAF] shadow-xs flex flex-col">
            <div class="w-10 h-10 rounded-[12px] bg-white flex items-center justify-center mb-4 shadow-xs">
                <span class="material-symbols-outlined text-[#4E6B43] text-[22px]">eco</span>
            </div>
            <h4 class="text-[20px] font-semibold text-[#1F3318] mb-1">Siap memesan?</h4>
            <p class="text-[14px] text-[#3F5B34] mb-5">Masuk untuk melihat katalog durian.</p>
            <a class="w-full h-10 rounded-[14px] bg-[#F2D98A] hover:brightness-95 text-[#1F261D] font-semibold text-[14px] flex items-center justify-center transition-all shadow-xs" href="{{ url('/login') }}">
                Masuk
            </a>
        </div>
    </aside>
</div>
@endsection
