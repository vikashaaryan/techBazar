@extends('manager.managerlayout')

@section('title', 'Create-Quote')

@section('content')
    <div class="min-h-screen bg-white py-12">
    <div class="max-w-6xl mx-auto bg-white  shadow-xl rounded-xl overflow-hidden">
     
        <!-- Main Content -->
         <h2 class="text-center text-2xl mb-4 underline">Quotation</h2>
        <div class="flex flex-col md:flex-row p-8 gap-8">
            <!-- Left Column - Form -->
            <div class="w-full md:w-8/12">
                <form action="" method="post" class="space-y-6">
                    <!-- Quotation Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Quotation Number</label>
                            <input type="text" 
                                class="w-full border-b-2 border-gray-300 focus:border-blue-500 py-2 px-1 bg-gray-50 rounded-t">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Quotation Date</label>
                            <input type="date" 
                                class="w-full border-b-2 border-gray-300 focus:border-blue-500 py-2 px-1 bg-gray-50 rounded-t">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Valid Till Date</label>
                            <input type="date" 
                                class="w-full border-b-2 border-gray-300 focus:border-blue-500 py-2 px-1 bg-gray-50 rounded-t">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select class="w-full border-b-2 border-gray-300 focus:border-blue-500 py-2 px-1 bg-gray-50 rounded-t">
                                <option>Select Status</option>
                                <option>Draft</option>
                                <option>Sent</option>
                                <option>Accepted</option>
                                <option>Rejected</option>
                                <option>Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <!-- Customer Selection -->
                    <div class="bg-blue-50 rounded-lg p-4 border border-blue-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Customer Information</h3>
                        <div class="space-y-4">
                            <select class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <option>Select Customer</option>
                                <option value="vikash">Vikash</option>
                            </select>
                            <div class="flex items-center">
                                <div class="flex-grow border-t border-gray-300"></div>
                                <span class="mx-4 text-gray-500">OR</span>
                                <div class="flex-grow border-t border-gray-300"></div>
                            </div>
                            <button type="button" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                                + Add New Customer
                            </button>
                        </div>
                    </div>

                    <!-- Pricing Summary -->
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Pricing Summary</h3>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Subtotal</label>
                                <input type="text" class="w-full border-b-2 border-gray-300 py-1 px-1 bg-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Tax</label>
                                <input type="text" class="w-full border-b-2 border-gray-300 py-1 px-1 bg-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Total</label>
                                <input type="text" class="w-full border-b-2 border-blue-500 py-1 px-1 bg-blue-50 font-medium">
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                        <textarea rows="4" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500 bg-gray-50"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg shadow-md transition transform hover:-translate-y-0.5">
                            Generate Quotation
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Column - Shop Info -->
            <div class="w-full md:w-4/12">
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm ">
                    <!-- Company Logo -->
                    <div class="flex flex-col items-center mb-6">
                        <div class="w-24 h-24 bg-gray-100 rounded-full mb-4 flex items-center justify-center border-2 border-dashed border-gray-300">
                            <span class="text-gray-400">  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-700" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
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