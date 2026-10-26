@extends('layouts.app')

@section('title', 'Keranjang - DuREN')

@section('content')
<!-- Header Halaman -->
<div class="flex flex-col mb-8 relative z-10">
    <h1 class="text-[40px] leading-[56px] font-bold text-[#1F261D] tracking-[-0.02em] mb-2">Keranjang</h1>
    <p class="text-[16px] text-[#6B7366]">Periksa pesananmu sebelum checkout.</p>
</div>

<!-- Layout Utama Grid: Kiri 8 Kolom (Item Keranjang), Kanan 4 Kolom (Ringkasan) -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 relative z-10 items-start">
    <!-- KOLOM KIRI: Kartu Item Keranjang -->
    <section class="lg:col-span-8 flex flex-col space-y-4">
        <div class="custom-card flex flex-col bg-white">
            <!-- Header Kartu -->
            <div class="flex items-center justify-between pb-5 border-b border-[#E4E9DA]">
                <div class="flex items-center space-x-2.5">
                    <span class="material-symbols-outlined text-[#3F5B34] text-[22px]">shopping_bag</span>
                    <h2 class="text-[20px] font-semibold text-[#1F261D]">Item Keranjang</h2>
                </div>
                <span class="text-[14px] text-[#4A5246]">Tipe: <strong class="text-[#1F261D] font-semibold">Ready Stock</strong></span>
            </div>

            <!-- Kotak Info Notifikasi Batasan Keranjang -->
            <div class="mt-5 p-4 rounded-[14px] bg-[#FAF1CE] border border-[#ECDDA1] flex items-start space-x-3">
                <span class="material-symbols-outlined text-[#7A6420] text-[20px] shrink-0 mt-0.5">info</span>
                <p class="text-[14px] text-[#5C4A12] font-medium leading-relaxed">
                    Satu keranjang hanya untuk satu tipe: Ready Stock atau Pre-Order.
                </p>
            </div>

            <!-- Daftar Item Keranjang -->
            <div class="mt-5 space-y-4" id="cart-item-list">
                <!-- ITEM 1: Montong L -->
                <article class="p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex flex-col md:flex-row md:items-center justify-between gap-4 transition-all" data-id="item-1" data-unit-price="250000">
                    <div class="flex items-center space-x-4 min-w-0">
                        <div class="w-14 h-14 rounded-2xl bg-[#E3F1DC] flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[#4E6B43] text-[28px]">eco</span>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <div class="flex items-center space-x-2">
                                <h3 class="text-[16px] font-semibold text-[#1F261D]">Montong L</h3>
                                <span class="px-2.5 py-0.5 rounded-full bg-[#E8F3E1] border border-[#CFE6C5] text-[12px] font-bold text-[#1F3318]">L</span>
                            </div>
                            <div class="flex items-center space-x-2 mt-1">
                                <span class="text-[14px] text-[#4A5246]">Est. 3,2 kg</span>
                                <span class="text-[#7A8275] text-[12px]">•</span>
                                <span class="text-[14px] text-[#6B7366]">Rp 250.000 / buah</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between md:justify-end space-x-5 pt-3 md:pt-0 border-t md:border-t-0 border-[#E4E9DA]">
                        <!-- Stepper -->
                        <div class="flex items-center bg-white border border-[#E4E9DA] rounded-lg p-0.5">
                            <button type="button" class="w-8 h-8 rounded-md flex items-center justify-center text-[#4A5246] hover:bg-[#F8FAF2] transition-colors" onclick="updateCartQty(this, -1)">
                                <span class="material-symbols-outlined text-[16px]">remove</span>
                            </button>
                            <span class="w-8 text-center text-[14px] font-semibold text-[#1F261D] item-qty">1</span>
                            <button type="button" class="w-8 h-8 rounded-md flex items-center justify-center text-[#4A5246] hover:bg-[#F8FAF2] transition-colors" onclick="updateCartQty(this, 1)">
                                <span class="material-symbols-outlined text-[16px]">add</span>
                            </button>
                        </div>
                        <div class="text-right min-w-[110px]">
                            <div class="text-[18px] font-bold text-[#1F261D] item-subtotal">
                                Rp 250.000
                            </div>
                        </div>
                        <button type="button" class="w-9 h-9 rounded-xl flex items-center justify-center text-[#6B7366] hover:text-[#BA1A1A] hover:bg-white transition-colors cursor-pointer" onclick="deleteCartItem(this)">
                            <span class="material-symbols-outlined text-[20px]">delete</span>
                        </button>
                    </div>
                </article>

                <!-- ITEM 2: Montong M -->
                <article class="p-4 rounded-[14px] bg-[#F8FAF2] border border-[#E4E9DA] flex flex-col md:flex-row md:items-center justify-between gap-4 transition-all" data-id="item-2" data-unit-price="190000">
                    <div class="flex items-center space-x-4 min-w-0">
                        <div class="w-14 h-14 rounded-2xl bg-[#FBEFB5] border border-[#ECDDA1] flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[#7A6420] text-[28px]">eco</span>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <div class="flex items-center space-x-2">
                                <h3 class="text-[16px] font-semibold text-[#1F261D]">Montong M</h3>
                                <span class="px-2.5 py-0.5 rounded-full bg-[#FBEFB5] border border-[#ECDDA1] text-[12px] font-bold text-[#5C4A12]">M</span>
                            </div>
                            <div class="flex items-center space-x-2 mt-1">
                                <span class="text-[14px] text-[#4A5246]">Est. 2,4 kg</span>
                                <span class="text-[#7A8275] text-[12px]">•</span>
                                <span class="text-[14px] text-[#6B7366]">Rp 190.000 / buah</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between md:justify-end space-x-5 pt-3 md:pt-0 border-t md:border-t-0 border-[#E4E9DA]">
                        <div class="flex items-center bg-white border border-[#E4E9DA] rounded-lg p-0.5">
                            <button type="button" class="w-8 h-8 rounded-md flex items-center justify-center text-[#4A5246] hover:bg-[#F8FAF2] transition-colors" onclick="updateCartQty(this, -1)">
                                <span class="material-symbols-outlined text-[16px]">remove</span>
                            </button>
                            <span class="w-8 text-center text-[14px] font-semibold text-[#1F261D] item-qty">1</span>
                            <button type="button" class="w-8 h-8 rounded-md flex items-center justify-center text-[#4A5246] hover:bg-[#F8FAF2] transition-colors" onclick="updateCartQty(this, 1)">
                                <span class="material-symbols-outlined text-[16px]">add</span>
                            </button>
                        </div>
                        <div class="text-right min-w-[110px]">
                            <div class="text-[18px] font-bold text-[#1F261D] item-subtotal">
                                Rp 190.000
                            </div>
                        </div>
                        <button type="button" class="w-9 h-9 rounded-xl flex items-center justify-center text-[#6B7366] hover:text-[#BA1A1A] hover:bg-white transition-colors cursor-pointer" onclick="deleteCartItem(this)">
                            <span class="material-symbols-outlined text-[20px]">delete</span>
                        </button>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- KOLOM KANAN: Ringkasan Pesanan -->
    <aside class="lg:col-span-4 custom-card p-6 flex flex-col justify-between sticky top-28">
        <div>
            <h2 class="text-[20px] font-semibold text-[#1F261D] mb-5">Ringkasan Pesanan</h2>

            <div class="space-y-3 pb-5 border-b border-[#E4E9DA]">
                <div class="flex items-center justify-between text-[14px]">
                    <span class="text-[#4A5246]">Total Jumlah</span>
                    <span class="font-semibold text-[#1F261D]" id="summary-total-qty">2 buah</span>
                </div>
                <div class="flex items-center justify-between text-[14px]">
                    <span class="text-[#4A5246]">Total Harga Durian</span>
                    <span class="font-bold text-[18px] text-[#1F261D]" id="summary-total-price">Rp 440.000</span>
                </div>
            </div>

            <div class="py-4 text-[12px] text-[#6B7366] leading-relaxed">
                <div class="flex items-center gap-2 mb-1 text-[#1F261D] font-medium">
                    <span class="material-symbols-outlined text-[16px] text-[#7A6420]">local_shipping</span>
                    <span>Ongkos Kirim Dikonfirmasi Nanti</span>
                </div>
                Ongkos kirim akan dihitung oleh Admin berdasarkan jarak lokasi dan dikonfirmasikan via nomor WhatsApp terdaftar.
            </div>
        </div>

        <div class="pt-4 border-t border-[#E4E9DA]">
            <a href="{{ url('/checkout') }}" class="w-full h-12 rounded-[14px] bg-[#F2D98A] hover:bg-[#ECDDA1] text-[#1F261D] font-semibold text-[14px] flex items-center justify-center gap-2 transition-all shadow-sm">
                <span>Lanjut ke Checkout</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
    </aside>
</div>

@push('scripts')
<script>
    function updateCartQty(btn, delta) {
        const article = btn.closest('article');
        const qtySpan = article.querySelector('.item-qty');
        const subtotalDiv = article.querySelector('.item-subtotal');
        const unitPrice = parseInt(article.getAttribute('data-unit-price')) || 0;

        let currentQty = parseInt(qtySpan.textContent) || 1;
        currentQty = Math.max(1, currentQty + delta);
        qtySpan.textContent = currentQty;

        const newSubtotal = currentQty * unitPrice;
        subtotalDiv.textContent = 'Rp ' + newSubtotal.toLocaleString('id-ID');

        recalculateCart();
    }

    function deleteCartItem(btn) {
        const article = btn.closest('article');
        article.remove();
        recalculateCart();
    }

    function recalculateCart() {
        const articles = document.querySelectorAll('#cart-item-list article');
        let totalQty = 0;
        let totalPrice = 0;

        articles.forEach(article => {
            const qty = parseInt(article.querySelector('.item-qty')?.textContent) || 0;
            const unitPrice = parseInt(article.getAttribute('data-unit-price')) || 0;
            totalQty += qty;
            totalPrice += (qty * unitPrice);
        });

        document.getElementById('summary-total-qty').textContent = totalQty + ' buah';
        document.getElementById('summary-total-price').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
    }
</script>
@endpush
@endsection
