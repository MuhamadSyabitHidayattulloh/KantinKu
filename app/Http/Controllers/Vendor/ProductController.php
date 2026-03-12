<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $vendor = Auth::user();
        $query = $vendor->products();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        $products = $query->paginate(15);

        return view('vendor.products', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('vendor.products-create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Set default status as available
        $validated['status'] = 'available';

        Auth::user()->products()->create($validated);

        return redirect()->route('vendor.products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        if ($product->vendor_id !== Auth::id()) {
            return back()->withErrors('Unauthorized');
        }
$categories = Category::all();
        return view('vendor.products-edit', ['product' => $product, 'categories' => $categories
        return view('vendor.products-edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        if ($product->vendor_id !== Auth::id()) {
            return back()->withErrors('Unauthorized');
        }

        $valicategory_id' => 'required|exists:categories,id',
            'dated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('vendor.products.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        if ($product->vendor_id !== Auth::id()) {
            return back()->withErrors('Unauthorized');
        }

        $product->delete();

        return redirect()->route('vendor.products.index')->with('success', 'Product deleted successfully');
    }
}
