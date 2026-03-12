<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Customers ki list dikhane ke liye
    public function index()
    {
        $customers = Customer::latest()->get();
        return view('customers.index', compact('customers'));
    }

    // Naya customer save karne ka logic (agar zaroorat ho)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable|unique:customers',
        ]);

        Customer::create($request->all());

        return redirect()->back()->with('success', 'Customer added successfully!');
    }
}