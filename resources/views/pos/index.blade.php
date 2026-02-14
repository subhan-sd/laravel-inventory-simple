@extends('layouts.app')

@section('title', 'Purchase/POS - ElectroTech')

@section('content')
<div x-data="posSystem()" class="grid grid-cols-1 lg:grid-cols-3 gap-8 h-[calc(100vh-10rem)]">
    <!-- Product Selection -->
    <div class="lg:col-span-2 flex flex-col overflow-hidden">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900 text-center lg:text-left">New Purchase</h1>
            <p class="text-slate-500 text-center lg:text-left">Select items from inventory to add to cart.</p>
        </div>

        <div class="flex-1 overflow-y-auto pr-2 grid grid-cols-1 sm:grid-cols-2 gap-4 pb-4">
            @foreach ($products as $product)
                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm hover:border-brand-500 transition-all cursor-pointer group"
                     @click="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, {{ $product->stock }})">
                    <div class="flex items-start justify-between mb-2">
                        <div class="p-2 bg-slate-50 rounded-lg group-hover:bg-brand-50 group-hover:text-brand-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3.251v8.615m-6.75-4.671 6.75 6.75 6.75-6.75M12 3a2.25 2.25 0 0 0 2.25 2.25h-4.5A2.25 2.25 0 0 0 12 3Z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 rounded-lg {{ $product->stock < 10 ? 'bg-amber-50 text-amber-700' : 'bg-slate-50 text-slate-600' }}">
                            {{ $product->stock }} in stock
                        </span>
                    </div>
                    <h3 class="font-semibold text-slate-900 truncate">{{ $product->name }}</h3>
                    <p class="text-brand-600 font-bold mt-1">Rp{{ number_format($product->price, 0, '.', ',') }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Cart Sidebar -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm flex flex-col overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-900">Current Cart</h2>
            <span x-text="cart.length" class="bg-brand-100 text-brand-700 text-xs font-bold px-2 py-1 rounded-full"></span>
        </div>

        <div class="flex-1 overflow-y-auto p-6 space-y-4">
            <template x-for="(item, index) in cart" :key="index">
                <div class="flex items-center gap-4 group">
                    <div class="flex-1">
                        <h4 class="text-sm font-semibold text-slate-900 truncate" x-text="item.name"></h4>
                        <p class="text-xs text-slate-500" x-text="'Rp' + formatNumber(item.price) + ' x ' + item.quantity"></p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button @click="changeQty(index, -1)" class="p-1 text-slate-400 hover:text-slate-900 hover:bg-slate-100 rounded transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                            </svg>
                        </button>
                        <span class="text-sm font-bold w-4 text-center" x-text="item.quantity"></span>
                        <button @click="changeQty(index, 1)" class="p-1 text-slate-400 hover:text-slate-900 hover:bg-slate-100 rounded transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </div>
                    <div class="text-right w-16">
                        <p class="text-sm font-bold text-slate-900" x-text="'Rp' + formatNumber(item.price * item.quantity)"></p>
                    </div>
                </div>
            </template>

            <template x-if="cart.length === 0">
                <div class="h-full flex flex-col items-center justify-center text-center py-12">
                    <div class="p-4 bg-slate-50 text-slate-300 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                    </div>
                    <p class="text-slate-400 text-sm">Cart is empty</p>
                </div>
            </template>
        </div>

        <div class="p-6 bg-slate-50 border-t border-slate-100 space-y-4">
            <div class="flex items-center justify-between text-slate-600 text-sm">
                <span>Subtotal</span>
                <span x-text="'Rp' + formatNumber(total)"></span>
            </div>
            <div class="flex items-center justify-between text-slate-900 font-bold text-lg">
                <span>Total</span>
                <span x-text="'Rp' + formatNumber(total)"></span>
            </div>

            <button @click="openCheckoutModal()" :disabled="cart.length === 0" 
                    class="w-full py-4 bg-brand-600 hover:bg-brand-700 disabled:opacity-50 disabled:cursor-not-allowed text-white font-bold rounded-xl shadow-lg shadow-brand-200 transition-all flex items-center justify-center gap-2">
                Checkout
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Checkout Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 transition-opacity" @click="showModal = false">
                <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
            <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                <form id="checkoutForm" action="{{ route('pos.store') }}" method="POST">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-xl leading-6 font-bold text-slate-900 mb-6">Complete Transaction</h3>

                        <div class="space-y-4">
                            <!-- Customer Selection -->
                            <div>
                                <label for="customer_id" class="block text-sm font-medium text-slate-700 mb-1">Select Customer (Optional)</label>
                                <select name="customer_id" id="customer_id" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all">
                                    <option value="">Guest Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Payment Method -->
                            <div>
                                <label for="payment_method" class="block text-sm font-medium text-slate-700 mb-1">Payment Method</label>
                                <div class="grid grid-cols-2 gap-2">
                                    <template x-for="method in ['Cash', 'Transfer', 'VA', 'QRIS']">
                                        <label class="cursor-pointer">
                                            <input type="radio" name="payment_method" :value="method" x-model="paymentMethod" class="hidden peer" required>
                                            <div class="px-3 py-2 text-center text-sm border border-slate-200 rounded-lg peer-checked:border-brand-500 peer-checked:bg-brand-50 peer-checked:text-brand-600 hover:bg-slate-50 transition-all" x-text="method"></div>
                                        </label>
                                    </template>
                                </div>
                            </div>

                            <!-- Summary -->
                            <div class="p-4 bg-slate-50 rounded-xl space-y-2">
                                <div class="flex justify-between text-sm text-slate-500">
                                    <span>Total Items</span>
                                    <span x-text="totalQty"></span>
                                </div>
                                <div class="flex justify-between font-bold text-slate-900">
                                    <span>Amount Due</span>
                                    <span x-text="'Rp' + formatNumber(total)"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden fields for cart items -->
                        <template x-for="(item, index) in cart" :key="index">
                            <div>
                                <input type="hidden" :name="'items['+index+'][product_id]'" :value="item.product_id">
                                <input type="hidden" :name="'items['+index+'][quantity]'" :value="item.quantity">
                            </div>
                        </template>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-3">
                        <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-lg px-6 py-3 bg-brand-600 text-base font-bold text-white hover:bg-brand-700 focus:outline-none sm:w-auto sm:text-sm transition-all">Confirm Order</button>
                        <button type="button" @click="showModal = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-slate-300 shadow-sm px-4 py-3 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm transition-colors">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function posSystem() {
        return {
            cart: [],
            paymentMethod: 'Cash',
            showModal: false,
            get total() {
                return this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            },
            get totalQty() {
                return this.cart.reduce((sum, item) => sum + item.quantity, 0);
            },
            addToCart(productId, name, price, stock) {
                const existing = this.cart.find(item => item.product_id === productId);
                if (existing) {
                    if (existing.quantity < stock) {
                        existing.quantity++;
                    }
                } else {
                    this.cart.push({
                        product_id: productId,
                        name: name,
                        price: price,
                        quantity: 1,
                        stock: stock
                    });
                }
            },
            changeQty(index, delta) {
                const item = this.cart[index];
                if (delta > 0 && item.quantity < item.stock) {
                    item.quantity++;
                } else if (delta < 0 && item.quantity > 1) {
                    item.quantity--;
                } else if (delta < 0 && item.quantity === 1) {
                    this.cart.splice(index, 1);
                }
            },
            formatNumber(num) {
                return new Intl.NumberFormat('en-US').format(num);
            },
            openCheckoutModal() {
                if (this.cart.length > 0) {
                    this.showModal = true;
                }
            }
        }
    }
</script>
@endsection
