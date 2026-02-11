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

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <div class="lg:w-1/4">
                <div class="bg-white p-6 rounded-xl shadow-sm sticky top-24">
                    <form action="{{ route('shop') }}" method="GET">
                        @if(request('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif

                        <!-- Search -->
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-900 mb-2">Search</label>
                            <div class="relative">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-gold-500 focus:border-gold-500 text-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="mb-6">
                            <h3 class="font-bold text-gray-900 mb-3">Categories</h3>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="category" value="" {{ !request('category') ? 'checked' : '' }} class="text-gold-600 focus:ring-gold-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-600">All</span>
                                </label>
                                
                                @foreach($categories['parents'] as $parent)
                                    @if($parent->children->count() > 0)
                                        <!-- Parent Category -->
                                        <div class="pt-2">
                                            <div class="flex items-center justify-between mb-1">
                                                <span class="text-xs font-semibold text-gray-500 uppercase">{{ $parent->name_en }}</span>
                                                @if($parent->products_count > 0)
                                                    <span class="text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">{{ $parent->products_count }}</span>
                                                @endif
                                            </div>
                                            <!-- Child Categories -->
                                            <div class="ml-3 space-y-1">
                                                @foreach($parent->children as $child)
                                                    @if($child->products_count > 0)
                                                        <label class="flex items-center justify-between group cursor-pointer">
                                                            <div class="flex items-center">
                                                                <input type="radio" name="category" value="{{ $child->id }}" {{ request('category') == $child->id ? 'checked' : '' }} class="text-gold-600 focus:ring-gold-500 border-gray-300">
                                                                <span class="ml-2 text-sm text-gray-600 group-hover:text-gold-600 transition-colors">
                                                                    {{ $child->name_en }}
                                                                </span>
                                                            </div>
                                                            <span class="text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">{{ $child->products_count }}</span>
                                                        </label>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @elseif($parent->products_count > 0)
                                        <!-- Parent without children but has products -->
                                        <label class="flex items-center justify-between group cursor-pointer">
                                            <div class="flex items-center">
                                                <input type="radio" name="category" value="{{ $parent->id }}" {{ request('category') == $parent->id ? 'checked' : '' }} class="text-gold-600 focus:ring-gold-500 border-gray-300">
                                                <span class="ml-2 text-sm text-gray-600 group-hover:text-gold-600 transition-colors">
                                                    {{ $parent->name_en }}
                                                </span>
                                            </div>
                                            <span class="text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">{{ $parent->products_count }}</span>
                                        </label>
                                    @endif
                                @endforeach
                                
                                <!-- Standalone child categories (without parent or parent not found) -->
                                @foreach($categories['children'] as $child)
                                    @if(!$child->parent || !$categories['parents']->contains('id', $child->parent_id))
                                        <label class="flex items-center justify-between group cursor-pointer">
                                            <div class="flex items-center">
                                                <input type="radio" name="category" value="{{ $child->id }}" {{ request('category') == $child->id ? 'checked' : '' }} class="text-gold-600 focus:ring-gold-500 border-gray-300">
                                                <span class="ml-2 text-sm text-gray-600 group-hover:text-gold-600 transition-colors">
                                                    {{ $child->name_en }}
                                                </span>
                                            </div>
                                            <span class="text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">{{ $child->products_count }}</span>
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-6">
                            <h3 class="font-bold text-gray-900 mb-3">Price</h3>
                            <div class="flex items-center gap-2">
                                <input type="number" name="min_price" value="{{ request('min_price', $minPrice) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-gold-500 focus:border-gold-500" placeholder="Min">
                                <span class="text-gray-400">-</span>
                                <input type="number" name="max_price" value="{{ request('max_price', $maxPrice) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-gold-500 focus:border-gold-500" placeholder="Max">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-gold-600 text-white py-2.5 rounded-lg font-bold hover:bg-gold-700 transition-colors shadow-md">
                            Filter
                        </button>

                        @if(request()->hasAny(['search', 'category', 'min_price', 'max_price']))
                            <a href="{{ route('shop') }}" class="block w-full text-center mt-3 text-sm text-gray-500 hover:text-red-500 transition-colors">
                                Clear Filters
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="lg:w-3/4">
                @if($products->count() > 0)
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6">
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
                        <p class="text-gray-500">Try changing your search or filter options.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
