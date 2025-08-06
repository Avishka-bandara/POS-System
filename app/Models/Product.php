<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    
    protected $table = 'products';
    protected $fillable = [
        'name',
        'size',
        'brand',
        'price',
        'category',
        'quantity',
        'exp_date',
        'category_id',
        'action',
        'measurement_unit_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand(){
        return $this->belongsTo(ProductBrand::class, 'brand_id');
    }

    public function sales()
    {
        return $this->hasMany(ProductSales::class, 'product_id');
    }
    public function measurementUnit()
    {
        return $this->belongsTo(MeasurementUnit::class, 'measurement_unit_id');
    }
}
