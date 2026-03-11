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
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        $totalOrders = Order::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalVendors = User::where('role', 'vendor')->count();

        // Orders by date (last 30 days)
        $ordersByDate = Order::where('status', 'completed')
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count, SUM(total_amount) as revenue')
            ->orderBy('date')
            ->get();

        // Top vendors
        $topVendors = User::where('role', 'vendor')
            ->withCount('products')
            ->with(['products' => function ($query) {
                $query->withCount('orderDetails');
            }])
            ->get()
            ->map(function ($vendor) {
                $vendor->total_sales = $vendor->products->sum(function ($product) {
                    return $product->order_details_count * $product->price;
                });
                return $vendor;
            })
            ->sortByDesc('total_sales')
            ->take(10);

        return view('admin.reports', [
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'totalUsers' => $totalUsers,
            'totalVendors' => $totalVendors,
            'ordersByDate' => $ordersByDate,
            'topVendors' => $topVendors,
        ]);
    }
}
