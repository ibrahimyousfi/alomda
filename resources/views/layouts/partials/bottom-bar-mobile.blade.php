{{-- Fixed bottom navigation bar (mobile only) --}}
<div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 md:hidden pb-safe">
    <div class="grid h-full max-w-lg grid-cols-5 mx-auto font-medium">

        <a href="{{ route('home') }}" class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group {{ request()->routeIs('home') ? 'text-gold-600' : 'text-gray-500' }}">
            <svg class="w-5 h-5 mb-0.5 {{ request()->routeIs('home') ? 'text-gold-600' : 'text-gray-500 group-hover:text-gold-600' }}" xmlns="http://www.w3.org/2000/svg" fill="{{ request()->routeIs('home') ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span class="text-[9px] {{ request()->routeIs('home') ? 'text-gold-600 font-bold' : 'text-gray-500 group-hover:text-gold-600' }}">Home</span>
        </a>

        @if(isset($machinesCategory) && $machinesCategory)
        <a href="{{ route('category.parent', $machinesCategory->slug) }}" class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group {{ request()->routeIs('category.parent') && request()->route('slug') == 'machines' ? 'text-gold-600' : 'text-gray-500' }}">
            <svg class="w-5 h-5 mb-0.5 {{ request()->routeIs('category.parent') && request()->route('slug') == 'machines' ? 'text-gold-600' : 'text-gray-500 group-hover:text-gold-600' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            <span class="text-[9px] {{ request()->routeIs('category.parent') && request()->route('slug') == 'machines' ? 'text-gold-600 font-bold' : 'text-gray-500 group-hover:text-gold-600' }}">MACHINES</span>
        </a>
        @endif

        @if(isset($toolsCategory) && $toolsCategory)
        <a href="{{ route('category.parent', $toolsCategory->slug) }}" class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group {{ request()->routeIs('category.parent') && request()->route('slug') == 'tools' ? 'text-gold-600' : 'text-gray-500' }}">
            <svg class="w-5 h-5 mb-0.5 {{ request()->routeIs('category.parent') && request()->route('slug') == 'tools' ? 'text-gold-600' : 'text-gray-500 group-hover:text-gold-600' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 1 15 21a2.652 2.652 0 0 1-2.17-1L8.23 15.83a2.652 2.652 0 0 1 0-3.34L11.42 15.17Z" /><path stroke-linecap="round" stroke-linejoin="round" d="m12 15-3-3m0 0 3-3m-3 3h7.5" />
            </svg>
            <span class="text-[9px] {{ request()->routeIs('category.parent') && request()->route('slug') == 'tools' ? 'text-gold-600 font-bold' : 'text-gray-500 group-hover:text-gold-600' }}">TOOLS</span>
        </a>
        @endif

        <a href="{{ route('cart.index') }}" class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group {{ request()->routeIs('cart.index') ? 'text-gold-600' : 'text-gray-500' }} relative">
            <div class="relative">
                <svg class="w-5 h-5 mb-0.5 {{ request()->routeIs('cart.index') ? 'text-gold-600' : 'text-gray-500 group-hover:text-gold-600' }}" xmlns="http://www.w3.org/2000/svg" fill="{{ request()->routeIs('cart.index') ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 5c.07.286.074.58.074.876 0 2.409-1.855 4.369-4.143 4.369h-11.886c-2.288 0-4.143-1.96-4.143-4.369 0-.296.004-.59.074-.876l1.263-5c.236-.94.979-1.583 1.838-1.583h12.934c.86 0 1.602.643 1.838 1.583Z" />
                </svg>
                <span id="mobile-cart-badge" class="{{ session()->has('cart') && count(session('cart')) > 0 ? '' : 'hidden' }} absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[8px] font-bold w-3.5 h-3.5 flex items-center justify-center rounded-full border border-white">
                    {{ session()->has('cart') ? count(session('cart')) : 0 }}
                </span>
            </div>
            <span class="text-[9px] {{ request()->routeIs('cart.index') ? 'text-gold-600 font-bold' : 'text-gray-500 group-hover:text-gold-600' }}">Cart</span>
        </a>

        <a href="{{ route('wishlist.index') }}" class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group {{ request()->routeIs('wishlist.index') ? 'text-gold-600' : 'text-gray-500' }} relative">
            <div class="relative">
                <svg class="w-5 h-5 mb-0.5 {{ request()->routeIs('wishlist.index') ? 'text-gold-600' : 'text-gray-500 group-hover:text-gold-600' }}" xmlns="http://www.w3.org/2000/svg" fill="{{ request()->routeIs('wishlist.index') ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
                <span id="mobile-wishlist-badge" class="{{ session()->has('wishlist') && count(session('wishlist')) > 0 ? '' : 'hidden' }} absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[8px] font-bold w-3.5 h-3.5 flex items-center justify-center rounded-full border border-white">
                    {{ session()->has('wishlist') ? count(session('wishlist')) : 0 }}
                </span>
            </div>
            <span class="text-[9px] {{ request()->routeIs('wishlist.index') ? 'text-gold-600 font-bold' : 'text-gray-500 group-hover:text-gold-600' }}">Wishlist</span>
        </a>

    </div>
</div>
