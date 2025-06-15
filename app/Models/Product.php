<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function parent()
    {
        return $this->hasOne(Product::class, "id", "category");
    }
}
