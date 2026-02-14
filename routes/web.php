<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\POSController;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Sale;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $stats = [
        'total_revenue' => Sale::sum('total_amount'),
        'total_orders' => Sale::count(),
        'low_stock' => Product::where('stock', '<', 10)->count(),
        'total_customers' => Customer::count(),
    ];
    
    $recent_orders = Sale::with('customer')->latest()->take(5)->get();
    $popular_products = Product::where('stock', '>', 0)->latest()->take(3)->get(); // Placeholder logic for now

    return view('welcome', compact('stats', 'recent_orders', 'popular_products'));
});

Route::resource('products', ProductController::class);
Route::post('products/{product}/adjust', [ProductController::class, 'adjustStock'])->name('products.adjust');
Route::resource('customers', CustomerController::class);

Route::get('/pos', [POSController::class, 'index'])->name('pos.index');
Route::post('/pos', [POSController::class, 'store'])->name('pos.store');

Route::get('/analytics', function() {
    return view('analytics');
})->name('analytics');
