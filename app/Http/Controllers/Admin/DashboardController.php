<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalVendors = User::where('role', 'vendor')->count();
        $totalOrders = Order::count();
        $admin = User::where('role', 'admin')->first();
        $adminRevenue = $admin && $admin->wallet ? $admin->wallet->balance : 0;

        $recentOrders = Order::with('user')->latest()->take(10)->get();
        $topProducts = Product::withCount('orderDetails')
            ->orderByDesc('order_details_count')
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalVendors' => $totalVendors,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $adminRevenue,
            'recentOrders' => $recentOrders,
            'topProducts' => $topProducts,
        ]);
    }
}
