@extends('layouts.app')

@section('title', 'Kelola Artikel - DuREN')

@section('content')
<div class="space-y-6">
    <!-- 1. KEPALA HALAMAN -->
    <div class="flex items-center justify-between pb-2">
        <div class="flex flex-col">
            <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">Kelola Artikel</h1>
            <p class="text-[16px] leading-[22px] text-[#6B7366] mt-1">Tulis dan atur artikel untuk pengunjung.</p>
        </div>
        <button class="h-12 px-6 rounded-[14px] bg-[#F2D98A] text-[#1F261D] font-semibold text-[16px] shadow-[0_8px_24px_rgba(40,52,30,0.08)] hover:bg-[#ECDDA1] transition-colors flex items-center gap-2 cursor-pointer" id="btn-open-drawer" type="button" onclick="openDrawerCreate()">
            <span class="material-symbols-outlined text-[20px]">add</span>
            <span>Tulis Artikel</span>
        </button>
    </div>

    @if (session('success'))
        <div class="p-4 rounded-[14px] bg-[#E3F1DC] border border-[#CFE6C5] text-[#1F3318] text-[14px] flex items-center gap-2.5 shadow-xs">
            <span class="material-symbols-outlined text-[20px] text-[#3F5B34]">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 rounded-[14px] bg-[#FBDDC6] border border-[#EFC3A3] text-[#8C4A1A] text-[14px] shadow-xs">
            <div class="flex items-center gap-2 font-semibold mb-1">
                <span class="material-symbols-outlined text-[20px]">error</span>
                <span>Terjadi kesalahan pengisian form:</span>
            </div>
            <ul class="list-disc list-inside text-[13px] space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- 2. KARTU FILTER & PENCARIAN -->
    @php
        $currentFilter = request('filter');
    @endphp
    <div class="rounded-[20px] border border-[#E4E9DA] bg-white shadow-[0_8px_24px_rgba(40,52,30,0.06)] px-6 py-5 flex items-center justify-between">
        <!-- Kotak Pencarian -->
        <form method="GET" action="{{ route('admin.articles') }}" class="relative w-[320px]">
            @if(request('filter'))
                <input type="hidden" name="filter" value="{{ request('filter') }}">
            @endif
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#7A8275] text-[20px]">search</span>
            <input class="w-full h-12 pl-11 pr-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] transition-colors" name="search" placeholder="Cari judul artikel" type="text" value="{{ request('search') }}">
        </form>
        <!-- Status Filter Chips -->
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.articles', array_filter(['search' => request('search')])) }}" class="h-[38px] px-5 rounded-full text-[14px] {{ empty($currentFilter) ? 'bg-[#E8F3E1] text-[#1F3318] font-semibold border border-[#CFE6C5]' : 'bg-white border border-[#E4E9DA] text-[#4A5246] hover:bg-[#F8FAF2] font-medium' }} transition-all flex items-center shadow-xs cursor-pointer">
                Semua
            </a>
            <a href="{{ route('admin.articles', array_filter(['filter' => 'terbit', 'search' => request('search')])) }}" class="h-[38px] px-5 rounded-full text-[14px] {{ $currentFilter === 'terbit' ? 'bg-[#E8F3E1] text-[#1F3318] font-semibold border border-[#CFE6C5]' : 'bg-white border border-[#E4E9DA] text-[#4A5246] hover:bg-[#F8FAF2] font-medium' }} transition-all flex items-center cursor-pointer">
                Terbit
            </a>
            <a href="{{ route('admin.articles', array_filter(['filter' => 'draft', 'search' => request('search')])) }}" class="h-[38px] px-5 rounded-full text-[14px] {{ $currentFilter === 'draft' ? 'bg-[#E8F3E1] text-[#1F3318] font-semibold border border-[#CFE6C5]' : 'bg-white border border-[#E4E9DA] text-[#4A5246] hover:bg-[#F8FAF2] font-medium' }} transition-all flex items-center cursor-pointer">
                Draft
            </a>
        </div>
    </div>

    <!-- 3. KARTU TABEL ARTIKEL -->
    <div class="rounded-[20px] border border-[#E4E9DA] bg-white shadow-[0_8px_24px_rgba(40,52,30,0.06)] overflow-hidden">
        <!-- Table Header Row -->
        <div class="h-[52px] bg-[#F8FAF2] border-b border-[#E4E9DA] px-6 flex items-center text-[14px] font-semibold text-[#6B7366]">
            <div class="flex-1 min-w-0">Artikel</div>
            <div class="w-[160px] shrink-0">Tanggal</div>
            <div class="w-[140px] shrink-0">Status</div>
            <div class="w-[120px] shrink-0 text-right">Aksi</div>
        </div>

        <!-- Table Rows Container -->
        <div class="divide-y divide-[#E4E9DA]" id="article-table-body">
            @forelse ($articles as $a)
                <div class="article-row h-[76px] px-6 flex items-center hover:bg-[#F8FAF2] transition-colors">
                    <div class="flex-1 min-w-0 flex items-center gap-4 pr-4">
                        <div class="w-14 h-14 rounded-[14px] bg-[#E8F3E1] flex items-center justify-center shrink-0 border border-[#B7D7A8]/40 overflow-hidden">
                            @if ($a->cover_path)
                                <img src="{{ asset('storage/' . $a->cover_path) }}" alt="{{ $a->title }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-9 h-9" fill="none" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 6C13.5 6 8 13.5 8 22C8 28.5 13.5 34 20 34C26.5 34 32 28.5 32 22C32 13.5 26.5 6 20 6Z" fill="#CDEBD9"></path>
                                    <path d="M20 10C16 10 12 15 12 21C12 26 16 29 20 29C24 29 28 26 28 21C28 15 24 10 20 10Z" fill="#FBEFB5"></path>
                                    <circle cx="17" cy="20" fill="#EFC3A3" r="2.5"></circle>
                                    <circle cx="23" cy="22" fill="#EFC3A3" r="2.5"></circle>
                                </svg>
                            @endif
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="font-semibold text-[14px] text-[#1F261D] truncate">{{ $a->title }}</span>
                            <span class="text-[12px] text-[#6B7366] truncate">{{ $a->summary }}</span>
                        </div>
                    </div>
                    <div class="w-[160px] shrink-0 text-[14px] text-[#4A5246]">
                        {{ $a->published_at ? $a->published_at->format('d M Y') : $a->created_at->format('d M Y') }}
                    </div>
                    <div class="w-[140px] shrink-0">
                        <x-badge-status :type="$a->is_published ? 'terbit' : 'draft'" />
                    </div>
                    <div class="w-[120px] shrink-0 flex items-center justify-end gap-2">
                        <button aria-label="Edit artikel" class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-center text-[#4A5246] hover:bg-white hover:text-[#1F261D] transition-colors cursor-pointer" type="button" onclick="openDrawerEdit('{{ $a->id }}', '{{ addslashes($a->title) }}', '{{ addslashes($a->summary) }}', '{{ addslashes(str_replace(["\r", "\n"], ['\\r', '\\n'], $a->body)) }}', {{ $a->is_published ? 'true' : 'false' }})">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                        </button>
                        <form method="POST" action="{{ route('admin.articles.destroy', $a->id) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                            @csrf
                            @method('DELETE')
                            <button aria-label="Hapus artikel" class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-center text-[#4A5246] hover:bg-[#FFDAD6] hover:text-[#BA1A1A] transition-colors cursor-pointer" type="submit">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-[#6B7366]">
                    Belum ada artikel yang sesuai kriteria.
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Drawer Backdrop -->
<div class="fixed inset-0 bg-[#1F261D]/25 backdrop-blur-[1px] z-40 hidden transition-opacity opacity-0" id="drawer-backdrop" onclick="closeDrawer()"></div>

<!-- Write / Edit Article Drawer Side Panel (480px wide) -->
<aside class="fixed top-0 right-0 bottom-0 w-[480px] bg-white z-50 shadow-[-8px_0_32px_rgba(40,52,30,0.12)] border-l border-[#E4E9DA] flex flex-col h-full translate-x-full transition-transform duration-300 ease-out" id="drawer-panel">
    <!-- Drawer Header -->
    <div class="h-[72px] px-8 border-b border-[#E4E9DA] flex items-center justify-between shrink-0">
        <h2 class="text-[20px] font-semibold text-[#1F261D]" id="drawer-title">Tulis Artikel</h2>
        <button class="w-9 h-9 rounded-[12px] border border-[#E4E9DA] bg-white flex items-center justify-center text-[#4A5246] hover:bg-[#F8FAF2] transition-colors cursor-pointer" id="btn-close-drawer" onclick="closeDrawer()" type="button">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
    </div>

    <!-- Drawer Body Form -->
    <form id="articleForm" method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data" class="flex-1 flex flex-col justify-between overflow-hidden">
        @csrf
        <input type="hidden" name="_method" id="articleFormMethod" value="POST">
        <input type="hidden" name="is_published" id="inputIsPublishedHidden" value="1">

        <div class="flex-1 overflow-y-auto p-8 space-y-5">
            <!-- Field: Judul -->
            <div class="flex flex-col gap-1.5">
                <label class="text-[14px] font-medium text-[#1F261D]" for="input-article-title">Judul</label>
                <input class="h-12 px-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] transition-colors" id="input-article-title" name="title" placeholder="Masukkan judul artikel" type="text" required>
            </div>

            <!-- Field: Ringkasan -->
            <div class="flex flex-col gap-1.5">
                <label class="text-[14px] font-medium text-[#1F261D]" for="input-article-summary">Ringkasan</label>
                <textarea class="min-h-[72px] p-3 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] resize-none transition-colors" id="input-article-summary" name="summary" placeholder="Tulis ringkasan singkat artikel..." rows="2" required></textarea>
            </div>

            <!-- Field: Gambar Sampul -->
            <div class="flex flex-col gap-1.5">
                <label class="text-[14px] font-medium text-[#1F261D]">Gambar sampul</label>
                <label for="cover_file" class="border-2 border-dashed border-[#B7D7A8] bg-[#F8FAF2] rounded-[16px] h-[110px] flex flex-col items-center justify-center cursor-pointer hover:bg-[#F1F5E8] transition-colors group">
                    <span class="material-symbols-outlined text-[26px] text-[#4E6B43] group-hover:scale-105 transition-transform">image</span>
                    <span class="text-[13px] font-medium text-[#1F261D] mt-1" id="coverFileName">Klik untuk memilih gambar</span>
                    <span class="text-[11px] text-[#6B7366] mt-0.5">JPG atau PNG, maksimal 2 MB</span>
                    <input type="file" name="cover" id="cover_file" class="hidden" accept="image/jpeg,image/png,image/jpg" onchange="handleCoverChange(this)">
                </label>
            </div>

            <!-- Field: Isi Artikel -->
            <div class="flex flex-col gap-1.5">
                <label class="text-[14px] font-medium text-[#1F261D]" for="input-article-content">Isi artikel</label>
                <textarea class="h-[180px] p-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] resize-none transition-colors" id="input-article-content" name="body" placeholder="Tulis isi lengkap artikel di sini (paragraf dipisah baris kosong)..." required></textarea>
            </div>

            <!-- Switch Terbitkan -->
            <div class="flex items-center justify-between py-2 border-t border-[#E4E9DA]">
                <div>
                    <span class="text-[14px] font-medium text-[#1F261D] block">Terbitkan</span>
                    <span class="text-[12px] text-[#6B7366]">Langsung tampilkan di arsip artikel</span>
                </div>
                <button aria-checked="true" class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-[#4E6B43] transition-colors duration-200 ease-in-out focus:outline-none" id="btn-toggle-publish" onclick="togglePublishState()" role="switch" type="button">
                    <span class="pointer-events-none inline-block h-5 w-5 translate-x-5 transform rounded-full bg-white shadow-xs ring-0 transition duration-200 ease-in-out" id="toggle-dot"></span>
                </button>
            </div>
        </div>

        <!-- Drawer Footer Actions -->
        <div class="p-6 border-t border-[#E4E9DA] bg-white flex gap-3 shrink-0">
            <button class="flex-1 h-12 rounded-[14px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] font-medium hover:bg-[#F8FAF2] transition-colors cursor-pointer" onclick="closeDrawer()" type="button">
                Batal
            </button>
            <button class="flex-1 h-12 rounded-[14px] bg-[#F2D98A] text-[#1F261D] text-[14px] font-semibold hover:bg-[#ECDDA1] transition-colors cursor-pointer shadow-xs" type="submit">
                Simpan
            </button>
        </div>
    </form>
</aside>

@push('scripts')
<script>
    const backdrop = document.getElementById('drawer-backdrop');
    const drawer = document.getElementById('drawer-panel');
    const drawerTitle = document.getElementById('drawer-title');
    const form = document.getElementById('articleForm');
    const methodInput = document.getElementById('articleFormMethod');
    const inputTitle = document.getElementById('input-article-title');
    const inputSummary = document.getElementById('input-article-summary');
    const inputContent = document.getElementById('input-article-content');
    const toggleBtn = document.getElementById('btn-toggle-publish');
    const toggleDot = document.getElementById('toggle-dot');
    const inputIsPublishedHidden = document.getElementById('inputIsPublishedHidden');
    const coverFileName = document.getElementById('coverFileName');

    let isPublished = true;

    function openDrawer() {
        backdrop.classList.remove('hidden');
        requestAnimationFrame(() => {
            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');
            drawer.classList.remove('translate-x-full');
            drawer.classList.add('translate-x-0');
        });
    }

    function closeDrawer() {
        drawer.classList.remove('translate-x-0');
        drawer.classList.add('translate-x-full');
        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        setTimeout(() => {
            backdrop.classList.add('hidden');
        }, 300);
    }

    function openDrawerCreate() {
        drawerTitle.textContent = 'Tulis Artikel';
        form.action = '{{ route("admin.articles.store") }}';
        methodInput.value = 'POST';
        inputTitle.value = '';
        inputSummary.value = '';
        inputContent.value = '';
        coverFileName.textContent = 'Klik untuk memilih gambar';
        setPublishState(true);
        openDrawer();
    }

    function openDrawerEdit(id, title, summary, body, published) {
        drawerTitle.textContent = 'Ubah Artikel';
        form.action = '{{ url("/admin/artikel") }}/' + id;
        methodInput.value = 'PUT';
        inputTitle.value = title;
        inputSummary.value = summary;
        inputContent.value = body.replace(/\\r\\n/g, '\n').replace(/\\n/g, '\n');
        coverFileName.textContent = 'Klik jika ingin mengganti gambar';
        setPublishState(published);
        openDrawer();
    }

    function setPublishState(state) {
        isPublished = state;
        inputIsPublishedHidden.value = isPublished ? '1' : '0';
        toggleBtn.setAttribute('aria-checked', String(isPublished));
        if (isPublished) {
            toggleBtn.classList.remove('bg-[#E2E2E2]');
            toggleBtn.classList.add('bg-[#4E6B43]');
            toggleDot.classList.remove('translate-x-0');
            toggleDot.classList.add('translate-x-5');
        } else {
            toggleBtn.classList.remove('bg-[#4E6B43]');
            toggleBtn.classList.add('bg-[#E2E2E2]');
            toggleDot.classList.remove('translate-x-5');
            toggleDot.classList.add('translate-x-0');
        }
    }

    function togglePublishState() {
        setPublishState(!isPublished);
    }

    function handleCoverChange(input) {
        if (input.files && input.files[0]) {
            coverFileName.textContent = input.files[0].name;
        }
    }
</script>
@endpush
@endsection
