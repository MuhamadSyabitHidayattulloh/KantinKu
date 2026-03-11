@props(['striped' => true])

<div class="overflow-x-auto">
    <table class="w-full text-sm text-gray-600 {{ $attributes->get('class') }}">
        {{ $slot }}
    </table>
</div>
