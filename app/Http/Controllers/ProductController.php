<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:products',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'expiry_date' => 'required|date'
        ]);

        Product::create($validated);

        return back()->with('success', 'New Medicine Added!');
    }

    public function bulkRestock(Request $request)
    {
        // restock array check: [id => quantity]
        foreach($request->restock as $id => $quantity) {
            if($quantity > 0) {
                $product = Product::find($id);
                if($product) {
                    $product->increment('stock', $quantity);
                }
            }
        }

        return back()->with('success', 'Inventory Updated!');
    }
}