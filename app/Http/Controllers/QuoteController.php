<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Quote;
use App\Http\Controllers\Controller;
use App\Models\QuotesItems;
use DB;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $customers = Customer::all();
        return view('manager.quotes.create-quote', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate main quotation data
        $validatedData = $request->validate([
            'quotation_no' => 'required|string|max:255|unique:quotes,quotation_no',
            'valid_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:sent,draft,accepted,rejected,cancelled',
            'customer_id' => 'required|exists:customers,id',
            'notes' => 'nullable|string|max:1000',
            'subtotal' => 'required|numeric',
            'tax' => 'required|numeric', // Added max 100 for percentage
            'total' => 'required|numeric',

            // Validate products array
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.description' => 'nullable|string|max:65535',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit' => 'required|string|in:piece,box',
            'items.*.mrp' => 'required|numeric|min:0|max:99999999.99',
            'items.*.discount' => 'required|numeric|min:0|max:99999999.99',
        ]);

        // Use database transaction for data integrity
        DB::beginTransaction();

        try {
            // Create the quotation
            $quotation = Quote::create([
                'quotation_no' => $validatedData['quotation_no'],
                'valid_date' => $validatedData['valid_date'],
                'status' => $validatedData['status'],
                'customer_id' => $validatedData['customer_id'],
                'notes' => $validatedData['notes'] ?? null,
                'subtotal' => $validatedData['subtotal'],
                'tax' => $validatedData['tax'],
                'total' => $validatedData['total'],
               
            ]);

            // Create quotation items
            foreach ($validatedData['items'] as $item) {
                $netPrice = $item['mrp'] - $item['discount'];
                $taxAmount = $netPrice * $validatedData['tax'] / 100;

                QuotesItems::create([
                    'quote_id' => $quotation->id,
                    'product_id' => $item['product_id'],
                    'description' => $item['description'] ?? null,
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'mrp' => $item['mrp'],
                    'discount' => $item['discount'],
                  
                ]);
            }

            DB::commit();

            // Optional: Generate PDF or send email notification here
            // $this->generateQuotationPDF($quotation->id);

            ToastMagic::success('Quotation created successfully!');
            return redirect()->route('quotations.show', $quotation);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quotation creation failed: ' . $e->getMessage());

            // More specific error message
            $errorMessage = 'Failed to create quotation. ';
            $errorMessage .= str_contains($e->getMessage(), 'quotation_no')
                ? 'Quotation number already exists.'
                : 'Please try again.';

          
            return redirect()->back()->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Quote $quote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quote $quote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quote $quote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quote $quote)
    {
        //
    }
}
