<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Quote;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('manager.quotes.create-quote', compact('customers','products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'quotation-no' => 'required|string|max:255|unique:quotes,quotation-no',
            'valid_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:sent,draft,accepted,rejected,cancelled',
            'customer_id' => 'required|exists:customers,id',
            'notes' => 'nullable|string|max:1000',
            'subtotal' => 'required|numeric|min:0',
            'tax' => 'required|string|max:255', // Changed from '255' to 'max:255'
            'total' => 'required|numeric|min:0|gte:subtotal',
        ]);

        Quote::create($data);
        return redirect()->back();



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
