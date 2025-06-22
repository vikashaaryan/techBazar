<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Quote;
use App\Models\QuotesItems;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateQuotation extends Component
{
    public $status = '', $notes;
    public $subtotal = 0, $tax = 0, $taxRate = 0.18, $total = 0;
    public $quotation_no, $datePrefix, $lastQuote, $lastIncrement, $newIncrement, $validQuotationDate;
    public $search = '', $selectedCustomer = null, $isSearching = false, $customers = [];
    public $products;

    public function mount()
    {
        // for quote no automatic generation
        $this->datePrefix = 'Q-' . now()->format('Ymd');
        $this->lastQuote = Quote::where('quotation_no', 'like', $this->datePrefix . '%')
            ->orderBy('quotation_no', 'desc')
            ->first();
        if ($this->lastQuote) {
            $this->lastIncrement = (int) substr($this->lastQuote->quotation_no, -3);
            $this->newIncrement = str_pad($this->lastIncrement + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $this->newIncrement = '001';
        }
        $this->quotation_no = $this->datePrefix . '-' . $this->newIncrement;
        // quote valid date (7 days)
        $this->validQuotationDate = date('Y-m-d', strtotime('+7 days'));
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
            'total' => 0,       // Live computed total for the item
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
            'sell_price' => 0,
            'total' => 0, // ✅ Initialize this
        ];
    }
    public function productSelected($index)
    {
        $productId = $this->items[$index]['product_id'] ?? null;

        if ($productId) {
            $product = Product::find($productId);

            if ($product) {
                $this->items[$index]['mrp'] = $product->mrp;
                $this->items[$index]['unit'] = $product->unit ?? 'piece';
                $this->items[$index]['description'] = $product->description ?? '';
                // Add more fields if needed
            }
        }
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

        $discountAmount = ($mrp * $discount) / 100;
        $netPrice = $mrp - $discountAmount;
        $item['total'] = round($netPrice * $qty, 2);
    }

    public function calculateSummary()
    {
        $this->subtotal = collect($this->items)->sum(fn($item) => $item['total'] ?? 0);
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

    public $selectedCustomerId;

    public function createQuote()
    {
        $this->validate([
            // quote validation 
            'status' => 'required',

            // Quotes items validation
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.mrp' => 'required|numeric|min:0',
            'items.*.discount' => 'nullable|numeric|min:0|max:100',
            'items.*.unit' => 'required|string',
        ]);
        $quote = Quote::create([
            'quotation_no' => $this->quotation_no,
            'valid_date' => $this->validQuotationDate,
            'status' => $this->status,
            'customer_id' => $this->selectedCustomer['id'],
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'total' => $this->total,
            'notes' => $this->notes,
        ]);

        foreach ($this->items as $item) {
            QuotesItems::create([
                'quote_id' => $quote->id,
                'product_id' => $item['product_id'],
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit' => $item['unit'],
                'mrp' => $item['mrp'],
                'discount' => $item['discount'] ?? 0,
                'tax' => 18, // Assuming fixed
            ]);
        }

        // session()->flash('success', 'Quotation created successfully!');
        $this->redirect('/hello'); // Change route if needed

    }

    public function render()
    {
        $customers = Customer::where('name', 'like', '%' . $this->search . '%')->get();
        return view('livewire.quotation.create-quotation', compact('customers'));
    }
}
