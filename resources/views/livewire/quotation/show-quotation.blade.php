<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Quotations <span class="text-blue-600">({{ count($quotations) }})</span></h2>
        <div class="flex flex-col sm:flex-row gap-2 items-center">
            <input type="search" wire:model.live.debounce.100ms="search" placeholder="Search by number or customer..." class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm" />
            <a wire:navigate href="{{ route('createQuotation') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                New Quotation
            </a>
        </div>
    </div>
    <div class="overflow-x-auto bg-white shadow-lg rounded-xl">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Quotation No</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Discount</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">Tax</th>
                    <th class="px-6 py-3 text-center text-xs font-bold text-blue-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100 text-gray-900">
                @forelse ($quotations as $quotation)
                    <tr class="hover:bg-blue-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $quotation->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-mono text-blue-700">{{ $quotation->quotation_no }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $quotation->customer->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $quotation->status == 'approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($quotation->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">₹{{ number_format($quotation->total, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">₹{{ number_format($quotation->total_discount, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">₹{{ number_format($quotation->tax, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">
                            <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-50 text-red-600 rounded hover:bg-red-100 text-xs font-semibold transition">Delete</button>
                            <button wire:click="editQuotation({{ $quotation->id }})" class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-700 rounded hover:bg-blue-100 text-xs font-semibold transition">Edit</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-gray-400 py-6 text-base">No quotations found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- View modals -->
    @if($showModal && $selectedQuote)
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
                    <!-- Header -->
                    <div class="flex justify-between items-start mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                            Quotation Details ({{ $selectedQuote->id }})
                        </h2>
                        <button @click="open = false; $wire.closeModal()"
                            class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Main Content -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Left Column - Quotation Info -->
                        <div class="bg-white border border-blue-100 rounded-xl p-6 shadow-sm space-y-6">
                            <!-- Header -->
                            <div class="border-b border-gray-300 pb-2">
                                <h2 class="text-xl font-bold text-gray-800 tracking-tight">Quotation Details</h2>
                            </div>

                            <!-- Form Grid -->
                            <div class="space-y-5">
                                <!-- Invoice Number -->
                                <div class="flex items-center justify-between">
                                    <label class="text-sm font-medium text-gray-700">Quotation #</label>
                                    <input type="text" value="{{ $selectedQuote->quotation_no }}" readonly
                                        class="w-44 text-right px-3 py-2 border border-gray-300 rounded-md bg-gray-50 font-mono text-sm focus:outline-none">
                                </div>

                                <!-- Invoice Date -->
                                <div class="flex items-center justify-between">
                                    <label class="text-sm font-medium text-gray-700">Quotation Date</label>
                                    <input type="date" value="{{ $selectedQuote->created_at->format('Y-m-d') }}" readonly
                                        class="w-44 px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div class="flex items-center justify-between">
                                    <label class="text-sm font-medium text-gray-700">Expiry Date</label>
                                    <input type="valid_date" value="{{ $selectedQuote->valid_date }}"
                                        class="w-44 px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                                        readonly>
                                </div>

                                <!-- Status Selector -->
                                <div class="flex items-center justify-between">
                                    <label class="text-sm font-medium text-gray-700">Status</label>
                                    <select
                                        class="w-44 px-3 py-2 border border-gray-300 rounded-md bg-white text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                        <option value="{{ $selectedQuote->status }}">{{ $selectedQuote->status }}
                                        </option>
                                        <option value="draft">Draft</option>
                                        <option value="sent">Sent</option>
                                        <option value="accepted">Accepted</option>
                                        <option value="rejected">Rejected</option>
                                        <option value="converted">converted</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white border border-blue-100 rounded-xl p-6 shadow-sm space-y-6">
                            <!-- Header -->
                            <div class="border-b border-gray-300 pb-2">
                                <h2 class="text-xl font-bold text-gray-800 tracking-tight">Customer Details</h2>
                            </div>

                            <!-- Form Grid -->
                            <div class="space-y-5">

                            </div>
                        </div>

                    </div>

                    <!-- Notes & Actions -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Notes</label>
                        <textarea rows="3"
                            class="w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-600 dark:border-gray-500 dark:text-white p-2">Thank you for your business. This quotation is valid for 30 days from the issue date.</textarea>
                    </div>

                    <!-- Footer Buttons -->

                    <button @click="open = false; $wire.closeModal()"
                        class="px-4 py-2 bg-gray-100 text-end dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors font-medium">
                        Cancel
                    </button>

                </div>
            </div>
    @endif
    </div>