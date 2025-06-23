<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    protected $table = 'Product_brand';
    protected $fillable = ['brand_name'];

    public function productBrand(){
        return $this->hasMany(Product::class, 'brand_id');
    }

}
