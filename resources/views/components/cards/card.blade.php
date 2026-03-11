@props(['noPadding' => false, 'border' => true])

<div class="bg-white rounded-xl shadow-md {{ $border ? 'border border-gray-100' : '' }} {{ !$noPadding ? 'p-6' : '' }} {{ $attributes->get('class') }}">
    {{ $slot }}
</div>
