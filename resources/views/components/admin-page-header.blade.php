@props([
    'title' => '',
    'addRoute' => null,
    'searchPlaceholder' => 'Search...',
    'showSearch' => true,
    'badge' => null,
])

<div class="flex items-center justify-between gap-4 py-2">
    <!-- Title with Badge -->
    <div class="flex items-center gap-3 flex-shrink-0">
        <h1 class="text-lg font-semibold text-gray-900">{{ $title }}</h1>
        @if($badge)
            <span class="px-3 py-1 text-xs font-medium bg-white/60 backdrop-blur-sm text-gray-700 rounded-full border border-gray-200/50">
                {{ $badge }}
            </span>
        @endif
    </div>

    <!-- Search - Centered -->
    @if($showSearch)
        <div class="flex-1 max-w-md mx-auto">
            <div class="relative">
                <input type="text" placeholder="{{ $searchPlaceholder }}" class="w-full pl-9 pr-3 py-2 text-sm rounded-lg border border-gray-200 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none">
                <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>
    @endif

    <!-- Add Button - Right -->
    @if($addRoute)
        <x-admin-action-button 
            type="link"
            :href="$addRoute"
            icon="plus"
            color="gold"
        />
    @else
        <div class="flex-shrink-0 w-10"></div>
    @endif
</div>
