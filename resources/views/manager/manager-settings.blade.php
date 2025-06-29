@extends('manager.managerlayout')

@section('title')
    Manager Settings
@endsection

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
            <!-- Profile Header -->
            <div class="bg-blue-50 py-4 px-6 border-b border-gray-200">
                <h1 class="text-xl font-semibold text-gray-800">Manager Profile Settings</h1>
            </div>

            <!-- Profile Picture -->
            <div class="flex flex-col items-center py-6">
                <div class="relative">
                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=random" 
                        class="w-24 h-24 rounded-full border-4 border-white shadow-md" alt="Profile">
                </div>
                <h2 class="mt-2 text-lg font-medium">John Doe</h2>
            </div>

            <!-- Settings Form -->
            <div class="px-6 pb-8">
                    
                <form class="space-y-6">
                    <!-- Basic Information Section -->
                    <div class="space-y-4">
                        <h2 class="text-lg font-medium text-gray-700">Basic Information</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Full Name</label>
                                <input type="text" value=""
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Contact Number</label>
                                <input type="text" value="+1 (555) 123-4567"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                           <div>
                              <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                              <input type="email" value="john.doe@example.com"
                                  class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                          </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Salary</label>
                                <input type="number" value="75000"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Employment Details -->
                    <div class="space-y-4">
                        <h2 class="text-lg font-medium text-gray-700">Employment Details</h2>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Join Date</label>
                                <input type="date" value="2022-01-15"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                                <select class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Role</label>
                            <select class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                <option value="staff">Staff</option>
                                <option value="admin" selected>Admin</option>
                            </select>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="space-y-4">
                        <h2 class="text-lg font-medium text-gray-700">Address Information</h2>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Full Address</label>
                            <textarea rows="3"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">123 Main Street, Apt 4B, New York, NY 10001</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">City</label>
                                <input type="text" value="New York"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">State</label>
                                <input type="text" value="New York"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Country</label>
                                <input type="text" value="United States"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Postal Code</label>
                                <input type="text" value="10001"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Address Type</label>
                                <select class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    <option value="customer">Customer</option>
                                    <option value="supplier">Supplier</option>
                                    <option value="staff" selected>Staff</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Purpose</label>
                                <select class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    <option value="billing">Billing</option>
                                    <option value="shipping">Shipping</option>
                                    <option value="manage_shop" selected>Manage Shop</option>
                                </select>
                            </div>
                        </div>
                        
                        <div>
                           <label class="block text-sm font-medium text-gray-600 mb-1">Password</label>
                           <input type="password" placeholder="Leave blank to keep current"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">
                       </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="pt-6 flex justify-end space-x-3">
                        <button type="button"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                            Save Changes
                        </button>
                    </div>

                </form>
               

            </div>
        </div>
    </div>
@endsection