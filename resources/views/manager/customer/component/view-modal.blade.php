@foreach ($customers as $customer)
<div id="customerModal-{{ $customer->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Modal Backdrop -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- Modal Content -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <!-- Modal Header -->
                <div class="bg-blue-600 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-white">Customer Details</h3>
                    <button onclick="closeCustomerModal({{ $customer->id }})"
                        class="text-white hover:text-gray-200">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Personal Information -->
                        <div class="bg-gray-100 p-6 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Personal Information
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span
                                            class="text-blue-600 text-xl font-medium">{{ strtoupper(substr($customer->name, 0, 1)) }}</span>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-medium text-gray-900">{{ $customer->name }}</h4>
                                        <p class="text-sm text-gray-500">Customer ID: {{ $customer->id }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Contact</label>
                                        <p class="mt-1 text-gray-900">{{ $customer->contact }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Email</label>
                                        <p class="mt-1 text-gray-900">{{ $customer->email }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Gender</label>
                                        <p class="mt-1 text-gray-900 capitalize">{{ $customer->gender }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Status</label>
                                        @if ($customer->status == '1')
                                            <span
                                                class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        @else
                                            <span
                                                class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Inactive
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-100 p-5 rounded">
                            <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Address Information
                            </h2>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Address</label>
                                    <p class="mt-1 text-gray-900">
                                        {{ $customer->address ? $customer->address->address : '-' }}</p>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">City</label>
                                        <p class="mt-1 text-gray-900">{{ $customer->address->city ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">State</label>
                                        <p class="mt-1 text-gray-900">{{ $customer->address->state ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Country</label>
                                        <p class="mt-1 text-gray-900">{{ $customer->address->country ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Postal Code</label>
                                        <p class="mt-1 text-gray-900">{{ $customer->address->pincode ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeCustomerModal({{ $customer->id }})"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                    Close
                </button>
               
            </div>
        </div>
    </div>
</div>
@endforeach