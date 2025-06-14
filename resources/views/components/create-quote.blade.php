<div id="quote-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow :bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t :border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 :text-white">
                    Create New Quote
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center :hover:bg-gray-600 :hover:text-white" data-modal-hide="quote-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Quotation Number -->
                        <div>
                            <label for="quotation_no" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Quotation Number</label>
                            <input type="text" id="quotation_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 :bg-gray-600 :border-gray-500 :placeholder-gray-400 :text-white" placeholder="Q-2023-001" required>
                        </div>
                        
                        <!-- Customer -->
                        <div>
                            <label for="customer" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Customer</label>
                            <select id="customer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 :bg-gray-600 :border-gray-500 :placeholder-gray-400 :text-white" required>
                                <option value="" selected disabled>Select Customer</option>
                                <option value="1">Customer A</option>
                                <option value="2">Customer B</option>
                                <option value="3">Customer C</option>
                            </select>
                        </div>
                        
                        <!-- Validity -->
                        <div>
                            <label for="validity" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Validity (Days)</label>
                            <input type="number" id="validity" min="1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 :bg-gray-600 :border-gray-500 :placeholder-gray-400 :text-white" placeholder="30" required>
                        </div>
                        
                        <!-- Status -->
                        <div>
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Status</label>
                            <select id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 :bg-gray-600 :border-gray-500 :placeholder-gray-400 :text-white" required>
                                <option value="draft">Draft</option>
                                <option value="sent">Sent</option>
                                <option value="accepted">Accepted</option>
                                <option value="rejected">Rejected</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        
                        <!-- Tax Type -->
                        <div>
                            <label for="tax_type" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Tax Type</label>
                            <select id="tax_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 :bg-gray-600 :border-gray-500 :placeholder-gray-400 :text-white" required>
                                <option value="vat">VAT</option>
                                <option value="gst">GST</option>
                                <option value="sales_tax">Sales Tax</option>
                                <option value="none">None</option>
                            </select>
                        </div>
                        
                        <!-- Tax Percentage -->
                        <div>
                            <label for="tax_percentage" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Tax Percentage (%)</label>
                            <input type="number" id="tax_percentage" min="0" max="100" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 :bg-gray-600 :border-gray-500 :placeholder-gray-400 :text-white" placeholder="7.5">
                        </div>
                    </div>
                    
                    <!-- Items Table (simplified) -->
                    <div class="mt-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 :text-white">Items</label>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 :text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 :bg-gray-700 :text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Item</th>
                                        <th scope="col" class="px-6 py-3">Description</th>
                                        <th scope="col" class="px-6 py-3">Quantity</th>
                                        <th scope="col" class="px-6 py-3">Unit Price</th>
                                        <th scope="col" class="px-6 py-3">Amount</th>
                                        <th scope="col" class="px-6 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b :bg-gray-800 :border-gray-700">
                                        <td class="px-6 py-4"><input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white" placeholder="Item"></td>
                                        <td class="px-6 py-4"><input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white" placeholder="Description"></td>
                                        <td class="px-6 py-4"><input type="number" min="1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white" placeholder="1"></td>
                                        <td class="px-6 py-4"><input type="number" min="0" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white" placeholder="0.00"></td>
                                        <td class="px-6 py-4">0.00</td>
                                        <td class="px-6 py-4"><button type="button" class="text-red-600 hover:text-red-900">Remove</button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="mt-2 text-sm text-blue-600 hover:text-blue-800">+ Add Item</button>
                        </div>
                    </div>
                    
                    <!-- Totals -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 :text-white">Subtotal</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 :bg-gray-600 :border-gray-500 :text-white">$0.00</div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 :text-white">Tax</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 :bg-gray-600 :border-gray-500 :text-white">$0.00</div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 :text-white">Total</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 :bg-gray-600 :border-gray-500 :text-white font-bold">$0.00</div>
                        </div>
                    </div>
                    
                    <!-- Notes -->
                    <div class="mt-4">
                        <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Notes</label>
                        <textarea id="notes" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 :bg-gray-600 :border-gray-500 :placeholder-gray-400 :text-white" placeholder="Additional notes..."></textarea>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b :border-gray-600">
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center :bg-blue-600 :hover:bg-blue-700 :focus:ring-blue-800">Save Quote</button>
                <button type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 :bg-gray-700 :text-gray-300 :border-gray-500 :hover:text-white :hover:bg-gray-600 :focus:ring-gray-600" data-modal-hide="quote-modal">Cancel</button>
            </div>
        </div>
    </div>
</div>