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
        $suppliers = Supplier::all();
        return view("manager.supplier.manage-supplier", compact('suppliers'));
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
            'status' => 'nullable|boolean',

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
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'company'       => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:suppliers,email,' . $supplier->id,
            'phone'         => 'required|string|max:20|unique:suppliers,phone,' . $supplier->id,
            'notes'         => 'nullable|string|max:500',
            'status'        => 'required|boolean',

            'address'       => 'required|string|max:500',
            'city'          => 'required|string|max:100',
            'state'         => 'required|string|max:100',
            'country'       => 'required|string|max:100',
            'pincode'       => 'required|string|max:10',
        ], [
            'email.unique' => 'The email address is already in use by another supplier.',
            'phone.unique' => 'The phone number is already in use by another supplier.',
            'supplier_name.required' => 'The supplier name field is required.',
            'company.required' => 'The company name field is required.',
            'address.required' => 'The address field is required.',
            'pincode.required' => 'The postal code field is required.',
        ]);

        // Update Supplier data
        $supplier->update([
            'supplier_name' => $request->supplier_name,
            'company'       => $request->company,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'notes'         => $request->notes,
            'status'        => $request->status,
        ]);

        // Prepare address data
        $addressData = [
            'address'   => $request->address,
            'purpose'   => $request->purpose ?? 'billing', // default if not passed
            'city'      => $request->city,
            'state'     => $request->state,
            'country'   => $request->country,
            'pincode'   => $request->pincode,
        ];

        // Update or create related address
        if ($supplier->address) {
            $supplier->address->update($addressData);
        } else {
            $supplier->address()->create($addressData);
        }

        return redirect()->back();
        ToastMagic::success('Supplier updated successfully!');
    }

  
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        ToastMagic::success('Supplier deleted successfully!');
        return redirect()->back();
    }
}
