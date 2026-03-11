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
            
            <x-layout.sidebar-item url="/vendor/products" :active="request()->is('vendor/products*')"
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m0 0v10l8 4"/></svg>'>
                Kelola Produk
            </x-layout.sidebar-item>
            
            <x-layout.sidebar-item url="/vendor/orders" 
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
        <x-layout.page-header title="Kelola Produk">
            <div class="flex gap-3">
                <input type="text" placeholder="Cari produk..." class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 w-64">
                <x-buttons.btn variant="accent" size="sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Produk
                </x-buttons.btn>
            </div>
        </x-layout.page-header>

        <!-- Content -->
        <div class="flex-1 p-8 overflow-auto">
            <x-cards.card>
                <div class="pb-4 border-b border-gray-200 mb-4">
                    <h3 class="font-poppins text-lg font-bold text-gray-800">Daftar Produk</h3>
                    <p class="text-sm text-gray-500 mt-1">Total 8 produk aktif</p>
                </div>
                
                <x-tables.table>
                    <x-tables.thead>
                        <x-tables.tr>
                            <x-tables.th>Gambar</x-tables.th>
                            <x-tables.th>Nama Produk</x-tables.th>
                            <x-tables.th>Kategori</x-tables.th>
                            <x-tables.th>Harga</x-tables.th>
                            <x-tables.th>Stok</x-tables.th>
                            <x-tables.th>Terjual</x-tables.th>
                            <x-tables.th>Status</x-tables.th>
                            <x-tables.th>Aksi</x-tables.th>
                        </x-tables.tr>
                    </x-tables.thead>
                    <x-tables.tbody>
                        <x-tables.tr>
                            <x-tables.td>
                                <div class="w-12 h-12 bg-accent-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            </x-tables.td>
                            <x-tables.td class="font-semibold text-gray-900">Nasi Goreng Spesial</x-tables.td>
                            <x-tables.td>Makanan</x-tables.td>
                            <x-tables.td>Rp 25.000</x-tables.td>
                            <x-tables.td class="font-medium">45 porsi</x-tables.td>
                            <x-tables.td>234 porsi</x-tables.td>
                            <x-tables.td>
                                <x-badges.badge variant="success">Aktif</x-badges.badge>
                            </x-tables.td>
                            <x-tables.td>
                                <div class="flex gap-2">
                                    <button class="text-primary-700 hover:text-primary-900 text-sm font-medium">Edit</button>
                                    <button class="text-red-600 hover:text-red-900 text-sm font-medium">Hapus</button>
                                </div>
                            </x-tables.td>
                        </x-tables.tr>
                        <x-tables.tr>
                            <x-tables.td>
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            </x-tables.td>
                            <x-tables.td class="font-semibold text-gray-900">Mie Kuah</x-tables.td>
                            <x-tables.td>Makanan</x-tables.td>
                            <x-tables.td>Rp 15.000</x-tables.td>
                            <x-tables.td class="font-medium">62 porsi</x-tables.td>
                            <x-tables.td>198 porsi</x-tables.td>
                            <x-tables.td>
                                <x-badges.badge variant="success">Aktif</x-badges.badge>
                            </x-tables.td>
                            <x-tables.td>
                                <div class="flex gap-2">
                                    <button class="text-primary-700 hover:text-primary-900 text-sm font-medium">Edit</button>
                                    <button class="text-red-600 hover:text-red-900 text-sm font-medium">Hapus</button>
                                </div>
                            </x-tables.td>
                        </x-tables.tr>
                        <x-tables.tr>
                            <x-tables.td>
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            </x-tables.td>
                            <x-tables.td class="font-semibold text-gray-900">Es Teh Tarik</x-tables.td>
                            <x-tables.td>Minuman</x-tables.td>
                            <x-tables.td>Rp 5.000</x-tables.td>
                            <x-tables.td class="font-medium">120 gelas</x-tables.td>
                            <x-tables.td>456 gelas</x-tables.td>
                            <x-tables.td>
                                <x-badges.badge variant="success">Aktif</x-badges.badge>
                            </x-tables.td>
                            <x-tables.td>
                                <div class="flex gap-2">
                                    <button class="text-primary-700 hover:text-primary-900 text-sm font-medium">Edit</button>
                                    <button class="text-red-600 hover:text-red-900 text-sm font-medium">Hapus</button>
                                </div>
                            </x-tables.td>
                        </x-tables.tr>
                        <x-tables.tr>
                            <x-tables.td>
                                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            </x-tables.td>
                            <x-tables.td class="font-semibold text-gray-900">Soto Ayam</x-tables.td>
                            <x-tables.td>Makanan</x-tables.td>
                            <x-tables.td>Rp 20.000</x-tables.td>
                            <x-tables.td class="font-medium">0 porsi</x-tables.td>
                            <x-tables.td>167 porsi</x-tables.td>
                            <x-tables.td>
                                <x-badges.badge variant="warning">Stok Habis</x-badges.badge>
                            </x-tables.td>
                            <x-tables.td>
                                <div class="flex gap-2">
                                    <button class="text-primary-700 hover:text-primary-900 text-sm font-medium">Edit</button>
                                    <button class="text-red-600 hover:text-red-900 text-sm font-medium">Hapus</button>
                                </div>
                            </x-tables.td>
                        </x-tables.tr>
                    </x-tables.tbody>
                </x-tables.table>

                <!-- Pagination -->
                <div class="flex justify-between items-center mt-6 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">Menampilkan 1-10 dari 8</p>
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
