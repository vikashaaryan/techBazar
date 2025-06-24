<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - TECHBZR001</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">
    <div  class="max-w-4xl mx-auto my-8 bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Invoice Header -->
        <div class="bg-gray-50 text-black p-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold">INVOICE</h1>
                    <p class="text-black">Thank you for your business</p>
                </div>
                <div class="text-right">
                    <h2 class="text-xl font-semibold">TECHBZR</h2>
                    <p class="text-black">123 Tech Street</p>
                    <p class="text-black">Purnea,(Bihar)</p>
                    <p class="text-black">GSTIN: 22ABCDE1234F1Z5</p>
                </div>
            </div>
        </div>

      
            <!-- Invoice Details -->
        <div id="" class="p-6 border-b">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Invoice To</h3>
                    <p class="font-medium">Acme Corporation</p>
                    <p class="text-gray-600">42 Innovation Drive</p>
                    <p class="text-gray-600">Purnea, Pr 854301</p>
                    <p class="text-gray-600">GSTIN: 27BOSPC9912J1ZW</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Invoice Details</h3>
                    <div class="grid grid-cols-2 gap-2">
                        <span class="text-gray-600">Invoice #</span>
                        <span class="font-medium">TECHBZR001</span>
                        <span class="text-gray-600">Invoice Date</span>
                        <span>{{ $invoice->created_at->format('d-M-Y') }}
                        </span>
                        <span class="text-gray-600">Due Date</span>
                        <span>{{$invoice->due_date->format('d-M-Y')}}</span>
                        <span class="text-gray-600">Status</span>
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">{{$invoice->sale->payment_status}}</span>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">Payment Info</h3>
                    <div class="grid grid-cols-2 gap-2">
                        <span class="text-gray-600">Method</span>
                        <span>{{$invoice->payment->method}}</span>
                        <span class="text-gray-600">Account</span>
                        <span>TechBzr Pvt Ltd</span>
                        <span class="text-gray-600">Bank</span>
                        <span>HDFC Bank</span>
                        <span class="text-gray-600">Account #</span>
                        <span>50100234567890</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rate</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Discount</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Item 1 -->
                        <tr>
                            @foreach ($invoice->salesItems as $item)
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900">{{ $item->product->name ?? 'N/A'}}</div>
                            </td>
                           
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{$invoice->notes}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500"></td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">₹{{$item->product->sell_price}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">₹{{ ($item->product->mrp ?? 0) - ($item->product->sell_price ?? 0) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium">₹{{$item->product->mrp-$item->product->sell_price * 2}}</td>
                            @endforeach
                        </tr>
                       
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Totals -->
        <div class="p-6 bg-gray-50">
            <div class="flex justify-end">
                <div class="w-64">
                    <div class="grid grid-cols-2 gap-2">
                        <span class="font-medium">Subtotal:</span>
                        <span class="text-right">₹88,500.00</span>
                        <span class="font-medium">Tax (18%):</span>
                        <span class="text-right">₹15,930.00</span>
                        <span class="font-medium">Discount:</span>
                        <span class="text-right">-₹6,500.00</span>
                        <span class="border-t border-gray-200 pt-2 font-bold">Total:</span>
                        <span class="border-t border-gray-200 pt-2 text-right font-bold">₹97,930.00</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notes & Footer -->
        <div class="p-6 border-t">
            <div class="mb-6">
                <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Notes</h3>
                <p class="text-gray-600">Payment is due within 30 days. Please make checks payable to TechBzr Pvt Ltd and include the invoice number in the memo.</p>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Terms & Conditions</h3>
                    <p class="text-xs text-gray-500">1. Late payments are subject to 2% monthly interest.</p>
                    <p class="text-xs text-gray-500">2. All sales are final.</p>
                </div>
                <div class="flex space-x-2">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 flex items-center">
                        <i class="fas fa-download mr-2"></i> Download PDF
                    </button>
                    <button class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-50 flex items-center">
                        <i class="fas fa-print mr-2"></i> Print
                    </button>
                </div>
            </div>
        </div>
     
        <!-- Footer -->
        <div class="bg-gray-100 p-4 text-center text-xs text-gray-500">
            <p>Thank you for your business! • techbzr@example.com • +91 9876543210</p>
        </div>
    </div>
</body>
</html>