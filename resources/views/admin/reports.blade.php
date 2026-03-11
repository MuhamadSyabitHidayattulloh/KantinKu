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
            
            <x-layout.sidebar-item url="/admin/vendors" 
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'>
                Kelola Vendor
            </x-layout.sidebar-item>
            
            <x-layout.sidebar-item url="/admin/transactions" 
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'>
                Top Up & Withdraw
            </x-layout.sidebar-item>
            
            <x-layout.sidebar-item url="/admin/reports" :active="request()->is('admin/reports*')"
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

    <!-- Main Content -->
    <main class="flex-1 overflow-auto flex flex-col">
        <x-layout.page-header title="Laporan">
            <div class="flex gap-3">
                <x-buttons.btn variant="secondary" size="sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Filter
                </x-buttons.btn>
                <x-buttons.btn variant="accent" size="sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Export
                </x-buttons.btn>
            </div>
        </x-layout.page-header>

        <!-- Content -->
        <div class="flex-1 p-8 overflow-auto">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <x-cards.stat-card 
                    title="Total Pesanan"
                    value="{{ number_format($totalOrders) }}"
                    icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>'
                    color="primary"
                />
                
                <x-cards.stat-card 
                    title="Total Pendapatan"
                    value="Rp {{ number_format($totalRevenue, 0, ',', '.') }}"
                    icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                    color="accent"
                />
                
                <x-cards.stat-card 
                    title="Total Users"
                    value="{{ number_format($totalUsers) }}"
                    icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                    color="green"
                />
                
                <x-cards.stat-card 
                    title="Total Vendor"
                    value="{{ number_format($totalVendors) }}"
                    icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292m0 0a4.004 4.004 0 014 4.354m0 0a4 4 0 11-8 0m6 2a1 1 0 100-2 1 1 0 000 2z"/></svg>'
                    color="blue"
                />
            </div>

            <!-- Charts & Tables -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Sales Performance -->
                <div class="lg:col-span-2">
                    <x-cards.card>
                        <div class="pb-4 border-b border-gray-200 mb-6">
                            <h3 class="font-poppins text-lg font-bold text-gray-800">Performa Penjualan</h3>
                        </div>
                        
                        <div class="h-64 bg-gradient-to-b from-primary-50 to-primary-100 rounded-lg flex items-center justify-center">
                            <p class="text-gray-500 text-sm">Chart akan ditampilkan dengan data real</p>
                        </div>
                    </x-cards.card>
                </div>

                <!-- Top Vendors -->
                <x-cards.card>
                    <div class="pb-4 border-b border-gray-200 mb-4">
                        <h3 class="font-poppins text-lg font-bold text-gray-800">Top Vendor</h3>
                    </div>
                    
                    <div class="space-y-4">
                        @forelse ($topVendors as $vendor)
                            <div class="flex items-center justify-between {{ !$loop->last ? 'pb-3 border-b border-gray-100' : '' }}">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">{{ $vendor->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $vendor->products_count ?? 0 }} produk</p>
                                </div>
                                <span class="text-primary-700 text-sm font-semibold">Rp {{ number_format($vendor->total_sales ?? 0, 0, ',', '.') }}</span>
                            </div>
                        @empty
                            <p class="text-gray-600 text-sm">Belum ada vendor</p>
                        @endforelse
                    </div>
                </x-cards.card>
            </div>

            <!-- Detailed Report Table -->
            <div class="mt-6">
                <x-cards.card>
                    <div class="pb-4 border-b border-gray-200 mb-4">
                        <h3 class="font-poppins text-lg font-bold text-gray-800">Laporan Rinci Penjualan Harian</h3>
                    </div>
                    
                    <x-tables.table>
                        <x-tables.thead>
                            <x-tables.tr>
                                <x-tables.th>Tanggal</x-tables.th>
                                <x-tables.th>Jumlah Pesanan</x-tables.th>
                                <x-tables.th>Total Penjualan</x-tables.th>
                                <x-tables.th>Rata-rata</x-tables.th>
                            </x-tables.tr>
                        </x-tables.thead>
                        <x-tables.tbody>
                            @forelse ($ordersByDate as $data)
                                <x-tables.tr>
                                    <x-tables.td class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($data->date)->format('d M Y') }}</x-tables.td>
                                    <x-tables.td>{{ $data->count }}</x-tables.td>
                                    <x-tables.td class="font-semibold text-gray-800">Rp {{ number_format($data->revenue, 0, ',', '.') }}</x-tables.td>
                                    <x-tables.td>Rp {{ number_format($data->revenue / max($data->count, 1), 0, ',', '.') }}</x-tables.td>
                                </x-tables.tr>
                            @empty
                                <x-tables.tr>
                                    <x-tables.td colspan="4" class="text-center py-4">
                                        <p class="text-gray-600">Belum ada data pesanan</p>
                                    </x-tables.td>
                                </x-tables.tr>
                            @endforelse
                        </x-tables.tbody>
                    </x-tables.table>
                </x-cards.card>
            </div>
        </div>
    </main>
</div>
@endsection
