@props([
    'image' => null,
    'imageAlt' => null,
    'showImagePlaceholder' => true,
])

<div class="bg-white border border-gray-200 rounded-lg p-4 flex items-center gap-4 hover:border-gray-300 transition-colors">
    <!-- Left Content (Image) -->
    @if(isset($leftSlot))
        <div class="flex-shrink-0">
            {{ $leftSlot }}
        </div>
    @elseif($image)
        <div class="flex-shrink-0">
            <img src="{{ $image }}" alt="{{ $imageAlt ?? '' }}" class="h-16 w-16 rounded-lg object-cover border border-gray-100">
        </div>
    @elseif($showImagePlaceholder)
        <div class="flex-shrink-0">
            <div class="h-16 w-16 rounded-lg bg-gray-100 flex items-center justify-center border border-gray-200">
                @if(isset($imagePlaceholder))
                    {{ $imagePlaceholder }}
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                @endif
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <div class="flex-1 min-w-0">
        {{ $slot }}
    </div>

    <!-- Actions -->
    @if(isset($actions))
        <div class="flex-shrink-0">
            {{ $actions }}
        </div>
    @endif
</div>
