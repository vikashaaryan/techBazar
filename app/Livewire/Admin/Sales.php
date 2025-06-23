<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Sales')]

class Sales extends Component
{
    public function render()
    {
        return view('livewire.admin.sales')->layout('components.layouts.admin');
    }
}
