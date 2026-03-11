@props(['title' => ''])

<header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-10">
    <div class="px-8 py-4 flex justify-between items-center">
        <h2 class="font-poppins text-2xl font-bold text-gray-800">{{ $title }}</h2>
        <div class="flex items-center gap-4">
            {{ $slot }}
        </div>
    </div>
</header>
