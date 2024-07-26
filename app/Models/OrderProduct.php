<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
