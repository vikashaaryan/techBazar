@foreach ($suppliers as $supplier)
<div id="editSupplierModal-{{ $supplier->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- Modal Panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Modal Header -->
                <div class="bg-indigo-600 px-6 py-4 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-white">Edit Supplier</h2>
                    <button type="button" data-modal-hide="editSupplierModal-{{ $supplier->id }}" class="text-white hover:text-gray-300">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="bg-white p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Supplier Info -->
                        <div>
                            <h3 class="text-base font-medium text-gray-900 mb-4 border-b pb-2">Supplier Info</h3>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Supplier Name *</label>
                                <input type="text" name="supplier_name" value="{{ old('supplier_name', $supplier->supplier_name) }}"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2" required>
                                @error('supplier_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Company *</label>
                                <input type="text" name="company" value="{{ old('company', $supplier->company) }}"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm p-2" required>
                                @error('company')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Email *</label>
                                <input type="email" name="email" value="{{ old('email', $supplier->email) }}"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm p-2" required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Phone *</label>
                                <input type="text" name="phone" value="{{ old('phone', $supplier->phone) }}"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm p-2" required>
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Notes</label>
                                <textarea name="notes" rows="2"
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm p-2">{{ old('notes', $supplier->notes) }}</textarea>
                                @error('notes')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status *</label>
                                <select name="status" class="mt-1 w-full rounded-md border-gray-300 shadow-sm p-2" required>
                                    <option value="1" {{ old('status', $supplier->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $supplier->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Address Info -->
                        <div>
                            <h3 class="text-base font-medium text-gray-900 mb-4 border-b pb-2">Address Info</h3>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Address *</label>
                                <textarea name="address" class="mt-1 w-full rounded-md border-gray-300 shadow-sm p-2" required>{{ old('address', $supplier->address->address ?? '') }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">City *</label>
                                    <input type="text" name="city" value="{{ old('city', $supplier->address->city ?? '') }}"
                                        class="mt-1 w-full rounded-md border-gray-300 shadow-sm p-2" required>
                                    @error('city')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">State *</label>
                                    <input type="text" name="state" value="{{ old('state', $supplier->address->state ?? '') }}"
                                        class="mt-1 w-full rounded-md border-gray-300 shadow-sm p-2" required>
                                    @error('state')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Country *</label>
                                    <input type="text" name="country" value="{{ old('country', $supplier->address->country ?? '') }}"
                                        class="mt-1 w-full rounded-md border-gray-300 shadow-sm p-2" required>
                                    @error('country')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Pincode *</label>
                                    <input type="text" name="pincode" value="{{ old('pincode', $supplier->address->pincode ?? '') }}"
                                        class="mt-1 w-full rounded-md border-gray-300 shadow-sm p-2" required>
                                    @error('pincode')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <input type="hidden" name="purpose" value="{{ old('purpose', $supplier->address->purpose ?? 'billing') }}">
                            <input type="hidden" name="addressable_type" value="App\Models\Supplier">
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="bg-gray-50 px-6 py-3 flex justify-end">
                    <button type="submit" class="inline-flex justify-center items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow hover:bg-indigo-700">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach