<aside :class="sidebarOpen ? 'translate-x-0' : (document.dir === 'rtl' ? 'translate-x-full md:translate-x-0' : '-translate-x-full md:translate-x-0')" class="fixed md:static inset-y-0 z-20 w-64 bg-white border-r border-gray-200 transition-transform duration-300 ease-in-out flex flex-col">
    <div class="p-6 hidden md:flex items-center gap-3 border-b border-gray-100">
        @if(file_exists(public_path('build/assets/Logo.png')))
            <img src="{{ asset('build/assets/Logo.png') }}" alt="ALOMDA" class="h-10 w-auto">
        @elseif(file_exists(public_path('images/Logo.png')))
            <img src="{{ asset('images/Logo.png') }}" alt="ALOMDA" class="h-10 w-auto">
        @else
            <span class="text-lg font-bold text-gray-900">ALOMDA</span>
        @endif
    </div>

    <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.products.*') ? 'bg-gold-50 text-gold-700 font-bold shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 group-hover:scale-110 transition-transform">
                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3.75m3 3.75 3-3.75M12 16.5V12m9-3.75a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25m19.5 0v1.5a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V7.5" />
            </svg>
            Products
        </a>

        <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.categories.*') ? 'bg-gold-50 text-gold-700 font-bold shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 group-hover:scale-110 transition-transform">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 16.5c0-.621.504-1.125 1.125-1.125h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
            </svg>
            Categories
        </a>

        <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.orders.*') ? 'bg-gold-50 text-gold-700 font-bold shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 group-hover:scale-110 transition-transform">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
            Orders
        </a>

        <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group text-gray-600 hover:bg-gray-50 hover:text-gray-900 mt-4 border-t border-gray-100 pt-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 group-hover:scale-110 transition-transform">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
            </svg>
            View Store
        </a>
    </nav>

    <!-- User Profile -->
    <div class="p-4 border-t border-gray-100">
        <div class="flex items-center gap-3 px-2">
            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold">
                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-gray-900 truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email ?? 'admin@tabak.com' }}</p>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors p-2" title="Logout">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>
