<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 underline">Edit Invoice ({{ $invoiceId }})</h1>
        </div>
        <div class="lg:col-span-2 p-6 md:p-8">
            <form wire:submit.prevent="updateInvoice" class="space-y-6">
                @csrf
                <!-- Invoice Header Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Invoice Details Column -->
                        <div class="md:w-1/2">
                            <div class="bg-white border border-blue-100 rounded-xl p-6 shadow-sm space-y-6">
                                <!-- Header -->
                                <div class="border-b border-gray-300 pb-2">
                                    <h2 class="text-xl font-bold text-gray-800 tracking-tight">Invoice Details</h2>
                                </div>

                                <!-- Form Grid -->
                                <div class="space-y-5">
                                    <!-- Invoice Number -->
                                    <div class="flex items-center justify-between">
                                        <label class="text-sm font-medium text-gray-700">Invoice #</label>
                                        <input type="text"  value="{{ $invoice->invoice_no }}" readonly
                                            class="w-44 text-right px-3 py-2 border border-gray-300 rounded-md bg-gray-50 font-mono text-sm focus:outline-none">
                                    </div>

                                    <!-- Invoice Date -->
                                    <div class="flex items-center justify-between">
                                        <label class="text-sm font-medium text-gray-700">Date</label>
                                        <input type="date" readonly value="{{ $invoice->created_at->format('Y-m-d') }}"
                                            class="w-44 px-3 text-center py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    </div>

                                    <!-- Status Selector -->
                                    <div class="flex items-center justify-between">
                                        <label class="text-sm font-medium text-gray-700">Status</label>
                                        <select wire:model="status"
                                            class="w-44 px-3 py-2 border border-gray-300 rounded-md bg-white text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                            <option value="draft">Draft</option>
                                            <option value="sent">Sent</option>
                                            <option value="accepted">Accepted</option>
                                            <option value="rejected">Rejected</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Business Info Column -->
                        <div class="md:w-1/2">
                            <div
                                class="h-full flex flex-col justify-between bg-gradient-to-br from-blue-50 to-white border border-blue-100 rounded-xl p-6 shadow-sm">
                                <div class="flex  gap-5">
                                    <!-- Logo Area -->
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-20 h-20 bg-white rounded-xl border-2 border-blue-300 flex items-center justify-center shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Business Info -->
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-800 flex items-center">
                                            TechBazar
                                            <span
                                                class="ml-2 text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Your
                                                Business</span>
                                        </h3>

                                        <div class="mt-2 space-y-1">
                                            <div class="flex items-start">
                                                <svg class="flex-shrink-0 h-4 w-4 text-gray-500 mt-0.5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                <span class="ml-2 text-sm text-gray-600">123 Business Street, Purnea,
                                                    Bihar 854301</span>
                                            </div>

                                            <div class="flex items-center">
                                                <svg class="flex-shrink-0 h-4 w-4 text-gray-500" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                                <span class="ml-2 text-sm text-gray-600">+91 8227046826</span>
                                            </div>

                                            <div class="flex items-center">
                                                <svg class="flex-shrink-0 h-4 w-4 text-gray-500" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                                <span
                                                    class="ml-2 text-sm text-gray-600">contact@techbazar.example</span>
                                            </div>
                                        </div>

                                        <div class="mt-3 flex items-center">
                                            <svg class="flex-shrink-0 h-4 w-4 text-gray-500" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                            <span
                                                class="ml-2 text-xs font-medium text-gray-700 bg-blue-50 px-2 py-1 rounded">GSTIN:
                                                22ABCDE1234F1Z5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Customer Section -->
                <div class="space-y-6">
                    <!-- Customer Information Card -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                        <!-- Card Header -->
                        <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b border-blue-200">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                </svg>
                                Customer Information
                            </h3>
                        </div>

                        <!-- Card Body -->
                        <div
                            class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Column 1 -->
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</p>
                                        <p class="text-gray-800 dark:text-gray-100 font-medium">
                                            {{ $invoice->customer->name }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Contact</p>
                                        <p class="text-gray-800 dark:text-gray-100 font-medium">
                                            {{ $invoice->customer->contact }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Column 2 -->
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</p>
                                        <p class="text-gray-800 dark:text-gray-100 font-medium">
                                            {{ $invoice->customer->email }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Address</p>
                                        <p class="text-gray-800 dark:text-gray-100 font-medium">
                                            {{ $invoice->customer->address->address }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               <!-- Products Section -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-800">Products & Services</h3>

                    @foreach($items as $index => $item)
                        <div wire:key="item-{{ $index }}"
                            class="border border-gray-300 rounded-xl p-4 bg-white shadow-sm relative">

                            <!-- Up/Down/Delete Buttons -->
                            <div class="absolute left-2 top-4 flex flex-col space-y-2">
                                <button type="button" wire:click="moveItemUp({{ $index }})"
                                    class="text-blue-500 hover:text-blue-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 15l7-7 7 7" />
                                    </svg>
                                </button>
                                <button type="button" wire:click="moveItemDown({{ $index }})"
                                    class="text-blue-500 hover:text-blue-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <button type="button" wire:click="removeItem({{ $index }})"
                                    class="text-red-500 hover:text-red-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Product Form Layout -->
                            <div class="md:grid md:grid-cols-2 md:gap-6 pl-10">
                                <!-- Left Section -->
                                <div class="space-y-1">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Item</label>
                                        <select wire:model.live="items.{{ $index }}.product_id"
                                            wire:change="productSelected({{ $index }})"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                            <option value="">Select Product</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    @if(collect($items)->pluck('product_id')->contains($product->id) && $items[$index]['product_id'] != $product->id) disabled @endif>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('items.' . $index . '.product_id')
                                            <p class="text-red-500 font-semibold">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                        <textarea wire:model="items.{{ $index }}.description"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm h-20"
                                            placeholder="Description..."></textarea>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">MRP</label>
                                        <input type="number" wire:model="items.{{ $index }}.mrp"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                            placeholder="Enter MRP">
                                    </div>
                                </div>

                                <!-- Right Section -->
                                <div class="space-y-1 mt-4 md:mt-0">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                        <input type="number" wire:model.lazy="items.{{ $index }}.quantity"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                            placeholder="Quantity">
                                        @error('items.' . $index . '.quantity')
                                            <p class="text-red-500 font-semibold">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Item Discount
                                            (%)</label>
                                        <input type="text" wire:model="items.{{ $index }}.discount_percent"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                            placeholder="%">
                                    </div>


                                    <!-- Calculated Totals -->
                                    <div class="text-right pt-2">
                                        <p class="text-xs text-gray-600">Discount:
                                            ₹{{ number_format($item['discount_amount'] ?? 0, 2) }}</p>
                                        <p class="text-sm font-medium text-gray-800">Total:
                                            ₹{{ number_format($item['total'] ?? 0, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <button type="button" wire:click="addItem"
                        class="w-full bg-blue-100 hover:bg-blue-200 text-blue-700 py-2 px-4 rounded-lg border border-blue-200 text-sm font-medium transition">
                        + Add Product
                    </button>
                </div>


                <!-- Notes -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                    <textarea wire:model="notes" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <!-- Summary -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-5">📊 Summary</h3>

                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Subtotal</span>
                            <span class="font-medium text-gray-700">₹{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Discount</span>
                            <span class="font-medium text-green-600">₹{{ number_format($total_discount, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Tax <span class="text-xs text-gray-400">(18%)</span></span>
                            <span class="font-medium text-orange-600">₹{{ number_format($tax, 2) }}</span>
                        </div>

                        <div class="flex justify-between border-t border-gray-100 pt-4 text-base">
                            <span class="font-semibold text-gray-800">Total</span>
                            <span class="font-bold text-blue-600 text-lg">₹{{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <button type="button"
                class="w-full text-white font-semibold bg-green-600 p-2 rounded text-xl">
                update Invoice
            </button>
            
            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
            
            <script>
                document.getElementById('rzp-button').addEventListener('click', function (e) {
                    e.preventDefault();
            
                    let amount = @this.amount_paid;
            
                    // ✅ IF amount is zero, skip Razorpay and directly create invoice
                    if (!amount || amount == 0) {
                        if (confirm("Amount is ₹0. Proceed without payment?")) {
                            @this.call('createInvoice');
                        }
                        return;
                    }
            
                    // ✅ ELSE use Razorpay
                    var options = {
                        "key": "{{ env('RAZORPAY_KEY') }}",
                        "amount": amount * 100, // amount in paise
                        "currency": "INR",
                        "name": "Invoice Payment",
                        "description": "Sales Invoice",
                        "handler": function (response) {
                            @this.call('processPaymentAndCreateInvoice',
                                response.razorpay_payment_id,
                                response.razorpay_order_id,
                                response.razorpay_signature
                            );
                        },
                        "prefill": {
                            "name": "{{ Auth::user()->name ?? 'Guest' }}",
                            "email": "{{ Auth::user()->email ?? 'email@example.com' }}"
                        },
                        "theme": {
                            "color": "#28a745"
                        }
                    };
            
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                });
            </script>
            </form>
        </div>
    </div>
</div>
