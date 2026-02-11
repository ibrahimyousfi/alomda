@props(['items' => []])

<nav class="flex text-sm text-gray-500" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2 space-x-reverse">
        @foreach($items as $index => $item)
            <li>
                @if($item['url'] ?? null)
                    <a href="{{ $item['url'] }}" class="hover:text-gold-600 transition-colors">
                        {{ $item['label'] }}
                    </a>
                @else
                    <span class="text-gray-900 font-medium">{{ $item['label'] }}</span>
                @endif
            </li>
            @if(!$loop->last)
                <li><span class="text-gray-300">/</span></li>
            @endif
        @endforeach
    </ol>
</nav>
