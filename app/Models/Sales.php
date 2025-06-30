<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'id', 'invoice_id');
    }

    public function items()
    {
        return $this->hasMany(SalesItems::class, 'sale_id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class , 'sale_id');
    }

}
