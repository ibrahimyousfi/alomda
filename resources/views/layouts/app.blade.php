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
                        @php
                            $machinesCategory = \App\Models\Category::where('slug', 'machines')->first();
                            $toolsCategory = \App\Models\Category::where('slug', 'tools')->first();
                        @endphp
                        @if($machinesCategory)
                            <a href="{{ route('category.parent', $machinesCategory->slug) }}" class="text-gray-500 hover:text-gold-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('category.parent') && request()->route('slug') == 'machines' ? 'text-gold-600 font-bold' : '' }}">
                                MACHINES
                            </a>
                        @endif
                        @if($toolsCategory)
                            <a href="{{ route('category.parent', $toolsCategory->slug) }}" class="text-gray-500 hover:text-gold-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('category.parent') && request()->route('slug') == 'tools' ? 'text-gold-600 font-bold' : '' }}">
                                TOOLS
                            </a>
                        @endif
                        <a href="{{ route('about') }}" class="text-gray-500 hover:text-gold-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('about') ? 'text-gold-600 font-bold' : '' }}">
                            About Us
                        </a>
                    </div>
                </div>

                <!-- Right Side Icons -->
                <div class="hidden md:flex items-center gap-6">
                    <!-- Phone Number -->
                    <div class="flex items-center gap-2 text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                        <span class="text-sm font-semibold">943 097 254 928</span>
                    </div>
                    
                    <div class="flex items-center gap-4">
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


                    </div>
                    
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
                @php
                    $machinesCategory = \App\Models\Category::where('slug', 'machines')->first();
                    $toolsCategory = \App\Models\Category::where('slug', 'tools')->first();
                @endphp
                @if($machinesCategory)
                    <a href="{{ route('category.parent', $machinesCategory->slug) }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gold-600 hover:bg-gold-50">MACHINES</a>
                @endif
                @if($toolsCategory)
                    <a href="{{ route('category.parent', $toolsCategory->slug) }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gold-600 hover:bg-gold-50">TOOLS</a>
                @endif
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gold-600 hover:bg-gold-50">About Us</a>
            </div>
        </div>

        <!-- Search Bar (Expandable) -->
        <div x-show="searchOpen" x-transition x-cloak class="absolute top-20 left-0 w-full bg-gray-50 border-b border-gray-200 py-4 px-4 shadow-md z-30">
            <form action="{{ route('shop') }}" method="GET" class="max-w-3xl mx-auto relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-gold-500">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                @if(request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif
            </form>
        </div>
    </nav>


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
    <footer class="text-white pt-16 pb-8" style="background-color: #141412;">
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
                     <h4 class="text-lg font-semibold mb-4 text-gray-200">Newsletter</h4>
                     <div class="flex mb-6">
                         <input type="email" placeholder="Email Address" class="bg-gray-800 text-white px-4 py-2 rounded-l-md w-full focus:outline-none focus:ring-1 focus:ring-gold-500 border-none text-sm">
                         <button class="bg-gold-600 hover:bg-gold-700 px-4 py-2 rounded-r-md transition-colors">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                             </svg>
                         </button>
                     </div>
                     
                     <!-- Social Media Icons -->
                     <h4 class="text-lg font-semibold mb-4 text-gray-200">Follow Us</h4>
                     <div class="flex items-center gap-3 justify-center md:justify-start">
                         <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" class="w-10 h-10 flex items-center justify-center bg-gray-800 hover:bg-gold-600 rounded-full transition-colors group">
                             <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                 <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                             </svg>
                         </a>
                         
                         <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer" class="w-10 h-10 flex items-center justify-center bg-gray-800 hover:bg-gold-600 rounded-full transition-colors group">
                             <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                 <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                             </svg>
                         </a>
                         
                         <a href="https://www.youtube.com" target="_blank" rel="noopener noreferrer" class="w-10 h-10 flex items-center justify-center bg-gray-800 hover:bg-gold-600 rounded-full transition-colors group">
                             <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                 <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                             </svg>
                         </a>
                         
                         <a href="https://www.linkedin.com" target="_blank" rel="noopener noreferrer" class="w-10 h-10 flex items-center justify-center bg-gray-800 hover:bg-gold-600 rounded-full transition-colors group">
                             <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                 <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                             </svg>
                         </a>
                         
                         <a href="https://wa.me/212666732836" target="_blank" rel="noopener noreferrer" class="w-10 h-10 flex items-center justify-center bg-gray-800 hover:bg-gold-600 rounded-full transition-colors group">
                             <svg class="w-5 h-5 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                 <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                             </svg>
                         </a>
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

    <!-- Fixed Social Media Icons -->
    <div class="fixed right-0 top-1/2 transform -translate-y-1/2 z-50 hidden md:block" style="right: 20px;">
        <div class="flex flex-col gap-4">
            <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" class="w-12 h-12 flex items-center justify-center bg-white hover:bg-blue-600 rounded-l-lg shadow-lg transition-all duration-300 group border border-gray-200">
                <svg class="w-6 h-6 text-gray-700 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
            </a>
            
            <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer" class="w-12 h-12 flex items-center justify-center bg-white hover:bg-gradient-to-r hover:from-purple-500 hover:to-pink-500 rounded-l-lg shadow-lg transition-all duration-300 group border border-gray-200">
                <svg class="w-6 h-6 text-gray-700 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
            </a>
            
            <a href="https://www.youtube.com" target="_blank" rel="noopener noreferrer" class="w-12 h-12 flex items-center justify-center bg-white hover:bg-red-600 rounded-l-lg shadow-lg transition-all duration-300 group border border-gray-200">
                <svg class="w-6 h-6 text-gray-700 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                </svg>
            </a>
            
            <a href="https://www.linkedin.com" target="_blank" rel="noopener noreferrer" class="w-12 h-12 flex items-center justify-center bg-white hover:bg-blue-700 rounded-l-lg shadow-lg transition-all duration-300 group border border-gray-200">
                <svg class="w-6 h-6 text-gray-700 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- WhatsApp Button -->
    <div class="wabtn" id="wabutton">
        <style>
            [wa-tooltip] {
                position: relative;
                cursor: default;
            }
            [wa-tooltip]:hover::before {
                content: attr(wa-tooltip);
                font-size: 16px;
                text-align: center;
                position: absolute;
                display: block;
                right: calc(0% - 100px);
                left: null;
                min-width: 200px;
                max-width: 200px;
                bottom: calc(100% + 40px);
                transform: translate(-50%);
                animation: fade-in 500ms ease;
                background: #00E785;
                border-radius: 4px;
                padding: 10px;
                color: #ffffff;
                z-index: 1;
            }
            @keyframes pulse {
                0% {
                    transform: scale(1);
                }
                50% {
                    transform: scale(1.1);
                }
                100% {
                    transform: scale(1);
                }
            }
            @keyframes fade-in {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }
        </style>
        <a 
            wa-tooltip="We are at your service. Contact us now" 
            target="_blank" 
            href="https://wa.me/212661623517?text=Hello%2C%20I%20would%20like%20to%20get%20more%20information" 
            style="cursor: pointer;height: auto;width: auto;padding: 10px 10px 10px 10px;position: fixed !important;color: #fff;bottom: 20px;right: 20px;display: flex;text-decoration: none;font-size: 18px;font-weight: 600;font-family: sans-serif;align-items: center;z-index: 999999999 !important;background-color: #00E785;box-shadow: 4px 5px 10px rgba(0, 0, 0, 0.4);border-radius: 100px;animation: pulse 2.5s ease infinite;">
            <svg width="42" height="42" style="padding: 5px;" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_1024_354)">
                    <path d="M23.8759 4.06939C21.4959 1.68839 18.3316 0.253548 14.9723 0.0320463C11.613 -0.189455 8.28774 0.817483 5.61565 2.86535C2.94357 4.91323 1.10682 7.86244 0.447451 11.1638C-0.21192 14.4652 0.351026 17.8937 2.03146 20.8109L0.0625 28.0004L7.42006 26.0712C9.45505 27.1794 11.7353 27.7601 14.0524 27.7602H14.0583C16.8029 27.7599 19.4859 26.946 21.768 25.4212C24.0502 23.8965 25.829 21.7294 26.8798 19.1939C27.9305 16.6583 28.206 13.8682 27.6713 11.1761C27.1367 8.48406 25.8159 6.01095 23.8759 4.06939ZM14.0583 25.4169H14.0538C11.988 25.417 9.96008 24.8617 8.1825 23.8091L7.7611 23.5593L3.3945 24.704L4.56014 20.448L4.28546 20.0117C2.92594 17.8454 2.32491 15.2886 2.57684 12.7434C2.82877 10.1982 3.91938 7.80894 5.67722 5.95113C7.43506 4.09332 9.76045 2.87235 12.2878 2.48017C14.8152 2.08799 17.4013 2.54684 19.6395 3.78457C21.8776 5.02231 23.641 6.96875 24.6524 9.3179C25.6638 11.6671 25.8659 14.2857 25.2268 16.7622C24.5877 19.2387 23.1438 21.4326 21.122 22.999C19.1001 24.5655 16.6151 25.4156 14.0575 25.4157L14.0583 25.4169Z" fill="#E0E0E0"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.6291 7.98363C10.3723 7.41271 10.1019 7.40123 9.85771 7.39143C9.65779 7.38275 9.42903 7.38331 9.20083 7.38331C9.0271 7.3879 8.8562 7.42837 8.69887 7.5022C8.54154 7.57602 8.40119 7.68159 8.28663 7.81227C7.899 8.17929 7.59209 8.62305 7.38547 9.11526C7.17884 9.60747 7.07704 10.1373 7.08655 10.6711C7.08655 12.3578 8.31519 13.9877 8.48655 14.2164C8.65791 14.4452 10.8581 18.0169 14.3425 19.3908C17.2382 20.5327 17.8276 20.3056 18.4562 20.2485C19.0848 20.1913 20.4843 19.4194 20.7701 18.6189C21.056 17.8183 21.0557 17.1323 20.9701 16.989C20.8844 16.8456 20.6559 16.7605 20.3129 16.5889C19.9699 16.4172 18.2849 15.5879 17.9704 15.4736C17.656 15.3594 17.4275 15.3023 17.199 15.6455C16.9705 15.9888 16.3139 16.7602 16.1137 16.9895C15.9135 17.2189 15.7136 17.2471 15.3709 17.0758C14.3603 16.6729 13.4275 16.0972 12.6143 15.3745C11.8648 14.6818 11.2221 13.8819 10.7072 13.0007C10.5073 12.6579 10.6857 12.472 10.8579 12.3007C11.0119 12.1472 11.2006 11.9005 11.3722 11.7003C11.5129 11.5271 11.6282 11.3346 11.7147 11.1289C11.7603 11.0343 11.7817 10.9299 11.7768 10.825C11.7719 10.7201 11.7409 10.6182 11.6867 10.5283C11.6001 10.3566 10.9337 8.66151 10.6291 7.98363Z" fill="white"></path>
                    <path d="M23.7628 4.02445C21.4107 1.66917 18.2825 0.249336 14.9611 0.0294866C11.6397 -0.190363 8.35161 0.804769 5.70953 2.82947C3.06745 4.85417 1.25154 7.77034 0.600156 11.0346C-0.051233 14.299 0.506321 17.6888 2.16894 20.5724L0.222656 27.6808L7.49566 25.7737C9.50727 26.8692 11.7613 27.4432 14.0519 27.4434H14.0577C16.7711 27.4436 19.4235 26.6392 21.6798 25.1321C23.936 23.6249 25.6947 21.4825 26.7335 18.9759C27.7722 16.4693 28.0444 13.711 27.5157 11.0497C26.9869 8.38835 25.6809 5.94358 23.7628 4.02445ZM14.0577 25.1269H14.0547C12.0125 25.1271 10.0078 24.5782 8.25054 23.5377L7.8339 23.2907L3.51686 24.4222L4.66906 20.2143L4.39774 19.7831C3.05387 17.6415 2.4598 15.1141 2.70892 12.598C2.95804 10.082 4.03622 7.72013 5.77398 5.88366C7.51173 4.04719 9.81051 2.84028 12.3089 2.45266C14.8074 2.06505 17.3638 2.5187 19.5763 3.74232C21.7888 4.96593 23.5319 6.89011 24.5317 9.21238C25.5314 11.5346 25.7311 14.1233 25.0993 16.5714C24.4675 19.0195 23.0401 21.1883 21.0414 22.7367C19.0427 24.2851 16.5861 25.1254 14.0577 25.1255V25.1269Z" fill="white"></path>
                </g>
                <defs>
                    <clipPath id="clip0_1024_354">
                        <rect width="27.8748" height="28" fill="white" transform="translate(0.0625)"></rect>
                    </clipPath>
                </defs>
            </svg>
            <span class="button-text"></span>
        </a>
    </div>
</body>
</html>
