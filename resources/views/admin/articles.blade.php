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
        <button class="h-12 px-6 rounded-[14px] bg-[#F2D98A] text-[#1F261D] font-semibold text-[16px] shadow-[0_8px_24px_rgba(40,52,30,0.08)] hover:bg-[#ECDDA1] transition-colors flex items-center gap-2 cursor-pointer" id="btn-open-drawer" type="button">
            <span class="material-symbols-outlined text-[20px]">add</span>
            <span>Tulis Artikel</span>
        </button>
    </div>

    <!-- 2. KARTU FILTER & PENCARIAN -->
    <div class="rounded-[20px] border border-[#E4E9DA] bg-white shadow-[0_8px_24px_rgba(40,52,30,0.06)] px-6 py-5 flex items-center justify-between">
        <!-- Kotak Pencarian -->
        <div class="relative w-[320px]">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#7A8275] text-[20px]">search</span>
            <input class="w-full h-12 pl-11 pr-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] transition-colors" id="search-input" placeholder="Cari judul artikel" type="text">
        </div>
        <!-- Status Filter Chips -->
        <div class="flex items-center gap-2" id="status-chips">
            <button class="chip-btn h-[38px] px-5 rounded-full text-[14px] font-medium bg-[#E8F3E1] text-[#1F3318] border border-transparent transition-all cursor-pointer" data-filter="all" type="button">
                Semua
            </button>
            <button class="chip-btn h-[38px] px-5 rounded-full text-[14px] font-medium bg-white border border-[#E4E9DA] text-[#4A5246] hover:bg-[#F8FAF2] transition-all cursor-pointer" data-filter="terbit" type="button">
                Terbit
            </button>
            <button class="chip-btn h-[38px] px-5 rounded-full text-[14px] font-medium bg-white border border-[#E4E9DA] text-[#4A5246] hover:bg-[#F8FAF2] transition-all cursor-pointer" data-filter="draft" type="button">
                Draft
            </button>
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
            <!-- Row 1 -->
            <div class="article-row h-[76px] px-6 flex items-center hover:bg-[#F8FAF2] transition-colors" data-status="terbit" data-title="Cara Memilih Durian Matang">
                <div class="flex-1 min-w-0 flex items-center gap-4 pr-4">
                    <div class="w-14 h-14 rounded-[14px] bg-[#E8F3E1] flex items-center justify-center shrink-0 border border-[#B7D7A8]/40 overflow-hidden">
                        <svg class="w-9 h-9" fill="none" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 6C13.5 6 8 13.5 8 22C8 28.5 13.5 34 20 34C26.5 34 32 28.5 32 22C32 13.5 26.5 6 20 6Z" fill="#CDEBD9"></path>
                            <path d="M20 10C16 10 12 15 12 21C12 26 16 29 20 29C24 29 28 26 28 21C28 15 24 10 20 10Z" fill="#FBEFB5"></path>
                            <circle cx="17" cy="20" fill="#EFC3A3" r="2.5"></circle>
                            <circle cx="23" cy="22" fill="#EFC3A3" r="2.5"></circle>
                        </svg>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="font-semibold text-[14px] text-[#1F261D] truncate">Cara Memilih Durian Matang</span>
                        <span class="text-[12px] text-[#6B7366] truncate">Kenali tanda durian yang siap dinikmati sebelum membeli.</span>
                    </div>
                </div>
                <div class="w-[160px] shrink-0 text-[14px] text-[#4A5246]">20 Okt 2026</div>
                <div class="w-[140px] shrink-0">
                    <x-badge-status type="terbit" />
                </div>
                <div class="w-[120px] shrink-0 flex items-center justify-end gap-2">
                    <button aria-label="Edit artikel" class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-center text-[#4A5246] hover:bg-[#E8E8E8] transition-colors cursor-pointer" type="button" onclick="openDrawerEdit('Cara Memilih Durian Matang', 'Kenali tanda durian yang siap dinikmati sebelum membeli.', true)">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                    </button>
                    <button aria-label="Hapus artikel" class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-center text-[#4A5246] hover:bg-[#FFDAD6] hover:text-[#BA1A1A] transition-colors cursor-pointer" type="button">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                    </button>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="article-row h-[76px] px-6 flex items-center hover:bg-[#F8FAF2] transition-colors" data-status="terbit" data-title="Mengenal Varian Montong dan Musang King">
                <div class="flex-1 min-w-0 flex items-center gap-4 pr-4">
                    <div class="w-14 h-14 rounded-[14px] bg-[#FBEFB5] flex items-center justify-center shrink-0 border border-[#ECDDA1]/60 overflow-hidden">
                        <svg class="w-9 h-9" fill="none" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 20C12 14 16 9 20 9C24 9 28 14 28 20C28 26 24 31 20 31C16 31 12 26 12 20Z" fill="#F2D98A"></path>
                            <path d="M16 19C16 15 18 12 20 12C22 12 24 15 24 19C24 23 22 27 20 27C18 27 16 23 16 19Z" fill="#FFF3C9"></path>
                            <circle cx="20" cy="18" fill="#705e1c" opacity="0.3" r="2"></circle>
                        </svg>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="font-semibold text-[14px] text-[#1F261D] truncate">Mengenal Varian Montong dan Musang King</span>
                        <span class="text-[12px] text-[#6B7366] truncate">Perbedaan rasa, tekstur, dan ukuran dua varian populer.</span>
                    </div>
                </div>
                <div class="w-[160px] shrink-0 text-[14px] text-[#4A5246]">18 Okt 2026</div>
                <div class="w-[140px] shrink-0">
                    <x-badge-status type="terbit" />
                </div>
                <div class="w-[120px] shrink-0 flex items-center justify-end gap-2">
                    <button aria-label="Edit artikel" class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-center text-[#4A5246] hover:bg-[#E8E8E8] transition-colors cursor-pointer" type="button" onclick="openDrawerEdit('Mengenal Varian Montong dan Musang King', 'Perbedaan rasa, tekstur, dan ukuran dua varian populer.', true)">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                    </button>
                    <button aria-label="Hapus artikel" class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-center text-[#4A5246] hover:bg-[#FFDAD6] hover:text-[#BA1A1A] transition-colors cursor-pointer" type="button">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                    </button>
                </div>
            </div>

            <!-- Row 3 -->
            <div class="article-row h-[76px] px-6 flex items-center hover:bg-[#F8FAF2] transition-colors" data-status="terbit" data-title="Cara Menyimpan Durian Utuh">
                <div class="flex-1 min-w-0 flex items-center gap-4 pr-4">
                    <div class="w-14 h-14 rounded-[14px] bg-[#FFF3C9] flex items-center justify-center shrink-0 border border-[#EEDFA6] overflow-hidden">
                        <svg class="w-9 h-9" fill="none" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                            <rect fill="#FBEFB5" height="18" rx="6" width="20" x="10" y="12"></rect>
                            <path d="M20 7V12" stroke="#5C4A12" stroke-linecap="round" stroke-width="2"></path>
                            <path d="M15 21C15 18 20 18 20 21C20 24 25 24 25 21" stroke="#CFE6C5" stroke-linecap="round" stroke-width="2"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="font-semibold text-[14px] text-[#1F261D] truncate">Cara Menyimpan Durian Utuh</span>
                        <span class="text-[12px] text-[#6B7366] truncate">Tips menyimpan durian agar tetap segar lebih lama.</span>
                    </div>
                </div>
                <div class="w-[160px] shrink-0 text-[14px] text-[#4A5246]">15 Okt 2026</div>
                <div class="w-[140px] shrink-0">
                    <x-badge-status type="terbit" />
                </div>
                <div class="w-[120px] shrink-0 flex items-center justify-end gap-2">
                    <button aria-label="Edit artikel" class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-center text-[#4A5246] hover:bg-[#E8E8E8] transition-colors cursor-pointer" type="button" onclick="openDrawerEdit('Cara Menyimpan Durian Utuh', 'Tips menyimpan durian agar tetap segar lebih lama.', true)">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                    </button>
                    <button aria-label="Hapus artikel" class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-center text-[#4A5246] hover:bg-[#FFDAD6] hover:text-[#BA1A1A] transition-colors cursor-pointer" type="button">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                    </button>
                </div>
            </div>

            <!-- Row 4 -->
            <div class="article-row h-[76px] px-6 flex items-center hover:bg-[#F8FAF2] transition-colors" data-status="draft" data-title="Ready Stock dan Pre-Order: Apa Bedanya?">
                <div class="flex-1 min-w-0 flex items-center gap-4 pr-4">
                    <div class="w-14 h-14 rounded-[14px] bg-[#CDEBD9] flex items-center justify-center shrink-0 border border-[#ABD9C0] overflow-hidden">
                        <svg class="w-9 h-9" fill="none" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="20" cy="20" fill="#E8F3E1" r="12"></circle>
                            <path d="M14 20C14 16 17 14 20 14C23 14 26 16 26 20C26 24 23 26 20 26" stroke="#4E6B43" stroke-linecap="round" stroke-width="2"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="font-semibold text-[14px] text-[#1F261D] truncate">Ready Stock dan Pre-Order: Apa Bedanya?</span>
                        <span class="text-[12px] text-[#6B7366] truncate">Penjelasan dua jenis stok dan kapan durian sampai.</span>
                    </div>
                </div>
                <div class="w-[160px] shrink-0 text-[14px] text-[#4A5246]">12 Okt 2026</div>
                <div class="w-[140px] shrink-0">
                    <x-badge-status type="draft" />
                </div>
                <div class="w-[120px] shrink-0 flex items-center justify-end gap-2">
                    <button aria-label="Edit artikel" class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-center text-[#4A5246] hover:bg-[#E8E8E8] transition-colors cursor-pointer" type="button" onclick="openDrawerEdit('Ready Stock dan Pre-Order: Apa Bedanya?', 'Penjelasan dua jenis stok dan kapan durian sampai.', false)">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                    </button>
                    <button aria-label="Hapus artikel" class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-center text-[#4A5246] hover:bg-[#FFDAD6] hover:text-[#BA1A1A] transition-colors cursor-pointer" type="button">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                    </button>
                </div>
            </div>

            <!-- Row 5 -->
            <div class="article-row h-[76px] px-6 flex items-center hover:bg-[#F8FAF2] transition-colors" data-status="draft" data-title="Ukuran S, M, L: Mana yang Cocok?">
                <div class="flex-1 min-w-0 flex items-center gap-4 pr-4">
                    <div class="w-14 h-14 rounded-[14px] bg-[#FBDDC6] flex items-center justify-center shrink-0 border border-[#EFC3A3] overflow-hidden">
                        <svg class="w-9 h-9" fill="none" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="22" fill="#FBDDC6" r="6" stroke="#EFC3A3" stroke-width="2"></circle>
                            <circle cx="25" cy="18" fill="#FBEFB5" r="8" stroke="#ECDDA1" stroke-width="2"></circle>
                        </svg>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="font-semibold text-[14px] text-[#1F261D] truncate">Ukuran S, M, L: Mana yang Cocok?</span>
                        <span class="text-[12px] text-[#6B7366] truncate">Panduan memilih ukuran sesuai jumlah orang.</span>
                    </div>
                </div>
                <div class="w-[160px] shrink-0 text-[14px] text-[#4A5246]">9 Okt 2026</div>
                <div class="w-[140px] shrink-0">
                    <x-badge-status type="draft" />
                </div>
                <div class="w-[120px] shrink-0 flex items-center justify-end gap-2">
                    <button aria-label="Edit artikel" class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-center text-[#4A5246] hover:bg-[#E8E8E8] transition-colors cursor-pointer" type="button" onclick="openDrawerEdit('Ukuran S, M, L: Mana yang Cocok?', 'Panduan memilih ukuran sesuai jumlah orang.', false)">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                    </button>
                    <button aria-label="Hapus artikel" class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] flex items-center justify-center text-[#4A5246] hover:bg-[#FFDAD6] hover:text-[#BA1A1A] transition-colors cursor-pointer" type="button">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Table Footer / Pagination -->
        <div class="px-6 py-5 border-t border-[#E4E9DA] flex items-center justify-between bg-white">
            <span class="text-[14px] text-[#6B7366]">Menampilkan 1–5 dari 8</span>
            <div class="flex items-center gap-2">
                <button aria-label="Halaman sebelumnya" class="w-9 h-9 rounded-full border border-[#E4E9DA] bg-white flex items-center justify-center text-[#4A5246] hover:bg-[#F8FAF2] transition-colors" type="button">
                    <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                </button>
                <button class="w-9 h-9 rounded-full bg-[#E8F3E1] text-[#1F3318] text-[14px] font-bold flex items-center justify-center border border-transparent" type="button">
                    1
                </button>
                <button class="w-9 h-9 rounded-full border border-[#E4E9DA] bg-white text-[#4A5246] text-[14px] font-medium hover:bg-[#F8FAF2] transition-colors flex items-center justify-center" type="button">
                    2
                </button>
                <button aria-label="Halaman berikutnya" class="w-9 h-9 rounded-full border border-[#E4E9DA] bg-white flex items-center justify-center text-[#4A5246] hover:bg-[#F8FAF2] transition-colors" type="button">
                    <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Drawer Backdrop -->
<div class="fixed inset-0 bg-[#1F261D]/25 backdrop-blur-[1px] z-40 hidden transition-opacity opacity-0" id="drawer-backdrop"></div>

<!-- Write / Edit Article Drawer Side Panel (480px wide) -->
<aside class="fixed top-0 right-0 bottom-0 w-[480px] bg-white z-50 shadow-[-8px_0_32px_rgba(40,52,30,0.12)] border-l border-[#E4E9DA] flex flex-col h-full translate-x-full transition-transform duration-300 ease-out" id="drawer-panel">
    <!-- Drawer Header -->
    <div class="h-[72px] px-8 border-b border-[#E4E9DA] flex items-center justify-between shrink-0">
        <h2 class="text-[20px] font-semibold text-[#1F261D]" id="drawer-title">Tulis Artikel</h2>
        <button class="w-9 h-9 rounded-[12px] border border-[#E4E9DA] bg-white flex items-center justify-center text-[#4A5246] hover:bg-[#F8FAF2] transition-colors cursor-pointer" id="btn-close-drawer" type="button">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
    </div>

    <!-- Drawer Body Form -->
    <div class="flex-1 overflow-y-auto p-8 space-y-6">
        <!-- Field: Judul -->
        <div class="flex flex-col gap-2">
            <label class="text-[14px] font-medium text-[#1F261D]" for="input-article-title">Judul</label>
            <input class="h-12 px-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] transition-colors" id="input-article-title" placeholder="Masukkan judul artikel" type="text">
        </div>

        <!-- Field: Ringkasan -->
        <div class="flex flex-col gap-2">
            <label class="text-[14px] font-medium text-[#1F261D]" for="input-article-summary">Ringkasan</label>
            <textarea class="min-h-[72px] p-3 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] resize-none transition-colors" id="input-article-summary" placeholder="Tulis ringkasan singkat artikel..." rows="2"></textarea>
        </div>

        <!-- Field: Gambar Sampul -->
        <div class="flex flex-col gap-2">
            <label class="text-[14px] font-medium text-[#1F261D]">Gambar sampul</label>
            <div class="border-2 border-dashed border-[#B7D7A8] bg-[#F8FAF2] rounded-[16px] h-[120px] flex flex-col items-center justify-center cursor-pointer hover:bg-[#F1F5E8] transition-colors group">
                <span class="material-symbols-outlined text-[28px] text-[#4E6B43] group-hover:scale-105 transition-transform">image</span>
                <span class="text-[14px] font-medium text-[#1F261D] mt-1">Klik untuk memilih gambar</span>
                <span class="text-[12px] text-[#6B7366] mt-0.5">JPG atau PNG, maksimal 2 MB</span>
            </div>
        </div>

        <!-- Field: Isi Artikel -->
        <div class="flex flex-col gap-2">
            <label class="text-[14px] font-medium text-[#1F261D]" for="input-article-content">Isi artikel</label>
            <textarea class="h-[200px] p-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] resize-none transition-colors" id="input-article-content" placeholder="Tulis isi lengkap artikel di sini..."></textarea>
        </div>

        <!-- Switch Terbitkan -->
        <div class="flex items-center justify-between py-2 border-t border-[#E4E9DA]">
            <span class="text-[14px] font-medium text-[#1F261D]">Terbitkan</span>
            <button aria-checked="true" class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-[#4E6B43] transition-colors duration-200 ease-in-out focus:outline-none" id="btn-toggle-publish" role="switch" type="button">
                <span class="pointer-events-none inline-block h-5 w-5 translate-x-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out" id="toggle-dot"></span>
            </button>
        </div>
    </div>

    <!-- Drawer Footer Actions -->
    <div class="p-6 border-t border-[#E4E9DA] bg-white flex gap-3 shrink-0">
        <button class="flex-1 h-12 rounded-[14px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] font-medium hover:bg-[#F8FAF2] transition-colors cursor-pointer" id="btn-cancel-drawer" type="button">
            Batal
        </button>
        <button class="flex-1 h-12 rounded-[14px] bg-[#F2D98A] text-[#1F261D] text-[14px] font-semibold hover:bg-[#ECDDA1] transition-colors cursor-pointer shadow-sm" id="btn-save-drawer" type="button">
            Simpan
        </button>
    </div>
</aside>

@push('scripts')
<script>
    (function() {
        const openBtn = document.getElementById('btn-open-drawer');
        const closeBtn = document.getElementById('btn-close-drawer');
        const cancelBtn = document.getElementById('btn-cancel-drawer');
        const saveBtn = document.getElementById('btn-save-drawer');
        const backdrop = document.getElementById('drawer-backdrop');
        const drawer = document.getElementById('drawer-panel');
        const drawerTitle = document.getElementById('drawer-title');
        const inputTitle = document.getElementById('input-article-title');
        const inputSummary = document.getElementById('input-article-summary');

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

        window.openDrawerEdit = function(title, summary, isPublished) {
            drawerTitle.textContent = 'Ubah Artikel';
            inputTitle.value = title;
            inputSummary.value = summary;
            setPublishState(isPublished);
            openDrawer();
        };

        openBtn?.addEventListener('click', () => {
            drawerTitle.textContent = 'Tulis Artikel';
            inputTitle.value = '';
            inputSummary.value = '';
            setPublishState(true);
            openDrawer();
        });

        closeBtn?.addEventListener('click', closeDrawer);
        cancelBtn?.addEventListener('click', closeDrawer);
        backdrop?.addEventListener('click', closeDrawer);
        saveBtn?.addEventListener('click', closeDrawer);

        // Toggle publish switch
        const toggleBtn = document.getElementById('btn-toggle-publish');
        const toggleDot = document.getElementById('toggle-dot');
        let isPublished = true;

        function setPublishState(state) {
            isPublished = state;
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

        toggleBtn?.addEventListener('click', () => {
            setPublishState(!isPublished);
        });

        // Filtering chips
        const chipButtons = document.querySelectorAll('.chip-btn');
        const tableRows = document.querySelectorAll('.article-row');
        const searchInput = document.getElementById('search-input');
        let currentFilter = 'all';

        function applyFilterAndSearch() {
            const query = (searchInput?.value || '').toLowerCase().trim();

            tableRows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                const rowTitle = (row.getAttribute('data-title') || '').toLowerCase();

                const matchesFilter = currentFilter === 'all' || rowStatus === currentFilter;
                const matchesSearch = !query || rowTitle.includes(query);

                if (matchesFilter && matchesSearch) {
                    row.style.display = 'flex';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        chipButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                chipButtons.forEach(b => {
                    b.className = 'chip-btn h-[38px] px-5 rounded-full text-[14px] font-medium bg-white border border-[#E4E9DA] text-[#4A5246] hover:bg-[#F8FAF2] transition-all cursor-pointer';
                });

                btn.className = 'chip-btn h-[38px] px-5 rounded-full text-[14px] font-medium bg-[#E8F3E1] text-[#1F3318] border border-transparent transition-all cursor-pointer';
                currentFilter = btn.getAttribute('data-filter') || 'all';
                applyFilterAndSearch();
            });
        });

        searchInput?.addEventListener('input', applyFilterAndSearch);
    })();
</script>
@endpush
@endsection
