<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', 0)->get();
        $customers = Customer::all();
        return view('pos.index', compact('products', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'customer_id' => 'nullable|exists:customers,id',
        ]);

        return DB::transaction(function () use ($request) {
            $totalAmount = 0;
            $totalItems = 0;

            $sale = Sale::create([
                'customer_id' => $request->customer_id,
                'total_amount' => 0,
                'total_items' => 0,
            ]);

            foreach ($request->items as $itemData) {
                $product = Product::lockForUpdate()->find($itemData['product_id']);

                if ($product->stock < $itemData['quantity']) {
                    throw new \Exception("Insufficient stock for {$product->name}");
                }

                $subtotal = $product->price * $itemData['quantity'];
                
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $itemData['quantity'],
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

                $product->decrement('stock', $itemData['quantity']);

                $totalAmount += $subtotal;
                $totalItems += $itemData['quantity'];
            }

            $sale->update([
                'total_amount' => $totalAmount,
                'total_items' => $totalItems,
            ]);

            return redirect()->route('pos.index')
                ->with('success', "Order #{$sale->id} completed successfully for Rp" . number_format($totalAmount, 0, '.', ','));
        });
    }
}
