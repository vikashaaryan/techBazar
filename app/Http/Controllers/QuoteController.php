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

        $quotation_no = Quote::generateQuotationNumber(); // Use your model method

        return view('manager.quotes.create-quote', compact('customers', 'products', 'quotation_no'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $generatedQuotationNo = Quote::generateQuotationNumber();


        // Step 2: Validate request (no need to validate user-inputted quotation_no)
        $validatedData = $request->validate([
            'valid_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:sent,draft,accepted,rejected,cancelled',
            'customer_id' => 'required|exists:customers,id',
            'notes' => 'nullable|string|max:1000',
            'subtotal' => 'required|numeric',
            'tax' => 'required|numeric',
            'total' => 'required|numeric',

            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.description' => 'nullable|string|max:65535',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit' => 'required|string|in:piece,box',
            'items.*.mrp' => 'required|numeric|min:0|max:99999999.99',
            'items.*.discount' => 'required|numeric|min:0|max:99999999.99',
        ]);

        DB::beginTransaction();

        try {
            // Step 3: Create quote using auto-generated quotation number
            $quotation = Quote::create([
                'quotation_no' => $generatedQuotationNo,
                'valid_date' => $validatedData['valid_date'],
                'status' => $validatedData['status'],
                'customer_id' => $validatedData['customer_id'],
                'notes' => $validatedData['notes'] ?? null,
                'subtotal' => $validatedData['subtotal'],
                'tax' => $validatedData['tax'],
                'total' => $validatedData['total'],
            ]);

            // Step 4: Create items
            foreach ($validatedData['items'] as $item) {
                QuotesItems::create([
                    'quote_id' => $quotation->id,
                    'product_id' => $item['product_id'],
                    'description' => $item['description'] ?? null,
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'mrp' => $item['mrp'],
                    'discount' => $item['discount'],
                    'tax' => $validatedData['tax'], // Optional: store total tax per item
                ]);
            }

            DB::commit();

            ToastMagic::success('Quotation created successfully!');
            return redirect()->route('quotations.show', $quotation);

        } catch (\Exception $e) {
            Db::rollBack();
            Log::error('Quotation creation failed: ' . $e->getMessage());

            return redirect()->back()->withInput()->withErrors([
                'error' => 'Failed to create quotation. ' . $e->getMessage()
            ]);
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
