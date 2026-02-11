@props(['badge' => null, 'title', 'subtitle' => null, 'showDivider' => true])

<div class="text-center mb-12">
    @if($badge)
        <span class="text-gold-600 font-bold tracking-wider uppercase text-sm">{{ $badge }}</span>
    @endif
    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2 mb-4">{{ $title }}</h2>
    @if($showDivider)
        <div class="w-20 h-1 bg-gold-500 mx-auto rounded-full"></div>
    @endif
    @if($subtitle)
        <p class="text-gray-600 mt-4">{{ $subtitle }}</p>
    @endif
    {{ $slot }}
</div>
