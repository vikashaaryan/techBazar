<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

      public function parent()
    {
        return $this->hasOne(Customer::class, "id", "customer_id");
    }
    
}
