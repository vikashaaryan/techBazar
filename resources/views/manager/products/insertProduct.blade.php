@extends('manager.managerlayout')

@section('title')
    Insert Product
@endsection

@section('content')
    <div class="min-h-screen bg-gray-100 p-4 md:p-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Add New Product</h1>
                <p class="text-gray-600 mt-2">Fill in the details below to add a new product to your inventory</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
                    @csrf

                    <!-- Grid Layout -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Product Information Section -->
                        <div class="md:col-span-2">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Product
                                Information</h2>
                        </div>

                        <!-- Product Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Enter product name">
                            @error('name')
                                <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- SKU -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">SKU *</label>
                            <input type="text" name="sku" value="{{ old('sku') }}"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Product SKU">
                            @error('sku')
                                <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                            <select name="category"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="{{ old('category') }}" disabled>--- Select category ---</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->cat_title }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Unit -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Unit *</label>
                            <select name="unit" value="{{ old('unit') }}"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="" disabled selected>Select unit</option>
                                <option value="pcs">Pieces</option>
                                <option value="box">Box</option>
                                <option value="kg">Kilogram</option>
                                <option value="ltr">Litre</option>
                            </select>
                            @error('unit')
                                <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pricing Section -->
                        <div class="md:col-span-2 mt-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Pricing &
                                Inventory</h2>
                        </div>

                        <!-- MRP -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">MRP *</label>
                            <div class="">
                                <input type="number" name="mrp" value="{{ old('mrp') }}"
                                    class="w-full pl-8 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                    placeholder="0.00">
                                @error('mrp')
                                    <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Sell Price -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sell Price *</label>
                            <div class="">
                                <input type="number" name="sell_price" step="0.01" value="{{ old('sell_price') }}"
                                    class="w-full pl-8 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                    placeholder="0.00">
                                @error('sell_price')
                                    <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Quantity *</label>
                            <input type="number" name="qty" value="{{ old('qty') }}"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Available quantity">
                            @error('qty')
                                <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Brand -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Brand *</label>
                            <input type="text" name="brand" value="{{ old('brand') }}"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Product brand">
                            @error('brand')
                                <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Additional Information Section -->
                        <div class="md:col-span-2 mt-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Additional
                                Information</h2>
                        </div>

                        <!-- Barcode -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Barcode (Optional)</label>
                            <input type="text" name="barcode" value="{{ old('barcode') }}"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Product barcode">
                            @error('barcode')
                                <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Warranty -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Warranty Period *</label>
                            <input type="text" name="warranty" value="{{ old('warranty') }}"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="e.g. 6 months, 1 year">
                            @error('warranty')
                                <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Product Image *</label>
                            <div class="mt-1 flex items-center">
                                <label
                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to
                                                upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG (MAX. 5MB)</p>
                                    </div>
                                    <input type="file" name="image" accept="image/*" class="hidden">
                                    @error('image')
                                        <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                                    @enderror
                                </label>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                            <textarea name="description" rows="4"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Detailed product description...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 flex justify-end space-x-4">
                        <button type="reset"
                            class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                            Reset
                        </button>
                        <button type="submit"
                            class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition">
                            Add Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection