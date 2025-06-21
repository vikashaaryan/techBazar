@extends('manager.managerlayout')

@section('title', 'Purchase Details')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Purchase Details</h2>
            <a href="{{ route('purchase.index') }}"
                class="flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Back to Purchases
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd" />
                    </svg>
                    Purchase Information
                </h3>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-md font-semibold text-gray-700 mb-4 border-b pb-2">Basic Information</h4>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Supplier</p>
                                <p class="text-sm text-gray-800 mt-1">{{ $purchase->supplier->supplier_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Invoice Number</p>
                                <p class="text-sm text-gray-800 mt-1">INV-{{ $purchase->invoice_number }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Purchase Date</p>
                                <p class="text-sm text-gray-800 mt-1">{{ $purchase->created_at->format('M d, Y h:i A') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-md font-semibold text-gray-700 mb-4 border-b pb-2">Payment Information</h4>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Amount</p>
                                <p class="text-sm text-gray-800 mt-1">{{ number_format($purchase->amount, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Amount Paid</p>
                                <p class="text-sm text-gray-800 mt-1">{{ number_format($purchase->amount_paid, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Amount Due</p>
                                <p class="text-sm text-gray-800 mt-1">
                                    {{ number_format($purchase->amount - $purchase->amount_paid, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Payment Status</p>
                                <span
                                    class="px-2 py-1 text-xs rounded-full 
                                    @if ($purchase->payment_status == 'paid') bg-green-100 text-green-800
                                    @elseif($purchase->payment_status == 'partial') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($purchase->payment_status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($purchase->attachment)
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-md font-semibold text-gray-700 mb-4 border-b pb-2">Attachment</h4>
                        <a href="{{ asset('storage/' . $purchase->attachment) }}" target="_blank"
                            class="inline-flex items-center text-blue-500 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                    clip-rule="evenodd" />
                            </svg>
                            View Invoice/Receipt
                        </a>
                    </div>
                @endif

                <div class="bg-gray-50 p-4 rounded-lg mb-8">
                    <h4 class="text-md font-semibold text-gray-700 mb-4 border-b pb-2">Purchase Items</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Product</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Quantity</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Unit Price</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($purchase->items as $item)
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                            {{ $item->product->name }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                            {{ number_format($item->price, 2) }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                            {{ number_format($item->quantity * $item->price, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="3" class="px-4 py-3 text-right text-sm font-semibold">Subtotal:</td>
                                    <td class="px-4 py-3 text-sm font-semibold">{{ number_format($purchase->amount, 2) }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Supplier Purchase History -->
                <div class="bg-gray-50 p-4 rounded-lg mb-8">
                    <h4 class="text-md font-semibold text-gray-700 mb-4 border-b pb-2">
                        Purchase History with {{ $purchase->supplier->supplier_name }}
                    </h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Date</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Invoice</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Amount</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($supplierPurchases as $supplierPurchase)
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                            {{ $supplierPurchase->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                            INV-{{ $supplierPurchase->invoice_number }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                            {{ number_format($supplierPurchase->amount, 2) }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full 
                                                @if ($supplierPurchase->payment_status == 'paid') bg-green-100 text-green-800
                                                @elseif($supplierPurchase->payment_status == 'partial') bg-yellow-100 text-yellow-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($supplierPurchase->payment_status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                            <a href="{{ route('purchase.show', $supplierPurchase->id) }}"
                                                class="text-blue-500 hover:text-blue-700">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Product Purchase History -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="text-md font-semibold text-gray-700 mb-4 border-b pb-2">Product Purchase History</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Product</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Last Purchase Date</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Last Price</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Times Purchased</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Total Quantity</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($productHistory as $product)
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                            {{ $product->name }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                            {{ $product->last_purchase_date ? $product->last_purchase_date->format('M d, Y') : 'N/A' }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                            {{ $product->last_price ? number_format($product->last_price, 2) : 'N/A' }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                            {{ $product->times_purchased }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                            {{ $product->total_quantity }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('purchase.index') }}"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection