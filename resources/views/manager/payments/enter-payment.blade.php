@extends('manager.managerlayout')

@section('title', 'Enter Payment')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Enter Payment</h1>
            <div class="flex space-x-2">
                <button type="submit" form="paymentForm" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Save Payment
                </button>
                <a href="" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors">
                    Cancel
                </a>
            </div>
        </div>

        <!-- Status Messages -->
        <div id="statusMessages">
            @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-md shadow-sm" role="alert">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <strong class="font-medium">Error!</strong>
                    </div>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md shadow-sm" role="alert">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <strong class="font-medium">Success!</strong>
                    </div>
                    <p class="mt-2 text-sm">{{ session('success') }}</p>
                </div>
            @endif
        </div>

        <!-- Payment Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
            <div class="p-5 border-b border-gray-200 bg-gray-50">
                <h2 class="text-lg font-medium text-gray-800">Payment Information</h2>
            </div>
            <div class="p-6">
                <form id="paymentForm" action="{{ route('manager.payments.store') }}" method="POST">
                    @csrf

                    <!-- Invoice Selection -->
                    <div class="mb-8">
                        <h3 class="text-base font-medium text-gray-700 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd" />
                            </svg>
                            Invoice Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="invoice_id" class="block text-sm font-medium text-gray-700 mb-2">Select Invoice *</label>
                                <select id="invoice_id" name="invoice_id" required
                                    class="block w-full pl-3 pr-10 py-2.5 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md shadow-sm">
                                    <option value="">-- Select Invoice --</option>
                                    @foreach($invoices as $invoice)
                                        <option value="{{ $invoice['id'] }}" 
                                            data-balance="{{ $invoice['balance'] }}"
                                            data-customer="{{ $invoice['customer_name'] }}"
                                            data-email="{{ $invoice['customer_email'] }}"
                                            data-phone="{{ $invoice['customer_phone'] }}">
                                            Invoice #{{ $invoice['invoice_number'] }} - 
                                            {{ $invoice['customer_name'] }} - 
                                            ₹{{ number_format($invoice['balance'], 2) }} due
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Remaining Balance</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">₹</span>
                                    </div>
                                    <div class="block w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-300 rounded-md shadow-sm text-gray-700">
                                        <span id="remainingBalance">0.00</span>
                                    </div>
                                </div>
                                <input type="hidden" id="customer_email" name="customer_email">
                                <input type="hidden" id="customer_phone" name="customer_phone">
                            </div>
                        </div>
                    </div>

                    <!-- Payment Details -->
                    <div class="mb-8">
                        <h3 class="text-base font-medium text-gray-700 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                            </svg>
                            Payment Details
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="payment_date" class="block text-sm font-medium text-gray-700 mb-2">Payment Date *</label>
                                <input type="date" id="payment_date" name="payment_date" 
                                    value="{{ $defaultDate }}" required
                                    class="block w-full pl-3 pr-10 py-2.5 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount *</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">₹</span>
                                    </div>
                                    <input type="number" step="0.01" id="amount" name="amount" required
                                        class="block w-full pl-10 pr-12 py-2.5 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md"
                                        placeholder="0.00" min="0.01">
                                </div>
                            </div>
                            <div>
                                <label for="method" class="block text-sm font-medium text-gray-700 mb-2">Payment Method *</label>
                                <select id="method" name="method" required
                                    class="block w-full pl-3 pr-10 py-2.5 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md shadow-sm">
                                    @foreach($paymentMethods as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="transaction_reference" class="block text-sm font-medium text-gray-700 mb-2">Reference Number</label>
                                <input type="text" id="transaction_reference" name="transaction_reference"
                                    class="block w-full pl-3 pr-10 py-2.5 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md shadow-sm"
                                    placeholder="Optional">
                            </div>
                        </div>
                    </div>

                    <!-- Notes Section -->
                    <div>
                        <h3 class="text-base font-medium text-gray-700 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                            </svg>
                            Additional Information
                        </h3>
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                            <textarea id="notes" name="notes" rows="3"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                placeholder="Any additional information about this payment"></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const invoiceSelect = document.getElementById('invoice_id');
    const amountInput = document.getElementById('amount');
    const remainingBalanceSpan = document.getElementById('remainingBalance');
    const customerEmail = document.getElementById('customer_email');
    const customerPhone = document.getElementById('customer_phone');
    const paymentForm = document.getElementById('paymentForm');
    const statusMessages = document.getElementById('statusMessages');

    // Update balance when invoice is selected
    invoiceSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const balance = selectedOption.getAttribute('data-balance') || '0';
        const email = selectedOption.getAttribute('data-email') || '';
        const phone = selectedOption.getAttribute('data-phone') || '';
        
        remainingBalanceSpan.textContent = parseFloat(balance).toFixed(2);
        amountInput.value = balance;
        amountInput.max = balance;
        customerEmail.value = email;
        customerPhone.value = phone;
    });

    // Validate amount doesn't exceed balance
    amountInput.addEventListener('change', function() {
        const balance = parseFloat(remainingBalanceSpan.textContent);
        const amount = parseFloat(this.value) || 0;
        
        if (amount > balance) {
            showAlert('Payment amount cannot exceed the remaining balance of ₹' + balance.toFixed(2), 'error');
            this.value = balance.toFixed(2);
        }
    });

    // Handle form submission
    paymentForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitButton = paymentForm.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Processing...
        `;
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Remove the paid invoice from dropdown
                const option = document.querySelector(`#invoice_id option[value="${data.invoice_id}"]`);
                if (option) option.remove();
                
                // Reset form
                paymentForm.reset();
                document.getElementById('remainingBalance').textContent = '0.00';
                
                // Show success message
                showAlert(data.message, 'success');
                
                // If invoice was fully paid, show additional confirmation
                if (data.fully_paid) {
                    showAlert('Payment completed successfully. Invoice is now fully paid.', 'info');
                }
            } else {
                showAlert(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('An error occurred while processing your request. Please try again.', 'error');
        })
        .finally(() => {
            submitButton.disabled = false;
            submitButton.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Save Payment
            `;
        });
    });

    function showAlert(message, type) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `border-l-4 p-4 mb-4 rounded-md shadow-sm ${type === 'error' ? 'bg-red-100 border-red-500 text-red-700' : 
                            type === 'success' ? 'bg-green-100 border-green-500 text-green-700' :
                            'bg-blue-100 border-blue-500 text-blue-700'}`;
        alertDiv.setAttribute('role', 'alert');
        
        const icon = type === 'error' ? 
            `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>` :
            `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>`;
        
        alertDiv.innerHTML = `
            <div class="flex items-center">
                ${icon}
                <strong class="font-medium">${type === 'error' ? 'Error!' : 'Success!'}</strong>
            </div>
            <p class="mt-2 text-sm">${message}</p>
        `;
        
        statusMessages.insertBefore(alertDiv, statusMessages.firstChild);
        
        // Remove alert after 5 seconds
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }
});
</script>
@endsection