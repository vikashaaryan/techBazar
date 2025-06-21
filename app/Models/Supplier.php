<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $guarded = [];
    public function address()
    {
        return $this->hasOne(Address::class, "id", "address_id");
    }
}
