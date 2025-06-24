<div class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Invoice</h1>
                <p class="text-sm text-gray-500">Update invoice details and items</p>
            </div>
            <div class="flex gap-3">
                <button class="px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-50">
                    Preview
                </button>
                <button wire:click="updateInvoice" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Save Changes
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">
                <!-- Left Column - Form -->
                <div class="lg:col-span-2 p-6">
                    <form wire:submit.prevent="updateInvoice">
                        <!-- Invoice Header -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Invoice Number</label>
                                <input type="text" wire:model.lazy="invoice_no" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @error('invoice_no') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Invoice Date</label>
                                <input type="date" wire:model.lazy="invoice_date"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @error('invoice_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select wire:model.lazy="status"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="draft">Draft</option>
                                    <option value="sent">Sent</option>
                                    <option value="paid">Paid</option>
                                    <option value="overdue">Overdue</option>
                                </select>
                                @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Customer Section -->
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-lg font-medium text-gray-800">Customer</h3>
                                <button type="button" class="text-sm text-blue-600 hover:text-blue-800">
                                    + Add New Customer
                                </button>
                            </div>
                            <div class="relative">
                                <input type="text" wire:model.live.debounce.300ms="customerSearch"
                                    placeholder="Search customer..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                
                                @if($customerSearch && !$selectedCustomer)
                                <div class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-md border border-gray-300 max-h-60 overflow-auto">
                                    @forelse($customers as $customer)
                                        <div wire:click="selectCustomer({{ $customer->id }})" 
                                            class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                                            <div class="font-medium">{{ $customer->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $customer->email }}</div>
                                        </div>
                                    @empty
                                        <div class="px-4 py-2 text-gray-500">No customers found</div>
                                    @endforelse
                                </div>
                                @endif
                            </div>
                            
                            @if($selectedCustomer)
                            <div class="mt-3 p-3 bg-blue-50 rounded-md border border-blue-100">
                                <div class="flex justify-between">
                                    <div>
                                        <h4 class="font-medium">{{ $selectedCustomer->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $selectedCustomer->email }}</p>
                                        <p class="text-sm text-gray-600">{{ $selectedCustomer->phone }}</p>
                                    </div>
                                    <button wire:click="clearCustomer" type="button" class="text-gray-400 hover:text-red-500">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Items Section -->
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-lg font-medium text-gray-800">Items</h3>
                                <button type="button" wire:click="addItem" 
                                    class="text-sm text-blue-600 hover:text-blue-800">
                                    + Add Item
                                </button>
                            </div>
                            
                            <div class="space-y-4">
                                @foreach($items as $index => $item)
                                <div wire:key="item-{{ $index }}" class="border rounded-md p-4">
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="w-full">
                                            <select wire:model="items.{{ $index }}.product_id" 
                                            wire:change="updateItemPrice({{ $index }})"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                            @error('items.'.$index.'.product_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <button wire:click="removeItem({{ $index }})" 
                                            class="ml-2 text-gray-400 hover:text-red-500">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Quantity</label>
                                            <input type="number" wire:model.lazy="items.{{ $index }}.quantity" wire:change="calculateTotals"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            @error('items.'.$index.'.quantity') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Price</label>
                                            <input type="number" wire:model.lazy="items.{{ $index }}.price" wire:change="calculateTotals"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            @error('items.'.$index.'.price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Discount</label>
                                            <input type="number" wire:model.lazy="items.{{ $index }}.discount" wire:change="calculateTotals"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            @error('items.'.$index.'.discount') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mt-3">
                                        <label class="block text-xs text-gray-500 mb-1">Description</label>
                                        <textarea wire:model.lazy="items.{{ $index }}.description" rows="2"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                    </div>
                                    
                                    <div class="mt-2 text-right font-medium">
                                        Item Total: ₹{{ number_format(($item['quantity'] * $item['price']) - $item['discount'], 2) }}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @error('items') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Notes Section -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                            <textarea wire:model.lazy="notes" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                    </form>
                </div>

                <!-- Right Column - Summary -->
                <div class="bg-gray-50 p-6 border-l">
                    <!-- Company Info -->
                    <div class="mb-6">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium">Your Business</h3>
                        </div>
                        <div class="text-sm text-gray-600 space-y-1">
                            <p>123 Business Street</p>
                            <p>Purnea, Bihar 854334</p>
                            <p>GSTIN: 22ABCDE1234F1Z5</p>
                            <p>Phone: +91 9876543210</p>
                        </div>
                    </div>

                    <!-- Payment Details -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-3">Payment Details</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm text-gray-500 mb-1">Payment Method</label>
                                <select wire:model.lazy="payment_method"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="cash">Cash</option>
                                    <option value="card">Credit Card</option>
                                    <option value="bank">Bank Transfer</option>
                                    <option value="upi">UPI</option>
                                </select>
                                @error('payment_method') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm text-gray-500 mb-1">Payment Status</label>
                                <select wire:model.lazy="payment_status"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="paid">Paid</option>
                                    <option value="partial">Partial</option>
                                    <option value="due">Due</option>
                                </select>
                                @error('payment_status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm text-gray-500 mb-1">Due Date</label>
                                <input type="date" wire:model.lazy="due_date"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @error('due_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm text-gray-500 mb-1">Amount Paid</label>
                                <input type="number" wire:model.lazy="amount_paid" wire:change="calculateTotals"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @error('amount_paid') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="border-t pt-4">
                        <h3 class="text-lg font-medium mb-3">Summary</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal:</span>
                                <span>₹{{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tax (18%):</span>
                                <span>₹{{ number_format($tax, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Discount:</span>
                                <span>-₹{{ number_format($discount, 2) }}</span>
                            </div>
                            <div class="flex justify-between font-medium text-base pt-2 border-t">
                                <span>Total:</span>
                                <span>₹{{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-blue-600 pt-1">
                                <span>Amount Due:</span>
                                <span>₹{{ number_format($amount_due, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>