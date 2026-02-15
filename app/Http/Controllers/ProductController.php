<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string|max:255',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $adjustments = $product->stockAdjustments()->latest()->paginate(10);
        return view('products.show', compact('product', 'adjustments'));
    }

    public function adjustStock(Request $request, Product $product)
    {
        $validated = $request->validate([
            'type' => 'required|in:in,out,adjustment',
            'quantity' => 'required|integer|min:1',
            'reason' => 'nullable|string|max:255',
        ]);

        $previousStock = $product->stock;
        
        if ($validated['type'] === 'in') {
            $currentStock = $previousStock + $validated['quantity'];
        } elseif ($validated['type'] === 'out') {
            if ($previousStock < $validated['quantity']) {
                return back()->with('error', 'Insufficient stock for this reduction.');
            }
            $currentStock = $previousStock - $validated['quantity'];
        } else {
            // Manual sync/adjustment
            $currentStock = $validated['quantity'];
        }

        \App\Models\StockAdjustment::create([
            'product_id' => $product->id,
            'type' => $validated['type'],
            'quantity' => $validated['quantity'],
            'reason' => $validated['reason'] ?? 'Manual Adjustment',
            'previous_stock' => $previousStock,
            'current_stock' => $currentStock,
        ]);

        $product->update(['stock' => $currentStock]);

        return redirect()->route('products.show', $product)
            ->with('success', 'Stock adjusted successfully.');
    }

    public function adjustPrice(Request $request, Product $product)
    {
        $validated = $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        $oldPrice = $product->price;
        $newPrice = $validated['price'];

        if ($oldPrice != $newPrice) {
            \App\Models\PriceHistory::create([
                'product_id' => $product->id,
                'old_price' => $oldPrice,
                'new_price' => $newPrice,
                'user_id' => auth()->id(),
            ]);

            $product->update(['price' => $newPrice]);

            return back()->with('success', 'Price adjusted successfully.');
        }

        return back()->with('info', 'New price is same as current price.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string|max:255',
        ]);

        $oldPrice = $product->price;
        $product->update($validated);

        if ($oldPrice != $validated['price']) {
            \App\Models\PriceHistory::create([
                'product_id' => $product->id,
                'old_price' => $oldPrice,
                'new_price' => $validated['price'],
                'user_id' => auth()->id(),
            ]);
        }

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
