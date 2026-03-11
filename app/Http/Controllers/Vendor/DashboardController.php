<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $vendor = Auth::user();

        $totalProducts = $vendor->products()->count();
        $totalOrders = Order::whereHas('orderDetails.product', function ($query) use ($vendor) {
            $query->where('vendor_id', $vendor->id);
        })->count();
        $totalRevenue = Order::whereHas('orderDetails.product', function ($query) use ($vendor) {
            $query->where('vendor_id', $vendor->id);
        })->where('status', 'completed')->sum('total_amount');

        $recentProducts = $vendor->products()->latest()->take(5)->get();
        $recentOrders = Order::whereHas('orderDetails.product', function ($query) use ($vendor) {
            $query->where('vendor_id', $vendor->id);
        })->with('orderDetails.product')->latest()->take(10)->get();

        return view('vendor.dashboard', [
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'recentProducts' => $recentProducts,
            'recentOrders' => $recentOrders,
        ]);
    }
}
