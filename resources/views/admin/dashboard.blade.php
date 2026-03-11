@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <x-layout.sidebar subtitle="Admin Panel">
        <x-layout.sidebar-group title="Menu Utama">
            <x-layout.sidebar-item url="/admin/dashboard" :active="request()->is('admin/dashboard')" 
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m2-2l6-6m6 6l2 3m-2 3v6m0 0H9m12 0v-6m0 0l-2-3m2 3V6m0 0h-6"/></svg>'>
                Dashboard
            </x-layout.sidebar-item>
            
            <x-layout.sidebar-item url="/admin/users" :active="request()->is('admin/users*')"
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0H9m6 0H9m6 0H9m0 6h12a2 2 0 01-2 2H5a2 2 0 01-2-2h12z"/></svg>'>
                Kelola User
            </x-layout.sidebar-item>
            
            <x-layout.sidebar-item url="/admin/vendors" :active="request()->is('admin/vendors*')"
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'>
                Kelola Vendor
            </x-layout.sidebar-item>
            
            <x-layout.sidebar-item url="/admin/transactions" :active="request()->is('admin/transactions*')"
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
        <x-layout.page-header title="Dashboard Admin">
            <x-buttons.btn variant="accent" size="sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Export
            </x-buttons.btn>
        </x-layout.page-header>

        <!-- Content -->
        <div class="flex-1 p-8 overflow-auto">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <x-cards.stat-card 
                    title="Total User"
                    value="{{ number_format($totalUsers) }}"
                    icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292m0 0a4.004 4.004 0 014 4.354m0 0a4 4 0 11-8 0m6 2a1 1 0 100-2 1 1 0 000 2z"/></svg>'
                    color="primary"
                />
                
                <x-cards.stat-card 
                    title="Total Vendor"
                    value="{{ number_format($totalVendors) }}"
                    icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12M8 7a2 2 0 100-4 2 2 0 000 4zm0 0a2 2 0 110 4 2 2 0 01-4 0 2 2 0 110-4zm4 8h8m-8 0a2 2 0 100-4 2 2 0 000 4zm0 0a2 2 0 110 4 2 2 0 01-4 0 2 2 0 110-4zm4 8h8m-8 0a2 2 0 100-4 2 2 0 000 4zm0 0a2 2 0 110 4 2 2 0 01-4 0 2 2 0 110-4z"/></svg>'
                    color="accent"
                />
                
                <x-cards.stat-card 
                    title="Total Pesanan"
                    value="{{ number_format($totalOrders) }}"
                    icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>'
                    color="green"
                />
                
                <x-cards.stat-card 
                    title="Pendapatan"
                    value="Rp {{ number_format($totalRevenue, 0, ',', '.') }}"
                    icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                    color="blue"
                />
            </div>

            <!-- Charts & Tables Row -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Orders -->
                <div class="lg:col-span-2">
                    <x-cards.card>
                        <div class="flex justify-between items-center pb-4 border-b border-gray-200 mb-4">
                            <h3 class="font-poppins text-lg font-bold text-gray-800">Pesanan Terbaru</h3>
                            <a href="/admin/orders" class="text-primary-700 text-sm font-medium hover:underline">Lihat Semua</a>
                        </div>
                        
                        <x-tables.table>
                            <x-tables.thead>
                                <x-tables.tr>
                                    <x-tables.th>ID Pesanan</x-tables.th>
                                    <x-tables.th>Customer</x-tables.th>
                                    <x-tables.th>Total</x-tables.th>
                                    <x-tables.th>Status</x-tables.th>
                                </x-tables.tr>
                            </x-tables.thead>
                            <x-tables.tbody>
                                @forelse ($recentOrders as $order)
                                    <x-tables.tr>
                                        <x-tables.td class="font-semibold text-gray-900">#{{ strtoupper($order->order_number) }}</x-tables.td>
                                        <x-tables.td>{{ $order->user->name }}</x-tables.td>
                                        <x-tables.td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</x-tables.td>
                                        <x-tables.td>
                                            @php
                                                $statusStyles = [
                                                    'pending' => 'info',
                                                    'completed' => 'warning',
                                                    'ready' => 'success',
                                                    'cancelled' => 'danger'
                                                ];
                                                $statusText = [
                                                    'pending' => 'Menunggu',
                                                    'completed' => 'Diproses',
                                                    'ready' => 'Siap Diambil',
                                                    'cancelled' => 'Dibatalkan'
                                                ];
                                            @endphp
                                            <x-badges.badge variant="{{ $statusStyles[$order->status] ?? 'secondary' }}">
                                                {{ $statusText[$order->status] ?? ucfirst($order->status) }}
                                            </x-badges.badge>
                                        </x-tables.td>
                                    </x-tables.tr>
                                @empty
                                    <x-tables.tr>
                                        <x-tables.td colspan="4" class="text-center py-4">
                                            <p class="text-gray-600">Belum ada pesanan</p>
                                        </x-tables.td>
                                    </x-tables.tr>
                                @endforelse
                            </x-tables.tbody>
                        </x-tables.table>
                    </x-cards.card>
                </div>

                <!-- Top Products -->
                <x-cards.card>
                    <div class="pb-4 border-b border-gray-200 mb-4">
                        <h3 class="font-poppins text-lg font-bold text-gray-800">Produk Top 5</h3>
                    </div>
                    
                    <div class="space-y-4">
                        @forelse ($topProducts as $product)
                            <div class="flex justify-between items-start {{ !$loop->last ? 'pb-3 border-b border-gray-100' : '' }}">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">{{ $product->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $product->order_details_count ?? 0 }} terjual</p>
                                </div>
                                <span class="text-primary-700 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                        @empty
                            <p class="text-gray-600 text-sm">Belum ada pesanan</p>
                        @endforelse
                    </div>
                </x-cards.card>
            </div>
        </div>
    </main>
</div>
@endsection
