<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        // Assuming polymorphic relationship
        return $this->morphOne(Address::class, 'addressable');
        // OR if using direct foreign key:
        // return $this->belongsTo(Address::class);
    }
}
