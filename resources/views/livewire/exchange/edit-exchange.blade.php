<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Exchange/Return</h1>
            <p class="text-sm text-gray-500">Serial: {{ $exchange->serial_no }}</p>
        </div>
        <a href="{{ route('exchange.view') }}" class="text-gray-600 hover:text-gray-900 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to List
        </a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <form wire:submit.prevent="update">
            @csrf

            <!-- Transaction Type Section -->
            <div class="mb-8 p-4 border rounded-lg bg-gray-50">
                <h2 class="text-lg font-semibold mb-4">Transaction Type</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Transaction Type</label>
                        <div class="space-y-2">
                            <label class="flex items-center space-x-3">
                                <input type="radio" wire:model="exchange.type" value="exchange" class="form-radio h-5 w-5 text-blue-600">
                                <span class="text-gray-700">Exchange</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="radio" wire:model="exchange.type" value="return" class="form-radio h-5 w-5 text-blue-600">
                                <span class="text-gray-700">Return</span>
                            </label>
                        </div>
                        @error('exchange.type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Return Type</label>
                        <div class="space-y-2">
                            <label class="flex items-center space-x-3">
                                <input type="radio" wire:model="exchange.return_type" value="sale_return" class="form-radio h-5 w-5 text-blue-600">
                                <span class="text-gray-700">Sale Return</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="radio" wire:model="exchange.return_type" value="purchase_return" class="form-radio h-5 w-5 text-blue-600">
                                <span class="text-gray-700">Purchase Return</span>
                            </label>
                        </div>
                        @error('exchange.return_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Reference Information -->
            <div class="mb-8 p-4 border rounded-lg">
                <h2 class="text-lg font-semibold mb-4">Reference Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Invoice Number</label>
                        <input type="text" wire:model="exchange.invoice_id" class="w-full border rounded px-3 py-2">
                        @error('exchange.invoice_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    @if($exchange->return_type === 'sale_return')
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Customer</label>
                            <select wire:model="exchange.customer_id" class="w-full border rounded px-3 py-2">
                              
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" @if($customer->id == $exchange->customer_id) selected @endif>
                                        {{ $customer->name }} ({{ $customer->contact }})
                                    </option>
                                @endforeach
                            </select>
                            @error('exchange.customer_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    @else
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Supplier</label>
                            <select wire:model="exchange.supplier_id" class="w-full border rounded px-3 py-2">
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" @if($supplier->id == $exchange->supplier_id) selected @endif>
                                        {{ $supplier->supplier_name }} ({{ $supplier->company }})
                                    </option>
                                @endforeach
                            </select>
                            @error('exchange.supplier_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    @endif
                </div>
            </div>

            <!-- Items Section -->
            <div class="mb-8 p-4 border rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Items</h2>
                    <button type="button" wire:click="addItem" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add Item
                    </button>
                </div>
                
                <div id="items-container">
                    @foreach($items as $index => $item)
                        <div class="item-row mb-4 p-4 border rounded-lg bg-gray-50">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-3">
                                <div>
                                    <label class="block text-gray-700 text-sm font-medium mb-1">Product</label>
                                    <select wire:model="items.{{ $index }}.product_id" class="w-full border rounded px-2 py-1 text-sm">
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->sku }})</option>
                                        @endforeach
                                    </select>
                                    @error('items.'.$index.'.product_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-sm font-medium mb-1">Quantity</label>
                                    <input type="number" wire:model="items.{{ $index }}.quantity" class="w-full border rounded px-2 py-1 text-sm" min="1">
                                    @error('items.'.$index.'.quantity') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-sm font-medium mb-1">Refund Amount</label>
                                    <input type="number" step="0.01" wire:model="items.{{ $index }}.refund_amount" class="w-full border rounded px-2 py-1 text-sm" placeholder="0.00">
                                    @error('items.'.$index.'.refund_amount') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-sm font-medium mb-1">Condition</label>
                                    <select wire:model="items.{{ $index }}.condition" class="w-full border rounded px-2 py-1 text-sm">
                                        <option value="new">New</option>
                                        <option value="opened">Opened</option>
                                        <option value="used">Used</option>
                                        <option value="damaged">Damaged</option>
                                        <option value="defective">Defective</option>
                                    </select>
                                    @error('items.'.$index.'.condition') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-gray-700 text-sm font-medium mb-1">Reason</label>
                                    <input type="text" wire:model="items.{{ $index }}.reason" class="w-full border rounded px-2 py-1 text-sm" placeholder="Reason for return">
                                    @error('items.'.$index.'.reason') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                @if($exchange->type === 'exchange')
                                    <div>
                                        <label class="block text-gray-700 text-sm font-medium mb-1">Replacement Product</label>
                                        <select wire:model="items.{{ $index }}.replacement_product_id" class="w-full border rounded px-2 py-1 text-sm">
                                            <option value="">Select Replacement</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->sku }})</option>
                                            @endforeach
                                        </select>
                                        @error('items.'.$index.'.replacement_product_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 text-sm font-medium mb-1">Price Difference</label>
                                        <input type="number" step="0.01" wire:model="items.{{ $index }}.replacement_price_diff" class="w-full border rounded px-2 py-1 text-sm" placeholder="0.00">
                                        @error('items.'.$index.'.replacement_price_diff') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                @endif
                            </div>
                            
                            <div class="mt-3 flex justify-end">
                                @if(count($items) > 1)
                                    <button type="button" wire:click="removeItem({{ $index }})" class="remove-item text-red-500 hover:text-red-700 text-sm flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        Remove
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Additional Information -->
            <div class="mb-8 p-4 border rounded-lg">
                <h2 class="text-lg font-semibold mb-4">Additional Information</h2>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Reasons (Detailed)</label>
                        <textarea wire:model="exchange.reasons" rows="3" class="w-full border rounded px-3 py-2"></textarea>
                        @error('exchange.reasons') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Notes</label>
                        <textarea wire:model="exchange.notes" rows="2" class="w-full border rounded px-3 py-2" placeholder="Any additional notes"></textarea>
                        @error('exchange.notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Status</label>
                            <select wire:model="exchange.status" class="w-full border rounded px-3 py-2">
                                <option value="requested">Requested</option>
                                <option value="approved">Approved</option>
                                <option value="processed">Processed</option>
                                <option value="completed">Completed</option>
                                <option value="rejected">Rejected</option>
                            </select>
                            @error('exchange.status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Refund Method</label>
                            <select wire:model="exchange.refund_method" class="w-full border rounded px-3 py-2">
                                <option value="">Select Method</option>
                                <option value="cash">Cash</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="store_credit">Store Credit</option>
                                <option value="exchange">Exchange</option>
                            </select>
                            @error('exchange.refund_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Return Date</label>
                            <input type="date" wire:model="exchange.return_date" class="w-full border rounded px-3 py-2">
                            @error('exchange.return_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Update Exchange/Return
                </button>
            </div>
        </form>
    </div>
</div>