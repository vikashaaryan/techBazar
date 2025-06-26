<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Invoice;
use App\Models\Payment; // Assuming you have a Payment model
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    protected $razorpay;

    public function __construct()
    {
        $this->razorpay = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
    }

    public function createOrder(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'invoice_id' => 'required|exists:invoices,id'
        ]);

        try {
            DB::beginTransaction();

            $invoice = Invoice::findOrFail($validated['invoice_id']);

            // Create Razorpay order
            $order = $this->razorpay->order->create([
                'receipt' => 'INV_' . $invoice->id . '_' . Str::random(6),
                'amount' => $validated['amount'] * 100, // Convert to paise
                'currency' => 'INR',
                'payment_capture' => 1
            ]);

            // Create payment record
            $payment = Payment::create([
                'order_id' => $order->id,
                'invoice_id' => $invoice->id,
                'customer_id' => $invoice->customer_id,
                'type' => 'customer',
                'payment_for' => 'sell',
                'method' => 'razorpay',
                'amount' => $validated['amount'],
                'status' => 'pending',
                'payment_status' => 'partial'
            ]);

            DB::commit();

            return response()->json([
                'id' => $order->id,
                'amount' => $order->amount,
                'currency' => $order->currency,
                'payment_id' => $payment->id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Order creation failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function handleSuccess(Request $request)
    {
        $validated = $request->validate([
            'razorpay_order_id' => 'required',
            'razorpay_payment_id' => 'required',
            'razorpay_signature' => 'required',
            'invoice_id' => 'required|exists:invoices,id',
            'payment_id' => 'required|exists:payments,id'
        ]);

        try {
            DB::beginTransaction();

            // Verify payment signature
            $this->razorpay->utility->verifyPaymentSignature([
                'razorpay_order_id' => $validated['razorpay_order_id'],
                'razorpay_payment_id' => $validated['razorpay_payment_id'],
                'razorpay_signature' => $validated['razorpay_signature']
            ]);

            $invoice = Invoice::findOrFail($validated['invoice_id']);
            $payment = Payment::findOrFail($validated['payment_id']);

            // Update payment record
            $payment->update([
                'payment_id' => $validated['razorpay_payment_id'],
                'signature' => $validated['razorpay_signature'],
                'status' => 'captured',
                'amount_paid' => $payment->amount
            ]);

            // Update invoice payment status
            $totalPaid = $invoice->payments()->where('status', 'captured')->sum('amount');
            $paymentStatus = ($totalPaid >= $invoice->total) ? 'paid' : 'partial';

            $invoice->update([
                'payment_status' => $paymentStatus,
                'amount_paid' => $totalPaid
            ]);

            DB::commit();

            // TODO: Send payment confirmation notification

            return response()->json([
                'success' => true,
                'redirect' => route('invoices.show', $invoice),
                'invoice_status' => $paymentStatus
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            // Mark payment as failed if verification fails
            if (isset($payment)) {
                $payment->update(['status' => 'failed']);
            }

            return response()->json([
                'success' => false,
                'error' => 'Payment verification failed: ' . $e->getMessage()
            ], 400);
        }
    }
}
