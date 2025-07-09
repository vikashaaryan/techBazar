<?php

namespace App\Livewire\Exchange;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ExchangeReturn;

class ViewExchange extends Component
{
    use WithPagination;

    public $type = '';
    public $return_type = '';
    public $status = '';
    public $search = '';

    protected $queryString = [
        'type' => ['except' => ''],
        'return_type' => ['except' => ''],
        'status' => ['except' => ''],
        'search' => ['except' => '']
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $exchanges = ExchangeReturn::query()
            ->when($this->type, fn($query) => $query->where('type', $this->type))
            ->when($this->return_type, fn($query) => $query->where('return_type', $this->return_type))
            ->when($this->status, fn($query) => $query->where('status', $this->status))
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('serial_no', 'like', '%' . $this->search . '%')
                        ->orWhere('invoice_id', 'like', '%' . $this->search . '%')
                        ->orWhereHas('customer', fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
                        ->orWhereHas('supplier', fn($q) => $q->where('supplier_name', 'like', '%' . $this->search . '%'));
                });
            })
            ->with(['customer', 'supplier', 'sale', 'purchase']) // Eager load all relationships
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.exchange.view-exchange', [
            'exchanges' => $exchanges
        ]);
    }

    public function resetFilters()
    {
        $this->reset(['type', 'return_type', 'status', 'search']);
    }
}
