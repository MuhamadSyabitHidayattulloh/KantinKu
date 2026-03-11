<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = $user->orders();

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        $orders = $query->with('orderDetails.product')->latest()->paginate(15);

        return view('user.orders', ['orders' => $orders]);
    }

    public function show(Order $order)
    {
        $user = Auth::user();

        if ($order->user_id !== $user->id) {
            return back()->withErrors('Unauthorized');
        }

        $order->load('orderDetails.product');

        return view('user.orders-detail', ['order' => $order]);
    }

    public function cancel(Order $order)
    {
        $user = Auth::user();

        if ($order->user_id !== $user->id) {
            return back()->withErrors('Unauthorized');
        }

        if ($order->status !== 'pending') {
            return back()->withErrors('Only pending orders can be cancelled');
        }

        $order->update(['status' => 'cancelled']);

        // Return wallet balance
        if ($order->total_amount > 0 && $user->wallet) {
            $user->wallet->topup($order->total_amount, $order->order_number, "Refund for cancelled order {$order->order_number}");

            // Increase product stock
            foreach ($order->orderDetails as $detail) {
                $detail->product->update([
                    'stock' => $detail->product->stock + $detail->quantity,
                ]);
            }
        }

        return back()->with('success', 'Order cancelled and wallet refunded');
    }
}
