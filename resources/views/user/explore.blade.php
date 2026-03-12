@extends('layouts.app')

@section('content')
<!-- Top Navigation -->
<nav class="bg-white border-b border-gray-200 sticky top-0 z-40 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-8">
            <h1 class="font-poppins text-2xl font-bold text-primary-900">Kantinku</h1>
            <div class="hidden md:flex gap-6">
                <a href="/user/explore" class="text-primary-700 font-medium hover:text-primary-900">Jelajahi</a>
                <div class="relative">
                    <a href="/user/cart" class="text-gray-600 hover:text-gray-900">Keranjang</a>
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
            <a href="/user/explore" class="block px-4 py-2 rounded-lg text-primary-700 font-medium bg-primary-50 hover:bg-primary-100">Jelajahi</a>
            <a href="/user/cart" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100">Keranjang</a>
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
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="font-poppins text-3xl font-bold text-gray-900 mb-2">Jelajahi Produk</h2>
            <p class="text-gray-600">Temukan berbagai makanan dan minuman favorit dari vendor terbaik</p>
        </div>

        <!-- Search & Filter -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <div class="flex gap-4 flex-wrap">
                <input type="text" placeholder="Cari produk..." class="flex-1 min-w-64 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600">
                <select class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600">
                    <option>Semua Kategori</option>
                    <option>Makanan</option>
                    <option>Minuman</option>
                    <option>Snack</option>
                </select>
                <select class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600">
                    <option>Terdekat</option>
                    <option>Terlaris</option>
                    <option>Rating Tertinggi</option>
                    <option>Harga Terendah</option>
                </select>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
                <!-- Product Card -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="h-48 bg-gradient-to-b from-accent-100 to-accent-50 flex items-center justify-center overflow-hidden">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-16 h-16 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="mb-3">
                            <p class="text-sm text-gray-500 font-medium">{{ $product->vendor->name }}</p>
                            <h3 class="font-poppins font-semibold text-gray-900">{{ $product->name }}</h3>
                        </div>
                        <div class="mb-3 pb-3 border-b border-gray-200">
                            <p class="text-sm font-semibold text-gray-700">Stok: <span class="text-primary-700">{{ $product->stock }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <h4 class="text-lg font-bold text-primary-700">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>
                            <form action="{{ route('user.cart.add', $product) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-800 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-700">Tidak ada produk yang tersedia</h3>
                    <p class="text-gray-500">Cobalah mengubah filter atau mencari kata kunci lain</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($products->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Mobile Bottom Navigation -->
<x-layout.mobile-nav />
@endsection
