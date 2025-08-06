<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeasurementUnit extends Model
{
    protected $table = 'measurement_unit';

    protected $fillable = [
        'name',
        'symbol',
        'base_unit',
        'conversion_factor',
    ];

    public function products(){
        return $this->hasMany(Product::class, 'measurement_unit_id');
    }
}
