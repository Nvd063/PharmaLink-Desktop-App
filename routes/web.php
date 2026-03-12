<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';


// // Ye route public hoga taake koi bhi baghair login ke bill dekh sakay
// Route::get('/view-receipt/{handle}', [ReceiptController::class, 'showPublic'])->name('receipt.public.view');

// Route::get('/dashboard', [ReceiptController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// // Ye missing routes hain, inhein lazmi add karein:
// Route::middleware(['auth'])->group(function () {
//     // New Sale Form dikhane ke liye
//     Route::get('/receipts/create', [ReceiptController::class, 'create'])->name('receipts.create');
    
//     // Receipt save karne ke liye
//     Route::post('/receipts', [ReceiptController::class, 'store'])->name('receipts.store');
// });

// // Public View Route (Jo koi bhi scan karke dekh sake)
// Route::get('/view-receipt/{handle}', [ReceiptController::class, 'showPublic'])->name('receipt.public.view');

// Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
// Route::post('/products/bulk-restock', [ProductController::class, 'bulkRestock'])->name('products.bulk-restock');


// Route::get('/reports/download/{type}', [ReportController::class, 'downloadReport'])->name('reports.download');



// 

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/dashboard', [ReceiptController::class, 'index'])->name('dashboard');

    // --- Customers Routes (Jo missing tha) ---
Route::get('/customers', function() { return "Coming Soon"; })->name('customers.index');
    // Agar customers add/edit karne hain to ye bhi chahiye honge:
    // Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    // Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');

    // --- Products Routes ---
    Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // Missing index
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::post('/products/bulk-restock', [ProductController::class, 'bulkRestock'])->name('products.bulk-restock');

    // --- Receipts Routes ---
    Route::get('/receipts/create', [ReceiptController::class, 'create'])->name('receipts.create');
    Route::post('/receipts', [ReceiptController::class, 'store'])->name('receipts.store');

    // --- Reports Routes ---
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index'); // Missing index
    Route::get('/reports/download/{type}', [ReportController::class, 'downloadReport'])->name('reports.download');
});

// Public Routes (Baghair login ke)
Route::get('/view-receipt/{handle}', [ReceiptController::class, 'showPublic'])->name('receipt.public.view');

require __DIR__.'/auth.php';