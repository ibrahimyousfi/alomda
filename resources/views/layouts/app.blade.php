<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ALOMDA') }}</title>

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Cairo', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased flex flex-col min-h-screen pb-20 md:pb-0" x-data="{ mobileMenuOpen: false, searchOpen: false }">

    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo & Desktop Nav -->
                <div class="flex items-center">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center gap-2">
                            @if(file_exists(public_path('build/assets/Logo.png')))
                                <img src="{{ asset('build/assets/Logo.png') }}" alt="ALOMDA" class="h-14 w-auto">
                            @elseif(file_exists(public_path('images/Logo.png')))
                                <img src="{{ asset('images/Logo.png') }}" alt="ALOMDA" class="h-14 w-auto">
                            @else
                                <span class="text-2xl font-bold text-gray-900">ALOMDA</span>
                            @endif
                        </a>
                    </div>
                    <div class="hidden md:flex md:items-center md:gap-8 mx-10">
                        <a href="{{ route('home') }}" class="text-gray-900 hover:text-gold-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('home') ? 'text-gold-600 font-bold' : '' }}">
                            Home
                        </a>
                        <a href="{{ route('shop') }}" class="text-gray-500 hover:text-gold-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('shop') ? 'text-gold-600 font-bold' : '' }}">
                            Shop
                        </a>
                        <a href="{{ route('about') }}" class="text-gray-500 hover:text-gold-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('about') ? 'text-gold-600 font-bold' : '' }}">
                            About Us
                        </a>
                        <a href="{{ route('contact') }}" class="text-gray-500 hover:text-gold-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('contact') ? 'text-gold-600 font-bold' : '' }}">
                            Contact
                        </a>
                        <a href="{{ route('faq') }}" class="text-gray-500 hover:text-gold-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('faq') ? 'text-gold-600 font-bold' : '' }}">
                            FAQ
                        </a>
                    </div>
                </div>

                <!-- Right Side Icons -->
                <div class="hidden md:flex items-center gap-4">
                    <!-- Search Icon -->
                    <button @click="searchOpen = !searchOpen" class="text-gray-500 hover:text-gold-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>

                    <!-- Wishlist Icon -->
                    <a href="{{ route('wishlist.index') }}" class="relative text-gray-500 hover:text-gold-600 transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:fill-gold-50">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                        <span id="wishlist-badge" class="{{ session()->has('wishlist') && count(session('wishlist')) > 0 ? '' : 'hidden' }} absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full border-2 border-white">
                            {{ session()->has('wishlist') ? count(session('wishlist')) : 0 }}
                        </span>
                    </a>

                    <!-- Cart Icon -->
                    <a href="{{ route('cart.index') }}" class="relative text-gray-500 hover:text-gold-600 transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:fill-gold-50">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 5c.07.286.074.58.074.876 0 2.409-1.855 4.369-4.143 4.369h-11.886c-2.288 0-4.143-1.96-4.143-4.369 0-.296.004-.59.074-.876l1.263-5c.236-.94.979-1.583 1.838-1.583h12.934c.86 0 1.602.643 1.838 1.583Z" />
                        </svg>
                        <span id="cart-badge" class="{{ session()->has('cart') && count(session('cart')) > 0 ? '' : 'hidden' }} absolute -top-2 -right-2 bg-gold-600 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full border-2 border-white">
                            {{ session()->has('cart') ? count(session('cart')) : 0 }}
                        </span>
                    </a>


                    <!-- Mobile menu button -->
                    <div class="flex items-center md:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gold-500">
                            <span class="sr-only">Open main menu</span>
                            <!-- Icon when menu is closed -->
                            <svg x-show="!mobileMenuOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                            <!-- Icon when menu is open -->
                            <svg x-show="mobileMenuOpen" x-cloak class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition x-cloak class="md:hidden bg-white border-t border-gray-100 absolute w-full left-0 shadow-lg z-40">
            <div class="px-4 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gold-600 hover:bg-gold-50">Home</a>
                <a href="{{ route('shop') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gold-600 hover:bg-gold-50">Shop</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gold-600 hover:bg-gold-50">About Us</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gold-600 hover:bg-gold-50">Contact</a>
                <a href="{{ route('faq') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gold-600 hover:bg-gold-50">FAQ</a>
            </div>
        </div>

        <!-- Search Bar (Expandable) -->
        <div x-show="searchOpen" x-transition x-cloak class="absolute top-20 left-0 w-full bg-gray-50 border-b border-gray-200 py-4 px-4 shadow-md z-30">
            <div class="max-w-3xl mx-auto relative">
                <input type="text" placeholder="Search for products..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-gold-500">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>
    </nav>

    <!-- Secondary Header -->
    <x-secondary-header />

    <main class="flex-grow">
        <!-- Toast Component -->
        <x-toast />

        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: { message: "{{ session('success') }}", type: 'success' }
                    }));
                });
            </script>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12 text-center md:text-start">
                <div class="col-span-1 md:col-span-1">
                    @if(file_exists(public_path('build/assets/Logo.png')))
                        <img src="{{ asset('build/assets/Logo.png') }}" alt="ALOMDA" class="h-12 w-auto mb-4 mx-auto md:mx-0">
                    @elseif(file_exists(public_path('images/Logo.png')))
                        <img src="{{ asset('images/Logo.png') }}" alt="ALOMDA" class="h-12 w-auto mb-4 mx-auto md:mx-0">
                    @else
                        <h2 class="text-2xl font-bold text-white mb-4">ALOMDA</h2>
                    @endif
                    <p class="text-gray-400 text-sm leading-relaxed">
                        ALOMDA is a specialized supplier of professional tools and equipment for jewelers and artisans, offering reliable, precise, and durable solutions for high-quality work.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-gray-200">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-gray-200 transition-colors">Home</a></li>
                        <li><a href="{{ route('shop') }}" class="hover:text-gray-200 transition-colors">Shop</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-gray-200 transition-colors">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-gray-200 transition-colors">Contact</a></li>
                        <li><a href="{{ route('faq') }}" class="hover:text-gray-200 transition-colors">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-gray-200">Contact Us</h4>
                    <ul class="space-y-2 text-gray-400 text-sm flex flex-col items-center md:items-start">
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                            Contact@alomda.ma
                        </li>
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                            +212 666 732 836
                        </li>
                    </ul>
                </div>
                <div>
                     <h4 class="text-lg font-semibold mb-4">Newsletter</h4>
                     <div class="flex">
                         <input type="email" placeholder="Email Address" class="bg-gray-800 text-white px-4 py-2 rounded-l-md w-full focus:outline-none focus:ring-1 focus:ring-gold-500 border-none text-sm">
                         <button class="bg-gold-600 hover:bg-gold-700 px-4 py-2 rounded-r-md transition-colors">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                             </svg>
                         </button>
                     </div>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} ALOMDA. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <!-- Bottom Navigation Bar (Mobile) -->
    <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 md:hidden pb-safe">
        <div class="grid h-full max-w-lg grid-cols-5 mx-auto font-medium">

            <!-- Home -->
            <a href="{{ route('home') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group {{ request()->routeIs('home') ? 'text-gold-600' : 'text-gray-500' }}">
                <svg class="w-6 h-6 mb-1 {{ request()->routeIs('home') ? 'text-gold-600' : 'text-gray-500 group-hover:text-gold-600' }}" xmlns="http://www.w3.org/2000/svg" fill="{{ request()->routeIs('home') ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span class="text-[10px] {{ request()->routeIs('home') ? 'text-gold-600 font-bold' : 'text-gray-500 group-hover:text-gold-600' }}">Home</span>
            </a>

            <!-- Categories (Shop) -->
            <a href="{{ route('shop') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group {{ request()->routeIs('shop') ? 'text-gold-600' : 'text-gray-500' }}">
                <svg class="w-6 h-6 mb-1 {{ request()->routeIs('shop') ? 'text-gold-600' : 'text-gray-500 group-hover:text-gold-600' }}" xmlns="http://www.w3.org/2000/svg" fill="{{ request()->routeIs('shop') ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
                <span class="text-[10px] {{ request()->routeIs('shop') ? 'text-gold-600 font-bold' : 'text-gray-500 group-hover:text-gold-600' }}">Categories</span>
            </a>

            <!-- Cart -->
            <a href="{{ route('cart.index') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group {{ request()->routeIs('cart.index') ? 'text-gold-600' : 'text-gray-500' }} relative">
                <div class="relative">
                    <svg class="w-6 h-6 mb-1 {{ request()->routeIs('cart.index') ? 'text-gold-600' : 'text-gray-500 group-hover:text-gold-600' }}" xmlns="http://www.w3.org/2000/svg" fill="{{ request()->routeIs('cart.index') ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 5c.07.286.074.58.074.876 0 2.409-1.855 4.369-4.143 4.369h-11.886c-2.288 0-4.143-1.96-4.143-4.369 0-.296.004-.59.074-.876l1.263-5c.236-.94.979-1.583 1.838-1.583h12.934c.86 0 1.602.643 1.838 1.583Z" />
                    </svg>
                    <span id="mobile-cart-badge" class="{{ session()->has('cart') && count(session('cart')) > 0 ? '' : 'hidden' }} absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[9px] font-bold w-4 h-4 flex items-center justify-center rounded-full border border-white">
                        {{ session()->has('cart') ? count(session('cart')) : 0 }}
                    </span>
                </div>
                <span class="text-[10px] {{ request()->routeIs('cart.index') ? 'text-gold-600 font-bold' : 'text-gray-500 group-hover:text-gold-600' }}">Cart</span>
            </a>

            <!-- Account (Wishlist for now) -->
            <a href="{{ route('wishlist.index') }}" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group {{ request()->routeIs('wishlist.index') ? 'text-gold-600' : 'text-gray-500' }}">
                <svg class="w-6 h-6 mb-1 {{ request()->routeIs('wishlist.index') ? 'text-gold-600' : 'text-gray-500 group-hover:text-gold-600' }}" xmlns="http://www.w3.org/2000/svg" fill="{{ request()->routeIs('wishlist.index') ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                <span class="text-[10px] {{ request()->routeIs('wishlist.index') ? 'text-gold-600 font-bold' : 'text-gray-500 group-hover:text-gold-600' }}">Account</span>
            </a>

            <!-- More (Menu) -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group text-gray-500 focus:outline-none">
                <svg class="w-6 h-6 mb-1 group-hover:text-gold-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <span class="text-[10px] group-hover:text-gold-600">More</span>
            </button>
        </div>
    </div>
</body>
</html>
