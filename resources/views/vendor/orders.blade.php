@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <x-layout.sidebar subtitle="Vendor Panel">
        <x-layout.sidebar-group title="Menu Utama">
            <x-layout.sidebar-item url="/vendor/dashboard" 
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m2-2l6-6m6 6l2 3m-2 3v6m0 0H9m12 0v-6m0 0l-2-3m2 3V6m0 0h-6"/></svg>'>
                Dashboard
            </x-layout.sidebar-item>
            
            <x-layout.sidebar-item url="/vendor/products" 
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m0 0v10l8 4"/></svg>'>
                Kelola Produk
            </x-layout.sidebar-item>
            
            <x-layout.sidebar-item url="/vendor/orders" :active="request()->is('vendor/orders*')"
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>'>
                Kelola Pesanan
            </x-layout.sidebar-item>
            
            <x-layout.sidebar-item url="/vendor/reports" 
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>'>
                Laporan
            </x-layout.sidebar-item>
        </x-layout.sidebar-group>

        <x-layout.sidebar-group title="Lainnya">
            <x-layout.sidebar-item url="#" 
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/></svg>'>
                Pengaturan
            </x-layout.sidebar-item>
            
            <x-layout.sidebar-item url="#" 
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>'>
                Logout
            </x-layout.sidebar-item>
        </x-layout.sidebar-group>
    </x-layout.sidebar>

    <!-- Main Content -->
    <main class="flex-1 overflow-auto flex flex-col">
        <x-layout.page-header title="Kelola Pesanan">
            <div class="flex gap-3">
                <input type="text" placeholder="Cari pesanan..." class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 w-64">
                <select class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600">
                    <option>Semua Status</option>
                    <option>Menunggu</option>
                    <option>Di Proses</option>
                    <option>Siap Diambil</option>
                    <option>Selesai</option>
                    <option>Dibatalkan</option>
                </select>
            </div>
        </x-layout.page-header>

        <!-- Content -->
        <div class="flex-1 p-8 overflow-auto">
            <x-cards.card>
                <div class="pb-4 border-b border-gray-200 mb-4">
                    <h3 class="font-poppins text-lg font-bold text-gray-800">Daftar Pesanan</h3>
                    <p class="text-sm text-gray-500 mt-1">Total 5 pesanan aktif</p>
                </div>
                
                <x-tables.table>
                    <x-tables.thead>
                        <x-tables.tr>
                            <x-tables.th>ID Pesanan</x-tables.th>
                            <x-tables.th>Customer</x-tables.th>
                            <x-tables.th>Produk</x-tables.th>
                            <x-tables.th>Total</x-tables.th>
                            <x-tables.th>Status</x-tables.th>
                            <x-tables.th>Waktu Pesan</x-tables.th>
                            <x-tables.th>Aksi</x-tables.th>
                        </x-tables.tr>
                    </x-tables.thead>
                    <x-tables.tbody>
                        <x-tables.tr>
                            <x-tables.td class="font-semibold text-gray-900">#ORD-001</x-tables.td>
                            <x-tables.td>Budi Santoso</x-tables.td>
                            <x-tables.td>Nasi Goreng x2</x-tables.td>
                            <x-tables.td class="font-semibold">Rp 50.000</x-tables.td>
                            <x-tables.td>
                                <x-badges.badge variant="success">Selesai</x-badges.badge>
                            </x-tables.td>
                            <x-tables.td class="text-sm text-gray-600">11 Mar, 14:30</x-tables.td>
                            <x-tables.td>
                                <button class="text-primary-700 hover:text-primary-900 text-sm font-medium">Detail</button>
                            </x-tables.td>
                        </x-tables.tr>
                        <x-tables.tr>
                            <x-tables.td class="font-semibold text-gray-900">#ORD-002</x-tables.td>
                            <x-tables.td>Siti Nur Azizah</x-tables.td>
                            <x-tables.td>Mie Kuah x1</x-tables.td>
                            <x-tables.td class="font-semibold">Rp 15.000</x-tables.td>
                            <x-tables.td>
                                <x-badges.badge variant="warning">Di Proses</x-badges.badge>
                            </x-tables.td>
                            <x-tables.td class="text-sm text-gray-600">11 Mar, 13:15</x-tables.td>
                            <x-tables.td>
                                <button class="text-primary-700 hover:text-primary-900 text-sm font-medium">Detail</button>
                            </x-tables.td>
                        </x-tables.tr>
                        <x-tables.tr>
                            <x-tables.td class="font-semibold text-gray-900">#ORD-003</x-tables.td>
                            <x-tables.td>Ahmad Wijaya</x-tables.td>
                            <x-tables.td>Nasi Goreng x1, Es Teh x2</x-tables.td>
                            <x-tables.td class="font-semibold">Rp 35.000</x-tables.td>
                            <x-tables.td>
                                <x-badges.badge variant="info">Menunggu</x-badges.badge>
                            </x-tables.td>
                            <x-tables.td class="text-sm text-gray-600">11 Mar, 12:45</x-tables.td>
                            <x-tables.td>
                                <button class="text-primary-700 hover:text-primary-900 text-sm font-medium">Detail</button>
                            </x-tables.td>
                        </x-tables.tr>
                        <x-tables.tr>
                            <x-tables.td class="font-semibold text-gray-900">#ORD-004</x-tables.td>
                            <x-tables.td>Dewi Lestari</x-tables.td>
                            <x-tables.td>Soto Ayam x3</x-tables.td>
                            <x-tables.td class="font-semibold">Rp 60.000</x-tables.td>
                            <x-tables.td>
                                <x-badges.badge variant="success">Selesai</x-badges.badge>
                            </x-tables.td>
                            <x-tables.td class="text-sm text-gray-600">10 Mar, 15:20</x-tables.td>
                            <x-tables.td>
                                <button class="text-primary-700 hover:text-primary-900 text-sm font-medium">Detail</button>
                            </x-tables.td>
                        </x-tables.tr>
                    </x-tables.tbody>
                </x-tables.table>

                <!-- Pagination -->
                <div class="flex justify-between items-center mt-6 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">Menampilkan 1-10 dari 46</p>
                    <div class="flex gap-2">
                        <x-buttons.btn variant="secondary" size="sm">Sebelumnya</x-buttons.btn>
                        <x-buttons.btn variant="secondary" size="sm">Selanjutnya</x-buttons.btn>
                    </div>
                </div>
            </x-cards.card>
        </div>
    </main>
</div>
@endsection
