@props(['currentPage' => ''])

<x-layout.sidebar subtitle="Vendor Panel">
    <x-layout.sidebar-group title="Menu Utama">
        <x-layout.sidebar-item url="/vendor/dashboard" :active="request()->is('vendor/dashboard')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m2-2l6-6m6 6l2 3m-2 3v6m0 0H9m12 0v-6m0 0l-2-3m2 3V6m0 0h-6"/></svg>'>
            Dashboard
        </x-layout.sidebar-item>

        <x-layout.sidebar-item url="/vendor/products" :active="request()->is('vendor/products*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>'>
            Kelola Produk
        </x-layout.sidebar-item>

        <x-layout.sidebar-item url="/vendor/orders" :active="request()->is('vendor/orders*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7 20H5a2 2 0 01-2-2V9a2 2 0 012-2h2m6-4h6a2 2 0 012 2v14a2 2 0 01-2 2h-6"/></svg>'>
            Pesanan
        </x-layout.sidebar-item>

        <x-layout.sidebar-item url="/vendor/reports" :active="request()->is('vendor/reports*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>'>
            Laporan
        </x-layout.sidebar-item>
    </x-layout.sidebar-group>

    <x-layout.sidebar-group title="Lainnya">
        <x-layout.sidebar-item url="#"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/></svg>'>
            Pengaturan
        </x-layout.sidebar-item>

        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-4 py-3 text-gray-700 hover:bg-gray-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                <span>Logout</span>
            </button>
        </form>
    </x-layout.sidebar-group>
</x-layout.sidebar>
