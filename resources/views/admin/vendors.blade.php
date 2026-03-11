@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <x-layout.sidebar subtitle="Admin Panel">
        <x-layout.sidebar-group title="Menu Utama">
            <x-layout.sidebar-item url="/admin/dashboard" 
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m2-2l6-6m6 6l2 3m-2 3v6m0 0H9m12 0v-6m0 0l-2-3m2 3V6m0 0h-6"/></svg>'>
                Dashboard
            </x-layout.sidebar-item>
            
            <x-layout.sidebar-item url="/admin/users" 
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0H9m6 0H9m6 0H9m0 6h12a2 2 0 01-2 2H5a2 2 0 01-2-2h12z"/></svg>'>
                Kelola User
            </x-layout.sidebar-item>
            
            <x-layout.sidebar-item url="/admin/vendors" :active="request()->is('admin/vendors*')"
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'>
                Kelola Vendor
            </x-layout.sidebar-item>
            
            <x-layout.sidebar-item url="/admin/transactions" 
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'>
                Top Up & Withdraw
            </x-layout.sidebar-item>
            
            <x-layout.sidebar-item url="/admin/reports" 
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
        <x-layout.page-header title="Kelola Vendor">
            <div class="flex gap-3">
                <input type="text" placeholder="Cari vendor..." class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 w-64">
                <x-buttons.btn variant="accent" size="sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Vendor
                </x-buttons.btn>
            </div>
        </x-layout.page-header>

        <!-- Content -->
        <div class="flex-1 p-8 overflow-auto">
            <x-cards.card>
                <div class="pb-4 border-b border-gray-200 mb-4">
                    <h3 class="font-poppins text-lg font-bold text-gray-800">Daftar Vendor</h3>
                    <p class="text-sm text-gray-500 mt-1">Total 145 vendor terdaftar</p>
                </div>
                
                <x-tables.table>
                    <x-tables.thead>
                        <x-tables.tr>
                            <x-tables.th>Nama Toko</x-tables.th>
                            <x-tables.th>Email</x-tables.th>
                            <x-tables.th>Nomor Telepon</x-tables.th>
                            <x-tables.th>Produk</x-tables.th>
                            <x-tables.th>Status</x-tables.th>
                            <x-tables.th>Terdaftar</x-tables.th>
                            <x-tables.th>Aksi</x-tables.th>
                        </x-tables.tr>
                    </x-tables.thead>
                    <x-tables.tbody>
                        <x-tables.tr>
                            <x-tables.td>
                                <div class="font-semibold text-gray-900">Warung Nasi Jaya</div>
                                <div class="text-xs text-gray-500">Kios A-01</div>
                            </x-tables.td>
                            <x-tables.td>nasi.jaya@example.com</x-tables.td>
                            <x-tables.td>081234567890</x-tables.td>
                            <x-tables.td class="text-center">8 produk</x-tables.td>
                            <x-tables.td>
                                <x-badges.badge variant="success">Aktif</x-badges.badge>
                            </x-tables.td>
                            <x-tables.td class="text-sm text-gray-600">10 Maret 2025</x-tables.td>
                            <x-tables.td>
                                <div class="flex gap-2">
                                    <button class="text-primary-700 hover:text-primary-900 text-sm font-medium">Edit</button>
                                    <button class="text-red-600 hover:text-red-900 text-sm font-medium">Hapus</button>
                                </div>
                            </x-tables.td>
                        </x-tables.tr>
                        <x-tables.tr>
                            <x-tables.td>
                                <div class="font-semibold text-gray-900">Bakso Enak</div>
                                <div class="text-xs text-gray-500">Kios B-05</div>
                            </x-tables.td>
                            <x-tables.td>bakso.enak@example.com</x-tables.td>
                            <x-tables.td>081298765432</x-tables.td>
                            <x-tables.td class="text-center">5 produk</x-tables.td>
                            <x-tables.td>
                                <x-badges.badge variant="success">Aktif</x-badges.badge>
                            </x-tables.td>
                            <x-tables.td class="text-sm text-gray-600">12 Maret 2025</x-tables.td>
                            <x-tables.td>
                                <div class="flex gap-2">
                                    <button class="text-primary-700 hover:text-primary-900 text-sm font-medium">Edit</button>
                                    <button class="text-red-600 hover:text-red-900 text-sm font-medium">Hapus</button>
                                </div>
                            </x-tables.td>
                        </x-tables.tr>
                        <x-tables.tr>
                            <x-tables.td>
                                <div class="font-semibold text-gray-900">Minuman Segar</div>
                                <div class="text-xs text-gray-500">Kios C-03</div>
                            </x-tables.td>
                            <x-tables.td>minuman.segar@example.com</x-tables.td>
                            <x-tables.td>085567890123</x-tables.td>
                            <x-tables.td class="text-center">6 produk</x-tables.td>
                            <x-tables.td>
                                <x-badges.badge variant="success">Aktif</x-badges.badge>
                            </x-tables.td>
                            <x-tables.td class="text-sm text-gray-600">18 Maret 2025</x-tables.td>
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
                    <p class="text-sm text-gray-600">Menampilkan 1-10 dari 145</p>
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
