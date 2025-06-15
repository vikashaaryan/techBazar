@extends('manager.managerlayout')

@section('title', 'Manage Category')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Manage Categories <span class="text-sm text-gray-500">({{ count($categories) }})</span></h2>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Table -->
            <div class="md:col-span-2 overflow-auto">
                <table class="min-w-full bg-white rounded shadow">
                    <thead class="bg-blue-100 text-gray-700 text-left">
                        <tr>
                            <th class="py-2 px-3 border">ID</th>
                            <th class="py-2 px-3 border">Name</th>
                            <th class="py-2 px-3 border">Description</th>
                            <th class="py-2 px-3 border">Parent</th>
                            <th class="py-2 px-3 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-3 border">{{ $category->id }}</td>
                                <td class="py-2 px-3 border">{{ $category->cat_title }}</td>
                                <td class="py-2 px-3 border">{{ $category->description }}</td>
                                <td class="py-2 px-3 border">{{ $category->parent ? $category->parent->cat_title : '-' }}</td>
                                <td class="py-2 px-3 border flex gap-2">
                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white text-sm px-3 py-1 rounded hover:bg-red-600 transition">
                                            Delete
                                        </button>
                                    </form>
                                    <a href="{{ route('category.edit', $category->id) }}"
                                        class="bg-yellow-400 text-white text-sm px-3 py-1 rounded hover:bg-yellow-500 transition">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Create Form -->
            <div class="bg-gray-50 p-5 rounded shadow">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Create Category</h3>
                <form action="{{ route('category.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Category Title</label>
                        <input type="text" name="cat_title" value="{{ old('cat_title') }}"
                            class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        @error('cat_title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Description</label>
                        <input type="text" name="description" value="{{ old('description') }}"
                            class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Parent Category -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Parent Category</label>
                        <select name="parent_cat"
                            class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            <option value="">-- Select Parent Category --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->cat_title }}</option>
                            @endforeach
                        </select>
                        @error('parent_cat')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-300">
                            Create Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
