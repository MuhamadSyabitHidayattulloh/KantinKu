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
                <div class="relative">
                    <a href="/user/cart" class="text-primary-700 font-medium hover:text-primary-900">Keranjang</a>
                    @if(count(session()->get('cart', [])) > 0)
                        <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">{{ count(session()->get('cart', [])) }}</span>
                    @endif
                </div>
                <a href="/user/orders" class="text-gray-600 hover:text-gray-900">Pesanan</a>
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
            <div class="relative">
                <a href="/user/cart" class="block px-4 py-2 rounded-lg text-primary-700 font-medium bg-primary-50 hover:bg-primary-100">Keranjang</a>
                @if(count(session()->get('cart', [])) > 0)
                    <span class="absolute top-1 right-2 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ count(session()->get('cart', [])) }}</span>
                @endif
            </div>
            <a href="/user/orders" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Pesanan</a>
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
    <div class="max-w-6xl mx-auto px-6">
        <!-- Header -->
        <h2 class="font-poppins text-3xl font-bold text-gray-900 mb-8">Keranjang Belanja</h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-4">
                @forelse ($products as $item)
                    <!-- Cart Item -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex gap-4">
                            <div class="w-20 h-20 bg-accent-100 rounded-lg flex items-center justify-center flex-shrink-0 overflow-hidden">
                                @if ($item['product']->image)
                                    <img src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-10 h-10 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="text-sm text-gray-500">{{ $item['product']->vendor->name }}</p>
                                        <h3 class="font-poppins font-semibold text-gray-900">{{ $item['product']->name }}</h3>
                                    </div>
                                    <form action="{{ route('user.cart.remove', $item['product']) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-primary-700">Rp {{ number_format($item['product']->price, 0, ',', '.') }}</span>
                                    <div class="flex items-center border border-gray-300 rounded-lg">
                                        <form action="{{ route('user.cart.update', $item['product']) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                            <button type="submit" class="px-3 py-1 hover:bg-gray-100" {{ $item['quantity'] == 1 ? 'disabled' : '' }}>-</button>
                                        </form>
                                        <span class="px-4 py-1 border-l border-r border-gray-300">{{ $item['quantity'] }}</span>
                                        <form action="{{ route('user.cart.update', $item['product']) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                            <button type="submit" class="px-3 py-1 hover:bg-gray-100">+</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty Cart -->
                    <div class="bg-white rounded-xl shadow-md p-12 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Keranjang Belanja Kosong</h3>
                        <p class="text-gray-500 mb-6">Anda belum menambahkan produk ke keranjang</p>
                        <a href="/user/explore" class="inline-block px-6 py-2 bg-primary-700 text-white font-medium rounded-lg hover:bg-primary-800">
                            Lanjut Belanja
                        </a>
                    </div>
                @endforelse
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-20">
                    <h3 class="font-poppins font-bold text-lg text-gray-900 mb-6">Ringkasan Pesanan</h3>

                    <div class="space-y-4 mb-6 pb-6 border-b border-gray-200">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal ({{ count($products) }} item)</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Biaya Layanan</span>
                            <span>Rp 0</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mb-6">
                        <span class="font-poppins font-bold text-lg">Total</span>
                        <span class="font-poppins font-bold text-xl text-primary-700">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <form action="{{ route('user.cart.checkout') }}" method="POST" class="space-y-4">
                        @csrf
                        <!-- Pickup Time Selection -->
                        <div>
                            <label for="pickup_time" class="block text-sm font-semibold text-gray-900 mb-3">Waktu Pengambilan</label>
                            <select id="pickup_time" name="pickup_time" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200 text-sm @error('pickup_time') border-red-500 @enderror">
                                <option value="">Pilih waktu pengambilan</option>
                                <option value="break1" @if(old('pickup_time') === 'break1') selected @endif>Break 1 (09.30 - 09.45)</option>
                                <option value="break2" @if(old('pickup_time') === 'break2') selected @endif>Break 2 (12.00 - 12.45)</option>
                            </select>
                            @error('pickup_time')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    <div class="space-y-3">
                        <button type="submit" class="w-full py-3 bg-primary-700 text-white font-semibold rounded-lg hover:bg-primary-800 transition disabled:opacity-50 disabled:cursor-not-allowed" {{ count($products) == 0 ? 'disabled' : '' }}>
                            Pesan Sekarang
                        </button>

                        <a href="/user/explore" class="block text-center w-full py-3 border-2 border-primary-700 text-primary-700 font-semibold rounded-lg hover:bg-primary-50 transition">
                            Lanjut Belanja
                        </a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Bottom Navigation -->
<x-layout.mobile-nav />
@endsection
