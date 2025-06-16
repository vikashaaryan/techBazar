@extends('manager.managerlayout')

@section('title')
    Customer Details
@endsection

@section('content')
    <!-- Main Content -->
    <div class="m-3 rounded bg-white p-4  ">
        <div class="bg-blue-600 rounded px-6 py-4">
            <h2 class="text-2xl font-semibold text-white">Add Customer Details</h2>
        </div>
        <form action="{{ route('customer.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
            @csrf
            <!-- Personal Information Section -->
            <div class="md:col-span-2">
                <h3 class="text-lg font-medium text-gray-800 border-b pb-2 mb-4">Personal Information</h3>
            </div>
            <!-- Full Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                @error('name')
                    <p class="text-red-500 text-sm font-semibold">{{ $message }}</p>
                @enderror
            </div>
            <!-- Contact -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Contact</label>
                <input type="text" name="contact" value="{{ old('contact') }}"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                @error('contact')
                    <p class="text-red-500 text-sm font-semibold">{{ $message }}</p>
                @enderror
            </div>
            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                @error('email')
                    <p class="text-red-500 text-sm font-semibold">{{ $message }}</p>
                @enderror
            </div>
            <!-- Gender -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                <select name="gender"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                  @error('gender')
                    <p class="text-red-500 text-sm font-semibold">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" 
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="">Select Status</option>
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
                  @error('status')
                    <p class="text-red-500 text-sm font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address Section -->
            <div class="md:col-span-2">
                <h3 class="text-lg font-medium text-gray-800 border-b pb-2 mb-4">Address Details</h3>
            </div>

            <!-- Address -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Full Address</label>
                <textarea name="address" rows="3"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">{{ old('address') }}</textarea>
                      @error('address')
                    <p class="text-red-500 text-sm font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Addressable Type (customer/supplier) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Address Type</label>
                <select name="addressable_type"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="">Select Type</option>
                    <option value="customer" selected>Customer</option>
                    <option value="supplier">Supplier</option>
                </select>
                  @error('addressable_type')
                    <p class="text-red-500 text-sm font-semibold">{{ $message }}</p>
                @enderror
            </div>
            <!-- Type (billing/shipping) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Purpose</label>
                <select name="purpose"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="">Select Purpose</option>
                    <option value="billing" selected>Billing</option>
                    <option value="shipping">Shipping</option>
                </select>
                 @error('purpose')
                    <p class="text-red-500 text-sm font-semibold">{{ $message }}</p>
                @enderror
            </div>
            <!-- Location Section -->
            <div class="md:col-span-2">
                <h3 class="text-lg font-medium text-gray-800 border-b pb-2 mb-4">Location Information</h3>
            </div>

            <!-- City -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                <input type="text" name="city" value="{{ old('city') }}"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                 @error('city')
                    <p class="text-red-500 text-sm font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <!-- State -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                <input type="text" name="state" value="{{old('city') }}"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                       @error('state')
                    <p class="text-red-500 text-sm font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Country -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                <input type="text" name="country" value="{{ old('country') }}"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        @error('country')
                    <p class="text-red-500 text-sm font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pincode -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Postal/Zip Code</label>
                <input type="text" name="pincode" value="{{ old('pincode') }}"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        @error('pincode')
                    <p class="text-red-500 text-sm font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="md:col-span-2 pt-4 flex justify-end space-x-3">
                <button type="reset" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                    Reset
                </button>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                    Save Address
                </button>
            </div>
        </form>
    </div>
@endsection