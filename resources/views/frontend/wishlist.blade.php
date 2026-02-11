@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Wishlist</h1>

        @if(count($wishlist) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($wishlist as $item)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden group hover:shadow-md transition-shadow">
                        <div class="relative aspect-[4/5] bg-gray-100 overflow-hidden">
                            <x-product-image 
                                :image="$item['image']" 
                                :alt="$item['name_en']" 
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" 
                            />
                            
                            <x-wishlist-button 
                                :productId="$item['id']" 
                                :isInWishlist="true"
                                size="md"
                                position="absolute"
                            />
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-1 truncate">
                                <a href="{{ route('product.show', $item['slug']) }}">{{ $item['name_en'] }}</a>
                            </h3>
                            <x-price :price="$item['price']" class="mb-4" />
                            
                            <x-add-to-cart-button :productId="$item['id']" variant="outline" />
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <x-empty-state 
                icon="heart"
                title="Your wishlist is empty"
                message="Save items you love here."
                :actionRoute="route('shop')"
                actionText="Browse Shop"
            />
        @endif
    </div>
</div>
@endsection
