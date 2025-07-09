<div class="container mx-auto px-4 py-8">
    <!-- Header with action buttons -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Exchange/Return Details</h1>
            <p class="text-sm text-gray-500">#{{ $exchange->serial_no }}</p>
        </div>
        <div class="flex space-x-2">
            <button onclick="window.print()" class="bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Print
            </button>
            <a href="{{ route('exchange.edit', $exchange->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
        </div>
    </div>

    <!-- Main content -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Status banner -->
        <div class="bg-{{ $exchange->status === 'completed' ? 'green' : ($exchange->status === 'rejected' ? 'red' : 'blue') }}-50 p-4 border-b">
            <div class="flex items-center">
                <span class="px-3 py-1 rounded-full text-sm font-medium bg-{{ $exchange->status === 'completed' ? 'green' : ($exchange->status === 'rejected' ? 'red' : 'blue') }}-100 text-{{ $exchange->status === 'completed' ? 'green' : ($exchange->status === 'rejected' ? 'red' : 'blue') }}-800">
                    {{ ucfirst($exchange->status) }}
                </span>
                <span class="ml-4 text-sm text-gray-600">
                    Last updated: {{ $exchange->updated_at->format('M d, Y h:i A') }}
                </span>
            </div>
        </div>

        <!-- Details sections -->
        <div class="p-6">
            <!-- Transaction Details -->
            <div class="mb-8">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Transaction Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Type</h3>
                        <p class="mt-1 text-sm text-gray-900">
                            {{ ucfirst($exchange->type) }} 
                            ({{ $exchange->return_type === 'sale_return' ? 'Sale' : 'Purchase' }})
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Date</h3>
                        <p class="mt-1 text-sm text-gray-900">
                            {{ $exchange->return_date->format('M d, Y') }}
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Reference</h3>
                        <p class="mt-1 text-sm text-gray-900">
                            {{ $exchange->invoice_id ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Party Information -->
            <div class="mb-8">
                <h2 class="text-lg font-medium text-gray-900 mb-4">
                    {{ $exchange->customer ? 'Customer' : 'Supplier' }} Information
                </h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    @if($exchange->customer)
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">{{ $exchange->customer->name }}</p>
                                <p class="text-sm text-gray-500">{{ $exchange->customer->contact }}</p>
                                @if($exchange->customer->email)
                                    <p class="text-sm text-gray-500">{{ $exchange->customer->email }}</p>
                                @endif
                            </div>
                        </div>
                    @elseif($exchange->supplier)
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">{{ $exchange->supplier->supplier_name }}</p>
                                <p class="text-sm text-gray-500">{{ $exchange->supplier->company }}</p>
                                <p class="text-sm text-gray-500">{{ $exchange->supplier->phone }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Items Section -->
            <div class="mb-8">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Items ({{ $exchange->items->count() }})</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Refund</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Condition</th>
                                @if($exchange->type === 'exchange')
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Replacement</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($exchange->items as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-md flex items-center justify-center">
                                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $item->product->name }}</div>
                                                <div class="text-sm text-gray-500">SKU: {{ $item->product->sku }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        ${{ number_format($item->refund_amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $item->condition === 'new' ? 'bg-green-100 text-green-800' : 
                                               ($item->condition === 'used' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($item->condition) }}
                                        </span>
                                    </td>
                                    @if($exchange->type === 'exchange')
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($item->replacementProduct)
                                                <div class="text-sm text-gray-900">{{ $item->replacementProduct->name }}</div>
                                                <div class="text-xs text-gray-500">+${{ number_format($item->replacement_price_diff, 2) }}</div>
                                            @else
                                                <span class="text-gray-400">None</span>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Financial Summary -->
            <div class="mb-8">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Financial Summary</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Subtotal</h3>
                        <p class="mt-1 text-lg font-semibold text-gray-900">${{ number_format($exchange->total_refund_amount, 2) }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Tax</h3>
                        <p class="mt-1 text-lg font-semibold text-gray-900">${{ number_format($exchange->total_tax_refund, 2) }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Refund Method</h3>
                        <p class="mt-1 text-lg font-semibold text-gray-900">
                            {{ $exchange->refund_method ? ucfirst(str_replace('_', ' ', $exchange->refund_method)) : 'Not specified' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div>
                <h2 class="text-lg font-medium text-gray-900 mb-4">Additional Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Reasons</h3>
                        <p class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $exchange->reasons }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Notes</h3>
                        <p class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $exchange->notes ?? 'No additional notes' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>