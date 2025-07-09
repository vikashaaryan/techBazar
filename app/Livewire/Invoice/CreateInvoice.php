<?php

namespace App\Livewire\Invoice;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sales;
use App\Models\SalesItems;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Livewire\Component;
use Razorpay\Api\Api;

#[Title('Invoice')]
class CreateInvoice extends Component
{
    public $status = 'draft', $payment_status = 'paid', $method = 'cash', $notes, $due_date, $amount_paid;
    public $datePrefix, $lastInvoice, $lastIncrement, $invoice_no, $newIncrement;
    public $subtotal = 0, $tax = 0, $taxRate = 0.18, $total = 0, $total_discount = 0;
    public $search = '', $selectedCustomer = null, $isSearching = false, $customers = [];
    public $products, $items = [];

    // Razorpay fields
    public $razorpay_payment_id, $razorpay_order_id, $razorpay_signature;

    public function mount()
    {
        $this->datePrefix = 'I-' . now()->format('Ymd');
        $this->lastInvoice = Invoice::where('invoice_no', 'like', $this->datePrefix . '%')
            ->orderBy('invoice_no', 'desc')
            ->first();

        $this->newIncrement = $this->lastInvoice
            ? str_pad((int) substr($this->lastInvoice->invoice_no, -3) + 1, 3, '0', STR_PAD_LEFT)
            : '001';

        $this->invoice_no = $this->datePrefix . '-' . $this->newIncrement;
        $this->products = Product::where('qty', '>', 0)->get();

        $this->items = [[
            'product_id' => null,
            'description' => '',
            'mrp' => 0,
            'quantity' => 1,
            'unit' => 'piece',
            'discount' => 0,
            'sell_price' => 0,
            'total' => 0,
            'discount_amount' => 0,
            'available_qty' => 0,
        ]];
    }

    public function updatedSearch()
    {
        $this->isSearching = true;
        $this->customers = Customer::where('name', 'like', '%' . $this->search . '%')->take(5)->get();
        $this->isSearching = false;
    }

    public function selectCustomer($customerId)
    {
        $this->selectedCustomer = Customer::find($customerId);
        $this->search = '';
    }

    public function clearSelection()
    {
        $this->selectedCustomer = null;
        $this->search = '';
        $this->customers = [];
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
            'available_qty' => 0,
        ];
    }

    public function productSelected($index)
    {
        $productId = $this->items[$index]['product_id'] ?? null;
        if (!$productId) return;

        foreach ($this->items as $i => $item) {
            if ($i !== (int) $index && $item['product_id'] == $productId) {
                $this->dispatch(
                    'duplicate-product',
                    message: 'This product is already selected in another row.'
                );
                $this->items[$index]['product_id'] = null;
                return;
            }
        }

        $product = Product::find($productId);
        if ($product) {
            $this->items[$index] = array_merge($this->items[$index], [
                'mrp' => $product->mrp,
                'unit' => $product->unit ?? 'piece',
                'description' => $product->description ?? '',
                'sell_price' => $product->sell_price,
                'available_qty' => $product->qty,
                'discount_amount' => ($product->mrp - $product->sell_price),
                'discount' => round((($product->mrp - $product->sell_price) / $product->mrp) * 100, 2)
            ]);
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

        if ($field === 'quantity') {
            if ($item['quantity'] > $item['available_qty']) {
                $this->addError("items.$index.quantity", "Quantity exceeds available stock");
                $item['quantity'] = $item['available_qty'];
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

    protected function rules()
    {
        return [
            'selectedCustomer' => 'required',
            'due_date' => 'nullable|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => [
                'required',
                'numeric',
                'min:1',
                function ($attribute, $value, $fail) {
                    $index = explode('.', $attribute)[1];
                    $productId = $this->items[$index]['product_id'];
                    $product = Product::find($productId);

                    if ($product && $value > $product->qty) {
                        $fail("Quantity exceeds available stock for {$product->name}");
                    }
                }
            ],
            'items.*.mrp' => 'required|numeric|min:0',
            'amount_paid' => 'required|numeric|min:0|lte:total',
            'method' => 'required_if:payment_status,paid',
            'payment_status' => 'required',
        ];
    }

    protected $messages = [
        'selectedCustomer.required' => 'Please select a customer.',
        'items.*.product_id.required' => 'Each item must have a selected product.',
        'items.*.quantity.required' => 'Quantity is required.',
        'amount_paid.lte' => 'Amount paid cannot be greater than total amount',
    ];

    public function createInvoice()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $customerId = $this->selectedCustomer?->id;

            // Create invoice
            $invoice = Invoice::create([
                'invoice_no' => $this->invoice_no,
                'customer_id' => $customerId,
                'status' => $this->status,
                'due_date' => $this->due_date,
                'subtotal' => $this->subtotal,
                'tax' => $this->tax,
                'total' => $this->total,
                'discount' => $this->total_discount,
                'notes' => $this->notes,
            ]);

            // Create sale
            $sales = Sales::create([
                'customer_id' => $customerId,
                'invoice_id' => $invoice->id,
                'payment_status' => $this->payment_status,
                'discount' => $this->total_discount,
                'tax' => $this->tax,
                'total_amount' => $this->total,
                'amount_paid' => $this->amount_paid,
            ]);

            // Process items and update stock
            foreach ($this->items as $item) {
                $product = Product::findOrFail($item['product_id']);

                // Validate stock again (in case of race conditions)
                if ($product->qty < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$product->name}");
                }

                // Create sale item
                SalesItems::create([
                    'sale_id' => $sales->id,
                    'product_id' => $item['product_id'],
                    'discount' => $item['discount_amount'],
                    'total' => $item['total'],
                    'qty' => $item['quantity'],
                    'invoice_id' => $invoice->id,
                ]);

                // Update product quantity
                $product->decrement('qty', $item['quantity']);
            }

            // Create payment
            Payment::create([
                'invoice_id' => $invoice->id,
                'customer_id' => $customerId,
                'type' => 'customer',
                'payment_for' => 'sell',
                'sale_id' => $sales->id,
                'method' => $this->method,
                'amount' => $this->total,
                'amount_paid' => $this->amount_paid,
                'payment_status' => $this->payment_status,
                'status' => 'captured',
                'payment_id' => $this->razorpay_payment_id ?? null,
                'order_id' => $this->razorpay_order_id ?? null,
                'signature' => $this->razorpay_signature ?? null,
            ]);

            DB::commit();

            ToastMagic::success('Invoice created successfully!');
            return redirect('/invoices');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Invoice creation failed: ' . $e->getMessage());
            $this->dispatch(
                'notify',
                type: 'error',
                message: 'Error creating invoice: ' . $e->getMessage()
            );
            return back();
        }
    }

    public function processPaymentAndCreateInvoice($razorpayPaymentId)
    {
        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $payment = $api->payment->fetch($razorpayPaymentId);

            if ($payment->status === 'authorized') {
                $payment->capture(['amount' => $payment->amount]);
            }

            $this->method = 'razorpay';
            $this->amount_paid = $payment->amount / 100;
            $this->payment_status = 'paid';
            $this->razorpay_payment_id = $payment->id;
            $this->razorpay_order_id = $payment->order_id ?? null;
            $this->razorpay_signature = request('razorpay_signature');

            return $this->createInvoice();
        } catch (\Exception $e) {
            Log::error('Razorpay payment failed: ' . $e->getMessage());
            $this->dispatch(
                'notify',
                type: 'error',
                message: 'Payment failed: ' . $e->getMessage()
            );
            return back();
        }
    }

    public function render()
    {
        $customers = Customer::where('name', 'like', '%' . $this->search . '%')->get();
        return view('livewire.invoice.create-invoice', compact('customers'));
    }
}
