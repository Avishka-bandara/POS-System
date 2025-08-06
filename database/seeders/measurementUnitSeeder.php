<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MeasurementUnit;

class measurementUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MeasurementUnit::create([
            'name' => 'Kilogram',
            'symbol' => 'kg',
            'base_unit' => 'g',
            'conversion_factor' => 1000,

        ]);
        MeasurementUnit::create([
            'name' => 'Gram',
            'symbol' => 'g',
            'base_unit' => 'g',
            'conversion_factor' => 1,
        ]);
        MeasurementUnit::create([
            'name' => 'Miligram',
            'symbol' => 'mg',
            'base_unit' => 'g',
            'conversion_factor' => 0.001,
        ]);
        MeasurementUnit::create([
            'name' => 'Liter',
            'symbol' => 'L',
            'base_unit' => 'L',
            'conversion_factor' => 1,
        ]);
        MeasurementUnit::create([
            'name' => 'Milliliter',
            'symbol' => 'mL',
            'base_unit' => 'L',
            'conversion_factor' => 0.001,
        ]);
        MeasurementUnit::create([
            'name' => 'Piece',
            'symbol' => 'pcs',
            'base_unit' => 'pcs',
            'conversion_factor' => 1,
        ]);
        
    }
}
