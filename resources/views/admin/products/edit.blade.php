@extends('admin.layouts.admin')

@section('pageHeader')
    <x-admin-page-header 
        title="Edit Product"
        :showSearch="false"
        badge="{{ $product->name_en }}"
    />
@endsection

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Info -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <span class="px-3 py-1 text-xs font-medium bg-white/60 backdrop-blur-sm text-gray-700 rounded-full border border-gray-200/50">
                            Basic Product Information
                        </span>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Name (Arabic)</label>
                                <input type="text" name="name_ar" value="{{ old('name_ar', $product->name_ar) }}" class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-gold-500 focus:ring-gold-500 shadow-sm transition-all">
                                @error('name_ar') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Name (English)</label>
                                <input type="text" name="name_en" value="{{ old('name_en', $product->name_en) }}" class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-gold-500 focus:ring-gold-500 shadow-sm transition-all text-left" dir="ltr">
                                @error('name_en') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Description (Arabic)</label>
                            <textarea name="description_ar" rows="4" class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-gold-500 focus:ring-gold-500 shadow-sm transition-all">{{ old('description_ar', $product->description_ar) }}</textarea>
                            @error('description_ar') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Description (English)</label>
                            <textarea name="description_en" rows="4" class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-gold-500 focus:ring-gold-500 shadow-sm transition-all text-left" dir="ltr">{{ old('description_en', $product->description_en) }}</textarea>
                            @error('description_en') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Media -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <span class="px-3 py-1 text-xs font-medium bg-white/60 backdrop-blur-sm text-gray-700 rounded-full border border-gray-200/50">
                            Images & Media
                        </span>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Main Image -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Main Product Image</label>
                            <div class="flex gap-6 items-start">
                                @if($product->image)
                                    <div class="flex-shrink-0">
                                        <p class="text-xs text-gray-500 mb-2">Current Image:</p>
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $product->image) }}" class="h-32 w-32 object-cover rounded-xl border border-gray-200 shadow-sm">
                                        </div>
                                    </div>
                                @endif

                                <div class="flex-grow">
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 transition-colors cursor-pointer group h-full" onclick="document.getElementById('image').click()">
                                        <div class="space-y-1 text-center self-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-gold-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600 justify-center">
                                                <label for="image" class="relative cursor-pointer rounded-md font-medium text-gold-600 hover:text-gold-500 focus-within:outline-none">
                                                    <span>Change Image</span>
                                                    <input id="image" name="image" type="file" class="sr-only">
                                                </label>
                                            </div>
                                            <p class="text-xs text-gray-500">Leave empty to keep current image</p>
                                        </div>
                                    </div>
                                    @error('image') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Gallery -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Additional Image Gallery</label>

                            @if($product->images && count($product->images) > 0)
                                <div class="mb-4">
                                    <p class="text-xs text-gray-500 mb-2">Current Gallery Images:</p>
                                    <div class="grid grid-cols-4 md:grid-cols-6 gap-3">
                                        @foreach($product->images as $img)
                                            <div class="relative group aspect-square">
                                                <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover rounded-lg border border-gray-200">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="mt-2">
                                <label class="block text-xs font-medium text-gray-700 mb-1">Add New Images:</label>
                                <input type="file" name="gallery[]" multiple class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2.5 file:px-4
                                    file:rounded-xl file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-gold-50 file:text-gold-700
                                    hover:file:bg-gold-100
                                    transition-all
                                ">
                                <p class="text-xs text-gray-500 mt-2">New images will be added to the current gallery</p>
                                @error('gallery') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Status & Category -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <span class="px-3 py-1 text-xs font-medium bg-white/60 backdrop-blur-sm text-gray-700 rounded-full border border-gray-200/50">
                            Category & Status
                        </span>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                            <select name="category_id" class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-gold-500 focus:ring-gold-500 shadow-sm transition-all">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_en }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                            <div>
                                <label for="is_featured" class="font-medium text-gray-700 cursor-pointer select-none">Featured Product</label>
                                <p class="text-xs text-gray-500">Display on homepage</p>
                            </div>
                            <div class="relative inline-block w-12 mr-2 align-middle select-none transition duration-200 ease-in">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer border-gray-300 checked:right-0 checked:border-gold-600"/>
                                <label for="is_featured" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                            <style>
                                .toggle-checkbox:checked {
                                    right: 0;
                                    border-color: #10b981;
                                }
                                .toggle-checkbox:checked + .toggle-label {
                                    background-color: #10b981;
                                }
                                .toggle-checkbox {
                                    right: auto;
                                    left: 0;
                                    transition: all 0.3s;
                                }
                                .toggle-checkbox:checked {
                                    left: auto;
                                    right: 0;
                                }
                            </style>
                        </div>
                    </div>
                </div>

                <!-- Pricing & Inventory -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <span class="px-3 py-1 text-xs font-medium bg-white/60 backdrop-blur-sm text-gray-700 rounded-full border border-gray-200/50">
                            Pricing & Inventory
                        </span>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Price</label>
                            <div class="relative">
                                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-gold-500 focus:ring-gold-500 shadow-sm transition-all pl-12">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">MAD</span>
                                </div>
                            </div>
                            @error('price') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Stock</label>
                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-gold-500 focus:ring-gold-500 shadow-sm transition-all">
                            @error('stock') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col gap-3">
                    <button type="submit" class="w-full bg-gold-600 hover:bg-gold-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-gold-200 transition-all">
                        Update Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="w-full bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-bold py-3 px-4 rounded-xl text-center transition-all">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
