<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
        protected $fillable = [

    'productname',

    'category_id',

    'supplier_id',

    'product_image',

    'purchase_price',

    'selling_price',

    'stock',

    'status'

];
    

 public function category()
{
    return $this->belongsTo(Category::class);
}

public function supplier()
{
    return $this->belongsTo(Supplier::class);
}

public function stockIns()
{
    return $this->hasMany(StockIn::class);
}

public function orders()
{
    return $this->hasMany(Order::class);
}

public function stockOuts()
{
    return $this->hasMany(StockOutA::class);
}
}

