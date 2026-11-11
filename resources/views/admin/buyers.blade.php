@extends('layouts.app')

@section('title', 'Kelola Pembeli - DuREN')

@section('content')
<div class="space-y-6">
    <!-- 1. KEPALA HALAMAN -->
    <div class="flex items-center justify-between pb-2">
        <div class="flex flex-col">
            <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em]">Kelola Pembeli</h1>
            <p class="text-[16px] leading-[22px] text-[#6B7366] mt-1">Lihat akun pembeli, ubah data, dan reset password.</p>
        </div>
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
                <span>Terjadi kesalahan pengisian:</span>
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
    <div class="rounded-[20px] border border-[#E4E9DA] bg-white shadow-[0_8px_24px_rgba(40,52,30,0.06)] px-6 py-5 flex items-center justify-between gap-6">
        <!-- Kotak Pencarian -->
        <form method="GET" action="{{ route('admin.buyers') }}" class="relative w-[320px]">
            @if(request('filter'))
                <input type="hidden" name="filter" value="{{ request('filter') }}">
            @endif
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#7A8275] text-[20px]">search</span>
            <input class="w-full h-12 pl-11 pr-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] placeholder-[#7A8275] focus:outline-none focus:border-[#B7D7A8] transition-colors" name="search" placeholder="Cari nama atau nomor WhatsApp" type="text" value="{{ request('search') }}">
        </form>
        <!-- Status Filter Chips -->
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.buyers', array_filter(['search' => request('search')])) }}" class="h-10 px-5 rounded-full text-[14px] {{ empty($currentFilter) ? 'bg-[#E8F3E1] text-[#1F3318] font-semibold border border-[#CFE6C5]' : 'bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2] font-medium' }} transition-colors flex items-center cursor-pointer">
                Semua
            </a>
            <a href="{{ route('admin.buyers', array_filter(['filter' => 'aktif', 'search' => request('search')])) }}" class="h-10 px-5 rounded-full text-[14px] {{ $currentFilter === 'aktif' ? 'bg-[#E8F3E1] text-[#1F3318] font-semibold border border-[#CFE6C5]' : 'bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2] font-medium' }} transition-colors flex items-center cursor-pointer">
                Aktif
            </a>
            <a href="{{ route('admin.buyers', array_filter(['filter' => 'nonaktif', 'search' => request('search')])) }}" class="h-10 px-5 rounded-full text-[14px] {{ $currentFilter === 'nonaktif' ? 'bg-[#E8F3E1] text-[#1F3318] font-semibold border border-[#CFE6C5]' : 'bg-white text-[#4A5246] border border-[#E4E9DA] hover:bg-[#F8FAF2] font-medium' }} transition-colors flex items-center cursor-pointer">
                Nonaktif
            </a>
        </div>
    </div>

    <!-- 3. KARTU TABEL PEMBELI -->
    <div class="rounded-[20px] border border-[#E4E9DA] bg-white shadow-[0_8px_24px_rgba(40,52,30,0.06)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="h-12 bg-[#F8FAF2] border-b border-[#E4E9DA] text-[14px] font-semibold text-[#6B7366]">
                        <th class="py-3 px-6 font-medium">Pembeli</th>
                        <th class="py-3 px-6 font-medium">Nomor WhatsApp</th>
                        <th class="py-3 px-6 font-medium">Alamat</th>
                        <th class="py-3 px-6 font-medium text-center">Pesanan</th>
                        <th class="py-3 px-6 font-medium text-center">Status</th>
                        <th class="py-3 px-6 font-medium">Terdaftar</th>
                        <th class="py-3 px-6 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E4E9DA]" id="buyer-table-body">
                    @forelse ($buyers as $b)
                        <tr class="buyer-row h-16 hover:bg-[#F8FAF2] transition-colors {{ ! $b->is_active ? 'opacity-75' : '' }}">
                            <td class="py-3 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#CFE6C5] flex items-center justify-center text-[14px] font-semibold text-[#1F3318] shrink-0">
                                        {{ strtoupper(substr($b->name, 0, 1)) }}
                                    </div>
                                    <span class="text-[14px] font-semibold text-[#1F261D]">{{ $b->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-[14px] text-[#1F261D] font-medium font-mono">{{ $b->phone }}</td>
                            <td class="py-3 px-6">
                                <span class="block max-w-[220px] text-[14px] text-[#4A5246] truncate" title="{{ $b->address }}">
                                    {{ $b->address }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center text-[14px] font-semibold text-[#1F261D]">
                                {{ $b->orders_count ?? 0 }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                <x-badge-status :type="$b->is_active ? 'aktif' : 'nonaktif'" />
                            </td>
                            <td class="py-3 px-6 text-[14px] text-[#6B7366]">
                                {{ $b->created_at ? $b->created_at->format('d M Y') : '-' }}
                            </td>
                            <td class="py-3 px-6 text-right">
                                <div class="inline-flex items-center gap-1.5 justify-end">
                                    <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] hover:bg-white text-[#1F261D] border border-[#E4E9DA] flex items-center justify-center transition-all cursor-pointer" onclick="openBuyerDrawer('{{ $b->id }}', '{{ addslashes($b->name) }}', '{{ $b->phone }}', '{{ addslashes($b->address) }}', {{ $b->is_active ? 'true' : 'false' }})" title="Ubah Pembeli" type="button">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </button>
                                    <button class="w-9 h-9 rounded-[12px] bg-[#F8FAF2] hover:bg-white text-[#5C4A12] border border-[#E4E9DA] flex items-center justify-center transition-all cursor-pointer" onclick="openResetModal('{{ $b->id }}', '{{ addslashes($b->name) }}', '{{ $b->phone }}')" title="Reset Password" type="button">
                                        <span class="material-symbols-outlined text-[18px]">vpn_key</span>
                                    </button>
                                    <form method="POST" action="{{ route('admin.buyers.toggle', $b->id) }}" class="inline">
                                        @csrf
                                        <button class="w-9 h-9 rounded-[12px] {{ $b->is_active ? 'bg-[#F8FAF2] hover:bg-white text-[#4A5246]' : 'bg-[#E3F1DC] hover:bg-[#cfe6c5] text-[#1F3318]' }} border border-[#E4E9DA] flex items-center justify-center transition-all cursor-pointer" title="{{ $b->is_active ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}" type="submit">
                                            <span class="material-symbols-outlined text-[18px]">{{ $b->is_active ? 'person_off' : 'person' }}</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-8 text-[#6B7366]">
                                Belum ada akun pembeli yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ==================== DRAWER EDIT PEMBELI ==================== -->
<div class="fixed inset-0 z-50 overflow-hidden hidden" id="drawer-container">
    <div class="absolute inset-0 bg-[#1F261D]/30 backdrop-blur-[2px] transition-opacity" onclick="closeBuyerDrawer()"></div>
    <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
        <div class="w-screen max-w-[480px] bg-white border-l border-[#E4E9DA] p-8 flex flex-col justify-between shadow-2xl">
            <!-- Header Panel -->
            <div class="flex items-center justify-between pb-6 border-b border-[#E4E9DA]">
                <div>
                    <h2 class="text-[20px] font-bold text-[#1F261D]" id="drawer-title">Ubah Data Pembeli</h2>
                    <p class="text-[14px] text-[#6B7366] mt-0.5">Perbarui nama, nomor WhatsApp, atau alamat.</p>
                </div>
                <button class="w-9 h-9 rounded-[12px] hover:bg-[#F8FAF2] text-[#4A5246] flex items-center justify-center transition-colors cursor-pointer" onclick="closeBuyerDrawer()" type="button">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>

            <!-- Form Edit -->
            <form id="buyerEditForm" method="POST" action="" class="flex-1 flex flex-col justify-between overflow-hidden">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="is_active" id="inputBuyerActiveHidden" value="1">

                <div class="flex-1 overflow-y-auto py-6 space-y-5">
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

                    <!-- Nama Lengkap -->
                    <div class="space-y-1.5">
                        <label class="text-[14px] font-medium text-[#1F261D]" for="edit-name">Nama Lengkap</label>
                        <input class="w-full h-12 px-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] focus:outline-none focus:border-[#B7D7A8] transition-colors" id="edit-name" name="name" type="text" required>
                    </div>

                    <!-- Nomor WhatsApp -->
                    <div class="space-y-1.5">
                        <label class="text-[14px] font-medium text-[#1F261D]" for="edit-phone">Nomor WhatsApp</label>
                        <input class="w-full h-12 px-4 rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] font-mono focus:outline-none focus:border-[#B7D7A8] transition-colors" id="edit-phone" name="phone" type="text" required>
                        <p class="text-[12px] text-[#6B7366]">Nomor WhatsApp harus unik.</p>
                    </div>

                    <!-- Alamat Lengkap -->
                    <div class="space-y-1.5">
                        <label class="text-[14px] font-medium text-[#1F261D]" for="edit-address">Alamat Lengkap</label>
                        <textarea class="w-full rounded-[12px] border border-[#E4E9DA] bg-white text-[#1F261D] text-[14px] p-3 focus:outline-none focus:border-[#B7D7A8] resize-none transition-colors" id="edit-address" name="address" rows="3" required></textarea>
                    </div>

                    <!-- Status Akun Switch -->
                    <div class="pt-2 border-t border-[#E4E9DA] flex items-center justify-between">
                        <div>
                            <span class="text-[14px] font-medium text-[#1F261D] block">Status Akun</span>
                            <span class="text-[12px] text-[#6B7366]">Izinkan pembeli masuk</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input class="sr-only peer" id="edit-status" type="checkbox" onchange="document.getElementById('inputBuyerActiveHidden').value = this.checked ? '1' : '0'">
                            <div class="w-11 h-6 bg-[#E2E2E2] rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-[#E4E9DA] after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#4E6B43]"></div>
                        </label>
                    </div>
                </div>

                <!-- Action Footer Buttons -->
                <div class="flex items-center gap-3 pt-6 border-t border-[#E4E9DA]">
                    <button class="h-12 px-6 rounded-[14px] bg-white hover:bg-[#F8FAF2] text-[#1F261D] text-[14px] font-medium border border-[#E4E9DA] transition-colors cursor-pointer" onclick="closeBuyerDrawer()" type="button">
                        Batal
                    </button>
                    <button class="flex-1 h-12 px-6 rounded-[14px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[#1F261D] text-[14px] font-semibold flex items-center justify-center transition-colors shadow-xs cursor-pointer" type="submit">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Reset Password -->
<div id="reset-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black/40 backdrop-blur-[2px]">
    <div class="bg-white rounded-[20px] border border-[#E4E9DA] p-6 max-w-md w-full mx-4 shadow-xl">
        <form id="resetPasswordForm" method="POST" action="">
            @csrf
            <div class="flex items-center justify-between pb-3 border-b border-[#E4E9DA]">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#7A6420]">vpn_key</span>
                    <h3 class="text-[18px] font-bold text-[#1F261D]">Reset Password Pembeli</h3>
                </div>
                <button type="button" onclick="closeResetModal()" class="w-8 h-8 rounded-[8px] hover:bg-[#F8FAF2] flex items-center justify-center text-[#4A5246] cursor-pointer">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
            <div class="py-4 space-y-4">
                <p class="text-[14px] text-[#4A5246]">
                    Setel password baru untuk akun <strong id="modal-buyer-name" class="text-[#1F261D]"></strong> (<span id="modal-buyer-phone" class="font-mono text-[13px]"></span>).
                </p>
                <div class="space-y-1.5">
                    <label class="text-[13px] font-medium text-[#1F261D]">Password Baru Sementara</label>
                    <input type="text" id="modal-new-password" name="new_password" value="duren12345" class="w-full h-11 px-3 rounded-[12px] border border-[#E4E9DA] bg-[#F8FAF2] text-[#1F261D] text-[14px] font-mono focus:outline-none focus:border-[#B7D7A8]" required minlength="8">
                </div>
                <p class="text-[12px] text-[#6B7366]">
                    Setelah disimpan, Anda dapat menyalin password ini dan mengirimkannya ke WhatsApp pembeli.
                </p>
            </div>
            <div class="flex items-center justify-end gap-3 pt-3 border-t border-[#E4E9DA]">
                <button type="button" onclick="closeResetModal()" class="h-10 px-4 rounded-[12px] border border-[#E4E9DA] text-[13px] font-medium hover:bg-[#F8FAF2] transition-colors cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="h-10 px-5 rounded-[12px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[#1F261D] text-[13px] font-semibold flex items-center gap-1.5 transition-colors cursor-pointer shadow-xs">
                    <span class="material-symbols-outlined text-[16px]">save</span>
                    <span>Simpan Password</span>
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    let currentBuyerId = null;

    function openBuyerDrawer(id, name, phone, address, isActive) {
        currentBuyerId = id;
        const drawer = document.getElementById('drawer-container');
        const form = document.getElementById('buyerEditForm');
        form.action = '{{ url("/admin/pembeli") }}/' + id;

        document.getElementById('edit-name').value = name;
        document.getElementById('edit-phone').value = phone;
        document.getElementById('edit-address').value = address;
        document.getElementById('edit-status').checked = isActive;
        document.getElementById('inputBuyerActiveHidden').value = isActive ? '1' : '0';

        drawer.classList.remove('hidden');
    }

    function closeBuyerDrawer() {
        const drawer = document.getElementById('drawer-container');
        drawer.classList.add('hidden');
    }

    function openResetModal(id, name, phone) {
        currentBuyerId = id;
        document.getElementById('modal-buyer-name').textContent = name;
        document.getElementById('modal-buyer-phone').textContent = phone;
        document.getElementById('resetPasswordForm').action = '{{ url("/admin/pembeli") }}/' + id + '/reset-password';
        document.getElementById('reset-modal').classList.remove('hidden');
    }

    function closeResetModal() {
        document.getElementById('reset-modal').classList.add('hidden');
    }
</script>
@endpush
@endsection
