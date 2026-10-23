@props([
    'type' => 'default',
    'label' => null,
])

@php
    $classes = match(strtolower($type)) {
        'waiting_verification', 'perlu verifikasi', 'menunggu verifikasi' => 'bg-[#F2D98A] text-[#5C4A12]',
        'waiting_payment', 'menunggu pembayaran' => 'bg-[#FBEFB5] text-[#5C4A12]',
        'waiting_shipping_fee', 'menunggu ongkir' => 'bg-[#FAF1CE] text-[#7A6420]',
        'processing', 'diproses' => 'bg-[#CDEBD9] text-[#1F3318]',
        'shipped', 'dikirim', 'sedang diantar' => 'bg-[#DDEDCF] text-[#3F5B34]',
        'completed', 'selesai' => 'bg-[#E3F1DC] text-[#1F3318]',
        'cancelled', 'batal', 'pembayaran ditolak' => 'bg-[#FBDDC6] text-[#8C4A1A]',
        'ready', 'ready stock' => 'bg-[#CDEBD9] text-[#14382A]',
        'preorder', 'pre-order' => 'bg-[#FBEFB5] text-[#5C4A12]',
        'active', 'aktif' => 'bg-[#E3F1DC] border border-[#B7D7A8] text-[#1F3318]',
        'inactive', 'nonaktif' => 'bg-[#F1F5E8] border border-[#E4E9DA] text-[#6B7366]',
        'menipis' => 'bg-[#FBDDC6] border border-[#EFC3A3] text-[#8C4A1A]',
        'habis' => 'bg-[#F1F5E8] border border-[#E4E9DA] text-[#BA1A1A]',
        default => 'bg-[#F8FAF2] text-[#4A5246] border border-[#E4E9DA]',
    };

    $displayLabel = $label ?? $slot->toHtml();
    if (empty($displayLabel)) {
        $displayLabel = match(strtolower($type)) {
            'waiting_verification' => 'Menunggu Verifikasi',
            'waiting_payment' => 'Menunggu Pembayaran',
            'waiting_shipping_fee' => 'Menunggu Ongkir',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Batal',
            'ready' => 'Ready Stock',
            'preorder' => 'Pre-Order',
            'active' => 'Aktif',
            'inactive' => 'Nonaktif',
            'menipis' => 'Menipis',
            'habis' => 'Habis',
            default => ucfirst($type),
        };
    }
@endphp

<span class="inline-flex items-center px-3 py-1 rounded-full text-[12px] font-medium whitespace-nowrap {{ $classes }}">
    {{ $displayLabel }}
</span>
