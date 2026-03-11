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
            
            <x-layout.sidebar-item url="#" 
                icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>'>
                Logout
            </x-layout.sidebar-item>
        </x-layout.sidebar-group>
    </x-layout.sidebar>

    <!-- Main Content -->
    <main class="flex-1 overflow-auto flex flex-col">
        <x-layout.page-header title="Top Up & Withdraw">
            <input type="text" placeholder="Cari transaksi..." class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 w-64">
        </x-layout.page-header>

        <!-- Content -->
        <div class="flex-1 p-8 overflow-auto">
            <!-- Segmented Tabs -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <div class="flex gap-4 border-b border-gray-200 mb-6">
                    <button onclick="switchTab('history')" id="historyTab" class="px-6 py-3 border-b-2 border-primary-700 text-primary-700 font-semibold transition">📋 History</button>
                    <button onclick="switchTab('input')" id="inputTab" class="px-6 py-3 text-gray-600 hover:text-gray-900 font-semibold transition">➕ Top Up & Withdraw</button>
                </div>

                <!-- History Tab -->
                <div id="historyContent" class="block">
                    <!-- Statistics -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <x-cards.stat-card 
                        title="Total Top Up"
                        value="Rp 125.5M"
                        icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>'
                        color="green"
                    />
                    
                    <x-cards.stat-card 
                        title="Total Withdraw"
                        value="Rp 45.2M"
                        icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>'
                        color="red"
                    />
                    
                    <x-cards.stat-card 
                        title="Saldo Pending"
                        value="Rp 12.8M"
                        icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                        color="blue"
                    />
                    </div>
                </div>

                <!-- Input Tab -->
                <div id="inputContent" class="hidden">
                    <!-- Input Subtabs -->
                    <div class="flex gap-3 mb-6 bg-gray-50 p-4 rounded-lg">
                        <button onclick="switchInput('topup')" id="topupBtn" class="flex-1 px-4 py-3 bg-primary-700 text-white font-semibold rounded-lg transition hover:bg-primary-800">💰 Top Up</button>
                        <button onclick="switchInput('withdraw')" id="withdrawBtn" class="flex-1 px-4 py-3 bg-gray-300 text-gray-700 font-semibold rounded-lg transition hover:bg-gray-400">💸 Withdraw</button>
                    </div>

                    <!-- Top Up Form -->
                    <div id="topupForm" class="bg-white rounded-xl p-6 border border-gray-200">
                        <h3 class="font-poppins font-bold text-lg text-gray-900 mb-6">Top Up User/Vendor</h3>
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Tipe Pengguna</label>
                                <select class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200">
                                    <option value="">Pilih Tipe</option>
                                    <option value="user">User Pembeli</option>
                                    <option value="vendor">Vendor Penjual</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Nama User/Vendor</label>
                                <select class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200">
                                    <option value="">Pilih User/Vendor</option>
                                    <option value="budi">Budi Santoso</option>
                                    <option value="siti">Siti Nur Azizah</option>
                                    <option value="ahmad">Ahmad Wijaya</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Jumlah Top Up</label>
                                <input type="number" placeholder="Masukkan jumlah" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200">
                            </div>
                            <button class="w-full px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                                ✅ Konfirmasi Top Up
                            </button>
                        </div>
                    </div>

                    <!-- Withdraw Form -->
                    <div id="withdrawForm" class="hidden bg-white rounded-xl p-6 border border-gray-200">
                        <h3 class="font-poppins font-bold text-lg text-gray-900 mb-6">Input Withdraw User/Vendor</h3>
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Tipe Pengguna</label>
                                <select class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200">
                                    <option value="">Pilih Tipe</option>
                                    <option value="user">User Pembeli</option>
                                    <option value="vendor">Vendor Penjual</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Nama User/Vendor</label>
                                <select class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200">
                                    <option value="">Pilih User/Vendor</option>
                                    <option value="budi">Budi Santoso</option>
                                    <option value="siti">Siti Nur Azizah</option>
                                    <option value="ahmad">Ahmad Wijaya</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Jumlah Withdraw</label>
                                <input type="number" placeholder="Masukkan jumlah" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Nomor Rekening/Dompet</label>
                                <input type="text" placeholder="Masukkan nomor rekening" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 focus:ring-2 focus:ring-primary-200">
                            </div>
                            <button class="w-full px-6 py-3 bg-orange-600 text-white font-semibold rounded-lg hover:bg-orange-700 transition">
                                ✅ Konfirmasi Withdraw
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <x-cards.card id="historyCard">
                <div class="pb-4 border-b border-gray-200 mb-4">
                    <h3 class="font-poppins text-lg font-bold text-gray-800">Transaksi Top Up & Withdraw</h3>
                    <p class="text-sm text-gray-500 mt-1">Riwayat semua transaksi</p>
                </div>
                
                <x-tables.table>
                    <x-tables.thead>
                        <x-tables.tr>
                            <x-tables.th>ID Transaksi</x-tables.th>
                            <x-tables.th>Nama User</x-tables.th>
                            <x-tables.th>Tipe</x-tables.th>
                            <x-tables.th>Jumlah</x-tables.th>
                            <x-tables.th>Status</x-tables.th>
                            <x-tables.th>Tanggal</x-tables.th>
                            <x-tables.th>Aksi</x-tables.th>
                        </x-tables.tr>
                    </x-tables.thead>
                    <x-tables.tbody>
                        <x-tables.tr>
                            <x-tables.td class="font-semibold text-gray-900">#TRX-00156</x-tables.td>
                            <x-tables.td>Budi Santoso</x-tables.td>
                            <x-tables.td>
                                <x-badges.badge variant="info">Top Up</x-badges.badge>
                            </x-tables.td>
                            <x-tables.td class="font-semibold text-green-600">+Rp 100.000</x-tables.td>
                            <x-tables.td>
                                <x-badges.badge variant="success">Selesai</x-badges.badge>
                            </x-tables.td>
                            <x-tables.td class="text-sm text-gray-600">11 Mar, 14:30</x-tables.td>
                            <x-tables.td>
                                <button class="text-primary-700 hover:text-primary-900 text-sm font-medium">Detail</button>
                            </x-tables.td>
                        </x-tables.tr>
                        <x-tables.tr>
                            <x-tables.td class="font-semibold text-gray-900">#TRX-00155</x-tables.td>
                            <x-tables.td>Siti Nur Azizah</x-tables.td>
                            <x-tables.td>
                                <x-badges.badge variant="danger">Withdraw</x-badges.badge>
                            </x-tables.td>
                            <x-tables.td class="font-semibold text-red-600">-Rp 50.000</x-tables.td>
                            <x-tables.td>
                                <x-badges.badge variant="warning">Pending</x-badges.badge>
                            </x-tables.td>
                            <x-tables.td class="text-sm text-gray-600">11 Mar, 13:15</x-tables.td>
                            <x-tables.td>
                                <button class="text-primary-700 hover:text-primary-900 text-sm font-medium">Detail</button>
                            </x-tables.td>
                        </x-tables.tr>
                        <x-tables.tr>
                            <x-tables.td class="font-semibold text-gray-900">#TRX-00154</x-tables.td>
                            <x-tables.td>Ahmad Wijaya</x-tables.td>
                            <x-tables.td>
                                <x-badges.badge variant="info">Top Up</x-badges.badge>
                            </x-tables.td>
                            <x-tables.td class="font-semibold text-green-600">+Rp 250.000</x-tables.td>
                            <x-tables.td>
                                <x-badges.badge variant="success">Selesai</x-badges.badge>
                            </x-tables.td>
                            <x-tables.td class="text-sm text-gray-600">10 Mar, 09:45</x-tables.td>
                            <x-tables.td>
                                <button class="text-primary-700 hover:text-primary-900 text-sm font-medium">Detail</button>
                            </x-tables.td>
                        </x-tables.tr>
                    </x-tables.tbody>
                </x-tables.table>

                <!-- Pagination -->
                <div class="flex justify-between items-center mt-6 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">Menampilkan 1-10 dari 234</p>
                    <div class="flex gap-2">
                        <x-buttons.btn variant="secondary" size="sm">Sebelumnya</x-buttons.btn>
                        <x-buttons.btn variant="secondary" size="sm">Selanjutnya</x-buttons.btn>
                    </div>
                </div>
            </x-cards.card>
        </div>
    </main>
</div>

<script>
function switchTab(tab) {
    const historyTab = document.getElementById('historyTab');
    const inputTab = document.getElementById('inputTab');
    const historyContent = document.getElementById('historyContent');
    const inputContent = document.getElementById('inputContent');
    const historyCard = document.getElementById('historyCard');

    if (tab === 'history') {
        historyTab.classList.add('border-b-2', 'border-primary-700', 'text-primary-700');
        historyTab.classList.remove('text-gray-600');
        inputTab.classList.remove('border-b-2', 'border-primary-700', 'text-primary-700');
        inputTab.classList.add('text-gray-600');
        historyContent.classList.remove('hidden');
        inputContent.classList.add('hidden');
        historyCard.classList.remove('hidden');
    } else {
        inputTab.classList.add('border-b-2', 'border-primary-700', 'text-primary-700');
        inputTab.classList.remove('text-gray-600');
        historyTab.classList.remove('border-b-2', 'border-primary-700', 'text-primary-700');
        historyTab.classList.add('text-gray-600');
        inputContent.classList.remove('hidden');
        historyContent.classList.add('hidden');
        historyCard.classList.add('hidden');
    }
}

function switchInput(type) {
    const topupBtn = document.getElementById('topupBtn');
    const withdrawBtn = document.getElementById('withdrawBtn');
    const topupForm = document.getElementById('topupForm');
    const withdrawForm = document.getElementById('withdrawForm');

    if (type === 'topup') {
        topupBtn.classList.add('bg-primary-700', 'text-white');
        topupBtn.classList.remove('bg-gray-300', 'text-gray-700');
        withdrawBtn.classList.remove('bg-primary-700', 'text-white');
        withdrawBtn.classList.add('bg-gray-300', 'text-gray-700');
        topupForm.classList.remove('hidden');
        withdrawForm.classList.add('hidden');
    } else {
        withdrawBtn.classList.add('bg-primary-700', 'text-white');
        withdrawBtn.classList.remove('bg-gray-300', 'text-gray-700');
        topupBtn.classList.remove('bg-primary-700', 'text-white');
        topupBtn.classList.add('bg-gray-300', 'text-gray-700');
        withdrawForm.classList.remove('hidden');
        topupForm.classList.add('hidden');
    }
}
</script>
@endsection
