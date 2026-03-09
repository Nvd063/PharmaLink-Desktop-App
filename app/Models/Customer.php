<?php

namespace App\Models;

use App\Models\Receipt;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['phone', 'email', 'name'];

public function receipts() {
    return $this->hasMany(Receipt::class);
}
}
