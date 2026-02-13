{{-- Mobile dropdown menu (visible on mobile only) --}}
<div x-show="mobileMenuOpen" x-transition x-cloak class="md:hidden bg-white border-t border-gray-100 absolute w-full left-0 shadow-lg z-40">
    <div class="px-4 pt-2 pb-3 space-y-1">
        <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gold-600 hover:bg-gold-50">Home</a>
        @if(isset($machinesCategory) && $machinesCategory)
            <a href="{{ route('category.parent', $machinesCategory->slug) }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gold-600 hover:bg-gold-50">MACHINES</a>
        @endif
        @if(isset($toolsCategory) && $toolsCategory)
            <a href="{{ route('category.parent', $toolsCategory->slug) }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gold-600 hover:bg-gold-50">TOOLS</a>
        @endif
        <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gold-600 hover:bg-gold-50">About Us</a>
    </div>
</div>
