<?php

namespace App\Livewire\Exchange;

use Livewire\Component;
use App\Models\ExchangeReturn;
use App\Models\ExchangeReturnItem;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Support\Str;

class EditExchange extends Component
{
    public ExchangeReturn $exchange;
    public $items = [];
    public $customers = [];
    public $suppliers = [];
    public $products = [];

    protected $rules = [
        'exchange.type' => 'required|in:exchange,return',
        'exchange.return_type' => 'required|in:sale_return,purchase_return',
        'exchange.invoice_id' => 'nullable|string',
        'exchange.customer_id' => 'nullable|required_if:exchange.return_type,sale_return|exists:customers,id',
        'exchange.supplier_id' => 'nullable|required_if:exchange.return_type,purchase_return|exists:suppliers,id',
        'exchange.reasons' => 'required|string',
        'exchange.notes' => 'nullable|string',
        'exchange.return_date' => 'required|date',
        'exchange.refund_method' => 'nullable|in:cash,credit_card,store_credit,exchange',
        'exchange.status' => 'required|in:requested,approved,processed,completed,rejected',
        'items.*.product_id' => 'required|exists:products,id',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.refund_amount' => 'required|numeric|min:0',
        'items.*.condition' => 'required|in:new,opened,used,damaged,defective',
        'items.*.reason' => 'nullable|string|max:255',
        'items.*.replacement_product_id' => 'nullable|required_if:exchange.type,exchange|exists:products,id',
        'items.*.replacement_price_diff' => 'nullable|numeric',
    ];

    public function mount(ExchangeReturn $exchange)
    {
        $this->exchange = $exchange;
        $this->items = $exchange->items->toArray();

        // Load options
        $this->customers = Customer::active()->get();
        $this->suppliers = Supplier::active()->get();
        $this->products = Product::all();
    }

    public function addItem()
    {
        $this->items[] = [
            'product_id' => '',
            'quantity' => 1,
            'refund_amount' => 0,
            'condition' => 'new',
            'reason' => '',
            'replacement_product_id' => '',
            'replacement_price_diff' => 0
        ];
    }

    public function removeItem($index)
    {
        if (count($this->items) > 1) {
            unset($this->items[$index]);
            $this->items = array_values($this->items);
        }
    }

    public function update()
    {
        $this->validate();

        // Update the exchange
        $this->exchange->save();

        // Update items
        $this->exchange->items()->delete();
        foreach ($this->items as $item) {
            $product = Product::find($item['product_id']);
            $this->exchange->items()->create([
                'product_id' => $item['product_id'],
                'product_name' => $product->name,
                'original_price' => $product->sell_price,
                'quantity' => $item['quantity'],
                'refund_amount' => $item['refund_amount'],
                'reason' => $item['reason'],
                'condition' => $item['condition'],
                'replacement_product_id' => $item['replacement_product_id'],
                'replacement_price_diff' => $item['replacement_price_diff'],
                'replacement_product_name' => $item['replacement_product_id'] ? Product::find($item['replacement_product_id'])->name : null,
            ]);
        }

        session()->flash('success', 'Exchange/Return updated successfully!');
        return redirect()->route('exchange.view');
    }

    public function render()
    {
        return view('livewire.exchange.edit-exchange');
    }
}
