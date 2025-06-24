<?php

namespace App\Livewire\Admin;

use App\Models\Sales;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Sales')]
class ManageSales extends Component
{
    public $search = '', $status = '';
    public $selectedSale;
    public $showModal = false;
    public function mount()
    {

    }
    public function deleteSales(Sales $sale)
    {
        $sale->delete();
    }
    public function closeModal()
    {
        $this->showModal = false;
        $this->reset('selectedSale');
    }
    public function viewSaleDetails($saleId)
    {
        $this->selectedSale = Sales::with('customer')->findOrFail($saleId);
        $this->showModal = true;
    }
    public function render()
    {
        $sales = Sales::with('customer')
            ->when(
                $this->search,
                fn($q) =>
                $q->whereHas(
                    'customer',
                    fn($q2) =>
                    $q2->where('name', 'like', '%' . $this->search . '%')
                )
            )
            ->when(
                $this->status !== '',
                fn($q) =>
                $q->where('payment_status', $this->status)
            )
            ->get();

        return view('livewire.admin.manage-sales', compact('sales'))
            ->layout('components.layouts.admin');
    }
}
