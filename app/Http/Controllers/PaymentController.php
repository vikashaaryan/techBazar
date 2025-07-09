<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentReceivedMail;

class PaymentController extends Controller
{
    public function records(Request $request)
    {
        // Start with base query
        $payments = Payment::with(['customer', 'invoice'])
            ->latest();

        // Apply search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $payments->where(function ($query) use ($search) {
                $query->where('payment_id', 'like', "%{$search}%")
                    ->orWhere('order_id', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('contact', 'like', "%{$search}%");
                    });
            });
        }

        // Apply status filter
        if ($request->has('status') && !empty($request->status)) {
            $payments->where('status', $request->status);
        }

        // Apply payment status filter
        if ($request->has('payment_status') && !empty($request->payment_status)) {
            $payments->where('payment_status', $request->payment_status);
        }

        // Apply method filter
        if ($request->has('method') && !empty($request->method)) {
            $payments->where('method', $request->method);
        }

        // Apply date range filter
        if ($request->has('date_range') && !empty($request->date_range)) {
            $dates = explode(' - ', $request->date_range);
            if (count($dates) == 2) {
                $payments->whereBetween('created_at', [trim($dates[0]), trim($dates[1])]);
            }
        }

        $payments = $payments->paginate(10);

        // Summary calculations
        $totalRevenue = Payment::where('status', 'captured')->sum('amount');
        $successfulPayments = Payment::where('status', 'captured')->count();
        $pendingPayments = Payment::where('status', 'pending')->count();

        return view('manager.payments.payment-record', [
            'payments' => $payments,
            'totalRevenue' => $totalRevenue,
            'successfulPayments' => $successfulPayments,
            'pendingPayments' => $pendingPayments,
            'filters' => $request->all(),
        ]);
    }

    public function enterPayment()
    {
        // Get invoices with remaining balance
        $invoices = Invoice::with(['customer', 'payments'])
            ->whereNotIn('status', ['paid', 'cancelled'])
            ->get()
            ->filter(function ($invoice) {
                $paidAmount = $invoice->payments->sum('amount');
                return ($invoice->total - $paidAmount) > 0;
            })
            ->map(function ($invoice) {
                $paidAmount = $invoice->payments->sum('amount');
                return [
                    'id' => $invoice->id,
                    'invoice_number' => $invoice->invoice_no,
                    'customer_name' => $invoice->customer->name,
                    'customer_email' => $invoice->customer->email,
                    'customer_phone' => $invoice->customer->phone,
                    'total' => $invoice->total,
                    'paid_amount' => $paidAmount,
                    'balance' => $invoice->total - $paidAmount,
                    'due_date' => $invoice->due_date,
                ];
            });

        return view('manager.payments.enter-payment', [
            'invoices' => $invoices,
            'paymentMethods' => [
                'cash' => 'Cash',
                'card' => 'Credit Card',
                'upi' => 'UPI',
                'bank' => 'Bank Transfer',
                'check' => 'Check',
                'razorpay' => 'Razorpay'
            ],
            'defaultDate' => now()->format('Y-m-d')
        ]);
    }

    public function storePayment(Request $request)
    {
        $validated = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric|min:0.01',
            'method' => 'required|in:cash,card,upi,bank,check,razorpay',
        ]);

        DB::beginTransaction();
        try {
            $invoice = Invoice::with(['customer', 'payments'])->findOrFail($validated['invoice_id']);
            $paidAmount = $invoice->payments->sum('amount');
            $balance = $invoice->total - $paidAmount;

            // Validate payment amount
            if ($validated['amount'] > $balance) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment amount cannot exceed the remaining balance of $' . number_format($balance, 2)
                ], 422);
            }

            // Determine payment status
            $paymentStatus = 'partial';
            $fullyPaid = false;

            if (abs(($paidAmount + $validated['amount']) - $invoice->total) < 0.01) {
                $paymentStatus = 'paid';
                $fullyPaid = true;
            }

            // Create payment
            $payment = new Payment([
                'invoice_id' => $invoice->id,
                'customer_id' => $invoice->customer_id,
                'payment_date' => $validated['payment_date'],
                'amount' => $validated['amount'],
                'method' => $validated['method'],
                'status' => 'captured',
                'payment_status' => $paymentStatus,
            ]);
            $payment->save();

            // Update invoice
            $newPaidAmount = $paidAmount + $validated['amount'];
            $invoice->amount_paid = $newPaidAmount;

            // Update invoice status
            if ($fullyPaid) {
                $invoice->status = 'paid';
            } elseif ($newPaidAmount > 0) {
                $invoice->status = 'partial';
            }

            $invoice->save();

            // Send notifications if invoice is fully paid
       
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Payment recorded successfully!',
                'invoice_id' => $invoice->id,
                'fully_paid' => $fullyPaid
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment processing error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Payment failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
