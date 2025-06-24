
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Create New Exchange/Return</h1>
        <a href="{{route('exchange.view')}}" class="text-gray-600 hover:text-gray-900">
            Back to List
        </a>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="" method="POST">
            @csrf

            <!-- Transaction Type Section -->
            <div class="mb-8 p-4 border rounded-lg">
                <h2 class="text-lg font-semibold mb-4">Transaction Type</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Transaction Type</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="type" value="exchange" class="form-radio" checked>
                                <span class="ml-2">Exchange</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="type" value="return" class="form-radio">
                                <span class="ml-2">Return</span>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Return Type</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="return_type" value="sale_return" class="form-radio" checked>
                                <span class="ml-2">Sale Return</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="return_type" value="purchase_return" class="form-radio">
                                <span class="ml-2">Purchase Return</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reference Information -->
            <div class="mb-8 p-4 border rounded-lg">
                <h2 class="text-lg font-semibold mb-4">Reference Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Invoice Number</label>
                        <input type="text" name="invoice_id" class="w-full border rounded px-3 py-2" placeholder="INV-2023-001">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Sale Reference</label>
                        <select name="sale_id" class="w-full border rounded px-3 py-2">
                            <option value="">Select Sale</option>
                            <option value="1">SALE-001 (John Doe)</option>
                            <option value="2">SALE-002 (Jane Smith)</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Purchase Reference</label>
                        <select name="purchase_id" class="w-full border rounded px-3 py-2">
                            <option value="">Select Purchase</option>
                            <option value="1">PO-001 (ABC Suppliers)</option>
                            <option value="2">PO-002 (XYZ Wholesale)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Customer/Supplier Information -->
            <div class="mb-8 p-4 border rounded-lg">
                <h2 class="text-lg font-semibold mb-4">Party Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Customer</label>
                        <select name="customer_id" class="w-full border rounded px-3 py-2">
                            <option value="">Select Customer</option>
                            <option value="1">John Doe (Customer #001)</option>
                            <option value="2">Jane Smith (Customer #002)</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Supplier</label>
                        <select name="supplier_id" class="w-full border rounded px-3 py-2">
                            <option value="">Select Supplier</option>
                            <option value="1">ABC Suppliers</option>
                            <option value="2">XYZ Wholesale</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Items Section -->
            <div class="mb-8 p-4 border rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Items</h2>
                    <button type="button" id="add-item" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                        Add Item
                    </button>
                </div>
                
                <div id="items-container">
                    <!-- Item template will be cloned here -->
                    <div class="item-row mb-4 p-4 border rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-3">
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-1">Product</label>
                                <select name="items[0][product_id]" class="w-full border rounded px-2 py-1 text-sm">
                                    <option value="">Select Product</option>
                                    <option value="1">Product A</option>
                                    <option value="2">Product B</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-1">Quantity</label>
                                <input type="number" name="items[0][quantity]" class="w-full border rounded px-2 py-1 text-sm" value="1" min="1">
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-1">Refund Amount</label>
                                <input type="number" step="0.01" name="items[0][refund_amount]" class="w-full border rounded px-2 py-1 text-sm" placeholder="0.00">
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-1">Condition</label>
                                <select name="items[0][condition]" class="w-full border rounded px-2 py-1 text-sm">
                                    <option value="new">New</option>
                                    <option value="opened">Opened</option>
                                    <option value="used">Used</option>
                                    <option value="damaged">Damaged</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-1">Reason</label>
                                <input type="text" name="items[0][reason]" class="w-full border rounded px-2 py-1 text-sm" placeholder="Reason for return">
                            </div>
                            <div class="exchange-fields">
                                <label class="block text-gray-700 text-sm font-medium mb-1">Replacement Product</label>
                                <select name="items[0][replacement_product_id]" class="w-full border rounded px-2 py-1 text-sm">
                                    <option value="">Select Replacement</option>
                                    <option value="1">Product A</option>
                                    <option value="2">Product B</option>
                                </select>
                            </div>
                            <div class="exchange-fields">
                                <label class="block text-gray-700 text-sm font-medium mb-1">Price Difference</label>
                                <input type="number" step="0.01" name="items[0][replacement_price_diff]" class="w-full border rounded px-2 py-1 text-sm" placeholder="0.00">
                            </div>
                        </div>
                        
                        <div class="mt-3 flex justify-end">
                            <button type="button" class="remove-item text-red-500 hover:text-red-700 text-sm">
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="mb-8 p-4 border rounded-lg">
                <h2 class="text-lg font-semibold mb-4">Additional Information</h2>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Reasons (Detailed)</label>
                        <textarea name="reasons" rows="3" class="w-full border rounded px-3 py-2" placeholder="Provide detailed reasons for the exchange/return"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Notes</label>
                        <textarea name="notes" rows="2" class="w-full border rounded px-3 py-2" placeholder="Any additional notes"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Refund Method</label>
                            <select name="refund_method" class="w-full border rounded px-3 py-2">
                                <option value="">Select Method</option>
                                <option value="cash">Cash</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="store_credit">Store Credit</option>
                                <option value="exchange">Exchange</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Return Date</label>
                            <input type="date" name="return_date" class="w-full border rounded px-3 py-2" value="{{ date('Y-m-d') }}">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add new item row
    document.getElementById('add-item').addEventListener('click', function() {
        const container = document.getElementById('items-container');
        const itemCount = container.querySelectorAll('.item-row').length;
        const template = container.querySelector('.item-row').cloneNode(true);
        
        // Update all the names with new index
        template.innerHTML = template.innerHTML.replace(/items\[0\]/g, `items[${itemCount}]`);
        
        // Clear values
        template.querySelectorAll('input').forEach(input => {
            if (input.type !== 'number' || input.name.includes('quantity')) {
                input.value = '';
            }
            if (input.name.includes('quantity')) {
                input.value = '1';
            }
        });
        
        container.appendChild(template);
    });

    // Remove item row
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-item')) {
            const itemRow = e.target.closest('.item-row');
            if (document.querySelectorAll('.item-row').length > 1) {
                itemRow.remove();
            } else {
                alert('You must have at least one item');
            }
        }
    });

    // Show/hide exchange fields based on transaction type
    const typeRadios = document.querySelectorAll('input[name="type"]');
    function toggleExchangeFields() {
        const isExchange = document.querySelector('input[name="type"]:checked').value === 'exchange';
        document.querySelectorAll('.exchange-fields').forEach(field => {
            field.style.display = isExchange ? 'block' : 'none';
        });
    }
    
    typeRadios.forEach(radio => {
        radio.addEventListener('change', toggleExchangeFields);
    });
    
    // Initialize
    toggleExchangeFields();
});
</script>

