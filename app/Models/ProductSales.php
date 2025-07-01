<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSales extends Model
{
    use HasFactory;
    
    protected $table = 'product_sales';
    protected $fillable = [
        'product_id',
        'sale_id',
        'sale_quantity', 
        'sale_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function sale()
    {
        return $this->belongsTo(Sales::class, 'sale_id');
    }
}
