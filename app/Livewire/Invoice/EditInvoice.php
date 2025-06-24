<?php

namespace App\Livewire\Invoice;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;

class EditInvoice extends Component
{
    public Invoice $invoice;

    // Form fields
    public $invoice_no;
    public $invoice_date;
    public $status;
    public $notes;

    // Customer search
    public $customerSearch = '';
    public $selectedCustomer = null;
    public $customers = [];

    // Items
    public $items = [];
    public $products = [];

    // Payment
    public $payment_method = 'cash';
    public $payment_status = 'due';
    public $due_date;
    public $amount_paid = 0;

    protected $rules = [
        'invoice_no' => 'required|unique:invoices,invoice_no,' . ':invoice.id',
        'invoice_date' => 'required|date',
        'status' => 'required|in:draft,sent,paid,overdue',
        'notes' => 'nullable|string',
        'items' => 'required|array|min:1',
        'items.*.product_id' => 'required|exists:products,id',
        'items.*.quantity' => 'required|numeric|min:0.01',
        'items.*.price' => 'required|numeric|min:0',
        'items.*.discount' => 'nullable|numeric|min:0',
        'payment_method' => 'required|in:cash,card,bank,upi,mixed',
        'payment_status' => 'required|in:paid,partial,due',
        'due_date' => 'required|date|after_or_equal:invoice_date',
        'amount_paid' => 'required|numeric|min:0'
    ];

    // Computed properties for dynamic totals
    public function getSubtotalProperty()
    {
        return collect($this->items)->sum(function ($item) {
            return ($item['quantity'] ?? 0) * ($item['price'] ?? 0);
        });
    }

    public function getDiscountProperty()
    {
        return collect($this->items)->sum('discount') ?? 0;
    }

    public function getTaxProperty()
    {
        return ($this->subtotal - $this->discount) * 0.18;
    }

    public function getTotalProperty()
    {
        return ($this->subtotal - $this->discount) + $this->tax;
    }

    public function getAmountDueProperty()
    {
        return $this->total - $this->amount_paid;
    }

    public function mount(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->loadInvoiceData();
        $this->products = Product::all();
    }

    protected function loadInvoiceData()
    {
        // Basic invoice info
        $this->invoice_no = $this->invoice->invoice_no;

        // Handle invoice_date - safely format if exists, otherwise use today
        $this->invoice_date = $this->invoice->invoice_date
            ? $this->invoice->invoice_date->format('Y-m-d')
            : now()->format('Y-m-d');

        $this->status = $this->invoice->status ?? 'draft';
        $this->notes = $this->invoice->notes ?? '';

        // Customer
        if ($this->invoice->customer) {
            $this->selectedCustomer = $this->invoice->customer;
        }

        // Items - with null check
        $this->items = $this->invoice->items->map(function ($item) {
            return [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'description' => $item->description ?? '',
                'quantity' => $item->quantity ?? 1,
                'price' => $item->price ?? 0,
                'discount' => $item->discount ?? 0,
                'unit' => $item->unit ?? 'piece'
            ];
        })->toArray();

        // Payment info with null checks
        $this->payment_method = $this->invoice->payment_method ?? 'cash';
        $this->payment_status = $this->invoice->payment_status ?? 'due';

        // Handle due_date safely
        $this->due_date = $this->invoice->due_date
            ? $this->invoice->due_date->format('Y-m-d')
            : now()->addDays(30)->format('Y-m-d');

        $this->amount_paid = $this->invoice->amount_paid ?? 0;
    }

    public function updatedCustomerSearch($value)
    {
        if (strlen($value) < 2) {
            $this->customers = [];
            return;
        }

        $this->customers = Customer::where('name', 'like', "%{$value}%")
            ->orWhere('email', 'like', "%{$value}%")
            ->limit(5)
            ->get();
    }

    public function selectCustomer($customerId)
    {
        $this->selectedCustomer = Customer::find($customerId);
        $this->customerSearch = $this->selectedCustomer->name;
        $this->customers = [];
    }

    public function clearCustomer()
    {
        $this->selectedCustomer = null;
        $this->customerSearch = '';
    }

    public function addItem()
    {
        $this->items[] = [
            'product_id' => '',
            'description' => '',
            'quantity' => 1,
            'price' => 0,
            'discount' => 0,
            'unit' => 'piece'
        ];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function updatedItems($value, $key)
    {
        $parts = explode('.', $key);

        if (count($parts) === 3 && $parts[2] === 'product_id') {
            $index = $parts[1];
            $product = Product::find($value);

            if ($product) {
                $this->items[$index]['price'] = $product->price;
                $this->items[$index]['description'] = $product->description;
            }
        }
    }

    public function updated($propertyName)
    {
        // Recalculate when amount paid changes
        if ($propertyName === 'amount_paid') {
            return;
        }

        // Recalculate when any item property changes
        if (str_starts_with($propertyName, 'items.')) {
            return;
        }
    }

    public function updateInvoice()
    {
        $this->validate();

        // Update invoice
        $this->invoice->update([
            'invoice_no' => $this->invoice_no,
            'invoice_date' => $this->invoice_date,
            'due_date' => $this->due_date,
            'status' => $this->status,
            'notes' => $this->notes,
            'customer_id' => $this->selectedCustomer?->id,
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'discount' => $this->discount,
            'total' => $this->total,
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,
            'amount_paid' => $this->amount_paid
        ]);

        // Sync items
        $existingIds = [];
        foreach ($this->items as $item) {
            $itemData = [
                'product_id' => $item['product_id'],
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'discount' => $item['discount'],
                'unit' => $item['unit'],
                'total' => ($item['quantity'] * $item['price']) - $item['discount']
            ];

            if (isset($item['id'])) {
                $this->invoice->items()->where('id', $item['id'])->update($itemData);
                $existingIds[] = $item['id'];
            } else {
                $newItem = $this->invoice->items()->create($itemData);
                $existingIds[] = $newItem->id;
            }
        }

        // Delete removed items
        $this->invoice->items()->whereNotIn('id', $existingIds)->delete();

        session()->flash('message', 'Invoice updated successfully!');
        return redirect()->route('invoices.show', $this->invoice);
    }

    public function render()
    {
        return view('livewire.invoice.edit-invoice', [
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'discount' => $this->discount,
            'total' => $this->total,
            'amount_due' => $this->amount_due
        ]);
    }
}
