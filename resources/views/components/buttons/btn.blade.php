@props(['variant' => 'primary', 'size' => 'md', 'disabled' => false, 'type' => 'button'])

@php
$baseClasses = 'font-medium rounded-lg transition duration-200 inline-flex items-center justify-center gap-2 font-inter';

$variants = [
    'primary' => 'bg-primary-700 text-white hover:bg-primary-800 disabled:bg-primary-400',
    'accent' => 'bg-accent-600 text-white hover:bg-accent-700 disabled:bg-accent-400',
    'secondary' => 'bg-gray-200 text-gray-800 hover:bg-gray-300 disabled:bg-gray-100',
    'outline' => 'border-2 border-primary-700 text-primary-700 hover:bg-primary-50 disabled:text-primary-400 disabled:border-primary-400',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 disabled:bg-red-400',
];

$sizes = [
    'sm' => 'px-4 py-2 text-sm',
    'md' => 'px-6 py-2.5 text-base',
    'lg' => 'px-8 py-3 text-lg',
];

$classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);

if ($disabled) {
    $classes .= ' opacity-50 cursor-not-allowed';
}
@endphp

<button {{ $attributes->merge(['class' => $classes, 'type' => $type, 'disabled' => $disabled]) }}>
    {{ $slot }}
</button>
