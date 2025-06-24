<?php

namespace App\Livewire\Invoice;

use App\Models\Invoice;
use Livewire\Component;

class ShowInvoice extends Component
{
    public function render()
    {
        // Find the invoice with relationships loaded
        $invoices = Invoice::all();
        return view('livewire.invoice.show-invoice', compact('invoices'));
    }
}
