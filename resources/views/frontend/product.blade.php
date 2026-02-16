@extends('layouts.app')

@section('content')
<!-- Breadcrumbs -->
<div class="bg-gray-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <x-breadcrumbs :items="[
            ['label' => __('Home'), 'url' => route('home')],
            ['label' => $product->translated_name]
        ]" />
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 lg:items-start">

        <!-- Image Gallery (Alpine.js) -->
        <div class="flex flex-col-reverse" x-data="{ activeImage: '{{ $product->image ? asset('storage/' . $product->image) : '' }}' }">
            <!-- Image Selector -->
            <div class="hidden mt-6 w-full max-w-2xl mx-auto sm:block lg:max-w-none">
                <div class="grid grid-cols-4 gap-6">
                    @if($product->image)
                        <button @click="activeImage = '{{ asset('storage/' . $product->image) }}'" class="relative h-24 bg-white rounded-md flex items-center justify-center text-sm font-medium uppercase text-gray-900 cursor-pointer hover:bg-gray-50 focus:outline-none focus:ring focus:ring-offset-4 focus:ring-opacity-50" :class="{ 'ring-2 ring-gold-500': activeImage === '{{ asset('storage/' . $product->image) }}', 'border border-gray-200': activeImage !== '{{ asset('storage/' . $product->image) }}' }">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="" class="w-full h-full object-cover rounded-md">
                        </button>
                    @endif

                    @if($product->images)
                        @foreach($product->images as $img)
                            <button @click="activeImage = '{{ asset('storage/' . $img) }}'" class="relative h-24 bg-white rounded-md flex items-center justify-center text-sm font-medium uppercase text-gray-900 cursor-pointer hover:bg-gray-50 focus:outline-none focus:ring focus:ring-offset-4 focus:ring-opacity-50" :class="{ 'ring-2 ring-gold-500': activeImage === '{{ asset('storage/' . $img) }}', 'border border-gray-200': activeImage !== '{{ asset('storage/' . $img) }}' }">
                                <img src="{{ asset('storage/' . $img) }}" alt="" class="w-full h-full object-cover rounded-md">
                            </button>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Main Image -->
            <div class="w-full aspect-[1/1] rounded-2xl overflow-hidden bg-gray-100 relative group">
                @if($product->image)
                    <img :src="activeImage" alt="{{ $product->name_en }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-24 h-24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                @endif

                <!-- Zoom Icon Overlay -->
                <div class="absolute top-4 right-4 bg-white/80 p-2 rounded-full backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-700">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607ZM10.5 7.5v6m3-3h-6" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
            <div class="mb-6">
                <span class="text-gold-600 font-bold tracking-wider uppercase text-xs bg-gold-50 px-3 py-1 rounded-full">
                    {{ $product->category->translated_name }}
                </span>
                <div class="flex justify-between items-start mt-4">
                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $product->name_en }}</h1>
                    <div class="relative">
                        @php
                            $isInWishlist = session()->has('wishlist') && isset(session('wishlist')[$product->id]);
                        @endphp
                        <x-wishlist-button 
                            :productId="$product->id" 
                            :isInWishlist="$isInWishlist"
                            size="lg"
                            position="static"
                        />
                    </div>
                </div>

                <div class="mt-3 flex items-end gap-4">
                    <x-price :price="$product->price" size="2xl" />
                    <div class="flex items-center gap-1 mb-1">
                         <div class="flex text-yellow-400">
                             <!-- 5 Stars -->
                             <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                             <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                             <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                             <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                             <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                         </div>
                         <span class="text-sm text-gray-500">(120 Reviews)</span>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <h3 class="sr-only">Description</h3>
                <div class="text-base text-gray-700 space-y-6 leading-relaxed">
                    <p>{{ $product->translated_description }}</p>
                </div>
            </div>

            <div x-data="{ qty: 1 }">
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <!-- Quantity -->
                    <div class="flex items-center gap-4 mb-8">
                        <label class="font-medium text-gray-700">{{ __('Quantity') }}:</label>
                        <div class="flex items-center border border-gray-300 rounded-lg">
                            <button type="button" @click="qty > 1 ? qty-- : qty = 1" class="px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-l-lg">-</button>
                            <input type="number" x-model="qty" class="w-12 text-center border-none focus:ring-0 p-0 text-gray-900" min="1" readonly>
                            <button type="button" @click="qty++" class="px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-r-lg">+</button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 mb-8">
                        <!-- Add to Cart -->
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" x-bind:value="qty">
                            <button type="submit" class="w-full bg-gold-50 text-gold-700 border border-gold-200 rounded-xl py-4 px-8 flex items-center justify-center text-base font-bold hover:bg-gold-100 transition-all gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>
                                Add to Cart
                            </button>
                        </form>

                        <!-- WhatsApp -->
                        @php
                            $message = urlencode("Hello, I would like to order: " . $product->translated_name);
                        @endphp
                        <a href="https://wa.me/966500000000?text={{ $message }}" target="_blank" class="flex-1 bg-white border border-gray-300 rounded-xl py-4 px-8 flex items-center justify-center text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold-500 transition-all gap-2">
                            <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            {{ __('WhatsApp') }}
                        </a>
                    </div>

                    <!-- Quick Checkout Form -->
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" x-bind:value="qty">

                        <!-- Customer Info (Collapsible or Clean Form) -->
                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 mb-8">
                            <h3 class="text-sm font-bold text-gray-900 mb-4 uppercase tracking-wide flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                Quick Checkout Details
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="col-span-2 md:col-span-1">
                                    <input type="text" name="customer_name" placeholder="Full Name" required class="w-full px-4 py-3 rounded-lg border-gray-300 focus:border-gold-500 focus:ring-gold-500 text-sm">
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <input type="text" name="customer_phone" placeholder="Phone Number" required class="w-full px-4 py-3 rounded-lg border-gray-300 focus:border-gold-500 focus:ring-gold-500 text-sm">
                                </div>
                                <div class="col-span-2">
                                    <input type="text" name="customer_address" placeholder="Address" required class="w-full px-4 py-3 rounded-lg border-gray-300 focus:border-gold-500 focus:ring-gold-500 text-sm">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-gold-600 border border-transparent rounded-full py-4 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-gold-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold-500 shadow-lg shadow-gold-500/30 transition-all">
                            Complete Quick Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mt-24">
            <h2 class="text-2xl font-bold mb-8 text-gray-900">{{ __('You May Also Like') }}</h2>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
                @foreach($relatedProducts as $related)
                    <x-product-card :product="$related" />
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection

