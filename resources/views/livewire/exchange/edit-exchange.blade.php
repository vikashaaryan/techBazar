<div class="container mx-auto px-4 mt-10 py-8 max-w-6xl">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <div class="flex items-center">
                <h1 class="text-2xl font-bold text-gray-800 mr-3">Edit Exchange/Return</h1>
                <span class="px-3 py-1 rounded-full text-xs font-medium 
                    @if($exchange->status === 'completed') bg-green-100 text-green-800
                    @elseif($exchange->status === 'approved') bg-blue-100 text-blue-800
                    @elseif($exchange->status === 'rejected') bg-red-100 text-red-800
                    @elseif($exchange->status === 'processed') bg-yellow-100 text-yellow-800
                    @else bg-gray-100 text-gray-800 @endif">
                    {{ ucfirst($exchange->status) }}
                </span>
            </div>
            <div class="flex items-center mt-2 space-x-4">
                <p class="text-sm text-gray-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                    </svg>
                    Created: {{ $exchange->created_at->format('M d, Y h:i A') }}
                </p>
                <p class="text-sm text-gray-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                    </svg>
                    Serial: {{ $exchange->serial_no }}
                </p>
            </div>
        </div>
        <a href="{{ route('exchange.view') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to List
        </a>
    </div>

    <!-- Status Action Bar -->
    @if(in_array($exchange->status, ['requested', 'approved', 'processed']))
    <div class="mb-6 bg-white shadow rounded-lg overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
            <h3 class="text-sm font-medium text-gray-700">Process Request</h3>
        </div>
        <div class="px-4 py-3 flex justify-between items-center">
            <div class="flex space-x-3">
                @if($exchange->status === 'requested')
                    <button wire:click="updateStatus('approved')" type="button" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Approve Request
                    </button>
                    <button wire:click="updateStatus('rejected')" type="button" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Reject Request
                    </button>
                @elseif($exchange->status === 'approved')
                    <button wire:click="updateStatus('processed')" type="button" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        Mark as Processed
                    </button>
                @elseif($exchange->status === 'processed')
                    <button wire:click="updateStatus('completed')" type="button" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Complete Transaction
                    </button>
                @endif
            </div>
            <div class="text-sm text-gray-500">
                Last updated: {{ $exchange->updated_at->format('M d, Y h:i A') }}
            </div>
        </div>
    </div>
    @endif

    <!-- Main Form -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <form wire:submit.prevent="update">
            @csrf

            <!-- Transaction Type Section -->
            <div class="p-6 border-b">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <span class="bg-blue-100 text-blue-800 p-2 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    Transaction Details
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Transaction Type</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="flex flex-col items-center p-3 border-2 rounded-lg cursor-pointer transition-colors duration-200
                                    @if($exchange->type === 'exchange') border-blue-500 bg-blue-50 @else border-gray-200 hover:border-blue-300 @endif">
                                    <input type="radio" wire:model="exchange.type" value="exchange" class="form-radio h-5 w-5 text-blue-600">
                                    <span class="mt-1 font-medium">Exchange</span>
                                </label>
                                <label class="flex flex-col items-center p-3 border-2 rounded-lg cursor-pointer transition-colors duration-200
                                    @if($exchange->type === 'return') border-blue-500 bg-blue-50 @else border-gray-200 hover:border-blue-300 @endif">
                                    <input type="radio" wire:model="exchange.type" value="return" class="form-radio h-5 w-5 text-blue-600">
                                    <span class="mt-1 font-medium">Return</span>
                                </label>
                            </div>
                            @error('exchange.type') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Return Type</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex flex-col items-center p-3 border-2 rounded-lg cursor-pointer transition-colors duration-200
                                @if($exchange->return_type === 'sale_return') border-blue-500 bg-blue-50 @else border-gray-200 hover:border-blue-300 @endif">
                                <input type="radio" wire:model="exchange.return_type" value="sale_return" class="form-radio h-5 w-5 text-blue-600">
                                <span class="mt-1 font-medium">Sale Return</span>
                            </label>
                            <label class="flex flex-col items-center p-3 border-2 rounded-lg cursor-pointer transition-colors duration-200
                                @if($exchange->return_type === 'purchase_return') border-blue-500 bg-blue-50 @else border-gray-200 hover:border-blue-300 @endif">
                                <input type="radio" wire:model="exchange.return_type" value="purchase_return" class="form-radio h-5 w-5 text-blue-600">
                                <span class="mt-1 font-medium">Purchase Return</span>
                            </label>
                        </div>
                        @error('exchange.return_type') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Reference Information -->
            <div class="p-6 border-b">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <span class="bg-blue-100 text-blue-800 p-2 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    Reference Information
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Invoice Number</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">INV-</span>
                            </div>
                            <input type="text" wire:model="exchange.invoice_id" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 sm:text-sm border-gray-300 rounded-md" placeholder="2023-001">
                        </div>
                        @error('exchange.invoice_id') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    @if($exchange->return_type === 'sale_return')
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
                            <div class="mt-1 relative">
                                <select wire:model="exchange.customer_id" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" @if($customer->id == $exchange->customer_id) selected @endif>
                                            {{ $customer->name }} ({{ $customer->contact }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('exchange.customer_id') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    @else
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Supplier</label>
                            <div class="mt-1 relative">
                                <select wire:model="exchange.supplier_id" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    <option value="">Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" @if($supplier->id == $exchange->supplier_id) selected @endif>
                                            {{ $supplier->supplier_name }} ({{ $supplier->company }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('exchange.supplier_id') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    @endif
                </div>
            </div>

            <!-- Items Section -->
            <div class="p-6 border-b">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                        <span class="bg-blue-100 text-blue-800 p-2 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        Items
                    </h2>
                    <button type="button" wire:click="addItem" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add Item
                    </button>
                </div>
                
                <div id="items-container" class="space-y-4">
                    @foreach($items as $index => $item)
                        <div class="item-row p-5 border rounded-lg bg-gray-50">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-sm font-medium text-gray-700">Item #{{ $index + 1 }}</h3>
                                @if(count($items) > 1)
                                    <button type="button" wire:click="removeItem({{ $index }})" class="text-red-600 hover:text-red-900 text-sm flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        Remove
                                    </button>
                                @endif
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                                    <select wire:model="items.{{ $index }}.product_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" @if($product->id == $item['product_id']) selected @endif>
                                                {{ $product->name }} ({{ $product->sku }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('items.'.$index.'.product_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                    <input type="number" wire:model="items.{{ $index }}.quantity" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" min="1">
                                    @error('items.'.$index.'.quantity') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Refund Amount</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">$</span>
                                        </div>
                                        <input type="number" step="0.01" wire:model="items.{{ $index }}.refund_amount" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                                    </div>
                                    @error('items.'.$index.'.refund_amount') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Condition</label>
                                    <select wire:model="items.{{ $index }}.condition" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                        <option value="new" @if($item['condition'] === 'new') selected @endif>New</option>
                                        <option value="opened" @if($item['condition'] === 'opened') selected @endif>Opened</option>
                                        <option value="used" @if($item['condition'] === 'used') selected @endif>Used</option>
                                        <option value="damaged" @if($item['condition'] === 'damaged') selected @endif>Damaged</option>
                                        <option value="defective" @if($item['condition'] === 'defective') selected @endif>Defective</option>
                                    </select>
                                    @error('items.'.$index.'.condition') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Reason</label>
                                    <input type="text" wire:model="items.{{ $index }}.reason" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Reason for return">
                                    @error('items.'.$index.'.reason') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                @if($exchange->type === 'exchange')
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Replacement Product</label>
                                        <select wire:model="items.{{ $index }}.replacement_product_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                            <option value="">Select Replacement</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" @if($product->id == ($item['replacement_product_id'] ?? '')) selected @endif>
                                                    {{ $product->name }} ({{ $product->sku }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('items.'.$index.'.replacement_product_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Price Difference</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">$</span>
                                            </div>
                                            <input type="number" step="0.01" wire:model="items.{{ $index }}.replacement_price_diff" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
                                        </div>
                                        @error('items.'.$index.'.replacement_price_diff') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Additional Information -->
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <span class="bg-blue-100 text-blue-800 p-2 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                        </svg>
                    </span>
                    Additional Information
                </h2>
                
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Reasons (Detailed)</label>
                        <div class="mt-1">
                            <textarea wire:model="exchange.reasons" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Provide detailed reasons for the exchange/return"></textarea>
                        </div>
                        @error('exchange.reasons') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                        <div class="mt-1">
                            <textarea wire:model="exchange.notes" rows="2" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Any additional notes"></textarea>
                        </div>
                        @error('exchange.notes') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select wire:model="exchange.status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                <option value="requested" @if($exchange->status === 'requested') selected @endif>Requested</option>
                                <option value="approved" @if($exchange->status === 'approved') selected @endif>Approved</option>
                                <option value="processed" @if($exchange->status === 'processed') selected @endif>Processed</option>
                                <option value="completed" @if($exchange->status === 'completed') selected @endif>Completed</option>
                                <option value="rejected" @if($exchange->status === 'rejected') selected @endif>Rejected</option>
                            </select>
                            @error('exchange.status') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Refund Method</label>
                            <select wire:model="exchange.refund_method" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                <option value="">Select Method</option>
                                <option value="cash" @if($exchange->refund_method === 'cash') selected @endif>Cash</option>
                                <option value="credit_card" @if($exchange->refund_method === 'credit_card') selected @endif>Credit Card</option>
                                <option value="store_credit" @if($exchange->refund_method === 'store_credit') selected @endif>Store Credit</option>
                                <option value="exchange" @if($exchange->refund_method === 'exchange') selected @endif>Exchange</option>
                            </select>
                            @error('exchange.refund_method') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Return Date</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="date" wire:model="exchange.return_date" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            @error('exchange.return_date') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Footer -->
            <div class="bg-gray-50 px-6 py-4 border-t flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    @if($exchange->updated_at)
                        Last saved: {{ $exchange->updated_at->format('M d, Y h:i A') }}
                    @endif
                </div>
                <div class="flex space-x-3">
                    <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </button>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Update Exchange/Return
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>