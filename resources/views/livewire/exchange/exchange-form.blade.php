<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Create New Exchange/Return</h1>
        <a href="{{ route('exchange.view') }}" class="text-gray-600 hover:text-gray-900">
            Back to List
        </a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <form wire:submit.prevent="submit">
            <!-- Transaction Type Section -->
            <div class="mb-8 p-4 border rounded-lg">
                <h2 class="text-lg font-semibold mb-4">Transaction Type</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Transaction Type</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" wire:model="type" value="exchange" class="form-radio">
                                <span class="ml-2">Exchange</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" wire:model="type" value="return" class="form-radio">
                                <span class="ml-2">Return</span>
                            </label>
                        </div>
                        @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Return Type</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" wire:model="return_type" value="sale_return" class="form-radio">
                                <span class="ml-2">Sale Return</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" wire:model="return_type" value="purchase_return" class="form-radio">
                                <span class="ml-2">Purchase Return</span>
                            </label>
                        </div>
                        @error('return_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Reference Information -->
            <div class="mb-8 p-4 border rounded-lg">
                <h2 class="text-lg font-semibold mb-4">Reference Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Invoice Number</label>
                        <input type="text" wire:model="invoice_id" class="w-full border rounded px-3 py-2" placeholder="INV-2023-001">
                        @error('invoice_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    @if($return_type === 'sale_return')
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Sale Reference</label>
                            <select wire:model="sale_id" class="w-full border rounded px-3 py-2">
                                <option value="">Select Sale</option>
                                @foreach($sales as $sale)
                                    <option value="{{ $sale->id }}">SALE-{{ $sale->id }} ({{ $sale->customer->name }})</option>
                                @endforeach
                            </select>
                            @error('sale_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    @endif
                    
                    @if($return_type === 'purchase_return')
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Purchase Reference</label>
                            <select wire:model="purchase_id" class="w-full border rounded px-3 py-2">
                                <option value="">Select Purchase</option>
                                @foreach($purchases as $purchase)
                                    <option value="{{ $purchase->id }}">PO-{{ $purchase->id }} ({{ $purchase->supplier->supplier_name }})</option>
                                @endforeach
                            </select>
                            @error('purchase_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    @endif
                </div>
            </div>

            <!-- Customer/Supplier Information -->
            <div class="mb-8 p-4 border rounded-lg">
                <h2 class="text-lg font-semibold mb-4">Party Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($return_type === 'sale_return')
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Customer</label>
                            <select wire:model="customer_id" class="w-full border rounded px-3 py-2">
                                <option value="">Select Customer</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }} (Customer #{{ $customer->id }})</option>
                                @endforeach
                            </select>
                            @error('customer_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    @endif
                    
                    @if($return_type === 'purchase_return')
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Supplier</label>
                            <select wire:model="supplier_id" class="w-full border rounded px-3 py-2">
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                @endforeach
                            </select>
                            @error('supplier_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    @endif
                </div>
            </div>

            <!-- Items Section -->
            <div class="mb-8 p-4 border rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Items</h2>
                    <button type="button" wire:click="addItem" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                        Add Item
                    </button>
                </div>
                
                <div id="items-container">
                    @foreach($items as $index => $item)
                        <div class="item-row mb-4 p-4 border rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-3">
                                <div>
                                    <label class="block text-gray-700 text-sm font-medium mb-1">Product</label>
                                    <select wire:model="items.{{ $index }}.product_id" class="w-full border rounded px-2 py-1 text-sm">
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
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
                                @if($type === 'exchange')
                                    <div>
                                        <label class="block text-gray-700 text-sm font-medium mb-1">Replacement Product</label>
                                        <select wire:model="items.{{ $index }}.replacement_product_id" class="w-full border rounded px-2 py-1 text-sm">
                                            <option value="">Select Replacement</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
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
                                    <button type="button" wire:click="removeItem({{ $index }})" class="remove-item text-red-500 hover:text-red-700 text-sm">
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
                        <textarea wire:model="reasons" rows="3" class="w-full border rounded px-3 py-2" placeholder="Provide detailed reasons for the exchange/return"></textarea>
                        @error('reasons') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Notes</label>
                        <textarea wire:model="notes" rows="2" class="w-full border rounded px-3 py-2" placeholder="Any additional notes"></textarea>
                        @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Refund Method</label>
                            <select wire:model="refund_method" class="w-full border rounded px-3 py-2">
                                <option value="">Select Method</option>
                                <option value="cash">Cash</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="store_credit">Store Credit</option>
                                <option value="exchange">Exchange</option>
                            </select>
                            @error('refund_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Return Date</label>
                            <input type="date" wire:model="return_date" class="w-full border rounded px-3 py-2">
                            @error('return_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                    Submit Exchange/Return
                </button>
            </div>
        </form>
    </div>
</div>