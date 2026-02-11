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
        @foreach($latestProducts as $product)
            <x-product-card :product="$product" />
        @endforeach
    </div>

    <!-- View More Button -->
    <div class="mt-12 flex justify-center">
        <a href="{{ route('shop') }}" class="bg-gold-600 text-white px-8 py-3 rounded-full font-bold hover:bg-gold-700 transition-all shadow-lg hover:shadow-gold-500/30 flex items-center justify-center gap-2">
            View More
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
            </svg>
        </a>
    </div>
</div>
@endsection
