<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Invoice - TECHBZR001</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
    }
    .dotted-line {
      border-top: 1px dashed #ccc;
      margin: 1.5rem 0;
    }
    .watermark {
      position: absolute;
      opacity: 0.06;
      font-size: 10rem;
      font-weight: 800;
      color: #0c094d;
      z-index: 0;
      transform: rotate(-40deg);
      pointer-events: none;
    }
  </style>
  {!! ToastMagic::styles() !!}

</head>
<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto my-8 bg-white shadow border-2 border-dotted border-gray-300 rounded-lg">
    <div class="watermark left-1/4 top-1/2">INVOICE</div>

    <!-- Header -->
    <div class="p-8 border-b border-gray-200">
      <div class="flex justify-between">
        <div>
          <h1 class="text-3xl font-bold text-blue-700">INVOICE</h1>
          <p class="text-gray-600 mt-2">Invoice No:- <span class="font-medium">{{$invoice->invoice_no}}</span></p>
          <p class="text-gray-600">Date: {{ $invoice->created_at->format('d.m.Y') }}</p>
          <p class="text-gray-600">Due: {{ $invoice->due_date ? $invoice->due_date->format('d.m.Y') : 'N/A' }}</p>
        </div>
        <div class="text-right">
          <h2 class="text-xl font-semibold text-gray-800">TECHBZR Pvt. Ltd.</h2>
          <p class="text-gray-600">123 Tech Street, Purnea, Bihar</p>
          <p class="text-gray-600">GSTIN: 22ABCDE1234F1Z5</p>
          <p class="text-gray-600">techbzr@example.com</p>
          <p class="text-gray-600">+91 9876543210</p>
        </div>
      </div>
    </div>

    <!-- Customer / Payee -->
    <div class="p-8 pt-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
          <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">BILL TO</h3>
          <p class="text-lg font-medium text-gray-800">{{ $invoice->customer->name ?? 'N/A' }}</p>
          <p class="text-gray-600">Ph: {{ $invoice->customer->contact ?? '-' }}</p>
          <p class="text-gray-600">{{ $invoice->address->city ?? 'N/A' }}</p>
        </div>
        <div>
          <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">PAY TO</h3>
          <p class="text-gray-800 font-medium">TechBzr Pvt Ltd</p>
          <p class="text-gray-600">Bank: Borcele Bank</p>
          <p class="text-gray-600">A/C No: 50100234567890</p>
          <p class="text-gray-600">IFSC: BORC0001234</p>
        </div>
      </div>
    </div>

    <!-- Items -->
    <div class="px-8">
      <table class="w-full text-sm mt-6 border-collapse">
        <thead>
          <tr class="border-b border-gray-300 bg-gray-100">
            <th class="text-left py-2 px-2 font-semibold text-gray-700">Description</th>
            <th class="text-right py-2 px-2 font-semibold text-gray-700">Unit Price</th>
            <th class="text-right py-2 px-2 font-semibold text-gray-700">Qty</th>
            <th class="text-right py-2 px-2 font-semibold text-gray-700">Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($invoice->salesItems as $item)
          <tr class="border-b border-gray-100">
            <td class="py-3 px-2 text-gray-800">{{ $item->product->name ?? 'N/A' }}</td>
            <td class="py-3 px-2 text-right text-gray-800">₹{{ $item->product->sell_price ?? 0 }}</td>
            <td class="py-3 px-2 text-right text-gray-800">{{ $item->qty }}</td>
            <td class="py-3 px-2 text-right text-gray-800">₹{{ ($item->product->sell_price ?? 0) * $item->qty }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Totals -->
    <div class="px-8 py-6 flex justify-end">
      <div class="w-full sm:w-1/2 md:w-1/3">
        <div class="grid grid-cols-2 gap-2 text-sm">
          <div class="text-gray-600 text-right">Subtotal:</div>
          <div class="text-right font-medium">₹{{ $invoice->subtotal }}</div>

          <div class="text-gray-600 text-right">Tax ({{ $invoice->tax_rate ?? 0 }}%):</div>
          <div class="text-right font-medium">₹{{ $invoice->tax }}</div>

          @if($invoice->discount > 0)
            <div class="text-gray-600 text-right">Discount:</div>
            <div class="text-right font-medium text-red-600">-₹{{ $invoice->discount }}</div>
          @endif

          <div class="text-gray-800 font-semibold text-right border-t pt-2">TOTAL:</div>
          <div class="text-right text-lg font-bold text-gray-900 border-t pt-2">₹{{ $invoice->total }}</div>
        </div>
      </div>
    </div>

    <!-- Payment Info -->
    <div class="px-8 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
      <div>
        <span class="text-sm text-gray-500 font-semibold uppercase">Status:</span>
        <span class="ml-2 px-3 py-1 rounded-full text-xs font-semibold {{ $invoice->sale->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
          {{ ucfirst($invoice->sale->payment_status) }}
        </span>
      </div>
      <div>
        <span class="text-sm text-gray-500 font-semibold uppercase">Payment Method:</span>
        <span class="ml-2 text-gray-800">{{ $invoice->payment->method ?? 'N/A' }}</span>
      </div>
    </div>

    <!-- Notes -->
    <div class="px-8 py-4">
      <p class="text-sm text-gray-600">
        <span class="font-semibold">Note:</span> Payment due within 30 days. Late payment may be subject to additional charges.
      </p>
    </div>

    <!-- Signature -->
    <div class="px-8 py-6">
      <div class="flex justify-between items-end">
        <div class="text-sm text-gray-500">
          <p>Authorized Signature:</p>
          <div class="h-12 border-b border-gray-300 w-48 mt-2"></div>
        </div>
        <!-- Optional QR code -->
        <!-- <img src="path_to_qr_code.png" class="h-16" alt="QR Code"> -->
      </div>
    </div>

    <!-- Footer -->
    <div class="bg-gray-100 px-8 py-4 text-center text-xs text-gray-500 border-t">
      <p>Thank you for shopping with TECHBZR! | Email: techbzr@example.com | Helpline: +91 9876543210</p>
    </div>
  </div>
  
    <form action="{{ route('invoices.send-email', $invoice->id) }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="flex items-center px-4 py-2 hover:bg-gray-100 w-full">
            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            Send Email
        </button>
    </form>

  <!-- Action Buttons -->
  <div class="max-w-4xl mx-auto mt-4 flex justify-end space-x-4">
    <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 flex items-center">
      <i class="fas fa-print mr-2"></i> Print
    </button>
    <a href="{{ route('downloadPdf', $invoice->id) }}" class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 flex items-center">
      <i class="fas fa-download mr-2"></i> Download PDF
    </a>
  </div>
  {!! ToastMagic::scripts() !!}
</body>
</html>
