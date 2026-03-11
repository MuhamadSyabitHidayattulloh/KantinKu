<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $vendor = Auth::user();

        // Get vendor's revenue and stats
        $vendorOrders = Order::whereHas('orderDetails.product', function ($q) use ($vendor) {
            $q->where('vendor_id', $vendor->id);
        });

        $totalRevenue = $vendorOrders->where('status', 'completed')->sum('total_amount');
        $totalOrders = $vendorOrders->count();
        $totalProducts = $vendor->products()->count();

        // Orders by date (last 30 days)
        $ordersByDate = $vendorOrders->where('status', 'completed')
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count, SUM(total_amount) as revenue')
            ->orderBy('date')
            ->get();

        // Top products
        $topProducts = $vendor->products()
            ->withCount('orderDetails')
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
}
