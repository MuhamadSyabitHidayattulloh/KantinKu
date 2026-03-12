@extends('layouts.app')

@section('content')
<x-toast />

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
        <x-layout.page-header title="Kelola Pesanan">
            <form action="{{ route('vendor.orders.index') }}" method="GET" class="flex gap-3">
                <input type="text" name="search" placeholder="Cari pesanan atau customer..." value="{{ request('search') }}" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 w-64">
                <select name="status" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Di Proses</option>
                    <option value="ready" {{ request('status') === 'ready' ? 'selected' : '' }}>Siap Diambil</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                <button type="submit" class="px-6 py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-800 transition font-medium">
                    Filter
                </button>
                @if(request('search') || request('status'))
                    <a href="{{ route('vendor.orders.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium">
                        Reset
                    </a>
                @endif
            </form>
        </x-layout.page-header>

        <!-- Content -->
        <div class="flex-1 p-8 overflow-auto">
            <x-cards.card>
                <div class="pb-4 border-b border-gray-200 mb-4">
                    <h3 class="font-poppins text-lg font-bold text-gray-800">Daftar Pesanan</h3>
                    <p class="text-sm text-gray-500 mt-1">Total {{ count($orders) }} pesanan</p>
                </div>

                <x-tables.table>
                    <x-tables.thead>
                        <x-tables.tr>
                            <x-tables.th>ID Pesanan</x-tables.th>
                            <x-tables.th>Customer</x-tables.th>
                            <x-tables.th>Produk</x-tables.th>
                            <x-tables.th>Qty</x-tables.th>
                            <x-tables.th>Harga</x-tables.th>
                            <x-tables.th>Status Produk</x-tables.th>
                            <x-tables.th>Waktu Pesan</x-tables.th>
                            <x-tables.th>Aksi</x-tables.th>
                        </x-tables.tr>
                    </x-tables.thead>
                    <x-tables.tbody>
                        @forelse ($orders as $order)
                            @php
                                $vendorDetails = $order->orderDetails->filter(function ($detail) {
                                    return $detail->product->vendor_id === auth()->user()->id;
                                });

                                $statusStyles = [
                                    'pending' => 'info',
                                    'processing' => 'warning',
                                    'ready' => 'success',
                                    'completed' => 'success',
                                    'cancelled' => 'danger'
                                ];
                                $statusText = [
                                    'pending' => 'Menunggu Persetujuan',
                                    'processing' => 'Sedang Dikerjakan',
                                    'ready' => 'Siap Diambil',
                                    'completed' => 'Selesai',
                                    'cancelled' => 'Dibatalkan'
                                ];
                            @endphp
                            @forelse ($vendorDetails as $detail)
                                <x-tables.tr>
                                    <x-tables.td class="font-semibold text-gray-900">
                                        @if ($loop->first)
                                            #{{ strtoupper($order->order_number) }}
                                        @endif
                                    </x-tables.td>
                                    <x-tables.td>
                                        @if ($loop->first)
                                            {{ $order->user->name }}
                                        @endif
                                    </x-tables.td>
                                    <x-tables.td>{{ $detail->product->name }}</x-tables.td>
                                    <x-tables.td class="text-center">{{ $detail->quantity }}</x-tables.td>
                                    <x-tables.td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</x-tables.td>
                                    <x-tables.td>
                                        <x-badges.badge variant="{{ $statusStyles[$detail->status] ?? 'secondary' }}">
                                            {{ $statusText[$detail->status] ?? ucfirst($detail->status) }}
                                        </x-badges.badge>
                                    </x-tables.td>
                                    <x-tables.td class="text-sm text-gray-600">
                                        @if ($loop->first)
                                            {{ $order->created_at->format('d M, H:i') }}
                                        @endif
                                    </x-tables.td>
                                    <x-tables.td>
                                        <div class="flex gap-2">
                                            @if ($detail->status === 'pending')
                                                <form action="{{ route('vendor.orderDetails.updateStatus', $detail->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="processing">
                                                    <button type="submit" title="Proses Produk" class="text-blue-600 hover:text-blue-900">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                                    </button>
                                                </form>
                                            @endif
                                            @if ($detail->status === 'processing')
                                                <form action="{{ route('vendor.orderDetails.updateStatus', $detail->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="ready">
                                                    <button type="submit" title="Siap Diambil" class="text-green-600 hover:text-green-900">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    </button>
                                                </form>
                                            @endif
                                            @if ($detail->status === 'ready')
                                                <form action="{{ route('vendor.orderDetails.updateStatus', $detail->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="completed">
                                                    <button type="submit" title="Selesai" class="text-purple-600 hover:text-purple-900">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                    </button>
                                                </form>
                                            @endif
                                            @if ($detail->status !== 'cancelled' && $detail->status !== 'completed')
                                                <form action="{{ route('vendor.orderDetails.updateStatus', $detail->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button type="submit" title="Batalkan" class="text-red-600 hover:text-red-900">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </x-tables.td>
                                </x-tables.tr>
                            @empty
                            @endforelse
                        @empty
                            <x-tables.tr>
                                <x-tables.td colspan="8" class="text-center py-8">
                                    <p class="text-gray-600">Belum ada pesanan</p>
                                </x-tables.td>
                            </x-tables.tr>
                        @endforelse
                    </x-tables.tbody>
                </x-tables.table>

                <!-- Pagination -->
                <div class="flex justify-between items-center mt-6 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">Menampilkan {{ count($orders) }} pesanan</p>
                    @if ($orders instanceof \Illuminate\Pagination\Paginator)
                        <div class="flex gap-2">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            </x-cards.card>
        </div>
    </main>
</div>
@endsection
