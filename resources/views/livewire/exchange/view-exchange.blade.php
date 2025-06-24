
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Exchange/Return Management</h1>
        <a href="{{route('exchange.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Create New
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white shadow rounded-lg p-4 mb-6">
        <form action="" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                    <select name="type" class="w-full border rounded px-3 py-2">
                        <option value="">All Types</option>
                        <option value="exchange">Exchange</option>
                        <option value="return">Return</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Return Type</label>
                    <select name="return_type" class="w-full border rounded px-3 py-2">
                        <option value="">All</option>
                        <option value="sale_return">Sale Return</option>
                        <option value="purchase_return">Purchase Return</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                    <select name="status" class="w-full border rounded px-3 py-2">
                        <option value="">All Statuses</option>
                        <option value="requested">Requested</option>
                        <option value="approved">Approved</option>
                        <option value="processed">Processed</option>
                        <option value="completed">Completed</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Exchange/Returns Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Serial No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer/Supplier</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Dummy Data Rows -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">ER-20230515-00001</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            Exchange
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">INV-2023-001</td>
                    <td class="px-6 py-4 whitespace-nowrap">John Doe</td>
                    <td class="px-6 py-4 whitespace-nowrap">$120.00</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Completed
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">2023-05-15</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>
                        <a href="#" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">ER-20230518-00002</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                            Return (Sale)
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">INV-2023-002</td>
                    <td class="px-6 py-4 whitespace-nowrap">Jane Smith</td>
                    <td class="px-6 py-4 whitespace-nowrap">$75.50</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Approved
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">2023-05-18</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>
                        <a href="#" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">ER-20230520-00003</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Return (Purchase)
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">PO-2023-001</td>
                    <td class="px-6 py-4 whitespace-nowrap">ABC Suppliers</td>
                    <td class="px-6 py-4 whitespace-nowrap">$250.00</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            Requested
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">2023-05-20</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>
                        <a href="#" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">3</span> results
                </div>
                <div class="flex space-x-2">
                    <button class="px-4 py-2 border rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                    </button>
                    <button class="px-4 py-2 border rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>