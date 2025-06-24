<?php

namespace App\Livewire\Admin;

use App\Models\Sales;
use Livewire\Component;

class ManageSales extends Component
{
    public function render()
    {
        $sales = Sales::all();
        return view('livewire.admin.manage-sales', compact('sales'));
    }
}
