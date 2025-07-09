@extends('manager.managerlayout')

@section('title', 'Enter Payment')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Enter Payment</h1>
            <div class="flex space-x-2">
                <button type="submit" form="paymentForm" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Save Payment
                </button>
                <a href="" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                    Cancel
                </a>
            </div>
        </div>

        <!-- Status Messages -->
        <div id="statusMessages">
            <!-- Error Messages -->
            @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <!-- Payment Form -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <form id="paymentForm" action="{{ route('manager.payments.store') }}" method="POST">
                @csrf

                <!-- Invoice Selection -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Invoice Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="invoice_id" class="block text-sm font-medium text-gray-700 mb-1">Select Invoice *</label>
                            <select id="invoice_id" name="invoice_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Select Invoice --</option>
                                @foreach($invoices as $invoice)
                                    <option value="{{ $invoice['id'] }}" 
                                        data-balance="{{ $invoice['balance'] }}"
                                        data-customer="{{ $invoice['customer_name'] }}"
                                        data-email="{{ $invoice['customer_email'] }}"
                                        data-phone="{{ $invoice['customer_phone'] }}">
                                        Invoice #{{ $invoice['invoice_number'] }} - 
                                        {{ $invoice['customer_name'] }} - 
                                        ${{ number_format($invoice['balance'], 2) }} due
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Remaining Balance</label>
                            <div class="p-2 bg-gray-100 rounded-md">
                                $<span id="remainingBalance">0.00</span>
                            </div>
                            <input type="hidden" id="customer_email" name="customer_email">
                            <input type="hidden" id="customer_phone" name="customer_phone">
                        </div>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Payment Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="payment_date" class="block text-sm font-medium text-gray-700 mb-1">Payment Date *</label>
                            <input type="date" id="payment_date" name="payment_date" 
                                value="{{ $defaultDate }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount *</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">$</span>
                                </div>
                                <input type="number" step="0.01" id="amount" name="amount" required
                                    class="block w-full pl-7 pr-12 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="0.00" min="0.01">
                            </div>
                        </div>
                        <div>
                            <label for="method" class="block text-sm font-medium text-gray-700 mb-1">Payment Method *</label>
                            <select id="method" name="method" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @foreach($paymentMethods as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="transaction_reference" class="block text-sm font-medium text-gray-700 mb-1">Reference Number</label>
                            <input type="text" id="transaction_reference" name="transaction_reference"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Optional">
                        </div>
                    </div>
                </div>

                <!-- Notes Section -->
                <div class="mb-4">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                    <textarea id="notes" name="notes" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Any additional information about this payment"></textarea>
                </div>

              
            </form>
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
            showAlert('Payment amount cannot exceed the remaining balance of $' + balance.toFixed(2), 'error');
            this.value = balance.toFixed(2);
        }
    });

    // Handle form submission
    paymentForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the paid invoice from dropdown
                const option = document.querySelector(`#invoice_id option[value="${data.invoice_id}"]`);
                if (option) option.remove();
                
                // Reset form
                this.reset();
                document.getElementById('remainingBalance').textContent = '0.00';
                
                // Show success message
                showAlert(data.message, 'success');
                
                // If invoice was fully paid, show additional confirmation
                if (data.fully_paid) {
                    showAlert('Customer has been notified about the payment.', 'info');
                }
            } else {
                showAlert(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('An error occurred while processing your request.', 'error');
        });
    });

    function showAlert(message, type) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `border-l-4 p-4 mb-4 ${type === 'error' ? 'bg-red-100 border-red-500 text-red-700' : 
                            type === 'success' ? 'bg-green-100 border-green-500 text-green-700' :
                            'bg-blue-100 border-blue-500 text-blue-700'}`;
        alertDiv.setAttribute('role', 'alert');
        alertDiv.textContent = message;
        
        statusMessages.insertBefore(alertDiv, statusMessages.firstChild);
        
        // Remove alert after 5 seconds
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }
});
</script>
@endsection