<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockAdjustment extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'type',
        'quantity',
        'reason',
        'previous_stock',
        'current_stock',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
