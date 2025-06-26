<?php

namespace App\Livewire;

use App\Models\Quote;
use App\Models\Sales;
use Livewire\Component;

class ShowQuotation extends Component
{
    public $selectedQuote;
    public $showModal = false;
    public function closeModal()
    {
        $this->showModal = false;
        $this->reset('selectedQuote');
    }
    public function viewQuotation($quoteId)
    {
        $this->selectedQuote = Quote::with('customer')->findOrFail($quoteId);
        $this->showModal = true;
    }
    public function editQuotation($quotationId)
    {
        return redirect()->route('editQuotation', ['quotation' => $quotationId]);
    }
    public function render()
    {
        $quotations = Quote::all();
        return view('livewire.quotation.show-quotation', compact('quotations'));
    }
}
