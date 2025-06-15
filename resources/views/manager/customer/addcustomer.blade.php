@extends('manager.managerlayout')

@section('title')
    Customer Details
@endsection

@section('content')
   <!-- Main Content -->
<div class="m-1 rounded bg-gray-100 ">
    <div class="bg-blue-600 rounded px-6 py-4">
        <h2 class="text-2xl font-semibold text-white">Add Customer Details</h2>
    </div>
    <form action="" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
        @csrf
        <!-- Personal Information Section -->
        <div class="md:col-span-2">
            <h3 class="text-lg font-medium text-gray-800 border-b pb-2 mb-4">Personal Information</h3>
        </div>
        <!-- Full Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
            <input type="text" name="full_name" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required>
        </div>
        <!-- Contact -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Contact</label>
            <input type="text" name="contact" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required>
        </div>
        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required>
        </div>
        <!-- Gender -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
            <select name="gender" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>

        <!-- Address Section -->
        <div class="md:col-span-2">
            <h3 class="text-lg font-medium text-gray-800 border-b pb-2 mb-4">Address Details</h3>
        </div>

        <!-- Address -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Full Address</label>
            <textarea name="address" rows="3" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required></textarea>
        </div>

        <!-- Addressable Type (customer/supplier) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Address Type</label>
            <select name="addressable_type" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required>
                <option value="">Select Type</option>
                <option value="customer">Customer</option>
                <option value="supplier">Supplier</option>
            </select>
        </div>
        <!-- Type (billing/shipping) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Purpose</label>
            <select name="type" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required>
                <option value="">Select Purpose</option>
                <option value="billing">Billing</option>
                <option value="shipping">Shipping</option>
            </select>
        </div>
        <!-- Location Section -->
        <div class="md:col-span-2">
            <h3 class="text-lg font-medium text-gray-800 border-b pb-2 mb-4">Location Information</h3>
        </div>

        <!-- City -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
            <input type="text" name="city" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required>
        </div>

        <!-- State -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
            <input type="text" name="state" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required>
        </div>

        <!-- Country -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
            <input type="text" name="country" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required>
        </div>

        <!-- Pincode -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Postal/Zip Code</label>
            <input type="text" name="pincode" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required>
        </div>

        <!-- Submit Button -->
        <div class="md:col-span-2 pt-4 flex justify-end space-x-3">
            <button type="reset" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                Reset
            </button>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                Save Address
            </button>
        </div>
    </form>
</div>
@endsection
