@extends('manager.managerlayout')

@section('title')
    Staff Dashboard
@endsection

@section('content')
    <div class=" min-h-screen bg-gray-50">
      
        <!-- Main Content -->
        <div class="ml-56 mt-10 p-8">
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Quick Actions
                </h2>
            
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                    <a href="{{route('customer.index')}}"
                        class="group flex flex-col items-center p-5 rounded-lg hover:bg-gray-100 transition-colors border border-gray-100">
                        <div class="bg-blue-100 p-3 rounded-full mb-3 group-hover:bg-blue-200 transition-colors">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6z" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-blue-600">Add Customer</span>
                    </a>
            
                    <a href="#"
                        class="group flex flex-col items-center p-5 rounded-lg hover:bg-gray-100 transition-colors border border-gray-100">
                        <div class="bg-green-100 p-3 rounded-full mb-3 group-hover:bg-green-200 transition-colors">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-green-600">Create Quote</span>
                    </a>
            
                    <a href="#"
                        class="group flex flex-col items-center p-5 rounded-lg hover:bg-gray-100 transition-colors border border-gray-100">
                        <div class="bg-amber-100 p-3 rounded-full mb-3 group-hover:bg-amber-200 transition-colors">
                            <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-amber-600">Create Invoice</span>
                    </a>
            
                    <a href="#"
                        class="group flex flex-col items-center p-5 rounded-lg hover:bg-gray-100 transition-colors border border-gray-100">
                        <div class="bg-purple-100 p-3 rounded-full mb-3 group-hover:bg-purple-200 transition-colors">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-purple-600">Enter Payment</span>
                    </a>
            
                    <a href="#"
                        class="group flex flex-col items-center p-5 rounded-lg hover:bg-gray-100 transition-colors border border-gray-100">
                        <div class="bg-red-100 p-3 rounded-full mb-3 group-hover:bg-red-200 transition-colors">
                            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" 
                                    d="M8 1a1 1 0 011 1v1h2a1 1 0 110 2H9v2a1 1 0 11-2 0V5H5a1 1 0 010-2h2V2a1 1 0 011-1zm0 10a1 1 0 011 1v1h2a1 1 0 110 2H9v2a1 1 0 11-2 0v-2H5a1 1 0 010-2h2v-1a1 1 0 011-1z" 
                                    clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-red-600">Return/Exchange</span>
                    </a>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex flex-col lg:flex-row gap-6">
                    {{-- Quote Overview --}}
                    <div class="w-full lg:w-1/2">
                        <div class="bg-gray-100 border border-gray-300 rounded-lg p-4 shadow-sm">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                </svg>
                                Quote Overview <span class="ml-auto text-sm font-medium text-gray-600">This Month</span>
                            </h2>
            
                            <ul class="space-y-2 text-sm">
                                <li class="flex justify-between">
                                    <span class="text-gray-700">Draft</span>
                                    <span class="text-gray-600">Rs.173,90</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-700">Sent</span>
                                    <span class="text-blue-600">Rs.137.620,13</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-700">Viewed</span>
                                    <span class="text-yellow-500">Rs.0,00</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-700">Approved</span>
                                    <span class="text-green-600">Rs.6.438,17</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-700">Rejected</span>
                                    <span class="text-red-600">Rs.452.430,00</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-700">Canceled</span>
                                    <span class="text-gray-600">Rs.0,00</span>
                                </li>
                            </ul>
                        </div>
                    </div>
            
                    {{-- Invoice Overview --}}
                    <div class="w-full lg:w-1/2">
                        <div class="bg-gray-100 border border-gray-300 rounded-lg p-4 shadow-sm">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h6m2 0a2 2 0 100-4H7a2 2 0 100 4m0 0a2 2 0 100 4h10a2 2 0 100-4" />
                                </svg>
                                Invoice Overview <span class="ml-auto text-sm font-medium text-gray-600">This Quarter</span>
                            </h2>
            
                            <ul class="space-y-2 text-sm">
                                <li class="flex justify-between">
                                    <span class="text-gray-700">Draft</span>
                                    <span class="text-red-500">-Rs.5.591.109,92</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-700">Sent</span>
                                    <span class="text-blue-600">Rs.292.620.475,17</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-700">Viewed</span>
                                    <span class="text-yellow-600">Rs.63.520,62</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-700">Paid</span>
                                    <span class="text-green-600">Rs.2.188.174.980,33</span>
                                </li>
                            </ul>
            
                            <div class="mt-4 p-3 bg-red-100 text-red-700 rounded-md font-medium text-sm">
                                <span class="font-semibold">⚠️ Overdue Invoices:</span> Rs.389.562.466,30
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
