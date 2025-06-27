<?php

namespace App\Livewire\Quotation;

use App\Models\Product;
use App\Models\Quote;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Edit Quotation')]
class EditQuotation extends Component
{
    public $status = 'draft', $notes;
    public $subtotal = 0, $tax = 0, $taxRate = 0.18, $total = 0, $total_discount = 0, $discount_amount = 0;
    public $quotation_no, $datePrefix, $lastQuote, $lastIncrement, $newIncrement, $validQuotationDate;
    public $products;

    public $quotation;
    public $quotationId;

    public function mount($quotation)
    {
        $this->quotationId = $quotation;
        $this->quotation = Quote::with(['items', 'customer'])->findOrFail($this->quotationId);
        $this->products = Product::all();

        // Initialize form fields with existing quotation data
        $this->status = $this->quotation->status;
        $this->notes = $this->quotation->notes;
        $this->subtotal = $this->quotation->subtotal;
        $this->tax = $this->quotation->tax;
        $this->total = $this->quotation->total;
        $this->discount_amount = $this->quotation->discount_amount;
        $this->total_discount = $this->quotation->discount;
        $this->selectedCustomer = $this->quotation->customer_id;


        // Initialize items from existing quotation
        $this->items = $this->quotation->items->map(function ($item) {
            return [
                'product_id' => $item->product_id,
                'description' => $item->description,
                'mrp' => $item->mrp,
                'quantity' => $item->quantity,
                'unit' => $item->unit,
                'discount_percent' => $item->discount_percent,
                'sell_price' => $item->sell_price,
                'total' => $item->total,
                'discount_amount' => $item->discount_amount,
            ];
        })->toArray();

        // Add empty item if no items exist
        if (empty($this->items)) {
            $this->items = [
                [
                    'product_id' => null,
                    'description' => '',
                    'mrp' => 0,
                    'quantity' => 1,
                    'unit' => 'piece',
                    'discount' => 0,
                    'sell_price' => 0,
                    'total' => 0,
                    'discount_amount' => 0,
                ]
            ];
        }
    }


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
    public function moveItemUp($index)
    {
        if ($index > 0) {
            $items = $this->items;
            $temp = $items[$index - 1];
            $items[$index - 1] = $items[$index];
            $items[$index] = $temp;
            $this->items = $items;
        }
    }

    public function moveItemDown($index)
    {
        if ($index < count($this->items) - 1) {
            $items = $this->items;
            $temp = $items[$index + 1];
            $items[$index + 1] = $items[$index];
            $items[$index] = $temp;
            $this->items = $items;
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

                // Default to 1 qty if not yet set
                $qty = isset($item['quantity']) ? $item['quantity'] : 1;

                $unit_discount = $product->mrp - $product->sell_price;
                $item['discount_amount'] = $unit_discount * $qty;
                $item['discount'] = round(($unit_discount / $product->mrp) * 100, 2);
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

    public function saveQuotation()
    {
        // Validate the form data
        $this->validate([
            'status' => 'required',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.mrp' => 'required|numeric|min:0',
            'items.*.discount' => 'nullable|numeric|min:0|max:100',
        ]);

        // Update the quotation
        $this->quotation->update([
            'status' => $this->status,
            'notes' => $this->notes,
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'total' => $this->total,
            'discount' => $this->total_discount,
        ]);

        // Sync items - delete old ones and create new ones
        $this->quotation->items()->delete();

        foreach ($this->items as $item) {
            $this->quotation->items()->create([
                'product_id' => $item['product_id'],
                'description' => $item['description'],
                'mrp' => $item['mrp'],
                'quantity' => $item['quantity'],
                'unit' => $item['unit'],
                'discount' => $item['discount_amount'],
            ]);
        }

        ToastMagic::success('Quotation updated successfully!');
        return redirect()->route('showQuotation', $this->quotationId);
    }
    public function render()
    {
        return view('livewire.quotation.edit-quotation');
    }
}
