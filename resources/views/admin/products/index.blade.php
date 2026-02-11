@extends('admin.layouts.admin')

@section('pageHeader')
    <x-admin-page-header 
        title="Products"
        :addRoute="route('admin.products.create')"
        searchPlaceholder="Search product..."
    />
@endsection

@section('content')
<div class="space-y-4">
    @forelse($products as $product)
        <x-admin-card
            :image="$product->image ? asset('storage/' . $product->image) : null"
        >
            <x-slot name="imagePlaceholder">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
            </x-slot>
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1 min-w-0">
                    <h3 class="text-base font-semibold text-gray-900 truncate">{{ $product->name_en }}</h3>
                    <div class="flex items-center gap-3 mt-1">
                        <span class="text-sm font-semibold text-gold-600">{{ number_format($product->price, 2) }} MAD</span>
                        <span class="text-xs text-gray-500">Stock: {{ $product->stock }}</span>
                        <span class="text-xs text-gray-400">{{ $product->category->name_en }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    @if($product->is_featured)
                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded">Featured</span>
                    @endif
                    @if($product->stock < 5)
                        <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded">Low Stock</span>
                    @endif
                </div>
            </div>
            
            <x-slot name="actions">
                <x-admin-action-buttons 
                    :editRoute="route('admin.products.edit', $product)"
                    :deleteRoute="route('admin.products.destroy', $product)"
                    deleteMessage="Are you sure you want to delete?"
                />
            </x-slot>
        </x-admin-card>
    @empty
        <x-admin-empty-card
            title="No products yet"
            message="Start by adding your first product"
            :action="route('admin.products.create')"
            actionText="Add New Product"
        >
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3.75m3 3.75 3-3.75M12 16.5V12m9-3.75a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25m19.5 0v1.5a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V7.5" />
                </svg>
            </x-slot>
        </x-admin-empty-card>
    @endforelse

    @if($products->hasPages())
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
