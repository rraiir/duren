@extends('layouts.app')

@section('title', 'Kelola Durian - DuREN')

@section('content')
<div class="space-y-6">
    <!-- 1. KEPALA HALAMAN -->
    <div class="flex items-center justify-between pb-2">
        <div class="flex flex-col">
            <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">Kelola Durian</h1>
            <p class="text-[16px] leading-[22px] text-[#6B7366] mt-1">Atur varian, ukuran, harga, dan stok durian.</p>
        </div>
        <!-- Tombol Tambah Durian -->
        <button class="h-12 px-6 rounded-[14px] bg-[#F2D98A] hover:bg-[#ebd07d] text-[#5C4A12] text-[15px] font-semibold flex items-center space-x-2 transition-all shadow-sm cursor-pointer hover-lift" id="btnOpenDrawer" type="button" onclick="openDrawer()">
            <span class="material-symbols-outlined text-[20px]">add</span>
            <span>Tambah Durian</span>
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

    <!-- 2. KARTU FILTER -->
    @php
        $currentFilter = request('filter');
    @endphp
    <div class="custom-card flex items-center justify-between !py-4">
        <!-- Kotak Pencarian -->
        <form method="GET" action="{{ route('admin.durian') }}" class="relative w-[320px]">
            @if(request('filter'))
                <input type="hidden" name="filter" value="{{ request('filter') }}">
            @endif
            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[#7A8275] text-[20px]">search</span>
            <input class="w-full h-12 pl-11 pr-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] transition-colors" name="search" placeholder="Cari nama varian..." type="text" value="{{ request('search') }}">
        </form>
        <!-- 4 Filter Chips -->
        <div class="flex items-center space-x-2.5">
            <a href="{{ route('admin.durian', array_filter(['search' => request('search')])) }}" class="h-9 px-4 rounded-full {{ empty($currentFilter) ? 'bg-[#E3F1DC] text-[#1F3318] border border-[#B7D7A8] font-semibold' : 'bg-[#F8FAF2] text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F1F5E8] font-medium' }} text-[12px] transition-colors flex items-center shadow-xs cursor-pointer">
                Semua
            </a>
            <a href="{{ route('admin.durian', array_filter(['filter' => 'ready', 'search' => request('search')])) }}" class="h-9 px-4 rounded-full {{ $currentFilter === 'ready' ? 'bg-[#E3F1DC] text-[#1F3318] border border-[#B7D7A8] font-semibold' : 'bg-[#F8FAF2] text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F1F5E8] font-medium' }} text-[12px] transition-colors flex items-center cursor-pointer">
                Ready Stock
            </a>
            <a href="{{ route('admin.durian', array_filter(['filter' => 'preorder', 'search' => request('search')])) }}" class="h-9 px-4 rounded-full {{ $currentFilter === 'preorder' ? 'bg-[#E3F1DC] text-[#1F3318] border border-[#B7D7A8] font-semibold' : 'bg-[#F8FAF2] text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F1F5E8] font-medium' }} text-[12px] transition-colors flex items-center cursor-pointer">
                Pre-Order
            </a>
            <a href="{{ route('admin.durian', array_filter(['filter' => 'inactive', 'search' => request('search')])) }}" class="h-9 px-4 rounded-full {{ $currentFilter === 'inactive' ? 'bg-[#E3F1DC] text-[#1F3318] border border-[#B7D7A8] font-semibold' : 'bg-[#F8FAF2] text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F1F5E8] font-medium' }} text-[12px] transition-colors flex items-center cursor-pointer">
                Nonaktif
            </a>
        </div>
    </div>

    <!-- 3. KARTU TABEL DURIAN -->
    <div class="custom-card !p-6 flex flex-col">
        <div class="w-full overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="h-11 bg-[#F8FAF2] rounded-[12px]">
                        <th class="px-4 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider rounded-l-[12px]">Varian</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider text-center">Ukuran</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider">Est. Berat</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider">Harga</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider">Stok</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider">Tipe</th>
                        <th class="px-3 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider">Status</th>
                        <th class="px-4 py-2 text-[12px] font-medium text-[#6B7366] uppercase tracking-wider text-right rounded-r-[12px]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E4E9DA] text-[14px] text-[#1F261D]">
                    @forelse ($products as $p)
                        <tr class="h-16 hover:bg-[#F8FAF2] transition-colors {{ ! $p->is_active ? 'opacity-75' : '' }}">
                            <td class="px-4 py-3 font-semibold {{ $p->is_active ? 'text-[#1F261D]' : 'text-[#6B7366]' }}">
                                {{ $p->name }}
                            </td>
                            <td class="px-3 py-3 text-center">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-[#F8FAF2] border border-[#E4E9DA] font-medium {{ $p->is_active ? 'text-[#1F261D]' : 'text-[#6B7366]' }} text-[13px]">
                                    {{ $p->size }}
                                </span>
                            </td>
                            <td class="px-3 py-3 {{ $p->is_active ? 'text-[#4A5246]' : 'text-[#7A8275]' }}">
                                {{ number_format($p->est_weight_gram, 0, ',', '.') }} gr
                            </td>
                            <td class="px-3 py-3 font-medium {{ $p->is_active ? 'text-[#1F261D]' : 'text-[#6B7366]' }}">
                                {{ numberToRupiah($p->price) }}
                            </td>
                            <td class="px-3 py-3 font-semibold {{ $p->stock <= 5 ? 'text-[#BA1A1A]' : ($p->is_active ? 'text-[#1F261D]' : 'text-[#7A8275]') }}">
                                {{ $p->stock }}
                            </td>
                            <td class="px-3 py-3">
                                <x-badge-status :type="$p->type" />
                            </td>
                            <td class="px-3 py-3">
                                <x-badge-status :type="$p->is_active ? 'active' : 'inactive'" />
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="inline-flex items-center space-x-1.5">
                                    <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] hover:bg-white text-[#4A5246] hover:text-[#1F261D] flex items-center justify-center transition-colors cursor-pointer" title="Ubah data" type="button" onclick="openDrawer('{{ $p->id }}', '{{ addslashes($p->name) }}', '{{ $p->size }}', '{{ $p->est_weight_gram }}', '{{ number_format($p->price, 0, ',', '.') }}', '{{ $p->stock }}', '{{ $p->type }}', '{{ addslashes($p->eta_text ?? '') }}', '{{ addslashes($p->description ?? '') }}', {{ $p->is_active ? 'true' : 'false' }})">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </button>
                                    <form method="POST" action="{{ route('admin.durian.toggle', $p->id) }}" class="inline">
                                        @csrf
                                        <button class="w-9 h-9 rounded-[12px] {{ $p->is_active ? 'bg-[#F8FAF2] border border-[#E4E9DA] hover:bg-white text-[#4A5246]' : 'bg-[#E3F1DC] border border-[#B7D7A8] hover:bg-[#cfe6c5] text-[#1F3318]' }} flex items-center justify-center transition-colors cursor-pointer" title="{{ $p->is_active ? 'Nonaktifkan' : 'Aktifkan kembali' }}" type="submit">
                                            <span class="material-symbols-outlined text-[18px]">{{ $p->is_active ? 'visibility_off' : 'visibility' }}</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-8 text-[#6B7366]">
                                Belum ada data durian yang sesuai dengan kriteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ==================== DRAWER PANEL TAMBAH/UBAH DURIAN ==================== -->
<!-- Backdrop -->
<div class="fixed inset-0 bg-black/30 backdrop-blur-xs z-50 transition-opacity duration-300 opacity-0 pointer-events-none" id="drawerBackdrop" onclick="closeDrawer()"></div>

<!-- Slide-over Container -->
<div class="fixed inset-y-0 right-0 max-w-full flex z-50 pointer-events-none">
    <div class="w-screen max-w-[480px] bg-white border-l border-[#E4E9DA] shadow-2xl flex flex-col justify-between transform translate-x-full transition-transform duration-300 ease-in-out pointer-events-auto" id="drawerPanel">
        <!-- Header Drawer -->
        <div class="p-6 border-b border-[#E4E9DA] flex items-center justify-between">
            <div>
                <h2 class="text-[20px] font-semibold text-[#1F261D]" id="drawerTitle">Tambah Durian</h2>
                <p class="text-[13px] text-[#6B7366] mt-0.5" id="drawerSubtitle">Isi data varian durian baru.</p>
            </div>
            <button class="w-9 h-9 rounded-full bg-[#F8FAF2] hover:bg-[#F1F5E8] text-[#4A5246] hover:text-[#1F261D] flex items-center justify-center transition-colors cursor-pointer" id="btnCloseDrawer" onclick="closeDrawer()" type="button">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <!-- Body Drawer / Form -->
        <div class="p-6 overflow-y-auto flex-1 space-y-4">
            @if ($errors->any())
                <div class="p-4 rounded-[12px] bg-[#FFF0ED] border border-[#FFDAD6] text-[#BA1A1A] text-[13px] space-y-1">
                    <p class="font-semibold flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px]">error</span>
                        Periksa kembali isian formulir:
                    </p>
                    <ul class="list-disc list-inside space-y-0.5 pl-1 text-[12px]">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="durianForm" method="POST" action="{{ route('admin.durian.store') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="_method" id="durianFormMethod" value="POST">
                <input type="hidden" name="size" id="inputSizeHidden" value="M">
                <input type="hidden" name="type" id="inputTypeHidden" value="ready">
                <input type="hidden" name="is_active" id="inputActiveHidden" value="1">

                <!-- 1. Nama Varian -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-1.5">Nama Varian</label>
                    <input class="w-full h-12 px-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] focus:outline-none focus:border-[#B7D7A8] transition-colors" id="inputName" name="name" placeholder="Contoh: Montong Parigi, Musang King" type="text" required>
                </div>

                <!-- 2. Ukuran -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-1.5">Ukuran</label>
                    <div class="grid grid-cols-3 gap-2.5" id="sizeOptions">
                        <button class="h-11 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] text-[#4A5246] text-[14px] font-medium hover:bg-[#F1F5E8] transition-colors flex items-center justify-center cursor-pointer size-btn" type="button" onclick="selectSize('S')">
                            S
                        </button>
                        <button class="h-11 rounded-[12px] bg-[#E3F1DC] border border-[#B7D7A8] text-[#1F3318] text-[14px] font-semibold flex items-center justify-center cursor-pointer size-btn" type="button" onclick="selectSize('M')">
                            M
                        </button>
                        <button class="h-11 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] text-[#4A5246] text-[14px] font-medium hover:bg-[#F1F5E8] transition-colors flex items-center justify-center cursor-pointer size-btn" type="button" onclick="selectSize('L')">
                            L
                        </button>
                    </div>
                </div>

                <!-- 3. Estimasi Berat -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-1.5">Estimasi berat</label>
                    <div class="relative">
                        <input class="w-full h-12 pl-4 pr-16 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] focus:outline-none focus:border-[#B7D7A8] transition-colors" id="inputWeight" name="est_weight_gram" type="number" value="1800" required>
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[12px] text-[#6B7366]">gram</span>
                    </div>
                </div>

                <!-- 4. Harga -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-1.5">Harga</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[13px] text-[#6B7366] font-medium">Rp</span>
                        <input class="w-full h-12 pl-11 pr-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] focus:outline-none focus:border-[#B7D7A8] transition-colors" id="inputPrice" name="price" type="text" value="250.000" required>
                    </div>
                </div>

                <!-- 5. Stok -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-1.5">Stok</label>
                    <input class="w-full h-12 px-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] focus:outline-none focus:border-[#B7D7A8] transition-colors" id="inputStock" name="stock" type="number" value="10" required>
                    <p class="text-[12px] text-[#6B7366] mt-1.5">Untuk Pre-Order, stok berfungsi sebagai kuota pesanan.</p>
                </div>

                <!-- 6. Tipe -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-1.5">Tipe</label>
                    <div class="grid grid-cols-2 gap-2.5">
                        <button class="h-11 rounded-[12px] bg-[#E3F1DC] border border-[#B7D7A8] text-[#1F3318] text-[13px] font-semibold flex items-center justify-center space-x-1.5 cursor-pointer type-btn" id="btnTypeReady" type="button" onclick="selectType('ready')">
                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                            <span>Ready Stock</span>
                        </button>
                        <button class="h-11 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] text-[#4A5246] text-[13px] font-medium hover:bg-[#F1F5E8] transition-colors flex items-center justify-center cursor-pointer type-btn" id="btnTypePreorder" type="button" onclick="selectType('preorder')">
                            <span>Pre-Order</span>
                        </button>
                    </div>
                </div>

                <!-- 7. Estimasi Tiba (Pre-Order) -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-[14px] font-medium text-[#1F261D]">Estimasi tiba</label>
                        <span class="px-2 py-0.5 rounded-full bg-[#F8FAF2] border border-[#E4E9DA] text-[11px] text-[#7A8275] font-medium">Hanya untuk Pre-Order</span>
                    </div>
                    <input class="w-full h-12 px-4 rounded-[12px] border border-[#E4E9DA] bg-[#F8FAF2] text-[#1F261D] text-[14px] focus:outline-none focus:border-[#B7D7A8] transition-colors opacity-60" id="inputEta" name="eta_text" placeholder="Contoh: panen akhir Oktober" type="text" disabled>
                </div>

                <!-- 8. Deskripsi Durian -->
                <div>
                    <label class="block text-[14px] font-medium text-[#1F261D] mb-1.5">Deskripsi Karakter Durian</label>
                    <textarea class="w-full rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] p-3 focus:outline-none focus:border-[#B7D7A8] transition-colors resize-none" id="inputDescription" name="description" placeholder="Jelaskan tekstur, rasa, dan keunggulan varian durian..." rows="3"></textarea>
                </div>

                <!-- 9. Sakelar Status Durian -->
                <div class="pt-2 flex items-center justify-between">
                    <div>
                        <span class="block text-[14px] font-medium text-[#1F261D]">Status Durian</span>
                        <span class="text-[12px] text-[#6B7366]">Tampilkan varian ke pembeli</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-[12px] font-semibold text-[#3F5B34]" id="switchStatusLabel">Aktif</span>
                        <button class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-[#B7D7A8] transition-colors duration-200 ease-in-out focus:outline-none" id="btnToggleActive" onclick="toggleActiveStatus()" type="button">
                            <span class="translate-x-5 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-[#1F3318] shadow-xs ring-0 transition duration-200 ease-in-out" id="switchKnob"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Footer Drawer -->
        <div class="p-6 border-t border-[#E4E9DA] flex items-center gap-3">
            <button class="flex-1 h-12 rounded-[14px] border border-[#E4E9DA] bg-white hover:bg-[#F8FAF2] text-[#4A5246] text-[14px] font-medium transition-colors cursor-pointer" onclick="closeDrawer()" type="button">
                Batal
            </button>
            <button class="flex-1 h-12 rounded-[14px] bg-[#F2D98A] text-[#5C4A12] hover:bg-[#ebd07d] text-[14px] font-semibold shadow-sm transition-colors cursor-pointer" onclick="submitDurianForm()" type="button">
                Simpan
            </button>
        </div>
    </div>
</div>

<script>
    const drawerPanel = document.getElementById('drawerPanel');
    const drawerBackdrop = document.getElementById('drawerBackdrop');
    let currentActive = true;

    function openDrawer(id = '', name = '', size = 'M', weight = '1800', price = '250.000', stock = '10', type = 'ready', eta = '', description = '', isActive = true) {
        if (!drawerPanel || !drawerBackdrop) return;
        
        const form = document.getElementById('durianForm');
        const methodInput = document.getElementById('durianFormMethod');

        if (id) {
            document.getElementById('drawerTitle').textContent = 'Ubah Durian';
            document.getElementById('drawerSubtitle').textContent = 'Perbarui data varian durian.';
            form.action = '{{ url("/admin/durian") }}/' + id;
            methodInput.value = 'PUT';
        } else {
            document.getElementById('drawerTitle').textContent = 'Tambah Durian';
            document.getElementById('drawerSubtitle').textContent = 'Isi data varian durian baru.';
            form.action = '{{ route("admin.durian.store") }}';
            methodInput.value = 'POST';
        }

        document.getElementById('inputName').value = name || '';
        document.getElementById('inputWeight').value = weight || '1800';
        document.getElementById('inputPrice').value = price || '250.000';
        document.getElementById('inputStock').value = stock || '10';
        document.getElementById('inputEta').value = eta || '';
        document.getElementById('inputDescription').value = description || '';
        
        selectSize(size || 'M');
        selectType(type || 'ready');
        setActiveStatus(isActive);

        drawerPanel.classList.remove('translate-x-full');
        drawerBackdrop.classList.remove('opacity-0', 'pointer-events-none');
    }

    function closeDrawer() {
        if (!drawerPanel || !drawerBackdrop) return;
        drawerPanel.classList.add('translate-x-full');
        drawerBackdrop.classList.add('opacity-0', 'pointer-events-none');
    }

    function submitDurianForm() {
        document.getElementById('durianForm').submit();
    }

    function selectSize(size) {
        document.getElementById('inputSizeHidden').value = size;
        const buttons = document.querySelectorAll('#sizeOptions button');
        buttons.forEach(btn => {
            if (btn.textContent.trim() === size) {
                btn.className = 'h-11 rounded-[12px] bg-[#E3F1DC] border border-[#B7D7A8] text-[#1F3318] text-[14px] font-semibold flex items-center justify-center cursor-pointer size-btn';
            } else {
                btn.className = 'h-11 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] text-[#4A5246] text-[14px] font-medium hover:bg-[#F1F5E8] transition-colors flex items-center justify-center cursor-pointer size-btn';
            }
        });
    }

    function selectType(type) {
        document.getElementById('inputTypeHidden').value = type;
        const btnReady = document.getElementById('btnTypeReady');
        const btnPreorder = document.getElementById('btnTypePreorder');
        const inputEta = document.getElementById('inputEta');

        if (type === 'ready') {
            btnReady.className = 'h-11 rounded-[12px] bg-[#E3F1DC] border border-[#B7D7A8] text-[#1F3318] text-[13px] font-semibold flex items-center justify-center space-x-1.5 cursor-pointer type-btn';
            btnPreorder.className = 'h-11 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] text-[#4A5246] text-[13px] font-medium hover:bg-[#F1F5E8] transition-colors flex items-center justify-center cursor-pointer type-btn';
            inputEta.disabled = true;
            inputEta.classList.add('bg-[#F8FAF2]', 'opacity-60');
        } else {
            btnPreorder.className = 'h-11 rounded-[12px] bg-[#E3F1DC] border border-[#B7D7A8] text-[#1F3318] text-[13px] font-semibold flex items-center justify-center space-x-1.5 cursor-pointer type-btn';
            btnReady.className = 'h-11 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] text-[#4A5246] text-[13px] font-medium hover:bg-[#F1F5E8] transition-colors flex items-center justify-center cursor-pointer type-btn';
            inputEta.disabled = false;
            inputEta.classList.remove('bg-[#F8FAF2]', 'opacity-60');
        }
    }

    function setActiveStatus(active) {
        currentActive = active;
        document.getElementById('inputActiveHidden').value = currentActive ? '1' : '0';
        const knob = document.getElementById('switchKnob');
        const btn = document.getElementById('btnToggleActive');
        const label = document.getElementById('switchStatusLabel');

        if (currentActive) {
            knob.className = 'translate-x-5 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-[#1F3318] shadow-xs ring-0 transition duration-200 ease-in-out';
            btn.className = 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-[#B7D7A8] transition-colors duration-200 ease-in-out focus:outline-none';
            label.textContent = 'Aktif';
            label.className = 'text-[12px] font-semibold text-[#3F5B34]';
        } else {
            knob.className = 'translate-x-0 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-[#7A8275] shadow-xs ring-0 transition duration-200 ease-in-out';
            btn.className = 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-[#E4E9DA] transition-colors duration-200 ease-in-out focus:outline-none';
            label.textContent = 'Nonaktif';
            label.className = 'text-[12px] font-semibold text-[#7A8275]';
        }
    }

    function toggleActiveStatus() {
        setActiveStatus(!currentActive);
    }

    @if ($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            openDrawer(
                '',
                '{{ addslashes(old("name", "")) }}',
                '{{ old("size", "M") }}',
                '{{ old("est_weight_gram", "1800") }}',
                '{{ old("price", "250000") }}',
                '{{ old("stock", "10") }}',
                '{{ old("type", "ready") }}',
                '{{ addslashes(old("eta_text", "")) }}',
                '{{ addslashes(old("description", "")) }}',
                {{ old("is_active", 1) ? 'true' : 'false' }}
            );
        });
    @endif
</script>
@endsection
