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

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Quick Adjustment Card -->
    <div class="lg:col-span-1">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm sticky top-8">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Stock Adjustment</h3>
            <form action="{{ route('products.adjust', $product) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Adjustment Type</label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="cursor-pointer">
                            <input type="radio" name="type" value="in" class="hidden peer" checked>
                            <div class="px-2 py-2 text-center text-xs border border-slate-200 rounded-lg peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-600 hover:bg-slate-50 transition-all font-bold">STOCK IN</div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="type" value="out" class="hidden peer">
                            <div class="px-2 py-2 text-center text-xs border border-slate-200 rounded-lg peer-checked:border-red-500 peer-checked:bg-red-50 peer-checked:text-red-600 hover:bg-slate-50 transition-all font-bold">STOCK OUT</div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="type" value="adjustment" class="hidden peer">
                            <div class="px-2 py-2 text-center text-xs border border-slate-200 rounded-lg peer-checked:border-amber-500 peer-checked:bg-amber-50 peer-checked:text-amber-600 hover:bg-slate-50 transition-all font-bold">SYNC</div>
                        </label>
                    </div>
                </div>

                <div>
                    <label for="quantity" class="block text-sm font-medium text-slate-700 mb-1">Quantity / Target</label>
                    <input type="number" name="quantity" id="quantity" min="1" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all" required>
                    <p class="text-[10px] text-slate-400 mt-1">Use 'SYNC' to manually set the absolute stock value.</p>
                </div>

                <div>
                    <label for="reason" class="block text-sm font-medium text-slate-700 mb-1">Reason / Note</label>
                    <input type="text" name="reason" id="reason" placeholder="e.g. Restock, Damaged Goods" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all">
                </div>

                <button type="submit" class="w-full py-3 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-xl transition-all shadow-lg shadow-slate-200 mt-4">
                    Update Inventory
                </button>
            </form>
        </div>
    </div>

    <!-- Adjustment Logs -->
    <div class="lg:col-span-2">
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
                            <th class="px-6 py-4 font-medium">Stock Change</th>
                            <th class="px-6 py-4 font-medium">Reason</th>
                            <th class="px-6 py-4 font-medium">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($adjustments as $adj)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ 
                                        match($adj->type) {
                                            'in' => 'bg-emerald-100 text-emerald-800',
                                            'out' => 'bg-red-100 text-red-800',
                                            default => 'bg-amber-100 text-amber-800'
                                        }
                                    }}">
                                        {{ $adj->type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-bold {{ $adj->type == 'out' ? 'text-red-600' : 'text-emerald-600' }}">
                                        {{ $adj->type == 'out' ? '-' : '+' }}{{ $adj->quantity }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-xs font-medium">
                                    <span class="text-slate-400">{{ $adj->previous_stock }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3 inline mx-1 text-slate-300">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                    </svg>
                                    <span class="text-slate-900 font-bold">{{ $adj->current_stock }}</span>
                                </td>
                                <td class="px-6 py-4 text-slate-600 text-xs italic">
                                    {{ $adj->reason }}
                                </td>
                                <td class="px-6 py-4 text-slate-400 text-xs">
                                    {{ $adj->created_at->format('M d, H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic">
                                    No stock movements recorded.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($adjustments->hasPages())
                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
                    {{ $adjustments->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
