<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeReturnItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'exchange_return_id',
        'product_id',
        'product_name',
        'original_price',
        'quantity',
        'refund_amount',
        'reason',
        'condition',
        'replacement_product_id',
        'replacement_product_name',
        'replacement_price_diff'
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function replacementProduct()
    {
        return $this->belongsTo(Product::class, 'replacement_product_id');
    }

    public function exchangeReturn()
    {
        return $this->belongsTo(ExchangeReturn::class);
    }
}
