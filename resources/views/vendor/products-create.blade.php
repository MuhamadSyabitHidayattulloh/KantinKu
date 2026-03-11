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
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>'>
                Kelola Produk
            </x-layout.sidebar-item>
            
            <x-layout.sidebar-item url="/vendor/orders" 
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V8a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>'>
                Pesanan Masuk
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
        <x-layout.page-header title="Tambah Produk Baru">
            <a href="/vendor/products" class="text-primary-700 text-sm font-medium hover:underline">
                ← Kembali ke Daftar Produk
            </a>
        </x-layout.page-header>

        <!-- Content -->
        <div class="flex-1 p-8 overflow-auto">
            <x-cards.card style="max-width: 700px; margin: 0 auto;">
                <h3 class="font-poppins text-lg font-bold text-gray-800 mb-6">Form Tambah Produk</h3>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-red-800 font-semibold mb-2">Terjadi kesalahan:</p>
                        <ul class="text-red-700 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Nama Produk</label>
                        <input type="text" name="name" value="{{ old('name') }}" required 
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200"
                            placeholder="Masukkan nama produk">
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Deskripsi</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200"
                            placeholder="Masukkan deskripsi produk">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Harga (Rp)</label>
                            <input type="number" name="price" value="{{ old('price') }}" required min="0" step="100"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200"
                                placeholder="Masukkan harga">
                            @error('price')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Stok</label>
                            <input type="number" name="stock" value="{{ old('stock') }}" required min="0"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200"
                                placeholder="Masukkan jumlah stok">
                            @error('stock')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Gambar Produk</label>
                            <input type="file" name="image" accept="image/*"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600">
                            <p class="text-gray-500 text-xs mt-1">Format: JPG, PNG (Max: 2MB)</p>
                            @error('image')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="flex-1 px-6 py-3 bg-primary-700 text-white font-semibold rounded-lg hover:bg-primary-800 transition">
                            ✓ Tambah Produk
                        </button>
                        <a href="/vendor/products" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition text-center">
                            ✕ Batal
                        </a>
                    </div>
                </form>
            </x-cards.card>
        </div>
    </main>
</div>
@endsection
