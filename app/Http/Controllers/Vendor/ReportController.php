<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index()
    {
        $vendor = Auth::user();

        // Get vendor's revenue and stats
        $vendorOrders = Order::whereHas('orderDetails.product', function ($q) use ($vendor) {
            $q->where('vendor_id', $vendor->id);
        });

        // Revenue adalah wallet balance vendor (accumulated dari order yang completed)
        $totalRevenue = $vendor->wallet ? $vendor->wallet->balance : 0;
        $totalOrders = $vendorOrders->count();
        $totalProducts = $vendor->products()->count();

        // Orders by date (last 30 days) - hanya yang sudah completed
        $ordersByDate = DB::table('order_details')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->where('products.vendor_id', $vendor->id)
            ->where('order_details.status', 'completed')
            ->whereDate('order_details.created_at', '>=', now()->subDays(30))
            ->groupBy(DB::raw('DATE(order_details.created_at)'))
            ->selectRaw('DATE(order_details.created_at) as date, COUNT(*) as count, SUM(order_details.subtotal * 0.95) as revenue')
            ->orderBy('date')
            ->get();

        // Top products
        $topProducts = $vendor->products()
            ->withCount(['orderDetails' => function ($q) {
                $q->where('status', 'completed');
            }])
            ->orderByDesc('order_details_count')
            ->take(10)
            ->get();

        return view('vendor.reports', [
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'totalProducts' => $totalProducts,
            'ordersByDate' => $ordersByDate,
            'topProducts' => $topProducts,
        ]);
    }

    public function export()
    {
        $vendor = Auth::user();

        // Get data sama seperti di method index()
        $ordersByDate = DB::table('order_details')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->where('products.vendor_id', $vendor->id)
            ->where('order_details.status', 'completed')
            ->whereDate('order_details.created_at', '>=', now()->subDays(30))
            ->groupBy(DB::raw('DATE(order_details.created_at)'))
            ->selectRaw('DATE(order_details.created_at) as date, COUNT(*) as count, SUM(order_details.subtotal * 0.95) as revenue')
            ->orderBy('date')
            ->get();

        // Create CSV response
        $response = new StreamedResponse(function () use ($ordersByDate) {
            $handle = fopen('php://output', 'w');

            // Header
            fputcsv($handle, ['Tanggal', 'Jumlah Pesanan', 'Total Penjualan', 'Rata-rata Pesanan'], ';');

            // Data rows
            foreach ($ordersByDate as $data) {
                fputcsv($handle, [
                    \Carbon\Carbon::parse($data->date)->format('d/m/Y'),
                    $data->count,
                    'Rp ' . number_format($data->revenue, 0, ',', '.'),
                    'Rp ' . number_format($data->revenue / max($data->count, 1), 0, ',', '.'),
                ], ';');
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="laporan-vendor-' . now()->format('Y-m-d') . '.csv"',
        ]);

        return $response;
    }
}
