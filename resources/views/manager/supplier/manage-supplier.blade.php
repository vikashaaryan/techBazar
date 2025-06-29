@extends('manager.managerlayout')

@section('title')
    Supplier Management
@endsection

@section('content')
    <div class="flex-1 p-6">
        <!-- Header with Gradient Background -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-xl shadow-md p-6 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-black">Supplier Management</h1>
                    <p class="text-gray-600 mt-2">Manage your supplier network efficiently</p>
                </div>
                <button onclick="document.getElementById('addModal').classList.remove('hidden')"
                    class="mt-4 md:mt-0 px-6 py-3 bg-white text-blue-600 rounded-lg shadow hover:shadow-lg transition-all flex items-center hover:bg-blue-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                            clip-rule="evenodd" />
                    </svg>
                    Add New Supplier
                </button>
            </div>
        </div>

        <!-- Search and Filter Bar -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="relative w-full md:w-96">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" id="searchInput" placeholder="Search suppliers..."
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <select id="statusFilter"
                    class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">
                    <option value="all">All Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                
                <button id="resetFilters" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                    Reset Filters
                </button>
            </div>
        </div>

        <!-- Supplier Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Supplier
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Company
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contact
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody id="supplierTableBody" class="bg-white divide-y divide-gray-100">
                        @foreach ($suppliers as $supplier)
                            <tr class="supplier-row hover:bg-gray-50 transition-colors" data-status="{{ $supplier->status }}" data-search="{{ strtolower($supplier->supplier_name.' '.$supplier->company.' '.$supplier->email.' '.$supplier->phone) }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            @php
                                                $initials = '';
                                                $words = explode(' ', $supplier->supplier_name);
                                                foreach ($words as $word) {
                                                    $initials .= strtoupper(substr($word, 0, 1));
                                                    if(strlen($initials) >= 2) break;
                                                }
                                            @endphp
                                            <span class="text-blue-600 font-medium">{{ $initials }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900 supplier-name">{{ $supplier->supplier_name }}</div>
                                            <div class="text-xs text-gray-500 supplier-email">{{ $supplier->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 supplier-company">{{ $supplier->company }}</div>
                                    <div class="text-xs text-gray-500">Supplier ID: {{ $supplier->id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 supplier-phone">{{ $supplier->phone }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap supplier-status">
                                    @if ($supplier->status == '1')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-3">
                                        <button data-modal-target="editSupplierModal-{{ $supplier->id }}" data-modal-toggle="editSupplierModal-{{ $supplier->id }}"
                                            class="text-blue-500 hover:text-blue-700 p-1 rounded-full hover:bg-blue-50 transition"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </button>
                                       
                                        <button class="text-gray-500 hover:text-gray-700 p-1 rounded-full hover:bg-gray-50 transition" title="View Details">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

           
        </div>

        <!-- Empty State -->
        <div id="emptyState" class="hidden bg-white rounded-xl shadow-md p-8 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">No suppliers found</h3>
            <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
            <button id="resetEmptyState" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Reset filters
            </button>
        </div>
        
        @include('manager.supplier.component.add-supplier')
        @include('manager.supplier.component.edit-supplier')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const resetFilters = document.getElementById('resetFilters');
            const supplierRows = document.querySelectorAll('.supplier-row');
            const emptyState = document.getElementById('emptyState');
            const resetEmptyState = document.getElementById('resetEmptyState');
            const supplierTableBody = document.getElementById('supplierTableBody');

            function filterSuppliers() {
                const searchTerm = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value;
                let visibleRows = 0;

                supplierRows.forEach(row => {
                    const searchContent = row.getAttribute('data-search');
                    const rowStatus = row.getAttribute('data-status');
                    const matchesSearch = searchContent.includes(searchTerm);
                    const matchesStatus = statusValue === 'all' || rowStatus === statusValue;

                    if (matchesSearch && matchesStatus) {
                        row.style.display = '';
                        visibleRows++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Show empty state if no rows visible
                if (visibleRows === 0) {
                    supplierTableBody.style.display = 'none';
                    emptyState.classList.remove('hidden');
                } else {
                    supplierTableBody.style.display = '';
                    emptyState.classList.add('hidden');
                }
            }

            // Event listeners
            searchInput.addEventListener('input', filterSuppliers);
            statusFilter.addEventListener('change', filterSuppliers);

            resetFilters.addEventListener('click', function() {
                searchInput.value = '';
                statusFilter.value = 'all';
                filterSuppliers();
            });

            resetEmptyState.addEventListener('click', function() {
                searchInput.value = '';
                statusFilter.value = 'all';
                filterSuppliers();
            });

            // Initial filter in case page loads with values
            filterSuppliers();
        });
    </script>
@endsection