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
        <form method="GET" action="{{ route('articles.index') }}" class="relative w-full">
            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[#7A8275] text-[20px] pointer-events-none">
                search
            </span>
            <input class="w-full h-12 pl-11 pr-4 bg-white border border-[#E4E9DA] rounded-[14px] text-[14px] text-[#1F261D] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] transition-all shadow-xs" name="search" placeholder="Cari artikel..." type="text" value="{{ request('search') }}">
        </form>
    </div>
</section>

<!-- GRID KARTU ARTIKEL (3 Kolom) -->
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="article-grid">
    @forelse ($articles as $a)
        <article class="article-card duren-card p-5 flex flex-col justify-between group">
            <div>
                <div class="h-40 w-full rounded-[14px] bg-[#E8F3E1] flex items-center justify-center relative overflow-hidden mb-4">
                    @if ($a->cover_path)
                        <img src="{{ asset('storage/' . $a->cover_path) }}" alt="{{ $a->title }}" class="w-full h-full object-cover">
                    @else
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
                    @endif
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-[12px] font-medium text-[#6B7366]">
                        {{ $a->published_at ? $a->published_at->format('d M Y') : $a->created_at->format('d M Y') }}
                    </span>
                </div>
                <h2 class="mt-2 text-[20px] font-semibold text-[#1F261D] line-clamp-2 group-hover:text-[#7A6420] transition-colors leading-[28px]">
                    {{ $a->title }}
                </h2>
                <p class="mt-2 text-[14px] text-[#4A5246] line-clamp-2 leading-[20px]">
                    {{ $a->summary }}
                </p>
            </div>
            <div class="mt-4 pt-3 flex items-center justify-between border-t border-[#E4E9DA]">
                <a class="inline-flex items-center gap-1.5 text-[#7A6420] text-[14px] font-semibold hover:gap-2.5 transition-all" href="{{ route('articles.show', $a->id) }}">
                    <span>Baca selengkapnya</span>
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
            </div>
        </article>
    @empty
        <div class="col-span-3 text-center py-12 text-[#6B7366]">
            Tidak ada artikel yang sesuai dengan pencarian Anda.
        </div>
    @endforelse
</section>

@if ($articles->hasPages())
    <div class="mt-12 flex justify-center">
        {{ $articles->links() }}
    </div>
@endif
@endsection
