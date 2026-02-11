@props(['product'])

<div class="group bg-white rounded-lg sm:rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 flex flex-col h-full overflow-hidden relative">
    <!-- Badges -->
    @if($product->is_featured)
        <div class="absolute top-2 left-2 z-10 bg-yellow-400 text-yellow-900 text-[10px] sm:text-xs font-bold px-1.5 py-0.5 rounded shadow-sm">
            FEATURED
        </div>
    @endif

    <!-- Image Container - Square -->
    <div class="relative aspect-square bg-gray-100 overflow-hidden">
        <a href="{{ route('product.show', $product->slug) }}" class="block w-full h-full">
            <x-product-image 
                :image="$product->image" 
                :alt="$product->name_en" 
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
            />
        </a>

        <x-wishlist-button 
            :productId="$product->id" 
            :isInWishlist="session()->has('wishlist') && isset(session('wishlist')[$product->id])"
            size="sm"
        />
    </div>

    <!-- Content -->
    <div class="p-3 sm:p-4 flex flex-col gap-2">
        <!-- Category & Rating in same line -->
        <div class="flex items-center justify-between gap-2">
            <div class="text-[10px] sm:text-xs text-gray-500 uppercase tracking-wide truncate">
                {{ $product->category->name_en }}
            </div>
            <!-- Rating -->
            <div class="flex items-center gap-1 text-yellow-400 text-[10px] sm:text-xs flex-shrink-0">
                <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                <span class="text-gray-400 font-medium">4.9</span>
            </div>
        </div>

        <!-- Title & Price in same line -->
        <div class="flex items-start justify-between gap-2">
            <h3 class="font-bold text-gray-900 text-sm sm:text-base leading-tight line-clamp-2 flex-1 min-w-0">
                <a href="{{ route('product.show', $product->slug) }}" class="hover:text-gold-600 transition-colors">
                    {{ $product->name_en }}
                </a>
            </h3>
            <div class="flex-shrink-0">
                <x-price :price="$product->price" />
            </div>
        </div>

        <!-- Action Button -->
        <div class="pt-1">
            <x-add-to-cart-button :productId="$product->id" />
        </div>
    </div>
</div>
