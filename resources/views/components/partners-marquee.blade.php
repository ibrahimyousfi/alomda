@props([
    'images' => [],
    'title' => null,
])

@if(count($images) > 0)
<section class="bg-white py-16 border-t border-gray-200 partners-marquee-section" dir="ltr" aria-label="{{ $title }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($title)
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $title }}</h2>
            </div>
        @endif
        <div class="relative overflow-hidden">
            <div class="flex animate-scroll partners-marquee-track" style="gap: 4rem;">
                @foreach($images as $index => $logo)
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center">
                        <img src="{{ $logo }}" alt="{{ __('Partner') }} {{ $index + 1 }}" class="max-w-full max-h-full object-contain" loading="lazy">
                    </div>
                @endforeach
                @foreach($images as $index => $logo)
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center">
                        <img src="{{ $logo }}" alt="" class="max-w-full max-h-full object-contain" loading="lazy" aria-hidden="true">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <style>
        @keyframes scroll { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        .animate-scroll { animation: scroll 30s linear infinite; display: flex; width: fit-content; }
        .animate-scroll:hover { animation-play-state: paused; }
    </style>
</section>
@endif
