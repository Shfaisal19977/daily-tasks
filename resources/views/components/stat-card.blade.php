<div class="bg-gradient-to-br {{ $colors['bg'] }} rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
    <div class="flex items-center justify-between">
        <div>
            <p class="{{ $colors['text'] }} text-sm font-medium mb-1">{{ $title }}</p>
            <p class="text-3xl font-bold">{{ $value }}</p>
            @if($extraInfo)
                <p class="{{ $colors['text'] }} text-xs mt-1">{{ $extraInfo }}</p>
            @endif
        </div>
        @if($icon)
            <div class="{{ $colors['iconBg'] }} rounded-lg p-3">
                {!! $icon !!}
            </div>
        @endif
    </div>
    @if($link)
        <a href="{{ $link }}" class="{{ $colors['text'] }} hover:text-white text-sm font-medium mt-4 inline-flex items-center">
            {{ $linkText }} <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
    @endif
</div>
