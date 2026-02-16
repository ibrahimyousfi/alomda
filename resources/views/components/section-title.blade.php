@props([
    'eyebrow' => null,
    'title',
    'class' => '',
])

<div class="mb-12 {{ $class }}">
    @if($eyebrow)
        <span class="text-gold-600 font-bold tracking-wider uppercase text-sm block mb-2">{{ $eyebrow }}</span>
    @endif
    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $title }}</h2>
</div>
