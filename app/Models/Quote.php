<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(QuotesItems::class, 'quote_id');
    }
    public static function generateQuotationNumber()
    {
        $datePrefix = 'Q-' . now()->format('Ymd');
        $lastQuote = self::where('quotation_no', 'like', $datePrefix . '%')
            ->orderBy('quotation_no', 'desc')
            ->first();

        if ($lastQuote) {
            $lastIncrement = (int) substr($lastQuote->quotation_no, -3);
            $newIncrement = str_pad($lastIncrement + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newIncrement = '001';
        }

        return $datePrefix . '-' . $newIncrement;
    }
    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }


}
