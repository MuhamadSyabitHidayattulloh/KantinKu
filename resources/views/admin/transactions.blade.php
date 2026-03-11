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
            
            <x-layout.sidebar-item url="/admin/users" 
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0H9m6 0H9m6 0H9m0 6h12a2 2 0 01-2 2H5a2 2 0 01-2-2h12z"/></svg>'>
                Kelola User
            </x-layout.sidebar-item>
            
            <x-layout.sidebar-item url="/admin/vendors" 
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'>
                Kelola Vendor
            </x-layout.sidebar-item>
            
            <x-layout.sidebar-item url="/admin/transactions" :active="request()->is('admin/transactions*')"
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
        <x-layout.page-header title="Top Up & Withdraw">
            <input type="text" placeholder="Cari transaksi..." class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 w-64">
        </x-layout.page-header>

        <!-- Content -->
        <div class="flex-1 p-8 overflow-auto">
            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <x-cards.stat-card 
                    title="Total Top Up"
                    value="Rp {{ number_format($totalTopup, 0, ',', '.') }}"
                    icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>'
                    color="green"
                />
                
                <x-cards.stat-card 
                    title="Total Withdraw"
                    value="Rp {{ number_format($totalWithdraw, 0, ',', '.') }}"
                    icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>'
                    color="red"
                />
                
                <x-cards.stat-card 
                    title="Saldo Pending"
                    value="Rp {{ number_format($pendingBalance, 0, ',', '.') }}"
                    icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                    color="blue"
                />
            </div>

            <!-- Forms Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Top Up Form -->
                <x-cards.card>
                    <h3 class="font-poppins font-bold text-lg text-gray-900 mb-6">💰 Top Up</h3>
                    <form id="topupForm" onsubmit="return confirmTopup(event)" action="{{ route('admin.transactions.topup') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Pilih User/Vendor</label>
                            <select id="topupUser" name="user_id" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200" required>
                                <option value="">-- Pilih User/Vendor --</option>
                                @forelse ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} (User)</option>
                                @empty
                                @endforelse
                                @forelse ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->name }} (Vendor)</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Jumlah (Rp)</label>
                            <input type="number" id="topupAmount" name="amount" placeholder="Min: 1000" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200" min="1000" step="100" required>
                        </div>
                        <button type="submit" class="w-full px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                            ✅ Top Up
                        </button>
                    </form>
                </x-cards.card>

                <!-- Withdraw Form -->
                <x-cards.card>
                    <h3 class="font-poppins font-bold text-lg text-gray-900 mb-6">💸 Withdraw</h3>
                    <form id="withdrawForm" onsubmit="return confirmWithdraw(event)" action="{{ route('admin.transactions.withdraw') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Pilih User/Vendor</label>
                            <select id="withdrawUser" name="user_id" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200" required>
                                <option value="">-- Pilih User/Vendor --</option>
                                @forelse ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} (User)</option>
                                @empty
                                @endforelse
                                @forelse ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->name }} (Vendor)</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Jumlah (Rp)</label>
                            <input type="number" id="withdrawAmount" name="amount" placeholder="Min: 100000" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200" min="100000" step="100" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">No Rekening</label>
                            <input type="text" name="bank_account" placeholder="Nomor rekening" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200" required>
                        </div>
                        <button type="submit" class="w-full px-6 py-3 bg-orange-600 text-white font-semibold rounded-lg hover:bg-orange-700 transition">
                            ✅ Withdraw
                        </button>
                    </form>
                </x-cards.card>
            </div>

            <!-- Transactions Table -->
            <x-cards.card>
                <div class="pb-4 border-b border-gray-200 mb-4">
                    <h3 class="font-poppins text-lg font-bold text-gray-800">Transaksi Top Up & Withdraw</h3>
                    <p class="text-sm text-gray-500 mt-1">Riwayat semua transaksi</p>
                </div>
                
                <x-tables.table>
                    <x-tables.thead>
                        <x-tables.tr>
                            <x-tables.th>Nama User</x-tables.th>
                            <x-tables.th>Tipe</x-tables.th>
                            <x-tables.th>Jumlah</x-tables.th>
                            <x-tables.th>Status</x-tables.th>
                            <x-tables.th>Tanggal</x-tables.th>
                        </x-tables.tr>
                    </x-tables.thead>
                    <x-tables.tbody>
                        @forelse ($transactions as $transaction)
                            <x-tables.tr>
                                <x-tables.td>{{ $transaction->wallet->user->name }}</x-tables.td>
                                <x-tables.td>
                                    <x-badges.badge variant="{{ $transaction->type === 'topup' ? 'success' : 'danger' }}">
                                        {{ $transaction->type === 'topup' ? 'Top Up' : 'Withdraw' }}
                                    </x-badges.badge>
                                </x-tables.td>
                                <x-tables.td class="font-semibold {{ $transaction->type === 'topup' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $transaction->type === 'topup' ? '+' : '-' }}Rp {{ number_format(abs($transaction->amount), 0, ',', '.') }}
                                </x-tables.td>
                                <x-tables.td>
                                    <x-badges.badge variant="{{ $transaction->status === 'completed' ? 'success' : ($transaction->status === 'pending' ? 'warning' : 'secondary') }}">
                                        {{ ucfirst($transaction->status) }}
                                    </x-badges.badge>
                                </x-tables.td>
                                <x-tables.td class="text-sm text-gray-600">{{ $transaction->created_at->format('d M, H:i') }}</x-tables.td>
                            </x-tables.tr>
                        @empty
                            <x-tables.tr>
                                <x-tables.td colspan="5" class="text-center py-8">
                                    <p class="text-gray-600">Belum ada transaksi</p>
                                </x-tables.td>
                            </x-tables.tr>
                        @endforelse
                    </x-tables.tbody>
                </x-tables.table>

                <!-- Pagination -->
                <div class="flex justify-between items-center mt-6 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">Menampilkan {{ count($transactions) }} transaksi</p>
                    @if ($transactions instanceof \Illuminate\Pagination\Paginator)
                        <div class="flex gap-2">
                            {{ $transactions->links() }}
                        </div>
                    @endif
                </div>
            </x-cards.card>
        </div>
    </main>
</div>

<script>
function confirmTopup(event) {
    event.preventDefault();
    const userSelect = document.getElementById('topupUser');
    const amountInput = document.getElementById('topupAmount');
    const userName = userSelect.options[userSelect.selectedIndex].text;
    const amount = parseInt(amountInput.value).toLocaleString('id-ID');
    
    if (confirm(`Konfirmasi Top Up:\nPenerima: ${userName}\nJumlah: Rp ${amount}\n\nLanjutkan?`)) {
        event.target.submit();
    }
    return false;
}

function confirmWithdraw(event) {
    event.preventDefault();
    const userSelect = document.getElementById('withdrawUser');
    const amountInput = document.getElementById('withdrawAmount');
    const userName = userSelect.options[userSelect.selectedIndex].text;
    const amount = parseInt(amountInput.value).toLocaleString('id-ID');
    
    if (confirm(`Konfirmasi Withdraw:\nPengguna: ${userName}\nJumlah: Rp ${amount}\n\nLanjutkan?`)) {
        event.target.submit();
    }
    return false;
}
</script>
@endsection
