<div class="md:hidden bg-white border-b border-gray-200 p-4 flex justify-between items-center sticky top-0 z-30">
    <div class="flex items-center gap-2">
        @if(file_exists(public_path('build/assets/Logo.png')))
            <img src="{{ asset('build/assets/Logo.png') }}" alt="ALOMDA" class="h-8 w-auto">
        @elseif(file_exists(public_path('images/Logo.png')))
            <img src="{{ asset('images/Logo.png') }}" alt="ALOMDA" class="h-8 w-auto">
        @else
            <span class="text-base font-bold text-gray-900">ALOMDA</span>
        @endif
        <span class="font-bold text-gray-800">Tabak Admin</span>
    </div>
    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gold-600 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
</div>
