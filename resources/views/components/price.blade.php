@props(['price', 'currency' => 'MAD', 'size' => 'base'])

@php
    $sizeClasses = [
        'sm' => 'text-sm',
        'base' => 'text-base sm:text-lg',
        'lg' => 'text-lg sm:text-xl',
        'xl' => 'text-xl sm:text-2xl',
        '2xl' => 'text-2xl sm:text-3xl',
    ];
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['base'];
    $additionalClasses = $attributes->get('class', '');
@endphp

<div class="flex items-baseline gap-1 {{ $additionalClasses }}">
    <span class="text-gold-600 font-bold {{ $sizeClass }}">{{ number_format($price, 2) }}</span>
    <span class="text-xs text-gray-400 font-medium">{{ $currency }}</span>
</div>
