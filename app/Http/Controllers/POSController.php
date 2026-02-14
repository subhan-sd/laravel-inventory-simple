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
            'payment_method' => 'required|string|in:Cash,Transfer,VA,QRIS',
        ]);

        return DB::transaction(function () use ($request) {
            $totalAmount = 0;
            $totalItems = 0;

            $sale = \App\Models\Sale::create([
                'customer_id' => $request->customer_id,
                'total_amount' => 0,
                'total_items' => 0,
                'payment_method' => $request->payment_method,
            ]);

            foreach ($request->items as $itemData) {
                $product = \App\Models\Product::lockForUpdate()->find($itemData['product_id']);

                if ($product->stock < $itemData['quantity']) {
                    throw new \Exception("Insufficient stock for {$product->name}");
                }

                $previousStock = $product->stock;
                $subtotal = $product->price * $itemData['quantity'];
                
                \App\Models\SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $itemData['quantity'],
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

                // Create Stock Adjustment Record
                \App\Models\StockAdjustment::create([
                    'product_id' => $product->id,
                    'type' => 'out',
                    'quantity' => $itemData['quantity'],
                    'reason' => "Sale #{$sale->id}",
                    'previous_stock' => $previousStock,
                    'current_stock' => $previousStock - $itemData['quantity'],
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
                ->with('success', "Order #{$sale->id} via {$request->payment_method} completed successfully for Rp" . number_format($totalAmount, 0, '.', ','));
        });
    }
}
