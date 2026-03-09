<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick POS | PharmaLink</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }

        .ts-control {
            border-radius: 1rem !important;
            padding: 12px 20px !important;
            border: none !important;
            background: #ffffff !important;
            font-weight: 700 !important;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="antialiased" x-data="saleManager()" x-cloak>

    <div class="min-h-screen py-8 px-4">
        <div class="max-w-6xl mx-auto">

            <form action="{{ route('receipts.store') }}" method="POST">
                @csrf
                <div
                    class="bg-white rounded-[3rem] shadow-2xl border border-slate-100 overflow-hidden flex flex-col lg:flex-row min-h-[700px]">

                    <div class="w-full lg:w-5/12 p-10 border-r border-slate-50 space-y-8 bg-slate-50/50">
                        <div class="flex justify-between items-center">
                            <h2 class="text-3xl font-black italic tracking-tighter">Pharma<span
                                    class="text-emerald-600">POS</span></h2>
                            <a href="{{ route('dashboard') }}"
                                class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-red-500 transition">←
                                Exit</a>
                        </div>

                        <div class="space-y-4 bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Live
                                Inventory Search</label>

                            <select id="medicine-search" placeholder="Search by name..." class="w-full">
                                <option value="">Start typing...</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}"
                                        data-name="{{ $product->name }}" data-stock="{{ $product->stock }}">
                                        {{ $product->name }} (Rs. {{ $product->price }}) - Stock: {{ $product->stock }}
                                    </option>
                                @endforeach
                            </select>

                            <div class="flex gap-2 pt-2">
                                <div class="w-24">
                                    <input type="number" x-model="qty" min="1"
                                        class="w-full px-4 py-4 rounded-2xl bg-slate-50 border-none font-black text-center focus:ring-2 focus:ring-emerald-500">
                                </div>
                                <button type="button" @click="addItem"
                                    class="flex-1 bg-emerald-600 text-white rounded-2xl font-black hover:bg-black transition-all shadow-lg shadow-emerald-100 active:scale-95">
                                    ADD TO BILL
                                </button>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 text-center block">Customer
                                Details</label>
                            <input type="text" name="customer_name" placeholder="Full Name"
                                class="w-full px-6 py-4 rounded-2xl bg-white border-none shadow-sm font-bold placeholder:text-slate-300">

                            <input type="text" name="customer_phone" placeholder="Phone Number"
                                class="w-full px-6 py-4 rounded-2xl bg-white border-none shadow-sm font-bold placeholder:text-slate-300">

                            <input type="email" name="customer_email" placeholder="Email Address (Optional)"
                                class="w-full px-6 py-4 rounded-2xl bg-white border-none shadow-sm font-bold placeholder:text-slate-300">
                        </div>
                    </div>

                    <div class="flex-1 p-10 flex flex-col bg-white">
                        <div class="flex justify-between items-center mb-8">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Current
                                Cart</span>
                            <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-4 py-1 rounded-full"
                                x-text="cart.length + ' Items Selected'"></span>
                        </div>

                        <div class="flex-1 overflow-y-auto max-h-[450px] pr-2 space-y-4">
                            <template x-for="(item, index) in cart" :key="index">
                                <div
                                    class="flex items-center justify-between p-5 bg-slate-50 rounded-3xl border border-slate-100 group hover:border-emerald-200 transition-all">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center font-black text-emerald-600 shadow-sm border border-slate-50"
                                            x-text="item.qty"></div>
                                        <div>
                                            <div class="text-sm font-black text-slate-800 uppercase tracking-tighter"
                                                x-text="item.name"></div>
                                            <div class="text-[10px] text-slate-400 font-bold"
                                                x-text="'Rs. ' + item.price + ' / unit'"></div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-6">
                                        <div class="text-sm font-black text-slate-900"
                                            x-text="'Rs. ' + (item.price * item.qty).toLocaleString()"></div>
                                        <button type="button" @click="removeItem(index)"
                                            class="text-slate-300 hover:text-red-500 transition-transform hover:scale-125">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <input type="hidden" :name="'items['+index+'][product_id]'" :value="item.id">
                                    <input type="hidden" :name="'items['+index+'][quantity]'" :value="item.qty">
                                </div>
                            </template>

                            <div x-show="cart.length === 0" class="py-24 text-center">
                                <div
                                    class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                                <p class="text-slate-300 font-black text-[10px] uppercase tracking-widest">Cart is
                                    empty. Start searching!</p>
                            </div>
                        </div>

                        <div class="mt-8 pt-8 border-t-2 border-dashed border-slate-100">
                            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                                <div>
                                    <span
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] block mb-1">Total
                                        Payable</span>
                                    <h3 class="text-5xl font-black text-slate-900 tracking-tighter italic"
                                        x-text="'Rs. ' + calculateTotal()"></h3>
                                </div>
                                <button type="submit" x-show="cart.length > 0"
                                    class="w-full md:w-auto px-12 py-6 bg-slate-900 text-white rounded-[2.5rem] font-black hover:bg-emerald-600 transition-all shadow-2xl shadow-slate-200 active:scale-95 uppercase tracking-widest text-xs">
                                    Generate Receipt →
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let tsControl;

        document.addEventListener('DOMContentLoaded', function () {
            // Initialize TomSelect
            tsControl = new TomSelect('#medicine-search', {
                create: false,
                sortField: { field: 'text', direction: 'asc' },
                allowEmptyOption: true,
            });
        });

        function saleManager() {
            return {
                qty: 1,
                cart: [],

                addItem() {
                    // TomSelect se direct value lein
                    const selectedId = tsControl.getValue();

                    if (!selectedId || selectedId === "") {
                        alert("Pehle koi medicine search kar ke select karein!");
                        return;
                    }

                    // Pure select element ko access karein data nikalne ke liye
                    const selectElement = document.getElementById('medicine-search');
                    const selectedOption = selectElement.options[selectElement.selectedIndex];

                    const name = selectedOption.getAttribute('data-name');
                    const price = parseFloat(selectedOption.getAttribute('data-price'));
                    const stock = parseInt(selectedOption.getAttribute('data-stock'));

                    // Validation
                    if (this.qty > stock) {
                        alert(`Sirf ${stock} bachi hain! Aap ${this.qty} add kar rahe hain.`);
                        return;
                    }

                    // Check duplicate in cart
                    let existing = this.cart.find(i => i.id === selectedId);
                    if (existing) {
                        if ((parseInt(existing.qty) + parseInt(this.qty)) > stock) {
                            alert("Total quantity stock se bahar ho rahi hai!");
                            return;
                        }
                        existing.qty = parseInt(existing.qty) + parseInt(this.qty);
                    } else {
                        this.cart.push({
                            id: selectedId,
                            name: name,
                            price: price,
                            qty: parseInt(this.qty)
                        });
                    }

                    // UI Reset
                    tsControl.clear();
                    this.qty = 1;
                },

                removeItem(index) {
                    this.cart.splice(index, 1);
                },

                calculateTotal() {
                    let total = this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
                    return total.toLocaleString();
                }
            }
        }
    </script>
</body>

</html>