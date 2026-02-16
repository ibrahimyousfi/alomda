@extends('layouts.app')

@section('content')
<!-- Hero Section with Video Background -->
<div class="relative h-[600px] md:h-[700px] overflow-hidden">
    <!-- YouTube Video Background -->
    <div class="absolute inset-0 w-full h-full">
        <iframe 
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full h-[200%] min-w-full min-h-full"
            src="{{ $heroEmbedUrl ?? 'https://www.youtube.com/embed/ZIkP_WMcLz0?autoplay=1&mute=1&loop=1&playlist=ZIkP_WMcLz0&controls=0&showinfo=0&rel=0&iv_load_policy=3&modestbranding=1&playsinline=1' }}"
            frameborder="0"
            allow="autoplay; encrypted-media"
            allowfullscreen
            style="pointer-events: none;"
        ></iframe>
    </div>
    
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/70 z-10"></div>
    
    <!-- Content -->
    <div class="relative z-20 h-full flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <!-- Text Content -->
                <div class="w-full md:w-1/2 space-y-6 text-center md:text-left">
                    <div class="inline-block bg-gold-100/90 text-gold-800 text-xs font-bold px-3 py-1 rounded-full mb-2">
                        {{ __('Professional Tools & Equipment') }}
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight">
                        <span class="text-gold-500">{{ __('Professional Jewelry Tools') }}</span>
                    </h1>
                    <p class="text-lg text-gray-200 max-w-lg mx-auto md:mx-0">
                        {{ __('Hero subtitle') }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start pt-4">
                        <a href="#products" class="bg-gold-600 text-white px-8 py-3.5 rounded-full font-bold hover:bg-gold-700 transition-all shadow-lg hover:shadow-gold-500/30 flex items-center justify-center gap-2">
                            {{ __('Shop Now') }}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Equipment Images Carousel -->
                @if(count($equipmentImages) > 0)
                    <div class="w-full md:w-1/2 relative hidden md:block overflow-hidden" 
                         x-data="heroCarousel({{ count($equipmentImages) }})"
                         x-init="start()">
                        <div class="relative w-full h-[400px] md:h-[500px]">
                            @foreach($equipmentImages as $index => $image)
                                <div 
                                    x-show="current === {{ $index }}"
                                    x-transition:enter="transition ease-out duration-500"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    class="absolute inset-0 flex items-center justify-center bg-transparent"
                                    style="pointer-events: none;"
                                >
                                    <img 
                                        src="{{ $image }}" 
                                        alt="Equipment {{ $index + 1 }}"
                                        class="w-full h-full object-contain"
                                        loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                    >
                                </div>
                            @endforeach
                            <!-- Navigation Dots -->
                            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2 z-20" style="pointer-events: auto;">
                                @foreach($equipmentImages as $index => $image)
                                    <button 
                                        type="button"
                                        @click="go({{ $index }})"
                                        :class="current === {{ $index }} ? 'bg-gold-500 scale-110' : 'bg-white/50 hover:bg-white/70'"
                                        class="w-2.5 h-2.5 rounded-full transition-all duration-300"
                                        :aria-label="'Slide {{ $index + 1 }}'"
                                    ></button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Placeholder if no images -->
                    <div class="w-full md:w-1/2 relative hidden md:block">
                        <div class="relative w-full h-[400px] md:h-[500px] flex items-center justify-center bg-white/5 rounded-xl">
                            <p class="text-white/50 text-sm text-center px-4">Place transparent equipment images in:<br><strong>public/images/hero-equipment/</strong></p>
                        </div>
                    </div>
                @endif
                
                <script>
                function heroCarousel(total) {
                    return {
                        current: 0,
                        total: total,
                        timer: null,
                        start() {
                            if (this.total <= 1) return;
                            var self = this;
                            this.timer = setInterval(function() {
                                self.current = (self.current + 1) % self.total;
                            }, 4000);
                        },
                        go(index) {
                            this.current = index;
                            if (this.timer) clearInterval(this.timer);
                            var self = this;
                            this.timer = setInterval(function() {
                                self.current = (self.current + 1) % self.total;
                            }, 4000);
                        }
                    };
                }
                </script>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16" id="products">

    <x-glow-cards-styles />
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-12">
        <x-quality-feature-card
            :title="__('Quality card title')"
            :text="__('Quality card text')"
            variant="amber"
        />
        <x-quality-feature-card
            :title="__('Experience card title')"
            :text="__('Experience card text')"
            variant="sky"
        />
    </div>

    <x-section-title :eyebrow="__('Our Collection')" :title="__('Latest Products')" />

    <!-- Products Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
        @foreach($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </div>

    <div class="mt-12 w-full flex justify-center">
        {{ $products->links('vendor.pagination.tailwind') }}
    </div>
</div>

<x-mission-section />

<x-partners-marquee :images="$partnerImages ?? []" :title="__('Top Brands')" />
@endsection
