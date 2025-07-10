<?php

namespace App\Livewire\Invoice;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

use Livewire\WithPagination;

class ShowInvoice extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $updatesQueryString = ['search', 'status', 'page'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function resetPage()
    {
        $this->gotoPage(1);
    }

    public function render()
    {
        $query = Invoice::query();

        if ($this->search) {
            $query->where(function($q) {
                $q->where('invoice_no', 'like', '%'.$this->search.'%')
                  ->orWhereHas('customer', function($q2) {
                      $q2->where('name', 'like', '%'.$this->search.'%');
                  });
            });
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $invoices = $query->orderByDesc('created_at')->paginate(10);

        return view('livewire.invoice.show-invoice', compact('invoices'));
    }
}
