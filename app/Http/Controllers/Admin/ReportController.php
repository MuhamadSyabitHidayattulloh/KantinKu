<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $totalTransactionValue = DB::table('order_details')
            ->sum('subtotal');

        $admin = User::where('role', 'admin')->first();
        $adminRevenue = $admin && $admin->wallet ? $admin->wallet->balance : 0;

        $totalOrders = Order::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalVendors = User::where('role', 'vendor')->count();

        // Orders by date (last 30 days)
        $ordersByDate = DB::table('order_details')
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count, SUM(subtotal) as revenue')
            ->orderBy('date')
            ->get();

        // Top vendors
        $topVendors = User::where('role', 'vendor')
            ->get()
            ->map(function ($vendor) {
                $vendor->total_sales = DB::table('order_details')
                    ->join('products', 'products.id', '=', 'order_details.product_id')
                    ->where('products.vendor_id', $vendor->id)
                    ->sum('order_details.subtotal');
                return $vendor;
            })
            ->sortByDesc('total_sales')
            ->take(10);

        return view('admin.reports', [
            'totalRevenue' => $adminRevenue,
            'totalTransactionValue' => $totalTransactionValue,
            'totalOrders' => $totalOrders,
            'totalUsers' => $totalUsers,
            'totalVendors' => $totalVendors,
            'ordersByDate' => $ordersByDate,
            'topVendors' => $topVendors,
        ]);
    }
}
