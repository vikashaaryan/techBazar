@extends('manager.managerlayout')

@section('title', 'Create-Quote')

@section('content')
    <div class="min-h-screen m-3 rounded bg-white py-12">
        <div class="max-w-6xl mx-auto bg-white  shadow-xl rounded-xl overflow-hidden">

            <!-- Main Content -->
            <h2 class="text-center text-2xl mb-4 underline">Quotation</h2>
            <div class="flex flex-col md:flex-row p-8 gap-8">
                <!-- Left Column - Form -->
                <div class="w-full md:w-8/12">
                    <form action="{{ route('quotes.store') }}" method="post" class="space-y-6">
                        @csrf
                        <!-- Quotation Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Quotation Number</label>
                                <input type="text" name="quotation-no"
                                    class="w-full border-b-2 border-gray-300 focus:border-blue-500 py-2 px-1 bg-gray-50 rounded-t">
                                @error('quotation-no')
                                    <p class=" text-red-500 font-semibold text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Quotation Date</label>
                                <input type="date" value="<?php echo date('Y-m-d'); ?>"
                                    class="w-full border-b-2 border-gray-300 focus:border-blue-500 py-2 px-1 bg-gray-50 rounded-t">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Valid Till Date</label>
                                <input type="date" name="valid_date"
                                    class="w-full border-b-2 border-gray-300 focus:border-blue-500 py-2 px-1 bg-gray-50 rounded-t">
                                @error('valid_date')
                                    <p class=" text-red-500 font-semibold text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status"
                                    class="w-full border-b-2 border-gray-300 focus:border-blue-500 py-2 px-1 bg-gray-50 rounded-t">
                                    <option>Select Status</option>
                                    <option value="draft" selected>Draft</option>
                                    <option value="sent">Sent</option>
                                    <option value="accepted">Accepted</option>
                                    <option value="rejected">Rejected</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                                @error('status')
                                    <p class=" text-red-500 font-semibold text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Customer Selection -->
                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-100">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Customer Information</h3>
                            <div class="space-y-4">
                                <select name="customer_id"
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    <option>Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{ $customer->name }}</option>
                                    @endforeach

                                </select>
                                @error('customer_id')
                                    <p class=" text-red-500 font-semibold text-xs">{{ $message }}</p>
                                @enderror
                                <div class="flex items-center">
                                    <div class="flex-grow border-t border-gray-300"></div>
                                    <span class="mx-4 text-gray-500">OR</span>
                                    <div class="flex-grow border-t border-gray-300"></div>
                                </div>
                                <a href="{{ route('customer.index') }}"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                                    + Add New Customer
                                </a>
                            </div>
                        </div>

                        <!-- Include Alpine.js -->
                        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

                        <div x-data="{ items: [{}] }" class="space-y-4">

                            <!-- Loop through each item -->
                            <template x-for="(item, index) in items" :key="index">
                                <div class="flex items-start gap-3 p-4 bg-white border rounded-xl shadow-sm">

                                    <!-- Controls -->
                                    <div class="flex flex-col items-center gap-2 pt-1 text-gray-400">
                                        <!-- Duplicate Button -->
                                        <button type="button" @click="items.splice(index + 1, 0, {...item})"
                                            title="Duplicate" class="hover:text-green-500 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>

                                        <!-- Delete Button -->
                                        <button type="button" @click="items.length > 1 && items.splice(index, 1)"
                                            title="Delete" class="hover:text-red-500 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Row Content -->
                                    <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Left Side -->
                                        <div class="space-y-3 flex flex-col">
                                            <select name="" id="" class="w-full p-2 border rounded text-gray-600">
                                                <option value="">Select Items</option>
                                               @foreach($products as $product)
                                                <option value="{{ $product-> id}}">{{ $product->name }}</option>
                                               @endforeach
                                            </select>
                                            <textarea placeholder="Description"
                                                class="w-full h-20 border rounded-md bg-gray-50 px-3 py-2 text-sm resize-none"></textarea>
                                        </div>

                                        <!-- Right Side -->
                                        <div class="grid grid-cols-2 gap-4">
                                            <input type="number" placeholder="Qty"
                                                class="col-span-2 border rounded-md px-3 py-2 text-sm" />

                                            <select class="col-span-2 border rounded-md px-3 py-2 text-sm">
                                                <option value="">Select Units</option>
                                               @foreach($products as $product)
                                                <option value="{{ $product-> id}}">{{ $product->unit }}</option>
                                               @endforeach
                                            </select>

                                            <div class="">
                                                <input type="number" placeholder="Price $"
                                                    class="w-full border rounded-md px-3 py-2 pr-10 text-sm" />
                                            </div>

                                            <div class="">
                                                <input type="number" placeholder="Disc. $"
                                                    class="w-full border rounded-md px-3 py-2 pr-10 text-sm" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <!-- Notes -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                            <textarea rows="4" name="notes"
                                class="w-full border border-gray-300 rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500 bg-gray-50"></textarea>
                            @error('notes')
                                <p class=" text-red-500 font-semibold text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Pricing Summary -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Pricing Summary</h3>
                            <div class="grid grid-rows-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Subtotal</label>
                                    <input type="text" name="subtotal"
                                        class="w-full border-b-2 border-gray-300 py-1 px-1 bg-white">
                                    @error('subtotal')
                                        <p class=" text-red-500 font-semibold text-xs">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Tax</label>
                                    <input type="text" name="tax"
                                        class="w-full border-b-2 border-gray-300 py-1 px-1 bg-white">
                                    @error('tax')
                                        <p class=" text-red-500 font-semibold text-xs">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Total</label>
                                    <input type="text" name="total"
                                        class="w-full border-b-2 border-blue-500 py-1 px-1 bg-blue-50 font-medium">
                                    @error('total')
                                        <p class=" text-red-500 font-semibold text-xs">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg shadow-md transition transform hover:-translate-y-0.5">
                                Generate Quotation
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Column - Shop Info -->
                <div class="w-full flex flex-col gap-5 md:w-4/12">
                    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm ">
                        <!-- Company Logo -->
                        <div class="flex flex-col items-center mb-6">
                            <div
                                class="w-24 h-24 bg-gray-100 rounded-full mb-4 flex items-center justify-center border-2 border-dashed border-gray-300">
                                <span class="text-gray-400"> <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-8 w-8 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg></span>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">TechBazar</h3>
                            <div class="mt-2 text-sm text-gray-600">
                                <p>123 Business Street</p>
                                <p>Purnea, Bihar 854334</p>
                                <p class="mt-2">GSTIN: 22ABCDE1234F1Z5</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection