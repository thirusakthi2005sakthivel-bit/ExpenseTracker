<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockOutA extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'reason',
        'stock_out_date'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}