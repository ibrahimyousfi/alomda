<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased" x-data="{ sidebarOpen: false }">
    <div class="min-h-screen flex flex-col md:flex-row">

        <x-admin-mobile-header />

        <x-admin-sidebar />

        <x-admin-overlay />

        <!-- Main Content -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            <x-admin-header />

            <!-- Scrollable Content -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                <div class="max-w-6xl mx-auto">
                    <x-admin-success-message />
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
