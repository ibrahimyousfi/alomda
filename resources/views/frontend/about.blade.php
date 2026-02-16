@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">{{ __('About Us') }}</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                {{ __('About intro') }}
            </p>
        </div>

        <!-- Large Banner -->
        <div class="mb-16 rounded-xl overflow-hidden shadow-lg">
            @if(!empty($aboutBanner))
                <img src="{{ asset('storage/' . $aboutBanner) }}" alt="ALOMDA Banner" class="w-full h-[400px] md:h-[500px] object-cover">
            @elseif(file_exists(public_path('images/about/banner.jpg')))
                <img src="{{ asset('images/about/banner.jpg') }}" alt="ALOMDA Banner" class="w-full h-[400px] md:h-[500px] object-cover">
            @elseif(file_exists(public_path('images/about/banner.png')))
                <img src="{{ asset('images/about/banner.png') }}" alt="ALOMDA Banner" class="w-full h-[400px] md:h-[500px] object-cover">
            @elseif(file_exists(public_path('images/about/banner.webp')))
                <img src="{{ asset('images/about/banner.webp') }}" alt="ALOMDA Banner" class="w-full h-[400px] md:h-[500px] object-cover">
            @else
                <div class="w-full h-[400px] md:h-[500px] bg-gradient-to-r from-gold-600 to-gold-800 flex items-center justify-center">
                    <p class="text-white text-lg">{{ __('Place banner image at') }}: <strong>public/images/about/banner.jpg</strong></p>
                </div>
            @endif
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <!-- Story Section -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                <div class="h-64 overflow-hidden">
                    @if(file_exists(public_path('images/about/image1.jpg')))
                        <img src="{{ asset('images/about/image1.jpg') }}" alt="About ALOMDA" class="w-full h-full object-cover">
                    @elseif(file_exists(public_path('images/about/image1.png')))
                        <img src="{{ asset('images/about/image1.png') }}" alt="About ALOMDA" class="w-full h-full object-cover">
                    @elseif(file_exists(public_path('images/about/image1.webp')))
                        <img src="{{ asset('images/about/image1.webp') }}" alt="About ALOMDA" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gold-100 flex items-center justify-center">
                            <p class="text-gray-500 text-sm text-center px-4">Place image at: <strong>public/images/about/image1.jpg</strong></p>
                        </div>
                    @endif
                </div>
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('About ALOMDA') }}</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        {{ __('About paragraph 1') }}
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        {{ __('About paragraph 2') }}
                    </p>
                </div>
            </div>

            <!-- Mission Section -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                <div class="h-64 overflow-hidden">
                    @if(!empty($aboutImage2))
                        <img src="{{ asset('storage/' . $aboutImage2) }}" alt="Our Vision" class="w-full h-full object-cover">
                    @elseif(file_exists(public_path('images/about/image2.jpg')))
                        <img src="{{ asset('images/about/image2.jpg') }}" alt="Our Vision" class="w-full h-full object-cover">
                    @elseif(file_exists(public_path('images/about/image2.png')))
                        <img src="{{ asset('images/about/image2.png') }}" alt="Our Vision" class="w-full h-full object-cover">
                    @elseif(file_exists(public_path('images/about/image2.webp')))
                        <img src="{{ asset('images/about/image2.webp') }}" alt="Our Vision" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gold-100 flex items-center justify-center">
                            <p class="text-gray-500 text-sm text-center px-4">{{ __('Place image at') }}: <strong>public/images/about/image2.jpg</strong></p>
                        </div>
                    @endif
                </div>
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('Our Vision') }}</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        {{ __('Vision paragraph 1') }}
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        {{ __('Vision paragraph 2') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- What We Offer -->
        <div class="bg-white rounded-xl shadow-sm p-8 border border-gray-100 mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">{{ __('What We Offer') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gold-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">{{ __('Jewelry Making & Repair Tools') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Jewelry tools desc') }}</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gold-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232 1.232 3.228 0 4.46s-3.228 1.232-4.46 0l-1.403-1.402m-4.24-4.24 1.403 1.403c1.232 1.232 3.228 1.232 4.46 0s1.232-3.228 0-4.46l-1.402-1.403m-4.24 4.24-1.403-1.402c-1.232-1.232-1.232-3.228 0-4.46s3.228-1.232 4.46 0l1.403 1.402m-4.24 4.24-1.403-1.402" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">{{ __('Precision Workshop Equipment') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Precision equipment desc') }}</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gold-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655-5.653a2.548 2.548 0 0 0-3.586 0l-1.837 1.84a2.548 2.548 0 0 0 0 3.586l5.877 5.877M11.42 15.17l-3.03 2.496a2.548 2.548 0 0 1-3.586 0l-1.837-1.84a2.548 2.548 0 0 1 0-3.586l5.877-5.877" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">{{ __('Selected Accessories') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('Selected accessories desc') }}</p>
                </div>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="bg-white rounded-xl shadow-sm p-8 border border-gray-100 mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">{{ __('Why Choose ALOMDA?') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gold-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-1">{{ __('Professional Quality') }}</h3>
                        <p class="text-sm text-gray-600">{{ __('Professional Quality desc') }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gold-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-1">{{ __('Fair & Transparent Prices') }}</h3>
                        <p class="text-sm text-gray-600">{{ __('Fair Prices desc') }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gold-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337L5 21l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-1">{{ __('Responsive Customer Service') }}</h3>
                        <p class="text-sm text-gray-600">{{ __('Customer Service desc') }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gold-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6.75m-9 3H12m10.5-3a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.5m-15 0h-1.5m0 0H3m1.5 0v-1.5m0 0V12m0-1.5V9m1.5 0h9m-9 0H3m0 0v1.5M3 15v-1.5m0 0h1.5m-1.5 0h9" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-1">{{ __('Fast Delivery & Careful Packaging') }}</h3>
                        <p class="text-sm text-gray-600">{{ __('Fast Delivery desc') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-gold-600 rounded-xl shadow-lg p-8 text-center text-white">
            <h2 class="text-2xl font-bold mb-4">{{ __('Explore Our Professional Tools') }}</h2>
            <p class="text-gold-50 mb-6 max-w-2xl mx-auto">
                {{ __('Explore CTA paragraph') }}
            </p>
            <a href="{{ route('shop') }}" class="inline-block bg-white text-gold-600 px-8 py-3 rounded-full font-bold hover:bg-gray-100 transition-colors">
                {{ __('Shop Now') }}
            </a>
        </div>
    </div>
</div>
@endsection
