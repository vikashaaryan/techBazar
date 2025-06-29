<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice - TECHBZR001</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f7fafc;
        }

        .container {
            width: 800px;
            margin: 30px auto;
            background: #fff;
            border: 2px dotted #cbd5e0;
            padding: 40px;
            position: relative;
        }

        .watermark {
            position: absolute;
            opacity: 0.06;
            font-size: 120px;
            font-weight: 800;
            color: #0c094d;
            transform: rotate(-43deg);
            top: 30%;
            left: 20% ;
            pointer-events: none;
            z-index: 0;
        }

        .header,
        .footer,
        .content,
        .totals,
        .items {
            position: relative;
            z-index: 1;
        }

        .flex {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            color: #1d4ed8;
        }

        .section {
            margin-top: 20px;
        }

        .section h3 {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            color: #6b7280;
            margin-bottom: 5px;
        }

        .section p {
            margin: 2px 0;
            font-size: 14px;
            color: #374151;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
            text-align: right;
        }

        th:first-child,
        td:first-child {
            text-align: left;
        }

        .totals div {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
            font-size: 14px;
        }

        .totals .label {
            color: #6b7280;
        }

        .totals .value {
            font-weight: bold;
        }

        .status {
            display: inline-block;
            padding: 4px 10px;
            font-size: 12px;
            font-weight: bold;
            border-radius: 9999px;
        }

        .paid {
            background: #d1fae5;
            color: #065f46;
        }

        .due {
            background: #fef3c7;
            color: #92400e;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="watermark">INVOICE</div>

        <!-- Header -->
        <div class="header flex">
            <div>
                <div class="title">INVOICE</div>
                <p>Invoice No: {{ $invoice->invoice_no }}</p>
                <p>Date: {{ $invoice->created_at->format('d.m.Y') }}</p>
                <p>Due: {{ $invoice->due_date ? $invoice->due_date->format('d.m.Y') : 'N/A' }}</p>
            </div>
            <div style="text-align:right">
                <p><strong>TECHBZR Pvt. Ltd.</strong></p>
                <p>123 Tech Street, Purnea, Bihar</p>
                <p>GSTIN: 22ABCDE1234F1Z5</p>
                <p>techbzr@example.com</p>
                <p>+91 9876543210</p>
            </div>
        </div>

        <!-- Billing -->
        <div class="section flex">
            <div>
                <h3>BILL TO</h3>
                <p>{{ $invoice->customer->name ?? 'N/A' }}</p>
                <p>Ph: {{ $invoice->customer->contact ?? '-' }}</p>
                <p>{{ $invoice->address->city ?? 'N/A' }}</p>
            </div>
            <div>
                <h3>PAY TO</h3>
                <p>TechBzr Pvt Ltd</p>
                <p>Bank: Borcele Bank</p>
                <p>A/C No: 50100234567890</p>
                <p>IFSC: BORC0001234</p>
            </div>
        </div>

        <!-- Items -->
        <div class="items">
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Unit Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->salesItems as $item)
                        <tr>
                            <td>{{ $item->product->name ?? 'N/A' }}</td>
                            <td>₹{{ number_format($item->product->sell_price ?? 0, 2) }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>₹{{ number_format(($item->product->sell_price ?? 0) * $item->qty, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Totals -->
        <div class="totals section" style="max-width:300px; float: right;">
            <div><span class="label">Subtotal:</span><span
                    class="value">₹{{ number_format($invoice->subtotal, 2) }}</span></div>
            <div><span class="label">Tax ({{ $invoice->tax_rate ?? 0 }}%):</span><span
                    class="value">₹{{ number_format($invoice->tax, 2) }}</span></div>
            @if ($invoice->discount > 0)
                <div><span class="label">Discount:</span><span class="value"
                        style="color:red">-₹{{ number_format($invoice->discount, 2) }}</span></div>
            @endif
            <div style="border-top: 1px solid #ccc; margin-top:10px; padding-top: 10px; font-size:16px;">
                <span class="label">TOTAL:</span><span class="value">₹{{ number_format($invoice->total, 2) }}</span>
            </div>
        </div>

        <!-- Payment Info -->
        <div class="section" style="clear: both;">
            <p><strong>Status:</strong>
                <span class="status {{ $invoice->sale->payment_status === 'paid' ? 'paid' : 'due' }}">
                    {{ ucfirst($invoice->sale->payment_status) }}
                </span>
            </p>
            <p><strong>Payment Method:</strong> {{ $invoice->payment->method ?? 'N/A' }}</p>
        </div>

        <!-- Notes -->
        <div class="section">
            <p><strong>Note:</strong> Payment due within 30 days. Late payment may be subject to additional charges.</p>
        </div>

        <!-- Signature -->
        <div class="section">
            <p>Authorized Signature:</p>
            <div style="border-bottom: 1px solid #ccc; width: 200px; height: 40px;"></div>
        </div>

        <!-- Footer -->
        <div class="footer"
            style="text-align:center; font-size:12px; color: #6b7280; border-top: 1px solid #e5e7eb; padding-top: 10px; margin-top: 20px;">
            Thank you for shopping with TECHBZR! | Email: techbzr@example.com | Helpline: +91 9876543210
        </div>
        @if (!request()->has('pdf'))
  <div style="width: 800px; margin: 20px auto; text-align: right;">
    <button onclick="window.print()" style="padding: 10px 16px; background-color: #2563eb; color: white; border: none; border-radius: 4px; margin-right: 10px; cursor: pointer;">
      🖨️ Print
    </button>

    <a href="{{ route('downloadPdf', $invoice->id) }}" style="padding: 10px 16px; background-color: #374151; color: white; text-decoration: none; border-radius: 4px;">
      ⬇️ Download PDF
    </a>
  </div>
@endif

    </div>
</body>

</html>
