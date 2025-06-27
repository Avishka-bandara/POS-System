<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Sales extends Model
{
    protected $table = 'sales';
    protected $fillable = [
        'grand_total',
    ];

    public function scopeFiltered(Builder $query, $filters)
    {
        if (!empty($filters['date_range'])) {
            $dates = explode(' - ', $filters['date_range']);
            if (count($dates) == 2) {
                $start = Carbon::parse($dates[0])->startOfDay();
                $end = Carbon::parse($dates[1])->endOfDay();
                $query->whereBetween('created_at', [$start, $end]);
            }
        }

        if (!empty($filters['month'])) {
            $query->whereMonth('created_at', $filters['month']);
        }

        if (!empty($filters['year'])) {
            $query->whereYear('created_at', $filters['year']);
        }

        if (!empty($filters['product'])) {
            $query->where('product_id', $filters['product']);
        }

        return $query;
    }
}
