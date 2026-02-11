@props([
    'icon' => 'heart',
    'title' => null,
    'message' => null,
    'action' => null,
    'actionText' => null,
    'actionRoute' => null
])

@php
    $icons = [
        'heart' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />',
        'cart' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />',
        'search' => '<path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />',
    ];
    $iconPath = $icons[$icon] ?? $icons['heart'];
@endphp

<div class="text-center py-16 bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-400">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
            {!! $iconPath !!}
        </svg>
    </div>
    <h2 class="text-2xl font-bold text-gray-900 mb-2">
        {{ $title ?? 'No items found' }}
    </h2>
    <p class="text-gray-500 mb-8">
        {{ $message ?? 'No items to display here.' }}
    </p>
    @if($actionRoute)
        <a href="{{ $actionRoute }}" class="inline-block bg-gold-600 text-white px-8 py-3 rounded-full font-bold hover:bg-gold-700 transition-colors">
            {{ $actionText ?? 'Browse Shop' }}
        </a>
    @endif
</div>
