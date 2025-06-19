<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function parent()
    {
        return $this->hasOne(Category::class, "id", "category");
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    // Add this to calculate total purchases amount
    public function getTotalPurchasesAttribute()
    {
        return $this->purchases()->sum('amount');
    }
}
