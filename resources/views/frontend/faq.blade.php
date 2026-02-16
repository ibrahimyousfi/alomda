@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">{{ __('Frequently Asked Questions') }}</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                {{ __('FAQ intro') }}
            </p>
        </div>

        <!-- FAQ Items -->
        <div class="space-y-4" x-data="{ openItem: null }">
            @php
                $faqs = [
                    ['question' => __('faq_q1'), 'answer' => __('faq_a1')],
                    ['question' => __('faq_q2'), 'answer' => __('faq_a2')],
                    ['question' => __('faq_q3'), 'answer' => __('faq_a3')],
                    ['question' => __('faq_q4'), 'answer' => __('faq_a4')],
                    ['question' => __('faq_q5'), 'answer' => __('faq_a5')],
                    ['question' => __('faq_q6'), 'answer' => __('faq_a6')],
                    ['question' => __('faq_q7'), 'answer' => __('faq_a7')],
                    ['question' => __('faq_q8'), 'answer' => __('faq_a8')],
                    ['question' => __('faq_q9'), 'answer' => __('faq_a9')],
                    ['question' => __('faq_q10'), 'answer' => __('faq_a10')],
                ];
            @endphp

            @foreach($faqs as $index => $faq)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ open: false }">
                    <button 
                        @click="open = !open" 
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors"
                    >
                        <span class="font-semibold text-gray-900 pr-4">{{ $faq['question'] }}</span>
                        <svg 
                            xmlns="http://www.w3.org/2000/svg" 
                            fill="none" 
                            viewBox="0 0 24 24" 
                            stroke-width="2" 
                            stroke="currentColor" 
                            class="w-5 h-5 text-gray-500 flex-shrink-0 transition-transform"
                            :class="{ 'rotate-180': open }"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div 
                        x-show="open"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2"
                        class="px-6 pb-4 text-gray-600 leading-relaxed"
                    >
                        {{ $faq['answer'] }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Contact CTA -->
        <div class="mt-12 bg-gold-600 rounded-xl shadow-lg p-8 text-center text-white">
            <h2 class="text-2xl font-bold mb-4">{{ __('Still have questions?') }}</h2>
            <p class="text-gold-50 mb-6">
                {{ __('FAQ CTA message') }}
            </p>
            <a href="{{ route('contact') }}" class="inline-block bg-white text-gold-600 px-8 py-3 rounded-full font-bold hover:bg-gray-100 transition-colors">
                {{ __('Contact Us') }}
            </a>
        </div>
    </div>
</div>
@endsection
