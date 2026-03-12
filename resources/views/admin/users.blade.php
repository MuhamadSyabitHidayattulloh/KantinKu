@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <x-layout.admin-sidebar />
                <input type="text" name="search" placeholder="Cari user..." value="{{ request('search') }}" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 w-64">
                <button type="submit" class="px-6 py-2 bg-primary-700 text-white rounded-lg hover:bg-primary-800 transition font-medium">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.users.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium">
                        Reset
                    </a>
                @endif
            </form>
            <a href="/admin/users/create" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-700 text-white font-semibold rounded-lg hover:bg-primary-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah User
            </a>
        </x-layout.page-header>

        <!-- Content -->
        <div class="flex-1 p-8 overflow-auto">
            <x-cards.card>
                <div class="pb-4 border-b border-gray-200 mb-4">
                    <h3 class="font-poppins text-lg font-bold text-gray-800">Daftar User</h3>
                    <p class="text-sm text-gray-500 mt-1">Total {{ count($users) }} user terdaftar</p>
                </div>

                <x-tables.table>
                    <x-tables.thead>
                        <x-tables.tr>
                            <x-tables.th>Nama</x-tables.th>
                            <x-tables.th>Email</x-tables.th>
                            <x-tables.th>Role</x-tables.th>
                            <x-tables.th>Saldo</x-tables.th>
                            <x-tables.th>Status</x-tables.th>
                            <x-tables.th>Terdaftar</x-tables.th>
                            <x-tables.th>Aksi</x-tables.th>
                        </x-tables.tr>
                    </x-tables.thead>
                    <x-tables.tbody>
                        @forelse ($users as $user)
                            <x-tables.tr>
                                <x-tables.td class="font-semibold text-gray-900">{{ $user->name }}</x-tables.td>
                                <x-tables.td>{{ $user->email }}</x-tables.td>
                                <x-tables.td>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $user->role === 'user' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </x-tables.td>
                                <x-tables.td>Rp {{ number_format($user->wallet->balance ?? 0, 0, ',', '.') }}</x-tables.td>
                                <x-tables.td>
                                    <x-badges.badge variant="success">Aktif</x-badges.badge>
                                </x-tables.td>
                                <x-tables.td class="text-sm text-gray-600">{{ $user->created_at->format('d M Y') }}</x-tables.td>
                                <x-tables.td>
                                    <div class="flex gap-2">
                                        <a href="/admin/users/{{ $user->id }}/edit" class="text-primary-700 hover:text-primary-900 text-sm font-medium">Edit</a>
                                        <form action="/admin/users/{{ $user->id }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </x-tables.td>
                            </x-tables.tr>
                        @empty
                            <x-tables.tr>
                                <x-tables.td colspan="7" class="text-center py-8">
                                    <p class="text-gray-600">Belum ada user</p>
                                </x-tables.td>
                            </x-tables.tr>
                        @endforelse
                    </x-tables.tbody>
                </x-tables.table>

                <!-- Pagination -->
                <div class="flex justify-between items-center mt-6 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">Menampilkan {{ count($users) }} user</p>
                    @if ($users instanceof \Illuminate\Pagination\Paginator)
                        <div class="flex gap-2">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </x-cards.card>
        </div>
    </main>
</div>
@endsection
