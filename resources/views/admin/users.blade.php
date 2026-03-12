@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <x-layout.sidebar subtitle="Admin Panel">
        <x-layout.sidebar-group title="Menu Utama">
            <x-layout.sidebar-item url="/admin/dashboard"
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m2-2l6-6m6 6l2 3m-2 3v6m0 0H9m12 0v-6m0 0l-2-3m2 3V6m0 0h-6"/></svg>'>
                Dashboard
            </x-layout.sidebar-item>

            <x-layout.sidebar-item url="/admin/users" :active="request()->is('admin/users*')"
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0H9m6 0H9m6 0H9m0 6h12a2 2 0 01-2 2H5a2 2 0 01-2-2h12z"/></svg>'>
                Kelola User
            </x-layout.sidebar-item>

            <x-layout.sidebar-item url="/admin/vendors"
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'>
                Kelola Vendor
            </x-layout.sidebar-item>

            <x-layout.sidebar-item url="/admin/transactions"
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'>
                Top Up & Withdraw
            </x-layout.sidebar-item>

            <x-layout.sidebar-item url="/admin/reports"
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
        <x-layout.page-header title="Kelola User">
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex gap-3">
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
