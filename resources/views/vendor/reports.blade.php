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
            
            <x-layout.sidebar-item url="/vendor/orders" 
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>'>
                Kelola Pesanan
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
            
            <x-layout.sidebar-item url="#" 
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>'>
                Logout
            </x-layout.sidebar-item>
        </x-layout.sidebar-group>
    </x-layout.sidebar>

    <!-- Main Content -->
    <main class="flex-1 overflow-auto flex flex-col">
        <x-layout.page-header title="Laporan Penjualan">
            <div class="flex gap-3">
                <select class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600">
                    <option>Bulanan</option>
                    <option>Mingguan</option>
                    <option>Harian</option>
                </select>
                <x-buttons.btn variant="accent" size="sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Export
                </x-buttons.btn>
            </div>
        </x-layout.page-header>

        <!-- Content -->
        <div class="flex-1 p-8 overflow-auto">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <x-cards.stat-card 
                    title="Total Penjualan Bulan Ini"
                    value="Rp 4.8M"
                    icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                    color="accent"
                    :trend="['type' => 'increase', 'percentage' => 12]"
                />
                
                <x-cards.stat-card 
                    title="Total Pesanan"
                    value="156"
                    icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>'
                    color="primary"
                    :trend="['type' => 'increase', 'percentage' => 8]"
                />
                

            </div>

            <!-- Chart -->
            <x-cards.card class="mb-6">
                <div class="pb-4 border-b border-gray-200 mb-6">
                    <h3 class="font-poppins text-lg font-bold text-gray-800">Grafik Penjualan Bulanan</h3>
                </div>
                
                <div class="h-64 bg-gradient-to-b from-accent-50 to-accent-100 rounded-lg flex items-center justify-center">
                    <p class="text-gray-500 text-sm">Chart akan ditampilkan dengan data real</p>
                </div>
            </x-cards.card>

            <!-- Detailed Report -->
            <x-cards.card>
                <div class="pb-4 border-b border-gray-200 mb-4">
                    <h3 class="font-poppins text-lg font-bold text-gray-800">Laporan Rinci Harian</h3>
                </div>
                
                <x-tables.table>
                    <x-tables.thead>
                        <x-tables.tr>
                            <x-tables.th>Tanggal</x-tables.th>
                            <x-tables.th>Jumlah Pesanan</x-tables.th>
                            <x-tables.th>Total Penjualan</x-tables.th>
                            <x-tables.th>Rata-rata Pesanan</x-tables.th>
                            <x-tables.th>Trend</x-tables.th>
                        </x-tables.tr>
                    </x-tables.thead>
                    <x-tables.tbody>
                        <x-tables.tr>
                            <x-tables.td class="font-semibold text-gray-900">11 Mar 2025</x-tables.td>
                            <x-tables.td>23</x-tables.td>
                            <x-tables.td class="font-semibold text-gray-800">Rp 350.000</x-tables.td>
                            <x-tables.td>Rp 15.2K</x-tables.td>
                            <x-tables.td>
                                <span class="text-green-600 text-sm font-semibold">↑ 12%</span>
                            </x-tables.td>
                        </x-tables.tr>
                        <x-tables.tr>
                            <x-tables.td class="font-semibold text-gray-900">10 Mar 2025</x-tables.td>
                            <x-tables.td>21</x-tables.td>
                            <x-tables.td class="font-semibold text-gray-800">Rp 320.000</x-tables.td>
                            <x-tables.td>Rp 15.2K</x-tables.td>
                            <x-tables.td>
                                <span class="text-green-600 text-sm font-semibold">↑ 5%</span>
                            </x-tables.td>
                        </x-tables.tr>
                        <x-tables.tr>
                            <x-tables.td class="font-semibold text-gray-900">09 Mar 2025</x-tables.td>
                            <x-tables.td>18</x-tables.td>
                            <x-tables.td class="font-semibold text-gray-800">Rp 280.000</x-tables.td>
                            <x-tables.td>Rp 15.6K</x-tables.td>
                            <x-tables.td>
                                <span class="text-red-600 text-sm font-semibold">↓ 3%</span>
                            </x-tables.td>
                        </x-tables.tr>
                    </x-tables.tbody>
                </x-tables.table>
            </x-cards.card>
        </div>
    </main>
</div>
@endsection
