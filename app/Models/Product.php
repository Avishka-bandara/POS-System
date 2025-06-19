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
        'category_id' 
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
