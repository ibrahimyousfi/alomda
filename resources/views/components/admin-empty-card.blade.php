@props([
    'title' => 'No items',
    'message' => null,
    'action' => null,
    'actionText' => 'Add New'
])

<div class="bg-white border border-gray-200 rounded-lg p-12 text-center">
    @if(isset($icon))
        <div class="h-16 w-16 text-gray-300 mx-auto mb-4">
            {{ $icon }}
        </div>
    @endif
    <p class="text-lg font-medium text-gray-900 mb-2">{{ $title }}</p>
    @if($message)
        <p class="text-sm text-gray-500 mb-4">{{ $message }}</p>
    @endif
    @if($action)
        <a href="{{ $action }}" class="inline-block text-gold-600 hover:text-gold-700 font-medium">
            + {{ $actionText }}
        </a>
    @endif
</div>
