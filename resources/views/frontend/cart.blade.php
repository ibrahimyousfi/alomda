@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">{{ __('Shopping Cart') }}</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items -->
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6 space-y-6">
                            @foreach($cart as $id => $details)
                                <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-gray-100 last:border-0 last:pb-0" x-data="{ quantity: {{ $details['quantity'] }} }">
                                    <div class="w-24 h-24 shrink-0 bg-gray-100 rounded-lg overflow-hidden">
                                        <x-product-image :image="$details['image']" :alt="$details['name_en']" class="w-full h-full object-cover" />
                                    </div>
                                    
                                    <div class="flex-1 text-center sm:text-start">
                                        <h3 class="text-lg font-bold text-gray-900 mb-1">
                                            <a href="{{ route('product.show', $details['slug']) }}" class="hover:text-gold-600 transition-colors">
                                                {{ $details['name_en'] }}
                                            </a>
                                        </h3>
                                        <x-price :price="$details['price']" />
                                    </div>

                                    <div class="flex items-center border border-gray-300 rounded-lg">
                                        <button @click="quantity > 1 ? quantity-- : quantity = 1; updateCart('{{ $id }}', quantity)" class="px-3 py-1 hover:bg-gray-50 text-gray-600">-</button>
                                        <input type="number" x-model="quantity" class="w-12 text-center border-none focus:ring-0 p-0 text-sm" readonly>
                                        <button @click="quantity++; updateCart('{{ $id }}', quantity)" class="px-3 py-1 hover:bg-gray-50 text-gray-600">+</button>
                                    </div>

                                    <button onclick="removeFromCart('{{ $id }}')" class="text-red-500 hover:text-red-700 p-2 transition-colors" title="{{ __('Remove') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                        <h2 class="text-lg font-bold text-gray-900 mb-6">Order Summary</h2>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span>{{ number_format($total, 2) }} MAD</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span class="text-green-600">Free</span>
                            </div>
                            <div class="border-t border-gray-100 pt-4 flex justify-between font-bold text-lg text-gray-900">
                                <span>Total</span>
                                <span>{{ number_format($total, 2) }} MAD</span>
                            </div>
                        </div>

                        <a href="#" class="block w-full bg-gold-600 text-white text-center py-3 rounded-lg font-bold hover:bg-gold-700 transition-colors shadow-lg shadow-gold-500/30">
                            Checkout
                        </a>
                        
                        <a href="{{ route('shop') }}" class="block w-full text-center py-3 mt-2 text-gold-600 font-medium hover:text-gold-700">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        @else
            <x-empty-state 
                icon="cart"
                :title="__('Your cart is empty')"
                :message="__('Add items to get started.')"
                :actionRoute="route('shop')"
                :actionText="__('Browse Shop')"
            />
        @endif
    </div>
</div>

@endsection
