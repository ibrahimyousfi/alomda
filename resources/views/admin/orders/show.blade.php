@extends('admin.layouts.admin')

@section('pageHeader')
    <x-admin-page-header 
        title="Order #{{ $order->id }}"
    />
@endsection

@section('content')
<div class="space-y-6">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Order Items & Summary -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Products -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-lg font-bold text-gray-800">Ordered Products</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-gray-50/30">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($order->items as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="h-10 w-10 rounded-lg object-cover border border-gray-100">
                                    @else
                                        <div class="h-10 w-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">{{ $item->product->name_en }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ number_format($item->price, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                {{ number_format($item->price * $item->quantity, 2) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50/50">
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-left font-bold text-gray-900">Total:</td>
                            <td class="px-6 py-4 text-right">
                                <span class="text-lg font-bold text-gold-600">{{ number_format($order->total_amount, 2) }} MAD</span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Customer Details & Status -->
    <div class="space-y-6">
        <!-- Status Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-lg font-bold text-gray-800">Order Status</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Update Status</label>
                        <select name="status" class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-gold-500 focus:ring-gold-500 shadow-sm transition-all">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-gold-600 hover:bg-gold-700 text-white font-bold py-2.5 px-4 rounded-xl shadow-lg shadow-gold-200 transition-all flex justify-center items-center gap-2">
                        <span>Save Changes</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- Customer Info -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-lg font-bold text-gray-800">Customer Information</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-start gap-3">
                    <div class="bg-gold-50 p-2 rounded-lg text-gold-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-xs text-gray-500 uppercase tracking-wider">Name</span>
                        <span class="font-bold text-gray-900">{{ $order->customer_name }}</span>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="bg-gold-50 p-2 rounded-lg text-gold-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-xs text-gray-500 uppercase tracking-wider">Phone Number</span>
                        <span class="font-bold text-gray-900 dir-ltr text-right">{{ $order->customer_phone }}</span>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="bg-gold-50 p-2 rounded-lg text-gold-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-xs text-gray-500 uppercase tracking-wider">Address</span>
                        <span class="font-medium text-gray-900">{{ $order->customer_address }}</span>
                    </div>
                </div>

                @if($order->notes)
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <span class="block text-xs text-gray-500 uppercase tracking-wider mb-2">Customer Notes</span>
                    <div class="bg-yellow-50 text-yellow-800 p-3 rounded-xl border border-yellow-100 text-sm">
                        {{ $order->notes }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
@endsection
