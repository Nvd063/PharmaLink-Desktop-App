<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\ReceiptItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReceiptController extends Controller
{

    // ReceiptController.php mein index function
    public function index()
    {
        // Saari receipts lein dashboard ke liye
        $receipts = Receipt::with('customer')->orderBy('created_at', 'desc')->get();

        // Total calculation
        $totalRevenue = Receipt::sum('total_amount');
        $receiptsCount = Receipt::count();

        // 1. SAARI PRODUCTS KO GET KAREIN (Taki modal mein list dikha sakein)
        $products = Product::all();

        // 2. Sirf low stock wali medicines (Stock <= 10)
        $lowStockMedicines = Product::where('stock', '<=', 10)
            ->orderBy('stock', 'asc') // Sab se kam wali upar aayein
            ->get();

        // 3. Count (Wahi purana)
        $lowStockCount = $lowStockMedicines->count();

        $topSelling = ReceiptItem::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->with('product') // Product ka naam lene ke liye
            ->groupBy('product_id')
            ->orderBy('total_sold', 'desc')
            ->take(5) // Sirf top 5 dikhayein
            ->get();


        // near to Expire products
        $nearExpiry = Product::where('expiry_date', '<=', now()->addDays(30))
            ->where('expiry_date', '>', now())->orderBy('expiry_date', 'asc') // Jo expire ho chuki hain unhein chor kar
            ->get();

        $nearExpiryCount = $nearExpiry->count();

        // 3. Sab data view ko pass karein
        return view('dashboard', compact(
            'receipts',
            'topSelling',
            'totalRevenue',
            'receiptsCount',
            'products',     // Yeh miss ho raha tha
            'lowStockCount',
            'nearExpiryCount',
            'nearExpiry',
            'lowStockMedicines'
        ));
    }

    public function create()
    {
        $products = Product::where('stock', '>', 0)->orderBy('name')->get();
        return view('receipts.create', compact('products'));
    }
    public function store(Request $request)
    {
        // 1. Items check karein
        if (!$request->has('items')) {
            return back()->with('error', 'Cart khali hai!');
        }

        $totalAmount = 0;
        $itemsData = [];

        // 2. Loop chala kar calculation aur stock update karein
        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);

            if ($product) {
                $itemTotal = $product->price * $item['quantity'];
                $totalAmount += $itemTotal;

                // YAHAN FIX HAI: 'price' ki jagah 'price_at_time' use kiya hai
                $itemsData[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price_at_time' => $product->price, // Database column match kar diya
                ];

                // Stock decrement
                $product->decrement('stock', $item['quantity']);
            }
        }

        // 3. Customer handle karein
        $phone = $request->customer_phone;
        if ($phone) {
            $customer = Customer::updateOrCreate(
                ['phone' => $phone],
                [
                    'name' => $request->customer_name ?? 'Walk-in Customer',
                    'email' => $request->customer_email
                ]
            );
        } else {
            $customer = Customer::firstOrCreate(
                ['phone' => '0000000000'],
                ['name' => 'Walk-in Customer']
            );
        }

        // 4. Receipt create karein
        $receipt = Receipt::create([
            'customer_id' => $customer->id,
            'total_amount' => $totalAmount,
            'receipt_handle' => strtoupper(uniqid('REC-')),
            'user_id' => auth()->id(),
        ]);

        if ($customer && $customer->email) {
            dispatch(new \App\Jobs\SendReceiptEmail($receipt));
        }

        // 5. Receipt items save karein
        foreach ($itemsData as $item) {
            // Relation ke through save karein
            $receipt->items()->create($item);
        }

        // 6. QR Code generate karein (Ensure SimpleSoftwareIO\QrCode is imported)
        $qrUrl = route('receipt.public.view', $receipt->receipt_handle);
        $qrCode = QrCode::size(200)->generate($qrUrl);

        return redirect()->route('dashboard')->with([
            'success' => 'Sale completed successfully!',
            'qrCode' => $qrCode
        ]);
    }

    public function showPublic($handle)
    {
        // Eager load items and products to avoid N+1 queries
        $receipt = Receipt::with('items.product')->where('receipt_handle', $handle)->firstOrFail();

        return view('receipts.public', compact('receipt'));
    }
}