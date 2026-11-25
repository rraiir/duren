@extends('layouts.app')

@section('title', 'Checkout - DuREN')

@section('content')
<!-- Header Halaman -->
<div class="flex flex-col mb-8 relative z-10">
    <div class="mb-3">
        <a class="inline-flex items-center gap-1.5 text-[14px] font-medium text-[#7A6420] hover:underline" href="{{ url('/katalog') }}">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span>Kembali ke Katalog</span>
        </a>
    </div>
    <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em] mb-1">Checkout Pesanan</h1>
    <p class="text-[16px] text-[#6B7366]">Periksa alamat pengiriman dan konfirmasi pesanan durian Anda.</p>
</div>

@if (session('error'))
    <div class="mb-6 p-4 rounded-[14px] bg-[#FBDDC6] border border-[#EFC3A3] text-[#8C4A1A] text-[14px] flex items-center gap-2.5 shadow-xs">
        <span class="material-symbols-outlined text-[20px] text-[#BA1A1A]">error</span>
        <span>{{ session('error') }}</span>
    </div>
@endif

@if (isset($errors) && $errors->any())
    <div class="mb-6 p-4 rounded-[14px] bg-[#FBDDC6] border border-[#EFC3A3] text-[#8C4A1A] text-[14px] shadow-xs">
        <div class="flex items-center gap-2 font-semibold mb-1">
            <span class="material-symbols-outlined text-[20px] text-[#BA1A1A]">warning</span>
            <span>Terdapat data yang belum lengkap:</span>
        </div>
        <ul class="list-disc list-inside text-[13px] space-y-0.5 ml-2">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('buyer.checkout.process') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id ?? 1 }}">
    <input type="hidden" name="quantity" value="{{ $quantity ?? 1 }}">
    <input type="hidden" name="proposed_price" value="{{ $proposedUnitPrice ?? ($product->price ?? 0) }}">
    <input type="hidden" name="is_negotiated" value="{{ $isNegotiated ? '1' : '0' }}">

    <!-- Layout Utama Grid: Kiri 8 Kolom, Kanan 4 Kolom -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 relative z-10 items-start">
        <!-- KOLOM KIRI (8 COLS) -->
        <div class="lg:col-span-8 space-y-6">

            <!-- 1. Alamat Pengiriman (Multi-Alamat) -->
            <div class="custom-card p-6 bg-white">
                <div class="flex items-center justify-between pb-4 border-b border-[#E4E9DA] mb-4">
                    <div class="flex items-center space-x-2.5">
                        <span class="material-symbols-outlined text-[#3F5B34] text-[22px]">location_on</span>
                        <h2 class="text-[18px] font-semibold text-[#1F261D]">Alamat Pengiriman</h2>
                    </div>
                    @if ($addresses->isNotEmpty())
                        <span class="text-[12px] font-medium text-[#4E6B43] bg-[#E8F3E1] px-2.5 py-0.5 rounded-full">
                            {{ $addresses->count() }} Alamat Tersimpan
                        </span>
                    @endif
                </div>

                @if ($addresses->isNotEmpty())
                    <!-- Opsi Pilihan Alamat -->
                    <div class="space-y-3">
                        <!-- Opsi 1: Alamat Utama -->
                        @if ($primaryAddress)
                            <label class="p-4 rounded-[14px] border transition-all flex items-start gap-3 cursor-pointer {{ old('address_choice', 'primary') === 'primary' ? 'border-[#4E6B43] bg-[#F8FAF2] ring-1 ring-[#4E6B43]' : 'border-[#E4E9DA] hover:border-[#B7D7A8]' }}" id="label-choice-primary">
                                <input type="radio" name="address_choice" value="primary" class="mt-1 text-[#4E6B43] focus:ring-0" {{ old('address_choice', 'primary') === 'primary' ? 'checked' : '' }} onchange="updateAddressChoice('primary')">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1 flex-wrap">
                                        <span class="px-2 py-0.5 rounded-full bg-[#E3F1DC] text-[#1F3318] text-[11px] font-bold">Alamat Utama</span>
                                        <span class="font-semibold text-[15px] text-[#1F261D]">{{ $primaryAddress->recipient_name }}</span>
                                        <span class="text-[#7A8275]">•</span>
                                        <span class="text-[13px] text-[#4A5246] font-mono">{{ $primaryAddress->phone }}</span>
                                    </div>
                                    <p class="text-[13px] text-[#4A5246] leading-relaxed">
                                        {{ $primaryAddress->address_line }}
                                    </p>
                                </div>
                            </label>
                        @endif

                        <!-- Opsi 2: Pilih Alamat Tersimpan Lainnya -->
                        @if ($addresses->count() > 1)
                            <label class="p-4 rounded-[14px] border transition-all flex items-start gap-3 cursor-pointer {{ old('address_choice') === 'saved' ? 'border-[#4E6B43] bg-[#F8FAF2] ring-1 ring-[#4E6B43]' : 'border-[#E4E9DA] hover:border-[#B7D7A8]' }}" id="label-choice-saved">
                                <input type="radio" name="address_choice" value="saved" class="mt-1 text-[#4E6B43] focus:ring-0" {{ old('address_choice') === 'saved' ? 'checked' : '' }} onchange="updateAddressChoice('saved')">
                                <div class="flex-1">
                                    <div class="font-semibold text-[14px] text-[#1F261D] mb-1">Gunakan Alamat Tersimpan Lain</div>
                                    <div id="saved-address-selector" class="{{ old('address_choice') === 'saved' ? 'block' : 'hidden' }} mt-2">
                                        <select name="saved_address_id" class="w-full p-2.5 rounded-[10px] border border-[#E4E9DA] text-[13px] bg-white text-[#1F261D]">
                                            @foreach ($addresses as $addr)
                                                <option value="{{ $addr->id }}" {{ old('saved_address_id') == $addr->id ? 'selected' : '' }}>
                                                    {{ $addr->label }} - {{ $addr->recipient_name }} ({{ $addr->phone }}) : {{ Str::limit($addr->address_line, 50) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </label>
                        @endif

                        <!-- Opsi 3: Tambah Alamat Baru / Hadiah -->
                        <label class="p-4 rounded-[14px] border transition-all flex items-start gap-3 cursor-pointer {{ old('address_choice') === 'new' ? 'border-[#4E6B43] bg-[#F8FAF2] ring-1 ring-[#4E6B43]' : 'border-[#E4E9DA] hover:border-[#B7D7A8]' }}" id="label-choice-new">
                            <input type="radio" name="address_choice" value="new" class="mt-1 text-[#4E6B43] focus:ring-0" {{ old('address_choice') === 'new' ? 'checked' : '' }} onchange="updateAddressChoice('new')">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-0.5">
                                    <span class="font-semibold text-[14px] text-[#1F261D]">Kirim ke Alamat Baru / Untuk Orang Lain (Hadiah)</span>
                                    <span class="material-symbols-outlined text-[16px] text-[#7A6420]">featured_seasonal_and_gifts</span>
                                </div>
                                <p class="text-[12px] text-[#6B7366]">Pesan untuk keluarga, teman, atau alamat kantor berbeda.</p>

                                <!-- Form Alamat Baru -->
                                <div id="new-address-form" class="{{ old('address_choice') === 'new' ? 'block' : 'hidden' }} mt-4 pt-4 border-t border-[#E4E9DA] space-y-3">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-[12px] font-medium text-[#4A5246] mb-1">Label Alamat</label>
                                            <input type="text" name="new_label" value="{{ old('new_label', 'Alamat Hadiah') }}" placeholder="Contoh: Rumah Mertua, Kantor" class="w-full h-10 px-3 rounded-[10px] border border-[#E4E9DA] text-[13px] bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-[12px] font-medium text-[#4A5246] mb-1">Nama Penerima <span class="text-[#BA1A1A]">*</span></label>
                                            <input type="text" name="new_recipient_name" value="{{ old('new_recipient_name') }}" placeholder="Nama lengkap penerima" class="w-full h-10 px-3 rounded-[10px] border border-[#E4E9DA] text-[13px] bg-white">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-[12px] font-medium text-[#4A5246] mb-1">Nomor WhatsApp Penerima <span class="text-[#BA1A1A]">*</span></label>
                                        <input type="text" name="new_phone" value="{{ old('new_phone') }}" placeholder="Contoh: 08123456789" class="w-full h-10 px-3 rounded-[10px] border border-[#E4E9DA] text-[13px] bg-white">
                                    </div>
                                    <div>
                                        <label class="block text-[12px] font-medium text-[#4A5246] mb-1">Alamat Lengkap Pengiriman <span class="text-[#BA1A1A]">*</span></label>
                                        <textarea name="new_address_line" rows="2" placeholder="Nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan, kota/kabupaten" class="w-full p-3 rounded-[10px] border border-[#E4E9DA] text-[13px] bg-white">{{ old('new_address_line') }}</textarea>
                                    </div>
                                    <label class="flex items-center gap-2 pt-1 text-[13px] text-[#1F261D] cursor-pointer">
                                        <input type="checkbox" name="set_primary" value="1" class="rounded text-[#4E6B43] focus:ring-0">
                                        <span>Jadikan ini sebagai Alamat Utama saya selanjutnya</span>
                                    </label>
                                </div>
                            </div>
                        </label>
                    </div>
                @else
                    <!-- Kondisi Pengguna Baru yang Belum Memiliki Alamat Tersimpan -->
                    <input type="hidden" name="address_choice" value="new">
                    <div class="p-4 rounded-[14px] bg-[#FAF1CE] border border-[#ECDDA1] flex items-start gap-3 mb-4">
                        <span class="material-symbols-outlined text-[#7A6420] text-[20px] shrink-0 mt-0.5">info</span>
                        <div class="text-[13px] text-[#5C4A12] leading-relaxed">
                            <strong>Alamat Pengiriman Pertama Kali:</strong>
                            <span class="block mt-0.5">Karena Anda mendaftar cepat tanpa mengisi alamat, alamat pertama ini otomatis akan disimpan sebagai <strong>Alamat Utama</strong> akun Anda.</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[12px] font-medium text-[#4A5246] mb-1">Label Alamat</label>
                                <input type="text" name="new_label" value="{{ old('new_label', 'Rumah') }}" class="w-full h-10 px-3 rounded-[10px] border border-[#E4E9DA] text-[13px] bg-white">
                            </div>
                            <div>
                                <label class="block text-[12px] font-medium text-[#4A5246] mb-1">Nama Penerima <span class="text-[#BA1A1A]">*</span></label>
                                <input type="text" name="new_recipient_name" value="{{ old('new_recipient_name', $user->name) }}" class="w-full h-10 px-3 rounded-[10px] border border-[#E4E9DA] text-[13px] bg-white">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[12px] font-medium text-[#4A5246] mb-1">Nomor WhatsApp Penerima <span class="text-[#BA1A1A]">*</span></label>
                            <input type="text" name="new_phone" value="{{ old('new_phone', $user->phone) }}" class="w-full h-10 px-3 rounded-[10px] border border-[#E4E9DA] text-[13px] bg-white">
                        </div>
                        <div>
                            <label class="block text-[12px] font-medium text-[#4A5246] mb-1">Alamat Lengkap Tujuan <span class="text-[#BA1A1A]">*</span></label>
                            <textarea name="new_address_line" rows="3" placeholder="Nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan, kota/kabupaten" class="w-full p-3 rounded-[10px] border border-[#E4E9DA] text-[13px] bg-white">{{ old('new_address_line') }}</textarea>
                        </div>
                    </div>
                @endif
            </div>

            <!-- 2. Rincian Barang yang Dipesan & Notifikasi Nego -->
            <div class="custom-card p-6 bg-white">
                <div class="flex items-center justify-between pb-4 border-b border-[#E4E9DA] mb-4">
                    <div class="flex items-center space-x-2.5">
                        <span class="material-symbols-outlined text-[#3F5B34] text-[22px]">inventory_2</span>
                        <h2 class="text-[18px] font-semibold text-[#1F261D]">Durian yang Dipesan</h2>
                    </div>
                    <x-badge-status :type="$product->type ?? 'ready'" />
                </div>

                <div class="py-3 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-[12px] bg-[#E3F1DC] flex items-center justify-center text-[#1F3318] font-bold text-[16px]">
                            {{ $product->size ?? 'L' }}
                        </div>
                        <div>
                            <h4 class="font-semibold text-[15px] text-[#1F261D]">{{ $product->name ?? 'Durian Montong' }} {{ $product->size ?? 'L' }} ({{ $quantity }} buah)</h4>
                            <span class="text-[12px] text-[#6B7366]">Est. {{ number_format(($product->est_weight_gram ?? 3200) / 1000, 1, ',', '.') }} kg per buah</span>
                        </div>
                    </div>
                    <div class="text-right">
                        @if ($isNegotiated)
                            <span class="text-[13px] text-[#7A8275] line-through block">{{ numberToRupiah($product->price * $quantity) }}</span>
                            <span class="font-bold text-[17px] text-[#1F3318]">{{ numberToRupiah($proposedUnitPrice * $quantity) }}</span>
                        @else
                            <span class="font-bold text-[16px] text-[#1F261D]">{{ numberToRupiah(($product->price ?? 250000) * $quantity) }}</span>
                        @endif
                    </div>
                </div>

                @if ($isNegotiated)
                    <!-- KOTAK LOGIKA NEGOSIASI ala inDrive -->
                    <div class="mt-4 p-4 rounded-[14px] bg-[#FAF1CE] border border-[#ECDDA1] flex flex-col gap-2">
                        <div class="flex items-center gap-2 text-[#7A6420]">
                            <span class="material-symbols-outlined text-[20px]">handshake</span>
                            <span class="font-bold text-[14px]">Pengajuan Tawaran Harga ala inDrive</span>
                        </div>
                        <p class="text-[13px] text-[#5C4A12] leading-relaxed">
                            Anda mengajukan tawaran <strong>{{ numberToRupiah($proposedUnitPrice) }}</strong> / buah (hemat <strong>{{ numberToRupiah($product->price - $proposedUnitPrice) }}</strong>/buah dari harga normal).
                        </p>
                        <div class="text-[12px] text-[#7A6420] bg-white/70 p-2.5 rounded-[10px] border border-[#ECDDA1]">
                            ⏳ <strong>Sistematika:</strong> Pesanan Anda akan dibuat dengan status <em>Menunggu Approval Harga</em>. Admin toko akan meninjau dan menyetujui tawaran Anda sebelum Anda melakukan pembayaran QRIS.
                        </div>
                        <div class="mt-1">
                            <label class="block text-[12px] font-medium text-[#5C4A12] mb-1">Catatan Nego ke Admin (Opsional):</label>
                            <input type="text" name="negotiation_note" placeholder="Contoh: Beli grosir, mohon di-acc min ya" class="w-full h-9 px-3 rounded-[8px] bg-white border border-[#ECDDA1] text-[13px] text-[#1F261D] placeholder-[#9A8440]">
                        </div>
                    </div>
                @endif
            </div>

            <!-- 3. Persetujuan Aturan & Garansi -->
            <div class="custom-card p-6 bg-[#F8FAF2] border border-[#E4E9DA]">
                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" name="terms" value="1" checked class="mt-1 w-4 h-4 rounded text-[#4E6B43] border-[#E4E9DA] focus:ring-0">
                    <span class="text-[14px] text-[#1F261D] leading-relaxed">
                        Saya telah membaca dan menyetujui seluruh ketentuan pada <a href="{{ url('/aturan-garansi') }}" target="_blank" class="text-[#7A6420] underline font-semibold">Aturan & Garansi</a> toko DuREN, termasuk syarat klaim garansi buah jika mentah atau busuk.
                    </span>
                </label>
            </div>
        </div>

        <!-- KOLOM KANAN (4 COLS) -->
        <aside class="lg:col-span-4 custom-card p-6 flex flex-col justify-between sticky top-28 bg-white">
            <div>
                <h2 class="text-[20px] font-semibold text-[#1F261D] mb-5">Ringkasan Pembayaran</h2>

                <div class="space-y-3 pb-5 border-b border-[#E4E9DA]">
                    <div class="flex items-center justify-between text-[14px]">
                        <span class="text-[#4A5246]">Harga Durian ({{ $quantity }} buah)</span>
                        @if ($isNegotiated)
                            <span class="font-medium text-[#1F3318]">{{ numberToRupiah($proposedUnitPrice * $quantity) }}</span>
                        @else
                            <span class="font-medium text-[#1F261D]">{{ numberToRupiah(($product->price ?? 250000) * $quantity) }}</span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between text-[14px]">
                        <span class="text-[#4A5246]">Ongkos Kirim</span>
                        <span class="text-[12px] font-semibold text-[#7A6420] bg-[#FAF1CE] px-2 py-0.5 rounded-full">Dikonfirmasi via WA</span>
                    </div>

                    <div class="p-3 rounded-[12px] bg-[#F8FAF2] border border-[#E4E9DA] text-[12px] text-[#4A5246] space-y-1.5 leading-relaxed">
                        <p class="text-[#6B7366]">
                            💡 <strong>Alur Ongkir:</strong> Admin akan menghubungi WhatsApp Anda ({{ $user->phone }}) untuk menyepakati kurir & ongkir setelah pembayaran durian selesai diverifikasi.
                        </p>
                    </div>

                    <div class="flex items-center justify-between text-[16px] pt-2 border-t border-[#E4E9DA]">
                        <span class="font-semibold text-[#1F261D]">Total {{ $isNegotiated ? 'Tawaran' : 'Pembayaran' }}</span>
                        <span class="font-bold text-[20px] {{ $isNegotiated ? 'text-[#1F3318]' : 'text-[#1F261D]' }}">
                            {{ numberToRupiah(($isNegotiated ? $proposedUnitPrice : ($product->price ?? 250000)) * $quantity) }}
                        </span>
                    </div>
                </div>

                <div class="py-4 text-[12px] text-[#6B7366] leading-relaxed">
                    @if ($isNegotiated)
                        Setelah diajukan, Admin akan memeriksa tawaran Anda. Anda akan menerima notifikasi status persetujuan harga sebelum transfer QRIS.
                    @else
                        Pembayaran dilakukan menggunakan QRIS dengan batas waktu 15 menit setelah pesanan dibuat.
                    @endif
                </div>
            </div>

            <div class="pt-4 border-t border-[#E4E9DA]">
                <button type="submit" class="w-full h-12 rounded-[14px] {{ $isNegotiated ? 'bg-[#FAF1CE] hover:bg-[#ECDDA1] text-[#5C4A12]' : 'bg-[#F2D98A] hover:bg-[#ECDDA1] text-[#1F261D]' }} font-semibold text-[14px] flex items-center justify-center gap-2 transition-all shadow-sm cursor-pointer">
                    @if ($isNegotiated)
                        <span class="material-symbols-outlined text-[18px]">handshake</span>
                        <span>Ajukan Tawaran & Buat Pesanan</span>
                    @else
                        <span>Buat Pesanan & Bayar QRIS</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    @endif
                </button>
            </div>
        </aside>
    </div>
</form>

@push('scripts')
<script>
    function updateAddressChoice(type) {
        const savedSelector = document.getElementById('saved-address-selector');
        const newForm = document.getElementById('new-address-form');
        const lblPrimary = document.getElementById('label-choice-primary');
        const lblSaved = document.getElementById('label-choice-saved');
        const lblNew = document.getElementById('label-choice-new');

        if (savedSelector) savedSelector.classList.toggle('hidden', type !== 'saved');
        if (newForm) newForm.classList.toggle('hidden', type !== 'new');

        // Reset styling
        [lblPrimary, lblSaved, lblNew].forEach(lbl => {
            if (lbl) {
                lbl.classList.remove('border-[#4E6B43]', 'bg-[#F8FAF2]', 'ring-1', 'ring-[#4E6B43]');
                lbl.classList.add('border-[#E4E9DA]');
            }
        });

        if (type === 'primary' && lblPrimary) {
            lblPrimary.classList.add('border-[#4E6B43]', 'bg-[#F8FAF2]', 'ring-1', 'ring-[#4E6B43]');
        } else if (type === 'saved' && lblSaved) {
            lblSaved.classList.add('border-[#4E6B43]', 'bg-[#F8FAF2]', 'ring-1', 'ring-[#4E6B43]');
        } else if (type === 'new' && lblNew) {
            lblNew.classList.add('border-[#4E6B43]', 'bg-[#F8FAF2]', 'ring-1', 'ring-[#4E6B43]');
        }
    }
</script>
@endpush
@endsection
