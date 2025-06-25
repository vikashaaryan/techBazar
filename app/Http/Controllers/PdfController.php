<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Invoice;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PdfController extends Controller
{
    public function genratePdf(Request $request, $id)
    {
        $invoice = Invoice::with(['customer.address', 'sale.product', 'salesItems.product'])->findOrFail($id);
        return view('manager.invoice-genrate-pdf', compact('invoice'));
    }

        public function downloadPdf(Request $request, $id)
        {
            $invoice = Invoice::with(['customer.address', 'sale.product', 'salesItems.product'])->findOrFail($id);
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('manager.invoice-genrate-pdf', compact('invoice'));
            return $pdf->download('invoice_' . $invoice->id . '.pdf');
        }

    public function SendEmail(Request $request, $id)
    {
        $invoice = Invoice::with(['customer.address', 'sale.product', 'salesItems.product'])->findOrFail($id);

        try { 
            // Validate customer has email
            if (empty($invoice->customer->email)) {
                throw new \Exception('Customer email is empty');
            }

            Mail::to($invoice->customer->email)->send(new InvoiceMail($invoice));

            ToastMagic::success('Email sent successfully to ' . $invoice->customer->email);
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
            ToastMagic::error('Failed to send email: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
