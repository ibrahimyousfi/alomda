@extends('layouts.app')

@section('content')
<!-- Hero Section with Video Background -->
<div class="relative h-[600px] md:h-[700px] overflow-hidden">
    <!-- YouTube Video Background -->
    <div class="absolute inset-0 w-full h-full">
        <iframe 
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full h-[200%] min-w-full min-h-full"
            src="https://www.youtube.com/embed/ZIkP_WMcLz0?autoplay=1&mute=1&loop=1&playlist=ZIkP_WMcLz0&controls=0&showinfo=0&rel=0&iv_load_policy=3&modestbranding=1&playsinline=1"
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
                        ✨ Professional Tools & Equipment
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight">
                        <span class="text-gold-500">Professional Jewelry Tools</span>
                    </h1>
                    <p class="text-lg text-gray-200 max-w-lg mx-auto md:mx-0">
                        Specialized supplier of professional tools and equipment for jewelers, goldsmiths, and precious metal artisans.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start pt-4">
                        <a href="#products" class="bg-gold-600 text-white px-8 py-3.5 rounded-full font-bold hover:bg-gold-700 transition-all shadow-lg hover:shadow-gold-500/30 flex items-center justify-center gap-2">
                            Shop Now
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                            </svg>
                        </a>
                        <a href="{{ route('shop') }}" class="bg-white/90 text-gray-800 border border-white px-8 py-3.5 rounded-full font-bold hover:bg-white transition-all flex items-center justify-center">
                            View All
                        </a>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="pt-8 flex items-center justify-center md:justify-start gap-[-10px]">
                        <div class="flex -space-x-4 space-x-reverse">
                            <img class="w-10 h-10 border-2 border-white rounded-full" src="https://i.pravatar.cc/100?img=1" alt="">
                            <img class="w-10 h-10 border-2 border-white rounded-full" src="https://i.pravatar.cc/100?img=2" alt="">
                            <img class="w-10 h-10 border-2 border-white rounded-full" src="https://i.pravatar.cc/100?img=3" alt="">
                            <div class="w-10 h-10 border-2 border-white rounded-full bg-gold-100 flex items-center justify-center text-xs font-bold text-gold-800">+1k</div>
                        </div>
                        <div class="mr-4 text-sm font-medium text-white">
                            <span class="text-yellow-400 font-bold">4.9 ★</span> Customer Rating
                        </div>
                    </div>
                </div>

                <!-- Equipment Images Carousel -->
                @if(count($equipmentImages) > 0)
                    <div class="w-full md:w-1/2 relative hidden md:block" 
                         x-data="carousel()"
                         x-init="init()">
                        <div class="relative w-full h-[400px] md:h-[500px]">
                            @foreach($equipmentImages as $index => $image)
                                <div 
                                    x-show="currentIndex === {{ $index }}"
                                    x-transition:enter="transition ease-out duration-500"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute inset-0 flex items-center justify-center"
                                    style="display: {{ $index === 0 ? 'flex' : 'none' }};"
                                >
                                    <img 
                                        src="{{ $image }}" 
                                        alt="Equipment {{ $index + 1 }}"
                                        class="w-full h-full object-contain"
                                    >
                                </div>
                            @endforeach
                            
                            <!-- Navigation Dots -->
                            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2 z-20">
                                @foreach($equipmentImages as $index => $image)
                                    <button 
                                        @click="currentIndex = {{ $index }}"
                                        :class="currentIndex === {{ $index }} ? 'bg-gold-500' : 'bg-white/50'"
                                        class="w-2 h-2 rounded-full transition-all duration-300"
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
                function carousel() {
                    return {
                        currentIndex: 0,
                        images: @json($equipmentImages),
                        init() {
                            if (this.images && this.images.length > 1) {
                                setInterval(() => {
                                    this.currentIndex = (this.currentIndex + 1) % this.images.length;
                                }, 3000);
                            }
                        }
                    }
                }
                </script>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <x-feature-card 
                iconColor="gold"
                title="Free Shipping"
                description="On orders over 180 MAD"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0 1.5 1.5 0 0 1 3 0Zm0 0-3-1.5m3 1.5h9.75a1.5 1.5 0 0 1 1.5 1.5 1.5 1.5 0 0 1-1.5 1.5H9.75a1.5 1.5 0 0 1-1.5-1.5Zm0 0L5.25 12t9-6 9 6h-9.75" />
                </svg>
            </x-feature-card>
            
            <x-feature-card 
                iconColor="yellow"
                title="Secure Payment"
                description="Multiple payment methods"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                </svg>
            </x-feature-card>
            
            <x-feature-card 
                iconColor="blue"
                title="Quality Guarantee"
                description="100% Authentic products"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                </svg>
            </x-feature-card>
            
            <x-feature-card 
                iconColor="purple"
                title="Best Prices"
                description="Best value for money"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </x-feature-card>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16" id="products">

    <!-- Section Header with Left Title and Right Filters -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-12 gap-4">
        <!-- Left Side: Title -->
        <div class="text-left">
            <span class="text-gold-600 font-bold tracking-wider uppercase text-sm block mb-2">Our Collection</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Latest Products</h2>
        </div>
        
        <!-- Right Side: Filter Tabs -->
        <div class="flex flex-wrap justify-start md:justify-end gap-4">
            <button class="px-6 py-2 rounded-full bg-gray-900 text-white text-sm font-medium transition-all shadow-lg">All Products</button>
            <button class="px-6 py-2 rounded-full bg-white text-gray-600 border border-gray-200 text-sm font-medium hover:bg-gold-50 hover:text-gold-600 hover:border-gold-200 transition-all">Best Sellers</button>
            <button class="px-6 py-2 rounded-full bg-white text-gray-600 border border-gray-200 text-sm font-medium hover:bg-gold-50 hover:text-gold-600 hover:border-gold-200 transition-all">New Arrivals</button>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
        @foreach($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </div>

    <!-- Pagination: results text left, page numbers right -->
    <div class="mt-12 w-full">
        {{ $products->links('vendor.pagination.tailwind') }}
    </div>
</div>

<!-- Mission & Quality Section -->
<div class="bg-gradient-to-br from-gray-50 to-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Image -->
            <div class="order-2 lg:order-1">
                @if(file_exists(public_path('images/about/mission.jpg')))
                    <img src="{{ asset('images/about/mission.jpg') }}" alt="ALOMDA Mission" class="w-full h-[500px] object-cover rounded-2xl shadow-xl">
                @elseif(file_exists(public_path('images/about/mission.png')))
                    <img src="{{ asset('images/about/mission.png') }}" alt="ALOMDA Mission" class="w-full h-[500px] object-cover rounded-2xl shadow-xl">
                @elseif(file_exists(public_path('images/about/mission.webp')))
                    <img src="{{ asset('images/about/mission.webp') }}" alt="ALOMDA Mission" class="w-full h-[500px] object-cover rounded-2xl shadow-xl">
                @else
                    <div class="w-full h-[500px] bg-gradient-to-br from-gold-100 to-gold-200 rounded-2xl shadow-xl flex items-center justify-center">
                        <p class="text-gray-600 text-center px-4">Place mission image at: <strong>public/images/about/mission.jpg</strong></p>
                    </div>
                @endif
            </div>

            <!-- Content -->
            <div class="order-1 lg:order-2 space-y-8">
                <div>
                    <span class="text-gold-600 font-bold tracking-wider uppercase text-sm">Excellence in Quality</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mt-4 mb-6">Premium Quality Tools</h2>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Our tools are engineered for durability, efficiency, and outstanding performance. With an unwavering commitment to quality, we deliver products that enhance your workflow and elevate your craftsmanship.
                    </p>
                </div>

                <div class="space-y-6">
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gold-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.645-5.963-1.758A6.967 6.967 0 0 0 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.059 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">Supporting Professionals</h4>
                                <p class="text-gray-600 text-sm">Providing comprehensive support to artisans, workshops, and jewelry schools with exceptional tools and equipment.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gold-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6.11m0 0A11.99 11.99 0 0 0 3 12c0 2.243.467 4.358 1.298 6.28m0 0a11.95 11.95 0 0 0 4.83 4.83m-4.83-4.83a11.95 11.95 0 0 1 4.83-4.83m0 0a11.99 11.99 0 0 1 3.664-1.098m-3.664 1.098a11.959 11.959 0 0 1 2.513-1.098m3.664 1.098a11.99 11.99 0 0 0 3.664 1.098m-3.664-1.098a11.95 11.95 0 0 1 4.83-4.83m0 0a11.99 11.99 0 0 1 3.664-1.098m-3.664 1.098a11.959 11.959 0 0 1 2.513-1.098m3.664 1.098a11.99 11.99 0 0 0 3.664 1.098m-3.664-1.098a11.95 11.95 0 0 1-4.83 4.83m4.83-4.83a11.95 11.95 0 0 0-4.83-4.83" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">Quality & Reliability</h4>
                                <p class="text-gray-600 text-sm">Streamlining your work with high-performance and reliable equipment that meets professional standards.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gold-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">Comprehensive Range</h4>
                                <p class="text-gray-600 text-sm">Offering a wide selection of references, from essential tools to sophisticated equipment for every need.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gold-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">Innovation & Evolution</h4>
                                <p class="text-gray-600 text-sm">Staying informed about the latest technologies and industry developments to provide innovative solutions adapted to current and future professional needs.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Partners Section -->
@php
    $partnerImages = [];
    $partnersPath = public_path('storage/partners');
    if (is_dir($partnersPath)) {
        $files = scandir($partnersPath);
        foreach ($files as $file) {
            if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp', 'svg'])) {
                $partnerImages[] = asset('storage/partners/' . $file);
            }
        }
    }
@endphp

@if(count($partnerImages) > 0)
<div class="bg-white py-16 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Les plus grandes marques</h2>
        </div>
        
        <div class="relative overflow-hidden">
            <!-- Animated Partners Logos -->
            <div class="flex animate-scroll" style="gap: 4rem;">
                <!-- First set of logos -->
                @foreach($partnerImages as $index => $logo)
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center grayscale hover:grayscale-0 transition-all duration-300 opacity-60 hover:opacity-100">
                        <img src="{{ $logo }}" alt="Partner {{ $index + 1 }}" class="max-w-full max-h-full object-contain">
                    </div>
                @endforeach
                <!-- Duplicate for seamless loop -->
                @foreach($partnerImages as $index => $logo)
                    <div class="flex-shrink-0 w-32 h-20 flex items-center justify-center grayscale hover:grayscale-0 transition-all duration-300 opacity-60 hover:opacity-100">
                        <img src="{{ $logo }}" alt="Partner {{ $index + 1 }}" class="max-w-full max-h-full object-contain">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
@keyframes scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

.animate-scroll {
    animation: scroll 30s linear infinite;
    display: flex;
    width: fit-content;
}

.animate-scroll:hover {
    animation-play-state: paused;
}
</style>
@endif
@endsection
