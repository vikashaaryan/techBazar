<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 underline">Create Quotation</h1>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <form wire:submit.prevent="createQuote" class="divide-y divide-gray-200">
                @csrf
                
                <!-- Quotation Header Section -->
                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Column - Quotation Details -->
                        <div class="space-y-6">
                            <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Quotation Details
                            </h2>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Quotation Number</label>
                                    <input type="text" wire:model.defer="quotation_no" readonly 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 font-mono">
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Quotation Date</label>
                                        <input type="date" wire:model="quotation_date" value="<?= date('Y-m-d') ?>"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Valid Till</label>
                                        <input type="date" wire:model="valid_date" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <select wire:model="status"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                        <option value="draft">Draft</option>
                                        <option value="sent">Sent</option>
                                        <option value="accepted">Accepted</option>
                                        <option value="rejected">Rejected</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Column - Company Info -->
                        <div class="bg-blue-50 rounded-lg p-6 border border-blue-100">
                            <div class="flex items-center gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 bg-white rounded-lg border-2 border-blue-200 flex items-center justify-center shadow-sm">
                                        <svg class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">TechBazar</h3>
                                    <div class="mt-2 space-y-1 text-sm text-gray-600">
                                        <p>123 Business Street, Purnea</p>
                                        <p>Bihar 854334, India</p>
                                        <p class="font-medium text-gray-700 mt-2">GSTIN: 22ABCDE1234F1Z5</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Customer Section -->
                <div class="p-6 md:p-8 border-t border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center mb-6">
                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Customer Information
                    </h2>
                    
                    <div class="space-y-4">
                        <!-- Customer Search -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                   placeholder="{{ $selectedCustomer ? 'Search different customer...' : 'Search by name or contact...' }}"
                                   class="block w-full pl-10 pr-12 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            
                            @if($selectedCustomer)
                                <button wire:click="clearSelection" class="absolute right-3 top-2.5 text-gray-400 hover:text-red-500">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            @endif
                            
                            @if($isSearching)
                                <div class="absolute right-3 top-2.5">
                                    <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Search Results -->
                        @if($search && count($customers) > 0)
                            <div class="mt-2 bg-white border border-gray-200 rounded-lg shadow-lg max-h-60 overflow-y-auto divide-y divide-gray-100">
                                @foreach($customers as $customer)
                                    <div wire:click="selectCustomer({{ $customer->id }})" class="p-3 hover:bg-blue-50 cursor-pointer flex justify-between items-center">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-medium mr-3">
                                                {{ substr($customer->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-medium">{{ $customer->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $customer->contact }}</p>
                                            </div>
                                        </div>
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                @endforeach
                            </div>
                        @elseif($search && !$isSearching)
                            <div class="mt-2 bg-white border border-gray-200 rounded-lg p-4 text-center">
                                <p class="text-gray-500">No customers found</p>
                            </div>
                        @endif
                        
                        <!-- Selected Customer -->
                        @if($selectedCustomer)
                            <div class="mt-4 bg-green-50 rounded-lg border border-green-100 p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $selectedCustomer->name }}</h4>
                                        <div class="mt-2 space-y-1 text-sm text-gray-600">
                                            <p>{{ $selectedCustomer->email }}</p>
                                            <p>{{ $selectedCustomer->contact }}</p>
                                            <p>{{ $selectedCustomer->address->city ?? '—' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Add Customer Button -->
                        <div class="pt-4">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center">
                                    <span class="px-2 bg-white text-sm text-gray-500">OR</span>
                                </div>
                            </div>
                            
                            <a href="{{ route('customer.create') }}" class="mt-4 block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-2.5 px-4 rounded-lg transition-colors">
                                + Add New Customer
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Products Section -->
                <div class="p-6 md:p-8 border-t border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            Products & Services
                        </h2>
                        <button type="button" wire:click="addItem" class="text-sm bg-blue-600 hover:bg-blue-700 text-white py-1.5 px-3 rounded-lg">
                            + Add Item
                        </button>
                    </div>
                    
                    <div class="space-y-4">
                        @foreach($items as $index => $item)
                            <div wire:key="item-{{ $index }}" class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm relative">
                                <!-- Item Actions -->
                                <div class="absolute left-3 top-3 flex flex-col space-y-2">
                                    <button wire:click="moveItemUp({{ $index }})" class="text-blue-500 hover:text-blue-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                        </svg>
                                    </button>
                                    <button wire:click="moveItemDown({{ $index }})" class="text-blue-500 hover:text-blue-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <button wire:click="removeItem({{ $index }})" class="text-red-500 hover:text-red-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                
                                <!-- Product Form -->
                                <div class="pl-10">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Product Selection -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                                            <select wire:model.live="items.{{ $index }}.product_id" wire:change="productSelected({{ $index }})"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" 
                                                            @if(collect($items)->pluck('product_id')->contains($product->id) && $items[$index]['product_id'] != $product->id) disabled @endif>
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <!-- Quantity -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                            <input type="number" wire:model.lazy="items.{{ $index }}.quantity"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                        </div>
                                        
                                        <!-- Description -->
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                            <textarea wire:model="items.{{ $index }}.description"
                                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm h-20"></textarea>
                                        </div>
                                        
                                        <!-- Price and Discount -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Unit Price</label>
                                            <input type="number" wire:model="items.{{ $index }}.mrp"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Discount (%)</label>
                                            <input type="text" wire:model="items.{{ $index }}.discount"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                        </div>
                                        
                                        <!-- Item Total -->
                                        <div class="md:col-span-2 pt-2">
                                            <div class="flex justify-between items-center border-t border-gray-100 pt-3">
                                                <span class="text-sm text-gray-500">Item Total:</span>
                                                <span class="font-medium">₹{{ number_format($item['total'] ?? 0, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Notes and Summary -->
                <div class="p-6 md:p-8 border-t border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Notes -->
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 flex items-center mb-6">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Notes
                            </h2>
                            <textarea wire:model="notes" rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        
                        <!-- Summary -->
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 flex items-center mb-6">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                                </svg>
                                Summary
                            </h2>
                            
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Subtotal:</span>
                                        <span class="font-medium">₹{{ number_format($subtotal, 2) }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Discount:</span>
                                        <span class="font-medium text-red-500">-₹{{ number_format($total_discount, 2) }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Tax (18%):</span>
                                        <span class="font-medium">₹{{ number_format($tax, 2) }}</span>
                                    </div>
                                    
                                    <div class="pt-3 border-t border-gray-200">
                                        <div class="flex justify-between">
                                            <span class="font-semibold">Total Amount:</span>
                                            <span class="text-lg font-bold text-blue-600">₹{{ number_format($total, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="p-6 md:p-8 border-t border-gray-200">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg shadow-md transition-colors font-medium">
                        Generate Quotation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>














<div class="p-6 md:p-8 border-t border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            Products & Services
                        </h2>
                        <button type="button" wire:click="addItem"
                            class="text-sm bg-blue-600 hover:bg-blue-700 text-white py-1.5 px-3 rounded-lg">
                            + Add Item
                        </button>
                    </div>

                    <div class="space-y-4">
                        @foreach($items as $index => $item)
                            <div wire:key="item-{{ $index }}"
                                class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm relative">
                                <!-- Item Actions -->
                                <div class="absolute left-3 top-3 flex flex-col space-y-2">
                                    <button wire:click="moveItemUp({{ $index }})" class="text-blue-500 hover:text-blue-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 15l7-7 7 7" />
                                        </svg>
                                    </button>
                                    <button wire:click="moveItemDown({{ $index }})"
                                        class="text-blue-500 hover:text-blue-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <button wire:click="removeItem({{ $index }})" class="text-red-500 hover:text-red-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Product Form -->
                                <div class="pl-10">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Product Selection -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                                            <select wire:model.live="items.{{ $index }}.product_id"
                                                wire:change="productSelected({{ $index }})"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}"
                                                        @if(collect($items)->pluck('product_id')->contains($product->id) && $items[$index]['product_id'] != $product->id) disabled @endif>
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Quantity -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                            <input type="number" wire:model.lazy="items.{{ $index }}.quantity"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                        </div>

                                        <!-- Description -->
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                            <textarea wire:model="items.{{ $index }}.description"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm h-20"></textarea>
                                        </div>

                                        <!-- Price and Discount -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Unit Price</label>
                                            <input type="number" wire:model="items.{{ $index }}.mrp"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Discount (%)</label>
                                            <input type="text" wire:model="items.{{ $index }}.discount"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                        </div>

                                        <!-- Item Total -->
                                        <div class="md:col-span-2 pt-2">
                                            <div class="flex justify-between items-center border-t border-gray-100 pt-3">
                                                <span class="text-sm text-gray-500">Item Total:</span>
                                                <span
                                                    class="font-medium">₹{{ number_format($item['total'] ?? 0, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>