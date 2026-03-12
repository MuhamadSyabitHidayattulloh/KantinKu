<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $products = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $products[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity,
                ];
                $total += $product->price * $quantity;
            }
        }

        return view('user.cart', [
            'products' => $products,
            'total' => $total,
        ]);
    }

    public function add(Product $product, Request $request)
    {
        if ($product->status !== 'available' || $product->stock <= 0) {
            return back()->withErrors('Product is not available');
        }

        $quantity = $request->input('quantity', 1);

        if ($quantity < 1 || $quantity > $product->stock) {
            return back()->withErrors('Invalid quantity');
        }

        $cart = session()->get('cart', []);
        $cart[$product->id] = ($cart[$product->id] ?? 0) + $quantity;

        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart');
    }

    public function update(Product $product, Request $request)
    {
        $quantity = $request->input('quantity', 1);

        if ($quantity < 1 || $quantity > $product->stock) {
            return back()->withErrors('Invalid quantity');
        }

        $cart = session()->get('cart', []);

        if ($quantity === 0) {
            unset($cart[$product->id]);
        } else {
            $cart[$product->id] = $quantity;
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Cart updated');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);

        return back()->with('success', 'Product removed from cart');
    }

    public function checkout(Request $request)
    {
        // Validate pickup_time
        $validated = $request->validate([
            'pickup_time' => 'required|string|in:break1,break2',
        ], [
            'pickup_time.required' => 'Waktu pengambilan harus dipilih',
            'pickup_time.in' => 'Waktu pengambilan tidak valid',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Keranjang masih kosong');
        }

        $user = Auth::user();
        $totalAmount = 0;
        $orderDetails = [];

        // Validate all products
        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);

            if (!$product || $product->status !== 'available' || $product->stock < $quantity) {
                return back()->with('error', "Produk {$product->name} tidak tersedia dengan jumlah yang diminta");
            }

            $subtotal = $product->price * $quantity;
            $totalAmount += $subtotal;
            $orderDetails[] = [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
                'subtotal' => $subtotal,
            ];
        }

        // Check wallet balance
        if (!$user->wallet || !$user->wallet->hasEnoughBalance($totalAmount)) {
            return back()->with('error', 'Saldo dompet tidak cukup. Silakan lakukan top-up terlebih dahulu');
        }

        // Create order
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => Order::generateOrderNumber(),
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'pickup_time' => $validated['pickup_time'],
        ]);

        // Create order details and reduce stock
        foreach ($orderDetails as $detail) {
            $product = Product::find($detail['product_id']);
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $detail['product_id'],
                'quantity' => $detail['quantity'],
                'price' => $detail['price'],
                'subtotal' => $detail['subtotal'],
            ]);

            // Reduce stock
            $product->update([
                'stock' => $product->stock - $detail['quantity'],
            ]);
        }

        // Deduct from wallet
        $user->wallet->payment($totalAmount, $order->order_number, "Order {$order->order_number}");

        // Clear cart
        session()->forget('cart');

        return redirect()->route('user.orders.index')->with('success', 'Order placed successfully!');
    }
}
