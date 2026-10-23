@props([
    'title',
    'value',
    'caption' => null,
    'badgeText' => null,
    'badgeClass' => 'bg-[#FAF1CE] border border-[#ECDDA1] text-[#5C4A12]',
    'badgeIcon' => null,
    'icon' => null,
    'iconBg' => 'bg-[#E3F1DC]',
    'iconColor' => 'text-[#3F5B34]',
])

<div class="custom-card h-[156px] flex flex-col justify-between">
    <div class="flex items-center justify-between">
        <span class="text-[14px] leading-[20px] font-medium text-[#4A5246]">{!! $title !!}</span>
        @if($badgeText)
            <span class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-full text-[12px] font-medium {{ $badgeClass }}">
                @if($badgeIcon)
                    <span class="material-symbols-outlined text-[14px]">{{ $badgeIcon }}</span>
                @endif
                <span>{{ $badgeText }}</span>
            </span>
        @elseif($icon)
            <div class="w-8 h-8 rounded-full {{ $iconBg }} flex items-center justify-center {{ $iconColor }}">
                <span class="material-symbols-outlined text-[18px]">{{ $icon }}</span>
            </div>
        @endif
    </div>
    <div class="flex items-baseline justify-between mt-auto">
        <span class="text-[40px] leading-none font-bold text-[#1F261D] tracking-tight">{{ $value }}</span>
        @if($caption)
            <span class="text-[12px] leading-[17px] font-medium text-[#6B7366] text-right">{{ $caption }}</span>
        @endif
    </div>
</div>
