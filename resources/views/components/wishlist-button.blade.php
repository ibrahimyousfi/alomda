@props(['productId', 'isInWishlist' => false, 'size' => 'md', 'position' => 'absolute'])

@php
    $sizeClasses = [
        'sm' => 'w-4 h-4 sm:w-5 sm:h-5',
        'md' => 'w-5 h-5',
        'lg' => 'w-8 h-8',
    ];
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    $positionClass = $position == 'absolute' ? 'absolute top-2 right-2' : '';
@endphp

<button onclick="toggleWishlist({{ $productId }})" class="{{ $positionClass }} bg-white/90 backdrop-blur-sm p-1.5 rounded-full shadow-sm hover:bg-red-50 transition-colors z-10 group/btn">
    <svg id="wishlist-icon-{{ $productId }}" xmlns="http://www.w3.org/2000/svg" 
         fill="{{ $isInWishlist ? 'currentColor' : 'none' }}" 
         viewBox="0 0 24 24" 
         stroke-width="1.5" 
         stroke="currentColor" 
         class="{{ $sizeClass }} {{ $isInWishlist ? 'text-red-500' : 'text-gray-400' }} group-hover/btn:text-red-500 transition-colors">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
    </svg>
</button>
