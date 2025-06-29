@extends('manager.managerlayout')

@section('title', 'Manage Categories')

@section('content')
<div class="p-6 min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Category Management</h1>
                <p class="text-gray-600 mt-1">Total Categories: <span class="font-semibold">{{ count($categories) }}</span></p>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Categories Table -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-white">
                        <h3 class="font-medium text-gray-800">All Categories</h3>
                        <div class="relative w-64">
                            <input type="text" id="categorySearch" placeholder="Search categories..." 
                                   class="w-full pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200">
                            <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        
                        
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parent</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($categories as $category)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $category->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 bg-blue-100 rounded-md flex items-center justify-center">
                                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $category->cat_title }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $category->description ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($category->parent)
                                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">{{ $category->parent->cat_title }}</span>
                                        @else
                                        <span class="text-gray-400">—</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('category.edit', $category->id) }}" 
                                               class="text-blue-600 hover:text-blue-900 transition-colors duration-200"
                                               title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 transition-colors duration-200" title="Delete">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Create Category Form -->
            <div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-white">
                        <h3 class="font-medium text-gray-800">Create New Category</h3>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('category.store') }}" method="POST" class="space-y-5">
                            @csrf
                            <div>
                                <label for="cat_title" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                                <input type="text" id="cat_title" name="cat_title" value="{{ old('cat_title') }}"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200">
                                @error('cat_title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea id="description" name="description" rows="2"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="parent_cat" class="block text-sm font-medium text-gray-700 mb-1">Parent Category</label>
                                <select id="parent_cat" name="parent_cat"
                                    class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-200">
                                    <option value="">None (Top Level)</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('parent_cat') == $cat->id ? 'selected' : '' }}>{{ $cat->cat_title }}</option>
                                    @endforeach
                                </select>
                                @error('parent_cat')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="pt-2">
                                <button type="submit"
                                    class="w-full px-4 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                                    Create Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('categorySearch');
        const tableRows = document.querySelectorAll('tbody tr');
        const noResultsMessage = document.createElement('tr');
        noResultsMessage.innerHTML = `
            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                No categories found matching your search
            </td>
        `;
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            let hasMatches = false;
            
            // Hide all rows initially
            tableRows.forEach(row => {
                row.style.display = 'none';
            });
            
            // Show rows that match the search term
            tableRows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const description = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                const parent = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                
                if (name.includes(searchTerm) || 
                    description.includes(searchTerm) || 
                    parent.includes(searchTerm)) {
                    row.style.display = '';
                    hasMatches = true;
                }
            });
            
            // Show "no results" message if no matches
            const tbody = document.querySelector('tbody');
            const existingNoResults = document.querySelector('.no-results-message');
            
            if (!hasMatches && searchTerm.length > 0) {
                if (!existingNoResults) {
                    noResultsMessage.classList.add('no-results-message');
                    tbody.appendChild(noResultsMessage);
                }
            } else {
                if (existingNoResults) {
                    tbody.removeChild(existingNoResults);
                }
            }
        });
    });
    </script>
@endsection