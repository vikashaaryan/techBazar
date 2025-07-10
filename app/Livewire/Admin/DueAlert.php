<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Livewire\Attributes\Layout;

class DueAlert extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';
    public $filter = 'all'; // 'all', 'low_stock', 'expiring', 'expired'
    public $sortField = 'qty';
    public $sortDirection = 'asc';

    protected $queryString = [
        'search' => ['except' => ''],
        'filter' => ['except' => 'all'],
        'perPage' => ['except' => 5],
        'sortField' => ['except' => 'qty'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $products = Product::query()
            ->with(['category'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('code', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filter === 'low_stock', function ($query) {
                $query->where('qty', '<=', 5); // Adjust threshold as needed
            })
            ->when($this->filter === 'expiring', function ($query) {
                $query->whereNotNull('expiry_date')
                    ->where('expiry_date', '>=', now())
                    ->where('expiry_date', '<=', now()->addDays(30));
            })
            ->when($this->filter === 'expired', function ($query) {
                $query->whereNotNull('expiry_date')
                    ->where('expiry_date', '<', now());
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.due-alert', [
            'products' => $products,
        ]);
    }
}
