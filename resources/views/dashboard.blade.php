<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaLink | Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body x-data="{ search: '', showLowStock: false }">

    <nav class="glass sticky top-0 z-40 border-b border-slate-200/60 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                </div>
                <span class="text-xl font-extrabold text-slate-900 tracking-tight">Pharma<span class="text-emerald-600">Link</span></span>
            </div>
            <div class="flex items-center gap-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-xs font-bold text-slate-400 hover:text-red-500 transition uppercase tracking-widest">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-10">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
            <div>
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-2">Inventory <span class="text-emerald-600">&</span> Sales</h1>
                <p class="text-slate-500 font-medium italic">Monitoring your pharmacy's performance in real-time.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('receipts.create') }}" class="px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold shadow-2xl shadow-slate-300 hover:bg-black transition-all transform hover:-translate-y-1 active:translate-y-0">
                    + Create New Sale
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm relative overflow-hidden group">
                <div class="relative z-10">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Net Revenue</span>
                    <h2 class="text-4xl font-black text-slate-900 mt-2 tracking-tighter">Rs. {{ number_format($totalRevenue, 0) }}</h2>
                </div>
                <div class="absolute -right-4 -bottom-4 opacity-[0.03] group-hover:scale-110 transition-transform duration-700">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/></svg>
                </div>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm relative overflow-hidden group">
                <div class="relative z-10">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Sales Volume</span>
                    <h2 class="text-4xl font-black text-slate-900 mt-2 tracking-tighter">{{ $receiptsCount }} <span class="text-lg text-slate-400">Bills</span></h2>
                </div>
            </div>

            <div @click="showLowStock = true" class="bg-emerald-600 p-8 rounded-[2.5rem] shadow-xl shadow-emerald-100 relative overflow-hidden group cursor-pointer hover:bg-emerald-700 transition-all">
                <div class="relative z-10">
                    <span class="text-[10px] font-black text-emerald-100 uppercase tracking-[0.2em]">Stock Status</span>
                    <h2 class="text-4xl font-black text-white mt-2 tracking-tighter">
                        {{ $lowStockCount }} <span class="text-lg opacity-60 font-medium tracking-normal">Alerts</span>
                    </h2>
                    <p class="text-[10px] text-emerald-200 font-bold mt-2 underline">Click to view details →</p>
                </div>
            </div>
        </div>

        <div class="relative mb-8 group">
            <input type="text" x-model="search" placeholder="Quick search: Type Receipt ID, Name or Phone..." 
                    class="w-full bg-white border-2 border-slate-100 rounded-3xl py-5 pl-14 pr-6 text-sm font-bold text-slate-700 focus:border-emerald-500 focus:ring-0 transition-all shadow-sm">
            <svg class="w-6 h-6 absolute left-5 top-5 text-slate-300 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>

        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="p-8 text-[11px] font-black text-slate-400 uppercase tracking-[0.1em]">Transaction</th>
                            <th class="p-8 text-[11px] font-black text-slate-400 uppercase tracking-[0.1em]">Customer</th>
                            <th class="p-8 text-[11px] font-black text-slate-400 uppercase tracking-[0.1em] text-right">Amount</th>
                            <th class="p-8 text-[11px] font-black text-slate-400 uppercase tracking-[0.1em] text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($receipts as $receipt)
                        <tr x-show="'{{ $receipt->receipt_handle }} {{ optional($receipt->customer)->name }} {{ optional($receipt->customer)->phone }}'.toLowerCase().includes(search.toLowerCase())" 
                            class="hover:bg-slate-50/50 transition-all">
                            <td class="p-8">
                                <span class="text-sm font-extrabold text-slate-800 tracking-tight">#{{ $receipt->receipt_handle }}</span>
                                <div class="text-[10px] text-slate-400 font-bold mt-1">{{ $receipt->created_at->format('M d, Y • h:i A') }}</div>
                            </td>
                            <td class="p-8">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-slate-700">{{ $receipt->customer->name ?? 'Walk-in' }}</span>
                                    <span class="text-[10px] font-black text-emerald-600">{{ $receipt->customer->phone ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td class="p-8 text-right font-black text-slate-900 text-sm">
                                Rs. {{ number_format($receipt->total_amount, 2) }}
                            </td>
                            <td class="p-8 text-center">
                                <a href="{{ route('receipt.public.view', $receipt->receipt_handle) }}" target="_blank" class="inline-flex items-center text-emerald-600 font-black text-[11px] uppercase tracking-widest hover:text-emerald-800">
                                    Open Bill →
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="p-20 text-center text-slate-300 font-bold uppercase tracking-widest italic text-xs">No records found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div x-show="showLowStock" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-slate-900/80 backdrop-blur-sm" x-cloak>
        
        <div @click.away="showLowStock = false" class="bg-white rounded-[3rem] w-full max-w-2xl overflow-hidden shadow-2xl">
            <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                <div>
                    <h3 class="text-2xl font-black text-slate-900 italic">Inventory <span class="text-red-500">Alerts</span></h3>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Medicines below threshold (10 units)</p>
                </div>
                <button @click="showLowStock = false" class="text-slate-400 hover:text-red-500 transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
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
                                <a href="#" class="text-emerald-600 font-black text-[10px] uppercase tracking-widest hover:underline">Restock →</a>
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
        <div class="bg-white rounded-[3.5rem] p-12 max-w-sm w-full text-center shadow-2xl shadow-black/20 transform scale-105">
            <div class="w-24 h-24 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-8">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
            </div>
            <h2 class="text-3xl font-black text-slate-900 mb-2 tracking-tight">Success!</h2>
            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mb-10 italic leading-relaxed">Bill generated. Show this QR to customer.</p>
            
            <div class="flex justify-center mb-10 p-8 bg-slate-50 rounded-[3rem] border-2 border-dashed border-emerald-100 shadow-inner">
                {!! session('qrCode') !!}
            </div>

            <button onclick="window.location.reload()" class="w-full py-5 bg-slate-900 text-white rounded-[2rem] font-extrabold text-sm tracking-widest uppercase hover:bg-black transition-all shadow-xl shadow-slate-200">
                Finish Sale
            </button>
        </div>
    </div>
    @endif

</body>
</html>