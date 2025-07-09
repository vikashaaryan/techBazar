<?php

namespace App\Livewire\Exchange;

use Livewire\Component;
use App\Models\ExchangeReturn;

class ExchangeDetail extends Component  // Changed from ViewExchange to ExchangeDetail
{
    public ExchangeReturn $exchange;

    public function mount(ExchangeReturn $exchange)
    {
        $this->exchange = $exchange->load([
            'customer',
            'supplier',
            'items.product',
            'items.replacementProduct',
            'processor'
        ]);
    }

    public function render()
    {
        return view('livewire.exchange.exchange-detail');
    }
}
