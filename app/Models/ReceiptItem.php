<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiptItem extends Model
{
    protected $fillable = ['receipt_id', 'product_id', 'quantity', 'price_at_time'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
