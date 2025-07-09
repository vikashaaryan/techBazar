<?php

namespace App\Livewire\Invoice;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;

class EditInvoice extends Component
{
    public $status = 'draft', $payment_status = 'paid', $method = 'cash', $notes, $due_date, $amount_paid;
    public $datePrefix, $lastInvoice, $lastIncrement, $invoice_no, $newIncrement;
    public $subtotal = 0, $tax = 0, $taxRate = 0.18, $total = 0, $total_discount = 0;
    public $products, $items = [];

    public $invoice, $invoiceId;
    public function mount($invoice)
    {
        $this->invoiceId = $invoice;
        $this->invoice = Invoice::with(['items', 'customer'])->findOrFail($this->invoiceId);
        $this->products = Product::all();

        // Initialize form fields with existing invoice data
        $this->status = $this->invoice->status;
        $this->notes = $this->invoice->notes;
        $this->subtotal = $this->invoice->subtotal;
        $this->tax = $this->invoice->tax;
        $this->total = $this->invoice->total;
        $this->discount_amount = $this->invoice->discount_amount;
        $this->total_discount = $this->invoice->discount;
        $this->selectedCustomer = $this->invoice->customer_id;


        // Initialize items from existing invoice
        $this->items = $this->invoice->items->map(function ($item) {
            return [
                'product_id' => $item->product_id,
                'name' => $item->product->name ?? '', // fallback if product missing
                'description' => $item->product->description ?? '',
                'total' => $item->total,
            ];
        })->toArray();



    }

    public function addItem()
    {
        $this->items[] = [
            'product_id' => null,
            'description' => '',
            'mrp' => 0,
            'quantity' => 1,
            'unit' => 'piece',
            'discount' => 0,
            'discount_amount' => 0,
            'sell_price' => 0,
            'total' => 0,
        ];
    }

    public function productSelected($index)
    {
        $productId = $this->items[$index]['product_id'] ?? null;
        if (!$productId)
            return;

        foreach ($this->items as $i => $item) {
            if ($i !== (int) $index && $item['product_id'] == $productId) {
                $this->dispatchBrowserEvent('duplicate-product', ['message' => 'This product is already selected in another row.']);
                $this->items[$index]['product_id'] = null;
                return;
            }
        }

        $product = Product::find($productId);
        if ($product) {
            $this->items[$index]['mrp'] = $product->mrp;
            $this->items[$index]['unit'] = $product->unit ?? 'piece';
            $this->items[$index]['description'] = $product->description ?? '';
        }

        $this->calculateItemTotal($index);
        $this->calculateSummary();
    }

    public function moveItemUp($index)
    {
        if ($index > 0) {
            [$this->items[$index], $this->items[$index - 1]] = [$this->items[$index - 1], $this->items[$index]];
        }
    }

    public function moveItemDown($index)
    {
        if ($index < count($this->items) - 1) {
            [$this->items[$index], $this->items[$index + 1]] = [$this->items[$index + 1], $this->items[$index]];
        }
    }

    public function updatedItems($value, $key)
    {
        [$index, $field] = explode('.', $key);
        $item = &$this->items[$index];

        if (isset($item['product_id']) && $field === 'product_id') {
            $product = Product::find($item['product_id']);
            if ($product) {
                $item['mrp'] = $product->mrp;
                $item['sell_price'] = $product->sell_price;
                $item['discount_amount'] = ($product->mrp - $product->sell_price);
                $item['discount'] = round((($product->mrp - $product->sell_price) / $product->mrp) * 100, 2);
            }
        }

        $this->calculateItemTotal($index);
        $this->calculateSummary();
    }

    public function calculateItemTotal($index)
    {
        $item = &$this->items[$index];
        $discountAmount = ($item['mrp'] * $item['discount']) / 100;
        $item['discount_amount'] = round($discountAmount * $item['quantity'], 2);
        $netPrice = $item['mrp'] - $discountAmount;
        $item['total'] = round($netPrice * $item['quantity'], 2);
    }

    public function calculateSummary()
    {
        $this->subtotal = collect($this->items)->sum(fn($item) => $item['total']);
        $this->total_discount = collect($this->items)->sum(fn($item) => $item['discount_amount']);
        $this->tax = round($this->subtotal * $this->taxRate, 2);
        $this->total = round($this->subtotal + $this->tax, 2);
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
        $this->calculateSummary();
    }

    public function duplicateItem($index)
    {
        $this->items = array_merge(
            array_slice($this->items, 0, $index + 1),
            [$this->items[$index]],
            array_slice($this->items, $index + 1)
        );
    }

    public function updateInvoice()
    {
        dd('updating Invoice');
    }

    public function render()
    {
        return view('livewire.invoice.edit-invoice');
    }
}
