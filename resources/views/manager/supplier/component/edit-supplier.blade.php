@foreach ($suppliers as $supplier)
<div id="editSupplierModal-{{ $supplier->id }}" class="fixed inset-0 m-2 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- Modal Content -->
        <div class="inline-block align-bottom bg-white pt-8 m-5 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <form action="{{route('supplier.update', $supplier->id)}}" method="POST">
                @csrf
                @method('PUT')

                <!-- Modal Header -->
                <div class="bg-blue-600 p-4 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-white">Edit supplier</h3>
                    <button data-modal-hide="editSupplierModal-{{ $supplier->id }}"
                        class="text-white hover:text-gray-200">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="bg-white p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Personal Info -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Personal Information</h3>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="supplier_name" value="{{ $supplier->supplier_name }}"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Contact</label>
                                <input type="text" name="phone" value="{{ $supplier->phone }}"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" value="{{ $supplier->email }}"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Company</label>
                                <input type="text" name="company" value="{{ $supplier->company }}"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                                    <select name="gender"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                        <option value="male" {{ $supplier->gender == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ $supplier->gender == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ $supplier->gender == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2 border" required>
                                        <option value="1" {{ old('status', $supplier->status) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $supplier->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Address Info -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Address Information</h3>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Address</label>
                                <input type="text" name="address" value="{{ $supplier->address->address ?? '' }}"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">City</label>
                                    <input type="text" name="city" value="{{ $supplier->address->city ?? '' }}"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">State</label>
                                    <input type="text" name="state" value="{{ $supplier->address->state ?? '' }}"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Country</label>
                                    <input type="text" name="country" value="{{ $supplier->address->country ?? '' }}"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Postal Code</label>
                                    <input type="text" name="pincode" value="{{ $supplier->address->pincode ?? '' }}"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">
                        Save Changes
                    </button>
                   
                </div>
            </form>
        </div>
    </div>
</div>

@endforeach

