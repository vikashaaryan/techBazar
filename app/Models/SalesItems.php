<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesItems extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->hasOne(Product::class, 'product_id', 'id');
    }
    // In SalesItems.php model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
