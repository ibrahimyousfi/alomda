@extends('admin.layouts.admin')

@section('pageHeader')
    <x-admin-page-header 
        title="Edit Category"
        :showSearch="false"
        badge="{{ $category->name_en }}"
    />
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <span class="px-3 py-1 text-xs font-medium bg-white/60 backdrop-blur-sm text-gray-700 rounded-full border border-gray-200/50">
                    Category Information
                </span>
            </div>

            <div class="p-6 space-y-6">
                <!-- Category Type -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_parent" value="1" {{ old('is_parent', $category->is_parent) ? 'checked' : '' }} id="is_parent" class="w-4 h-4 text-gold-600 border-gray-300 rounded focus:ring-gold-500">
                        <span class="text-sm font-semibold text-gray-700">This is a Parent Category (will appear in secondary header)</span>
                    </label>
                </div>

                <!-- Parent Category Selection (only if not parent) -->
                <div id="parent_selection" style="display: {{ $category->is_parent ? 'none' : 'block' }};">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Parent Category</label>
                    <select name="parent_id" class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-gold-500 focus:ring-gold-500 shadow-sm transition-all">
                        <option value="">Select Parent Category</option>
                        @foreach($parentCategories as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name_en }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Icon (only for parent categories) -->
                <div id="icon_field" style="display: {{ $category->is_parent ? 'block' : 'none' }};">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Icon (SVG code or icon name)</label>
                    <input type="text" name="icon" value="{{ old('icon', $category->icon) }}" class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-gold-500 focus:ring-gold-500 shadow-sm transition-all" placeholder="e.g. machine-icon or SVG code">
                    @error('icon') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Names -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Name (Arabic)</label>
                        <input type="text" name="name_ar" value="{{ old('name_ar', $category->name_ar) }}" class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-gold-500 focus:ring-gold-500 shadow-sm transition-all">
                        @error('name_ar') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Name (English)</label>
                        <input type="text" name="name_en" value="{{ old('name_en', $category->name_en) }}" class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-gold-500 focus:ring-gold-500 shadow-sm transition-all text-left" dir="ltr">
                        @error('name_en') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Name (French)</label>
                        <input type="text" name="name_fr" value="{{ old('name_fr', $category->name_fr) }}" class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-gold-500 focus:ring-gold-500 shadow-sm transition-all text-left" dir="ltr">
                        @error('name_fr') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Category Image</label>
                    <div class="flex gap-6 items-start">
                        @if($category->image)
                            <div class="flex-shrink-0">
                                <p class="text-xs text-gray-500 mb-2">Current Image:</p>
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $category->image) }}" class="h-32 w-32 object-cover rounded-xl border border-gray-200 shadow-sm">
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
            </div>

            <div class="bg-gray-50 px-6 py-4 flex items-center justify-end gap-3 border-t border-gray-100">
                <a href="{{ route('admin.categories.index') }}" class="text-gray-700 bg-white border border-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-xl text-sm px-5 py-2.5 hover:bg-gray-100 focus:z-10 transition-all">
                    Cancel
                </a>
                <button type="submit" class="text-white bg-gold-600 hover:bg-gold-700 focus:ring-4 focus:outline-none focus:ring-gold-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center shadow-lg shadow-gold-200 transition-all">
                    Update Category
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('is_parent').addEventListener('change', function() {
        const isParent = this.checked;
        const parentSelection = document.getElementById('parent_selection');
        const iconField = document.getElementById('icon_field');
        
        if (isParent) {
            parentSelection.style.display = 'none';
            iconField.style.display = 'block';
            document.querySelector('select[name="parent_id"]').value = '';
        } else {
            parentSelection.style.display = 'block';
            iconField.style.display = 'none';
            document.querySelector('input[name="icon"]').value = '';
        }
    });
</script>
@endsection
