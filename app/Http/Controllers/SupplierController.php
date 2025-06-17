<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Controllers\Controller;
use App\Models\Address;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("manager.supplier.manage-supplier");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            //supplier
            'supplier_name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:suppliers,email',
            'phone' => 'required|string|max:20|unique:suppliers,phone',
            'notes' => 'nullable|string|max:500',

            // Address

            'address' => 'required|string|max:500',
            'addressable_type' => 'required|in:customer,supplier',
            'purpose' => 'required|in:billing,shipping',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
        ]);

        $address = Address::create([
            'address' => $request->address,
            'addressable_type' => $request->addressable_type,
            'purpose' => $request->purpose,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'pincode' => $request->pincode
        ]);

        Supplier::create([
            'supplier_name' => $request->supplier_name,
            'company' => $request->company,
            'email' => $request->email,
            'phone' => $request->phone,
            'address_id' => $address->id,
            'notes' => $request->notes
        ]);
        ToastMagic::success('Customer Add successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
