@props([
    'category',
    'href' => null,
])

@php
    $url = $href ?? route('shop', ['category' => $category->id]);
    $name = $category->translated_name ?? $category->name_en ?? $category->name_fr ?? $category->name_ar ?? '';
    $imageUrl = $category->image ? asset('storage/' . $category->image) : null;
@endphp

<a href="{{ $url }}" class="group block w-full focus:outline-none focus-visible:ring-2 focus-visible:ring-gold-500 focus-visible:ring-offset-2 rounded-2xl">
    {{-- Top: image only - rounded, gold border, white bg --}}
    <div class="rounded-xl border-2 bg-white overflow-hidden" style="border-color: #C9A227;">
        <div class="aspect-square overflow-hidden">
            @if($imageUrl)
                <img
                    src="{{ $imageUrl }}"
                    alt="{{ $name }}"
                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                    loading="lazy"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                >
                <div class="hidden w-full h-full items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100/80 rounded-xl" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
            @else
                <div class="w-full h-full min-h-[120px] flex items-center justify-center bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif
        </div>
    </div>

    <div class="h-2"></div>

    {{-- Bottom: pill - solid background (no transparency) --}}
    <div class="rounded-full py-3 px-6 text-center text-white font-bold text-sm sm:text-base truncate" style="background-color: #C9A227;">
        {{ $name }}
    </div>
</a>
