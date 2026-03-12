@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <x-layout.admin-sidebar />
                <input type="text" name="search" placeholder="Cari vendor..." value="{{ request('search') }}" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 w-64">
                <button type="submit" class="px-6 py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-800 transition font-medium">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.vendors.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium">
                        Reset
                    </a>
                @endif
            </form>
            <a href="/admin/vendors/create" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-700 text-white font-semibold rounded-lg hover:bg-primary-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Vendor
            </a>
        </x-layout.page-header>

        <!-- Content -->
        <div class="flex-1 p-8 overflow-auto">
            <x-cards.card>
                <div class="pb-4 border-b border-gray-200 mb-4">
                    <h3 class="font-poppins text-lg font-bold text-gray-800">Daftar Vendor</h3>
                    <p class="text-sm text-gray-500 mt-1">Total {{ count($vendors) }} vendor terdaftar</p>
                </div>

                <x-tables.table>
                    <x-tables.thead>
                        <x-tables.tr>
                            <x-tables.th>Nama Vendor</x-tables.th>
                            <x-tables.th>Email</x-tables.th>
                            <x-tables.th>Produk</x-tables.th>
                            <x-tables.th>Status</x-tables.th>
                            <x-tables.th>Terdaftar</x-tables.th>
                            <x-tables.th>Aksi</x-tables.th>
                        </x-tables.tr>
                    </x-tables.thead>
                    <x-tables.tbody>
                        @forelse ($vendors as $vendor)
                            <x-tables.tr>
                                <x-tables.td>
                                    <div class="font-semibold text-gray-900">{{ $vendor->name }}</div>
                                </x-tables.td>
                                <x-tables.td>{{ $vendor->email }}</x-tables.td>
                                <x-tables.td class="text-center">{{ count($vendor->products) }} produk</x-tables.td>
                                <x-tables.td>
                                    <x-badges.badge variant="success">Aktif</x-badges.badge>
                                </x-tables.td>
                                <x-tables.td class="text-sm text-gray-600">{{ $vendor->created_at->format('d M Y') }}</x-tables.td>
                                <x-tables.td>
                                    <div class="flex gap-2">
                                        <a href="/admin/vendors/{{ $vendor->id }}/edit" class="text-primary-700 hover:text-primary-900 text-sm font-medium">Edit</a>
                                        <form action="/admin/vendors/{{ $vendor->id }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium" onclick="return confirm('Yakin ingin menghapus vendor ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </x-tables.td>
                            </x-tables.tr>
                        @empty
                            <x-tables.tr>
                                <x-tables.td colspan="6" class="text-center py-8">
                                    <p class="text-gray-600">Belum ada vendor</p>
                                </x-tables.td>
                            </x-tables.tr>
                        @endforelse
                    </x-tables.tbody>
                </x-tables.table>

                <!-- Pagination -->
                <div class="flex justify-between items-center mt-6 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">Menampilkan {{ count($vendors) }} vendor</p>
                    @if ($vendors instanceof \Illuminate\Pagination\Paginator)
                        <div class="flex gap-2">
                            {{ $vendors->links() }}
                        </div>
                    @endif
                </div>
            </x-cards.card>
        </div>
    </main>
</div>
@endsection
