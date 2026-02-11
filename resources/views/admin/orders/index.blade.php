@extends('admin.layouts.admin')

@section('pageHeader')
    <x-admin-page-header 
        title="Orders"
        searchPlaceholder="Search by order number or customer name..."
    />
@endsection

@section('content')
<div class="space-y-4">
    <!-- Filters -->
    <div class="flex gap-2 overflow-x-auto pb-2">
        <button class="px-4 py-2 rounded-lg bg-gold-50 text-gold-700 font-semibold text-sm whitespace-nowrap border border-gold-200">All</button>
        <button class="px-4 py-2 rounded-lg bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium text-sm whitespace-nowrap">Pending</button>
        <button class="px-4 py-2 rounded-lg bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium text-sm whitespace-nowrap">Processing</button>
        <button class="px-4 py-2 rounded-lg bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium text-sm whitespace-nowrap">Completed</button>
    </div>

    @forelse($orders as $order)
        <x-admin-card>
            <x-slot name="leftSlot">
                <span class="font-mono text-sm font-bold text-gray-900 bg-gray-100 px-3 py-1.5 rounded border border-gray-200">#{{ $order->id }}</span>
            </x-slot>
            
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-4 mb-1">
                        <h3 class="text-base font-semibold text-gray-900">{{ $order->customer_name }}</h3>
                        @php
                            $statusClasses = [
                                'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                'processing' => 'bg-blue-50 text-blue-700 border-blue-200',
                                'completed' => 'bg-gold-50 text-gold-700 border-gold-200',
                                'cancelled' => 'bg-red-50 text-red-700 border-red-200',
                            ];
                            $statusLabels = [
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ];
                        @endphp
                        <span class="px-2.5 py-1 text-xs font-semibold rounded border {{ $statusClasses[$order->status] ?? 'bg-gray-50 text-gray-700 border-gray-200' }}">
                            {{ $statusLabels[$order->status] ?? $order->status }}
                        </span>
                    </div>
                    <div class="flex items-center gap-4 text-xs text-gray-500">
                        <span class="font-mono">{{ $order->customer_phone }}</span>
                        <span>{{ $order->created_at->format('Y-m-d h:i A') }}</span>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <span class="text-sm font-bold text-gold-600">{{ number_format($order->total_amount, 2) }} MAD</span>
                </div>
            </div>
            
            <x-slot name="actions">
                <x-admin-action-button 
                    type="link"
                    :href="route('admin.orders.show', $order)"
                    icon="view"
                />
            </x-slot>
        </x-admin-card>
    @empty
        <x-admin-empty-card
            title="No orders yet"
            message="New orders will appear here when customers make purchases"
        >
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
            </x-slot>
        </x-admin-empty-card>
    @endforelse

    @if($orders->hasPages())
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
