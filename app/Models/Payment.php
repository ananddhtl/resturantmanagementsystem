<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_code', 'amount', 'payment_method', 'product_code', 'order_id', 'payment_status'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
