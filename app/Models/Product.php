<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'expiry_date', 'stock', 'min_stock_level'];

    protected $casts = [
        'expiry_date' => 'date',
    ];
}
