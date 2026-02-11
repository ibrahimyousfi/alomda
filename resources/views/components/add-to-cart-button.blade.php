@props(['productId', 'quantity' => 1, 'variant' => 'primary', 'fullWidth' => true])

@php
    $variants = [
        'primary' => 'bg-gold-600 text-white hover:bg-gold-700',
        'secondary' => 'bg-gold-50 text-gold-700 border border-gold-200 hover:bg-gold-100',
        'outline' => 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50',
    ];
    $variantClass = $variants[$variant] ?? $variants['primary'];
    $widthClass = $fullWidth ? 'w-full' : '';
@endphp

<form action="{{ route('cart.add') }}" method="POST" class="{{ $widthClass }}">
    @csrf
    <input type="hidden" name="product_id" value="{{ $productId }}">
    <input type="hidden" name="quantity" value="{{ $quantity }}">
    <button type="submit" class="{{ $widthClass }} {{ $variantClass }} text-xs sm:text-sm font-bold py-2 px-3 rounded-lg active:bg-gold-800 transition-all shadow-sm hover:shadow flex items-center justify-center gap-1.5">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 sm:w-4 sm:h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
        </svg>
        Add
    </button>
</form>
