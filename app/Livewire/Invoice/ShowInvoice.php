<?php

namespace App\Livewire\Invoice;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowInvoice extends Component
{
    public function render()
    {
        // Find the invoice with relationships loaded
        $invoices = Invoice::whereIn('id', function ($query) {
            $query->select(DB::raw('MAX(id)'))
                ->from('invoices')
                ->groupBy('customer_id');
        })->get();
            ;
        return view('livewire.invoice.show-invoice', compact('invoices'));
    }
}
