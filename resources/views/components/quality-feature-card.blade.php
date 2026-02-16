@props([
    'title',
    'text',
    'variant' => 'amber', // amber | sky
])

@php
    $variantClasses = [
        'amber' => [
            'deco' => 'bg-amber-50',
            'border' => 'hover:border-amber-200/60',
            'iconBg' => 'bg-amber-50',
            'iconClass' => 'icon-glow-amber',
            'iconColor' => 'text-amber-500',
            'iconPath' => 'M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
        ],
        'sky' => [
            'deco' => 'bg-sky-50',
            'border' => 'hover:border-sky-200/60',
            'iconBg' => 'bg-sky-50',
            'iconClass' => 'icon-glow-sky',
            'iconColor' => 'text-sky-500',
            'iconPath' => 'M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
        ],
    ];
    $v = $variantClasses[$variant] ?? $variantClasses['amber'];
@endphp

<div class="group relative overflow-hidden rounded-2xl bg-white border border-gray-100 p-6 shadow-sm hover:shadow-md {{ $v['border'] }} transition-all duration-300">
    <div class="absolute top-0 right-0 w-24 h-24 rounded-full {{ $v['deco'] }} -translate-y-1/2 translate-x-1/2 group-hover:scale-110 transition-transform duration-300" aria-hidden="true"></div>
    <div class="relative flex items-start gap-4">
        <div class="flex-shrink-0 w-12 h-12 rounded-xl {{ $v['iconBg'] }} flex items-center justify-center {{ $v['iconClass'] }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 {{ $v['iconColor'] }}" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $v['iconPath'] }}" />
            </svg>
        </div>
        <div>
            <h3 class="font-bold text-gray-900 text-lg mb-1">{{ $title }}</h3>
            <p class="text-sm text-gray-500 leading-relaxed">{{ $text }}</p>
        </div>
    </div>
</div>
