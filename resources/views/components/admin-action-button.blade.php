@props([
    'type' => 'link', // 'link', 'submit'
    'href' => null,
    'action' => null,
    'method' => 'DELETE',
    'icon' => 'plus', // 'plus', 'edit', 'delete', 'view'
    'color' => 'default', // 'default', 'gold', 'red'
    'confirm' => null
])

@php
    $iconSvg = match($icon) {
        'plus' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />',
        'edit' => '<path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />',
        'delete' => '<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />',
        'view' => '<path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />',
        default => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />'
    };
    
    $iconViewBox = match($icon) {
        'plus' => '0 0 24 24',
        'edit', 'delete', 'view' => '0 0 20 20',
        default => '0 0 24 24'
    };
    
    $colorClasses = match($color) {
        'gold' => 'bg-gold-600 hover:bg-gold-700 text-white border-gold-600',
        'red' => 'border-red-300 text-red-600 hover:text-red-700 hover:border-red-400',
        default => 'border-gray-300 text-gray-600 hover:text-gold-600 hover:border-gold-300'
    };
    
    $confirmAttr = $confirm ? "onsubmit=\"return confirm('{$confirm}')\"" : '';
@endphp

@if($type === 'submit')
    <form action="{{ $action }}" method="{{ $method }}" class="inline-block" {!! $confirmAttr !!}>
        @csrf
        @if($method !== 'GET' && $method !== 'POST')
            @method($method)
        @endif
        <button type="submit" class="p-2.5 border rounded-full {{ $colorClasses }} flex-shrink-0 w-9 h-9 flex items-center justify-center">
            @if($icon === 'plus')
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="{{ $iconViewBox }}" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    {!! $iconSvg !!}
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="{{ $iconViewBox }}" fill="currentColor" class="w-4 h-4">
                    {!! $iconSvg !!}
                </svg>
            @endif
        </button>
    </form>
@else
    <a href="{{ $href }}" class="p-2.5 border rounded-full {{ $colorClasses }} flex-shrink-0 w-9 h-9 flex items-center justify-center">
        @if($icon === 'plus')
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="{{ $iconViewBox }}" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                {!! $iconSvg !!}
            </svg>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="{{ $iconViewBox }}" fill="currentColor" class="w-4 h-4">
                {!! $iconSvg !!}
            </svg>
        @endif
    </a>
@endif
