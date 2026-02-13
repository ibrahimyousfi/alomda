<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ALOMDA') }}</title>

    @include('components.head-assets')

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Cairo', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased flex flex-col min-h-screen pb-20 md:pb-0" x-data="{ mobileMenuOpen: false, searchOpen: false }">

                        @php
                            $machinesCategory = \App\Models\Category::where('slug', 'machines')->first();
                            $toolsCategory = \App\Models\Category::where('slug', 'tools')->first();
                        @endphp

    @include('layouts.partials.header')

    <main class="flex-grow">
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

    @include('layouts.partials.footer')

    {{-- Mobile: fixed bottom nav --}}
    @include('layouts.partials.bottom-bar-mobile')

    {{-- Desktop: fixed social sidebar --}}
    @include('layouts.partials.sidebar-social-desktop')

    @include('layouts.partials.whatsapp-button')
</body>
</html>
