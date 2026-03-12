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
        // Hanya hitung orders yang memiliki minimal 1 completed product dari vendor
        $totalOrders = Order::whereHas('orderDetails', function ($q) use ($vendor) {
            $q->where('status', 'completed')
              ->whereHas('product', function ($p) use ($vendor) {
                  $p->where('vendor_id', $vendor->id);
              });
        })->distinct()->count();

        // Revenue adalah wallet balance vendor (accumulated dari order yang completed)
        $totalRevenue = $vendor->wallet ? $vendor->wallet->balance : 0;

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
