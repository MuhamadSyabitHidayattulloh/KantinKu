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
        <div class="mb-3 pb-3 border-b border-primary-700">
            <p class="text-sm font-medium text-white">{{ auth()->user()->name }}</p>
            <p class="text-xs text-primary-200">{{ auth()->user()->role === 'admin' ? 'Administrator' : 'Vendor' }}</p>
            @if(auth()->user()->wallet)
                <p class="text-xs text-primary-100 mt-2">
                    <span class="text-primary-300">Saldo:</span> Rp {{ number_format(auth()->user()->wallet->balance, 0, ',', '.') }}
                </p>
            @endif
        </div>
        <x-slot name="footer"></x-slot>
    </div>
</aside>
