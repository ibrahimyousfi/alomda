<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Admin Login') }} - ALOMDA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Cairo', sans-serif; }</style>
</head>
<body class="bg-gray-50 h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl border border-gray-100 p-8 transform transition-all hover:scale-[1.01]">
        <div class="text-center mb-8">
            @if(file_exists(public_path('build/assets/Logo.png')))
                <img src="{{ asset('build/assets/Logo.png') }}" alt="ALOMDA" class="h-20 w-auto mx-auto mb-4">
            @elseif(file_exists(public_path('images/Logo.png')))
                <img src="{{ asset('images/Logo.png') }}" alt="ALOMDA" class="h-20 w-auto mx-auto mb-4">
            @else
                <h1 class="text-3xl font-bold text-gray-900 mb-4">ALOMDA</h1>
            @endif
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Tabak<span class="text-gold-600">Store</span></h1>
            <p class="text-gray-500 text-sm mt-2 font-medium">Admin Dashboard</p>
        </div>

        <form action="{{ route('admin.login.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                <div class="relative">
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-gold-500 focus:border-gold-500 transition-all pl-10">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-gold-500 focus:border-gold-500 transition-all pl-10">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="remember" class="text-gold-600 focus:ring-gold-500 rounded border-gray-300 w-4 h-4">
                    <span class="ml-2 text-sm text-gray-600 font-medium">Remember Me</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-gold-600 text-white py-3.5 rounded-xl font-bold hover:bg-gold-700 transition-all shadow-lg shadow-gold-200 flex justify-center items-center gap-2 group">
                <span>Login</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:-translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                </svg>
            </button>
        </form>

        <div class="mt-8 text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} ALOMDA. All rights reserved
        </div>
    </div>
</body>
</html>
