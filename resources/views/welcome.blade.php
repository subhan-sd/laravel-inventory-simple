@extends('layouts.app')

@section('title', 'ElectroTech Dashboard')

@section('content')
<!-- Welcome Banner -->
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-900">Good Morning, Admin!</h1>
    <p class="text-slate-500">Here's what's happening with your store today.</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stat Card 1 -->
    <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">Real-time</span>
        </div>
        <h3 class="text-slate-500 text-sm font-medium mb-1">Total Revenue</h3>
        <p class="text-2xl font-bold text-slate-900">Rp{{ number_format($stats['total_revenue'], 0, '.', ',') }}</p>
    </div>

    <!-- Stat Card 2 -->
    <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="p-2 bg-purple-50 text-purple-600 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
            </div>
            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">{{ $stats['total_orders'] }} orders</span>
        </div>
        <h3 class="text-slate-500 text-sm font-medium mb-1">Total Sales</h3>
        <p class="text-2xl font-bold text-slate-900">{{ $stats['total_orders'] }}</p>
    </div>

    <!-- Stat Card 3 -->
    <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="p-2 bg-amber-50 text-amber-600 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3.251v8.615m-6.75-4.671 6.75 6.75 6.75-6.75M12 3a2.25 2.25 0 0 0 2.25 2.25h-4.5A2.25 2.25 0 0 0 12 3Z" />
                </svg>
            </div>
            <span class="text-xs font-semibold {{ $stats['low_stock'] > 5 ? 'text-red-600 bg-red-50' : 'text-amber-600 bg-amber-50' }} px-2 py-1 rounded-full">Alert</span>
        </div>
        <h3 class="text-slate-500 text-sm font-medium mb-1">Low Stock Items</h3>
        <p class="text-2xl font-bold text-slate-900">{{ $stats['low_stock'] }}</p>
    </div>

    <!-- Stat Card 4 -->
    <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </div>
            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">Active</span>
        </div>
        <h3 class="text-slate-500 text-sm font-medium mb-1">Total Customers</h3>
        <p class="text-2xl font-bold text-slate-900">{{ $stats['total_customers'] }}</p>
    </div>
</div>

<!-- Main Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Recent Orders Table -->
    <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-slate-900">Recent Sales</h2>
            <a href="{{ url('/analytics') }}" class="text-sm font-medium text-brand-600 hover:text-brand-700">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-3 font-medium">Order ID</th>
                        <th class="px-6 py-3 font-medium">Items</th>
                        <th class="px-6 py-3 font-medium">Customer</th>
                        <th class="px-6 py-3 font-medium">Date</th>
                        <th class="px-6 py-3 font-medium text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recent_orders as $order)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-slate-900">#ORD-{{ $order->id }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $order->total_items }} items</td>
                            <td class="px-6 py-4 text-slate-600">{{ $order->customer?->name ?? 'Guest' }}</td>
                            <td class="px-6 py-4 text-slate-500 text-xs">{{ $order->created_at->format('M d, H:i') }}</td>
                            <td class="px-6 py-4 text-right font-medium text-slate-900">Rp{{ number_format($order->total_amount, 0, '.', ',') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-400">No orders yet. Start selling!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Popular Products -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-lg font-semibold text-slate-900">Featured Inventory</h2>
        </div>
        <div class="p-6 space-y-6">
            @forelse($popular_products as $product)
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-slate-900 truncate">{{ $product->name }}</h4>
                        <p class="text-xs text-slate-500">{{ $product->category }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-slate-900">Rp{{ number_format($product->price, 0, '.', ',') }}</p>
                        <p class="text-xs {{ $product->stock < 10 ? 'text-red-500' : 'text-green-600' }}">{{ $product->stock }} left</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-slate-400">No products available.</p>
            @endforelse
            
            <a href="{{ route('products.index') }}" class="block w-full text-center py-2 text-sm font-medium text-brand-600 bg-brand-50 hover:bg-brand-100 rounded-lg transition-colors">
                View All products
            </a>
        </div>
    </div>
</div>
@endsection
