@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Find answers to common questions about our professional tools, equipment, shipping, and services.
            </p>
        </div>

        <!-- FAQ Items -->
        <div class="space-y-4" x-data="{ openItem: null }">
            @php
                $faqs = [
                    [
                        'question' => 'What types of products do you sell?',
                        'answer' => 'We specialize in professional tools and equipment for jewelers, goldsmiths, and precious metal artisans. Our product range includes jewelry making and repair tools, precision workshop equipment, and carefully selected accessories chosen for their performance and longevity.'
                    ],
                    [
                        'question' => 'How do I place an order?',
                        'answer' => 'You can place an order directly through our website by adding products to your cart and proceeding to checkout. You can also contact us via WhatsApp for personalized assistance with your order.'
                    ],
                    [
                        'question' => 'What are your shipping options?',
                        'answer' => 'We offer standard shipping within Morocco. Shipping times vary depending on your location, typically 3-7 business days. We also offer express shipping options for faster delivery. All products are carefully packaged to ensure safe delivery.'
                    ],
                    [
                        'question' => 'How can I track my order?',
                        'answer' => 'Once your order is shipped, you will receive a tracking number via email or SMS. You can use this number to track your order status on our website or through the shipping carrier\'s website.'
                    ],
                    [
                        'question' => 'What is your return policy?',
                        'answer' => 'We accept returns within 14 days of delivery for unused items in their original packaging. Please contact us before returning any items. Custom or personalized items may not be eligible for return.'
                    ],
                    [
                        'question' => 'Do you offer international shipping?',
                        'answer' => 'Currently, we ship within Morocco. We are working on expanding our shipping options to other countries. Please contact us if you have specific shipping requirements.'
                    ],
                    [
                        'question' => 'How do I maintain my professional tools?',
                        'answer' => 'Care instructions vary by tool type. Generally, we recommend keeping tools clean, dry, and properly stored. Regular maintenance ensures longevity and optimal performance. Specific care instructions are included with each product or can be found on the product page.'
                    ],
                    [
                        'question' => 'Are your tools professional quality?',
                        'answer' => 'Yes, all our tools are professional-grade, tested, and approved. We select products that meet industry standards and are suitable for both beginners and confirmed professionals. Quality is our top priority.'
                    ],
                    [
                        'question' => 'Can I customize products?',
                        'answer' => 'Some products may be available for customization. Please contact us with your requirements, and we will do our best to accommodate your needs. Custom orders may require additional time for production.'
                    ],
                    [
                        'question' => 'What payment methods do you accept?',
                        'answer' => 'We accept various payment methods including credit/debit cards, bank transfers, and cash on delivery (COD) for orders within Morocco. All online payments are processed securely. Our prices are fair and transparent with no hidden costs.'
                    ]
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
            <h2 class="text-2xl font-bold mb-4">Still have questions?</h2>
            <p class="text-gold-50 mb-6">
                Can't find the answer you're looking for? Please feel free to contact us.
            </p>
            <a href="{{ route('contact') }}" class="inline-block bg-white text-gold-600 px-8 py-3 rounded-full font-bold hover:bg-gray-100 transition-colors">
                Contact Us
            </a>
        </div>
    </div>
</div>
@endsection
