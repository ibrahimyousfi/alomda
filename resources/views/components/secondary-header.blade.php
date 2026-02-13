@php
    $parentCategories = \App\Models\Category::where('is_parent', true)->orderBy('name_en')->get();
@endphp

<div class="bg-white border-b border-gray-200 sticky top-20 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14">
            <!-- Parent Categories -->
            <div class="flex items-center gap-6">
                @foreach($parentCategories as $parent)
                    @php
                        // If category name is "Products", link to shop page, otherwise link to parent category page
                        $link = strtolower($parent->name_en) === 'products' 
                            ? route('shop') 
                            : route('category.parent', $parent->slug);
                    @endphp
                    <a href="{{ $link }}" class="flex items-center gap-2 text-gray-700 hover:text-gold-600 transition-colors group">
                        @if($parent->icon)
                            <div class="w-5 h-5 text-gray-600 group-hover:text-gold-600">
                                {!! $parent->icon !!}
                            </div>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-600 group-hover:text-gold-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 16.5c0-.621.504-1.125 1.125-1.125h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                            </svg>
                        @endif
                        <span class="text-sm font-medium">{{ $parent->name_en }}</span>
                    </a>
                @endforeach
            </div>

            <!-- Phone Number -->
            <div class="flex items-center gap-2 text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769-.335-.759-.75l.05-4.5a1.25 1.25 0 0 0-.75-1.2l-3.5-1.75a1.25 1.25 0 0 0-1.2 0l-3.5 1.75a1.25 1.25 0 0 0-.75 1.2l.05 4.5c.01.415-.477.626-.759.75l-.97-1.293a1.25 1.25 0 0 0-1.173-.417l-4.423 1.106c-.5.125-.852.575-.852 1.091v1.372A2.25 2.25 0 0 0 2.25 19.5h2.25Z" />
                </svg>
                <span class="text-sm font-semibold">+212 661 623 517</span>
            </div>
        </div>
    </div>
</div>
