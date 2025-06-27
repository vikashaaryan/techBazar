<?php
namespace App\Livewire\Invoice;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sales;
use App\Models\SalesItems;
use Devrabiul\ToastMagic\Facades\ToastMagic;
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
    public $products;
    public $items = [];

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
        $this->products = Product::all();
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
        ];
    }

    public function productSelected($index)
    {
        $productId = $this->items[$index]['product_id'] ?? null;
        if (!$productId) return;

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

    protected function rules()
    {
        return [
            'selectedCustomer' => 'required',
            'due_date' => 'nullable|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.mrp' => 'required|numeric|min:0',
            'amount_paid' => 'required|numeric|min:0',
            'method' => 'required_if:payment_status,paid',
            'payment_status' => 'required',
        ];
    }

    protected $messages = [
        'selectedCustomer.required' => 'Please select a customer.',
        'items.*.product_id.required' => 'Each item must have a selected product.',
        'items.*.quantity.required' => 'Quantity is required.',
    ];

    public function createInvoice()
    {
        $this->validate();

        $invoice = Invoice::create([
            'invoice_no' => $this->invoice_no,
            'customer_id' => $this->selectedCustomer?->id,
            'status' => $this->status,
            'due_date' => $this->due_date,
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'total' => $this->total,
            'discount' => $this->total_discount,
            'notes' => $this->notes,
        ]);

        $sales = Sales::create([
            'customer_id' => $this->selectedCustomer?->id,
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
                'discount' => $item['discount_amount'],
                'total' => $item['total'],
                'qty' => $item['quantity'],
                'invoice_id' => $invoice->id,
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

        ToastMagic::success('Invoice Created Successfully');
        return redirect('/invoices');
    }

    public function processPaymentAndCreateInvoice($razorpayPaymentId)
    {
        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $payment = $api->payment->fetch($razorpayPaymentId);

            if ($payment->status === 'authorized') {
                $payment->capture(['amount' => $payment->amount]);
            }

            $this->payment_status = 'paid';
            $this->method = 'razorpay';
            $this->amount_paid = $payment->amount / 100;

            $this->createInvoice();

            ToastMagic::success('Payment & Invoice created successfully');

        } catch (\Exception $e) {
            ToastMagic::error('Payment failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $customers = Customer::where('name', 'like', '%' . $this->search . '%')->get();
        return view('livewire.invoice.create-invoice', compact('customers'));
    }
}
