@props(['subtitle' => ''])

<aside class="w-64 bg-primary-900 text-white shadow-lg overflow-y-auto flex flex-col">
    <!-- Logo Section -->
    <div class="p-6 border-b border-primary-700 flex-shrink-0">
        <h1 class="font-poppins text-2xl font-bold">Kantinku</h1>
        @if($subtitle)
        <p class="text-primary-200 text-sm">{{ $subtitle }}</p>
        @endif
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 p-4 overflow-y-auto">
        {{ $slot }}
    </nav>

    <!-- User Profile Section (Footer) -->
    <div class="p-4 border-t border-primary-700 bg-primary-800 flex-shrink-0">
        <x-slot name="footer"></x-slot>
    </div>
</aside>
