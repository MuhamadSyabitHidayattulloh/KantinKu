<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
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

        // Filter by order number search
        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        // Filter by order detail status
        if ($request->has('status') && !empty($request->input('status'))) {
            $status = $request->input('status');
            $query->whereHas('orderDetails', function ($q) use ($status) {
                $q->where('status', $status);
            });
        }

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

        $oldStatus = $detail->status;
        $detail->update($validated);

        // Saat status berubah menjadi completed, topup vendor dan admin wallet
        if ($validated['status'] === 'completed' && $oldStatus !== 'completed') {
            // Vendor dapat 95% dari subtotal
            $vendorRevenue = $detail->subtotal * 0.95;
            if ($vendor->wallet) {
                $vendor->wallet->topup($vendorRevenue, $detail->order->order_number, "Revenue from order {$detail->order->order_number} - {$detail->product->name}");
            }

            // Admin dapat 5% dari subtotal
            $adminFee = $detail->subtotal * 0.05;
            $admin = User::where('role', 'admin')->first();
            if ($admin && $admin->wallet) {
                $admin->wallet->topup($adminFee, $detail->order->order_number, "Admin fee from order {$detail->order->order_number}");
            }
        }

        return back()->with('success', 'Status produk ' . $detail->product->name . ' berhasil diperbarui');
    }
}
