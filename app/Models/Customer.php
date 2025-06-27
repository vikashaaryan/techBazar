<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];
    public function address()
    {
        return $this->belongsTo(Address::class, "address_id");
    }

    public function sales()
    {
        return $this->hasMany(Sales::class); // or Invoice::class
    }
    public function CustomerAddress()
    {
        return $this->belongsTo(Address::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quote::class);
    }


}
