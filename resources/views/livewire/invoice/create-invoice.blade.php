<div class="min-h-screen m-3 rounded bg-white py-12">
    <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-xl overflow-hidden">
        <h2 class="text-center text-2xl mb-4 underline">Invoice</h2>

        <div class="flex flex-col md:flex-row p-8 gap-8">
            <!-- Left Column -->
            <div class="w-full md:w-8/12">
                <form wire:submit.prevent="createInvoice" class="space-y-6">
                    @csrf
                    <!-- Invoice Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-1">Invoice Number</label>
                            <input type="text" wire:model.defer="invoice_no" readonly
                                class="w-full border-b-2 py-2 px-1 bg-gray-50">
                            @error('invoice_no')
                                <span class="text-red-500 font-semibold ">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-1">Invoice Date</label>
                            <input type="date" value="<?= date('Y-m-d')?>"
                                class="w-full border-b-2 py-2 px-1 bg-gray-50">
                        </div>

                        <div>
                            <label class="block mb-1">Status</label>
                            <select wire:model="status" class="w-full border-b-2 py-2 px-1 bg-gray-50">
                                <option value="">Select Status</option>
                                <option value="draft" selected>Draft</option>
                                <option value="sent">Sent</option>
                                <option value="accepted">Accepted</option>
                                <option value="rejected">Rejected</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                            @error('status')
                                <span class="text-red-500 font-semibold ">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Customer -->
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="bg-blue-50 p-4 border rounded-lg space-y-4 w-full">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Customer Information</h3>

                                <!-- Search Input with Clear Button -->
                                <div class="relative">
                                    <input type="text" wire:model.live.debounce.30ms="search"
                                        placeholder="{{ $selectedCustomer ? 'Search again...' : 'Search Customer...' }}"
                                        class="border rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition"
                                        @if($selectedCustomer) wire:keydown.escape="clearSelection" @endif>

                                    <!-- Clear/X Button (when customer is selected) -->
                                    @if($selectedCustomer)
                                        <button wire:click="clearSelection"
                                            class="absolute right-3 top-3 text-gray-500 hover:text-red-500"
                                            title="Clear selection">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    @endif

                                    <!-- Loading Spinner -->
                                    @if($isSearching)
                                        <div class="absolute right-3 top-3">
                                            <svg class="animate-spin h-5 w-5 text-gray-500"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                    stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Search Results Dropdown -->
                                @if($search && count($customers) > 0)
                                    <div class="mt-2 bg-white border rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                        @foreach($customers as $customer)
                                            <div wire:click="selectCustomer({{ $customer->id }})"
                                                class="p-3 hover:bg-gray-100 cursor-pointer flex justify-between items-center">
                                                <span>{{ $customer->name }}</span>
                                                <span class="text-xs text-gray-500">{{ $customer->contact }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @elseif($search && !$isSearching)
                                    <div class="mt-2 p-3 text-gray-500 bg-white border rounded-lg">
                                        No customers found
                                    </div>
                                @endif

                                <!-- Selected Customer Display -->
                                @if($selectedCustomer)
                                    <div class="mt-4 p-3 bg-teal-50 rounded-lg border border-teal-100">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <p class="font-medium">Customer Details</p>
                                                <input value="{{ $selectedCustomer->name }}" wire:model="customer_id">
                                                </wire:modal>

                                                <p class="text-sm text-gray-600">{{ $selectedCustomer->email }}</p>
                                                <p class="text-sm text-gray-600">
                                                    {{ $selectedCustomer->address->city ?? '—' }}
                                                </p>
                                            </div>
                                            <button wire:click="clearSelection"
                                                class="text-gray-400 hover:text-red-500 transition" title="Change customer">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="flex items-center">
                                <div class="flex-grow border-t"></div>
                                <span class="mx-4 text-gray-500">OR</span>
                                <div class="flex-grow border-t"></div>
                            </div>

                            <a href="{{ route('customer.create') }}"
                                class="block w-full bg-blue-600 text-white py-2 rounded text-center hover:bg-blue-700">
                                + Add New Customer
                            </a>
                        </div>
                    </div>
                    <!-- Product Items Section -->
                    <div class="space-y-4">
                        @foreach($items as $index => $item)
                            <div wire:key="item-{{ $index }}" class="flex items-start gap-3 p-4 border rounded shadow">
                                <!-- Action buttons -->
                                <div class="flex flex-col items-center gap-2 pt-1 text-gray-400">
                                    <button type="button" wire:click.prevent="duplicateItem({{ $index }})"
                                        class="hover:text-green-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>

                                    <button wire:click.prevent="removeItem({{ $index }})" class="hover:text-red-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <select wire:model="items.{{ $index }}.product_id"
                                            wire:change="productSelected({{ $index }})"
                                            class="w-full border rounded px-2 py-2 text-sm">
                                            <option value="">Select Product</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('items.0.product_id')
                                            <p class="text-red-500 text-xs">{{ $message }}</p>
                                        @enderror
                                        <textarea wire:model="items.{{ $index }}.description" placeholder="Description"
                                            class="w-full h-20 border rounded px-2 py-1 mt-2 text-sm"></textarea>

                                        <input type="number" wire:model="items.{{ $index }}.mrp" placeholder="MRP"
                                            class="w-full border rounded px-2 py-1 text-sm" />

                                        @error('items.0.mrp')
                                            <p class="text-red-500 text-xs">{{ $message }}</p>
                                        @enderror
                                        <div class="text-right text-sm font-medium text-gray-600">
                                            Item Total: ₹{{ number_format($item['total'] ?? 0, 2) }}
                                        </div>
                                        <div class="text-right text-sm font-medium text-gray-600">
                                            Item Discount Amount: ₹
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <input type="number" wire:model.change="items.{{ $index }}.quantity"
                                            placeholder="Qty" class="col-span-2 border rounded px-2 py-1 text-sm" />
                                        @error('items.0.quantity')
                                            <p class="text-red-500 text-xs">{{ $message }}</p>
                                        @enderror
                                        <select wire:model="items.{{ $index }}.unit"
                                            class="col-span-2 border rounded px-2 py-1 text-sm">
                                            <option value="piece">Piece</option>
                                            <option value="box">Box</option>
                                        </select>
                                        @error('items.0.unit')
                                            <p class="text-red-500 text-xs">{{ $message }}</p>
                                        @enderror

                                        <input type="text" wire:model="items.{{ $index }}.discount" placeholder="Discount"
                                            class="w-full border rounded px-2 py-1 text-sm" />
                                        @error('items.0.discount')
                                            <p class="text-red-500 text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <button type="button" wire:click="addItem"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            + Add Product
                        </button>
                    </div>
                    <!-- Notes -->
                    <div>
                        <label class="block mb-1">Notes</label>
                        <textarea wire:model="notes" rows="4" class="w-full border rounded p-3 bg-gray-50"></textarea>
                    </div>

                    <!-- Pricing Summary -->
                    <div class="bg-gray-50 rounded-lg p-4 border">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Pricing Summary</h3>
                        <div class="grid grid-rows-3 gap-4">
                            <div>
                                <label class="block mb-1">Subtotal</label>
                                <input type="text" wire:model="subtotal" class="w-full border-b-2 py-1 px-1 bg-white"
                                    value="₹{{ number_format($subtotal, 2) }}" readonly>
                                @error('subtotal')
                                    <p class="text-red-500 text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block mb-1">Total Discount</label>
                                <input type="text" wire:model="discount" class="w-full border-b-2 py-1 px-1 bg-white"
                                    value="" readonly>
                                @error('discount')
                                    <p class="text-red-500 text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block mb-1">Tax (18%)</label>
                                <input type="text" wire:model="tax" class="w-full border-b-2 py-1 px-1 bg-white"
                                    value="₹{{ number_format($tax, 2) }}" readonly>
                                @error('tax')
                                    <p class="text-red-500 text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block mb-1">Total</label>
                                <input type="text" wire:model="total"
                                    class="w-full border-b-2 py-1 px-1 bg-blue-50 font-medium"
                                    value="₹{{ number_format($total, 2) }}" readonly>
                                @error('total')
                                    <p class="text-red-500 text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 border">
                        <div class="grid grid-cols-2">
                            <div>
                                <label for="">Select Payment method</label>
                                <select wire:model="method">
                                    <option value="cash">cash</option>
                                    <option value="card">card</option>
                                    <option value="upi">upi</option>
                                    <option value="bank">bank</option>
                                    <option value="mixed">mixed</option>
                                </select>
                            </div>
                            <div>
                                <label for="">Select Payment Status</label>
                                <select wire:model="payment_status">
                                    <option value="paid">paid</option>
                                    <option value="partial">partial</option>
                                    <option value="due">due</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-1">Due Date</label>
                                <input type="date" wire:model="due_date" class="w-full border-b-2 py-2 px-1 bg-gray-50">
                                @error('due_date')
                                    <span class="text-red-500 font-semibold ">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="">Amount Paid</label>
                                <input type="text" wire:model="amount_paid">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg shadow-md">
                            Generate Invoice
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Column (Company Info) -->
            <div class="w-full flex flex-col gap-5 md:w-4/12">
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                    <div class="flex flex-col items-center mb-6">
                        <div
                            class="w-24 h-24 bg-gray-100 rounded-full mb-4 flex items-center justify-center border-2 border-dashed">
                            <svg class="h-8 w-8 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold">TechBazar</h3>
                        <p class="text-sm text-gray-600 mt-2">
                            123 Business Street<br>
                            Purnea, Bihar 854334<br>
                            GSTIN: 22ABCDE1234F1Z5
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>