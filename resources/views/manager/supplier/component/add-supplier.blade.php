<!-- Add Supplier Modal -->
<div id="addModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay with smooth transition -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-900 bg-opacity-75 backdrop-blur-sm"></div>
        </div>

        <!-- Trick the browser into centering the modal contents -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal container with slide-in animation -->
        <div class="inline-block align-bottom bg-white rounded-t-lg rounded-b-none sm:rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <!-- Modal header with gradient and subtle shadow -->
            <div class="bg-gradient-to-r from-blue-700 to-blue-900 px-6 py-5 flex justify-between items-center border-b border-blue-600 rounded-t-lg">
                <div>
                    <h3 class="text-xl font-semibold text-white" id="modal-title">Add New Supplier</h3>
                    <p class="mt-1 text-sm text-blue-200">Fill in the supplier details below</p>
                </div>
                <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')"
                    class="text-blue-200 hover:text-white transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300 rounded-full p-1">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal body with improved spacing and subtle background pattern -->
            <div class="bg-gray-50 bg-opacity-50 p-6">
                <form action="{{ route('supplier.store') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <!-- Basic Information Section -->
                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                            <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <svg class="h-5 w-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Basic Information
                            </h4>
                            
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-6">
                                <!-- Supplier Name -->
                                <div class="sm:col-span-3">
                                    <label for="supplier_name" class="block text-sm font-medium text-gray-700 mb-1">Supplier Name <span class="text-red-500">*</span></label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" name="supplier_name" value="{{ old('supplier_name') }}" id="supplier_name"
                                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200"
                                            placeholder="John Doe" required>
                                    </div>
                                    @error('supplier_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Company -->
                                <div class="sm:col-span-3">
                                    <label for="company" class="block text-sm font-medium text-gray-700 mb-1">Company <span class="text-red-500">*</span></label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" name="company" id="company"
                                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200"
                                            placeholder="Acme Inc." required>
                                    </div>
                                    @error('company')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="sm:col-span-3">
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                            </svg>
                                        </div>
                                        <input type="email" name="email" id="email"
                                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200"
                                            placeholder="supplier@example.com" required>
                                    </div>
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div class="sm:col-span-3">
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone <span class="text-red-500">*</span></label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                            </svg>
                                        </div>
                                        <input type="tel" name="phone" id="phone"
                                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200"
                                            placeholder="+1 (555) 123-4567" required>
                                    </div>
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Address Information Section -->
                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                            <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <svg class="h-5 w-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Address Information
                            </h4>
                            
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-6">
                                <!-- Address -->
                                <div class="sm:col-span-6">
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" name="address" id="address"
                                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200"
                                            placeholder="123 Main St">
                                    </div>
                                    @error('address')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- City -->
                                <div class="sm:col-span-2">
                                    <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                    <input type="text" name="city" id="city"
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200"
                                        placeholder="New York">
                                    @error('city')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- State -->
                                <div class="sm:col-span-2">
                                    <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                                    <select id="state" name="state"
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200">
                                        <option value="">Select State</option>
                                        <option value="bihar">Bihar</option>
                                        <option value="uttar-pardesh">Uttar Pradesh</option>
                                        <!-- More states -->
                                    </select>
                                    @error('state')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Postal Code -->
                                <div class="sm:col-span-2">
                                    <label for="pincode" class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                    <input type="text" name="pincode" id="pincode"
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200"
                                        placeholder="10001">
                                    @error('pincode')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Country -->
                                <div class="sm:col-span-2">
                                    <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                    <select name="country" id="country"
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200">
                                        <option value="" disabled>Select Country</option>
                                        <option value="india" selected>India</option>
                                        <option value="USA">USA</option>
                                        <option value="china">China</option>
                                    </select>
                                    @error('country')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Address Purpose -->
                                <div class="sm:col-span-2">
                                    <label for="purpose" class="block text-sm font-medium text-gray-700 mb-1">Address Purpose</label>
                                    <select name="purpose" id="purpose"
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200">
                                        <option value="" disabled>Select Purpose</option>
                                        <option value="billing">Billing</option>
                                        <option value="shipping" selected>Shipping</option>
                                    </select>
                                    @error('purpose')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Address Type -->
                                <div class="sm:col-span-2">
                                    <label for="addressable_type" class="block text-sm font-medium text-gray-700 mb-1">Address Type</label>
                                    <select name="addressable_type" id="addressable_type"
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200">
                                        <option value="" disabled>Select Type</option>
                                        <option value="customer">Customer</option>
                                        <option value="supplier" selected>Supplier</option>
                                    </select>
                                    @error('addressable_type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information Section -->
                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                            <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <svg class="h-5 w-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                                Additional Information
                            </h4>
                            
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                                <textarea id="notes" name="notes" rows="3"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200"
                                    placeholder="Any special notes about this supplier"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer with improved button styling -->
                    <div class="mt-6 bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-lg border-t border-gray-200">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-6 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 sm:ml-3 sm:w-auto sm:text-sm">
                            <svg class="h-5 w-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Save Supplier
                        </button>
                        <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>