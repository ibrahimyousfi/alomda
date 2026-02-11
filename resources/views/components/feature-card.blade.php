@props(['title', 'description', 'iconColor' => 'gold'])

@php
    $colorClasses = [
        'gold' => 'bg-gold-100 text-gold-600',
        'yellow' => 'bg-yellow-100 text-yellow-600',
        'blue' => 'bg-blue-100 text-blue-600',
        'purple' => 'bg-purple-100 text-purple-600',
    ];
    $colorClass = $colorClasses[$iconColor] ?? $colorClasses['gold'];
@endphp

<div class="flex items-center gap-4 p-4 rounded-xl hover:bg-gray-50 transition-colors">
    <div class="w-12 h-12 {{ $colorClass }} rounded-full flex items-center justify-center">
        {{ $slot }}
    </div>
    <div>
        <h3 class="font-bold text-gray-900 text-sm md:text-base">{{ $title }}</h3>
        <p class="text-xs text-gray-500">{{ $description }}</p>
    </div>
</div>
