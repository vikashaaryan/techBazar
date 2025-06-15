<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = [];
    
    public function parent()
    {
        return $this->hasOne(Address::class, "id", "parent_cat");
    }
}
