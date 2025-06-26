<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $guarded =  [];
    // In app/Models/Invoice.php
    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
 
    // In Invoice.php model
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function items()
    {
        return $this->hasMany(Sales::class);
    }
    
    public function quotation()
{
    return $this->belongsTo(Quote::class, 'quotation_id');
}
    public function sales(): HasMany
    {
        return $this->hasMany(Sales::class);
    }
    public function sale()
    {
        return $this->hasOne(Sales::class, 'invoice_id', 'id');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class, 'invoice_id', 'id');
    }
    public function salesItems()
    {
        return $this->hasMany(SalesItems::class, 'invoice_id', 'id');
    }
    
}
