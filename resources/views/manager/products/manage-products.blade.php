@extends('manager.managerlayout')

@section('title', 'Manage Products')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl font-bold text-gray-800">Product Management</h1>
                    <p class="text-gray-600">Total Products: <span class="font-semibold">{{ $products->count() }}</span></p>
                </div>
                <a href="{{ route('product.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition duration-150 ease-in-out shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add New Product
                </a>
            </div>

            <!-- Search Section -->
            <div class="mb-6">
                <div class="relative max-w-md">
                    <input type="text" id="productSearch" placeholder="Search products by name, SKU or category..." 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition duration-200 shadow-sm">
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Products Table -->
            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Brand</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">MRP</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="productTableBody">
                        @foreach($products as $product)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-md object-cover" 
                                             src="{{ asset('storage/' . $product->image) }}"
                                             alt="{{ $product->name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                        <div class="text-xs text-gray-500">{{ Str::limit($product->description, 30) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono">{{ $product->sku }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="px-2 py-1 bg-gray-100 rounded-full text-xs">{{ $product->parent ? $product->parent->cat_title : '-' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->brand ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="line-through">Rs.{{ number_format($product->mrp, 2) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-teal-600">
                                Rs.{{ number_format($product->sell_price, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $product->qty > 10 ? 'bg-green-100 text-green-800' : ($product->qty > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $product->qty }} in stock
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-3">
                                    <a href="{{ route('product.edit', $product->id) }}" 
                                       class="text-indigo-600 hover:text-indigo-900 transition duration-150 ease-in-out"
                                       title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('product.show', $product->id) }}" 
                                       class="text-gray-600 hover:text-gray-900 transition duration-150 ease-in-out"
                                       title="View">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Status Message -->
            <div id="searchStatus" class="mt-4 text-center text-gray-500 italic hidden">
                No products found matching your search.
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('productSearch');
            const productRows = document.querySelectorAll('#productTableBody tr');
            const searchStatus = document.getElementById('searchStatus');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                let hasMatches = false;

                productRows.forEach(row => {
                    const productName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const sku = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                    const category = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                    const brand = row.querySelector('td:nth-child(5)').textContent.toLowerCase();

                    if (productName.includes(searchTerm) || 
                        sku.includes(searchTerm) || 
                        category.includes(searchTerm) ||
                        brand.includes(searchTerm)) {
                        row.style.display = '';
                        hasMatches = true;
                    } else {
                        row.style.display = 'none';
                    }
                });

                if (!hasMatches && searchTerm.length > 0) {
                    searchStatus.classList.remove('hidden');
                } else {
                    searchStatus.classList.add('hidden');
                }
            });
        });
    </script>
@endsection