@extends('manager.managerlayout')

@section('title')
    Staff Dashboard
@endsection

@section('content')
    <div class="p-4 space-y-6">
        <!-- Quick Actions Card -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-3">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    Quick Actions
                </h2>
                <span class="text-sm text-blue-600 font-medium">Shortcuts to common tasks</span>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <a href="{{route('customer.create')}}" class="group relative overflow-hidden">
                    <div
                        class="flex flex-col items-center p-5 rounded-xl bg-gradient-to-b from-white to-gray-50 hover:from-blue-50 hover:to-blue-100 transition-all border border-gray-200 hover:border-blue-200 shadow-sm hover:shadow-md">
                        <div
                            class="bg-blue-100/80 p-3 rounded-xl mb-3 group-hover:bg-blue-200/80 transition-colors backdrop-blur-sm">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6z" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-blue-600">Add Customer</span>
                    </div>
                </a>

                <a href="#" class="group relative overflow-hidden">
                    <div
                        class="flex flex-col items-center p-5 rounded-xl bg-gradient-to-b from-white to-gray-50 hover:from-green-50 hover:to-green-100 transition-all border border-gray-200 hover:border-green-200 shadow-sm hover:shadow-md">
                        <div
                            class="bg-green-100/80 p-3 rounded-xl mb-3 group-hover:bg-green-200/80 transition-colors backdrop-blur-sm">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-green-600">Create Quote</span>
                    </div>
                </a>

                <a href="#" class="group relative overflow-hidden">
                    <div
                        class="flex flex-col items-center p-5 rounded-xl bg-gradient-to-b from-white to-gray-50 hover:from-amber-50 hover:to-amber-100 transition-all border border-gray-200 hover:border-amber-200 shadow-sm hover:shadow-md">
                        <div
                            class="bg-amber-100/80 p-3 rounded-xl mb-3 group-hover:bg-amber-200/80 transition-colors backdrop-blur-sm">
                            <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-amber-600">Create Invoice</span>
                    </div>
                </a>

                <a href="#" class="group relative overflow-hidden">
                    <div
                        class="flex flex-col items-center p-5 rounded-xl bg-gradient-to-b from-white to-gray-50 hover:from-purple-50 hover:to-purple-100 transition-all border border-gray-200 hover:border-purple-200 shadow-sm hover:shadow-md">
                        <div
                            class="bg-purple-100/80 p-3 rounded-xl mb-3 group-hover:bg-purple-200/80 transition-colors backdrop-blur-sm">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-purple-600">Enter Payment</span>
                    </div>
                </a>

                <a href="{{route('exchange.view')}}" class="group relative overflow-hidden">
                    <div
                        class="flex flex-col items-center p-5 rounded-xl bg-gradient-to-b from-white to-gray-50 hover:from-red-50 hover:to-red-100 transition-all border border-gray-200 hover:border-red-200 shadow-sm hover:shadow-md">
                        <div
                            class="bg-red-100/80 p-3 rounded-xl mb-3 group-hover:bg-red-200/80 transition-colors backdrop-blur-sm">
                            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8 1a1 1 0 011 1v1h2a1 1 0 110 2H9v2a1 1 0 11-2 0V5H5a1 1 0 010-2h2V2a1 1 0 011-1zm0 10a1 1 0 011 1v1h2a1 1 0 110 2H9v2a1 1 0 11-2 0v-2H5a1 1 0 010-2h2v-1a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-red-600">Return/Exchange</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Quote Overview -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b border-blue-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-3">
                            <div class="p-1.5 bg-blue-200/50 rounded-lg backdrop-blur-sm">
                                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                </svg>
                            </div>
                            Quote Overview
                        </h2>
                        <span
                            class="text-xs font-medium px-2 py-1 bg-white rounded-full text-blue-700 border border-blue-200 shadow-sm">This
                            Month</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="space-y-3">
                        @foreach($quoteStats as $stat)
                        <div class="flex items-center justify-between p-2 hover:bg-blue-50/50 rounded-lg transition-colors">
                            <div class="flex items-center gap-2">
                                @php
                                    $dotColor = match($stat->status) {
                                        'draft' => 'bg-gray-400',
                                        'sent' => 'bg-blue-500',
                                        'accepted' => 'bg-green-500',
                                        'rejected' => 'bg-red-500',
                                        'converted' => 'bg-purple-500',
                                        default => 'bg-gray-400'
                                    };
                                @endphp
                                <div class="w-2 h-2 rounded-full {{ $dotColor }}"></div>
                                <span class="text-sm font-medium text-gray-700">{{ ucfirst($stat->status) }}</span>
                            </div>
                            <span class="text-sm font-medium {{ $stat->color_class }}">Rs.{{ number_format($stat->total_amount, 2) }}</span>
                        </div>
                        @endforeach
                        <div class="flex items-center justify-between p-2 bg-blue-50 rounded-lg mt-4">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                                <span class="text-sm font-medium text-gray-700">Total</span>
                            </div>
                            <span class="text-sm font-bold text-blue-700">Rs.{{ number_format($totalQuotesAmount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice Overview -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b border-blue-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-3">
                            <div class="p-1.5 bg-blue-200/50 rounded-lg backdrop-blur-sm">
                                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h6m2 0a2 2 0 100-4H7a2 2 0 100 4m0 0a2 2 0 100 4h10a2 2 0 100-4" />
                                </svg>
                            </div>
                            Invoice Overview
                        </h2>
                        <span
                            class="text-xs font-medium px-2 py-1 bg-white rounded-full text-blue-700 border border-blue-200 shadow-sm">This
                            Quarter</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="space-y-3 mb-4">
                        @foreach($invoiceStats as $stat)
                        <div class="flex items-center justify-between p-2 hover:bg-blue-50/50 rounded-lg transition-colors">
                            <div class="flex items-center gap-2">
                                @php
                                    $dotColor = match($stat->status) {
                                        'draft' => 'bg-gray-400',
                                        'sent' => 'bg-blue-500',
                                        'paid' => 'bg-green-500',
                                        'rejected' => 'bg-red-500',
                                        'cancelled' => 'bg-gray-500',
                                        default => 'bg-gray-400'
                                    };
                                @endphp
                                <div class="w-2 h-2 rounded-full {{ $dotColor }}"></div>
                                <span class="text-sm font-medium text-gray-700">{{ ucfirst($stat->status) }}</span>
                            </div>
                            <span class="text-sm font-medium {{ $stat->color_class }}">Rs.{{ number_format($stat->total_amount, 2) }}</span>
                        </div>
                        @endforeach
                        <div class="flex items-center justify-between p-2 bg-blue-50 rounded-lg mt-4">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                                <span class="text-sm font-medium text-gray-700">Total</span>
                            </div>
                            <span class="text-sm font-bold text-blue-700">Rs.{{ number_format($totalInvoicesAmount, 2) }}</span>
                        </div>
                    </div>
                    @if($overdueInvoices > 0)
                    <div
                        class="mt-4 p-3 bg-gradient-to-r from-red-50 to-red-100 border border-red-200 text-red-700 rounded-lg font-medium text-sm flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span class="font-semibold">Overdue Invoices:</span> Rs.{{ number_format($overdueInvoices, 2) }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection