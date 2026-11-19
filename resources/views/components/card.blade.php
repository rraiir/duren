@props([
    'judul' => null,
    'kelas' => '',
])

<div class="custom-card {{ $kelas }}">
    @if($judul)
        <div class="mb-4">
            <h2 class="text-[20px] leading-[28px] font-semibold text-[#1F261D]">{{ $judul }}</h2>
        </div>
    @endif
    <div>
        {{ $slot }}
    </div>
</div>
