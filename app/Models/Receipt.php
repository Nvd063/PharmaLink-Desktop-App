<?php

namespace App\Models;

use App\Models\ReceiptItem;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = ['user_id', 'customer_id', 'receipt_handle', 'total_amount'];

public function customer() {
    return $this->belongsTo(Customer::class);
}

public function items() {
    return $this->hasMany(ReceiptItem::class);
}

public function user() {
    return $this->belongsTo(User::class);
}
}
