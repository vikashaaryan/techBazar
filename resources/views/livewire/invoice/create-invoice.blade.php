<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 underline">Invoice</h1>
        </div>

        <div class="lg:col-span-2 p-6 md:p-8">
            <form wire:submit.prevent="createInvoice" class="space-y-6">
                @csrf
                <!-- Invoice Header Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Invoice Details Column -->
                        <div class="md:w-1/2 space-y-4">
                            <div class="flex items-center justify-between pb-4">
                                <h2 class="text-xl font-semibold text-gray-800">Invoice Details</h2>
                            </div>

                            <div class="grid grid-cols-1 gap-4">
                                <!-- Invoice Number -->
                                <div class="flex items-center justify-between">
                                    <label class="text-sm font-medium text-gray-600">Invoice #</label>
                                    <div class="flex items-center gap-2">
                                        <input type="text" wire:model.defer="invoice_no" readonly
                                           class="w-40 px-3 py-2 border-b border-gray-300 text-right font-mono font-medium focus:outline-none appearance-none">
                                    </div>
                                </div>

                                <!-- Invoice Date -->
                                <div class="flex items-center justify-between">
                                    <label class="text-sm font-medium text-gray-600">Date</label>
                                    <input type="date" wire:model="invoice_date" value="<?= date('Y-m-d')?>"
                                        class="w-40 px-3 py-2 border-b border-gray-300 focus:outline-none focus:border-blue-500">
                                </div>

                                <!-- Status Selector -->
                                <div class="flex items-center justify-between">
                                    <label class="text-sm font-medium text-gray-600">Status</label>
                                    <select wire:model="status"
                                        class="w-40 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                        <option value="draft">Draft</option>
                                        <option value="sent" selected>Sent</option>
                                        <option value="accepted">Accepted</option>
                                        <option value="rejected">Rejected</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Business Info Column -->
                        <div class="md:w-1/2">
                            <div
                                class="h-full flex flex-col justify-between border border-blue-50 bg-blue-50 rounded-lg p-4">
                                <div class="flex items-center gap-4">
                                    <!-- Logo Area -->
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-16 h-16 bg-white rounded-lg border-2 border-dashed border-blue-200 flex items-center justify-center overflow-hidden">
                                            <svg class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Business Info -->
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800">TechBazar</h3>
                                        <p class="text-xs text-gray-600 mt-1">123 Business Street, Purnea</p>
                                        <p class="text-xs text-gray-600">Bihar 854334, India</p>
                                        <p class="text-xs font-medium text-gray-700 mt-2">GSTIN: 22ABCDE1234F1Z5</p>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer Section -->
                <div class="space-y-4">
                    <div class="border border-gray-200 rounded-lg p-4 bg-blue-50">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Customer Information</h3>

                        <!-- Customer Search -->
                        <div class="relative">
                            <input type="text" wire:model.live.debounce.10ms="search"
                                placeholder="{{ $selectedCustomer ? 'Search again...' : 'Search Customer...' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">

                            <!-- Clear Button -->
                            @if($selectedCustomer)
                                <button wire:click="clearSelection"
                                    class="absolute right-3 top-2.5 text-gray-400 hover:text-red-500 transition-colors">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            @endif

                            <!-- Loading Indicator -->
                            <div wire:loading.delay.shortest wire:target="search" class="absolute right-3 top-2.5">
                                <svg class="animate-spin h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <!-- Search Results -->
                        @if($search && count($customers) > 0)
                            <div class="mt-2 bg-white border border-gray-200 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                @foreach($customers as $customer)
                                    <div wire:click="selectCustomer({{ $customer->id }})"
                                        class="p-3 hover:bg-gray-100 cursor-pointer flex justify-between items-center border-b border-gray-100 last:border-0">
                                        <span class="font-medium">{{ $customer->name }}</span>
                                        <span class="text-xs text-gray-500">{{ $customer->contact }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Selected Customer -->
                        @if($selectedCustomer)
                            <div class="mt-4 p-3 bg-teal-50 rounded-lg border border-teal-100">
                                <div class="flex justify-between">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $selectedCustomer->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $selectedCustomer->email }}</p>
                                        <p class="text-sm text-gray-600">{{ $selectedCustomer->contact }}</p>
                                        <p class="text-sm text-gray-600">
                                            {{ $selectedCustomer->address->city ?? '—' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Add Customer Button -->
                        <div class="flex items-center my-3">
                            <div class="flex-grow border-t border-gray-300"></div>
                            <span class="mx-3 text-gray-500 text-sm">OR</span>
                            <div class="flex-grow border-t border-gray-300"></div>
                        </div>

                        <a wire:navigate href="{{ route('customer.create') }}"
                            class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-lg transition-colors">
                            + Add New Customer
                        </a>
                    </div>
                </div>

                <!-- Products Section -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900">Products & Services</h3>

                    @foreach($items as $index => $item)
                        <div wire:key="item-{{ $index }}" class="border border-gray-200 rounded-lg p-4 shadow-sm">
                            <div class="flex gap-4">
                                <!-- Remove Button -->
                                <button wire:click.prevent="removeItem({{ $index }})"
                                    class="text-gray-400 hover:text-red-500 transition-colors mt-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>

                                <!-- Product Details -->
                                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <select wire:model.live="items.{{ $index }}.product_id"
                                            wire:change="productSelected({{ $index }})"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Select Product</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    @if(collect($items)->pluck('product_id')->contains($product->id) && $items[$index]['product_id'] != $product->id) disabled @endif>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <textarea wire:model="items.{{ $index }}.description" placeholder="Description"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 h-20"></textarea>

                                        <input type="number" wire:model="items.{{ $index }}.mrp" placeholder="MRP"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <div class="space-y-2">
                                        <input type="number" wire:model.lazy="items.{{ $index }}.quantity"
                                            placeholder="Quantity"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">

                                        <input type="text" wire:model="items.{{ $index }}.discount" placeholder="Discount"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">

                                        <div class="pt-2 space-y-1 text-right">
                                            <p class="text-sm text-gray-600">Discount:
                                                ₹{{ number_format($item['discount_amount'] ?? 0, 2) }}</p>
                                            <p class="text-sm font-medium">Total:
                                                ₹{{ number_format($item['total'] ?? 0, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <button type="button" wire:click="addItem"
                        class="w-full bg-blue-100 hover:bg-blue-200 text-blue-700 py-2 px-4 rounded-lg border border-blue-200 transition-colors">
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
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Summary</h3>

                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="font-medium">₹{{ number_format($subtotal, 2) }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-600">Discount:</span>
                            <span class="font-medium">₹{{ number_format($total_discount, 2) }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax (18%):</span>
                            <span class="font-medium">₹{{ number_format($tax, 2) }}</span>
                        </div>

                        <div class="flex justify-between pt-2 border-t border-gray-200">
                            <span class="text-gray-900 font-medium">Total:</span>
                            <span class="text-blue-600 font-bold">₹{{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Section -->
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Details</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Method</label>
                            <select wire:model.live="method"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="cash">Cash</option>
                                <option value="card">Card</option>
                                <option value="upi">UPI</option>
                                <option value="bank">Bank Transfer</option>
                                <option value="mixed">Mixed</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select wire:model.live="payment_status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="paid">Paid</option>
                                <option value="partial">Partial</option>
                                <option value="due">Due</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                            <input type="date" wire:model.live="due_date"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Amount Paid</label>
                            <input type="text" wire:model.live="amount_paid"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg shadow-md transition-colors font-medium">
                    Generate Invoice
                </button>
            </form>
        </div>
    </div>
</div>