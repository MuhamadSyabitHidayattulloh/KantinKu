<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('status', 'available')->where('stock', '>', 0);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        if ($request->has('vendor')) {
            $query->where('vendor_id', $request->input('vendor'));
        }

        if ($request->has('sort')) {
            $sort = $request->input('sort');
            if ($sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            } elseif ($sort === 'newest') {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $products = $query->with('vendor')->paginate(12);

        return view('user.explore', ['products' => $products]);
    }

    public function show(Product $product)
    {
        if ($product->status !== 'available' || $product->stock <= 0) {
            return back()->withErrors('Product is not available');
        }

        $product->load('vendor');

        return view('user.product-detail', ['product' => $product]);
    }
}
