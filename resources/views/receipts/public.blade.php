<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Receipt - #{{ $receipt->receipt_handle }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-gray-100 antialiased p-4 md:p-8">

    <div class="max-w-md mx-auto bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-gray-100">

        <div class="bg-emerald-600 p-8 text-center text-white relative">
            <div class="absolute top-0 left-0 w-full h-2 bg-emerald-700 opacity-20"></div>
            <div
                class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-4 backdrop-blur-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="text-2xl font-black tracking-tight">PHARMA LINK</h1>
            <p class="text-emerald-100 text-xs font-bold uppercase tracking-widest mt-1">Digital Receipt</p>
        </div>

        <div class="p-8">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Receipt ID</p>
                    <h3 class="font-black text-gray-800 text-lg">#{{ $receipt->receipt_handle }}</h3>
                </div>

                <div class="text-right">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Date</p>
                    <p class="text-sm font-bold text-gray-700">{{ $receipt->created_at->format('d M, Y') }}</p>
                </div>
            </div>
            <div class="customer-info">
                <p><strong>Customer:</strong> {{ $receipt->customer->name ?? 'Walk-in' }}</p>
                <p><strong>Phone:</strong> {{ $receipt->customer->phone ?? 'N/A' }}</p>
            </div>
            <br>
            <div class="space-y-4 mb-8">
                <p
                    class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 border-b border-gray-50 pb-2">
                    Purchase Details</p>

                @foreach($receipt->items as $item)
                    <div class="flex justify-between items-center">
                        <div>
                            <h4 class="text-sm font-extrabold text-gray-800">{{ $item->product->name }}</h4>
                            <p class="text-[11px] text-gray-400 font-medium">{{ $item->quantity }} x Rs.
                                {{ number_format($item->price_at_time, 2) }}</p>
                        </div>
                        <p class="text-sm font-black text-gray-700">Rs.
                            {{ number_format($item->quantity * $item->price_at_time, 2) }}</p>
                    </div>
                @endforeach
            </div>

            <div class="bg-gray-50 rounded-3xl p-6 border border-gray-100">
                <div class="flex justify-between items-center">
                    <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Amount Paid</span>
                    <span class="text-2xl font-black text-emerald-600">Rs.
                        {{ number_format($receipt->total_amount, 2) }}</span>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-dashed border-gray-200 text-center">
                <div class="inline-block p-3 bg-gray-50 rounded-2xl mb-4">
                    {!! QrCode::size(80)->generate(Request::url()) !!}
                </div>
                <p class="text-[11px] text-gray-400 font-bold px-6 leading-relaxed">
                    This is a computer-generated digital receipt. No signature required. 🌿 Go Paperless!
                </p>
            </div>

        </div>

        <div class="p-6 bg-gray-50 flex gap-3 no-print">
            <button onclick="window.print()"
                class="flex-1 py-4 bg-gray-800 text-white rounded-2xl font-bold text-sm shadow-xl hover:bg-black transition">
                Download PDF
            </button>
            <a href="https://wa.me/?text=My Pharmacy Receipt: {{ Request::url() }}"
                class="flex-1 py-4 bg-emerald-600 text-white rounded-2xl font-bold text-sm text-center shadow-xl hover:bg-emerald-700 transition">
                Share on WhatsApp
            </a>
        </div>
    </div>

    <p class="text-center mt-8 text-gray-400 text-[10px] font-bold uppercase tracking-widest">
        Powered by PharmaLink Digital
    </p>

</body>

</html>