<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExchangeReturn extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'serial_no',
        'type',
        'return_type',
        'invoice_id',
        'sale_id',
        'purchase_id',
        'total_quantity',
        'total_refund_amount',
        'total_tax_refund',
        'reasons',
        'status',
        'processed_by',
        'customer_id',
        'supplier_id',
        'notes',
        'return_date',
        'processed_at',
        'refund_method'
    ];

    protected $casts = [
        'return_date' => 'date',
        'processed_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(ExchangeReturnItem::class);
    }
    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id');
    }

    // Supplier relationship (for purchase returns)
    public function supplier()
    {
        return $this->belongsTo(\App\Models\Supplier::class, 'supplier_id');
    }
    public function sale()
    {
        return $this->belongsTo(Sales::class);
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    public function processor()
    {
        // Example if processor is a User model
        return $this->belongsTo(User::class, 'processed_by');

        // Or if it's a different relationship type, adjust accordingly
    }

}
