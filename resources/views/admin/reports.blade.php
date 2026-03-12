@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <x-layout.admin-sidebar />
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Export CSV
            </a>
        </x-layout.page-header>

        <!-- Content -->
        <div class="flex-1 p-8 overflow-auto">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <x-cards.stat-card
                    title="Total Pesanan"
                    value="{{ number_format($totalOrders) }}"
                    icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>'
                    color="primary"
                />

                <x-cards.stat-card
                    title="Total Pendapatan"
                    value="Rp {{ number_format($totalRevenue, 0, ',', '.') }}"
                    icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                    color="accent"
                />

                <x-cards.stat-card
                    title="Total Users"
                    value="{{ number_format($totalUsers) }}"
                    icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                    color="green"
                />

                <x-cards.stat-card
                    title="Total Vendor"
                    value="{{ number_format($totalVendors) }}"
                    icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292m0 0a4.004 4.004 0 014 4.354m0 0a4 4 0 11-8 0m6 2a1 1 0 100-2 1 1 0 000 2z"/></svg>'
                    color="blue"
                />
            </div>

            <!-- Charts & Tables -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Sales Performance -->
                <div class="lg:col-span-2">
                    <x-cards.card>
                        <div class="pb-4 border-b border-gray-200 mb-6">
                            <h3 class="font-poppins text-lg font-bold text-gray-800">Performa Penjualan</h3>
                        </div>

                        <div class="h-64">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </x-cards.card>
                </div>

                <!-- Top Vendors -->
                <x-cards.card>
                    <div class="pb-4 border-b border-gray-200 mb-4">
                        <h3 class="font-poppins text-lg font-bold text-gray-800">Top Vendor</h3>
                    </div>

                    <div class="space-y-4">
                        @forelse ($topVendors as $vendor)
                            <div class="flex items-center justify-between {{ !$loop->last ? 'pb-3 border-b border-gray-100' : '' }}">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">{{ $vendor->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $vendor->products_count ?? 0 }} produk</p>
                                </div>
                                <span class="text-primary-700 text-sm font-semibold">Rp {{ number_format($vendor->total_sales ?? 0, 0, ',', '.') }}</span>
                            </div>
                        @empty
                            <p class="text-gray-600 text-sm">Belum ada vendor</p>
                        @endforelse
                    </div>
                </x-cards.card>
            </div>

            <!-- Detailed Report Table -->
            <div class="mt-6">
                <x-cards.card>
                    <div class="pb-4 border-b border-gray-200 mb-4">
                        <h3 class="font-poppins text-lg font-bold text-gray-800">Laporan Rinci Penjualan Harian</h3>
                    </div>

                    <x-tables.table>
                        <x-tables.thead>
                            <x-tables.tr>
                                <x-tables.th>Tanggal</x-tables.th>
                                <x-tables.th>Jumlah Pesanan</x-tables.th>
                                <x-tables.th>Total Penjualan</x-tables.th>
                                <x-tables.th>Rata-rata</x-tables.th>
                            </x-tables.tr>
                        </x-tables.thead>
                        <x-tables.tbody>
                            @forelse ($ordersByDate as $data)
                                <x-tables.tr>
                                    <x-tables.td class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($data->date)->format('d M Y') }}</x-tables.td>
                                    <x-tables.td>{{ $data->count }}</x-tables.td>
                                    <x-tables.td class="font-semibold text-gray-800">Rp {{ number_format($data->revenue, 0, ',', '.') }}</x-tables.td>
                                    <x-tables.td>Rp {{ number_format($data->revenue / max($data->count, 1), 0, ',', '.') }}</x-tables.td>
                                </x-tables.tr>
                            @empty
                                <x-tables.tr>
                                    <x-tables.td colspan="4" class="text-center py-4">
                                        <p class="text-gray-600">Belum ada data pesanan</p>
                                    </x-tables.td>
                                </x-tables.tr>
                            @endforelse
                        </x-tables.tbody>
                    </x-tables.table>
                </x-cards.card>
            </div>
        </div>
    </main>
</div>

@section('extra-js')
<script>
    // Prepare data for chart
    const ordersByDate = @json($ordersByDate);
    const dates = ordersByDate.map(d => new Date(d.date).toLocaleDateString('id-ID', { month: 'short', day: 'numeric' }));
    const orders = ordersByDate.map(d => d.count);
    const revenues = ordersByDate.map(d => d.revenue);

    // Initialize Sales Chart
    const ctx = document.getElementById('salesChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [
                    {
                        label: 'Jumlah Pesanan',
                        data: orders,
                        borderColor: '#26b2a2',
                        backgroundColor: 'rgba(38, 178, 162, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        yAxisID: 'y',
                    },
                    {
                        label: 'Total Pendapatan (Rp)',
                        data: revenues,
                        borderColor: '#ffb430',
                        backgroundColor: 'rgba(255, 180, 48, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        yAxisID: 'y1',
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Jumlah Pesanan'
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Pendapatan (Rp)'
                        },
                        grid: {
                            drawOnChartArea: false,
                        },
                    },
                }
            }
        });
    }
</script>
@endsection

@endsection
