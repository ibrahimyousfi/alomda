{{-- Desktop navigation links (hidden on mobile) --}}
<div class="hidden md:flex md:items-center md:gap-8 mx-10">
    <a href="{{ route('home') }}" class="text-gray-900 hover:text-gold-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('home') ? 'text-gold-600 font-bold' : '' }}">
        {{ __('Home') }}
    </a>
    @if(isset($machinesCategory) && $machinesCategory)
        <a href="{{ route('category.parent', $machinesCategory->slug) }}" class="text-gray-500 hover:text-gold-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('category.parent') && request()->route('slug') == 'machines' ? 'text-gold-600 font-bold' : '' }}">
            {{ __('MACHINES') }}
        </a>
    @endif
    @if(isset($toolsCategory) && $toolsCategory)
        <a href="{{ route('category.parent', $toolsCategory->slug) }}" class="text-gray-500 hover:text-gold-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('category.parent') && request()->route('slug') == 'tools' ? 'text-gold-600 font-bold' : '' }}">
            {{ __('TOOLS') }}
        </a>
    @endif
    <a href="{{ route('about') }}" class="text-gray-500 hover:text-gold-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('about') ? 'text-gold-600 font-bold' : '' }}">
        {{ __('About Us') }}
    </a>
</div>
