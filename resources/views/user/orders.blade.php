@extends('layouts.app')

@section('content')
<x-toast />

<!-- Top Navigation -->
<nav class="bg-white border-b border-gray-200 sticky top-0 z-40 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-8">
            <h1 class="font-poppins text-2xl font-bold text-primary-900">Kantinku</h1>
            <div class="hidden md:flex gap-6">
                <a href="/user/explore" class="text-gray-600 hover:text-gray-900">Jelajahi</a>
                <a href="/user/cart" class="text-gray-600 hover:text-gray-900">Keranjang</a>
                <a href="/user/orders" class="text-primary-700 font-medium hover:text-primary-900">Pesanan</a>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="hidden md:block text-right">
                <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-500">Saldo: Rp {{ number_format(auth()->user()->wallet->balance ?? 0, 0, ',', '.') }}</p>
            </div>
            <form action="{{ route('auth.logout') }}" method="POST" class="hidden md:flex">
                @csrf
                <button type="submit" class="p-2 rounded-lg hover:bg-gray-100">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </button>
            </form>
            <!-- Hamburger Menu (Mobile/Tablet) -->
            <button class="md:hidden p-2 rounded-lg hover:bg-gray-100" onclick="toggleMobileMenu()">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden border-t border-gray-200 bg-white">
        <div class="px-6 py-4 space-y-2">
            <a href="/user/explore" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Jelajahi</a>
            <a href="/user/cart" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Keranjang</a>
            <a href="/user/orders" class="block px-4 py-2 rounded-lg text-primary-700 font-medium bg-primary-50 hover:bg-primary-100">Pesanan</a>
            <hr class="my-2">
            <div class="px-4 py-2">
                <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-500">Saldo: Rp {{ number_format(auth()->user()->wallet->balance ?? 0, 0, ',', '.') }}</p>
            </div>
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full px-4 py-2 text-left text-red-600 hover:bg-red-50 rounded-lg">🚪 Logout</button>
            </form>
        </div>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
}
</script>

<!-- Main Content -->
<div class="min-h-screen bg-gray-50 py-8 pb-24 md:pb-8">
    <div class="max-w-4xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="font-poppins text-3xl font-bold text-gray-900 mb-2">Riwayat Pesanan</h2>
            <p class="text-gray-600">Lihat status pesanan anda yang sedang berjalan dan yang sudah selesai</p>
        </div>

        <!-- Filter Tabs -->
        <div class="flex gap-4 mb-8 border-b border-gray-200 overflow-x-auto">
            <button class="px-6 py-3 border-b-2 border-primary-700 text-primary-700 font-medium whitespace-nowrap">Semua</button>
            <button class="px-6 py-3 text-gray-600 hover:text-gray-900 whitespace-nowrap">Sedang Diproses</button>
            <button class="px-6 py-3 text-gray-600 hover:text-gray-900 whitespace-nowrap">Siap Diambil</button>
            <button class="px-6 py-3 text-gray-600 hover:text-gray-900 whitespace-nowrap">Selesai</button>
            <button class="px-6 py-3 text-gray-600 hover:text-gray-900 whitespace-nowrap">Dibatalkan</button>
        </div>

        <!-- Order Items -->
        <div class="space-y-4">
            @forelse ($orders as $order)
                @php
                    $vendorNames = $order->orderDetails->map(fn($detail) => $detail->product->vendor->name)->unique()->implode(', ');
                    $statusStyles = [
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'processing' => 'bg-orange-100 text-orange-800',
                        'ready' => 'bg-blue-100 text-blue-800',
                        'completed' => 'bg-green-100 text-green-800',
                        'cancelled' => 'bg-red-100 text-red-800'
                    ];
                    $statusText = [
                        'pending' => 'Menunggu Persetujuan',
                        'processing' => 'Sedang Dikerjakan',
                        'ready' => 'Siap Diambil',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan'
                    ];
                @endphp
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="font-poppins font-bold text-lg text-gray-900">#{{ strtoupper($order->order_number) }}</h3>
                            <p class="text-sm text-gray-500">{{ $vendorNames }} • {{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <span class="px-4 py-2 {{ $statusStyles[$order->status] ?? 'bg-gray-100 text-gray-800' }} rounded-full text-sm font-semibold">
                            {{ $statusText[$order->status] ?? ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="border-t border-gray-200 pt-4 mb-4">
                        <div class="space-y-3">
                            @foreach ($order->orderDetails as $detail)
                                @php
                                    $statusStyles = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'processing' => 'bg-orange-100 text-orange-800',
                                        'ready' => 'bg-blue-100 text-blue-800',
                                        'completed' => 'bg-green-100 text-green-800',
                                        'cancelled' => 'bg-red-100 text-red-800'
                                    ];
                                    $statusText = [
                                        'pending' => 'Menunggu',
                                        'processing' => 'Dikerjakan',
                                        'ready' => 'Siap Diambil',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan'
                                    ];
                                @endphp
                                <div class="flex justify-between items-center text-sm p-3 bg-gray-50 rounded-lg">
                                    <div class="flex-1">
                                        <p class="text-gray-700 font-medium">{{ $detail->product->name }} x{{ $detail->quantity }}</p>
                                        <p class="text-xs text-gray-500">{{ $detail->product->vendor->name }}</p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="px-3 py-1 {{ $statusStyles[$detail->status] ?? 'bg-gray-100 text-gray-800' }} rounded-full text-xs font-semibold">
                                            {{ $statusText[$detail->status] ?? ucfirst($detail->status) }}
                                        </span>
                                        <span class="font-medium text-gray-900">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        @if($order->status === 'pending')
                            <div class="bg-yellow-50 rounded-lg p-3 mb-4 flex items-start gap-3">
                                <svg class="w-5 h-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <p class="text-sm text-yellow-800"><span class="font-semibold">Status:</span> Pesanan menunggu persetujuan vendor</p>
                            </div>
                        @elseif($order->status === 'processing')
                            <div class="bg-orange-50 rounded-lg p-3 mb-4 flex items-start gap-3">
                                <svg class="w-5 h-5 text-orange-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/></svg>
                                <p class="text-sm text-orange-800"><span class="font-semibold">Status:</span> Pesanan sedang dikerjakan</p>
                            </div>
                        @elseif($order->status === 'ready')
                            <div class="bg-blue-50 rounded-lg p-3 mb-4 flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                <p class="text-sm text-blue-800"><span class="font-semibold">Status:</span> Pesanan siap diambil!</p>
                            </div>
                        @elseif($order->status === 'completed')
                            <div class="bg-green-50 rounded-lg p-3 mb-4 flex items-start gap-3">
                                <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                <p class="text-sm text-green-800"><span class="font-semibold">Status:</span> Pesanan selesai</p>
                            </div>
                        @elseif($order->status === 'cancelled')
                            <div class="bg-red-50 rounded-lg p-3 mb-4">
                                <p class="text-sm text-red-800"><span class="font-semibold">Status:</span> Pesanan dibatalkan</p>
                            </div>
                        @endif

                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Total Bayar</p>
                                <p class="font-poppins font-bold text-lg text-primary-700">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            </div>
                            @if($order->status === 'pending')
                                <form action="{{ route('user.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Batalkan pesanan ini?')">
                                    @csrf
                                    <button type="submit" class="px-6 py-2 border-2 border-red-700 text-red-700 font-semibold rounded-lg hover:bg-red-50 transition">
                                        Batalkan
                                    </button>
                                </form>
                            @elseif($order->status === 'cancelled')
                                <form action="{{ route('user.cart.add', ['product' => $order->orderDetails->first()->product]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-6 py-2 border-2 border-primary-700 text-primary-700 font-semibold rounded-lg hover:bg-primary-50 transition">
                                        Pesan Lagi
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-md p-12 text-center">
                    <div class="mb-4">
                        <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <h3 class="font-semibold text-lg text-gray-900 mb-2">Belum Ada Pesanan</h3>
                    <p class="text-gray-600 mb-6">Anda belum membuat pesanan apapun. Mari mulai pesan sekarang!</p>
                    <a href="/user/explore" class="inline-block px-8 py-3 bg-primary-700 text-white font-semibold rounded-lg hover:bg-primary-800 transition">
                        Jelajahi Menu
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Mobile Bottom Navigation -->
<x-layout.mobile-nav />
@endsection
