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
                                        <input type="text" wire:model.defer="invoice_no" readonly
                                            class="w-44 text-right px-3 py-2 border border-gray-300 rounded-md bg-gray-50 font-mono text-sm focus:outline-none">
                                    </div>

                                    <!-- Invoice Date -->
                                    <div class="flex items-center justify-between">
                                        <label class="text-sm font-medium text-gray-700">Date</label>
                                        <input type="date" value="<?= date('Y-m-d') ?>"
                                            class="w-44 px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
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
                        <div class="p-6 space-y-5">
                            <!-- Search Section -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" wire:model.live.debounce.300ms="search"
                                    placeholder="{{ $selectedCustomer ? 'Search different customer...' : 'Search by name or contact...' }}"
                                    class="block w-full pl-10 pr-12 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                @error('selectedCustomer')
                                    <p class="font-semibold text-red-500">{{ $message }}</p>
                                @enderror

                                <!-- Clear/Loading Indicators -->
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    @if ($selectedCustomer)
                                        <button wire:click="clearSelection"
                                            class="text-gray-400 hover:text-red-500 transition-colors">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    @else
                                        <div wire:loading.delay.shortest wire:target="search">
                                            <svg class="animate-spin h-5 w-5 text-blue-500"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Search Results -->
                            @if ($search && count($customers) > 0)
                                <div
                                    class="mt-2 bg-white border border-gray-200 rounded-lg shadow-lg max-h-60 overflow-y-auto divide-y divide-gray-100">
                                    @foreach ($customers as $customer)
                                        <div wire:click="selectCustomer({{ $customer->id }})"
                                            class="p-3 hover:bg-blue-50 cursor-pointer flex justify-between items-center transition-colors duration-150">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-medium">
                                                    {{ substr($customer->name, 0, 1) }}
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900">{{ $customer->name }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">{{ $customer->contact }}</p>
                                                </div>
                                            </div>
                                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                    @endforeach
                                </div>
                            @elseif($search && count($customers) === 0)
                                <div class="mt-2 bg-white border border-gray-200 rounded-lg shadow-lg p-4 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h4 class="mt-2 text-sm font-medium text-gray-700">No customer found</h4>
                                    <p class="mt-1 text-xs text-gray-500">We couldn't find any customer matching
                                        "{{ $search }}"</p>
                                </div>
                            @endif

                            <!-- Selected Customer -->
                            @if ($selectedCustomer)
                                <div
                                    class="mt-4 bg-white rounded-lg border border-green-100 overflow-hidden shadow-sm">
                                    <div class="bg-green-50 px-4 py-2 border-b border-green-100">
                                        <h4 class="text-sm font-medium text-green-800 flex items-center">
                                            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Selected Customer
                                        </h4>
                                    </div>
                                    <div class="p-4">
                                        <div class="flex items-start">
                                            <div
                                                class="flex-shrink-0 h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-medium text-lg">
                                                {{ substr($selectedCustomer->name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <h4 class="text-base font-semibold text-gray-900">
                                                    {{ $selectedCustomer->name }}
                                                </h4>
                                                <div class="mt-2 grid grid-cols-2 gap-x-4 gap-y-1 text-sm">
                                                    <div class="flex items-center">
                                                        <svg class="flex-shrink-0 h-4 w-4 text-gray-400"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                        </svg>
                                                        <span
                                                            class="ml-2 text-gray-600">{{ $selectedCustomer->email }}</span>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <svg class="flex-shrink-0 h-4 w-4 text-gray-400"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                        </svg>
                                                        <span
                                                            class="ml-2 text-gray-600">{{ $selectedCustomer->contact }}</span>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <svg class="flex-shrink-0 h-4 w-4 text-gray-400"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                        <span
                                                            class="ml-2 text-gray-600">{{ $selectedCustomer->address->city ?? 'Not specified' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Add Customer CTA -->
                            <div class="pt-2">
                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                        <div class="w-full border-t border-gray-300"></div>
                                    </div>
                                    <div class="relative flex justify-center">
                                        <span class="px-2 bg-white text-sm text-gray-500">OR</span>
                                    </div>
                                </div>

                                <a wire:navigate href="{{ route('customer.create') }}"
                                    class="mt-4 w-full inline-flex justify-center items-center px-4 py-2.5  text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-150">
                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Add New Customer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Section -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-800">Products & Services</h3>

                    @foreach ($items as $index => $item)
                        <div wire:key="item-{{ $index }}"
                            class="border border-gray-300 rounded-xl p-4 bg-white shadow-sm relative">

                            <!-- Up/Down/Delete Buttons -->
                            <div class="absolute left-2 top-4 flex flex-col space-y-2">
                                <button wire:click="moveItemUp({{ $index }})"
                                    class="text-blue-500 hover:text-blue-700">
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
                                <button wire:click="removeItem({{ $index }})"
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
                                                    @if (collect($items)->pluck('product_id')->contains($product->id) && $items[$index]['product_id'] != $product->id) disabled @endif>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('items.*.product_id')
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
                                        @error('items.*.quantity')
                                            <p class="text-red-500 font-semibold">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Item Discount
                                            (%)</label>
                                        <input type="text" wire:model="items.{{ $index }}.discount"
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


                <!-- Payment Section -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-5">💳 Payment Details</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                            <select wire:model.live="method"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="cash">Cash</option>
                                <option value="card">Card</option>
                                <option value="upi">UPI</option>
                                <option value="bank">Bank Transfer</option>
                                <option value="mixed">Mixed</option>
                            </select>
                            @error('method')
                                <p class="text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Payment Status</label>
                            <select wire:model.live="payment_status"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="paid">Paid</option>
                                <option value="partial">Partial</option>
                                <option value="due">Due</option>
                            </select>
                            @error('payment_status')
                                <p class="text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                            <input type="date" wire:model.live="due_date"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('due_date')
                                <p class="text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Amount Paid</label>
                            <input type="number" wire:model.live="amount_paid" wire:key="amount_paid"
                                placeholder="₹0.00"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('amount_paid')
                                <p class="text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>


                <button id="rzp-button" type="button"
                    class="w-full text-white font-semibold bg-green-600 p-2 rounded text-xl">
                    Pay & Generate Invoice
                </button>
                <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                <script>
                    document.getElementById('rzp-button').addEventListener('click', function(e) {
                        e.preventDefault();

                        let amount = @this.amount_paid;
                        if (!amount || amount <= 0) {
                            alert('Please enter a valid amount');
                            return;
                        }

                        var options = {
                            "key": "{{ env('RAZORPAY_KEY') }}",
                            "amount": amount * 100,
                            "currency": "INR",
                            "name": "Invoice Payment",
                            "description": "Sales Invoice",
                            "handler": function(response) {
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
