<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesItems extends Model
{
    protected $guarded = [];

    
    // In SalesItems.php model
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

     public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function sale()
    {
        return $this->belongsTo(Sales::class, 'sale_id');
    }
}
