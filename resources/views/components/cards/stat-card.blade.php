@props(['title' => '', 'value' => '0', 'icon' => '', 'color' => 'primary', 'trend' => null])

@php
$colors = [
    'primary' => 'bg-primary-100 text-primary-700',
    'accent' => 'bg-accent-100 text-accent-700',
    'green' => 'bg-green-100 text-green-700',
    'blue' => 'bg-blue-100 text-blue-700',
    'red' => 'bg-red-100 text-red-700',
];
@endphp

<x-cards.card>
    <div class="flex items-start justify-between">
        <div class="flex-1">
            <p class="text-sm text-gray-600 font-inter">{{ $title }}</p>
            <p class="text-3xl font-bold text-gray-900 font-poppins mt-2">{{ $value }}</p>
            @if($trend)
            <p class="text-sm mt-2 {{ $trend['type'] === 'increase' ? 'text-green-600' : 'text-red-600' }}">
                {{ $trend['type'] === 'increase' ? '↑' : '↓' }} {{ $trend['percentage'] }}% {{ $trend['period'] ?? 'dari bulan lalu' }}
            </p>
            @endif
        </div>
        @if($icon)
        <div class="p-3 rounded-lg {{ $colors[$color] ?? $colors['primary'] }}">
            {!! $icon !!}
        </div>
        @endif
    </div>
</x-cards.card>
