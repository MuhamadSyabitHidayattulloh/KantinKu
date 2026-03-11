@extends('layouts.app')

@section('content')
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
                <p class="text-sm font-medium text-gray-900">Budi Santoso</p>
                <p class="text-xs text-gray-500">Saldo: Rp 250.000</p>
            </div>
            <button class="hidden md:flex p-2 rounded-lg hover:bg-gray-100">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            </button>
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
                <p class="text-sm font-medium text-gray-900">Budi Santoso</p>
                <p class="text-xs text-gray-500">Saldo: Rp 250.000</p>
            </div>
            <button class="w-full px-4 py-2 text-left text-red-600 hover:bg-red-50 rounded-lg">🚪 Logout</button>
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
            <!-- Order Card 1 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="font-poppins font-bold text-lg text-gray-900">#ORD-001</h3>
                        <p class="text-sm text-gray-500">Warung Nasi Jaya • 11 Mar 2025, 14:30</p>
                    </div>
                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Selesai</span>
                </div>

                <div class="border-t border-gray-200 pt-4 mb-4">
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Nasi Goreng Spesial x2</span>
                            <span class="font-medium">Rp 50.000</span>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Bayar</p>
                        <p class="font-poppins font-bold text-lg text-primary-700">Rp 50.000</p>
                    </div>
                    <button class="px-6 py-2 border-2 border-primary-700 text-primary-700 font-semibold rounded-lg hover:bg-primary-50 transition">
                        Lihat Detail
                    </button>
                </div>
            </div>

            <!-- Order Card 2 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="font-poppins font-bold text-lg text-gray-900">#ORD-002</h3>
                        <p class="text-sm text-gray-500">Warung Nasi Jaya • 11 Mar 2025, 13:15</p>
                    </div>
                    <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">Diproses</span>
                </div>

                <div class="border-t border-gray-200 pt-4 mb-4">
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Mie Kuah x1</span>
                            <span class="font-medium">Rp 15.000</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Es Teh Tarik x2</span>
                            <span class="font-medium">Rp 10.000</span>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <div class="bg-blue-50 rounded-lg p-3 mb-4 flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/></svg>
                        <p class="text-sm text-blue-800"><span class="font-semibold">Estimasi selesai:</span> 15 menit lagi</p>
                    </div>

                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Total Bayar</p>
                            <p class="font-poppins font-bold text-lg text-primary-700">Rp 25.000</p>
                        </div>
                        <button class="px-6 py-2 border-2 border-primary-700 text-primary-700 font-semibold rounded-lg hover:bg-primary-50 transition">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <!-- Order Card 3 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="font-poppins font-bold text-lg text-gray-900">#ORD-003</h3>
                        <p class="text-sm text-gray-500">Minuman Segar • 10 Mar 2025, 15:20</p>
                    </div>
                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Selesai</span>
                </div>

                <div class="border-t border-gray-200 pt-4 mb-4">
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Es Teh Tarik x1</span>
                            <span class="font-medium">Rp 5.000</span>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Bayar</p>
                        <p class="font-poppins font-bold text-lg text-primary-700">Rp 5.000</p>
                    </div>
                    <button class="px-6 py-2 border-2 border-primary-700 text-primary-700 font-semibold rounded-lg hover:bg-primary-50 transition">
                        Pesan Lagi
                    </button>
                </div>
            </div>

            <!-- Order Card 4 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="font-poppins font-bold text-lg text-gray-900">#ORD-004</h3>
                        <p class="text-sm text-gray-500">Bakso Enak • 09 Mar 2025, 12:00</p>
                    </div>
                    <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-semibold">Dibatalkan</span>
                </div>

                <div class="border-t border-gray-200 pt-4 mb-4">
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Soto Ayam x2</span>
                            <span class="font-medium">Rp 40.000</span>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <div class="bg-red-50 rounded-lg p-3 mb-4">
                        <p class="text-sm text-red-800"><span class="font-semibold">Alasan:</span> Toko telah menutup pesanan ini</p>
                    </div>

                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Dana Kembali</p>
                            <p class="font-poppins font-bold text-lg text-green-600">Rp 40.000</p>
                        </div>
                        <button class="px-6 py-2 border-2 border-primary-700 text-primary-700 font-semibold rounded-lg hover:bg-primary-50 transition">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Bottom Navigation -->
<x-layout.mobile-nav />
@endsection
