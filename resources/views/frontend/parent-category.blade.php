@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-4">
                @if($parentCategory->icon)
                    <div class="w-12 h-12 text-gold-600">
                        {!! $parentCategory->icon !!}
                    </div>
                @endif
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900">{{ $parentCategory->name_en }}</h1>
            </div>
            <p class="text-lg text-gray-600">
                Browse all subcategories under {{ $parentCategory->name_en }}
            </p>
        </div>

        <!-- Child Categories Grid -->
        @if($childCategories->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                @foreach($childCategories as $child)
                    <a href="{{ route('shop', ['category' => $child->id]) }}" class="group">
                        <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all border border-amber-200/50">
                            <!-- Image Container with Golden Border -->
                            <div class="relative aspect-square bg-gray-100 overflow-hidden border-2 border-amber-400 rounded-t-lg">
                                @if($child->image)
                                    <img src="{{ asset('storage/' . $child->image) }}" alt="{{ $child->name_en }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Category Name Button -->
                            <div class="bg-amber-700 hover:bg-amber-800 text-white py-3 px-4 rounded-b-lg transition-colors">
                                <h3 class="text-sm font-semibold text-center truncate">{{ $child->name_en }}</h3>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No subcategories yet</h3>
                <p class="text-sm text-gray-500">Subcategories will appear here when added.</p>
            </div>
        @endif
    </div>
</div>
@endsection
