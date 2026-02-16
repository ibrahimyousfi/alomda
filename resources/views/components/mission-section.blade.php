@props([
    'primaryImage' => null,
    'fallbackImage' => null,
])

@php
    $primaryImage = $primaryImage ?? asset('images/about/alomda.gif');
    $fallbackImage = $fallbackImage ?? asset('images/about/mission.jpg');
@endphp

<section class="bg-gradient-to-br from-gray-50 to-white py-20" aria-labelledby="mission-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <img src="{{ $primaryImage }}" alt="ALOMDA" class="w-full h-[500px] object-cover rounded-2xl shadow-xl mission-img" onerror="this.style.display='none'; var m=document.getElementById('mission-fallback'); if(m) m.style.display='block';">
                <img id="mission-fallback" src="{{ $fallbackImage }}" alt="ALOMDA Mission" class="w-full h-[500px] object-cover rounded-2xl shadow-xl" style="display: none;" onerror="this.style.display='none'; document.getElementById('mission-placeholder').style.display='flex';">
                <div id="mission-placeholder" class="w-full h-[500px] bg-gradient-to-br from-gold-100 to-gold-200 rounded-2xl shadow-xl flex items-center justify-center" style="display: none;">
                    <span class="text-gray-600 text-center px-4">ALOMDA</span>
                </div>
            </div>

            <div class="order-1 lg:order-2 space-y-8">
                <div>
                    <span class="text-gold-600 font-bold tracking-wider uppercase text-sm">{{ __('Excellence in Quality') }}</span>
                    <h2 id="mission-heading" class="text-4xl md:text-5xl font-bold text-gray-900 mt-4 mb-6">{{ __('Premium Quality Tools') }}</h2>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        {{ __('Mission paragraph') }}
                    </p>
                </div>

                <ul class="space-y-4" role="list">
                    <li class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center flex-shrink-0" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gold-600"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.645-5.963-1.758A6.967 6.967 0 0 0 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.059 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" /></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-1">{{ __('Supporting Professionals') }}</h4>
                            <p class="text-gray-600 text-sm">{{ __('Supporting Professionals desc') }}</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center flex-shrink-0" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gold-600"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6.11m0 0A11.99 11.99 0 0 0 3 12c0 2.243.467 4.358 1.298 6.28m0 0a11.95 11.95 0 0 0 4.83 4.83m-4.83-4.83a11.95 11.95 0 0 1 4.83-4.83m0 0a11.99 11.99 0 0 1 3.664-1.098m-3.664 1.098a11.959 11.959 0 0 1 2.513-1.098m3.664 1.098a11.99 11.99 0 0 0 3.664 1.098m-3.664-1.098a11.95 11.95 0 0 1 4.83-4.83m0 0a11.99 11.99 0 0 1 3.664-1.098m-3.664 1.098a11.959 11.959 0 0 1 2.513-1.098m3.664 1.098a11.99 11.99 0 0 0 3.664 1.098m-3.664-1.098a11.95 11.95 0 0 1-4.83 4.83m4.83-4.83a11.95 11.95 0 0 0-4.83-4.83" /></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-1">{{ __('Quality & Reliability') }}</h4>
                            <p class="text-gray-600 text-sm">{{ __('Quality & Reliability desc') }}</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center flex-shrink-0" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gold-600"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" /></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-1">{{ __('Comprehensive Range') }}</h4>
                            <p class="text-gray-600 text-sm">{{ __('Comprehensive Range desc') }}</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center flex-shrink-0" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gold-600"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" /></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-1">{{ __('Innovation & Evolution') }}</h4>
                            <p class="text-gray-600 text-sm">{{ __('Innovation & Evolution desc') }}</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
