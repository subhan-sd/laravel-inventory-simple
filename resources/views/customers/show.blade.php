@extends('layouts.app')

@section('title', 'Purchase History - ' . $customer->name)

@section('content')
<div class="mb-8">
    <a href="{{ route('customers.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-brand-600 mb-2 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        Back to customers
    </a>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">{{ $customer->name }}</h1>
            <p class="text-slate-500">Purchase History & Activity</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-brand-50 text-brand-700 border border-brand-100">
                {{ $sales->total() }} Total Orders
            </span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Customer Info Card -->
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Contact Info</h3>
            <div class="space-y-4">
                <div>
                    <p class="text-xs text-slate-500 mb-1">Email</p>
                    <p class="text-sm font-medium text-slate-900">{{ $customer->email ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 mb-1">Phone</p>
                    <p class="text-sm font-medium text-slate-900">{{ $customer->phone ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 mb-1">Address</p>
                    <p class="text-sm font-medium text-slate-900">{{ $customer->address ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Purchase History Table -->
    <div class="lg:col-span-3">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-bold text-slate-900">Recent Transactions</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-slate-500 uppercase bg-slate-50/50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 font-medium">Order ID</th>
                            <th class="px-6 py-4 font-medium">Date</th>
                            <th class="px-6 py-4 font-medium">Payment</th>
                            <th class="px-6 py-4 font-medium text-right">Items</th>
                            <th class="px-6 py-4 font-medium text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($sales as $sale)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4">
                                    <span class="font-bold text-slate-900">#ORD-{{ $sale->id }}</span>
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $sale->created_at->format('M d, Y') }}
                                    <div class="text-[10px] text-slate-400">{{ $sale->created_at->format('H:i A') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-tight {{ 
                                        match($sale->payment_method) {
                                            'QRIS' => 'bg-emerald-100 text-emerald-800',
                                            'VA' => 'bg-blue-100 text-blue-800',
                                            'Transfer' => 'bg-indigo-100 text-indigo-800',
                                            default => 'bg-slate-100 text-slate-800'
                                        }
                                    }}">
                                        {{ $sale->payment_method }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-slate-600 font-medium">
                                    {{ $sale->total_items }}
                                </td>
                                <td class="px-6 py-4 text-right font-bold text-slate-900">
                                    Rp{{ number_format($sale->total_amount, 0, '.', ',') }}
                                </td>
                            </tr>
                            <!-- Order Items (Optional Expansion) -->
                            <tr class="bg-slate-50/30">
                                <td colspan="5" class="px-6 py-2">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($sale->items as $item)
                                            <span class="text-[10px] px-1.5 py-0.5 bg-white border border-slate-200 rounded text-slate-500">
                                                {{ $item->product?->name }} (x{{ $item->quantity }})
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic">
                                    No purchase history found for this customer.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($sales->hasPages())
                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
                    {{ $sales->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
