@props(['active' => false, 'url' => '#', 'icon' => ''])

@php
$baseClasses = 'w-full px-4 py-3 rounded-lg transition duration-200 text-primary-100 hover:bg-primary-700 hover:text-white flex items-center gap-3 text-left font-inter';
$activeClasses = $active ? 'bg-accent-600 text-white' : '';
@endphp

<a href="{{ $url }}" class="{{ $baseClasses }} {{ $activeClasses }}">
    @if($icon)
    <span class="flex-shrink-0">
        {!! $icon !!}
    </span>
    @endif
    <span class="flex-1">{{ $slot }}</span>
</a>
