<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function genratePdf(Request $request ,$id)
    {
        $invoice = Invoice::with(['customer', 'sale.product', 'salesItems.product'])->findOrFail($id);

        return view('manager.invoice-genrate-pdf', compact('invoice'));
        // $pdf = Pdf::loadView('manager.invoice-genrate-pdf', $data);
        // return $pdf->download('invoice.pdf');
    }
}
