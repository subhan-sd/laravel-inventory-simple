@extends('layouts.app')

@section('title', 'Stock History - ' . $product->name)

@section('content')
<div class="mb-8 rotate-0">
    <a href="{{ route('products.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-brand-600 mb-2 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        Back to inventory
    </a>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">{{ $product->name }}</h1>
            <p class="text-slate-500">Inventory Tracking & Stock Management</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right">
                <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">Current Stock</p>
                <p class="text-3xl font-black {{ $product->stock <= 5 ? 'text-red-600' : 'text-slate-900' }}">{{ $product->stock }}</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Quick Stock Adjustment Card -->
    <div class="">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm h-full">
            <div class="flex items-center gap-3 mb-4">
                <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.307a11.95 11.95 0 0 1 5.814-5.519l2.74-1.22m0 0-5.94-2.28m5.94 2.28-2.28 5.941" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Inventory Adjustment</h3>
            </div>
            <form action="{{ route('products.adjust', $product) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Adjustment Type</label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="cursor-pointer">
                            <input type="radio" name="type" value="in" class="hidden peer" checked>
                            <div class="px-2 py-2 text-center text-[10px] border border-slate-200 rounded-lg peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-600 hover:bg-slate-50 transition-all font-black">STOCK IN</div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="type" value="out" class="hidden peer">
                            <div class="px-2 py-2 text-center text-[10px] border border-slate-200 rounded-lg peer-checked:border-red-500 peer-checked:bg-red-50 peer-checked:text-red-600 hover:bg-slate-50 transition-all font-black">STOCK OUT</div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="type" value="adjustment" class="hidden peer">
                            <div class="px-2 py-2 text-center text-[10px] border border-slate-200 rounded-lg peer-checked:border-amber-500 peer-checked:bg-amber-50 peer-checked:text-amber-600 hover:bg-slate-50 transition-all font-black">SYNC</div>
                        </label>
                    </div>
                </div>

                <div>
                    <label for="quantity" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Quantity / Target</label>
                    <input type="number" name="quantity" id="quantity" min="1" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all" required>
                </div>

                <div>
                    <label for="reason" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Reason / Note</label>
                    <input type="text" name="reason" id="reason" placeholder="e.g. Restock, Damaged Goods" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all">
                </div>

                <button type="submit" class="w-full py-3 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-xl transition-all shadow-lg shadow-slate-200">
                    Update Stock
                </button>
            </form>
        </div>
    </div>

    <!-- Quick Price Adjustment Card -->
    <div class="">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm h-full">
            <div class="flex items-center gap-3 mb-4">
                <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Price Adjustment</h3>
            </div>
            <form action="{{ route('products.adjust-price', $product) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Current Selling Price</label>
                    <div class="px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-400 text-sm font-bold">
                        Rp{{ number_format($product->price, 0, '.', ',') }}
                    </div>
                </div>

                <div>
                    <label for="price" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">New Price (Rp)</label>
                    <input type="number" name="price" id="price" min="0" step="0.01" class="w-full px-4 py-2.5 bg-white border-2 border-brand-100 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-black" required>
                    <p class="text-[10px] text-slate-500 mt-2 italic font-medium">Changes will be logged in the price history below.</p>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-4 bg-brand-600 hover:bg-brand-700 text-white font-black rounded-xl transition-all shadow-lg shadow-brand-200">
                        Update Selling Price
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
    <!-- Stock History -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
            <h3 class="font-bold text-slate-900">Stock Movement Logs</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50/50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 font-medium">Type</th>
                        <th class="px-6 py-4 font-medium">Qty</th>
                        <th class="px-6 py-4 font-medium">Result</th>
                        <th class="px-6 py-4 font-medium">Reason</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($adjustments as $adj)
                        <tr class="hover:bg-slate-50/50 transition-colors text-xs">
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold uppercase {{ 
                                    match($adj->type) {
                                        'in' => 'bg-emerald-100 text-emerald-800',
                                        'out' => 'bg-red-100 text-red-800',
                                        default => 'bg-amber-100 text-amber-800'
                                    }
                                }}">
                                    {{ $adj->type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold">
                                {{ $adj->type == 'out' ? '-' : '+' }}{{ $adj->quantity }}
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-900">
                                {{ $adj->current_stock }}
                            </td>
                            <td class="px-6 py-4 text-slate-500 italic max-w-xs truncate">
                                {{ $adj->reason }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-slate-400 italic">No movement recorded.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Price History -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
            <h3 class="font-bold text-slate-900">Price Change History</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50/50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 font-medium">User</th>
                        <th class="px-6 py-4 font-medium">Old Price</th>
                        <th class="px-6 py-4 font-medium">New Price</th>
                        <th class="px-6 py-4 font-medium">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($product->priceHistories()->with('user')->latest()->get() as $pHistory)
                        <tr class="hover:bg-slate-50/50 transition-colors text-xs">
                            <td class="px-6 py-4 font-medium text-brand-700">
                                {{ $pHistory->user?->name ?? 'System' }}
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-400">
                                Rp{{ number_format($pHistory->old_price, 0, '.', ',') }}
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-900">
                                Rp{{ number_format($pHistory->new_price, 0, '.', ',') }}
                            </td>
                            <td class="px-6 py-4 text-slate-500">
                                {{ $pHistory->created_at->format('M d, H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-slate-400 italic">No price changes recorded.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
