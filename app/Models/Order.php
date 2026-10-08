<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [

    'user_id',

    'product_id',

    'customer_name',
    'customer_phone',
    'customer_email',

    'quantity',
    'price',
    'total',

    'address',
    'note',

    'payment_method',

    'status'
];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}