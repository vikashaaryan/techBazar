@extends('manager.managerlayout')

@section('title', 'Create Purchase')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Create New Purchase</h2>
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
            <div class="px-6 py-4 border-b border-gray-200">
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
                <form action="{{ route('purchase.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="supplier_id" class="block text-sm font-medium text-gray-700 mb-1">Supplier <span
                                    class="text-red-500">*</span></label>
                            <select name="supplier_id" id="supplier_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->supplier_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="invoice_number" class="block text-sm font-medium text-gray-700 mb-1">Invoice No
                                <span class="text-red-500">*</span></label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500">INV-</span>
                                <input type="text" name="invoice_number" id="invoice_number" required
                                    value="{{ old('invoice_number') }}"
                                    class="flex-1 block w-full px-3 py-2 border border-gray-300 rounded-r-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            @error('invoice_number')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Total Amount <span
                                    class="text-red-500">*</span></label>
                            <input type="number" step="0.01" name="amount" id="amount" required
                                value="{{ old('amount') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('amount')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="amount_paid" class="block text-sm font-medium text-gray-700 mb-1">Amount Paid <span
                                    class="text-red-500">*</span></label>
                            <input type="number" step="0.01" name="amount_paid" id="amount_paid" required
                                value="{{ old('amount_paid', 0) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            @error('amount_paid')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-1">Payment Status
                                <span class="text-red-500">*</span></label>
                            <select name="payment_status" id="payment_status" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Status</option>
                                <option value="paid" {{ old('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="partial" {{ old('payment_status') == 'partial' ? 'selected' : '' }}>Partial</option>
                                <option value="due" {{ old('payment_status') == 'due' ? 'selected' : '' }}>Due</option>
                            </select>
                            @error('payment_status')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="attachment" class="block text-sm font-medium text-gray-700 mb-1">Attachment
                            (Invoice/Receipt)</label>
                        <input type="file" name="attachment" id="attachment"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @error('attachment')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-semibold text-gray-800">Purchase Items</h4>
                            <button type="button" id="addItem"
                                class="px-3 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                Add Item
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200" id="itemsTable">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Product</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Quantity</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Price</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="itemRows" class="bg-white divide-y divide-gray-200">
                                    @php
                                        $oldItems = old('items', [['product_id' => '', 'quantity' => 1, 'price' => 0]]);
                                    @endphp
                                    
                                    @foreach($oldItems as $i => $item)
                                    <tr class="item-row">
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <select name="items[{{ $i }}][product_id]" required
                                                class="product-select w-full border rounded px-2 py-1 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">Select Product</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}" 
                                                        {{ $item['product_id'] == $product->id ? 'selected' : '' }}>
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <input type="number" name="items[{{ $i }}][quantity]" required min="1" 
                                                value="{{ $item['quantity'] }}"
                                                class="quantity w-full border rounded px-2 py-1 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <input type="number" name="items[{{ $i }}][price]" required step="0.01" min="0"
                                                value="{{ $item['price'] }}"
                                                class="price w-full border rounded px-2 py-1 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <span class="total">0.00</span>
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <button type="button"
                                                class="remove-item px-2 py-1 bg-red-100 text-red-600 rounded-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1">
                                                Remove
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="px-4 py-2 text-right font-semibold">Subtotal:</td>
                                        <td id="subtotal" class="px-4 py-2 font-semibold">0.00</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('purchase.index') }}"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Save Purchase
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const itemRows = document.getElementById('itemRows');
            const addItemBtn = document.getElementById('addItem');
            let rowCount = {{ count($oldItems) }};
            
            // Calculate totals initially
            calculateTotals();
            
            // Add new item row
            addItemBtn.addEventListener('click', function() {
                const newRow = document.createElement('tr');
                newRow.className = 'item-row';
                newRow.innerHTML = `
                    <td class="px-4 py-2 whitespace-nowrap">
                        <select name="items[${rowCount}][product_id]" required
                            class="product-select w-full border rounded px-2 py-1 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <input type="number" name="items[${rowCount}][quantity]" required min="1" value="1"
                            class="quantity w-full border rounded px-2 py-1 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <input type="number" name="items[${rowCount}][price]" required step="0.01" min="0" value="0"
                            class="price w-full border rounded px-2 py-1 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <span class="total">0.00</span>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <button type="button"
                            class="remove-item px-2 py-1 bg-red-100 text-red-600 rounded-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1">
                            Remove
                        </button>
                    </td>
                `;
                itemRows.appendChild(newRow);
                rowCount++;
                
                // Add event listeners to new inputs
                addRowEventListeners(newRow);
            });
            
            // Remove item row
            itemRows.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-item')) {
                    const row = e.target.closest('tr');
                    if (document.querySelectorAll('.item-row').length > 1) {
                        row.remove();
                        calculateTotals();
                    } else {
                        alert('You must have at least one item.');
                    }
                }
            });
            
            // Add event listeners to existing rows
            document.querySelectorAll('.item-row').forEach(row => {
                addRowEventListeners(row);
            });
            
            // Function to add event listeners to a row
            function addRowEventListeners(row) {
                const quantityInput = row.querySelector('.quantity');
                const priceInput = row.querySelector('.price');
                
                quantityInput.addEventListener('input', calculateRowTotal);
                priceInput.addEventListener('input', calculateRowTotal);
                
                // Calculate initial row total
                calculateRowTotal.call(row);
            }
            
            // Calculate total for a single row
            function calculateRowTotal() {
                const row = this.closest ? this.closest('tr') : this;
                const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
                const price = parseFloat(row.querySelector('.price').value) || 0;
                const total = quantity * price;
                
                row.querySelector('.total').textContent = total.toFixed(2);
                calculateTotals();
            }
            
            // Calculate all totals and update subtotal and amount field
            function calculateTotals() {
                let subtotal = 0;
                document.querySelectorAll('.item-row').forEach(row => {
                    subtotal += parseFloat(row.querySelector('.total').textContent) || 0;
                });
                
                document.getElementById('subtotal').textContent = subtotal.toFixed(2);
                document.getElementById('amount').value = subtotal.toFixed(2);
                
                // Update amount paid if it's more than the new total
                const amountPaid = parseFloat(document.getElementById('amount_paid').value) || 0;
                if (amountPaid > subtotal) {
                    document.getElementById('amount_paid').value = subtotal.toFixed(2);
                }
                
                // Update payment status
                updatePaymentStatus();
            }
            
            // Update payment status based on amounts
            function updatePaymentStatus() {
                const amount = parseFloat(document.getElementById('amount').value) || 0;
                const amountPaid = parseFloat(document.getElementById('amount_paid').value) || 0;
                const paymentStatus = document.getElementById('payment_status');
                
                if (amountPaid >= amount) {
                    paymentStatus.value = 'paid';
                } else if (amountPaid > 0) {
                    paymentStatus.value = 'partial';
                } else {
                    paymentStatus.value = 'due';
                }
            }
            
            // Amount paid change listener
            document.getElementById('amount_paid').addEventListener('input', function() {
                const amount = parseFloat(document.getElementById('amount').value) || 0;
                const amountPaid = parseFloat(this.value) || 0;
                
                if (amountPaid > amount) {
                    this.value = amount.toFixed(2);
                }
                
                updatePaymentStatus();
            });
        });
    </script>
@endsection