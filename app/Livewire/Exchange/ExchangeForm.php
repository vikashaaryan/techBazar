<?php

namespace App\Livewire\Exchange;

use Livewire\Component;
use App\Models\ExchangeReturn;
use App\Models\ExchangeReturnItem;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Invoice;
use App\Models\Sales;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ExchangeForm extends Component
{
    // Form fields
    public $type = 'exchange';
    public $return_type = 'sale_return';
    public $invoice_id;
    public $sale_id;
    public $purchase_id;
    public $customer_id;
    public $supplier_id;
    public $reasons;
    public $notes;
    public $return_date;
    public $refund_method;
    public $status = 'requested';

    // Items array
    public $items = [
        [
            'product_id' => '',
            'quantity' => 1,
            'refund_amount' => 0,
            'condition' => 'new',
            'reason' => '',
            'replacement_product_id' => '',
            'replacement_price_diff' => 0
        ]
    ];

    // Options for selects
    public $customers = [];
    public $suppliers = [];
    public $products = [];
    public $sales = [];
    public $purchases = [];
    public $invoices = [];

    protected $rules = [
        'type' => 'required|in:exchange,return',
        'return_type' => 'required|in:sale_return,purchase_return',
        'invoice_id' => 'nullable',
        'sale_id' => 'nullable|required_if:return_type,sale_return|exists:sales,id',
        'purchase_id' => 'nullable|required_if:return_type,purchase_return|exists:purchases,id',
        'customer_id' => 'nullable|required_if:return_type,sale_return|exists:customers,id',
        'supplier_id' => 'nullable|required_if:return_type,purchase_return|exists:suppliers,id',
        'items.*.product_id' => 'required|exists:products,id',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.refund_amount' => 'required|numeric|min:0',
        'items.*.condition' => 'required|in:new,opened,used,damaged,defective',
        'items.*.reason' => 'nullable|string|max:255',
        'items.*.replacement_product_id' => 'nullable|required_if:type,exchange|exists:products,id',
        'items.*.replacement_price_diff' => 'nullable|numeric',
        'reasons' => 'required|string',
        'notes' => 'nullable|string',
        'return_date' => 'required|date',
        'refund_method' => 'nullable|in:cash,credit_card,store_credit,exchange',
    ];

    public function mount()
    {
        $this->return_date = now()->format('Y-m-d');
        $this->loadOptions();
    }

    public function loadOptions()
    {
        $this->customers = Customer::active()->get();
        $this->suppliers = Supplier::active()->get();
        $this->products = Product::all();
        $this->sales = Sales::with('customer')->get();
        $this->purchases = Purchase::with('supplier')->get();
        $this->invoices = Invoice::all();
    }

    public function updatedReturnType($value)
    {
        $this->reset(['sale_id', 'purchase_id', 'customer_id', 'supplier_id']);
    }

    public function updatedSaleId($value)
    {
        if ($value) {
            $sale = Sales::find($value);
            $this->customer_id = $sale->customer_id;
            $this->invoice_id = $sale->invoice_id;
        }
    }

    public function updatedPurchaseId($value)
    {
        if ($value) {
            $purchase = Purchase::find($value);
            $this->supplier_id = $purchase->supplier_id;
        }
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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();

        // Calculate totals
        $totalQuantity = collect($this->items)->sum('quantity');
        $totalRefundAmount = collect($this->items)->sum('refund_amount');

        // Create the exchange/return
        $exchangeReturn = ExchangeReturn::create([
            'serial_no' => 'EX-' . Str::upper(Str::random(8)),
            'type' => $this->type,
            'return_type' => $this->return_type,
            'invoice_id' => $this->invoice_id,
            'sale_id' => $this->return_type === 'sale_return' ? $this->sale_id : null,
            'purchase_id' => $this->return_type === 'purchase_return' ? $this->purchase_id : null,
            'customer_id' => $this->return_type === 'sale_return' ? $this->customer_id : null,
            'supplier_id' => $this->return_type === 'purchase_return' ? $this->supplier_id : null,
            'total_quantity' => $totalQuantity,
            'total_refund_amount' => $totalRefundAmount,
            'total_tax_refund' => 0, // You may need to calculate this
            'reasons' => $this->reasons,
            'status' => $this->status,
            'processed_by' => Auth::id(),
            'notes' => $this->notes,
            'return_date' => $this->return_date,
            'refund_method' => $this->refund_method,
        ]);

        // Create items
        foreach ($this->items as $item) {
            $product = Product::find($item['product_id']);

            ExchangeReturnItem::create([
                'exchange_return_id' => $exchangeReturn->id,
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

        session()->flash('success', 'Exchange/Return created successfully!');
        return redirect()->route('exchange.view');
    }

    public function render()
    {
        return view('livewire.exchange.exchange-form');
    }
}
