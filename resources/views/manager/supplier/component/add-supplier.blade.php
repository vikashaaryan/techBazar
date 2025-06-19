
        <!-- Add Supplier Modal -->
        <div id="addModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- Modal content -->
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div>
                        <!-- Modal header -->
                        <div
                            class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4 flex justify-between items-center rounded-t-lg">
                            <h3 class="text-lg font-medium text-white">Add New Supplier</h3>
                            <button onclick="document.getElementById('addModal').classList.add('hidden')"
                                class="text-white hover:text-gray-200">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Modal body -->
                        <div class="p-6">
                            <form action="{{ route('supplier.store') }}" method="POST">
                                @csrf
                                <div class="bg-white shadow-sm rounded-lg p-6">
                                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-6">
                                        <!-- Supplier Name -->
                                        <div class="sm:col-span-3">
                                            <label for="supplier_name"
                                                class="block text-sm font-medium text-gray-700 mb-1">Supplier Name <span
                                                    class="text-red-500">*</span></label>
                                            <div class="relative rounded-md shadow-sm">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <input type="text" name="supplier_name"
                                                    value="{{ old('supplier_name') }}" id="supplier_name"
                                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                    placeholder="John Doe">
                                                @error('supplier_name')
                                                    <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Company -->
                                        <div class="sm:col-span-3">
                                            <label for="company"
                                                class="block text-sm font-medium text-gray-700 mb-1">Company <span
                                                    class="text-red-500">*</span></label>
                                            <div class="relative rounded-md shadow-sm">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <input type="text" name="company" id="company"
                                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                    placeholder="Acme Inc.">
                                                @error('company')
                                                    <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="sm:col-span-3">
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700 mb-1">Email <span
                                                    class="text-red-500">*</span></label>
                                            <div class="relative rounded-md shadow-sm">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                                    </svg>
                                                </div>
                                                <input type="email" name="email" id="email"
                                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                    placeholder="supplier@example.com">
                                                @error('email')
                                                    <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Phone -->
                                        <div class="sm:col-span-3">
                                            <label for="phone"
                                                class="block text-sm font-medium text-gray-700 mb-1">Phone <span
                                                    class="text-red-500">*</span></label>
                                            <div class="relative rounded-md shadow-sm">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                                    </svg>
                                                </div>
                                                <input type="tel" name="phone" id="phone"
                                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                    placeholder="+1 (555) 123-4567">
                                                @error('phone')
                                                    <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Address -->
                                        <div class="sm:col-span-6">
                                            <label for="address"
                                                class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
                                            <div class="relative rounded-md shadow-sm">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <input type="text" name="address" id="address"
                                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                    placeholder="123 Main St">
                                                @error('address')
                                                    <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- City, State, Postal Code -->
                                        <div class="sm:col-span-2">
                                            <label for="city"
                                                class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                            <input type="text" name="city" id="city"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                placeholder="New York">
                                            @error('city')
                                                <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="sm:col-span-2">
                                            <label for="state"
                                                class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                                            <select id="state" name="state"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                <option value="">Select</option>
                                                <option value="bihar">Bihar</option>
                                                <option value="uttar-pardesh">Uttar pardesh</option>
                                                <!-- More states -->
                                            </select>
                                            @error('state')
                                                <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="sm:col-span-2">
                                            <label for="pincode"
                                                class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                            <input type="text" name="pincode" id="pincode"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                placeholder="10001">
                                            @error('pincode')
                                                <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        {{-- country --}}
                                        <div class="sm:col-span-2">
                                            <label for="country" class="block text-sm font-medium text-gray-700 mb-1">
                                                country</label>
                                            <select name="country" id="country"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                placeholder="10001">
                                                <option value="" disabled>Select Country</option>
                                                <option value="india" selected>india</option>
                                                <option value="USA">USA</option>
                                                <option value="chaina">USA</option>
                                            </select>
                                            @error('country')
                                                <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- address purpose --}}
                                        <div class="sm:col-span-2">
                                            <label for="purpose"
                                                class="block text-sm font-medium text-gray-700 mb-1">Address
                                                Purpose</label>
                                            <select name="purpose" id="purpose"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                placeholder="10001">
                                                <option value="" disabled>Select Address-type</option>
                                                <option value="billing">Billing</option>
                                                <option value="shipping" selected>shipping</option>
                                            </select>
                                            @error('purpose')
                                                <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        {{-- address type --}}
                                        <div class="sm:col-span-2">
                                            <label for="addressable_type"
                                                class="block text-sm font-medium text-gray-700 mb-1">Address Type</label>
                                            <select name="addressable_type" id="addressable_type"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                placeholder="10001">
                                                <option value="" disabled>Select Address-type</option>
                                                <option value="customer">customer</option>
                                                <option value="supplier" selected>supplier</option>
                                            </select>
                                            @error('addressable_type')
                                                <p class="text-red-500 font-semibold text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Additional Information -->
                                        <div class="sm:col-span-6">
                                            <label for="notes"
                                                class="block text-sm font-medium text-gray-700 mb-1">Additional
                                                Notes</label>
                                            <textarea id="notes" name="notes" rows="3"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                placeholder="Any special notes about this supplier"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="submit"
                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                        Save Supplier
                                    </button>
                                    <button type="button"
                                        onclick="document.getElementById('addModal').classList.add('hidden')"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>