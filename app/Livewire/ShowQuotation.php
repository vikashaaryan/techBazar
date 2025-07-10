<?php

namespace App\Livewire;

use App\Models\Quote;
use App\Models\Sales;
use Livewire\Component;

class ShowQuotation extends Component
{
    public $selectedQuote;
    public $showModal = false;
    public $search = '';

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
        $quotations = Quote::with('customer')
            ->when($this->search, function($query) {
                $query->where('quotation_no', 'like', '%'.$this->search.'%')
                      ->orWhereHas('customer', function($q) {
                          $q->where('name', 'like', '%'.$this->search.'%');
                      });
            })
            ->get();
        return view('livewire.quotation.show-quotation', compact('quotations'));
    }
}
