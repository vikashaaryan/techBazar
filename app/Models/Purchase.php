<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'invoice_number',
        'amount',
        'amount_paid',
        'payment_status',
        'attachment',
        'notes',
        'purchase_date'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'purchase_date' => 'date',
    ];

    /**
     * Get the supplier associated with the purchase.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Get the items for the purchase.
     */
    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    /**
     * Calculate the remaining balance.
     */
    public function getBalanceAttribute()
    {
        return $this->amount - $this->amount_paid;
    }

    /**
     * Scope a query to only include paid purchases.
     */
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    /**
     * Scope a query to only include due purchases.
     */
    public function scopeDue($query)
    {
        return $query->where('payment_status', 'due');
    }

    /**
     * Scope a query to only include partial payments.
     */
    public function scopePartial($query)
    {
        return $query->where('payment_status', 'partial');
    }
    // In app/Models/Purchase.php
    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}
