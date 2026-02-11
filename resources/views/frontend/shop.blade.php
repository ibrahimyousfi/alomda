@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header & Sorting -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 pb-6 border-b border-gray-200">
            <h1 class="text-3xl font-bold text-gray-900 mb-4 md:mb-0">Shop</h1>

            <div class="flex items-center gap-4">
                <span class="text-gray-500 text-sm hidden sm:inline">{{ $products->total() }} Products</span>
                <form action="{{ route('shop') }}" method="GET" id="sortForm">
                    <!-- Keep existing filters -->
                    @foreach(request()->except('sort', 'page') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <select name="sort" onchange="document.getElementById('sortForm').submit()" class="bg-white border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-gold-500 focus:border-gold-500 block p-2.5">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- Product Grid -->
        <div>
            @if($products->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-4">
                    @foreach($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-16 bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">No products found</h3>
                    <p class="text-gray-500">Try changing your search options.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
