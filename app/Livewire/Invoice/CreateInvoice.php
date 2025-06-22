<?php

namespace App\Livewire\Invoice;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sales;
use App\Models\SalesItems;
use Livewire\Component;

class CreateInvoice extends Component
{
    public $status = '', $payment_status = '', $method = '', $notes, $due_date, $amount_paid;
    public $datePrefix, $lastInvoice, $lastIncrement, $invoice_no, $newIncrement;
    public $subtotal = 0, $tax = 0, $taxRate = 0.18, $total = 0, $total_discount = 0;
    public $search = '', $selectedCustomer = null, $isSearching = false, $customers = [];
    public $products;
    public function mount()
    {
        // for Invoice no automatic generation
        $this->datePrefix = 'I-' . now()->format('Ymd');
        $this->lastInvoice = Invoice::where('invoice_no', 'like', $this->datePrefix . '%')
            ->orderBy('invoice_no', 'desc')
            ->first();
        if ($this->lastInvoice) {
            $this->lastIncrement = (int) substr($this->lastInvoice->invoice_no, -3);
            $this->newIncrement = str_pad($this->lastIncrement + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $this->newIncrement = '001';
        }
        $this->invoice_no = $this->datePrefix . '-' . $this->newIncrement;

        $this->products = Product::all();
    }
    // Live search customer with debounce (300ms delay)
    public function updatedSearch()
    {
        $this->isSearching = true;

        $this->customers = Customer::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->take(5) // Limit results
            ->get();

        $this->isSearching = false;
    }
    // Select customer
    public function selectCustomer($customerId)
    {
        $this->selectedCustomer = Customer::find($customerId);
        $this->search = ''; // Clear search term after selection
    }

    public function clearSelection()
    {
        $this->selectedCustomer = null;
        $this->search = '';
        $this->customers = [];
    }
    // end customer logic functions

    public $items = [
        [
            'product_id' => null,
            'description' => '',
            'mrp' => 0,
            'quantity' => 1,
            'unit' => 'piece',
            'discount' => 0,
            'sell_price' => 0, // Optional if you want to store it
            'total' => 0, // Live computed total for the item
            'discount_amount' => 0,
        ]
    ];
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
            'total' => 0, // ✅ Initialize this
        ];
    }
    public function productSelected($index)
    {
        $productId = $this->items[$index]['product_id'] ?? null;

        if (!$productId)
            return;

        // ✅ Check if this product is already selected in another item
        foreach ($this->items as $i => $item) {
            if ($i !== (int) $index && $item['product_id'] == $productId) {
                $this->dispatchBrowserEvent('duplicate-product', ['message' => 'This product is already selected in another row.']);
                // Reset the product_id to null
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


    public function updatedItems($value, $key)
    {
        // When any item field changes, update totals
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

        // Recalculate total for this item
        $this->calculateItemTotal($index);
        $this->calculateSummary();
    }

    public function calculateItemTotal($index)
    {
        $item = &$this->items[$index];

        $mrp = $item['mrp'] ?? 0;
        $qty = $item['quantity'] ?? 1;
        $discount = $item['discount'] ?? 0;

        // Calculate per unit discount amount
        $discountAmount = ($mrp * $discount) / 100;

        // ✅ Save total discount for that line (unit discount × quantity)
        $item['discount_amount'] = round($discountAmount * $qty, 2);

        // Net total for this line
        $netPrice = $mrp - $discountAmount;
        $item['total'] = round($netPrice * $qty, 2);
    }


    public function calculateSummary()
    {
        $this->subtotal = collect($this->items)->sum(fn($item) => $item['total'] ?? 0);

        // ✅ Corrected line to calculate total_discount
        $this->total_discount = collect($this->items)->sum(fn($item) => $item['discount_amount'] ?? 0);

        $this->tax = round($this->subtotal * $this->taxRate, 2);
        $this->total = round($this->subtotal + $this->tax, 2);
    }


    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Reindex array
        $this->calculateSummary(); // ✅ Recalculate totals
    }
    public function duplicateItem($index)
    {
        $duplicate = $this->items[$index];
        array_splice($this->items, $index + 1, 0, [$duplicate]);
    }

    public function createInvoice()
    {
        $invoice = Invoice::create([
            'invoice_no' => $this->invoice_no,
            'customer_id' => $this->selectedCustomer['id'],
            'status' => $this->status,
            'due_date' => $this->due_date,
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'total' => $this->total,
            'discount' => $this->total_discount,
            'notes' => $this->notes,
        ]);

        $sales = Sales::create([
            'customer_id' => $this->selectedCustomer['id'],
            'invoice_id' => $invoice->id,
            'payment_status' => $this->payment_status,
            'discount' => $this->total_discount,
            'tax' => $this->tax,
            'total_amount' => $this->total,
            'amount_paid' => $this->amount_paid,

        ]);
        foreach ($this->items as $item) {
            SalesItems::create([
                'sale_id' => $sales->id,
                'product_id' => $item['product_id'],
                'discount' => $item['discount_amount'] ?? 0,
            ]);
        }
        Payment::create([
            'invoice_id' => $invoice->id,
            'type' => 'customer',
            'payment_for' => 'sell',
            'sale_id' => $sales->id,
            'method' => $this->method,
            'amount_paid' => $this->amount_paid,
            'payment_status' => $this->payment_status,
        ]);


        $this->redirect('/hi', navigate: true); // Change route if needed
    }

    public function render()
    {
        $customers = Customer::where('name', 'like', '%' . $this->search . '%')->get();
        return view('livewire.invoice.create-invoice', compact('customers'));
    }
}
