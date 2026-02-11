@extends('admin.layouts.admin')

@section('pageHeader')
    <x-admin-page-header 
        title="Categories"
        :addRoute="route('admin.categories.create')"
        searchPlaceholder="Search category..."
    />
@endsection

@section('content')
<div class="space-y-4">
    @if(session('error'))
        <div class="bg-red-50 text-red-700 p-4 rounded-lg border border-red-100 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            {{ session('error') }}
        </div>
    @endif

    @forelse($categories as $category)
        <x-admin-card
            :image="$category->image ? asset('storage/' . $category->image) : null"
        >
            <x-slot name="imagePlaceholder">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </x-slot>
            <h3 class="text-base font-semibold text-gray-900 truncate">{{ $category->name_en }}</h3>
            <div class="flex items-center gap-4 mt-1">
                <span class="text-xs text-gray-500">{{ $category->products_count ?? $category->products()->count() }} products</span>
                <span class="text-xs text-gray-400">{{ $category->created_at->format('Y/m/d') }}</span>
            </div>
            
            <x-slot name="actions">
                <x-admin-action-buttons 
                    :editRoute="route('admin.categories.edit', $category)"
                    :deleteRoute="route('admin.categories.destroy', $category)"
                    deleteMessage="Are you sure you want to delete this category? All associated products will be deleted!"
                />
            </x-slot>
        </x-admin-card>
    @empty
        <x-admin-empty-card
            title="No categories yet"
            message="Start by adding a new category to organize your products"
            :action="route('admin.categories.create')"
            actionText="Add New Category"
        >
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </x-slot>
        </x-admin-empty-card>
    @endforelse

    @if($categories->hasPages())
        <div class="mt-6">
            {{ $categories->links() }}
        </div>
    @endif
</div>
@endsection
