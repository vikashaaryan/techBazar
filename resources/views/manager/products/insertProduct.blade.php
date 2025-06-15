@extends('manager.managerlayout')

@section('title')
    Insert Product
@endsection

@section('content')
    <div class="min-h-screen bg-gray-50 p-6">
        <h2 class="text-2xl font-semibold mb-4">Add New Product</h2>

        <form action="" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded shadow grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf

            <!-- Product Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <!-- SKU -->
            <div>
                <label class="block text-sm font-medium text-gray-700">SKU</label>
                <input type="text" name="sku" class="mt-1 block w-full rounded-md border  border-gray-300 shadow-sm"
                    required>
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <input type="text" name="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    required>
            </div>

            <!-- Unit -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Unit</label>
                <select name="unit" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    <option value="">Select Unit</option>
                    <option value="pcs">Pcs</option>
                    <option value="box">Box</option>
                    <option value="kg">Kg</option>
                    <option value="ltr">Litre</option>
                </select>
            </div>

            <!-- MRP -->
            <div>
                <label class="block text-sm font-medium text-gray-700">MRP</label>
                <input type="number" name="mrp" step="0.01"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <!-- Sell Price -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Sell Price</label>
                <input type="number" name="sell_price" step="0.01"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <!-- Quantity -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" name="qty" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    required>
            </div>

            <!-- Brand -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Brand</label>
                <input type="text" name="brand" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    required>
            </div>

            <!-- Barcode (Optional) -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Barcode (Optional)</label>
                <input type="text" name="barcode" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <!-- Warranty Period -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Warranty Period</label>
                <input type="text" name="warranty" placeholder="e.g. 6 months, 1 year"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <!-- Image Upload -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Product Image</label>
                <input type="file" name="image" accept="image/*"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <!-- Description -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>
            </div>

            <!-- Submit Button -->
            <div class="md:col-span-2">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection
