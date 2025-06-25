<div class="p-2 bg-white dark:bg-gray-900 rounded-xl shadow-md">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-4">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            Manage Sales ({{ count($sales) }})
        </h2>

        <!-- Filter section -->
        <div class="flex flex-col md:flex-row gap-3">
            <input type="text" wire:model.live="search" placeholder="Search by Customer Name"
                class="px-4 py-2 text-sm border border-gray-300 dark:border-gray-700 rounded-md bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500" />

            <select wire:model.live="status"
                class="px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">All Payment Status</option>
                <option value="paid">Paid</option>
                <option value="partial">partial</option>
                <option value="due">due</option>
            </select>

            <input type="date"
                class="px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-white dark:bg-gray-800 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>
    </div>

    <div class="overflow-x-auto mt-4">
        <table class="w-full border-collapse rounded-lg overflow-hidden text-sm">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-800 text-left text-gray-700 dark:text-gray-300">
                    <th class="px-4 py-3 border dark:border-gray-700">ID</th>
                    <th class="px-4 py-3 border dark:border-gray-700">Customer Name</th>
                    <th class="px-4 py-3 border dark:border-gray-700">Invoice No</th>
                    <th class="px-4 py-3 border dark:border-gray-700">Payment Status</th>
                    <th class="px-4 py-3 border dark:border-gray-700">Total Amount</th>
                    <th class="px-4 py-3 border dark:border-gray-700">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-800 dark:text-gray-100">
                @forelse ($sales as $sale)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-4 py-2 border dark:border-gray-700">{{ $sale->id }}</td>
                                <td class="px-4 py-2 border dark:border-gray-700">{{ $sale->customer->name }}</td>
                                <td class="px-4 py-2 border dark:border-gray-700">{{ $sale->invoice->invoice_no }}</td>
                                <td class="px-4 py-2 border dark:border-gray-700">
                                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full 
                                                                                                                    {{ 
                                                                                                                        $sale->payment_status == 'paid' ? 'bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200' :
                    ($sale->payment_status == 'partial' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-800 dark:text-yellow-200' :
                        'bg-red-100 text-red-700 dark:bg-red-800 dark:text-red-200') 
                                                                                                                    }}">
                                        {{ ucfirst($sale->payment_status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 border dark:border-gray-700">₹{{ number_format($sale->total_amount, 2) }}</td>
                                <td class="flex justify-evenly px-4 py-2 border dark:border-gray-700">
                                    <button wire:click="deleteSales({{ $sale->id }})" wire:confirm="Are you Sure want to delete this sales"
                                        class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 font-semibold transition duration-150">
                                        Delete
                                    </button>
                                    <button wire:click="viewSaleDetails({{ $sale->id }})"
                                        class="text-blue-500 hover:underline">View</button>
                                </td>
                            </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center space-y-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-medium text-gray-600">No Record found</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- View modals -->
    @if($showModal && $selectedSale)
        <div x-data="{ open: true }" x-show="open" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center p-4"
            @keydown.escape.window="open = false; $wire.closeModal()">

            <!-- Backdrop -->
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="open = false; $wire.closeModal()"></div>

            <!-- Modal Content -->
            <div class="relative w-full max-w-4xl max-h-[90vh] overflow-y-auto bg-white dark:bg-gray-800 rounded-xl shadow-2xl transform transition-all"
                x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                <!-- Close Button -->
                <button @click="open = false; $wire.closeModal()"
                    class="absolute top-4 right-4 p-1 rounded-full text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Modal Body -->
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Order Details ({{ $selectedSale->id }})</h2>

                    <div class="grid grid-cols-2 gap-10">
                        <!-- Sales Details Section -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white border-b pb-2">Sales
                                Information
                            </h3>
                            <div class="space-y-3 text-gray-700 dark:text-gray-200">
                                <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                                    <span class="font-medium">Invoice No:</span>
                                    <span
                                        class="text-gray-900 dark:text-white">{{ $selectedSale->invoice->invoice_no }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                                    <span class="font-medium">Order Date:</span>
                                    <span
                                        class="text-gray-900 dark:text-white">{{ $selectedSale->created_at->format('d M Y, h:i A') }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                                    <span class="font-medium">Payment Status:</span>
                                    <span
                                        class="capitalize {{ $selectedSale->payment_status === 'paid' ? 'text-green-600 dark:text-green-400' : 'text-yellow-600 dark:text-yellow-400' }}">
                                        {{ ucfirst($selectedSale->payment_status) }}
                                    </span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                                    <span class="font-medium">Total Amount:</span>
                                    <span
                                        class="text-gray-900 dark:text-white">₹{{ number_format($selectedSale->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Details Section -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white border-b pb-2">Customer
                                Information</h3>
                            <div class="space-y-3 text-gray-700 dark:text-gray-200">
                                <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                                    <span class="font-medium">Name:</span>
                                    <span class="text-gray-900 dark:text-white">{{ $selectedSale->customer->name }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                                    <span class="font-medium">Contact:</span>
                                    <span class="text-gray-900 dark:text-white">{{ $selectedSale->customer->contact }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                                    <span class="font-medium">Email:</span>
                                    <span class="text-gray-900 dark:text-white">{{ $selectedSale->customer->email }}</span>
                                </div>
                                <div class="flex  py-2 border-b border-gray-100 dark:border-gray-700">
                                    <span class="font-medium">Address:</span>
                                    <span class="text-end text-gray-900 dark:text-white">{{ $selectedSale->customer->address->address }},{{ $selectedSale->customer->address->city }}, {{ $selectedSale->customer->address->state }},{{ $selectedSale->customer->address->pincode }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Sales Items Section -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white border-b pb-2">Order Items
                            </h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col"
                                                class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Item</th>
                                            <th scope="col"
                                                class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Qty</th>
                                            <th scope="col"
                                                class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Price</th>
                                            <th scope="col"
                                                class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($selectedSale->items as $item)
                                        <tr>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                                {{ $item->product->name }}</td>
                                            <td
                                                class="px-4 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                2
                                            </td>
                                            <td
                                                class="px-4 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                ₹500.00</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                                ₹1000.00</td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    <tfoot class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <td colspan="3"
                                                class="px-4 py-2 text-right text-sm font-medium text-gray-900 dark:text-white">
                                                Subtotal</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                                ₹2200.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"
                                                class="px-4 py-2 text-right text-sm font-medium text-gray-900 dark:text-white">
                                                Tax (5%)</td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                                ₹ {{$selectedSale->tax}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"
                                                class="px-4 py-2 text-right text-sm font-bold text-gray-900 dark:text-white">
                                                Total</td>
                                            <td
                                                class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-900 dark:text-white">
                                                ₹{{$selectedSale->total_amount}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    <div class="mt-6 flex justify-end">
                        <button @click="open = false; $wire.closeModal()"
                            class="px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors font-medium">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>