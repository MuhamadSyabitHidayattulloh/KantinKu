@extends('layouts.app')

@section('content')
<x-toast />

<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <x-layout.admin-sidebar />

    <!-- Main Content -->
    <main class="flex-1 overflow-auto flex flex-col">
        <x-layout.page-header title="Kelola Kategori">
            <form action="{{ route('admin.categories.index') }}" method="GET" class="flex gap-3">
                <input type="text" name="search" placeholder="Cari kategori..." value="{{ request('search') }}" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 w-64">
                <button type="submit" class="px-6 py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-800 transition font-medium">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.categories.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium">
                        Reset
                    </a>
                @endif
            </form>
            <a href="/admin/categories/create" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-700 text-white font-semibold rounded-lg hover:bg-primary-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Kategori
            </a>
        </x-layout.page-header>

        <!-- Content -->
        <div class="flex-1 p-8 overflow-auto">
            <x-cards.card>
                <div class="pb-4 border-b border-gray-200 mb-4">
                    <h3 class="font-poppins text-lg font-bold text-gray-800">Daftar Kategori</h3>
                    <p class="text-sm text-gray-500 mt-1">Total {{ count($categories) }} kategori</p>
                </div>

                <x-tables.table>
                    <x-tables.thead>
                        <x-tables.tr>
                            <x-tables.th>Nama Kategori</x-tables.th>
                            <x-tables.th>Slug</x-tables.th>
                            <x-tables.th>Jumlah Produk</x-tables.th>
                            <x-tables.th>Deskripsi</x-tables.th>
                            <x-tables.th>Aksi</x-tables.th>
                        </x-tables.tr>
                    </x-tables.thead>
                    <x-tables.tbody>
                        @forelse ($categories as $category)
                            <x-tables.tr>
                                <x-tables.td class="font-semibold text-gray-900">{{ $category->name }}</x-tables.td>
                                <x-tables.td><code class="bg-gray-100 px-2 py-1 rounded text-sm">{{ $category->slug }}</code></x-tables.td>
                                <x-tables.td>
                                    <span class="inline-flex items-center rounded-full bg-primary-100 px-3 py-1 text-sm font-medium text-primary-700">
                                        {{ $category->products_count }}
                                    </span>
                                </x-tables.td>
                                <x-tables.td class="text-gray-600">{{ Str::limit($category->description, 50) }}</x-tables.td>
                                <x-tables.td>
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition text-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 transition text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </x-tables.td>
                            </x-tables.tr>
                        @empty
                            <x-tables.tr>
                                <x-tables.td colspan="5" class="text-center py-4">
                                    <p class="text-gray-600">Belum ada kategori</p>
                                </x-tables.td>
                            </x-tables.tr>
                        @endforelse
                    </x-tables.tbody>
                </x-tables.table>
            </x-cards.card>

            <!-- Pagination -->
            @if ($categories->hasPages())
                <div class="mt-6">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </main>
</div>
@endsection
