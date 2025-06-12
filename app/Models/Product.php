<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'quantity',
        'warning_level',
        'image',
        'barcode',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function stockUpdates()
    {
        return $this->hasMany(StockUpdate::class);
    }

    public function isLowStock()
    {
        return $this->quantity <= $this->warning_level;
    }
}
