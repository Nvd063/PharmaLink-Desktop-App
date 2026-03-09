<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceiptController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Ye route public hoga taake koi bhi baghair login ke bill dekh sakay
Route::get('/view-receipt/{handle}', [ReceiptController::class, 'showPublic'])->name('receipt.public.view');

Route::get('/dashboard', [ReceiptController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Ye missing routes hain, inhein lazmi add karein:
Route::middleware(['auth'])->group(function () {
    // New Sale Form dikhane ke liye
    Route::get('/receipts/create', [ReceiptController::class, 'create'])->name('receipts.create');
    
    // Receipt save karne ke liye
    Route::post('/receipts', [ReceiptController::class, 'store'])->name('receipts.store');
});

// Public View Route (Jo koi bhi scan karke dekh sake)
Route::get('/view-receipt/{handle}', [ReceiptController::class, 'showPublic'])->name('receipt.public.view');