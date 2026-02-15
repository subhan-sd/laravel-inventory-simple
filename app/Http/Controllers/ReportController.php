<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function exportSales()
    {
        $sales = Sale::with('customer')->latest()->get();

        $response = new StreamedResponse(function () use ($sales) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Order ID', 'Date', 'Customer', 'Items', 'Total Amount', 'Payment Method']);

            foreach ($sales as $sale) {
                fputcsv($handle, [
                    '#ORD-' . $sale->id,
                    $sale->created_at->format('Y-m-d H:i'),
                    $sale->customer?->name ?? 'Guest',
                    $sale->total_items,
                    $sale->total_amount,
                    $sale->payment_method
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="sales_report_' . date('Y-m-d') . '.csv"');

        return $response;
    }

    public function exportInventory()
    {
        $products = Product::all();

        $response = new StreamedResponse(function () use ($products) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Product ID', 'Name', 'Category', 'Price', 'Stock']);

            foreach ($products as $product) {
                fputcsv($handle, [
                    '#PROD-' . $product->id,
                    $product->name,
                    $product->category,
                    $product->price,
                    $product->stock
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="inventory_report_' . date('Y-m-d') . '.csv"');

        return $response;
    }
}
