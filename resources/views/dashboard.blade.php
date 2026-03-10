<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaLink | Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }

        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body
    x-data="{ search: '', showLowStock: false ,showRestockModal: false ,showAddNew: false, showTopSelling: false, showExpiryAlert: false ,showReportModal: false}">

    <div x-show="showRestockModal" x-cloak
        class="fixed inset-0 z-[150] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md">

        <div @click.away="showRestockModal = false"
            class="bg-white w-full max-w-4xl rounded-[3rem] shadow-2xl overflow-hidden border border-slate-100 flex flex-col h-[85vh]">

            <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                <div class="text-left">
                    <h3 class="text-2xl font-black text-slate-800 italic tracking-tighter">Inventory Management</h3>
                    <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mt-1">Update Stock or
                        Register New Medicines</p>
                </div>
                <div class="flex gap-4">
                    <button @click="showAddNew = !showAddNew"
                        class="bg-emerald-600 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-100">
                        + New Medicine
                    </button>
                    <button @click="showRestockModal = false"
                        class="text-slate-300 hover:text-slate-600 text-4xl font-light">&times;</button>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-8 custom-scrollbar">

                <div x-show="showAddNew" x-transition
                    class="mb-10 bg-emerald-50/50 p-8 rounded-[2.5rem] border-2 border-emerald-100 border-dashed">
                    <h4 class="text-xs font-black text-emerald-800 uppercase mb-6 italic text-left">Register New Product
                    </h4>
                    <form action="{{ route('products.store') }}" method="POST"
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        @csrf
                        <input type="text" name="name" placeholder="Medicine Name"
                            class="bg-white border-0 rounded-xl p-3 text-sm focus:ring-2 focus:ring-emerald-500 shadow-sm"
                            required>
                        <input type="number" name="price" placeholder="Price"
                            class="bg-white border-0 rounded-xl p-3 text-sm focus:ring-2 focus:ring-emerald-500 shadow-sm"
                            required>
                        <input type="number" name="stock" placeholder="Initial Qty"
                            class="bg-white border-0 rounded-xl p-3 text-sm focus:ring-2 focus:ring-emerald-500 shadow-sm"
                            required>
                        <input type="date" name="expiry_date"
                            class="bg-white border-0 rounded-xl p-3 text-sm focus:ring-2 focus:ring-emerald-500 shadow-sm"
                            required>
                        <div class="lg:col-span-4 text-right">
                            <button type="submit"
                                class="bg-emerald-800 text-white px-8 py-3 rounded-xl font-bold text-xs uppercase tracking-widest">Save
                                to Database</button>
                        </div>
                    </form>
                </div>

                <div class="text-left">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase mb-6 tracking-[0.2em]">Low Stock Alert
                        List (Stock <= 10)</h4>
                            <form action="{{ route('products.bulk-restock') }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 gap-3">
                                    @foreach($lowStockMedicines as $product)
                                        <div
                                            class="flex items-center justify-between p-5 bg-slate-50 rounded-[2rem] border border-slate-100 hover:border-slate-300 transition-all">
                                            <div class="flex items-center gap-5">
                                                <div
                                                    class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center font-black text-slate-400 text-sm shadow-sm border border-slate-50">
                                                    {{ $product->stock }}
                                                </div>
                                                <div>
                                                    <p class="font-black text-slate-800 text-base italic leading-tight">
                                                        {{ $product->name }}
                                                    </p>
                                                    <p
                                                        class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter mt-1">
                                                        Current Stock: {{ $product->stock }} Units</p>
                                                </div>
                                            </div>
                                            <div
                                                class="flex items-center gap-4 bg-white p-2 rounded-2xl border border-slate-100 shadow-inner">
                                                <span
                                                    class="text-[10px] font-black text-slate-400 uppercase px-2">Add:</span>
                                                <input type="number" name="restock[{{ $product->id }}]"
                                                    class="w-24 border-0 bg-transparent text-center text-lg font-black text-slate-800 focus:ring-0"
                                                    placeholder="0">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-8 sticky bottom-0">
                                    <button type="submit"
                                        class="w-full bg-slate-900 text-white py-5 rounded-[2rem] font-black text-xs uppercase tracking-[0.3em] shadow-2xl hover:bg-black transition-all">
                                        Update Inventory Stock
                                    </button>
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <nav class="glass sticky top-0 z-40 border-b border-slate-200/60 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div
                    class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                </div>
                <span class="text-xl font-extrabold text-slate-900 tracking-tight">Pharma<span
                        class="text-emerald-600">Link</span></span>
            </div>
            <div class="flex items-center gap-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="text-xs font-bold text-slate-400 hover:text-red-500 transition uppercase tracking-widest">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-10">

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
            <div>
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-2">Inventory <span
                        class="text-emerald-600">&</span> Sales</h1>
                <p class="text-slate-500 font-medium italic">Real Time Pharmacy Performance Monitoring System.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('receipts.create') }}"
                    class="px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold shadow-2xl shadow-slate-300 hover:bg-black transition-all transform hover:-translate-y-1 active:translate-y-0">
                    + Create New Sale
                </a>
                <button @click="showRestockModal = true"
                    class="bg-slate-900 text-white px-6 py-3 rounded-2xl font-bold hover:bg-slate-800 transition-all flex items-center gap-2 shadow-lg">
                    + Restock Inventory
                </button>


                <button @click="showReportModal = true"
                    class="bg-white border border-slate-200 text-slate-900 px-8 py-4 rounded-[2rem] font-black text-xs uppercase tracking-widest hover:bg-slate-50 transition-all shadow-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Reports
                </button>

                <div x-show="showReportModal" x-cloak
                    class="fixed inset-0 z-[160] flex items-center justify-center p-6 bg-slate-900/60 backdrop-blur-md">
                    <div @click.away="showReportModal = false"
                        class="bg-white w-full max-w-md rounded-[3rem] shadow-2xl overflow-hidden p-10 text-center">
                        <h3 class="text-3xl font-black text-slate-800 italic tracking-tighter mb-2">Business Insights
                        </h3>
                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.3em] mb-10">Select report
                            durationto download</p>

                        <div class="grid grid-cols-1 gap-4">
                            <a href="{{ route('reports.download', 'weekly') }}"
                                class="group flex items-center justify-between p-6 bg-slate-50 rounded-[2rem] border border-slate-100 hover:bg-blue-600 transition-all duration-300">
                                <div class="text-left">
                                    <p class="font-black text-slate-800 group-hover:text-white text-lg leading-none">
                                        Weekly Report</p>
                                    <p
                                        class="text-[10px] text-slate-400 group-hover:text-blue-200 font-bold uppercase mt-2">
                                        Last 7 Days Sales</p>
                                </div>
                                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                    </svg>
                                </div>
                            </a>

                            <a href="{{ route('reports.download', 'monthly') }}"
                                class="group flex items-center justify-between p-6 bg-slate-50 rounded-[2rem] border border-slate-100 hover:bg-emerald-600 transition-all duration-300">
                                <div class="text-left">
                                    <p class="font-black text-slate-800 group-hover:text-white text-lg leading-none">
                                        Monthly Report</p>
                                    <p
                                        class="text-[10px] text-slate-400 group-hover:text-emerald-100 font-bold uppercase mt-2">
                                        Full Month Analytics</p>
                                </div>
                                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                    </svg>
                                </div>
                            </a>
                        </div>

                        <button @click="showReportModal = false"
                            class="mt-8 text-slate-400 font-black text-[10px] uppercase tracking-widest hover:text-slate-900 transition-colors">Close</button>
                    </div>
                </div>
            </div>
        </div>




        {{-- Pure section ko is div mein wrap karein --}}
        {{-- 1. Main Wrapper with Alpine State --}}
        <div x-data="{ showLowStock: false, showTopSelling: false, showExpiryAlert: false }">

            {{-- 2. Grid Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-12">

                <div
                    class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm relative overflow-hidden group h-48 flex flex-col justify-between">
                    <div class="relative z-10">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Net
                            Revenue</span>
                        <h2 class="text-3xl font-black text-slate-900 mt-2 tracking-tighter">Rs.
                            {{ number_format($totalRevenue, 0) }}
                        </h2>
                    </div>
                </div>

                <div
                    class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm relative overflow-hidden group h-48 flex flex-col justify-between">
                    <div class="relative z-10">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Sales
                            Volume</span>
                        <h2 class="text-3xl font-black text-slate-900 mt-2 tracking-tighter">{{ $receiptsCount }} <span
                                class="text-lg text-slate-400 font-medium">Bills</span></h2>
                    </div>
                </div>

                <div @click="showLowStock = true"
                    class="bg-emerald-600 p-8 rounded-[2.5rem] shadow-xl shadow-emerald-100 relative overflow-hidden group cursor-pointer hover:bg-emerald-700 transition-all h-48 flex flex-col justify-between">
                    <div class="relative z-10 text-left">
                        <span class="text-[10px] font-black text-emerald-100 uppercase tracking-[0.2em]">Stock
                            Status</span>
                        <h2 class="text-3xl font-black text-white mt-2 tracking-tighter">
                            {{ $lowStockCount }} <span
                                class="text-lg opacity-60 font-medium tracking-normal">Alerts</span>
                        </h2>
                        <p class="text-[10px] text-emerald-200 font-bold mt-2 underline italic">View details →</p>
                    </div>
                </div>

                <div @click="showTopSelling = true"
                    class="bg-blue-600 p-8 rounded-[2.5rem] shadow-xl shadow-blue-100 relative overflow-hidden group cursor-pointer hover:bg-blue-700 transition-all h-48 flex flex-col justify-between">
                    <div class="relative z-10 text-left">
                        <span class="text-[10px] font-black text-blue-100 uppercase tracking-[0.2em]">Top Selling</span>
                        <h2 class="text-3xl font-black text-white mt-2 tracking-tighter">Analytics</h2>
                        <p class="text-[10px] text-blue-200 font-bold mt-2 underline italic">View best sellers →</p>
                    </div>
                </div>

                <div @click="showExpiryAlert = true"
                    class="bg-orange-500 p-8 rounded-[2.5rem] shadow-xl shadow-orange-100 relative overflow-hidden group cursor-pointer hover:bg-orange-600 transition-all h-48 flex flex-col justify-between">
                    <div class="relative z-10 text-left">
                        <span class="text-[10px] font-black text-orange-100 uppercase tracking-[0.2em]">Expiry</span>
                        <h2 class="text-3xl font-black text-white mt-2 tracking-tighter">
                            {{ $nearExpiryCount }} <span
                                class="text-lg opacity-60 font-medium tracking-normal">Items</span>
                        </h2>
                        <p class="text-[10px] text-orange-100 font-bold mt-2 underline italic">Check dates →</p>
                    </div>
                </div>
            </div>

            {{-- 3. Modals Section (Outside Grid, Inside x-data) --}}

            <div x-show="showLowStock" x-cloak
                class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
                <div @click.away="showLowStock = false"
                    class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl overflow-hidden text-left">
                    <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-emerald-50/50">
                        <h3 class="text-xl font-black text-emerald-800 italic">Inventory Alerts</h3>
                        <button @click="showLowStock = false"
                            class="text-emerald-400 hover:text-emerald-600 text-3xl font-light">&times;</button>
                    </div>
                    <div class="p-8 max-h-[450px] overflow-y-auto">
                        @foreach($lowStockMedicines as $product)
                            <div
                                class="flex items-center justify-between p-4 mb-3 bg-slate-50 rounded-2xl border border-emerald-100">
                                <div>
                                    <p class="font-bold text-slate-800">{{ $product->name }}</p>
                                    <p class="text-xs text-red-500 font-bold italic">Stock Left: {{ $product->stock }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div x-show="showTopSelling" x-cloak
                class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
                <div @click.away="showTopSelling = false"
                    class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl overflow-hidden text-left">
                    <div class="p-8 border-b border-slate-100 flex justify-between items-center">
                        <h3 class="text-xl font-black text-slate-800 italic">Top Sellers</h3>
                        <button @click="showTopSelling = false"
                            class="text-slate-400 hover:text-slate-600 text-3xl font-light">&times;</button>
                    </div>
                    <div class="p-8 max-h-[450px] overflow-y-auto">
                        @foreach($topSelling as $item)
                            <div
                                class="flex items-center justify-between p-4 mb-3 bg-slate-50 rounded-2xl border border-slate-100">
                                <div>
                                    <p class="font-bold text-slate-800">{{ $item->product->name }}</p>
                                    <p class="text-xs text-slate-500 font-medium italic">Sold: {{ $item->total_sold }} units
                                    </p>
                                </div>
                                <span
                                    class="bg-blue-100 text-blue-700 text-[10px] font-black px-3 py-1 rounded-full uppercase">#{{ $loop->iteration }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div x-show="showExpiryAlert" x-cloak
                class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
                <div @click.away="showExpiryAlert = false"
                    class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl overflow-hidden text-left">
                    <div class="p-8 border-b border-orange-100 flex justify-between items-center bg-orange-50/50">
                        <h3 class="text-xl font-black text-orange-800 italic">Expiry Alerts</h3>
                        <button @click="showExpiryAlert = false"
                            class="text-orange-400 hover:text-orange-600 text-3xl font-light">&times;</button>
                    </div>
                    <div class="p-8 max-h-[450px] overflow-y-auto">
                        @forelse($nearExpiry as $product)
                            <div
                                class="flex items-center justify-between p-4 mb-3 bg-white rounded-2xl border border-orange-100 shadow-sm">
                                <div>
                                    <p class="font-bold text-slate-800">{{ $product->name }}</p>
                                    <p
                                        class="text-xs font-bold {{ $product->expiry_date->isPast() ? 'text-red-500' : 'text-orange-500' }}">
                                        {{ $product->expiry_date->isPast() ? 'Expired:' : 'Expires:' }}
                                        {{ $product->expiry_date->format('d M, Y') }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span
                                        class="text-[10px] font-black text-slate-400 uppercase block leading-none">Stock</span>
                                    <span class="font-bold text-slate-700">{{ $product->stock }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <div class="text-4xl mb-2">✅</div>
                                <p class="text-slate-500 font-medium text-sm">No items near expiry.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div> {{-- Main Wrapper End --}}


        <div class="relative mb-8 group">
            <input type="text" x-model="search" placeholder="Quick search: Type Receipt ID, Name or Phone..."
                class="w-full bg-white border-2 border-slate-100 rounded-3xl py-5 pl-14 pr-6 text-sm font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 transition-all shadow-sm">
            <svg class="w-6 h-6 absolute left-5 top-5 text-slate-300 group-focus-within:text-emerald-500 transition-colors"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>

        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="p-8 text-[11px] font-black text-slate-400 uppercase tracking-[0.1em]">Transaction
                            </th>
                            <th class="p-8 text-[11px] font-black text-slate-400 uppercase tracking-[0.1em]">Customer
                            </th>
                            <th class="p-8 text-[11px] font-black text-slate-400 uppercase tracking-[0.1em] text-right">
                                Amount</th>
                            <th
                                class="p-8 text-[11px] font-black text-slate-400 uppercase tracking-[0.1em] text-center">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($receipts as $receipt)
                            <tr x-show="'{{ $receipt->receipt_handle }} {{ optional($receipt->customer)->name }} {{ optional($receipt->customer)->phone }}'.toLowerCase().includes(search.toLowerCase())"
                                class="hover:bg-slate-50/50 transition-all">
                                <td class="p-8">
                                    <span
                                        class="text-sm font-extrabold text-slate-800 tracking-tight">#{{ $receipt->receipt_handle }}</span>
                                    <div class="text-[10px] text-slate-400 font-bold mt-1">
                                        {{ $receipt->created_at->format('M d, Y • h:i A') }}
                                    </div>
                                </td>
                                <td class="p-8">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-bold text-slate-700">{{ $receipt->customer->name ?? 'Walk-in' }}</span>
                                        <span
                                            class="text-[10px] font-black text-emerald-600">{{ $receipt->customer->phone ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="p-8 text-right font-black text-slate-900 text-sm">
                                    Rs. {{ number_format($receipt->total_amount, 2) }}
                                </td>
                                <td class="p-8 text-center">
                                    <a href="{{ route('receipt.public.view', $receipt->receipt_handle) }}" target="_blank"
                                        class="inline-flex items-center text-emerald-600 font-black text-[11px] uppercase tracking-widest hover:text-emerald-800">
                                        Open Bill →
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"
                                    class="p-20 text-center text-slate-300 font-bold uppercase tracking-widest italic text-xs">
                                    No records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div x-show="showLowStock" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-slate-900/80 backdrop-blur-sm" x-cloak>

        <div @click.away="showLowStock = false"
            class="bg-white rounded-[3rem] w-full max-w-2xl overflow-hidden shadow-2xl">
            <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                <div>
                    <h3 class="text-2xl font-black text-slate-900 italic">Inventory <span
                            class="text-red-500">Alerts</span></h3>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Medicines below threshold (10
                        units)</p>
                </div>
                <button @click="showLowStock = false" class="text-slate-400 hover:text-red-500 transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-8 max-h-[400px] overflow-y-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            <th class="pb-4">Medicine Name</th>
                            <th class="pb-4 text-center">Current Stock</th>
                            <th class="pb-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($products->where('stock', '<=', 10) as $lowItem)
                            <tr>
                                <td class="py-4 font-bold text-slate-800">{{ $lowItem->name }}</td>
                                <td class="py-4 text-center">
                                    <span class="px-3 py-1 bg-red-50 text-red-600 rounded-full font-black text-xs">
                                        {{ $lowItem->stock }} Left
                                    </span>
                                </td>
                                <td class="py-4 text-right">
                                    <a href="#"
                                        class="text-emerald-600 font-black text-[10px] uppercase tracking-widest hover:underline">Restock
                                        →</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if(session('qrCode'))
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-md flex items-center justify-center z-50 p-6">
            <div
                class="bg-white rounded-[3.5rem] p-12 max-w-sm w-full text-center shadow-2xl shadow-black/20 transform scale-105">
                <div
                    class="w-24 h-24 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h2 class="text-3xl font-black text-slate-900 mb-2 tracking-tight">Success!</h2>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mb-10 italic leading-relaxed">Bill
                    generated. Show this QR to customer.</p>

                <div
                    class="flex justify-center mb-10 p-8 bg-slate-50 rounded-[3rem] border-2 border-dashed border-emerald-100 shadow-inner">
                    {!! session('qrCode') !!}
                </div>

                <button onclick="window.location.reload()"
                    class="w-full py-5 bg-slate-900 text-white rounded-[2rem] font-extrabold text-sm tracking-widest uppercase hover:bg-black transition-all shadow-xl shadow-slate-200">
                    Finish Sale
                </button>
            </div>
        </div>
    @endif

</body>

</html>