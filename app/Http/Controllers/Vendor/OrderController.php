<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $vendor = Auth::user();

        // Get orders that contain this vendor's products
        $query = Order::whereHas('orderDetails.product', function ($q) use ($vendor) {
            $q->where('vendor_id', $vendor->id);
        });

        $orders = $query->with('user', 'orderDetails.product')->latest()->paginate(15);

        return view('vendor.orders', ['orders' => $orders]);
    }

    public function updateDetailStatus(Request $request, OrderDetail $detail)
    {
        $vendor = Auth::user();

        // Check if this order detail belongs to vendor's product
        if ($detail->product->vendor_id !== $vendor->id) {
            return back()->withErrors('Unauthorized');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,ready,completed,cancelled',
        ]);

        $detail->update($validated);

        return back()->with('success', 'Status produk ' . $detail->product->name . ' berhasil diperbarui');
    }
}
