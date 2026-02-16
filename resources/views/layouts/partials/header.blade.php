{{-- Shared header: logo, desktop nav, right icons, mobile menu button --}}
<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center min-w-0 flex-1">
                <div class="shrink-0 flex items-center" style="min-width: 80px;">
                    <a href="{{ route('home') }}" class="flex items-center py-1 align-items-center">
                        <img src="{{ asset('build/assets/Logo.png') }}" alt="ALOMDA" width="120" height="56" style="display: block; height: 2.5rem; max-height: 3.5rem; width: auto; object-fit: contain;" class="sm:h-12 md:h-14 logo-img" loading="eager" onerror="this.style.display='none'; var s=this.nextElementSibling; if(s) s.style.display='block';">
                        <span class="text-xl sm:text-2xl font-bold text-gray-900 logo-fallback" style="display: none;">ALOMDA</span>
                    </a>
                </div>
                @include('layouts.partials.nav-desktop')
            </div>

            <div class="flex items-center gap-2 md:gap-6 shrink-0">
                {{-- Language: AR | FR --}}
                <div class="flex items-center gap-1 border border-gray-200 rounded-lg p-0.5">
                    <a href="{{ route('lang.switch', 'ar') }}" class="px-2 py-1 rounded text-sm font-medium {{ app()->getLocale() === 'ar' ? 'bg-gold-100 text-gold-700' : 'text-gray-500 hover:text-gray-700' }}">العربية</a>
                    <span class="text-gray-300">|</span>
                    <a href="{{ route('lang.switch', 'fr') }}" class="px-2 py-1 rounded text-sm font-medium {{ app()->getLocale() === 'fr' ? 'bg-gold-100 text-gold-700' : 'text-gray-500 hover:text-gray-700' }}">FR</a>
                </div>
                <div class="hidden md:flex items-center gap-2 text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                    <span class="text-sm font-semibold" dir="ltr">+212 661 623 517</span>
                </div>
                <div class="flex items-center gap-4">
                    <button @click="searchOpen = !searchOpen" class="text-gray-500 hover:text-gold-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                    <a href="{{ route('wishlist.index') }}" class="relative text-gray-500 hover:text-gold-600 transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:fill-gold-50">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                        <span id="wishlist-badge" class="{{ session()->has('wishlist') && count(session('wishlist')) > 0 ? '' : 'hidden' }} absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full border-2 border-white">
                            {{ session()->has('wishlist') ? count(session('wishlist')) : 0 }}
                        </span>
                    </a>
                    <a href="{{ route('cart.index') }}" class="relative text-gray-500 hover:text-gold-600 transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:fill-gold-50">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 5c.07.286.074.58.074.876 0 2.409-1.855 4.369-4.143 4.369h-11.886c-2.288 0-4.143-1.96-4.143-4.369 0-.296.004-.59.074-.876l1.263-5c.236-.94.979-1.583 1.838-1.583h12.934c.86 0 1.602.643 1.838 1.583Z" />
                        </svg>
                        <span id="cart-badge" class="{{ session()->has('cart') && count(session('cart')) > 0 ? '' : 'hidden' }} absolute -top-2 -right-2 bg-gold-600 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full border-2 border-white">
                            {{ session()->has('cart') ? count(session('cart')) : 0 }}
                        </span>
                    </a>
                </div>
                <div class="flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gold-500">
                        <span class="sr-only">Open main menu</span>
                        <svg x-show="!mobileMenuOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.partials.nav-mobile')
    @include('layouts.partials.search-bar')
</nav>
